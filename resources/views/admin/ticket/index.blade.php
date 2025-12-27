@extends('layouts.app')

@section('header_title', 'Semua Tiket')

@section('content')
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-slate-100 text-gray-600">
            <tr>
                <th class="px-6 py-4">Tiket</th>
                <th class="px-6 py-4">Kategori</th>
                <th class="px-6 py-4">Prioritas</th>
                <th class="px-6 py-4">Status</th>
                <th class="px-6 py-4">Teknisi</th>
                <th class="px-6 py-4">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tickets as $ticket)
            <tr class="border-t">
                <td class="px-6 py-4">
                    <div class="font-bold">#{{ $ticket->ticket_id }} - {{ $ticket->title }}</div>
                    <div class="text-xs text-gray-400">Dari: {{ $ticket->user->name }}</div>
                </td>
                <td class="px-6 py-4">{{ $ticket->category->name }}</td>
                <td class="px-6 py-4">
                    <span class="text-xs font-bold {{ $ticket->priority == 'high' ? 'text-red-500' : 'text-blue-500' }}">
                        {{ strtoupper($ticket->priority) }}
                    </span>
                </td>
                <td class="px-6 py-4">{{ ucfirst($ticket->status) }}</td>
                <td class="px-6 py-4">
                    {{ $ticket->assignment->technician->name ?? 'Belum Ditugaskan' }}
                </td>
                <td class="px-6 py-4">
                    @if(!$ticket->assignment)
                    <button onclick="openModal('{{ $ticket->ticket_id }}')" class="bg-orange-500 text-white px-3 py-1 rounded text-sm">
                        Tugaskan
                    </button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection