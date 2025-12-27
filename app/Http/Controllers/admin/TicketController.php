<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Assignment;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with('user', 'category')->latest()->get(); // Lacak semua tiket [cite: 806, 807]
        $technicians = User::where('role', 'teknisi')->get();
        return view('admin.ticket.index', compact('tickets', 'technicians'));
    }

    public function assign(Request $request, $id)
    {
        $request->validate(['user_id' => 'required']); // Pilih teknisi [cite: 414]

        Assignment::updateOrCreate(
            ['ticket_id' => $id],
            ['user_id' => $request->user_id, 'assigned_at' => now()]
        );

        Ticket::findOrFail($id)->update(['status' => 'diproses']); // Update status jadi diproses [cite: 428]

        return redirect()->back()->with('success', 'Teknisi berhasil ditugaskan');
    }
}