<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;

class DaycareEditController extends Controller
{
    public function edit()
    {
        // Check permission untuk edit daycare
        $permissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Daycare');
        if (empty($permissionRole)) {
            abort(404);
        }

        $daycareData = $this->getDaycareData();
        return view('users.daycare-edit', compact('daycareData'));
    }

    public function update(Request $request)
    {
        // Check permission untuk edit daycare
        $permissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Daycare');
        if (empty($permissionRole)) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'banner_type' => 'required|in:image,video',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_video' => 'nullable|string|max:255',
            'kelebihan_daycare' => 'required|string',
            'usia' => 'required|string|max:255',
            'jam_operasional' => 'required|string|max:255',
            'hari' => 'nullable|string|max:255',
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
            'pricelist_items.*.description' => 'nullable|numeric',
            'pricelist_items.*.food_cost' => 'nullable|string|max:255',
            'activity_items' => 'required|array',
            'activity_items.*.title' => 'required|string|max:255',
            'activity_items.*.time' => 'required|string|max:255',
            'activity_items.*.description' => 'required|string',
            'caregiver_items' => 'nullable|array',
            'caregiver_items.*.usia' => 'nullable|string|max:255',
            'caregiver_items.*.rasio' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $daycareData = $this->getDaycareData();

        // Update banner
        $daycareData['banner_type'] = $request->banner_type;
        if ($request->banner_type == 'image' && $request->hasFile('banner_image')) {
            // Delete old image if exists
            if (isset($daycareData['banner_image']) && Storage::disk('public')->exists($daycareData['banner_image'])) {
                Storage::disk('public')->delete($daycareData['banner_image']);
            }

            $daycareData['banner_image'] = 'storage/' . $request->file('banner_image')->store('daycare', 'public');
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
            'details' => [
                'usia' => $request->usia,
                'jam_operasional' => $request->jam_operasional,
                'hari' => $request->hari ?? 'Senin-Sabtu'
            ]
        ];

        // Update about caregiver section
        $daycareData['about_caregiver'] = [
            'caregivers' => []
        ];

        if ($request->has('caregiver_items')) {
            foreach ($request->caregiver_items as $caregiver) {
                if (!empty($caregiver['usia']) && !empty($caregiver['rasio'])) {
                    $daycareData['about_caregiver']['caregivers'][] = [
                        'usia' => $caregiver['usia'],
                        'rasio' => $caregiver['rasio']
                    ];
                }
            }
        }

        // Update facilities
        $oldData = $this->getDaycareData();
        $daycareData['facilities'] = [];
        foreach ($request->facility_items as $index => $facility) {
            $facilityItem = [
                'title' => $facility['title'],
                'description' => $facility['description']
            ];

            // Handle new image upload
            if (isset($facility['image']) && $facility['image'] instanceof \Illuminate\Http\UploadedFile) {
                // Delete old image if exists and it's not a default image
                if (
                    isset($oldData['facilities'][$index]['image']) &&
                    !str_contains($oldData['facilities'][$index]['image'], 'images/daycare/default') &&
                    Storage::disk('public')->exists(str_replace('storage/', '', $oldData['facilities'][$index]['image']))
                ) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $oldData['facilities'][$index]['image']));
                }

