<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KnowledgeBase;

class LandingController extends Controller
{
    public function index()
    {
        // Mengambil beberapa solusi populer dari basis pengetahuan untuk ditampilkan
        $faqs = KnowledgeBase::where('is_verified', true)->latest()->take(3)->get();
        return view('landingpage', compact('faqs'));
    }

    public function kb()
    {
        // Hanya menampilkan solusi yang sudah divalidasi oleh admin
        $kb = KnowledgeBase::where('is_verified', true)->latest()->get();
        return view('kb.index', compact('kb'));
    }

    public function show($id)
    {
        $item = KnowledgeBase::where('is_verified', true)->findOrFail($id);
        return view('kb.show', compact('item'));
    }
}