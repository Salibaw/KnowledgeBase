@extends('layouts.app')

@section('header_title', 'Admin Overview')

@section('content')
<div class="space-y-8">
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center text-2xl">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Pelanggan</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $total_pelanggan }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-2xl">
                <i class="fas fa-ticket-alt"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Tiket Baru (Open)</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $tiket_baru }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-2xl">
                <i class="fas fa-tools"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Dalam Perbaikan</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $tiket_proses }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl">
                <i class="fas fa-check-circle"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Selesai Ditangani</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $tiket_selesai }}</h3>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex justify-between items-center">
                <h3 class="font-bold text-slate-800">Tiket Masuk Terbaru</h3>
                <a href="{{ route('admin.tickets.index') }}" class="text-xs font-bold text-indigo-600 hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-widest">
                        <tr>
                            <th class="px-6 py-4">Pelanggan</th>
                            <th class="px-6 py-4">Masalah</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($recent_tickets as $ticket)
                        <tr class="hover:bg-slate-50/50 transition">
                            <td class="px-6 py-4">
                                <span class="text-sm font-semibold text-slate-700">{{ $ticket->user->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-slate-500">{{ Str::limit($ticket->subject, 30) }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($ticket->status == 'open')
                                    <span class="px-3 py-1 bg-amber-100 text-amber-600 rounded-full text-[10px] font-bold uppercase">New</span>
                                @elseif($ticket->status == 'processing')
                                    <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-[10px] font-bold uppercase">Proses</span>
                                @else
                                    <span class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-full text-[10px] font-bold uppercase">Solved</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-400">
                                {{ $ticket->created_at->diffForHumans() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-indigo-600 rounded-3xl p-8 text-white relative overflow-hidden shadow-xl shadow-indigo-200">
            <div class="relative z-10">
                <i class="fas fa-book-open text-4xl mb-6 opacity-50"></i>
                <h3 class="text-xl font-bold mb-2">Basis Pengetahuan</h3>
                <p class="text-indigo-100 text-sm mb-6 leading-relaxed">
                    Saat ini tersedia <strong>{{ $total_kb }} solusi</strong> terverifikasi untuk membantu pelanggan secara mandiri.
                </p>
                <a href="{{ route('admin.knowledge-base.index') }}" class="inline-block bg-white text-indigo-600 px-6 py-3 rounded-xl font-bold text-sm shadow-lg hover:bg-indigo-50 transition">
                    Kelola Solusi
                </a>
            </div>
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full"></div>
        </div>
    </div>
</div>
@endsection