<?php

namespace App\Http\Controllers;

use App\Models\JournalModel;
use App\Models\BimbelModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;

class JournalController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Check permission untuk akses Journal
            $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Journal');
            if(empty($PermissionRole)){
                abort(404);
            }

            // Get permission untuk Add, Edit dan Delete
            $data['PermissionAdd'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Add Journal');
            $data['PermissionEdit'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Journal');
            $data['PermissionDelete'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Delete Journal');

            $perPage = $request->get('per_page', 5);
            $query = JournalModel::with('bimbel');

            // Filter berdasarkan search
            if ($request->has('search') && $request->search !== '') {
                $searchTerm = $request->search;
                $query->where(function($q) use ($searchTerm) {
                    $q->where('nama_guru', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('pelajaran', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('pembahasan', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhereHas('bimbel', function($q) use ($searchTerm) {
                          $q->where('name', 'LIKE', '%' . $searchTerm . '%');
                      });
                });
            }

            // Filter berdasarkan parameter individual
            if ($request->tanggal) {
                $query->whereDate('tanggal', $request->tanggal);
            }
            if ($request->nama_guru) {
                $query->where('nama_guru', 'LIKE', '%' . $request->nama_guru . '%');
            }
            if ($request->bimbel_id) {
                $query->where('bimbel_id', $request->bimbel_id);
            }
            if ($request->pelajaran) {
                $query->where('pelajaran', 'LIKE', '%' . $request->pelajaran . '%');
            }
            if ($request->pertemuan_ke) {
                $query->where('pertemuan_ke', $request->pertemuan_ke);
            }

            $data['journals'] = $query->orderBy('tanggal', 'desc')->paginate($perPage);
            $data['bimbels'] = BimbelModel::where('status', 'active')->get();
            $data['per_page'] = $perPage;

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'data' => $data['journals'],
                    'bimbels' => $data['bimbels'],
                    'pagination' => [
                        'current_page' => $data['journals']->currentPage(),
                        'last_page' => $data['journals']->lastPage(),
                        'per_page' => $perPage,
                        'total' => $data['journals']->total()
                    ]
                ]);
            }

            return view('users.journal', $data);
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memuat data: ' . $e->getMessage()
                ], 500);
            }
            return back()->with('error', 'Gagal memuat data: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            // Check permission untuk Add Journal
            $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Add Journal');
            if(empty($PermissionRole)){
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            // Validasi input
            $validated = $request->validate([
                'bimbel_id' => 'required|exists:bimbel,id',
                'tanggal' => 'required|date',
                'nama_guru' => 'required|string|max:255',
                'pelajaran' => 'required|string|max:255',
                'pembahasan' => 'required|string',
                'pertemuan_ke' => 'required|integer|min:1',
                'periode_ke' => 'required|integer|min:1'

            ]);

            // Tambahkan created_by ke data yang divalidasi
            $validated['created_by'] = Auth::user()->name;

            // Membuat record baru
            $journal = JournalModel::create($validated);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Journal berhasil ditambahkan',
                    'data' => $journal
                ]);
            }

            return redirect()->route('journal.index')
                ->with('success', 'Journal berhasil ditambahkan');

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menambahkan journal: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan journal: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Check permission untuk Edit Journal
            $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Journal');
            if(empty($PermissionRole)){
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized'
                ], 403);
            }

            $journal = JournalModel::findOrFail($id);

            // Update data
            $journal->tanggal = $request->tanggal;
            $journal->nama_guru = $request->nama_guru;
            $journal->bimbel_id = $request->bimbel_id;
            $journal->pelajaran = $request->pelajaran;
            $journal->pembahasan = $request->pembahasan;
            $journal->pertemuan_ke = $request->pertemuan_ke;
            $journal->periode_ke = $request->periode_ke;
            $journal->save();

            return response()->json([
                'success' => true,
                'message' => 'Journal berhasil diupdate'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate journal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            // Check permission untuk Delete Journal
            $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Delete Journal');
            if(empty($PermissionRole)){
                return response()->json(['message' => 'Unauthorized'], 403);
            }

            $journal = JournalModel::findOrFail($id);
            $journal->delete();

            return response()->json([
                'success' => true,
                'message' => 'Journal berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus journal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $journal = JournalModel::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $journal
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat data journal: ' . $e->getMessage()
            ], 500);
        }
    }
}