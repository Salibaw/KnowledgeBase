<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Ticket;
use App\Models\KnowledgeBase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        $data = [
            'total_pelanggan' => User::where('role', 'pelanggan')->count(),
            'total_teknisi'   => User::where('role', 'teknisi')->count(),
            'tiket_baru'      => Ticket::where('status', 'open')->count(),
            'tiket_proses'    => Ticket::where('status', 'processing')->count(),
            'tiket_selesai'   => Ticket::where('status', 'resolved')->count(),
            'total_kb'        => KnowledgeBase::where('is_verified', true)->count(),
            // Mengambil 5 tiket terbaru untuk tabel
            'recent_tickets'  => Ticket::with('user')->latest()->take(5)->get()
        ];

        return view('admin.dashboard', $data);
    }

    public function teknisi()
    {
        $userId = Auth::id();

        $data = [
            'tugas_baru'    => Ticket::where('user_id', $userId)->where('status', 'processing')->count(),
            'tugas_selesai' => Ticket::where('user_id', $userId)->where('status', 'resolved')->count(),
            // Mengambil 5 tugas terakhir yang belum selesai
            'active_tasks'  => Ticket::with('user')
                                ->where('user_id', $userId)
                                ->where('status', 'processing')
                                ->latest()
                                ->take(5)
                                ->get()
        ];

        return view('teknisi.dashboard', $data);
    }
}