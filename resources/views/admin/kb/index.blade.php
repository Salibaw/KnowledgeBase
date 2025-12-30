@extends('layouts.app')

@section('header_title', 'Verifikasi Basis Pengetahuan')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-widest">
                <tr>
                    <th class="px-6 py-4">Masalah & Solusi</th>
                    <th class="px-6 py-4">Kategori</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($kb as $item)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-4 max-w-md">
                        <div class="text-sm font-bold text-slate-800">{{ $item->problem_title }}</div>
                        <div class="text-[11px] text-slate-500 line-clamp-2 mt-1">{{ $item->solution }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs text-slate-600">{{ $item->category->name ?? 'Umum' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        @if($item->is_verified)
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-600 rounded-full text-[10px] font-bold uppercase">Terverifikasi</span>
                        @else
                            <span class="px-3 py-1 bg-amber-100 text-amber-600 rounded-full text-[10px] font-bold uppercase animate-pulse">Menunggu</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            @if(!$item->is_verified)
                            <form action="{{ route('admin.kb.verify', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-xl text-xs font-bold hover:bg-indigo-700 transition">
                                    Verifikasi
                                </button>
                            </form>
                            @endif
                            <form action="{{ route('admin.knowledge-base.destroy', $item->kb_id) }}" method="POST" onsubmit="return confirm('Hapus data ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-red-400 hover:text-red-600">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-10 text-center text-slate-400 italic text-sm">Belum ada data solusi masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="p-6">
            {{ $kb->links() }}
        </div>
    </div>
</div>
@endsection