                $path = $facility['image']->store('daycare', 'public');
                $facilityItem['image'] = 'storage/' . $path;
            } elseif (isset($oldData['facilities'][$index]['image'])) {
                // Keep existing image if no new upload
                $facilityItem['image'] = $oldData['facilities'][$index]['image'];
                // Pastikan path dimulai dengan storage/ untuk konsistensi
                if (strpos($facilityItem['image'], 'storage/') !== 0 && strpos($facilityItem['image'], 'images/') !== 0) {
                    $facilityItem['image'] = 'storage/' . $facilityItem['image'];
                }
            } else {
                $facilityItem['image'] = 'images/daycare/default-facility.jpg';
            }

            $daycareData['facilities'][] = $facilityItem;
        }

        // Update pricelist
        $daycareData['pricelist'] = [];
        foreach ($request->pricelist_items as $pricelist) {
            $price = $pricelist['price'];
            // Jika tidak dimulai dengan "Rp", tambahkan
            if (!str_starts_with(strtolower(trim($price)), 'rp')) {
                $price = 'Rp ' . $price;
            }

            $daycareData['pricelist'][] = [
                'title' => $pricelist['title'],
                'price' => $price,
                'description' => !empty($pricelist['description']) ? 'Rp. ' . number_format($pricelist['description'], 0, ',', '.') : '-',
                'food_cost' => $pricelist['food_cost'] ?? '12.5k / Porsi, 5k Snack'
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

        // Update program section
        $daycareData['program'] = [
            'description' => $request->program_description,
            'points' => $request->program_points
        ];

        if ($request->hasFile('program_image')) {
            // Delete old image if exists and it's not a default image
            if (
                isset($oldData['program']['image']) &&
                !str_contains($oldData['program']['image'], 'images/daycare/default') &&
                Storage::disk('public')->exists(str_replace('storage/', '', $oldData['program']['image']))
            ) {
                Storage::disk('public')->delete(str_replace('storage/', '', $oldData['program']['image']));
            }

            $daycareData['program']['image'] = 'storage/' . $request->file('program_image')->store('daycare', 'public');
        } elseif (isset($oldData['program']['image'])) {
            // Keep existing image
            $daycareData['program']['image'] = $oldData['program']['image'];
            // Pastikan path gambar program konsisten
            if (strpos($daycareData['program']['image'], 'storage/') !== 0 && strpos($daycareData['program']['image'], 'images/') !== 0) {
                $daycareData['program']['image'] = 'storage/' . $daycareData['program']['image'];
            }
        } else {
            $daycareData['program']['image'] = 'images/daycare/default-program.jpg';
        }

        // Save data to JSON file
        $jsonPath = storage_path('app/public/daycare/data.json');
        file_put_contents($jsonPath, json_encode($daycareData, JSON_PRETTY_PRINT));

        return redirect()->route('daycare.edit')->with('success', 'Data daycare berhasil diperbarui.');
    }

    private function getDaycareData()
    {
        $defaultData = [
            'banner_type' => 'image',
            'banner_image' => 'images/daycare/banner.jpg',
            'banner_video' => '',
            'kelebihan_daycare' => 'Fokus pada pertumbuhan dan perkembangan anak secara holistik',
            'about_daycare' => [
                'details' => [
                    'usia' => '6 bulan - 12 tahun',
                    'jam_operasional' => '07.00 - 17.00 WIB, Senin - Sabtu',
                    'hari' => 'Senin-Sabtu'
                ]
            ],
            'about_caregiver' => [
                'caregivers' => [
                    [
                        'usia' => 'Usia 0 - 1',
                        'rasio' => '1 Anak 1 Care Giver'
                    ],
                    [
                        'usia' => 'Usia 1 - 3',
                        'rasio' => '2 Anak 1 Care Giver'
                    ],
                    [
                        'usia' => 'Usia 3 - 12',
                        'rasio' => '4 Anak 1 Care Giver'
                    ]
                ]
            ],
            'program' => [
                'description' => 'Program daycare kami dirancang untuk memberikan pengalaman belajar yang menyenangkan dan stimulatif bagi anak-anak',
                'image' => 'images/daycare/program.jpg',
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
                    'image' => 'images/daycare/facility-ac.jpg'
                ],
                [
                    'title' => 'Purifier',
                    'description' => 'Air purifier untuk udara yang bersih dan sehat',
                    'image' => 'images/daycare/facility-purifier.jpg'
                ],
                [
                    'title' => '3 Kamar',
                    'description' => 'Kamar terpisah untuk berbagai kegiatan dan usia',
                    'image' => 'images/daycare/facility-rooms.jpg'
                ],
                [
                    'title' => 'Baby Bed',
                    'description' => 'Tempat tidur khusus bayi yang nyaman dan aman',
                    'image' => 'images/daycare/facility-bed.jpg'
                ],
                [
                    'title' => 'Outdoor Area',
                    'description' => 'Area bermain luar ruangan yang aman',
                    'image' => 'images/daycare/facility-outdoor.jpg'
                ]
            ],
            'pricelist' => [
                [
                    'title' => 'Daycare Harian',
                    'price' => 'Rp 110.000',
                    'description' => 'promo Rp. 100.000',
                    'food_cost' => '12.5k / Porsi, 5k Snack'
                ],
                [
                    'title' => 'Daycare Bulanan',
                    'price' => 'Rp 1.300.000',
                    'description' => 'promo Rp. 100.000',
                    'food_cost' => '12.5k / Porsi, 5k Snack'
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

        $jsonPath = storage_path('app/public/daycare/data.json');
        if (file_exists($jsonPath)) {
            $jsonData = json_decode(file_get_contents($jsonPath), true);
            return array_merge($defaultData, $jsonData);
        }

        return $defaultData;
    }
}
