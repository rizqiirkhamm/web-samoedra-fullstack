<?php

namespace App\Http\Controllers;

use App\Models\Statistik;
use Illuminate\Http\Request;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;

class StatistikController extends Controller
{
    public function index()
    {
        $PermissionStatistik = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Statistik');
        if(empty($PermissionStatistik)) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman Statistik');
        }

        $statistik = Statistik::where('status', 'active')->first();

        // Jika belum ada data statistik, buat data default
        if (!$statistik) {
            $statistik = Statistik::create([
                'daycare' => 0,
                'daycare_title' => 'Anak Di Daycare',
                'daycare_description' => 'Deskripsi daycare belum tersedia',
                'bermain' => 0,
                'bermain_title' => 'Anak Bermain',
                'bermain_description' => 'Deskripsi bermain belum tersedia',
                'bimbel' => 0,
                'bimbel_title' => 'Peserta Bimbel',
                'bimbel_description' => 'Deskripsi bimbel belum tersedia',
                'stimulasi' => 0,
                'stimulasi_title' => 'Peserta Kelas Stimulasi',
                'stimulasi_description' => 'Deskripsi stimulasi belum tersedia',
                'event' => 0,
                'event_title' => 'Event',
                'event_description' => 'Deskripsi event belum tersedia',
                'status' => 'active'
            ]);
        }

        return view('users.statistik.index', compact('statistik'));
    }

    public function edit($kategori)
    {
        $PermissionStatistik = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Statistik');
        if(empty($PermissionStatistik)) {
            return redirect()->route('statistik.index')->with('error', 'Anda tidak memiliki akses untuk mengedit Statistik');
        }

        $statistik = Statistik::where('status', 'active')->firstOrFail();
        return view('users.statistik.edit', compact('statistik', 'kategori'));
    }

    public function update(Request $request, $kategori)
    {
        $PermissionStatistik = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Statistik');
        if(empty($PermissionStatistik)) {
            return redirect()->route('statistik.index')->with('error', 'Anda tidak memiliki akses untuk mengedit Statistik');
        }

        $statistik = Statistik::where('status', 'active')->firstOrFail();

        $request->validate([
            'judul' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'deskripsi' => 'required|string|max:1000'
        ]);

        $statistik->update([
            $kategori => $request->jumlah,
            $kategori . '_title' => $request->judul,
            $kategori . '_description' => $request->deskripsi
        ]);

        return redirect()->route('statistik.index')
            ->with('success', 'Statistik ' . ucfirst($kategori) . ' berhasil diperbarui');
    }
}
