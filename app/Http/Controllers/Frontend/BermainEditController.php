<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;

class BermainEditController extends Controller
{
    public function edit()
    {
        // Check permission untuk edit area bermain
        $permissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Bermain');
        if (empty($permissionRole)) {
            abort(404);
        }

        $bermain = $this->getBermainData();
        return view('users.bermain-edit', compact('bermain'));
    }

    public function update(Request $request)
    {
        // Check permission untuk edit area bermain
        $permissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Bermain');
        if (empty($permissionRole)) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'banner_type' => 'required|in:image,video',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_video' => 'nullable|string|max:255',
            'benefit_title' => 'required|string|max:255',
            'benefit_description' => 'required|string',
            'info_title' => 'required|string|max:255',
            'age_range' => 'required|string|max:255',
            'operating_hours' => 'required|string|max:255',
            'operating_days' => 'required|string|max:255',
            'cost' => 'required|string',
            'facility_title' => 'required|string|max:255',
            'facility_name' => 'required|array',
            'facility_name.*' => 'required|string|max:255',
            'facility_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'existing_facility_image' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $bermainData = $this->getBermainData();

        // Update banner
        $bermainData['banner_type'] = $request->banner_type;
        if ($request->banner_type == 'image' && $request->hasFile('banner_image')) {
            // Delete old image if exists
            if (isset($bermainData['banner_image']) && Storage::disk('public')->exists($bermainData['banner_image'])) {
                Storage::disk('public')->delete($bermainData['banner_image']);
            }

            $bannerImage = $request->file('banner_image');
            $bermainData['banner_image'] = $bannerImage->store('bermain', 'public');
            $bermainData['banner_video'] = null;
        } elseif ($request->banner_type == 'video') {
            $bermainData['banner_video'] = $request->banner_video;
            // Jika ada banner_image yang sudah ada, pertahankan dalam kasus user berganti ke video
            if (!isset($bermainData['banner_image'])) {
                $bermainData['banner_image'] = null;
            }
        }

        // Update kelebihan section
        $bermainData['benefit_title'] = $request->benefit_title;
        $bermainData['benefit_description'] = $request->benefit_description;

        // Update informasi area bermain
        $bermainData['info_title'] = $request->info_title;
        $bermainData['age_range'] = $request->age_range;
        $bermainData['operating_hours'] = $request->operating_hours;
        $bermainData['operating_days'] = $request->operating_days;
        $bermainData['cost'] = $request->cost;

        // Update fasilitas
        $bermainData['facility_title'] = $request->facility_title;
        $bermainData['facilities'] = [];

        if ($request->has('facility_name')) {
            foreach ($request->facility_name as $index => $name) {
                $facilityData = [
                    'name' => $name,
                    'image' => $request->existing_facility_image[$index] ?? null
                ];

                // Update facility image if provided
                if (isset($request->file('facility_image')[$index])) {
                    // Delete old image if exists
                    if (!empty($facilityData['image']) && Storage::disk('public')->exists($facilityData['image'])) {
                        Storage::disk('public')->delete($facilityData['image']);
                    }

                    $facilityImage = $request->file('facility_image')[$index];
                    $facilityData['image'] = $facilityImage->store('bermain/facilities', 'public');
                }

                $bermainData['facilities'][] = $facilityData;
            }
        }


        // Save data to JSON file
        $jsonDir = storage_path('app/public/bermain');
        if (!file_exists($jsonDir)) {
            mkdir($jsonDir, 0777, true);
        }

        $jsonPath = $jsonDir . '/data.json';
        file_put_contents($jsonPath, json_encode($bermainData, JSON_PRETTY_PRINT));

        return redirect()->route('bermain.edit')->with('success', 'Data area bermain berhasil diperbarui.');
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
                ],
            ];
        }

        return $data;
    }
}
