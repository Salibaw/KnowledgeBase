@extends('layouts.app')

@section('header_title', 'Manajemen User')

@section('content')
<div class="bg-white rounded-xl shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-lg font-bold text-gray-700">Daftar Pengguna</h3>
        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
            <i class="fas fa-plus mr-2"></i> Tambah User
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm uppercase">
                    <th class="px-4 py-3 border-b">Nama</th>
                    <th class="px-4 py-3 border-b">Email</th>
                    <th class="px-4 py-3 border-b">Role</th>
                    <th class="px-4 py-3 border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-4 border-b">{{ $user->name }}</td>
                    <td class="px-4 py-4 border-b">{{ $user->email }}</td>
                    <td class="px-4 py-4 border-b">
                        <span class="px-2 py-1 rounded text-xs font-semibold 
                            {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-700' : ($user->role == 'teknisi' ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-700') }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td class="px-4 py-4 border-b text-center">
                        <button class="text-yellow-500 hover:text-yellow-600 mx-1"><i class="fas fa-edit"></i></button>
                        <button class="text-red-500 hover:text-red-600 mx-1"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection