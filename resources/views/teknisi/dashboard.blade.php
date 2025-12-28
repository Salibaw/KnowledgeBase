@extends('layouts.app')

@section('header_title', 'Dashboard Teknisi')

@section('content')
<div class="space-y-8">
    
    <div class="bg-indigo-700 rounded-3xl p-8 text-white shadow-xl shadow-indigo-100 relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-2xl font-bold">Halo, {{ Auth::user()->name }}! 👋</h2>
            <p class="text-indigo-100 mt-2 opacity-90 text-sm">Anda memiliki {{ $tugas_baru }} tugas perbaikan yang perlu segera diselesaikan hari ini.</p>
        </div>
        <i class="fas fa-tools absolute -right-5 -bottom-5 text-9xl text-white/10 rotate-12"></i>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center text-2xl">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Tugas Pending</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $tugas_baru }}</h3>
            </div>
        </div>

        <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm flex items-center gap-5">
            <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl">
                <i class="fas fa-check-circle"></i>
            </div>
            <div>
                <p class="text-sm font-medium text-slate-500">Total Selesai</p>
                <h3 class="text-2xl font-bold text-slate-800">{{ $tugas_selesai }}</h3>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
            <h3 class="font-bold text-slate-800">Tugas Perbaikan Saat Ini</h3>
            <a href="{{ route('teknisi.assignments.index') }}" class="text-xs font-bold text-indigo-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-widest">
                    <tr>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Masalah</th>
                        <th class="px-6 py-4">Prioritas</th>
                        <th class="px-6 py-4">Waktu Masuk</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($active_tasks as $task)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-4">
                            <span class="text-sm font-semibold text-slate-700 block">{{ $task->user->name }}</span>
                            <span class="text-[10px] text-slate-400 italic">ID Tiket: #{{ $task->id }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm text-slate-600">{{ Str::limit($task->title, 40) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase 
                                {{ $task->priority == 'high' ? 'bg-red-100 text-red-600' : 'bg-blue-100 text-blue-600' }}">
                                {{ $task->priority }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-xs text-slate-400 italic">
                            {{ $task->updated_at->diffForHumans() }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-slate-400 italic text-sm">
                            Tidak ada tugas pending. Kerja bagus! 🚀
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection