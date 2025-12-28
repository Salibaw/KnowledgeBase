<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\KnowledgeBase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        // Mengambil tiket yang ditugaskan ke teknisi yang sedang login
        $assignments = Ticket::where('technician_id', Auth::id())
            ->whereIn('status', ['processing', 'resolved'])
            ->latest()
            ->paginate(10);
            
        return view('teknisi.assignments.index', compact('assignments'));
    }

    public function solve(Request $request, $id)
    {
        $request->validate([
            'solution' => 'required|min:20',
        ]);

        $ticket = Ticket::findOrFail($id);
        
        // 1. Update status tiket menjadi selesai
        $ticket->update(['status' => 'resolved']);

        // 2. Simpan ke tabel Knowledge Base (is_verified = false)
        // Admin harus memverifikasi ini sebelum masuk ke sistem AI
        KnowledgeBase::create([
            'problem_title' => $ticket->title,
            'problem_description' => $ticket->problem_description,
            'solution' => $request->solution,
            'category_id' => $ticket->category_id,
            'is_verified' => false,
            'created_by' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Solusi berhasil disimpan. Menunggu verifikasi admin.');
    }
}