@extends('layouts.app')

@section('header_title', 'Log Aktivitas Sistem')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-gray-700">Riwayat Aktivitas User</h3>
        <span class="text-sm text-gray-500">Menampilkan 10 aktivitas terakhir per halaman</span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm uppercase">
                    <th class="px-4 py-3 border-b">Waktu</th>
                    <th class="px-4 py-3 border-b">Nama User</th>
                    <th class="px-4 py-3 border-b">Role</th>
                    <th class="px-4 py-3 border-b">Aktivitas</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $log)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-4 border-b text-sm text-gray-600">
                        {{ $log->created_at->format('d M Y, H:i') }}
                    </td>
                    <td class="px-4 py-4 border-b font-medium">{{ $log->user->name }}</td>
                    <td class="px-4 py-4 border-b">
                        <span class="text-xs px-2 py-1 rounded bg-slate-100 text-slate-600 italic">
                            {{ ucfirst($log->user->role) }}
                        </span>
                    </td>
                    <td class="px-4 py-4 border-b">
                        <span class="text-sm {{ Str::contains($log->activity, 'Login') ? 'text-blue-600' : 'text-gray-700' }}">
                            {{ $log->activity }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-10 text-center text-gray-400">Belum ada data log aktivitas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $logs->links() }}
    </div>
</div>
@endsection