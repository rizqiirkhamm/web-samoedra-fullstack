<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;

class TestimoniController extends Controller
{
    public function index()
    {
        $PermissionTestimoni = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Testimoni');
        if(empty($PermissionTestimoni)) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman Testimoni');
        }

        $testimonis = Testimoni::where('status', 'active')
            ->orderBy('urutan', 'asc')
            ->get();
        return view('users.testimoni.index', compact('testimonis'));
    }

    public function create()
    {
        $PermissionTestimoni = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Testimoni');
        if(empty($PermissionTestimoni)) {
            return redirect()->route('testimoni.index')->with('error', 'Anda tidak memiliki akses untuk menambah Testimoni');
        }

        return view('users.testimoni.create');
    }

    public function store(Request $request)
    {
        $PermissionTestimoni = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Testimoni');
        if(empty($PermissionTestimoni)) {
            return redirect()->route('testimoni.index')->with('error', 'Anda tidak memiliki akses untuk menambah Testimoni');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'testimoni' => 'required|string',
            'urutan' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nama_foto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('images/testimoni'), $nama_foto);
            $data['foto'] = 'images/testimoni/' . $nama_foto;
        }

        Testimoni::create($data);

        return redirect()->route('testimoni.index')
            ->with('success', 'Testimoni berhasil ditambahkan');
    }

    public function edit(Testimoni $testimoni)
    {
        $PermissionTestimoni = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Testimoni');
        if(empty($PermissionTestimoni)) {
            return redirect()->route('testimoni.index')->with('error', 'Anda tidak memiliki akses untuk mengedit Testimoni');
        }

        return view('users.testimoni.edit', compact('testimoni'));
    }

    public function update(Request $request, Testimoni $testimoni)
    {
        $PermissionTestimoni = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Testimoni');
        if(empty($PermissionTestimoni)) {
            return redirect()->route('testimoni.index')->with('error', 'Anda tidak memiliki akses untuk mengedit Testimoni');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'testimoni' => 'required|string',
            'urutan' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($testimoni->foto && file_exists(public_path($testimoni->foto))) {
                unlink(public_path($testimoni->foto));
            }

            $foto = $request->file('foto');
            $nama_foto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('images/testimoni'), $nama_foto);
            $data['foto'] = 'images/testimoni/' . $nama_foto;
        }

        $testimoni->update($data);

        return redirect()->route('testimoni.index')
            ->with('success', 'Testimoni berhasil diperbarui');
    }

    public function destroy(Testimoni $testimoni)
    {
        $PermissionTestimoni = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Testimoni');
        if(empty($PermissionTestimoni)) {
            return redirect()->route('testimoni.index')->with('error', 'Anda tidak memiliki akses untuk menghapus Testimoni');
        }

        if ($testimoni->foto && file_exists(public_path($testimoni->foto))) {
            unlink(public_path($testimoni->foto));
        }

        $testimoni->delete();

        return redirect()->route('testimoni.index')
            ->with('success', 'Testimoni berhasil dihapus');
    }
}
