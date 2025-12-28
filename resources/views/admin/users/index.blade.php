@extends('layouts.app')

@section('header_title', 'Kelola Pengguna')

@section('content')
<div x-data="{ openAdd: false, openEdit: false, currentUser: {} }">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <form action="{{ route('admin.users.index') }}" method="GET" class="relative w-full md:w-96">
            <input type="text" name="search" value="{{ request('search') }}" 
                placeholder="Cari nama atau email..." 
                class="w-full pl-12 pr-4 py-3 rounded-2xl border border-gray-100 shadow-sm focus:ring-2 focus:ring-indigo-500 outline-none transition">
            <i class="fas fa-search absolute left-4 top-4 text-gray-400"></i>
        </form>

        <button @click="openAdd = true" class="bg-indigo-600 text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition flex items-center justify-center gap-2">
            <i class="fas fa-plus"></i> Tambah User
        </button>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-widest">
                <tr>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Dibuat Pada</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @foreach($users as $user)
                <tr class="hover:bg-slate-50/50 transition">
                    <td class="px-6 py-4 font-semibold text-slate-700">{{ $user->name }}</td>
                    <td class="px-6 py-4 text-slate-500">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase 
                            {{ $user->role == 'admin' ? 'bg-purple-100 text-purple-600' : ($user->role == 'teknisi' ? 'bg-blue-100 text-blue-600' : 'bg-slate-100 text-slate-600') }}">
                            {{ $user->role }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-xs text-slate-400">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            <button @click="currentUser = {{ $user }}; openEdit = true" class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-600 hover:text-white transition flex items-center justify-center">
                                <i class="fas fa-edit text-xs"></i>
                            </button>
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition flex items-center justify-center">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-6 border-t border-gray-50">
            {{ $users->links() }}
        </div>
    </div>

    <div x-show="openAdd" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        <div class="bg-white w-full max-w-md rounded-3xl p-8 shadow-2xl" @click.away="openAdd = false">
            <h3 class="text-xl font-bold mb-6">Tambah Pengguna Baru</h3>
            <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="name" placeholder="Nama Lengkap" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-indigo-500" required>
                <input type="email" name="email" placeholder="Email" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-indigo-500" required>
                <input type="password" name="password" placeholder="Password" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-indigo-500" required>
                <select name="role" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="pelanggan">Pelanggan</option>
                    <option value="teknisi">Teknisi</option>
                    <option value="admin">Admin</option>
                </select>
                <div class="flex gap-3 pt-4">
                    <button type="button" @click="openAdd = false" class="flex-1 px-4 py-3 rounded-xl bg-gray-100 font-bold text-gray-600">Batal</button>
                    <button type="submit" class="flex-1 px-4 py-3 rounded-xl bg-indigo-600 font-bold text-white shadow-lg shadow-indigo-200">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <div x-show="openEdit" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        <div class="bg-white w-full max-w-md rounded-3xl p-8 shadow-2xl" @click.away="openEdit = false">
            <h3 class="text-xl font-bold mb-6">Edit Pengguna</h3>
            <form :action="`/admin/users/${currentUser.id}`" method="POST" class="space-y-4">
                @csrf @method('PATCH')
                <input type="text" name="name" x-model="currentUser.name" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-indigo-500">
                <input type="email" name="email" x-model="currentUser.email" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-indigo-500">
                <select name="role" x-model="currentUser.role" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-indigo-500">
                    <option value="pelanggan">Pelanggan</option>
                    <option value="teknisi">Teknisi</option>
                    <option value="admin">Admin</option>
                </select>
                <p class="text-[10px] text-gray-400 italic">*Kosongkan password jika tidak ingin diubah</p>
                <input type="password" name="password" placeholder="Password Baru" class="w-full px-4 py-3 rounded-xl border border-gray-200 outline-none focus:ring-2 focus:ring-indigo-500">
                <div class="flex gap-3 pt-4">
                    <button type="button" @click="openEdit = false" class="flex-1 px-4 py-3 rounded-xl bg-gray-100 font-bold text-gray-600">Batal</button>
                    <button type="submit" class="flex-1 px-4 py-3 rounded-xl bg-amber-500 font-bold text-white shadow-lg shadow-amber-200">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection