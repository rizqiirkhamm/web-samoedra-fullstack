<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadController extends Controller
{
    /**
     * Handle image upload from TinyMCE editor
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('file');
        $filename = 'article-content-' . time() . '-' . Str::random(10) . '.' . $file->getClientOriginalExtension();

        // Simpan file ke storage/public/article-content
        $path = $file->storeAs('article-content', $filename, 'public');

        // Kembalikan URL gambar untuk digunakan oleh TinyMCE
        return response()->json([
            'location' => asset('storage/' . $path)
        ]);
    }
}
