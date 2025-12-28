@extends('layouts.app')

@section('header_title', 'Kelola Tiket Gangguan')

@section('content')
<div x-data="{ openAssign: false, selectedTicket: {} }">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <form action="{{ route('admin.tickets.index') }}" method="GET" class="relative w-full md:w-96">
            <input type="text" name="search" value="{{ request('search') }}" 
                placeholder="Cari tiket atau pelanggan..." 
                class="w-full pl-12 pr-4 py-3 rounded-2xl border border-gray-100 shadow-sm focus:ring-2 focus:ring-indigo-500 outline-none transition">
            <i class="fas fa-search absolute left-4 top-4 text-gray-400"></i>
        </form>

        <div class="flex gap-2">
            <span class="bg-amber-100 text-amber-700 px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-2">
                <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                {{ $tickets->where('status', 'open')->count() }} Tiket Baru
            </span>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-widest">
                <tr>
                    <th class="px-6 py-4">Informasi Tiket</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Prioritas</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Teknisi</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($tickets as $ticket)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-4">
                        <div class="text-sm font-bold text-slate-800">#{{ $ticket->id }} - {{ $ticket->title }}</div>
                        <div class="text-xs text-slate-400">Oleh: {{ $ticket->user->name }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $ticket->category->name ?? 'Umum' }}</td>
                    <td class="px-6 py-4">
                        <span class="text-[10px] font-bold uppercase {{ $ticket->priority == 'high' ? 'text-red-500' : 'text-blue-500' }}">
                            {{ $ticket->priority }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase 
                            {{ $ticket->status == 'open' ? 'bg-amber-100 text-amber-600' : ($ticket->status == 'processing' ? 'bg-blue-100 text-blue-600' : 'bg-emerald-100 text-emerald-600') }}">
                            {{ $ticket->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600 italic">
                        {{ $ticket->technician->name ?? 'Belum Ditugaskan' }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            @if($ticket->status == 'open')
                            <button @click="selectedTicket = {{ $ticket }}; openAssign = true" 
                                class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-indigo-700 transition">
                                Tugaskan
                            </button>
                            @else
                            <button class="bg-slate-100 text-slate-400 px-4 py-2 rounded-xl text-xs font-bold cursor-not-allowed">
                                Detail
                            </button>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-10 text-center text-slate-400 italic text-sm">Tidak ada tiket ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-6 border-t border-gray-50">
            {{ $tickets->links() }}
        </div>
    </div>

    <div x-show="openAssign" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        <div class="bg-white w-full max-w-md rounded-3xl p-8 shadow-2xl" @click.away="openAssign = false">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center text-xl">
                    <i class="fas fa-user-tools"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold">Pilih Teknisi</h3>
                    <p class="text-xs text-slate-400 italic" x-text="'Tiket: #' + selectedTicket.id"></p>
                </div>
            </div>

            <form :action="`/admin/tickets/${selectedTicket.id}/assign`" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-3">Teknisi Tersedia</label>
                    <div class="grid gap-3">
                        @foreach($technicians as $tech)
                        <label class="relative flex items-center p-4 border border-gray-100 rounded-2xl cursor-pointer hover:bg-slate-50 transition has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50">
                            <input type="radio" name="technician_id" value="{{ $tech->id }}" class="sr-only" required>
                            <div class="flex-1">
                                <p class="text-sm font-bold text-slate-800">{{ $tech->name }}</p>
                                <p class="text-[10px] text-slate-500 italic">{{ $tech->email }}</p>
                            </div>
                            <i class="fas fa-check-circle text-indigo-500 hidden group-has-[:checked]:block"></i>
                        </label>
                        @endforeach
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" @click="openAssign = false" class="flex-1 px-4 py-3 rounded-xl bg-gray-100 font-bold text-gray-600">Batal</button>
                    <button type="submit" class="flex-1 px-4 py-3 rounded-xl bg-indigo-600 font-bold text-white shadow-lg shadow-indigo-200">Tugaskan Sekarang</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection