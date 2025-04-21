<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
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
