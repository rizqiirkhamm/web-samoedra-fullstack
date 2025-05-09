<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\PermissionRoleModel;

class EventEditController extends Controller
{
    public function index()
    {
        // Check permission untuk edit event
        $permissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Event');
        if (empty($permissionRole)) {
            abort(404);
        }

        $jsonPath = storage_path('app/public/event/data.json');
        $data = [];

        if (file_exists($jsonPath)) {
            $data = json_decode(file_get_contents($jsonPath), true);
        }

        return view('users.event-edit', compact('data'));
    }

    public function update(Request $request)
    {
        // Check permission untuk edit event
        $permissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Edit Event');
        if (empty($permissionRole)) {
            abort(404);
        }

        $jsonPath = storage_path('app/public/event/data.json');
        $data = [];

        if (file_exists($jsonPath)) {
            $data = json_decode(file_get_contents($jsonPath), true);
        }

        try {
            // Validasi input untuk events
            if ($request->has('events')) {
                // Batasi jumlah event maksimal 4
                if (count($request->events) > 4) {
                    return redirect()->back()
                        ->with('error', 'Maksimal hanya boleh ada 4 event. Silakan hapus beberapa event.')
                        ->withInput();
                }

                // Kumpulkan hanya event yang memiliki banner_type untuk validasi
                $validEvents = [];
                foreach ($request->events as $index => $event) {
                    if (isset($event['banner_type'])) {
                        $validEvents[$index] = $event;
                    }
                }

                // Jika tidak ada event valid, hentikan proses
                if (empty($validEvents)) {
                    return redirect()->back()
                        ->with('error', 'Tidak ada event valid untuk disimpan.')
                        ->withInput();
                }

                // Validasi hanya event yang valid
                $validator = \Illuminate\Support\Facades\Validator::make(['events' => $validEvents], [
                    'events' => 'required|array|max:4',
                    'events.*.banner_type' => 'required|in:image,video',
                    'events.*.event_title' => 'nullable|string',
                    'events.*.descriptions' => 'nullable|array',
                    'events.*.descriptions.*.title' => 'required_with:events.*.descriptions|string',
                    'events.*.descriptions.*.content' => 'required_with:events.*.descriptions|string',
                    'events.*.about_event.usia' => 'nullable|string',
                    'events.*.about_event.biaya' => 'nullable|string',
                    'events.*.about_event.tanggal' => 'nullable|string',
                    'events.*.about_event.kegiatan' => 'nullable|string',
                    'events.*.about_event.created_at' => 'nullable|string',
                    'events.*.about_event.activities' => 'nullable|array',
                    'events.*.about_event.activities.*' => 'nullable|string',
                    'events.*.banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                    'events.*.banner_video' => 'nullable|string',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput()
                        ->with('error', 'Terjadi kesalahan validasi data.');
                }

                // Simpan data events yang lama jika ada
                $oldEvents = isset($data['events']) ? $data['events'] : [];
                $newEvents = [];

                // Process each event
                foreach ($request->events as $index => $eventData) {
                    // Skip event jika tidak memiliki data yang cukup
                    if (!isset($eventData['banner_type'])) {
                        continue;
                    }

                    $event = [
                        'banner_type' => $eventData['banner_type'],
                        'event_title' => $eventData['event_title'] ?? 'Event Baru',
                        'banner_video' => $eventData['banner_video'] ?? null,
                        'descriptions' => [],
                        'about_event' => [
                            'usia' => isset($eventData['about_event']) && isset($eventData['about_event']['usia']) ? $eventData['about_event']['usia'] : 'Semua Usia',
                            'biaya' => isset($eventData['about_event']) && isset($eventData['about_event']['biaya']) ? $eventData['about_event']['biaya'] : 'Hubungi Admin',
                            'tanggal' => isset($eventData['about_event']) && isset($eventData['about_event']['tanggal']) ? $eventData['about_event']['tanggal'] : date('d M Y'),
                            'kegiatan' => isset($eventData['about_event']) && isset($eventData['about_event']['kegiatan']) ? $eventData['about_event']['kegiatan'] : 'Event',
                            'created_at' => isset($eventData['about_event']) && isset($eventData['about_event']['created_at']) ? $eventData['about_event']['created_at'] : date('Y-m-d\TH:i'),
                            'activities' => isset($eventData['about_event']) && isset($eventData['about_event']['activities']) ? $eventData['about_event']['activities'] : []
                        ]
                    ];

                    // Handle banner image upload
                    if (isset($eventData['banner_image']) && $eventData['banner_image'] instanceof \Illuminate\Http\UploadedFile) {
                        // Delete old image if exists and not default
                        if (isset($oldEvents[$index]['banner_image']) && !str_contains($oldEvents[$index]['banner_image'], 'assets/img.png')) {
                            $oldPath = str_replace('storage/', '', $oldEvents[$index]['banner_image']);
                            if (Storage::disk('public')->exists($oldPath)) {
                                Storage::disk('public')->delete($oldPath);
                            }
                        }

                        $path = $eventData['banner_image']->store('event', 'public');
                        $event['banner_image'] = 'storage/' . $path;
                    } elseif (isset($oldEvents[$index]['banner_image'])) {
                        // Gunakan gambar lama jika ada
                        $event['banner_image'] = $oldEvents[$index]['banner_image'];
                    } else {
                        // Gunakan default jika tidak ada
                        $event['banner_image'] = 'images/assets/img_layanan.png';
                    }

                    // Process descriptions
                    if (isset($eventData['descriptions']) && is_array($eventData['descriptions'])) {
                        foreach ($eventData['descriptions'] as $description) {
                            if (isset($description['title']) && isset($description['content'])) {
                                $event['descriptions'][] = [
                                    'title' => $description['title'],
                                    'content' => $description['content']
                                ];
                            }
                        }
                    }

                    // Tambahkan deskripsi default jika tidak ada
                    if (empty($event['descriptions'])) {
                        $event['descriptions'][] = [
                            'title' => 'Deskripsi',
                            'content' => 'Informasi lengkap event akan segera diupdate.'
                        ];
                    }

                    $newEvents[] = $event;
                }

                $data['events'] = $newEvents;
            }

            // Validasi dan update data kerja sama
            if ($request->has('collaboration')) {
                $request->validate([
                    'collaboration.title' => 'required|string',
                    'collaboration.subtitle' => 'required|string',
                    'collaboration.description' => 'required|string',
                    'collaboration.contact.whatsapp' => 'required|string',
                    'collaboration.contact.message' => 'required|string',
                    'collaboration.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                ]);

                // Simpan data kolaborasi lama
                $oldCollaboration = isset($data['collaboration']) ? $data['collaboration'] : [];

                // Update data kerja sama
                $collaboration = [
                    'title' => $request->input('collaboration.title'),
                    'subtitle' => $request->input('collaboration.subtitle'),
                    'description' => $request->input('collaboration.description'),
                    'contact' => [
                        'whatsapp' => $request->input('collaboration.contact.whatsapp'),
                        'message' => $request->input('collaboration.contact.message'),
                    ],
                ];

                // Handle image upload
                if ($request->hasFile('collaboration.image')) {
                    // Delete old image if exists and not default
                    if (isset($oldCollaboration['image']) && !str_contains($oldCollaboration['image'], 'assets/img.png')) {
                        $oldPath = str_replace('storage/', '', $oldCollaboration['image']);
                        if (Storage::disk('public')->exists($oldPath)) {
                            Storage::disk('public')->delete($oldPath);
                        }
                    }

                    $path = $request->file('collaboration.image')->store('event', 'public');
                    $collaboration['image'] = 'storage/' . $path;
                } elseif (isset($oldCollaboration['image'])) {
                    // Gunakan gambar lama jika tidak ada upload baru
                    $collaboration['image'] = $oldCollaboration['image'];
                } else {
                    // Gunakan default jika tidak ada
                    $collaboration['image'] = 'assets/img.png';
                }

                $data['collaboration'] = $collaboration;
            }

            // Create directory if it doesn't exist
            if (!file_exists(dirname($jsonPath))) {
                mkdir(dirname($jsonPath), 0755, true);
            }

            // Save to JSON file
            file_put_contents($jsonPath, json_encode($data, JSON_PRETTY_PRINT));

            return redirect()->back()->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage())
                ->withInput();
        }
    }
}
