<?php

namespace App\Http\Controllers;

use App\Models\BimbelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;

class BimbelController extends Controller
{
    public function index(Request $request)
    {
        // Check permission untuk akses Bimbel
        $PermissionBimbel = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel');
        if(empty($PermissionBimbel)){
            abort(404);
        }

        // Update status berdasarkan tanggal setiap kali halaman diakses
        BimbelModel::updateStatusBasedOnDate();

        // Perbaiki nama variabel permission sesuai dengan yang digunakan di view
        $data['PermissionDelete'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel Delete');
        $data['PermissionDetail'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel Detail');

        $perPage = $request->get('per_page', 3);
        $query = BimbelModel::query();

        // Filter berdasarkan status jika ada
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan search jika ada
        if ($request->has('search') && $request->search !== '') {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $data['total_active'] = BimbelModel::where('status', 'active')->count();
        $data['total_inactive'] = BimbelModel::where('status', 'inactive')->count();
        $data['total_today'] = BimbelModel::whereDate('created_at', today())->count();
        $data['total_all'] = BimbelModel::count();
        $data['bimbels'] = $query->orderBy('created_at', 'desc')->paginate($perPage);
        $data['per_page'] = $perPage;

        return view('users.bimbel', $data);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'age' => 'required|integer|min:1',
                'phone' => 'required|string|max:15',
                'bimbel_type' => 'required|in:online,offline',
                'service_type' => 'required',
                'gender' => 'required|in:L,P',
                'birth_place' => 'required|string',
                'birth_date' => 'required|date',
                'has_school_history' => 'required|boolean',
                'school_name' => 'nullable|required_if:has_school_history,1',
                'religion' => 'required',
                'address' => 'required|string',
                'child_order' => 'required|integer|min:1',
                'child_phone' => 'nullable|string',
                'father_name' => 'required|string',
                'father_age' => 'required|integer',
                'father_education' => 'required|string',
                'father_occupation' => 'required|string',
                'mother_name' => 'required|string',
                'mother_age' => 'required|integer',
                'mother_education' => 'required|string',
                'mother_occupation' => 'required|string',
                'student_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'start_date' => 'required|date',
                'total_meetings' => [
                    'required',
                    'integer',
                    function ($attribute, $value, $fail) use ($request) {
                        $expectedMeetings = $request->service_type === 'bimbel_coding' ? 4 : 8;
                        if ($value !== $expectedMeetings) {
                            $fail('Jumlah pertemuan tidak sesuai dengan jenis bimbel yang dipilih.');
                        }
                    },
                ],
                'need_socks' => 'boolean'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $validator->errors()
                ], 422);
            }

            // Handle file uploads dengan pengecekan
            if (!$request->hasFile('student_photo') || !$request->hasFile('payment_proof')) {
                throw new \Exception('File foto siswa dan bukti pembayaran harus diupload');
            }

            $studentPhoto = $request->file('student_photo');
            $paymentProof = $request->file('payment_proof');

            if (!$studentPhoto->isValid() || !$paymentProof->isValid()) {
                throw new \Exception('File tidak valid');
            }

            $studentPhotoPath = $studentPhoto->store('student_photos', 'public');
            $paymentProofPath = $paymentProof->store('payment_proofs', 'public');

            // Get day from start_date
            $day = BimbelModel::getDayFromDate($request->start_date);

            // Create bimbel record
            $bimbel = BimbelModel::create([
                'name' => $request->name,
                'age' => $request->age,
                'phone' => $request->phone,
                'bimbel_type' => $request->bimbel_type,
                'service_type' => $request->service_type,
                'gender' => $request->gender,
                'birth_place' => $request->birth_place,
                'birth_date' => $request->birth_date,
                'has_school_history' => $request->has_school_history,
                'school_name' => $request->school_name,
                'religion' => $request->religion,
                'address' => $request->address,
                'child_order' => $request->child_order,
                'child_phone' => $request->child_phone,
                'father_name' => $request->father_name,
                'father_age' => $request->father_age,
                'father_education' => $request->father_education,
                'father_occupation' => $request->father_occupation,
                'mother_name' => $request->mother_name,
                'mother_age' => $request->mother_age,
                'mother_education' => $request->mother_education,
                'mother_occupation' => $request->mother_occupation,
                'student_photo' => $studentPhotoPath,
                'payment_proof' => $paymentProofPath,
                'start_date' => $request->start_date,
                'day' => $day,
                'total_meetings' => $request->total_meetings,
                'need_socks' => $request->has('need_socks') ? true : false,
                'status' => 'active'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data bimbel berhasil disimpan',
                'data' => $bimbel
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function detail($id)
    {
        try {
            // Ubah nama permission dari 'Bimbel_Detail' menjadi 'Bimbel Detail'
            $PermissionDetail = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel Detail');
            if(empty($PermissionDetail)){
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 403);
            }

            $bimbel = BimbelModel::findOrFail($id);

            // Hitung harga
            $basePrice = 50000;
            $socksPrice = $bimbel->need_socks ? 15000 : 0;
            $totalPrice = $basePrice + $socksPrice;

            // Format data untuk response
            $data = [
                'id' => $bimbel->id,
                'name' => $bimbel->name,
                'age' => $bimbel->age,
                'phone' => $bimbel->phone,
                'child_phone' => $bimbel->child_phone,
                'gender' => $bimbel->gender,
                'birth_place' => $bimbel->birth_place,
                'birth_date' => Carbon::parse($bimbel->birth_date)->format('d F Y'),
                'religion' => ucfirst($bimbel->religion),
                'address' => $bimbel->address,
                'child_order' => $bimbel->child_order,
                'father_name' => $bimbel->father_name,
                'father_age' => $bimbel->father_age,
                'father_education' => $bimbel->father_education,
                'father_occupation' => $bimbel->father_occupation,
                'mother_name' => $bimbel->mother_name,
                'mother_age' => $bimbel->mother_age,
                'mother_education' => $bimbel->mother_education,
                'mother_occupation' => $bimbel->mother_occupation,
                'bimbel_type' => ucfirst($bimbel->bimbel_type),
                'service_type' => ucfirst($bimbel->service_type),
                'day' => $bimbel->day,
                'total_meetings' => $bimbel->total_meetings,
                'status' => $bimbel->status,
                'need_socks' => $bimbel->need_socks,
                'student_photo_url' => Storage::url($bimbel->student_photo),
                'base_price' => $basePrice,
                'socks_price' => $socksPrice,
                'total_price' => $totalPrice
            ];

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Detail bimbel berhasil diambil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus($id, Request $request)
    {
        try {
            $bimbel = BimbelModel::findOrFail($id);
            $bimbel->status = $request->status;
            $bimbel->save();

            return response()->json([
                'success' => true,
                'message' => 'Status berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate status'
            ], 500);
        }
    }

    public function trackMeeting($id, Request $request)
    {
        try {
            $bimbel = BimbelModel::findOrFail($id);
            $currentMeeting = $request->meeting_number;

            // Simpan progress pertemuan
            // Implementasi sesuai kebutuhan

            return response()->json([
                'success' => true,
                'message' => 'Progress pertemuan berhasil disimpan'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan progress'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Check permission untuk delete
            $PermissionDelete = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel Delete');
            if(empty($PermissionDelete)){
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 403);
            }

            // Cari data bimbel
            $bimbel = BimbelModel::findOrFail($id);

            // Hapus file foto dan bukti pembayaran jika ada
            if ($bimbel->student_photo && Storage::disk('public')->exists($bimbel->student_photo)) {
                Storage::disk('public')->delete($bimbel->student_photo);
            }

            if ($bimbel->payment_proof && Storage::disk('public')->exists($bimbel->payment_proof)) {
                Storage::disk('public')->delete($bimbel->payment_proof);
            }

            // Hapus data dari database
            if ($bimbel->delete()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data bimbel berhasil dihapus'
                ]);
            }

            throw new \Exception('Gagal menghapus data bimbel');

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data bimbel tidak ditemukan'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data'
            ], 500);
        }
    }

    public function search(Request $request)
    {
        try {
            $perPage = $request->get('per_page', 3);
            $query = $request->get('query', '');
            $status = $request->get('status', '');

            $results = BimbelModel::query();

            if (!empty($query)) {
                $results->where(function($q) use ($query) {
                    $q->where('name', 'LIKE', '%' . $query . '%')
                      ->orWhere('day', 'LIKE', '%' . $query . '%')
                      ->orWhere('service_type', 'LIKE', '%' . $query . '%');
                });
            }

            if (!empty($status)) {
                $results->where('status', $status);
            }

            $paginated = $results->orderBy('created_at', 'desc')->paginate($perPage);

            if ($paginated && is_countable($paginated->items())) {
                $formattedData = collect($paginated->items())->map(function($item) {
                    return [
                        'id' => $item->id,
                        'name' => $item->name,
                        'age' => $item->age,
                        'day' => $item->day,
                        'bimbel_type' => $item->bimbel_type,
                        'service_type' => $item->service_type,
                        'total_meetings' => $item->total_meetings,
                        'status' => $item->status,
                        'need_socks' => $item->need_socks
                    ];
                });
            } else {
                $formattedData = [];
            }

            return response()->json([
                'data' => $formattedData,
                'current_page' => $paginated ? $paginated->currentPage() : 1,
                'last_page' => $paginated ? $paginated->lastPage() : 1,
                'per_page' => $perPage,
                'total' => $paginated ? $paginated->total() : 0,
                'canDetail' => Auth::user() && PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel Detail'),
                'canDelete' => Auth::user() && PermissionRoleModel::getPermission(Auth::user()->role_id, 'Bimbel Delete')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'data' => [],
                'current_page' => 1,
                'last_page' => 1,
                'per_page' => $request->get('per_page', 3),
                'total' => 0,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
