<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DaycareEditController extends Controller
{
    public function index()
    {
        $daycareData = $this->getDaycareData();
        return view('users.daycare-edit', compact('daycareData'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'banner_type' => 'required|in:image,video',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_video' => 'nullable|string|max:255',
            'kelebihan_daycare' => 'required|string',
            'about_daycare_title' => 'required|string|max:255',
            'about_daycare_description' => 'required|string',
            'usia' => 'required|string|max:255',
            'jam_operasional' => 'required|string|max:255',
            'rasio' => 'required|string|max:255',
            'makanan' => 'required|string|max:255',
            'about_caregiver_title' => 'required|string|max:255',
            'about_caregiver_description' => 'required|string',
            'program_description' => 'required|string',
            'program_points' => 'required|array',
            'program_points.*' => 'required|string',
            'program_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facility_items' => 'required|array',
            'facility_items.*.title' => 'required|string|max:255',
            'facility_items.*.description' => 'required|string',
            'facility_items.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pricelist_items' => 'required|array',
            'pricelist_items.*.title' => 'required|string|max:255',
            'pricelist_items.*.price' => 'required|string|max:255',
            'pricelist_items.*.description' => 'required|string',
            'activity_items' => 'required|array',
            'activity_items.*.title' => 'required|string|max:255',
            'activity_items.*.time' => 'required|string|max:255',
            'activity_items.*.description' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $daycareData = $this->getDaycareData();

        // Update banner
        $daycareData['banner_type'] = $request->banner_type;
        if ($request->banner_type == 'image' && $request->hasFile('banner_image')) {
            // Delete old image if exists
            if (isset($daycareData['banner_image']) && file_exists(public_path($daycareData['banner_image']))) {
                unlink(public_path($daycareData['banner_image']));
            }

            // Ensure the directory exists
            $dirPath = public_path('images/daycare');
            if (!file_exists($dirPath)) {
                mkdir($dirPath, 0777, true);
            }

            $daycareData['banner_image'] = 'images/daycare/' . $request->file('banner_image')->getClientOriginalName();
            $request->file('banner_image')->move($dirPath, $request->file('banner_image')->getClientOriginalName());
            $daycareData['banner_video'] = null;
        } elseif ($request->banner_type == 'video') {
            $daycareData['banner_video'] = $request->banner_video;
            // Keep old image or set to null if changing from image to video
            if (!isset($daycareData['banner_image'])) {
                $daycareData['banner_image'] = null;
            }
        }

        // Update about daycare section
        $daycareData['kelebihan_daycare'] = $request->kelebihan_daycare;
        $daycareData['about_daycare'] = [
            'title' => $request->about_daycare_title,
            'description' => $request->about_daycare_description,
            'details' => [
                'usia' => $request->usia,
                'jam_operasional' => $request->jam_operasional,
                'rasio' => $request->rasio,
                'makanan' => $request->makanan,
            ]
        ];

        // Update about caregiver section
        $daycareData['about_caregiver'] = [
            'title' => $request->about_caregiver_title,
            'description' => $request->about_caregiver_description
        ];

        // Update program section
        $daycareData['program'] = [
            'description' => $request->program_description,
            'points' => $request->program_points
        ];

        if ($request->hasFile('program_image')) {
            // Delete old image if exists
            if (isset($daycareData['program']['image']) && file_exists(public_path($daycareData['program']['image']))) {
                unlink(public_path($daycareData['program']['image']));
            }

            // Ensure the directory exists
            $dirPath = public_path('images/daycare/program');
            if (!file_exists($dirPath)) {
                mkdir($dirPath, 0777, true);
            }

            $daycareData['program']['image'] = 'images/daycare/program/' . $request->file('program_image')->getClientOriginalName();
            $request->file('program_image')->move($dirPath, $request->file('program_image')->getClientOriginalName());
        }

        // Update facilities
        $daycareData['facilities'] = [];
        foreach ($request->facility_items as $index => $facility) {
            $facilityItem = [
                'title' => $facility['title'],
                'description' => $facility['description']
            ];

            // Check if this is an existing facility with an image
            if (isset($daycareData['facilities'][$index]['image'])) {
                $facilityItem['image'] = $daycareData['facilities'][$index]['image'];
            }

            // Handle new image upload
            if (isset($facility['image']) && $facility['image'] instanceof \Illuminate\Http\UploadedFile) {
                // Delete old image if exists
                if (isset($facilityItem['image']) && file_exists(public_path($facilityItem['image']))) {
                    unlink(public_path($facilityItem['image']));
                }

                // Ensure the directory exists
                $dirPath = public_path('images/daycare/facilities');
                if (!file_exists($dirPath)) {
                    mkdir($dirPath, 0777, true);
                }

                $facilityItem['image'] = 'images/daycare/facilities/' . $facility['image']->getClientOriginalName();
                $facility['image']->move($dirPath, $facility['image']->getClientOriginalName());
            }

            $daycareData['facilities'][] = $facilityItem;
        }

        // Update pricelist
        $daycareData['pricelist'] = [];
        foreach ($request->pricelist_items as $pricelist) {
            $daycareData['pricelist'][] = [
                'title' => $pricelist['title'],
                'price' => $pricelist['price'],
                'description' => $pricelist['description']
            ];
        }

        // Update activities
        $daycareData['activities'] = [];
        foreach ($request->activity_items as $activity) {
            $daycareData['activities'][] = [
                'title' => $activity['title'],
                'time' => $activity['time'],
                'description' => $activity['description']
            ];
        }

        // Save data to JSON file
        $jsonDir = storage_path('app/public/daycare');
        if (!file_exists($jsonDir)) {
            mkdir($jsonDir, 0777, true);
        }

        $jsonPath = $jsonDir . '/data.json';
        file_put_contents($jsonPath, json_encode($daycareData, JSON_PRETTY_PRINT));

        return redirect()->route('daycare.edit')->with('success', 'Data daycare berhasil diperbarui.');
    }

    private function getDaycareData()
    {
        $defaultData = [
            'banner_type' => 'image',
            'banner_image' => 'images/assets/img.png',
            'banner_video' => null,
            'kelebihan_daycare' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus itaque rem quae alias facere ipsum in maiores cupiditate modi, magnam qui natus beatae nam aut voluptate, neque quibusdam reiciendis aliquid atque.',
            'about_daycare' => [
                'title' => 'About Daycare',
                'description' => 'Informasi mengenai layanan daycare di Rumah Samoedra',
                'details' => [
                    'usia' => '6 bln - 12 y.o',
                    'jam_operasional' => 'Senin - Sabtu 07.00 - 17.00',
                    'rasio' => '1:4 (1 caregiver, 4 anak)',
                    'makanan' => 'Snack, Lunch'
                ]
            ],
            'about_caregiver' => [
                'title' => 'About Care Giver',
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, quaerat. Aliquid perferendis minus, nihil esse ducimus eos repellendus natus, neque cumque expedita pariatur eaque, mollitia eveniet? Incidunt non corporis illum.'
            ],
            'program' => [
                'description' => 'Berikut adalah program-program yang diterapkan di Daycare Rumah Samoedra',
                'image' => 'images/assets/img.png',
                'points' => [
                    'Program Pengembangan Fisik Motorik',
                    'Program Pengembangan Kognitif',
                    'Program Pengembangan Bahasa',
                    'Program Pengembangan Sosial Emosional',
                    'Program Pengembangan NAM'
                ]
            ],
            'facilities' => [
                [
                    'title' => 'Fasilitas Tidur',
                    'description' => 'Tempat tidur yang nyaman dan bersih untuk anak-anak beristirahat',
                    'image' => 'images/assets/img.png'
                ],
                [
                    'title' => 'Fasilitas Bermain',
                    'description' => 'Area bermain dengan berbagai mainan edukatif dan aman',
                    'image' => 'images/assets/img.png'
                ],
                [
                    'title' => 'Fasilitas Makan',
                    'description' => 'Ruang makan yang nyaman dan peralatan makan yang bersih',
                    'image' => 'images/assets/img.png'
                ]
            ],
            'pricelist' => [
                [
                    'title' => 'Full Day',
                    'price' => 'Rp 800.000/bulan',
                    'description' => 'Senin - Jumat (08.00 - 16.00)'
                ],
                [
                    'title' => 'Half Day',
                    'price' => 'Rp 500.000/bulan',
                    'description' => 'Senin - Jumat (08.00 - 12.00 atau 12.00 - 16.00)'
                ],
                [
                    'title' => 'Daily',
                    'price' => 'Rp 50.000/hari',
                    'description' => 'Maksimal 8 jam'
                ]
            ],
            'activities' => [
                [
                    'title' => 'Penyambutan Anak',
                    'time' => '07.00 - 08.00',
                    'description' => 'Penyambutan anak oleh caregiver'
                ],
                [
                    'title' => 'Kegiatan Pembelajaran',
                    'time' => '08.00 - 10.00',
                    'description' => 'Kegiatan pembelajaran sesuai tema'
                ],
                [
                    'title' => 'Snack Time',
                    'time' => '10.00 - 10.30',
                    'description' => 'Waktu makan snack'
                ],
                [
                    'title' => 'Bermain Bebas',
                    'time' => '10.30 - 12.00',
                    'description' => 'Bermain bebas di dalam/luar ruangan'
                ],
                [
                    'title' => 'Makan Siang',
                    'time' => '12.00 - 13.00',
                    'description' => 'Waktu makan siang'
                ],
                [
                    'title' => 'Tidur Siang',
                    'time' => '13.00 - 15.00',
                    'description' => 'Waktu tidur siang'
                ],
                [
                    'title' => 'Kegiatan Sore',
                    'time' => '15.00 - 16.30',
                    'description' => 'Kegiatan sore yang menyenangkan'
                ],
                [
                    'title' => 'Persiapan Pulang',
                    'time' => '16.30 - 17.00',
                    'description' => 'Persiapan pulang dan penjemputan'
                ]
            ]
        ];

        $jsonPath = storage_path('app/public/daycare/data.json');
        if (file_exists($jsonPath)) {
            $jsonData = json_decode(file_get_contents($jsonPath), true);
            return array_merge($defaultData, $jsonData);
        }

        return $defaultData;
    }
}
