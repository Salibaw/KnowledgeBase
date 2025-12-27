<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\KnowledgeBase;
use Illuminate\Http\Request;

class KnowledgeBaseController extends Controller
{
    public function index()
    {
        // Menampilkan data basis pengetahuan sesuai Gambar 3.19 [cite: 824]
        $kb = KnowledgeBase::latest()->get();
        return view('admin.knowledge_base.index', compact('kb'));
    }

    public function verify($id)
    {
        $kb = KnowledgeBase::findOrFail($id);
        $kb->update(['is_verified' => true]); // Verifikasi solusi teknisi [cite: 825]
        
        return redirect()->back()->with('success', 'Solusi telah diverifikasi dan aktif');
    }
}