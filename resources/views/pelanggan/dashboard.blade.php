@extends('layouts.app')

@section('header_title', 'Dashboard Pelanggan')

@section('content')
<div class="space-y-8">
    
    <div class="bg-gradient-to-r from-indigo-600 to-violet-700 rounded-3xl p-8 text-white shadow-xl flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="space-y-2">
            <h2 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h2>
            <p class="text-indigo-100 opacity-90 text-sm">Punya kendala dengan koneksi internet Violet Net Anda? Kami siap membantu.</p>
        </div>
        <a href="{{ route('pelanggan.tickets.create') }}" class="bg-white text-indigo-600 px-6 py-4 rounded-2xl font-bold text-sm shadow-lg hover:bg-indigo-50 transition flex items-center gap-2">
            <i class="fas fa-plus-circle"></i>
            Buat Laporan Gangguan
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Semua Tiket</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $total_tiket }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5 border-l-4 border-l-amber-400">
            <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-2xl">
                <i class="fas fa-spinner animate-spin-slow"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Sedang Diproses</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $tiket_proses }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5 border-l-4 border-l-emerald-400">
            <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl">
                <i class="fas fa-check-double"></i>
            </div>
            <div>
                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Sudah Selesai</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $tiket_selesai }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-50">
            <h3 class="font-bold text-slate-800">Riwayat Laporan Terakhir</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-widest">
                    <tr>
                        <th class="px-6 py-4">Kode Tiket</th>
                        <th class="px-6 py-4">Masalah</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm">
                    @forelse($recent_tickets as $ticket)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-4 font-mono font-bold text-indigo-600">
                            {{ $ticket->ticket_code }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-slate-700 block font-medium">{{ $ticket->title }}</span>
                            <span class="text-[10px] text-slate-400 italic">{{ $ticket->created_at->diffForHumans() }}</span>
                        </td>
                        <td class="px-6 py-4 text-slate-500">
                            {{ $ticket->category->name ?? 'Umum' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase 
                                {{ $ticket->status == 'open' ? 'bg-blue-100 text-blue-600' : ($ticket->status == 'processing' ? 'bg-amber-100 text-amber-600' : 'bg-emerald-100 text-emerald-600') }}">
                                {{ $ticket->status }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-slate-400 italic">
                            Belum ada laporan yang dibuat. Klik tombol di atas untuk melapor.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection