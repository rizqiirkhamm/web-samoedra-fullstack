<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use App\Models\PermissionRoleModel;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::where('status', 'active')
            ->orderBy('urutan', 'asc')
            ->get();
        return view('faq', compact('faqs'));
    }

    public function adminIndex()
    {
        $PermissionFaq = PermissionRoleModel::getPermission(Auth::user()->role_id, 'FAQ');
        if(empty($PermissionFaq)) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman FAQ');
        }

        $faqs = Faq::orderBy('urutan', 'asc')->get();
        return view('users.faq.index', compact('faqs'));
    }

    public function create()
    {
        $PermissionFaq = PermissionRoleModel::getPermission(Auth::user()->role_id, 'FAQ');
        if(empty($PermissionFaq)) {
            return redirect()->route('faq.admin.index')->with('error', 'Anda tidak memiliki akses untuk menambah FAQ');
        }

        return view('users.faq.create');
    }

    public function store(Request $request)
    {
        $PermissionFaq = PermissionRoleModel::getPermission(Auth::user()->role_id, 'FAQ');
        if(empty($PermissionFaq)) {
            return redirect()->route('faq.admin.index')->with('error', 'Anda tidak memiliki akses untuk menambah FAQ');
        }

        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'urutan' => 'required|integer|min:0|unique:faqs,urutan',
            'status' => 'required|in:active,inactive'
        ]);

        Faq::create($request->all());

        return redirect()->route('faq.admin.index')
            ->with('success', 'FAQ berhasil ditambahkan');
    }

    public function edit(Faq $faq)
    {
        $PermissionFaq = PermissionRoleModel::getPermission(Auth::user()->role_id, 'FAQ');
        if(empty($PermissionFaq)) {
            return redirect()->route('faq.admin.index')->with('error', 'Anda tidak memiliki akses untuk mengedit FAQ');
        }

        return view('users.faq.edit', compact('faq'));
    }

    public function update(Request $request, Faq $faq)
    {
        $PermissionFaq = PermissionRoleModel::getPermission(Auth::user()->role_id, 'FAQ');
        if(empty($PermissionFaq)) {
            return redirect()->route('faq.admin.index')->with('error', 'Anda tidak memiliki akses untuk mengedit FAQ');
        }

        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'jawaban' => 'required|string',
            'urutan' => 'required|integer|min:0|unique:faqs,urutan,' . $faq->id,
            'status' => 'required|in:active,inactive'
        ]);

        $faq->update($request->all());

        return redirect()->route('faq.admin.index')
            ->with('success', 'FAQ berhasil diperbarui');
    }

    public function destroy(Faq $faq)
    {
        $PermissionFaq = PermissionRoleModel::getPermission(Auth::user()->role_id, 'FAQ');
        if(empty($PermissionFaq)) {
            return redirect()->route('faq.admin.index')->with('error', 'Anda tidak memiliki akses untuk menghapus FAQ');
        }

        $faq->delete();

        return redirect()->route('faq.admin.index')
            ->with('success', 'FAQ berhasil dihapus');
    }

    public function updateImage(Request $request)
    {
        $PermissionFaq = PermissionRoleModel::getPermission(Auth::user()->role_id, 'FAQ');
        if(empty($PermissionFaq)) {
            return redirect()->route('faq.admin.index')->with('error', 'Anda tidak memiliki akses untuk mengedit FAQ');
        }

        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = 'faq.png';
            $image->move(public_path('images/faq'), $imageName);
        }

        return redirect()->route('faq.admin.index')->with('success', 'Gambar FAQ berhasil diperbarui');
    }
}
