<?php

namespace App\Http\Controllers;

use App\Models\HomeContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;

class HomeContentController extends Controller
{
    public function index()
    {
        $PermissionHomeContent = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Home Content');
        if(empty($PermissionHomeContent)) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman Home Content');
        }

        $content = HomeContent::firstOrCreate(
            ['id' => 1],
            [
                'description' => 'Selamat datang website Rumah Samoedra. Kami menyediakan berbagai layanan terbaik untuk anak-anak Anda.',
                'phone_number' => '+62 896 111 111 53',
                'phone_link' => 'https://api.whatsapp.com/send/?phone=6289611111153&text&type=phone_number&app_absent=00',
                'image' => 'home-content/default.png'
            ]
        );

        // Debug info
        Log::info('HomeContent Data:', [
            'id' => $content->id,
            'image' => $content->image,
            'full_path' => storage_path('app/public/' . $content->image),
            'exists' => Storage::exists('public/' . $content->image),
            'url' => asset('storage/' . $content->image)
        ]);

        return view('users.home-content.index', compact('content'));
    }

    public function edit()
    {
        $PermissionHomeContent = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Home Content');
        if(empty($PermissionHomeContent)) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman Home Content');
        }

        $content = HomeContent::firstOrCreate(
            ['id' => 1],
            [
                'description' => 'Selamat datang website Rumah Samoedra. Kami menyediakan berbagai layanan terbaik untuk anak-anak Anda.',
                'phone_number' => '+62 896 111 111 53',
                'phone_link' => 'https://api.whatsapp.com/send/?phone=6289611111153&text&type=phone_number&app_absent=00',
                'image' => 'home-content/default.png'
            ]
        );

        return view('users.home-content.edit', compact('content'));
    }

    public function update(Request $request)
    {
        $PermissionHomeContent = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Home Content');
        if(empty($PermissionHomeContent)) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman Home Content');
        }

        $request->validate([
            'description' => 'required|string',
            'phone_number' => 'required|string',
            'phone_link' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $content = HomeContent::firstOrCreate(['id' => 1]);

            // Update data teks
            $content->description = $request->description;
            $content->phone_number = $request->phone_number;
            $content->phone_link = $request->phone_link;

            // Handle upload gambar
            if ($request->hasFile('image')) {
                // Hapus gambar lama jika ada
                if ($content->image && Storage::exists('public/' . $content->image)) {
                    Storage::delete('public/' . $content->image);
                }

                // Simpan gambar baru
                $imagePath = $request->file('image')->store('home-content', 'public');
                $content->image = $imagePath;

                // Debug info
                Log::info('New image uploaded:', [
                    'path' => $imagePath,
                    'full_path' => storage_path('app/public/' . $imagePath),
                    'exists' => Storage::exists('public/' . $imagePath),
                    'url' => asset('storage/' . $imagePath)
                ]);
            }

            $content->save();

            return redirect()->route('home-content.index')
                ->with('success', 'Konten berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Error updating home content: ' . $e->getMessage());
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan: ' . $e->getMessage())
                ->withInput();
        }
    }
}
