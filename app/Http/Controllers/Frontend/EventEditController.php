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
        $request->validate([
            'events' => 'required|array',
            'events.*.banner_type' => 'required|in:image,video',
            'events.*.event_title' => 'required|string',
            'events.*.descriptions' => 'required|array',
            'events.*.descriptions.*.title' => 'required|string',
            'events.*.descriptions.*.content' => 'required|string',
            'events.*.about_event.usia' => 'required|string',
            'events.*.about_event.biaya' => 'required|string',
            'events.*.about_event.tanggal' => 'required|string',
            'events.*.about_event.kegiatan' => 'required|string',
                    'events.*.about_event.created_at' => 'required|string',
            'events.*.about_event.activities' => 'required|array',
            'events.*.about_event.activities.*' => 'required|string',
            'events.*.banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'events.*.banner_video' => 'nullable|string|url',
        ]);

                // Simpan data events yang lama jika ada
                $oldEvents = isset($data['events']) ? $data['events'] : [];
                $newEvents = [];

            // Process each event
            foreach ($request->events as $index => $eventData) {
                $event = [
                    'banner_type' => $eventData['banner_type'],
                    'event_title' => $eventData['event_title'],
                    'banner_video' => $eventData['banner_video'] ?? null,
                    'descriptions' => [],
                    'about_event' => [
                        'usia' => $eventData['about_event']['usia'],
                        'biaya' => $eventData['about_event']['biaya'],
                        'tanggal' => $eventData['about_event']['tanggal'],
                        'kegiatan' => $eventData['about_event']['kegiatan'],
                            'created_at' => $eventData['about_event']['created_at'],
                        'activities' => $eventData['about_event']['activities'] ?? []
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
                        $event['banner_image'] = 'assets/img.png';
                }

                // Process descriptions
                if (isset($eventData['descriptions'])) {
                    foreach ($eventData['descriptions'] as $description) {
                        $event['descriptions'][] = [
                            'title' => $description['title'],
                            'content' => $description['content']
                        ];
                    }
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
