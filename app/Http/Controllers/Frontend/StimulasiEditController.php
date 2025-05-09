<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StimulasiEditController extends Controller
{
    public function edit()
    {
        // Check permission untuk edit stimulasi
        $permissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Stimulasi');
        if (empty($permissionRole)) {
            abort(404);
        }

        $stimulasiData = $this->getStimulasiData();
        return view('users.stimulasi-edit', ['stimulasi' => $stimulasiData]);
    }

    public function update(Request $request)
    {
        // Check permission untuk edit stimulasi
        $permissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Stimulasi');
        if (empty($permissionRole)) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'banner_type' => 'required|in:image,video',
            'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_video' => 'nullable|string|max:255',
            'benefit_title' => 'nullable|string|max:255',
            'benefit_description' => 'nullable|string',
            'info_title' => 'nullable|string|max:255',
            'age_range' => 'nullable|string|max:255',
            'operating_hours' => 'nullable|string|max:255',
            'operating_days' => 'nullable|string|max:255',
            'cost' => 'nullable|string|max:255',
            'program_title' => 'nullable|string|max:255',
            'program_description' => 'nullable|string',
            'program_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'program_points' => 'nullable|array',
            'program_points.*' => 'nullable|string',
            'description' => 'nullable|string',
            'kegiatan_title' => 'nullable|string|max:255',
            'kegiatan_name' => 'nullable|array',
            'kegiatan_name.*' => 'nullable|string',
            'kegiatan_description' => 'nullable|array',
            'kegiatan_description.*' => 'nullable|string',
            'fasilitas_name' => 'nullable|array',
            'fasilitas_name.*' => 'nullable|string',
            'fasilitas_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fasilitas_old_image' => 'nullable|array',
            'fasilitas_old_image.*' => 'nullable|string',
            'pricelist_subtitle' => 'nullable|string|max:255',
            'pricelist_header' => 'nullable|string|max:255',
            'pricelist_title.*' => 'nullable|string|max:255',
            'pricelist_age_range.*' => 'nullable|string|max:255',
            'pricelist_registration_fee.*' => 'nullable|string|max:255',
            'pricelist_price.*' => 'nullable|string|max:255',
            'pricelist_meetings.*' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // Log request data for debugging
        Log::info('Request data: ', $request->all());

        // Get current stimulasi data
        $stimulasiData = $this->getStimulasiData();
        Log::info('Current stimulasi data: ', $stimulasiData);

        if ($request->hasFile('banner_image')) {
            $stimulasiData['banner_image'] = $request->file('banner_image')->store('stimulasi', 'public');
        }

        // Text fields update
        $stimulasiData['banner_type'] = $request->banner_type;
        $stimulasiData['banner_video'] = $request->banner_video;
        $stimulasiData['description'] = $request->description;
        $stimulasiData['age_range'] = $request->age_range;
        $stimulasiData['hours'] = $request->operating_hours;
        $stimulasiData['days'] = $request->operating_days;
        $stimulasiData['cost'] = $request->cost;

        // Make sure we have these fields
        if (!isset($stimulasiData['operating_hours'])) {
            $stimulasiData['operating_hours'] = $request->operating_hours;
        }
        if (!isset($stimulasiData['operating_days'])) {
            $stimulasiData['operating_days'] = $request->operating_days;
        }

        // Update program title, description dan image
        $stimulasiData['program_title'] = $request->program_title;
        $stimulasiData['program_description'] = $request->program_description;

        // Update program image if provided
        if ($request->hasFile('program_image')) {
            // Delete old image if exists and is not an external path
            if (isset($stimulasiData['program_image']) && !str_starts_with($stimulasiData['program_image'], 'images/') && Storage::disk('public')->exists(str_replace('storage/', '', $stimulasiData['program_image']))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $stimulasiData['program_image']));
            }

            $stimulasiData['program_image'] = $request->file('program_image')->store('stimulasi', 'public');
        }

        // Update program points
        if ($request->has('program_points')) {
            $stimulasiData['program']['points'] = $request->program_points;
        }

        // Update kegiatan kelas stimulasi
        if ($request->has('kegiatan_title')) {
            $stimulasiData['kegiatan_title'] = $request->kegiatan_title;
        }

        // Update kegiatan items
        if ($request->has('kegiatan_name') && $request->has('kegiatan_description')) {
            $kegiatanNames = $request->kegiatan_name;
            $kegiatanDescriptions = $request->kegiatan_description;

            $kegiatan = [];

            for ($i = 0; $i < count($kegiatanNames); $i++) {
                if (!empty($kegiatanNames[$i])) {
                    $kegiatan[] = [
                        'name' => $kegiatanNames[$i],
                        'description' => $kegiatanDescriptions[$i]
                    ];
                }
            }

            $stimulasiData['kegiatan'] = $kegiatan;
        }

        // Update fasilitas items
        if ($request->has('fasilitas_name')) {
            $fasilitasNames = $request->fasilitas_name;
            $oldImages = $request->fasilitas_old_image ?? [];
            $files = $request->file('fasilitas_image') ?? [];

            $fasilitas = [];

            for ($i = 0; $i < count($fasilitasNames); $i++) {
                if (!empty($fasilitasNames[$i])) {
                    $fasilitasItem = [
                        'name' => $fasilitasNames[$i],
                    ];

                    // Handle image upload or use existing
                    if (isset($files[$i]) && $files[$i]) {
                        $fasilitasItem['image'] = $files[$i]->store('stimulasi/fasilitas', 'public');
                    } elseif (isset($oldImages[$i])) {
                        $fasilitasItem['image'] = $oldImages[$i];
                    } else {
                        $fasilitasItem['image'] = 'images/assets/img_layanan.png'; // Default image
                    }

                    $fasilitas[] = $fasilitasItem;
                }
            }

            $stimulasiData['fasilitas'] = $fasilitas;
        }

        // Debug pricelist data
        Log::info('Pricelist data from request: ', [
            'pricelist_subtitle' => $request->pricelist_subtitle,
            'pricelist_header' => $request->pricelist_header,
            'pricelist_title_array' => $request->input('pricelist_title'),
            'pricelist_age_range' => $request->input('pricelist_age_range'),
            'pricelist_registration_fee' => $request->input('pricelist_registration_fee'),
            'pricelist_price' => $request->input('pricelist_price'),
            'pricelist_meetings' => $request->input('pricelist_meetings'),
        ]);

        // Update pricelist
        if ($request->has('pricelist_subtitle')) {
            $stimulasiData['pricelist_subtitle'] = $request->pricelist_subtitle;
        }

        if ($request->has('pricelist_header')) {
            $stimulasiData['pricelist_title'] = $request->input('pricelist_header');
        }

        // Update pricelist items
        $pricelistTitles = $request->input('pricelist_title');
        if (is_array($pricelistTitles)) {
            $pricelistAgeRanges = $request->input('pricelist_age_range', []);
            $pricelistRegistrationFees = $request->input('pricelist_registration_fee', []);
            $pricelistPrices = $request->input('pricelist_price', []);
            $pricelistMeetings = $request->input('pricelist_meetings', []);

            Log::info('Processing pricelist items with arrays:', [
                'titles_count' => count($pricelistTitles),
                'age_ranges_count' => count($pricelistAgeRanges),
                'registration_fees_count' => count($pricelistRegistrationFees),
                'prices_count' => count($pricelistPrices),
                'meetings_count' => count($pricelistMeetings),
            ]);

            $stimulasiData['pricelist_items'] = [];

            $count = count($pricelistTitles);
            for ($i = 0; $i < $count; $i++) {
                // Jangan tambahkan item jika title kosong
                if (empty($pricelistTitles[$i])) {
                    continue;
                }

                $item = [
                    'title' => $pricelistTitles[$i],
                    'age_range' => isset($pricelistAgeRanges[$i]) ? $pricelistAgeRanges[$i] : '6 bulan - 12 tahun',
                    'registration_fee' => isset($pricelistRegistrationFees[$i]) ? $pricelistRegistrationFees[$i] : 'Rp. 100.000',
                    'price' => isset($pricelistPrices[$i]) ? $pricelistPrices[$i] : 'Rp. 500.000',
                    'meetings' => isset($pricelistMeetings[$i]) ? $pricelistMeetings[$i] : '10x Pertemuan'
                ];

                Log::info('Adding pricelist item:', $item);
                $stimulasiData['pricelist_items'][] = $item;
            }
        } else {
            Log::warning('pricelist_title is not an array, it is: ' . gettype($pricelistTitles));
            // Pastikan pricelist_items tetap ada meskipun tidak ada data baru
            if (!isset($stimulasiData['pricelist_items']) || !is_array($stimulasiData['pricelist_items'])) {
                $stimulasiData['pricelist_items'] = [
                    [
                        'title' => 'Kelas Stimulasi',
                        'age_range' => '6 bulan - 12 tahun',
                        'registration_fee' => 'Rp. 100.000',
                        'price' => 'Rp. 500.000',
                        'meetings' => '10x Pertemuan'
                    ]
                ];
            }
        }

        // Log the final pricelist_items array
        Log::info('Final pricelist_items array:', $stimulasiData['pricelist_items'] ?? []);

        // Save data to JSON file
        $jsonDir = storage_path('app/public/stimulasi');
        if (!file_exists($jsonDir)) {
            mkdir($jsonDir, 0777, true);
        }

        $jsonPath = $jsonDir . '/data.json';
        file_put_contents($jsonPath, json_encode($stimulasiData, JSON_PRETTY_PRINT));

        Log::info('Updated stimulasi data: ', $stimulasiData);

        return redirect()->route('stimulasi.edit')->with('success', 'Data kelas stimulasi berhasil diperbarui.');
    }

    private function getStimulasiData()
    {
        $jsonPath = storage_path('app/public/stimulasi/data.json');

        if (file_exists($jsonPath)) {
            $data = json_decode(file_get_contents($jsonPath), true);
        } else {
            // Default data jika file belum ada
            $data = [
                'title' => 'Kelas Stimulasi Little Explorer',
                'banner_type' => 'image',
                'banner_image' => 'images/assets/img_layanan.png',
                'banner_video' => '',
                'description' => 'Kelas stimulasi adalah program pengembangan anak yang dirancang untuk meningkatkan perkembangan kognitif, fisik, dan sosial dengan berbagai aktivitas yang menyenangkan dan edukatif.',
                'info_title' => 'Kelas Stimulasi Little Explorer',
                'age_range' => '6 bulan - 12 tahun',
                'registration_fee' => 'Rp. 100.000',
                'price' => 'Rp. 500.000',
                'meetings' => '10x Pertemuan',
                'kegiatans' => [],
                'fasilitas' => [],
                'pricelist_subtitle' => 'Pricelist',
                'pricelist_title' => 'Price List Kelas Stimulasi',
                'pricelist_items' => [
                    [
                        'title' => 'Kelas Stimulasi',
                        'age_range' => '6 bulan - 12 tahun',
                        'registration_fee' => 'Rp. 100.000',
                        'price' => 'Rp. 500.000',
                        'meetings' => '10x Pertemuan'
                    ]
                ]
            ];
        }

        return $data;
    }
}
