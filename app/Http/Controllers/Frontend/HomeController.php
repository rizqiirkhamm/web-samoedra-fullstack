<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BermainModel;
use App\Models\BimbelModel;
use App\Models\DaycareRegistrationModel;
use App\Models\EventModel;
use App\Models\EventRegistrationModel;
use App\Models\Faq;
use App\Models\Statistik;
use App\Models\StimulasiModel;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{

    public function index()
    {
        $testimonis = Testimoni::where('status', 'active')
            ->orderBy('urutan', 'asc')
            ->get();

        $faqs = Faq::where('status', 'active')
            ->orderBy('urutan', 'asc')
            ->take(4)
            ->get();

        $statistik = Statistik::where('status', 'active')->first();

        // Jika belum ada data statistik, buat data default
        if (!$statistik) {
            $statistik = Statistik::create([
                'daycare' => 0,
                'daycare_description' => 'Deskripsi daycare belum tersedia',
                'bermain' => 0,
                'bermain_description' => 'Deskripsi bermain belum tersedia',
                'bimbel' => 0,
                'bimbel_description' => 'Deskripsi bimbel belum tersedia',
                'stimulasi' => 0,
                'stimulasi_description' => 'Deskripsi stimulasi belum tersedia',
                'event' => 0,
                'event_description' => 'Deskripsi event belum tersedia',
                'status' => 'active'
            ]);
        }

        // Ambil data home content
        $homeContent = \App\Models\HomeContent::first();

        // Ambil data program dari file JSON
        $daycareData = $this->getDaycareData();
        $bermainData = $this->getBermainData();
        $bimbelData = $this->getBimbelData();
        $stimulasiData = $this->getStimulasiData();
        $eventData = $this->getEventData();

        return view('home', [
            'total_daycare' => $statistik->daycare,
            'total_bermain' => $statistik->bermain,
            'total_bimbel' => $statistik->bimbel,
            'total_stimulasi' => $statistik->stimulasi,
            'total_event' => $statistik->event,
            'testimonis' => $testimonis,
            'faqs' => $faqs,
            'statistik' => $statistik,
            'homeContent' => $homeContent,
            'daycareData' => $daycareData,
            'bermainData' => $bermainData,
            'bimbelData' => $bimbelData,
            'stimulasiData' => $stimulasiData,
            'eventData' => $eventData
        ]);
    }

    private function getDaycareData()
    {
        $defaultData = [
            'banner_type' => 'image',
            'banner_image' => 'images/assets/img1.png',
            'about_daycare' => [
                'details' => [
                    'jam_operasional' => '08.00 - 15.00',
                    'hari' => 'Senin - Jumat',
                ]
            ],
            'kelebihan_daycare' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Alias facere dolorem nesciunt ratione assumenda natus vitae nemo, dolores voluptatibus ipsum, numquam modi totam unde quas quaerat, rerum quasi voluptates deleniti.'
        ];

        $jsonPath = storage_path('app/public/daycare/data.json');
        if (file_exists($jsonPath)) {
            $jsonData = json_decode(file_get_contents($jsonPath), true);
            if ($jsonData) {
                return $jsonData;
            }
        }

        return $defaultData;
    }

    private function getBermainData()
    {
        $defaultData = [
            'banner_type' => 'image',
            'banner_image' => 'images/assets/img_layanan.png',
            'operating_hours' => '08.00 - 15.00',
            'operating_days' => 'Senin - Jumat',
            'benefit_description' => 'Area bermain yang luas dan aman untuk anak-anak, dilengkapi dengan berbagai permainan edukatif yang dapat merangsang perkembangan motorik dan kognitif anak.'
        ];

        $jsonPath = storage_path('app/public/bermain/data.json');
        if (file_exists($jsonPath)) {
            $jsonData = json_decode(file_get_contents($jsonPath), true);
            if ($jsonData) {
                return array_merge($defaultData, $jsonData);
            }
        }

        return $defaultData;
    }

    private function getBimbelData()
    {
        $defaultData = [
            'banner_type' => 'image',
            'banner_image' => 'images/assets/img1.png',
            'operating_hours' => '08.00 - 15.00',
            'operating_days' => 'Senin - Jumat',
            'benefit_description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Alias facere dolorem nesciunt ratione assumenda natus vitae nemo, dolores voluptatibus ipsum, numquam modi totam unde quas quaerat, rerum quasi voluptates deleniti.'
        ];

        $jsonPath = storage_path('app/public/bimbel/data.json');
        if (file_exists($jsonPath)) {
            $jsonData = json_decode(file_get_contents($jsonPath), true);
            if ($jsonData) {
                return $jsonData;
            }
        }

        return $defaultData;
    }

    private function getStimulasiData()
    {
        $defaultData = [
            'banner_type' => 'image',
            'banner_image' => 'images/assets/img1.png',
            'hours' => '08.00 - 15.00',
            'days' => 'Senin - Jumat',
            'description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Alias facere dolorem nesciunt ratione assumenda natus vitae nemo, dolores voluptatibus ipsum, numquam modi totam unde quas quaerat, rerum quasi voluptates deleniti.'
        ];

        $jsonPath = storage_path('app/public/stimulasi/data.json');
        if (file_exists($jsonPath)) {
            $jsonData = json_decode(file_get_contents($jsonPath), true);
            if ($jsonData) {
                return $jsonData;
            }
        }

        return $defaultData;
    }

    private function getEventData()
    {
        $defaultData = [
            'banner_type' => 'image',
            'banner_image' => 'images/assets/img_layanan.png',
            'operating_hours' => '08.00 - 15.00',
            'operating_days' => 'Senin - Jumat',
            'description' => 'Berbagai event menarik seperti playdate, ulang tahun, dan outing class yang dapat memberikan pengalaman bermain dan belajar yang menyenangkan untuk anak-anak.',
            'events' => [],
            'collaboration' => []
        ];

        $jsonPath = storage_path('app/public/event/data.json');
        if (file_exists($jsonPath)) {
            $jsonData = json_decode(file_get_contents($jsonPath), true);
            if ($jsonData) {
                // Jika ada event, ambil event terbaru
                if (isset($jsonData['events']) && count($jsonData['events']) > 0) {
                    $latestEvent = $jsonData['events'][0];
                    return array_merge($defaultData, [
                        'banner_type' => $latestEvent['banner_type'] ?? 'image',
                        'banner_image' => $latestEvent['banner_image'] ?? $defaultData['banner_image'],
                        'description' => $latestEvent['descriptions'][0]['content'] ?? $defaultData['description'],
                        'events' => $jsonData['events'],
                        'collaboration' => $jsonData['collaboration'] ?? []
                    ]);
                }
                return array_merge($defaultData, $jsonData);
            }
        }

        return $defaultData;
    }
}
