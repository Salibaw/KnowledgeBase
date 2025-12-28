@extends('layouts.guest')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-slate-50 px-6 py-12">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-xl shadow-slate-200/60 p-10 border border-slate-100">
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center w-12 h-12 rounded-xl bg-indigo-500 text-white mb-4">
                <i class="fas fa-lock text-xl"></i>
            </div>
            <h2 class="text-2xl font-bold text-slate-900">Selamat Datang</h2>
            <p class="text-slate-500 text-sm mt-2">Silakan masuk untuk mengelola tiket Anda</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <div>
                <label class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                <input type="email" name="email" required placeholder="nama@email.com" 
                    class="w-full px-5 py-3.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <div>
                <div class="flex justify-between mb-2">
                    <label class="block text-sm font-bold text-slate-700">Kata Sandi</label>
                    <a href="#" class="text-xs font-semibold text-indigo-600 hover:underline">Lupa Password?</a>
                </div>
                <input type="password" name="password" required placeholder="••••••••" 
                    class="w-full px-5 py-3.5 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="remember" class="w-4 h-4 text-indigo-600 border-slate-300 rounded focus:ring-indigo-500">
                <label for="remember" class="ml-2 text-sm text-slate-600">Ingat saya di perangkat ini</label>
            </div>

            <button type="submit" class="w-full bg-indigo-500 text-white py-4 rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-600 transition-all flex items-center justify-center gap-2">
                Masuk ke Akun <i class="fas fa-arrow-right text-sm"></i>
            </button>
        </form>

        <p class="text-center mt-8 text-sm text-slate-500">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="font-bold text-indigo-600 hover:underline">Daftar Sekarang</a>
        </p>
    </div>
</div>
@endsection