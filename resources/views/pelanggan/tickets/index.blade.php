@extends('layouts.app')

@section('header_title', 'Riwayat Laporan Saya')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h3 class="text-xl font-bold text-slate-800">Daftar Tiket</h3>
            <p class="text-sm text-slate-500">Pantau perkembangan perbaikan koneksi internet Anda.</p>
        </div>
        <a href="{{ route('pelanggan.tickets.create') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-2xl font-bold text-sm shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition flex items-center justify-center gap-2">
            <i class="fas fa-plus"></i>
            Buat Laporan Baru
        </a>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-widest">
                    <tr>
                        <th class="px-6 py-4">Informasi Tiket</th>
                        <th class="px-6 py-4">Masalah</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Status Terkini</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($tickets as $ticket)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="text-indigo-600 font-mono font-bold text-sm mb-1">
                                {{ $ticket->ticket_code }}
                            </div>
                            <div class="text-[10px] text-slate-400">
                                <i class="far fa-calendar-alt mr-1"></i> {{ $ticket->created_at->format('d M Y') }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-bold text-slate-800">{{ $ticket->title }}</div>
                            <div class="text-xs text-slate-500 line-clamp-1 italic">{{ $ticket->description }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-xs text-slate-600 bg-slate-100 px-3 py-1 rounded-lg">
                                {{ $ticket->category->name ?? 'Umum' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase 
                                {{ $ticket->status == 'open' ? 'bg-blue-100 text-blue-600' : 
                                  ($ticket->status == 'processing' ? 'bg-amber-100 text-amber-600 animate-pulse' : 
                                  'bg-emerald-100 text-emerald-600') }}">
                                <i class="fas {{ $ticket->status == 'resolved' ? 'fa-check-circle' : 'fa-circle' }} mr-1"></i>
                                {{ $ticket->status == 'open' ? 'Menunggu' : ($ticket->status == 'processing' ? 'Diproses' : 'Selesai') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="#" class="inline-flex items-center justify-center w-10 h-10 bg-slate-50 text-slate-400 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-20 h-20 bg-slate-50 text-slate-200 rounded-full flex items-center justify-center text-4xl mb-4">
                                    <i class="fas fa-ticket-alt"></i>
                                </div>
                                <p class="text-slate-400 italic text-sm">Anda belum memiliki riwayat laporan gangguan.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($tickets->hasPages())
        <div class="px-6 py-4 border-t border-gray-50">
            {{ $tickets->links() }}
        </div>
        @endif
    </div>
</div>
@endsection