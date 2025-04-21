<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing galleries first
        Gallery::truncate();
        Log::info('Cleared existing galleries');

        // Create the storage directory if it doesn't exist
        if (!Storage::disk('public')->exists('galleries')) {
            Storage::disk('public')->makeDirectory('galleries');
            Log::info('Created galleries directory in storage');
        }

        // Sample galleries - Note: category MUST be exactly 'Daycare' for the ones that should appear
        $galleries = [
            [
                'title' => 'Ruang Bermain Daycare',
                'category' => 'Daycare', // Exact match is important
                'image' => 'galleries/daycare1.jpg'
            ],
            [
                'title' => 'Waktu Istirahat di Daycare',
                'category' => 'Daycare', // Exact match is important
                'image' => 'galleries/daycare2.jpg'
            ],
            [
                'title' => 'Kegiatan Belajar di Daycare',
                'category' => 'Daycare', // Exact match is important
                'image' => 'galleries/daycare3.jpg'
            ],
            [
                'title' => 'Area Bermain Outdoor',
                'category' => 'Area Main',
                'image' => 'galleries/area_main1.jpg'
            ],
            [
                'title' => 'Ruang Bimbel Matematika',
                'category' => 'Bimbel',
                'image' => 'galleries/bimbel1.jpg'
            ],
            [
                'title' => 'Kelas Stimulasi Musik',
                'category' => 'Kelas Stimulasi',
                'image' => 'galleries/stimulasi1.jpg'
            ],
            [
                'title' => 'Event Hari Anak',
                'category' => 'Event',
                'image' => 'galleries/event1.jpg'
            ]
        ];

        // Copy sample images from public/images/assets to storage/app/public/galleries
        $sourcePath = public_path('images/assets');
        $destinationPath = storage_path('app/public/galleries');

        // Make sure the destination directory exists
        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
            Log::info('Created galleries directory in storage/app/public');
        }

        foreach ($galleries as $gallery) {
            // Use placeholder image if specific image doesn't exist
            $sourceImage = File::exists($sourcePath . '/img_layanan.png')
                ? $sourcePath . '/img_layanan.png'
                : $sourcePath . '/img.png';

            if (!File::exists($sourceImage)) {
                Log::warning('Source image not found, using default placeholder');
                $sourceImage = public_path('images/assets/img.png');

                if (!File::exists($sourceImage)) {
                    Log::error('No placeholder images found. Creating empty file.');
                    file_put_contents($destinationPath . '/' . basename($gallery['image']), '');
                    continue;
                }
            }

            $fileName = basename($gallery['image']);
            File::copy($sourceImage, $destinationPath . '/' . $fileName);

            Gallery::create([
                'title' => $gallery['title'],
                'category' => $gallery['category'],
                'image' => $gallery['image']
            ]);

            Log::info('Created gallery: ' . $gallery['title'] . ' with category: ' . $gallery['category']);
        }

        // Verify created galleries
        $daycareCount = Gallery::where('category', 'Daycare')->count();
        Log::info('Total Daycare galleries created: ' . $daycareCount);
        $allCategories = Gallery::select('category')->distinct()->pluck('category')->toArray();
        Log::info('All categories created: ' . implode(', ', $allCategories));
    }
}
