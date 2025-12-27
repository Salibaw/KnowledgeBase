<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Violet Network - Pusat Bantuan Internet</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .soft-gradient { background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%); }
        .btn-shadow { shadow-lg shadow-indigo-200; }
    </style>
</head>
<body class="bg-white text-slate-800">

    <nav class="fixed w-full z-50 bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-indigo-500 rounded-lg flex items-center justify-center text-white">
                    <i class="fas fa-home text-lg"></i>
                </div>
                <span class="text-xl font-bold tracking-tight text-slate-900">VIOLET <span class="text-indigo-500">NET</span></span>
            </div>
            
            <div class="flex items-center gap-6">
                <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-indigo-600 transition">Masuk</a>
                <a href="{{ route('register') }}" class="bg-indigo-500 text-white px-7 py-3 rounded-xl text-sm font-bold shadow-md hover:bg-indigo-600 transition">Mulai Sekarang</a>
            </div>
        </div>
    </nav>

    <section class="relative pt-32 pb-20 soft-gradient">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <div class="inline-block bg-indigo-100 text-indigo-700 px-4 py-1.5 rounded-full text-xs font-bold mb-6">
                Pusat Bantuan Internet Sumenep 
            </div>
            <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 mb-6 leading-tight">
                Internet Bermasalah? <br> <span class="text-indigo-600">Kami Siap Membantu Anda</span>
            </h1>
            <p class="text-base md:text-lg text-slate-600 max-w-2xl mx-auto mb-10 leading-relaxed">
                Laporkan gangguan internet Anda dengan mudah. Sistem pintar kami akan memberikan saran perbaikan secara otomatis agar Anda bisa kembali online lebih cepat. 
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('login') }}" class="w-full sm:w-auto bg-indigo-500 text-white px-10 py-4 rounded-2xl font-bold shadow-xl hover:bg-indigo-600 transition flex items-center justify-center gap-3 text-lg">
                    <i class="fas fa-edit"></i> Buat Laporan Baru
                </a>
                <a href="#faq" class="w-full sm:w-auto bg-white text-slate-700 border border-slate-200 px-10 py-4 rounded-2xl font-bold hover:bg-slate-50 transition">
                    Cari Solusi Mandiri
                </a>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid md:grid-cols-3 gap-12">
                <div class="text-center group">
                    <div class="w-20 h-20 bg-blue-50 text-blue-500 rounded-3xl flex items-center justify-center text-3xl mb-6 mx-auto group-hover:bg-blue-500 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-lightbulb"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Saran Otomatis</h3>
                    <p class="text-slate-500 leading-relaxed text-sm">
                        Dapatkan petunjuk perbaikan langsung saat Anda melaporkan masalah.
                    </p>
                </div>

                <div class="text-center group">
                    <div class="w-20 h-20 bg-indigo-50 text-indigo-500 rounded-3xl flex items-center justify-center text-3xl mb-6 mx-auto group-hover:bg-indigo-500 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Teknisi Terpercaya</h3>
                    <p class="text-slate-500 leading-relaxed text-sm">
                        Tim teknis kami akan segera menangani laporan Anda dengan transparan.
                    </p>
                </div>

                <div class="text-center group">
                    <div class="w-20 h-20 bg-teal-50 text-teal-500 rounded-3xl flex items-center justify-center text-3xl mb-6 mx-auto group-hover:bg-teal-500 group-hover:text-white transition-all duration-300">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3">Lacak Laporan</h3>
                    <p class="text-slate-500 leading-relaxed text-sm">
                        Lihat sejauh mana progres perbaikan internet di rumah Anda.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="faq" class="py-24 bg-slate-50">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-slate-900 mb-4">Masalah yang Sering Terjadi</h2>
                <p class="text-slate-500">Klik pada masalah di bawah ini untuk melihat solusinya.</p>
            </div>
            
            <div class="grid gap-4">
                @foreach($faqs as $faq)
                <div class="bg-white border border-slate-200 rounded-2xl p-6 hover:border-indigo-500 transition cursor-pointer flex items-center justify-between group">
                    <div class="flex items-center gap-4">
                        <div class="w-2 h-2 rounded-full bg-indigo-500"></div>
                        <h4 class="font-bold text-slate-800">{{ $faq->problem_title }}</h4>
                    </div>
                    <i class="fas fa-chevron-right text-slate-300 group-hover:text-indigo-500 transition"></i>
                </div>
                @endforeach
            </div>
            
            <div class="mt-12 p-8 bg-indigo-600 rounded-3xl text-white flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="text-center md:text-left">
                    <h4 class="text-xl font-bold mb-1">Masalah belum teratasi?</h4>
                    <p class="text-indigo-100 text-sm">Masuk ke akun Anda untuk berbicara dengan tim teknis kami.</p>
                </div>
                <a href="{{ route('login') }}" class="bg-white text-indigo-600 px-8 py-3 rounded-xl font-bold shadow-lg hover:bg-indigo-50 transition whitespace-nowrap">
                    Buka Tiket Baru
                </a>
            </div>
        </div>
    </section>

    <footer class="bg-white py-12 border-t border-slate-100 text-center">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center justify-center gap-2 mb-6 opacity-50">
                <i class="fas fa-home text-slate-900"></i>
                <span class="font-bold text-slate-900">VIOLET NET</span>
            </div>
            <p class="text-slate-400 text-xs tracking-widest uppercase mb-2">Lokasi Penelitian: Sumenep, Madura </p>
            <p class="text-slate-400 text-[10px]">&copy; 2025 Aplikasi Helpdesk Berbasis Web Menggunakan Framework Laravel.</p>
        </div>
    </footer>

</body>
</html>