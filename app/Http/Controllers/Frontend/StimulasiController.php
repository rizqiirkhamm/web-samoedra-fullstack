<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StimulasiController extends Controller
{
    public function index()
    {
        $stimulasiData = $this->getStimulasiData();
        $galleries = Gallery::where('category', 'Kelas Stimulasi')->latest()->get();

        return view('program.stimulasi', compact('stimulasiData', 'galleries'));
    }

    public function getStimulasiData()
    {
        // Default data jika tidak ada file JSON
        $defaultData = [
            'title' => 'Kelas Stimulasi Little Explorer',
            'banner_type' => 'image',
            'banner_image' => 'images/stimulasi/banner.png',
            'banner_video' => '',
            'description' => 'Apa itu Kelas Stimulasi',
            'program_title' => 'Kelas Stimulasi Di Rumah Samoedra',
            'program_description' => 'Kelas Stimulasi Rumah Samoedra dirancang untuk mendukung tumbuh kembang anak melalui aktivitas bermain yang menyenangkan dan penuh makna. Kami percaya setiap anak itu unik, dan melalui kelas ini, mereka diajak belajar, bermain, dan tumbuh bersama dalam lingkungan yang aman dan penuh kasih. Yuk, kenalkan si kecil pada dunia belajar yang seru dan interaktif bersama Rumah Samoedra!',
            'program_image' => 'images/stimulasi/program.png',
            'kegiatan_title' => 'Kegiatan Kelas Stimulasi Rumah Samoedra',
            'kegiatan' => [
                [
                    'name' => 'ADAPTASI SOSIAL',
                    'description' => "Diskusi tentang pengalaman bulan Puasa & Lebaran\n⁠Praktik Bersalaman dan Bermaaf maafan\n⁠Berkenalan dengan teman baru\nMenjawab pertanyaan sederhana"
                ],
                [
                    'name' => 'LOGIKA MATEMATIKA',
                    'description' => "⁠Meniru bentuk sebuah pola menggunakan stick\nBelajar mengenal waktu Tahun, Bulan, Minggu, Hari, Jam menggunakan kalender dan jam dinding"
                ],
                [
                    'name' => 'FISIK MOTORIK',
                    'description' => "Melewati rintangan sensory path\nBermain lompat karet"
                ],
                [
                    'name' => 'KREATIFITAS',
                    'description' => "⁠Melengkapi setengah gambar dengan cara meniru gambar di sebelahnya"
                ],
                [
                    'name' => 'FOKUS & KESEIMBANGAN',
                    'description' => "menggulung tali dan melepaskan jepitan\nmenarik bola dalam lingkaran & melemparnya"
                ]
            ],
            'fasilitas' => [
                [
                    'name' => 'Full AC',
                    'image' => 'images/stimulasi/fasilitas/full-ac.png'
                ],
                [
                    'name' => 'Purifier',
                    'image' => 'images/stimulasi/fasilitas/purifier.png'
                ],
                [
                    'name' => 'Area Bermain Indoor',
                    'image' => 'images/stimulasi/fasilitas/area-bermain.png'
                ]
            ],
            'age_range' => '6 bln - 12 y.o',
            'hours' => '9.00-17.00',
            'days' => 'Senin-Sabtu',
            'price' => 'Rp. 375.000',
            'meetings' => '4x Pertemuan',
            'registration_fee' => 'Rp. 50.000',
            'pricelist_items' => [
                [
                    'title' => 'Kelas Stimulasi Reguler',
                    'age_range' => '3 - 6 tahun',
                    'registration_fee' => 'Rp. 50.000',
                    'price' => 'Rp. 375.000',
                    'meetings' => '4x Pertemuan'
                ],
                [
                    'title' => 'Kelas Stimulasi Toddler',
                    'age_range' => '1 - 3 tahun',
                    'registration_fee' => 'Rp. 50.000',
                    'price' => 'Rp. 350.000',
                    'meetings' => '4x Pertemuan'
                ]
            ],
            'program' => [
                'points' => [
                    'Pembelajaran melalui bermain',
                    'Fokus pada perkembangan motorik',
                    'Peningkatan kemampuan sosial',
                    'Aktivitas kreatif dan eksplorasi',
                    'Lingkungan yang aman dan menyenangkan'
                ]
            ]
        ];

        // Cek apakah ada file JSON
        $jsonPath = storage_path('app/public/stimulasi/data.json');
        if (file_exists($jsonPath)) {
            $jsonData = json_decode(file_get_contents($jsonPath), true);
            return array_merge($defaultData, $jsonData);
        }

        return $defaultData;
    }
}
