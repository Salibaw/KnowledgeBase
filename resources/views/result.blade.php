@extends('layouts.guest')

@section('content')
<div class="bg-gray-50 min-h-screen pt-28 pb-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-gray-900">Basis Pengetahuan</h1>
            <p class="text-gray-600 mt-2">Cari solusi cepat untuk gangguan internet Anda</p>
            
            <form action="{{ route('kb.public') }}" method="GET" class="mt-8 max-w-2xl mx-auto relative">
                <input type="text" name="search" placeholder="Ketik masalah Anda (misal: RTO, Lampu LOS)..." 
                    class="w-full px-6 py-4 rounded-2xl border-none shadow-lg focus:ring-2 focus:ring-indigo-500 outline-none transition"
                    value="{{ request('search') }}">
                <button type="submit" class="absolute right-3 top-3 bg-indigo-600 text-white px-6 py-2 rounded-xl hover:bg-indigo-700">
                    Cari
                </button>
            </form>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @forelse($kb as $item)
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center gap-3 mb-4">
                    <span class="bg-indigo-100 text-indigo-600 text-[10px] font-bold px-3 py-1 rounded-full uppercase">
                        {{ $item->category ?? 'Umum' }}
                    </span>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $item->problem_title }}</h3>
                <p class="text-gray-600 text-sm line-clamp-3 mb-6">{{ $item->problem_description }}</p>
                
                <a href="{{ route('kb.detail', $item->id) }}" class="text-indigo-600 font-semibold text-sm flex items-center gap-2 hover:gap-3 transition-all">
                    Baca Selengkapnya <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
            @empty
            <div class="col-span-3 text-center py-20">
                <i class="fas fa-search text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">Solusi tidak ditemukan. Silakan hubungi dukungan pelanggan.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12">
            {{ $kb->links() }}
        </div>
    </div>
</div>
@endsection