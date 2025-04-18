<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\EventModel;
use App\Models\PermissionRoleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        // Check permission untuk akses Article
        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Article');
        if (empty($PermissionRole)) {
            abort(404);
        }

        // Get permission untuk actions
        $data['PermissionDetail'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Article Detail');
        $data['PermissionEdit'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Article Edit');
        $data['PermissionDelete'] = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Article Delete');

        // Search functionality
        $query = Article::latest();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                ->orWhere('category', 'like', "%{$search}%")
                ->orWhere('content', 'like', "%{$search}%");
        }

        $data['articles'] = $query->paginate(10);
        $data['events'] = EventModel::all();

        return view('users.article.article-master', $data);
    }

    public function store(Request $request)
    {
        // Check permission untuk akses Article
        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Article');
        if (empty($PermissionRole)) {
            abort(404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:events,id',
            'tags' => 'nullable|string',
        ]);

        // Upload gambar
        $imagePath = $request->file('image')->store('articles', 'public');

        // Proses tags
        $tags = $request->tags ? explode(',', $request->tags) : [];
        $tags = array_map('trim', $tags);

        // Proses konten dari Summernote
        $content = $request->content;

        // Buat slug dari title
        $slug = Str::slug($request->title) . '-' . time();

        Article::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $content,
            'image' => $imagePath,
            'category_id' => $request->category_id,
            'tags' => $tags,
        ]);

        return redirect()->route('article.master')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function show($id)
    {
        // Check permission untuk Article Detail
        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Article Detail');
        if (empty($PermissionRole)) {
            abort(404);
        }

        $article = Article::findOrFail($id);
        $previousArticle = Article::where('id', '<', $id)
            ->orderBy('id', 'desc')
            ->first();

        $nextArticle = Article::where('id', '>', $id)
            ->orderBy('id', 'asc')
            ->first();

        return view('users.article.article-detail', compact('article', 'previousArticle', 'nextArticle'));
    }

    public function edit($id)
    {
        // Check permission untuk Article Edit
        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Article Edit');
        if (empty($PermissionRole)) {
            abort(404);
        }

        $article = Article::findOrFail($id);
        $events = EventModel::all();
        return view('users.article.edit-article', compact('article', 'events'));
    }

    public function update(Request $request, $id)
    {
        // Check permission untuk Article Edit
        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Article Edit');
        if (empty($PermissionRole)) {
            abort(404);
        }

        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:events,id',
            'tags' => 'nullable|string',
        ]);

        // Update data artikel
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
        ];

        // Jika title berubah, update slug
        if ($article->title != $request->title) {
            $data['slug'] = Str::slug($request->title) . '-' . time();
        }

        // Jika ada gambar baru
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            Storage::disk('public')->delete($article->image);

            // Upload gambar baru
            $data['image'] = $request->file('image')->store('articles', 'public');
        }

        // Proses tags
        if ($request->has('tags')) {
            $tags = $request->tags ? explode(',', $request->tags) : [];
            $data['tags'] = array_map('trim', $tags);
        }

        $article->update($data);

        return redirect()->route('article.master')->with('success', 'Artikel berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Check permission untuk Article Delete
        $PermissionRole = PermissionRoleModel::getPermission(Auth::user()->role_id, 'Article Delete');
        if (empty($PermissionRole)) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $article = Article::findOrFail($id);
        // Hapus gambar dari storage
        Storage::disk('public')->delete($article->image);

        // Hapus artikel
        $article->delete();

        return redirect()->route('article.master')->with('success', 'Artikel berhasil dihapus');
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            try {
                $file = $request->file('image');

                // Validasi file
                $validator = \Illuminate\Support\Facades\Validator::make(['image' => $file], [
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
                ]);

                if ($validator->fails()) {
                    return response()->json(['error' => 'File tidak valid. Gunakan format gambar (JPG, PNG, GIF) dengan ukuran maksimal 2MB.'], 422);
                }

                // Generate nama file yang aman
                $fileName = time() . '_' . \Illuminate\Support\Str::slug($file->getClientOriginalName());

                // Simpan file ke folder article_images di dalam storage/app/public
                $path = $file->storeAs('article_images', $fileName, 'public');

                if (!$path) {
                    return response()->json(['error' => 'Gagal menyimpan file.'], 500);
                }

                // Return URL gambar yang benar
                return response()->json([
                    'url' => asset('storage/' . $path)
                ]);
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Error uploading image: ' . $e->getMessage());
                return response()->json(['error' => 'Terjadi kesalahan saat upload gambar.'], 500);
            }
        }

        return response()->json(['error' => 'Tidak ada file yang diupload.'], 400);
    }
}
