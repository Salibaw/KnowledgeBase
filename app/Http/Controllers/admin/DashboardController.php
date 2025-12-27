<?php 
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use App\Models\KnowledgeBase;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_tickets' => Ticket::count(), 
            'total_solved'  => Ticket::where('status', 'selesai')->count(), 
            'awaiting_approval' => Ticket::where('status', 'terbuka')->count(), 
            'in_progress'   => Ticket::where('status', 'diproses')->count(),
            'latest_tickets' => Ticket::with('user')->latest()->take(5)->get()
        ];

        return view('admin.dashboard', $data);
    }
}