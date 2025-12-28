<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KnowledgeBase;
use Illuminate\Http\Request;

class KnowledgeBaseController extends Controller
{
    public function index()
    {
        // Mengambil solusi yang butuh verifikasi (paling atas) dan yang sudah diverifikasi
        $kb = KnowledgeBase::latest()->paginate(10);
        return view('admin.kb.index', compact('kb'));
    }

    public function verify($id)
    {
        $kb = KnowledgeBase::findOrFail($id);
        
        // Admin memverifikasi agar data ini masuk ke database cerdas/public
        $kb->update(['is_verified' => true]);

        return redirect()->back()->with('success', 'Solusi telah diverifikasi dan masuk ke sistem rekomendasi.');
    }

    public function destroy($id)
    {
        KnowledgeBase::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data solusi berhasil dihapus.');
    }
}