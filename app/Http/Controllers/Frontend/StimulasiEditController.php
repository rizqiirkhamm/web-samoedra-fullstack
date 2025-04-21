<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;

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
        return view('users.stimulasi-edit', compact('stimulasiData'));
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
            'description' => 'required|string',
            'age_range' => 'required|string|max:255',
            'hours' => 'required|string|max:255',
            'days' => 'nullable|string|max:255',
            'program_title' => 'required|string|max:255',
            'program_description' => 'required|string',
            'program_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'program_points' => 'required|array',
            'program_points.*' => 'required|string',
            'kegiatan_title' => 'required|string|max:255',
            'kegiatan' => 'nullable|array',
            'kegiatan.*.name' => 'required|string|max:255',
            'kegiatan.*.description' => 'required|string',
            'fasilitas' => 'nullable|array',
            'fasilitas.*.name' => 'required|string|max:255',
            'fasilitas.*.image' => 'nullable|string',
            'fasilitas_image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pricelist_title' => 'nullable|string|max:255',
            'pricelist_subtitle' => 'nullable|string|max:255',
            'pricelist_items' => 'nullable|array',
            'pricelist_items.*.title' => 'required|string|max:255',
            'pricelist_items.*.age_range' => 'required|string|max:255',
            'pricelist_items.*.registration_fee' => 'required|string',
            'pricelist_items.*.price' => 'required|string',
            'pricelist_items.*.meetings' => 'required|string',
            'price' => 'required|string|max:255',
            'meetings' => 'required|string|max:255',
            'registration_fee' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $stimulasiData = $this->getStimulasiData();

        // Update informasi umum (hilangkan title karena tidak ada di form)
        // $stimulasiData['title'] = $request->title;

        // Update banner
        $stimulasiData['banner_type'] = $request->banner_type;
        if ($request->banner_type == 'image' && $request->hasFile('banner_image')) {
            // Delete old image if exists
            if (isset($stimulasiData['banner_image']) && file_exists(public_path($stimulasiData['banner_image']))) {
                unlink(public_path($stimulasiData['banner_image']));
            }

            // Ensure the directory exists
            $dirPath = public_path('images/stimulasi');
            if (!file_exists($dirPath)) {
                mkdir($dirPath, 0777, true);
            }

            $stimulasiData['banner_image'] = 'images/stimulasi/' . $request->file('banner_image')->getClientOriginalName();
            $request->file('banner_image')->move($dirPath, $request->file('banner_image')->getClientOriginalName());
            $stimulasiData['banner_video'] = null;
        } elseif ($request->banner_type == 'video') {
            $stimulasiData['banner_video'] = $request->banner_video;
            // Keep old image or set to null if changing from image to video
            if (!isset($stimulasiData['banner_image'])) {
                $stimulasiData['banner_image'] = null;
            }
        }

        // Update deskripsi dan informasi kelas
        $stimulasiData['description'] = $request->description;
        $stimulasiData['age_range'] = $request->age_range;
        $stimulasiData['hours'] = $request->hours;
        $stimulasiData['days'] = $request->days ?? 'Senin-Sabtu';

        // Update program title, description dan image
        $stimulasiData['program_title'] = $request->program_title;
        $stimulasiData['program_description'] = $request->program_description;

        // Update program image if provided
        if ($request->hasFile('program_image')) {
            // Delete old image if exists
            if (isset($stimulasiData['program_image']) && file_exists(public_path($stimulasiData['program_image']))) {
                unlink(public_path($stimulasiData['program_image']));
            }

            // Ensure the directory exists
            $dirPath = public_path('images/stimulasi');
            if (!file_exists($dirPath)) {
                mkdir($dirPath, 0777, true);
            }

            $stimulasiData['program_image'] = 'images/stimulasi/' . $request->file('program_image')->getClientOriginalName();
            $request->file('program_image')->move($dirPath, $request->file('program_image')->getClientOriginalName());
        }

        // Update program points
        $stimulasiData['program']['points'] = $request->program_points;

        // Update kegiatan
        $stimulasiData['kegiatan_title'] = $request->kegiatan_title;
        $stimulasiData['kegiatan'] = $request->kegiatan ?? [];

        // Update fasilitas
        if ($request->has('fasilitas')) {
            foreach ($request->fasilitas as $index => $fasilitas) {
                if (isset($request->file('fasilitas_image')[$index])) {
                    // Delete old image if exists
                    if (!empty($fasilitas['image']) && file_exists(public_path($fasilitas['image']))) {
                        unlink(public_path($fasilitas['image']));
                    }

                    // Ensure the directory exists
                    $dirPath = public_path('images/stimulasi');
                    if (!file_exists($dirPath)) {
                        mkdir($dirPath, 0777, true);
                    }

                    $fileName = 'fasilitas_' . time() . '_' . $index . '.' . $request->file('fasilitas_image')[$index]->getClientOriginalExtension();
                    $request->file('fasilitas_image')[$index]->move($dirPath, $fileName);
                    $stimulasiData['fasilitas'][$index]['image'] = 'images/stimulasi/' . $fileName;
                } else {
                    $stimulasiData['fasilitas'][$index]['image'] = $fasilitas['image'];
                }
                $stimulasiData['fasilitas'][$index]['name'] = $fasilitas['name'];
            }
        } else {
            $stimulasiData['fasilitas'] = [];
        }

        // Update informasi harga
        $stimulasiData['price'] = 'Rp. ' . $request->price;
        $stimulasiData['meetings'] = $request->meetings . 'x Pertemuan';
        $stimulasiData['registration_fee'] = 'Rp. ' . $request->registration_fee;
        $stimulasiData['pricelist_title'] = $request->pricelist_title;
        $stimulasiData['pricelist_subtitle'] = $request->pricelist_subtitle;

        // Update pricelist items jika ada
        if ($request->has('pricelist_items')) {
            $stimulasiData['pricelist_items'] = [];
            foreach ($request->pricelist_items as $item) {
                $stimulasiData['pricelist_items'][] = [
                    'title' => $item['title'],
                    'age_range' => $item['age_range'],
                    'registration_fee' => 'Rp. ' . $item['registration_fee'],
                    'price' => 'Rp. ' . $item['price'],
                    'meetings' => $item['meetings'] . 'x Pertemuan'
                ];
            }
        }

        // Save data to JSON file
        $jsonDir = storage_path('app/public/stimulasi');
        if (!file_exists($jsonDir)) {
            mkdir($jsonDir, 0777, true);
        }

        $jsonPath = $jsonDir . '/data.json';
        file_put_contents($jsonPath, json_encode($stimulasiData, JSON_PRETTY_PRINT));

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
                'banner_image' => 'images/stimulasi/@img.png',
                'banner_video' => '',
                'description' => 'Apa itu Kelas Stimulasi',
                'program_title' => 'Kelas Stimulasi Di Rumah Samoedra',
                'program_description' => 'Kelas Stimulasi Rumah Samoedra dirancang untuk mendukung tumbuh kembang anak melalui aktivitas bermain yang menyenangkan dan penuh makna. Kami percaya setiap anak itu unik, dan melalui kelas ini, mereka diajak belajar, bermain, dan tumbuh bersama dalam lingkungan yang aman dan penuh kasih. Yuk, kenalkan si kecil pada dunia belajar yang seru dan interaktif bersama Rumah Samoedra!',
                'program_image' => 'images/assets/img_detail_layanan.png',
                'kegiatan_title' => 'Kegiatan Kelas Stimulasi Rumah Samoedra',
                'kegiatan' => [
                    [
                        'name' => 'ADAPTASI SOSIAL',
                        'description' => "Diskusi tentang pengalaman bulan Puasa & Lebaran\n⁠Praktik Bersalaman dan Bermaaf maafan\n⁠Berkenalan dengan teman baru\nMenjawab pertanyaan sederhana"
                    ],
                    [
                        'name' => 'LOGIKA MATEMATIKA',
                        'description' => "⁠Meniru bentuk sebuah pola menggunakan stick\nBelajar mengenal waktu Tahun, Bulan, Minggu, Hari, Jam menggunakan kalender dan jam dinding"
                    ],
                    [
                        'name' => 'FISIK MOTORIK',
                        'description' => "Melewati rintangan sensory path\nBermain lompat karet"
                    ],
                    [
                        'name' => 'KREATIFITAS',
                        'description' => "⁠Melengkapi setengah gambar dengan cara meniru gambar di sebelahnya"
                    ],
                    [
                        'name' => 'FOKUS & KESEIMBANGAN',
                        'description' => "menggulung tali dan melepaskan jepitan\nmenarik bola dalam lingkaran & melemparnya"
                    ]
                ],
                'fasilitas' => [
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
                    ]
                ],
                'age_range' => '6 bln - 12 y.o',
                'hours' => '9.00-17.00',
                'days' => 'Senin-Sabtu',
                'price' => 'Rp. 375.000',
                'meetings' => '4x Pertemuan',
                'registration_fee' => 'Rp. 50.000',
                'program' => [
                    'points' => [
                        'Pembelajaran melalui bermain',
                        'Fokus pada perkembangan motorik',
                        'Peningkatan kemampuan sosial',
                        'Aktivitas kreatif dan eksplorasi',
                        'Lingkungan yang aman dan menyenangkan'
                    ]
                ]
            ];
        }

        return $data;
    }
}
