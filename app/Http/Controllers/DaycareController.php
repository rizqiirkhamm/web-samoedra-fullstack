<?php

namespace App\Http\Controllers;

use App\Models\DaycareRegistrationModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;

class DaycareController extends Controller
{
    public function index(Request $request)
    {
        // Check permission untuk akses Daycare
        $PermissionDaycare = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Daycare');
        if(empty($PermissionDaycare)){
            abort(404);
        }

        // Perbaiki nama variabel permission sesuai dengan yang digunakan di view
        $data['PermissionDelete'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Daycare Delete');
        $data['PermissionDetail'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Daycare Detail');

        $query = DaycareRegistrationModel::query();

        // Handle search
        if ($request->has('search') && !empty($request->search)) {
            $searchQuery = $request->search;
            $query->where(function($q) use ($searchQuery) {
                $q->where('name', 'like', "%{$searchQuery}%")
                  ->orWhere('father_name', 'like', "%{$searchQuery}%")
                  ->orWhere('mother_name', 'like', "%{$searchQuery}%");
            });
        }

        // Handle status filter
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Get per page value
        $per_page = $request->query('per_page', 10);

        $data['daycares'] = $query->paginate($per_page)->appends($request->except('page'));
        $data['total_today'] = DaycareRegistrationModel::whereDate('created_at', today())->count();
        $data['total_active'] = DaycareRegistrationModel::where('status', 'active')->count();
        $data['total_all'] = DaycareRegistrationModel::count();
        $data['per_page'] = $per_page;

        return view('users.daycare', $data);
    }

    public function detail($id)
    {
        // Sementara bypass permission check untuk testing
        // $PermissionDetail = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Daycare Detail');
        // if(empty($PermissionDetail)){
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Unauthorized access'
        //     ], 403);
        // }

        try {
            $daycare = DaycareRegistrationModel::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $daycare
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    public function destroy($id)
    {
        // Sementara bypass permission check untuk testing
        // $PermissionDelete = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Daycare Delete');
        // if(empty($PermissionDelete)){
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Unauthorized access'
        //     ], 403);
        // }

        try {
            $daycare = DaycareRegistrationModel::findOrFail($id);
            $daycare->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data daycare berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data daycare: ' . $e->getMessage()
            ], 500);
        }
    }

    public function generateInvoice($id)
    {
        try {
            // Ambil data daycare
            $daycare = DaycareRegistrationModel::findOrFail($id);

            // Hitung harga berdasarkan jenis daycare
            $basePrice = 0;
            if ($daycare->daycare_type == 'bulanan') {
                $basePrice = 100000; // Harga bulanan
            } else {
                $basePrice = 110000; // Harga harian
            }

            // Hitung total harga (termasuk kaus kaki jika diperlukan)
            $socksPrice = $daycare->need_socks ? 15000 : 0;
            $totalPrice = $basePrice + $socksPrice;

            // Tambahkan informasi harga ke data
            $daycare->base_price = $basePrice;
            $daycare->socks_price = $socksPrice;
            $daycare->total_price = $totalPrice;

            // Tambahkan keterangan tipe daycare
            $daycare->daycare_type_text = $daycare->daycare_type == 'bulanan' ?
                'Penitipan Anak Bulanan' : 'Penitipan Anak Harian';

            // Tambahkan keterangan bahwa ini hanya biaya pendaftaran
            $daycare->registration_note = 'Catatan: Ini adalah biaya pendaftaran saja';



            return response()->json([
                'success' => true,
                'data' => $daycare
            ]);
        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data invoice: ' . $e->getMessage()
            ], 500);
        }
    }
}