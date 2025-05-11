<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;

class BimbelEditController extends Controller
{
    public function edit()
    {
        // Check permission untuk edit bimbel
        $permissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Bimbel');
        if (empty($permissionRole)) {
            abort(404);
        }

        $bimbel = $this->getBimbelData();
        return view('users.bimbel-edit', compact('bimbel'));
    }

    public function update(Request $request)
    {
        // Check permission untuk edit bimbel
        $permissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Bimbel');
        if (empty($permissionRole)) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'banner_type' => 'required|in:image,video',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_video' => 'nullable|string|max:255',
            'benefit_title' => 'required|string|max:255',
            'benefit_description' => 'required|string',
            'age_range' => 'required|string|max:255',
            'operating_hours' => 'required|string|max:255',
            'operating_days' => 'required|string|max:255',
            'service_types' => 'required|array',
            'service_types.*' => 'required|string|max:255',
            'program_title' => 'required|string|max:255',
            'program_description' => 'required|string',
            'program_points' => 'required|array',
            'program_points.*' => 'required|string|max:255',
            'program_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'facility_items' => 'required|array',
            'facility_items.*.title' => 'required|string|max:255',
            'facility_items.*.description' => 'required|string',
            'facility_items.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pricing_items' => 'required|array',
            'pricing_items.*.service' => 'required|string|max:255',
            'pricing_items.*.levels' => 'required|string|max:255',
            'pricing_items.*.registration_promo' => 'required|string|max:255',
            'pricing_items.*.price_per_session' => 'required|numeric',
            'pricing_items.*.price_per_session_promo' => 'required|numeric',
            'pricing_items.*.monthly_price' => 'required|numeric',
            'pricing_items.*.monthly_price_promo' => 'required|numeric',
            'pricing_items.*.sessions_per_month' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $bimbelData = [];

            // Update banner
            $bimbelData['banner_type'] = $request->banner_type;
            if ($request->banner_type == 'image') {
                if ($request->hasFile('banner_image')) {
                    // Delete old image if exists
                    $oldData = $this->getBimbelData();
                    if (isset($oldData['banner_image']) && Storage::disk('public')->exists(str_replace('storage/', '', $oldData['banner_image']))) {
                        Storage::disk('public')->delete(str_replace('storage/', '', $oldData['banner_image']));
                    }

                    $bannerImage = $request->file('banner_image');
                    $bimbelData['banner_image'] = 'storage/' . $bannerImage->store('bimbel', 'public');
                } else {
                    // Pertahankan gambar lama jika tidak ada upload baru
                    $oldData = $this->getBimbelData();
                    $bimbelData['banner_image'] = $oldData['banner_image'] ?? 'images/assets/img.png';
                }
                $bimbelData['banner_video'] = null;
            } elseif ($request->banner_type == 'video') {
                $bimbelData['banner_video'] = $request->banner_video;
                $bimbelData['banner_image'] = null;
            }

            // Update kelebihan section
            $bimbelData['benefit_title'] = $request->benefit_title;
            $bimbelData['benefit_description'] = $request->benefit_description;

            // Update informasi bimbel
            $bimbelData['age_range'] = $request->age_range;
            $bimbelData['operating_hours'] = $request->operating_hours;
            $bimbelData['operating_days'] = $request->operating_days;

            // Update jenis layanan
            $bimbelData['service_types'] = $request->service_types;

            // Update program
            $bimbelData['program_title'] = $request->program_title;
            $bimbelData['program_description'] = $request->program_description;
            $bimbelData['program_points'] = $request->program_points;

            // Update program image if provided
            if ($request->hasFile('program_image')) {
                // Delete old program image if exists
                $oldData = $this->getBimbelData();
                if (isset($oldData['program_image']) && Storage::disk('public')->exists(str_replace('storage/', '', $oldData['program_image']))) {
                    Storage::disk('public')->delete(str_replace('storage/', '', $oldData['program_image']));
                }

                $programImage = $request->file('program_image');
                $bimbelData['program_image'] = 'storage/' . $programImage->store('bimbel/program', 'public');
            } else {
                // Pertahankan gambar program yang sudah ada
                $oldData = $this->getBimbelData();
                $bimbelData['program_image'] = $oldData['program_image'] ?? 'storage/images/assets/img_detail_layanan.png';
            }

            // Update facilities
            $bimbelData['facilities'] = [];
            $oldData = $this->getBimbelData();
            if ($request->has('facility_items')) {
                foreach ($request->facility_items as $index => $item) {
                    $facilityData = [
                        'title' => $item['title'],
                        'description' => $item['description']
                    ];

                    // Handle facility image
                    if (isset($request->file('facility_items')[$index]['image'])) {
                        // Delete old image if exists
                        if (isset($oldData['facilities'][$index]['image'])) {
                            $oldImagePath = str_replace('storage/', '', $oldData['facilities'][$index]['image']);
                            if (Storage::disk('public')->exists($oldImagePath)) {
                                Storage::disk('public')->delete($oldImagePath);
                            }
                        }

                        $image = $request->file('facility_items')[$index]['image'];
                        $facilityData['image'] = 'storage/' . $image->store('bimbel/facilities', 'public');
                    } else {
                        // Gunakan gambar yang sudah ada jika tersedia
                        $facilityData['image'] = isset($oldData['facilities'][$index]['image'])
                            ? str_replace('storage/storage/', 'storage/', $oldData['facilities'][$index]['image'])
                            : 'images/assets/img_layanan.png';
                    }

                    $bimbelData['facilities'][] = $facilityData;
                }
            }

            // Update pricing
            $bimbelData['pricing_items'] = [];
            foreach ($request->pricing_items as $item) {
                $bimbelData['pricing_items'][] = [
                    'service' => $item['service'],
                    'levels' => $item['levels'],
                    'registration_promo' => $item['registration_promo'],
                    'price_per_session' => (int)$item['price_per_session'],
                    'price_per_session_promo' => (int)$item['price_per_session_promo'],
                    'monthly_price' => (int)$item['monthly_price'],
                    'monthly_price_promo' => (int)$item['monthly_price_promo'],
                    'sessions_per_month' => (int)$item['sessions_per_month']
                ];
            }

            // Save data to JSON file
            $jsonDir = storage_path('app/public/bimbel');
            if (!file_exists($jsonDir)) {
                mkdir($jsonDir, 0777, true);
            }

            $jsonPath = $jsonDir . '/data.json';
            $success = file_put_contents($jsonPath, json_encode($bimbelData, JSON_PRETTY_PRINT));

            if ($success === false) {
                throw new \Exception('Failed to write JSON file');
            }

            return redirect()->route('bimbel.edit')->with('success', 'Data bimbel berhasil diperbarui');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data')->withInput();
        }
    }

    public function getBimbelData()
    {
        $jsonPath = storage_path('app/public/bimbel/data.json');

        if (file_exists($jsonPath)) {
            $data = json_decode(file_get_contents($jsonPath), true);

            // Bersihkan semua path gambar dari duplikasi storage
            $cleanPath = function ($path) {
                return str_replace('storage/storage/', 'storage/', $path);
            };

            if (isset($data['banner_image'])) {
                $data['banner_image'] = $cleanPath($data['banner_image']);
            }

            if (isset($data['program_image'])) {
                $data['program_image'] = $cleanPath($data['program_image']);
            }

            if (isset($data['facilities'])) {
                foreach ($data['facilities'] as &$facility) {
                    if (isset($facility['image'])) {
                        $facility['image'] = $cleanPath($facility['image']);
                    }
                }
            }

            return $data;
        } else {
            // Default data jika file belum ada
            $data = [
                'banner_type' => 'image',
                'banner_image' => 'images/assets/img.png',
                'banner_video' => '',
                'benefit_title' => 'Kelebihan Bimbel Kami',
                'benefit_description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus itaque rem quae alias facere ipsum in maiores cupiditate modi, magnam qui natus beatae nam aut voluptate, neque quibusdam reiciendis aliquid atque. Necessitatibus praesentium maiores, modi ratione nostrum vel odit recusandae!',
                'info_title' => 'About Bimbel',
                'age_range' => '0-Dewasa',
                'operating_hours' => '9.00-20.00 (Pilihan waktu dapat disesuaikan)',
                'operating_days' => 'Senin-Sabtu',
                'service_types' => [
                    'Siswa datang ke Samoedra',
                    'Guru datang ke rumah (private)',
                    'Online via zoom/wa video'
                ],
                'program_title' => 'Program Bimbel Rumah Samoedra',
                'program_description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi fugit delectus repellendus non sed illo aliquam totam velit, dolorum quo sunt inventore temporibus eaque doloribus sint! Placeat quia alias perferendis.',
                'program_points' => [
                    'Bimbingan Belajar Pelajaran Sekolah Semua Jenjang',
                    'Bimbingan Belajar Mengaji Iqra/Al-Quran',
                    'Bimbingan Remedial',
                    'Bimbingan Tumbuh Kembang',
                    'Bimbingan Persiapan Ujian',
                    'Bimbingan Bahasa Inggris',
                    'Bimbingan Bahasa Arab',
                    'Bimbingan Lainnya Sesuai Kebutuhan',
                    'Bimbingan Coding',
                    'Bimbingan Persiapan Masuk PTN'
                ],
                'program_image' => 'images/assets/img.png',
                'facilities' => [
                    [
                        'title' => 'Full AC',
                        'description' => 'Ruangan ber-AC untuk kenyamanan belajar',
                        'image' => 'images/assets/img_layanan.png'
                    ],
                    [
                        'title' => 'Ruang Belajar Nyaman',
                        'description' => 'Dilengkapi meja dan kursi yang nyaman',
                        'image' => 'images/assets/img_layanan.png'
                    ],
                    [
                        'title' => 'Wifi Gratis',
                        'description' => 'Akses internet cepat untuk pembelajaran online',
                        'image' => 'images/assets/img_layanan.png'
                    ]
                ],
                'pricing_items' => [
                    [
                        'service' => 'Bimbel Calistung',
                        'levels' => 'TK-SD',
                        'registration_promo' => 'Gratis 1x Pertemuan',
                        'price_per_session' => '75000',
                        'price_per_session_promo' => '56250',
                        'monthly_price' => '600000',
                        'monthly_price_promo' => '450000',
                        'sessions_per_month' => '8'
                    ],
                    [
                        'service' => 'Bimbel Mata Pelajaran SD',
                        'levels' => 'SD',
                        'registration_promo' => 'Gratis 1x Pertemuan',
                        'price_per_session' => '85000',
                        'price_per_session_promo' => '63750',
                        'monthly_price' => '680000',
                        'monthly_price_promo' => '510000',
                        'sessions_per_month' => '8'
                    ]
                ]
            ];
        }

        return $data;
    }
}
