<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KnowledgeBase;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with(['user', 'technician']);

        // Fitur Search berdasarkan Judul atau Nama Pelanggan
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhereHas('user', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%');
                });
        }

        $tickets = $query->latest()->paginate(10);

        // Mengambil daftar user yang rolenya 'teknisi' untuk dipilih admin
        $technicians = User::where('role', 'teknisi')->get();

        return view('admin.ticket.index', compact('tickets', 'technicians'));
    }

    public function assign(Request $request, $id)
    {
        $request->validate([
            'technician_id' => 'required|exists:users,id'
        ]);

        $ticket = Ticket::findOrFail($id);

        // Update tiket: Isi teknisi dan ubah status menjadi processing
        $ticket->update([
            'technician_id' => $request->technician_id,
            'status' => 'processing'
        ]);

        return redirect()->back()
            ->with('success', 'Teknisi ' . $ticket->technician->name . ' berhasil ditugaskan.');
    }
    public function pelanggan()
    {
        $tickets = Ticket::where('user_id', Auth::id())->latest()->paginate(10);
        return view('pelanggan.tickets.index', compact('tickets'));
    }

    public function create_pelanggan()
    {
        return view('user.tickets.create');
    }

    /**
     * Fungsi untuk rekomendasi solusi otomatis menggunakan logika pencarian teks sederhana
     * (Ini adalah dasar sebelum Anda memasukkan rumus TF-IDF lengkap)
     */
    public function getRecommendation(Request $request)
    {
        $text = $request->text;
        if (empty($text)) return response()->json([]);

        // TAHAP 1: PREPROCESSING SEDERHANA
        // 1. Case Folding (Kecilkan semua huruf)
        $cleanText = strtolower($text);
        // 2. Filtering (Hapus tanda baca)
        $cleanText = preg_replace('/[^\p{L}\p{N}\s]/u', '', $cleanText);

        // TAHAP 2: PENCARIAN KEMIRIPAN (Disederhanakan)
        // Di skripsi Anda, bagian ini akan diganti dengan kodingan rumus TF-IDF & Cosine Similarity
        $suggestions = KnowledgeBase::where('is_verified', true)
            ->where(function ($q) use ($cleanText) {
                $q->where('problem_title', 'like', "%$cleanText%")
                    ->orWhere('keyword', 'like', "%$cleanText%");
            })
            ->take(3)
            ->get();

        return response()->json($suggestions);
    }

    public function store_pelanggan(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'problem_description' => 'required',
            'priority' => 'required|in:low,medium,high',
        ]);

        Ticket::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'problem_description' => $request->problem_description,
            'priority' => $request->priority,
            'status' => 'open',
        ]);

        return redirect()->route('pelanggan.tickets.index')
            ->with('success', 'Laporan Anda telah terkirim. Teknisi Violet Net akan segera memeriksa.');
    }
}
