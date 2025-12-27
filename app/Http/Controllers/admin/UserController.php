<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Mengambil semua data user [cite: 325]
        return view('admin.users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete(); // Menghapus user [cite: 325]
        return redirect()->back()->with('success', 'User berhasil dihapus');
    }
    public function logs()
{
    // Mengambil log terbaru beserta data user terkait
    $logs = \App\Models\LogHistory::with('user')->latest()->paginate(10);
    return view('admin.logs.index', compact('logs'));
}
}