<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BermainController extends Controller
{
    public function index()
    {
        $bermain = $this->getBermainData();
        return view('program.bermain', compact('bermain'));
    }

    private function getBermainData()
    {
        $jsonPath = storage_path('app/public/bermain/data.json');

        if (file_exists($jsonPath)) {
            $data = json_decode(file_get_contents($jsonPath), true);
        } else {
            // Default data jika file belum ada
            $data = [
                'banner_type' => 'image',
                'banner_image' => 'images/assets/img.png',
                'banner_video' => '',
                'benefit_title' => 'Kelebihan Area Bermain Kami',
                'benefit_description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus itaque rem quae alias facere ipsum in maiores cupiditate modi, magnam qui natus beatae nam aut voluptate, neque quibusdam reiciendis aliquid atque. Necessitatibus praesentium maiores, modi ratione nostrum vel odit recusandae!',
                'info_title' => 'About Area Bermain',
                'age_range' => '6 bln - 12 y.o',
                'operating_hours' => '9:00 - 17:00',
                'operating_days' => 'Senin-Sabtu',
                'cost' => "15k perJam\n45k sepuasnya\n(max 6jam)",
                'facility_title' => 'Area Bermain',
                'facilities' => [
                    [
                        'name' => 'Full AC',
                        'image' => 'images/assets/img_layanan.png'
                    ],
                    [
                        'name' => 'Purifier',
                        'image' => 'images/assets/img_layanan.png'
                    ],
                    [
                        'name' => 'Area Bermain Indoor',
                        'image' => 'images/assets/img_layanan.png'
                    ],
                    [
                        'name' => 'Baby Bed',
                        'image' => 'images/assets/img_layanan.png'
                    ],
                    [
                        'name' => 'Outdor Area',
                        'image' => 'images/assets/img_layanan.png'
                    ]
                ]
            ];
        }

        return $data;
    }
}
