<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class BimbelController extends Controller
{
    public function index()
    {
        $jsonPath = storage_path('app/public/bimbel/data.json');
        $bimbel = [];

        if (file_exists($jsonPath)) {
            $bimbel = json_decode(file_get_contents($jsonPath), true);

            // Pastikan semua path gambar memiliki prefix yang benar
            if (isset($bimbel['banner_image']) && !str_starts_with($bimbel['banner_image'], 'storage/')) {
                $bimbel['banner_image'] = str_replace('images/', 'storage/images/', $bimbel['banner_image']);
            }

            if (isset($bimbel['program_image']) && !str_starts_with($bimbel['program_image'], 'storage/')) {
                $bimbel['program_image'] = str_replace('images/', 'storage/images/', $bimbel['program_image']);
            }

            if (isset($bimbel['facilities'])) {
                foreach ($bimbel['facilities'] as &$facility) {
                    if (isset($facility['image']) && !str_starts_with($facility['image'], 'storage/')) {
                        $facility['image'] = str_replace('images/', 'storage/images/', $facility['image']);
                    }
                }
            }
        } else {
            // Set default data jika file JSON tidak ditemukan
            $bimbel = [
                'banner_type' => 'image',
                'banner_image' => 'storage/images/assets/img.png',
                'banner_video' => '',
                'benefit_title' => 'Kelebihan Bimbel Kami',
                'benefit_description' => 'Belum ada deskripsi',
                'program_title' => 'Program Bimbel Rumah Samoedra',
                'program_description' => 'Belum ada deskripsi program',
                'program_image' => 'storage/images/assets/img_detail_layanan.png',
                'facilities' => [
                    [
                        'title' => 'Fasilitas 1',
                        'description' => 'Deskripsi fasilitas 1',
                        'image' => 'storage/images/assets/img_layanan.png'
                    ]
                ]
            ];
        }

        // Ambil data galeri khusus kategori Bimbel
        $galleries = Gallery::where('category', 'Bimbel')->get();

        return view('program.bimbel', compact('bimbel', 'galleries'));
    }
}
