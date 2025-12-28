@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-50 px-6 py-20">
    <div class="max-w-lg w-full bg-white rounded-3xl shadow-xl shadow-slate-200/60 p-10 border border-slate-100">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold text-slate-900">Buat Akun Baru</h2>
            <p class="text-slate-500 text-sm mt-2">Daftar untuk mulai melaporkan gangguan internet Anda</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" required placeholder="Budi Santoso" 
                        class="w-full px-5 py-3.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Role (Uji Coba)</label>
                    <select name="role" class="w-full px-5 py-3.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition bg-slate-50">
                        <option value="pelanggan">Pelanggan</option>
                        <option value="teknisi">Teknisi</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                <input type="email" name="email" required placeholder="nama@email.com" 
                    class="w-full px-5 py-3.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kata Sandi</label>
                    <input type="password" name="password" required placeholder="••••••••" 
                        class="w-full px-5 py-3.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi</label>
                    <input type="password" name="password_confirmation" required placeholder="••••••••" 
                        class="w-full px-5 py-3.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full bg-indigo-500 text-white py-4 rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-600 transition-all">
                    Daftar Sekarang
                </button>
            </div>
        </form>

        <p class="text-center mt-8 text-sm text-slate-500">
            Sudah memiliki akun? 
            <a href="{{ route('login') }}" class="font-bold text-indigo-600 hover:underline">Masuk di sini</a>
        </p>
    </div>
</div>
@endsection