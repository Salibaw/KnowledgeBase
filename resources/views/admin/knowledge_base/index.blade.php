@extends('layouts.app')

@section('header_title', 'Basis Pengetahuan')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <h3 class="font-bold text-gray-700 mb-4">Verifikasi Solusi Baru</h3>
    <div class="space-y-4">
        @foreach($kb as $item)
        <div class="border rounded-lg p-4 {{ $item->is_verified ? 'bg-white' : 'bg-yellow-50 border-yellow-200' }}">
            <div class="flex justify-between items-start">
                <div>
                    <h4 class="font-bold text-blue-800">{{ $item->problem_title }}</h4>
                    <p class="text-sm text-gray-600 mt-1">{{ Str::limit($item->solution, 150) }}</p>
                    <div class="mt-2 flex gap-2">
                        @foreach(explode(',', $item->keyword) as $key)
                            <span class="text-[10px] bg-gray-200 px-2 py-0.5 rounded italic">#{{ trim($key) }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="flex flex-col items-end gap-2">
                    @if(!$item->is_verified)
                        <form action="{{ route('admin.kb.verify', $item->kb_id) }}" method="POST">
                            @csrf
                            <button class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-green-700 shadow-sm">
                                <i class="fas fa-check mr-1"></i> Verifikasi
                            </button>
                        </form>
                    @else
                        <span class="text-green-600 text-sm font-bold"><i class="fas fa-check-double"></i> Terverifikasi</span>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection