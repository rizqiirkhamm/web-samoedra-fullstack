<?php

namespace App\Http\Controllers;

use App\Models\PermissionRoleModel;
use App\Models\StimulasiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StimulasiController extends Controller
{
    public function index(Request $request) {
        // Check permission untuk akses Stimulasi
        $PermissionStimulasi = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Stimulasi');
        if(empty($PermissionStimulasi)){
            abort(404);
        }

        $query = StimulasiModel::query();
        $per_page = in_array($request->per_page, [3, 5, 7]) ? $request->per_page : 3;

        // Handle search
        if ($request->has('search') && !empty($request->search)) {
            $searchQuery = $request->search;
            $query->where(function($q) use ($searchQuery) {
                $q->where('name', 'like', "%{$searchQuery}%");
            });
        }

        // Handle status filter
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Jika request AJAX
        if ($request->ajax()) {
            $stimulasis = $query->orderBy('created_at', 'desc')->paginate($per_page);
            return response()->json([
                'success' => true,
                'html' => view('users.stimulasi-table', compact('stimulasis'))->render(),
                'pagination' => [
                    'current_page' => $stimulasis->currentPage(),
                    'last_page' => $stimulasis->lastPage(),
                    'total' => $stimulasis->total()
                ]
            ]);
        }

        // Regular request
        $data['total_today'] = StimulasiModel::whereDate('created_at', today())->count();
        $data['total_active'] = StimulasiModel::where('status', 'active')->count();
        $data['total_all'] = StimulasiModel::count();
        $data['stimulasis'] = $query->orderBy('created_at', 'desc')->paginate($per_page)->appends($request->except('page'));
        $data['per_page'] = $per_page;

        return view('users.stimulasi', $data);
    }

    public function detail($id){
        $stimulasi = StimulasiModel::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => $stimulasi
        ]);
    }

    public function destroy($id){
        try {
            $stimulasi = StimulasiModel::findOrFail($id);
            $stimulasi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data stimulasi berhasil dihapus'
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data Stimulasi'
            ], 500);
        }
    }

    public function generateInvoice($id)
    {
        try {
            $stimulasi = StimulasiModel::findOrFail($id);

            // Hitung harga berdasarkan jenis stimulasi (contoh)
            $basePrice = 100000; // Default price

            // Pastikan harga tidak null
            if (!$stimulasi->price) {
                $stimulasi->price = $basePrice;
            }

            // Format data untuk invoice dengan detail lengkap
            $data = [
                'id' => $stimulasi->id,
                'name' => $stimulasi->name,
                'age' => $stimulasi->age,
                'father_name' => $stimulasi->father_name ?? '-',
                'mother_name' => $stimulasi->mother_name ?? '-',
                'address' => $stimulasi->address ?? '-',
                'phone' => $stimulasi->phone ?? '-',
                'stimulasi_type' => ucfirst($stimulasi->stimulasi_type),
                'day' => $stimulasi->day,
                'time' => $stimulasi->time,
                'price' => (int)$stimulasi->price, // Pastikan harga adalah integer
                'created_at' => $stimulasi->created_at->format('d M Y'),
                'status' => $stimulasi->status,
                'logo_path' => public_path('images/logo/logo_samoedra.JPG'),
            ];

            return response()->json([
                'success' => true,
                'data' => $data
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getData(Request $request)
    {
        $query = StimulasiModel::query();

        // Handle search
        if ($request->has('search')) {
            $searchQuery = $request->search;
            $query->where('name', 'like', "%{$searchQuery}%");
        }

        // Handle status filter
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Get per page value
        $per_page = in_array($request->per_page, [3, 5, 7]) ? $request->per_page : 3;

        // Order by created_at
        $query->orderBy('created_at', 'desc');

        $stimulasis = $query->paginate($per_page);
        $PermissionDetail = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Stimulasi Detail');
        $PermissionDelete = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Stimulasi Delete');

        return response()->json([
            'success' => true,
            'data' => view('users.partials.stimulasi-table', compact('stimulasis', 'PermissionDetail', 'PermissionDelete'))->render(),
            'pagination' => view('users.partials.stimulasi-pagination', compact('stimulasis'))->render()
        ]);
    }
}
