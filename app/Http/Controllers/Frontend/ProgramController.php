<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\DaycareController;
use App\Http\Controllers\Frontend\StimulasiController;

class ProgramController extends Controller
{
    public function index()
    {
        $daycareData = $this->getDaycareData();
        $stimulasiData = $this->getStimulasiData();
        $bermain = $this->getBermainData();
        $bimbelData = $this->getBimbelData();
        $data = $this->getEventData();

        return view('program', compact('daycareData', 'stimulasiData', 'bermain', 'bimbelData', 'data'));
    }

    public function getDaycareData()
    {
        $data = [
            'banner_type' => 'image',
            'banner_image' => 'images/assets/img1.png',
            'about_daycare' => [
                'title' => 'About Daycare',
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
                $data = $jsonData;
            }
        }

        return $data;
    }

    public function getStimulasiData()
    {
        $data = [
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
                $data = $jsonData;
            }
        }

        return $data;
    }

    public function getBermainData()
    {
        $data = [
            'banner_type' => 'image',
            'banner_image' => 'images/assets/img1.png',
            'operating_hours' => '08.00 - 15.00',
            'operating_days' => 'Senin - Jumat',
            'benefit_description' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Alias facere dolorem nesciunt ratione assumenda natus vitae nemo, dolores voluptatibus ipsum, numquam modi totam unde quas quaerat, rerum quasi voluptates deleniti.'
        ];

        $jsonPath = storage_path('app/public/bermain/data.json');
        if (file_exists($jsonPath)) {
            $jsonData = json_decode(file_get_contents($jsonPath), true);
            if ($jsonData) {
                $data = $jsonData;
            }
        }

        return $data;
    }

    public function getBimbelData()
    {
        $data = [
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
                $data = $jsonData;
            }
        }

        return $data;
    }

    public function getEventData()
    {
        $data = ['events' => [], 'collaboration' => []];
        $jsonPath = storage_path('app/public/event/data.json');

        if (file_exists($jsonPath)) {
            $jsonData = json_decode(file_get_contents($jsonPath), true);
            if (isset($jsonData['events']) && is_array($jsonData['events'])) {
                $data = $jsonData;
            }
        }

        return $data;
    }
}
