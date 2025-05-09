<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DaycareController extends Controller
{
    public function index()
    {
        $daycareData = $this->getDaycareData();
        $galleries = Gallery::where('category', 'Daycare')->latest()->get();

        return view('program.daycare', compact('daycareData', 'galleries'));
    }

    public function getDaycareData()
    {
        // Default data jika tidak ada file JSON
        $defaultData = [
            'banner_type' => 'image',
            'banner_image' => 'storage/daycare/img.png',
            'banner_video' => '',
            'kelebihan_daycare' => 'Fokus pada pertumbuhan dan perkembangan anak secara holistik',
            'about_daycare' => [
                'title' => 'Daycare Samoedra',
                'description' => 'Layanan penitipan anak berkualitas dengan pendekatan pendidikan yang holistik dan fokus pada perkembangan anak',
                'details' => [
                    'usia' => '6 bulan - 12 tahun',
                    'jam_operasional' => '07.00 - 17.00 WIB, Senin - Sabtu',
                    'rasio' => '1:2 (anak:pengasuh) untuk usia 0-1 tahun, 1:4 untuk usia 1-3 tahun, 1:8 untuk usia 3+ tahun',
                    'makanan' => 'Menu sehat dan bergizi, disesuaikan dengan usia anak'
                ]
            ],
            'about_caregiver' => [
                'title' => 'Pengasuh Berpengalaman',
                'description' => 'Pengasuh kami memiliki latar belakang pendidikan dan pengalaman dalam pengasuhan anak usia dini'
            ],
            'program' => [
                'description' => 'Program daycare kami dirancang untuk memberikan pengalaman belajar yang menyenangkan dan stimulatif bagi anak-anak',
                'image' => 'storage/daycare/img.png',
                'points' => [
                    'Daily Activity',
                    'Pengecekan Tumbuh Kembang Rutin',
                    'Daily Report',
                    'Stimulasi Sesuai Usia',
                    'Outdoor Activity',
                    'Art and Craft'
                ]
            ],
            'facilities' => [
                [
                    'title' => 'Full AC',
                    'description' => 'Ruangan ber-AC untuk kenyamanan anak',
                    'image' => 'storage/daycare/facility-ac.jpg'
                ],
                [
                    'title' => 'Purifier',
                    'description' => 'Air purifier untuk udara yang bersih dan sehat',
                    'image' => 'storage/daycare/facility-purifier.jpg'
                ],
                [
                    'title' => '3 Kamar',
                    'description' => 'Kamar terpisah untuk berbagai kegiatan dan usia',
                    'image' => 'storage/daycare/facility-rooms.jpg'
                ],
                [
                    'title' => 'Baby Bed',
                    'description' => 'Tempat tidur khusus bayi yang nyaman dan aman',
                    'image' => 'storage/daycare/facility-bed.jpg'
                ],
                [
                    'title' => 'Outdoor Area',
                    'description' => 'Area bermain luar ruangan yang aman',
                    'image' => 'storage/daycare/facility-outdoor.jpg'
                ]
            ],
            'pricelist' => [
                [
                    'title' => 'Daycare Harian',
                    'price' => 'Rp 110.000',
                    'description' => 'Untuk usia 6 bulan - 12 tahun'
                ],
                [
                    'title' => 'Daycare Bulanan',
                    'price' => 'Rp 1.300.000',
                    'description' => 'Harga promo pendaftaran Rp 100.000'
                ]
            ],
            'activities' => [
                [
                    'title' => 'Kedatangan',
                    'time' => '07.00 - 07.30',
                    'description' => 'Penyambutan anak-anak yang datang'
                ],
                [
                    'title' => 'Sarapan',
                    'time' => '07.30 - 08.00',
                    'description' => 'Sarapan bersama'
                ],
                [
                    'title' => 'Kegiatan Pagi',
                    'time' => '08.00 - 09.30',
                    'description' => 'Aktivitas edukasi pagi'
                ],
                [
                    'title' => 'Snack Time',
                    'time' => '09.30 - 10.00',
                    'description' => 'Makanan ringan dan istirahat'
                ],
                [
                    'title' => 'Outdoor Play',
                    'time' => '10.00 - 11.30',
                    'description' => 'Bermain di luar ruangan'
                ],
                [
                    'title' => 'Makan Siang',
                    'time' => '11.30 - 12.30',
                    'description' => 'Makan siang bersama'
                ],
                [
                    'title' => 'Tidur Siang',
                    'time' => '12.30 - 14.30',
                    'description' => 'Waktu istirahat/tidur siang'
                ],
                [
                    'title' => 'Snack Sore',
                    'time' => '14.30 - 15.00',
                    'description' => 'Makanan ringan sore'
                ],
                [
                    'title' => 'Kegiatan Sore',
                    'time' => '15.00 - 16.30',
                    'description' => 'Aktivitas edukasi sore'
                ],
                [
                    'title' => 'Persiapan Pulang',
                    'time' => '16.30 - 17.00',
                    'description' => 'Persiapan untuk dijemput'
                ]
            ]
        ];

        // Cek apakah ada file JSON
        $jsonPath = storage_path('app/public/daycare/data.json');
        if (file_exists($jsonPath)) {
            $jsonData = json_decode(file_get_contents($jsonPath), true);
            return array_merge($defaultData, $jsonData);
        }

        return $defaultData;
    }

    public function daycare()
    {
        $daycareData = $this->getDaycareData();

        // First try exact match on 'Daycare' category
        $galleries = Gallery::where('category', 'Daycare')->latest()->get();

        // Debug info about the first query
        info('Initial query for Daycare category: ' . $galleries->count() . ' results');

        // If no results found, try with case-insensitive search
        if ($galleries->isEmpty()) {
            $galleries = Gallery::whereRaw('LOWER(category) = ?', [strtolower('Daycare')])->latest()->get();
            info('Case-insensitive query for daycare: ' . $galleries->count() . ' results');
        }

        // If still no results, try partial matching
        if ($galleries->isEmpty()) {
            $galleries = Gallery::where('category', 'like', '%daycare%')->latest()->get();
            info('Partial match query for daycare: ' . $galleries->count() . ' results');
        }

        // Last resort - get any galleries (limited to 6)
        if ($galleries->isEmpty()) {
            $galleries = Gallery::latest()->limit(6)->get();
            info('Last resort - fetching any galleries: ' . $galleries->count() . ' results');
        }

        // Debug info for troubleshooting
        if ($galleries->isEmpty()) {
            $allGalleries = Gallery::select('id', 'title', 'category')->get()->toArray();
            $categories = Gallery::select('category')->distinct()->get()->pluck('category')->toArray();

            // Log debugging information
            info('No galleries found at all. Available categories: ' . implode(', ', $categories));
            info('All galleries: ' . json_encode($allGalleries));

            // Create dummy galleries for testing
            $dummyGalleries = collect();
            info('Created dummy galleries collection for testing');
        } else {
            info('Final gallery count: ' . $galleries->count());
        }

        return view('program.daycare', compact('daycareData', 'galleries'));
    }
}
