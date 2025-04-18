<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;

class TentangController extends Controller
{
    public function edit()
    {
        // Check permission untuk edit tentang
        $permissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Content');
        if (empty($permissionRole)) {
            abort(404);
        }

        // Mendapatkan data tentang page yang sedang aktif
        $data = [
            'pageTitle' => 'Edit Halaman Tentang',
        ];

        return view('users.tentang-edit', $data);
    }

    public function update(Request $request)
    {
        // Check permission untuk edit tentang
        $permissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Content');
        if (empty($permissionRole)) {
            abort(404);
        }

        $request->validate([
            'sambutan_lembaga' => 'required|string',
            'tempat_bermain' => 'required|string',
            'konsep_pendidikan' => 'required|string',
            'filosofi' => 'required|string',
            'sejarah' => 'required|string',
            'image_sambutan' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Simpan data ke file JSON di storage
        $tentangData = [
            'sambutan_lembaga' => $request->sambutan_lembaga,
            'tempat_bermain' => $request->tempat_bermain,
            'konsep_pendidikan' => $request->konsep_pendidikan,
            'filosofi' => $request->filosofi,
            'sejarah' => $request->sejarah,
        ];

        // Proses gambar jika ada upload
        if ($request->hasFile('image_sambutan')) {
            // Hapus gambar lama jika ada
            $oldData = $this->getTentangData();
            if (isset($oldData['image_sambutan']) && Storage::disk('public')->exists($oldData['image_sambutan'])) {
                Storage::disk('public')->delete($oldData['image_sambutan']);
            }

            // Upload gambar baru
            $imagePath = $request->file('image_sambutan')->store('tentang', 'public');
            $tentangData['image_sambutan'] = $imagePath;
        } else {
            // Pertahankan gambar lama
            $oldData = $this->getTentangData();
            if (isset($oldData['image_sambutan'])) {
                $tentangData['image_sambutan'] = $oldData['image_sambutan'];
            }
        }

        // Simpan data ke storage
        Storage::disk('public')->put('tentang/data.json', json_encode($tentangData));

        return redirect()->route('tentang.edit')->with('success', 'Halaman Tentang berhasil diperbarui');
    }

    // Mendapatkan data tentang dari file JSON
    private function getTentangData()
    {
        $jsonPath = 'tentang/data.json';
        if (Storage::disk('public')->exists($jsonPath)) {
            $jsonData = Storage::disk('public')->get($jsonPath);
            return json_decode($jsonData, true);
        }
        return [];
    }

    public function updateOrganisasi(Request $request)
    {
        // Check permission untuk edit tentang
        $permissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Content');
        if (empty($permissionRole)) {
            abort(404);
        }

        // Struktur data organisasi
        $organisasiData = [
            'manajemen' => [],
            'guru' => []
        ];

        // Proses data manajemen
        if ($request->has('manajemen')) {
            foreach ($request->manajemen as $index => $manager) {
                $itemData = [
                    'id' => $manager['id'],
                    'nama' => $manager['nama'],
                    'jabatan' => $manager['jabatan'],
                    'dapat_dihapus' => $manager['dapat_dihapus'] === 'true'
                ];

                // Proses foto jika diupload
                if ($request->hasFile("manajemen.{$index}.foto")) {
                    // Hapus foto lama jika ada
                    $oldData = $this->getOrganisasiData();
                    $oldItem = collect($oldData['manajemen'] ?? [])->firstWhere('id', $manager['id']);

                    if ($oldItem && isset($oldItem['foto']) && Storage::disk('public')->exists($oldItem['foto'])) {
                        Storage::disk('public')->delete($oldItem['foto']);
                    }

                    // Upload foto baru
                    $fotoPath = $request->file("manajemen.{$index}.foto")->store('tentang/organisasi', 'public');
                    $itemData['foto'] = $fotoPath;
                } else {
                    // Pertahankan foto lama
                    $oldData = $this->getOrganisasiData();
                    $oldItem = collect($oldData['manajemen'] ?? [])->firstWhere('id', $manager['id']);

                    if ($oldItem && isset($oldItem['foto'])) {
                        $itemData['foto'] = $oldItem['foto'];
                    } else {
                        $itemData['foto'] = 'images/assets/img1.png';
                    }
                }

                $organisasiData['manajemen'][] = $itemData;
            }
        }

        // Proses data guru
        if ($request->has('guru')) {
            foreach ($request->guru as $index => $guru) {
                $itemData = [
                    'id' => $guru['id'],
                    'nama' => $guru['nama'],
                    'jabatan' => $guru['jabatan'],
                    'dapat_dihapus' => $guru['dapat_dihapus'] === 'true'
                ];

                // Proses foto jika diupload
                if ($request->hasFile("guru.{$index}.foto")) {
                    // Hapus foto lama jika ada
                    $oldData = $this->getOrganisasiData();
                    $oldItem = collect($oldData['guru'] ?? [])->firstWhere('id', $guru['id']);

                    if ($oldItem && isset($oldItem['foto']) && Storage::disk('public')->exists($oldItem['foto'])) {
                        Storage::disk('public')->delete($oldItem['foto']);
                    }

                    // Upload foto baru
                    $fotoPath = $request->file("guru.{$index}.foto")->store('tentang/organisasi', 'public');
                    $itemData['foto'] = $fotoPath;
                } else {
                    // Pertahankan foto lama
                    $oldData = $this->getOrganisasiData();
                    $oldItem = collect($oldData['guru'] ?? [])->firstWhere('id', $guru['id']);

                    if ($oldItem && isset($oldItem['foto'])) {
                        $itemData['foto'] = $oldItem['foto'];
                    } else {
                        $itemData['foto'] = 'images/assets/img1.png';
                    }
                }

                $organisasiData['guru'][] = $itemData;
            }
        }

        // Simpan data ke storage
        Storage::disk('public')->put('tentang/organisasi.json', json_encode($organisasiData));

        return redirect()->route('tentang.edit', ['#organisasi'])->with('success', 'Struktur organisasi berhasil diperbarui');
    }

    // Mendapatkan data organisasi dari file JSON
    private function getOrganisasiData()
    {
        $jsonPath = 'tentang/organisasi.json';
        if (Storage::disk('public')->exists($jsonPath)) {
            $jsonData = Storage::disk('public')->get($jsonPath);
            return json_decode($jsonData, true) ?? [];
        }

        // Data default jika tidak ada file JSON
        return [
            'manajemen' => [
                [
                    'id' => 'direktur',
                    'nama' => 'Mr Hakim',
                    'jabatan' => 'Direktur',
                    'foto' => 'images/assets/img1.png',
                    'dapat_dihapus' => false
                ],
                [
                    'id' => 'manager',
                    'nama' => 'Miss Rina',
                    'jabatan' => 'Manager Operasional',
                    'foto' => 'images/assets/img1.png',
                    'dapat_dihapus' => false
                ]
            ],
            'guru' => [
                [
                    'id' => 'guru1',
                    'nama' => 'Mr. Karim',
                    'jabatan' => 'Teachers',
                    'foto' => 'images/assets/img1.png',
                    'dapat_dihapus' => false
                ],
                [
                    'id' => 'guru2',
                    'nama' => 'Mr. Dimas',
                    'jabatan' => 'Teachers',
                    'foto' => 'images/assets/img1.png',
                    'dapat_dihapus' => false
                ],
                [
                    'id' => 'guru3',
                    'nama' => 'Mr. Andi',
                    'jabatan' => 'Teachers',
                    'foto' => 'images/assets/img1.png',
                    'dapat_dihapus' => false
                ],
                [
                    'id' => 'guru4',
                    'nama' => 'Miss Anna',
                    'jabatan' => 'Teachers',
                    'foto' => 'images/assets/img1.png',
                    'dapat_dihapus' => false
                ]
            ]
        ];
    }
}
