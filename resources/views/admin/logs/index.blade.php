@extends('layouts.app')

@section('header_title', 'Riwayat Aktivitas Sistem')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-50">
            <h3 class="font-bold text-slate-800 text-lg">Log Aktivitas</h3>
            <p class="text-xs text-slate-500">Memantau setiap aksi yang dilakukan oleh Admin, Teknisi, dan Pelanggan.</p>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-widest">
                    <tr>
                        <th class="px-6 py-4">Waktu</th>
                        <th class="px-6 py-4">Pengguna</th>
                        <th class="px-6 py-4">Aktivitas</th>
                        <th class="px-6 py-4">Detail</th>
                        <th class="px-6 py-4 text-center">IP Address</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($logs as $log)
                    <tr class="hover:bg-slate-50/50 transition text-sm">
                        <td class="px-6 py-4 text-slate-500 whitespace-nowrap">
                            {{ $log->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-800">{{ $log->user->name }}</div>
                            <div class="text-[10px] text-indigo-500 uppercase font-semibold">{{ $log->user->role }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 bg-slate-100 text-slate-600 rounded-lg font-medium">
                                {{ $log->activity }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-500 italic">
                            {{ $log->description }}
                        </td>
                        <td class="px-6 py-4 text-center text-xs text-slate-400">
                            {{ $log->ip_address }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-slate-400 italic">Belum ada riwayat aktivitas.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 border-t border-gray-50">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection