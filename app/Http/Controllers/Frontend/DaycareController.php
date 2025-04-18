<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DaycareContent;
use App\Models\Gallery;
use Illuminate\Http\Request;

class DaycareController extends Controller
{
    public function index()
    {
        $daycareData = $this->getDaycareData();
        return view('daycare', compact('daycareData'));
    }

    private function getDaycareData()
    {
        // Coba ambil data dari database terlebih dahulu
        $daycareContent = DaycareContent::first();

        if ($daycareContent) {
            return $daycareContent->toArray();
        }

        // Jika tidak ada data di database, coba ambil dari file JSON
        $defaultData = [
            'banner_type' => 'image',
            'banner_image' => 'images/daycare/banner.jpg',
            'banner_video' => '',
            'kelebihan_daycare' => 'Fokus pada pertumbuhan dan perkembangan anak secara holistik',
            'about_daycare_title' => 'Daycare Samoedra',
            'about_daycare_description' => 'Layanan penitipan anak berkualitas dengan pendekatan pendidikan yang holistik dan fokus pada perkembangan anak',
            'about_daycare_details' => [
                ['title' => 'Jam Operasional', 'content' => '07.00 - 17.00 WIB, Senin - Jumat'],
                ['title' => 'Usia Anak', 'content' => '1 - 5 tahun'],
                ['title' => 'Jumlah Anak per Kelas', 'content' => 'Maksimal 10 anak']
            ],
            'about_caregiver_title' => 'Pengasuh Berpengalaman',
            'about_caregiver_description' => 'Pengasuh kami memiliki latar belakang pendidikan dan pengalaman dalam pengasuhan anak usia dini',
            'program_description' => 'Program daycare kami dirancang untuk memberikan pengalaman belajar yang menyenangkan dan stimulatif bagi anak-anak',
            'program_image' => 'images/daycare/program.jpg',
            'program_points' => [
                ['title' => 'Stimulasi Perkembangan', 'content' => 'Fokus pada aspek kognitif, fisik, emosional, dan sosial'],
                ['title' => 'Belajar Sambil Bermain', 'content' => 'Aktivitas pembelajaran yang menyenangkan dan melibatkan anak secara aktif'],
                ['title' => 'Pendidikan Karakter', 'content' => 'Menumbuhkan nilai-nilai positif dan keterampilan sosial']
            ],
            'facilities' => [
                ['name' => 'Ruang Bermain', 'description' => 'Area bermain yang aman dan nyaman'],
                ['name' => 'Ruang Tidur', 'description' => 'Tempat istirahat yang tenang dan bersih'],
                ['name' => 'Ruang Makan', 'description' => 'Area makan dengan menu sehat dan bergizi'],
                ['name' => 'Taman Outdoor', 'description' => 'Area bermain luar ruangan yang aman']
            ],
            'pricelist' => [
                ['plan' => 'Harian', 'price' => 'Rp 150.000', 'features' => ['Penitipan 8 jam', 'Makan 2x', 'Snack 1x']],
                ['plan' => 'Mingguan', 'price' => 'Rp 700.000', 'features' => ['Penitipan 8 jam/hari', 'Makan 2x/hari', 'Snack 2x/hari']],
                ['plan' => 'Bulanan', 'price' => 'Rp 2.500.000', 'features' => ['Penitipan 8 jam/hari', 'Makan 2x/hari', 'Snack 2x/hari', 'Kegiatan edukatif']]
            ],
            'activities' => [
                ['time' => '07.00 - 08.00', 'activity' => 'Kedatangan & Sarapan'],
                ['time' => '08.00 - 09.30', 'activity' => 'Kegiatan Edukatif Pagi'],
                ['time' => '09.30 - 10.00', 'activity' => 'Snack Pagi'],
                ['time' => '10.00 - 11.30', 'activity' => 'Bermain & Aktivitas Fisik'],
                ['time' => '11.30 - 12.30', 'activity' => 'Makan Siang'],
                ['time' => '12.30 - 14.30', 'activity' => 'Tidur Siang'],
                ['time' => '14.30 - 15.00', 'activity' => 'Snack Sore'],
                ['time' => '15.00 - 16.30', 'activity' => 'Kegiatan Edukatif Sore'],
                ['time' => '16.30 - 17.00', 'activity' => 'Persiapan Pulang']
            ]
        ];

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
        $galleries = Gallery::latest()->get();

        // Debugging
        if (!isset($daycareData)) {
            dd('$daycareData is not set in daycare method');
        }

        return view('program.daycare', compact('daycareData', 'galleries'));
    }
}
