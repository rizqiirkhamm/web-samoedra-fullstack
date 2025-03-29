<?php

namespace App\Http\Controllers;

use App\Models\BermainModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BermainController extends Controller
{
    public function index(Request $request)
    {
        // Check permission untuk akses Bermain
        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bermain');
        if(empty($PermissionRole)){
            abort(404);
        }

        // Get permission untuk Delete
        $data['PermissionDelete'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Delete Bermain');

        // Update semua status terlebih dahulu
        $this->updateAllStatus();

        $perPage = $request->get('per_page', 3); // Default 3 items per page
        $query = BermainModel::query();

        // Filter berdasarkan status jika ada
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan search jika ada
        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('day', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('start_datetime', 'LIKE', '%' . $request->search . '%');
            });
        }

        // Update data untuk tampilan
        $data['total_active'] = BermainModel::where('status', 'playing')->count();
        $data['total_today'] = BermainModel::whereDate('created_at', today())->count();
        $data['total_all'] = BermainModel::count();
        $data['bermain'] = $query->orderBy('start_datetime', 'desc')->paginate($perPage);
        $data['per_page'] = $perPage;

        return view('users.bermain', $data);
    }

    private function updateAllStatus()
    {
        try {
            $now = Carbon::now();
            Log::info('Updating all status at: ' . $now);

            // Update status waiting ke playing
            BermainModel::where('status', 'waiting')
                ->where('start_datetime', '<=', $now)
                ->where('end_datetime', '>', $now)
                ->each(function($bermain) use ($now) {
                    Log::info('Checking record:', [
                        'id' => $bermain->id,
                        'start' => $bermain->start_datetime,
                        'current' => $now,
                        'end' => $bermain->end_datetime
                    ]);

                    $startDateTime = Carbon::parse($bermain->start_datetime);
                    $endDateTime = Carbon::parse($bermain->end_datetime);

                    if ($now->between($startDateTime, $endDateTime)) {
                        $bermain->status = 'playing';
                        $bermain->remaining_time = $now->diffInSeconds($endDateTime);
                        $bermain->save();

                        Log::info('Updated to playing:', [
                            'id' => $bermain->id,
                            'remaining_time' => $bermain->remaining_time
                        ]);
                    }
                });

            // Update status playing ke finished
            BermainModel::where('status', 'playing')
                ->get()
                ->each(function($bermain) use ($now) {
                    $endDateTime = Carbon::parse($bermain->end_datetime);

                    if ($now->gte($endDateTime)) {
                        $bermain->status = 'finished';
                        $bermain->remaining_time = 0;
                        $bermain->save();

                        Log::info('Updated to finished:', [
                            'id' => $bermain->id
                        ]);
                    } else {
                        // Update remaining time untuk yang masih bermain
                        $bermain->remaining_time = $now->diffInSeconds($endDateTime);
                        $bermain->save();
                    }
                });

        } catch (\Exception $e) {
            Log::error('Error updating status: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'phone' => 'required|string|max:15',
            'selected_time' => 'required',
            'duration' => 'required|integer|between:1,3',
            'day' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu,Minggu',
            'date' => 'required|date',
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/payment_proofs', $filename);
            $validated['payment_proof'] = $filename;
        }

        // Set status dan waktu
        $startDateTime = Carbon::parse($validated['date'] . ' ' . $validated['selected_time']);
        $endDateTime = $startDateTime->copy()->addHours($validated['duration']);

        $validated['status'] = 'waiting';
        $validated['start_datetime'] = $startDateTime;
        $validated['end_datetime'] = $endDateTime;
        $validated['remaining_time'] = $validated['duration'] * 3600;

        $bermain = BermainModel::create($validated);
        Log::info('New record created:', [
            'id' => $bermain->id,
            'start' => $bermain->start_datetime,
            'end' => $bermain->end_datetime
        ]);

        return redirect()->route('bermain.index')
            ->with('success', 'Reservasi berhasil dibuat!');
    }

    public function updateTimer($id)
    {
        try {
            $bermain = BermainModel::findOrFail($id);
            $now = Carbon::now();
            $startDateTime = Carbon::parse($bermain->start_datetime);
            $endDateTime = Carbon::parse($bermain->end_datetime);

            Log::info('Updating timer for ID: ' . $id, [
                'current_time' => $now,
                'start_time' => $startDateTime,
                'end_time' => $endDateTime,
                'current_status' => $bermain->status
            ]);

            if ($bermain->status === 'waiting' && $now->gte($startDateTime)) {
                $bermain->status = 'playing';
                $bermain->remaining_time = (int) $now->diffInSeconds($endDateTime);
                $bermain->save();

                return response()->json([
                    'status' => 'playing',
                    'remaining_time' => (int) $bermain->remaining_time
                ]);
            }

            if ($bermain->status === 'playing') {
                if ($now->gte($endDateTime)) {
                    $bermain->status = 'finished';
                    $bermain->remaining_time = 0;
                    $bermain->save();

                    return response()->json([
                        'status' => 'finished',
                        'remaining_time' => 0
                    ]);
                }

                $bermain->remaining_time = $now->diffInSeconds($endDateTime);
                $bermain->save();

                return response()->json([
                    'status' => 'playing',
                    'remaining_time' => $bermain->remaining_time
                ]);
            }

            return response()->json([
                'status' => $bermain->status,
                'remaining_time' => $bermain->remaining_time
            ]);

        } catch (\Exception $e) {
            Log::error('Error updating timer: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        // Check permission untuk Delete Bermain
        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Delete Bermain');
        if(empty($PermissionRole)){
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $bermain = BermainModel::findOrFail($id);
        $bermain->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }

    public function search(Request $request)
    {
        $this->updateAllStatus();

        $perPage = $request->get('per_page', 3);
        $query = $request->get('query');

        $results = BermainModel::where(function($q) use ($query) {
            $q->where('name', 'LIKE', '%' . $query . '%')
              ->orWhere('day', 'LIKE', '%' . $query . '%')
              ->orWhere('start_datetime', 'LIKE', '%' . $query . '%');
        });

        if ($request->has('status') && $request->status !== 'all') {
            $results->where('status', $request->status);
        }

        $paginated = $results->orderBy('start_datetime', 'desc')
                            ->paginate($perPage);

        // Format data sebelum dikirim ke response
        $formattedData = collect($paginated->items())->map(function($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'age' => $item->age,
                'day' => $item->day,
                'start_datetime' => Carbon::parse($item->start_datetime)->format('Y-m-d H:i:s'),
                'end_datetime' => Carbon::parse($item->end_datetime)->format('Y-m-d H:i:s'),
                'status' => $item->status,
                'duration' => $item->duration,
                'remaining_time' => $item->remaining_time
            ];
        });

        return response()->json([
            'data' => $formattedData,
            'current_page' => $paginated->currentPage(),
            'last_page' => $paginated->lastPage(),
            'per_page' => $perPage,
            'total' => $paginated->total()
        ]);
    }
}
