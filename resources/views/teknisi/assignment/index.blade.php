@extends('layouts.app')

@section('header_title', 'Tugas Perbaikan')

@section('content')
<div x-data="{ openSolve: false, selectedTicket: {} }" class="space-y-6">
    
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-widest">
                    <tr>
                        <th class="px-6 py-4 whitespace-nowrap">Tiket & Pelanggan</th>
                        <th class="px-6 py-4 whitespace-nowrap">Masalah</th>
                        <th class="px-6 py-4 whitespace-nowrap">Status</th>
                        <th class="px-6 py-4 text-center whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($assignments as $task)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-bold text-slate-800">#{{ $task->ticket_code ?? $task->id }}</div>
                            <div class="text-xs text-slate-500">{{ $task->user->name }}</div>
                        </td>
                        <td class="px-6 py-4 min-w-[200px]">
                            <div class="text-sm text-slate-700 font-medium">{{ $task->title }}</div>
                            <div class="text-[11px] text-slate-400 line-clamp-1">{{ Str::limit($task->description, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase 
                                {{ $task->status == 'processing' ? 'bg-blue-100 text-blue-600' : 'bg-emerald-100 text-emerald-600' }}">
                                {{ $task->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if($task->status == 'processing')
                            <button @click="selectedTicket = {{ $task }}; openSolve = true" 
                                class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-indigo-700 transition">
                                Input Solusi
                            </button>
                            @else
                            <span class="text-xs text-emerald-600 font-bold"><i class="fas fa-check-double mr-1"></i> Selesai</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-slate-400 italic text-sm">
                            Tidak ada tugas penugasan untuk Anda saat ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="openSolve" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak 
         class="fixed inset-0 z-[60] flex items-center justify-center bg-slate-900/60 backdrop-blur-sm p-4">
        
        <div class="bg-white w-full max-w-lg rounded-3xl p-6 md:p-8 shadow-2xl overflow-y-auto max-h-[90vh]" 
             @click.away="openSolve = false">
            
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-xl font-bold text-slate-800">Selesaikan Tugas</h3>
                    <p class="text-xs text-slate-500 mt-1" x-text="'Tiket: ' + (selectedTicket.ticket_code || '#' + selectedTicket.id)"></p>
                </div>
                <button @click="openSolve = false" class="text-slate-400 hover:text-slate-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="bg-indigo-50 p-4 rounded-2xl mb-6">
                <p class="text-[10px] font-bold text-indigo-600 uppercase tracking-widest mb-1">Keluhan Pelanggan:</p>
                <p class="text-sm text-slate-700 font-medium" x-text="selectedTicket.title"></p>
            </div>

            <form :action="`/teknisi/assignments/${selectedTicket.id}/solve`" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Langkah Perbaikan (Bahasa Awam)</label>
                    <textarea name="solution" rows="5" required 
                        placeholder="Contoh: Sudah diganti kabelnya, sekarang wifi sudah nyala kembali..."
                        class="w-full px-5 py-3.5 rounded-2xl border border-gray-100 bg-slate-50 focus:ring-2 focus:ring-indigo-500 outline-none transition text-sm"></textarea>
                    <p class="text-[10px] text-slate-400 mt-2 italic">*Gunakan bahasa yang mudah dimengerti orang tua/pelanggan.</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="button" @click="openSolve = false" 
                        class="order-2 sm:order-1 flex-1 px-4 py-3 rounded-xl bg-slate-100 font-bold text-slate-600 text-sm transition hover:bg-slate-200">
                        Batal
                    </button>
                    <button type="submit" 
                        class="order-1 sm:order-2 flex-1 px-4 py-3 rounded-xl bg-emerald-600 font-bold text-white text-sm shadow-lg shadow-emerald-200 hover:bg-emerald-700 transition">
                        Kirim Solusi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection