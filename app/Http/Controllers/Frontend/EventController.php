<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Gallery;

class EventController extends Controller
{
    public function index()
    {
        $data = ['events' => [], 'collaboration' => []];
        $jsonPath = storage_path('app/public/event/data.json');

        if (file_exists($jsonPath)) {
            $jsonData = json_decode(file_get_contents($jsonPath), true);
            if (isset($jsonData['events']) && is_array($jsonData['events'])) {
                $data = $jsonData;
            }
        }

        // Ambil data galeri khusus kategori "Event"
        $galleries = Gallery::where('category', 'Event')->latest()->get();

        return view('program.event', compact('data', 'galleries'));
    }
}
