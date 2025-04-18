<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{

    public function index()
    {
        $galleries = Gallery::latest()->paginate(9);
        $canEdit = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Gallery Edit');
        $canDelete = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Gallery Delete');
        return view('users.article.gallery-master', compact('galleries', 'canEdit', 'canDelete'));
    }

    public function store(Request $request)
    {
        if (!PermissionRoleModel::getPermission(Auth::user()->role_id, 'Gallery Edit')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $image = $request->file('image');
        $imagePath = $image->store('galleries', 'public');

        Gallery::create([
            'title' => $request->title,
            'category' => $request->category,
            'image' => $imagePath
        ]);

        return redirect()->back()->with('success', 'Galeri berhasil ditambahkan');
    }

    public function update(Request $request, Gallery $gallery)
    {
        if (!PermissionRoleModel::getPermission(Auth::user()->role_id, 'Gallery Edit')) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = [
            'title' => $request->title,
            'category' => $request->category,
        ];

        if ($request->hasFile('image')) {
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }

            $image = $request->file('image');
            $data['image'] = $image->store('galleries', 'public');
        }

        $gallery->update($data);

        return redirect()->back()->with('success', 'Galeri berhasil diperbarui');
    }

    public function destroy(Gallery $gallery)
    {
        if (!PermissionRoleModel::getPermission(Auth::user()->role_id, 'Gallery Delete')) {
            abort(403, 'Unauthorized action.');
        }

        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }

        $gallery->delete();

        return redirect()->back()->with('success', 'Galeri berhasil dihapus');
    }
}
