@extends('layouts.app')

@section('header_title', 'Tugas Perbaikan')

@section('content')
<div x-data="{ openSolve: false, selectedTicket: {} }">
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-widest">
                <tr>
                    <th class="px-6 py-4">Tiket & Pelanggan</th>
                    <th class="px-6 py-4">Masalah</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($assignments as $task)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-4">
                        <div class="text-sm font-bold text-slate-800">#{{ $task->id }}</div>
                        <div class="text-xs text-slate-500">{{ $task->user->name }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-slate-700 font-medium">{{ $task->title }}</div>
                        <div class="text-[11px] text-slate-400">{{ Str::limit($task->problem_description, 50) }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase 
                            {{ $task->status == 'processing' ? 'bg-blue-100 text-blue-600' : 'bg-emerald-100 text-emerald-600' }}">
                            {{ $task->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
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
                @endforeach
            </tbody>
        </table>
    </div>

    <div x-show="openSolve" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        <div class="bg-white w-full max-w-lg rounded-3xl p-8 shadow-2xl" @click.away="openSolve = false">
            <h3 class="text-xl font-bold mb-2">Selesaikan Tugas</h3>
            <p class="text-sm text-slate-500 mb-6" x-text="'Masalah: ' + selectedTicket.title"></p>

            <form :action="`/teknisi/assignments/${selectedTicket.id}/solve`" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Solusi Perbaikan</label>
                    <textarea name="solution" rows="6" required 
                        placeholder="Jelaskan langkah-langkah perbaikan yang dilakukan secara detail..."
                        class="w-full px-5 py-3.5 rounded-2xl border border-gray-100 bg-slate-50 focus:ring-2 focus:ring-indigo-500 outline-none transition"></textarea>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" @click="openSolve = false" class="flex-1 px-4 py-3 rounded-xl bg-gray-100 font-bold text-gray-600">Batal</button>
                    <button type="submit" class="flex-1 px-4 py-3 rounded-xl bg-emerald-600 font-bold text-white shadow-lg">Kirim Solusi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection