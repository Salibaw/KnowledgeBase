@extends('layouts.app')

@section('header_title', 'Laporkan Gangguan')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-sm">
                <h3 class="text-xl font-bold text-slate-800 mb-6">Detail Gangguan</h3>

                <form action="{{ route('pelanggan.tickets.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Subjek / Judul Masalah</label>
                        <input type="text" name="title" required placeholder="Contoh: Lampu Router Warna Merah"
                            class="w-full px-5 py-3.5 rounded-2xl border border-gray-100 bg-slate-50 focus:ring-2 focus:ring-indigo-500 outline-none transition">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tingkat Urgensi</label>
                        <select name="priority" class="w-full px-5 py-3.5 rounded-2xl border border-gray-100 bg-slate-50 focus:ring-2 focus:ring-indigo-500 outline-none transition font-medium">
                            <option value="low">Rendah (Hanya Bertanya)</option>
                            <option value="medium" selected>Sedang (Internet Lemot)</option>
                            <option value="high">Tinggi (Mati Total / Lampu LOS)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi Lengkap</label>
                        <textarea name="problem_description" rows="5" required
                            placeholder="Ceritakan kronologi masalahnya di sini..."
                            class="w-full px-5 py-3.5 rounded-2xl border border-gray-100 bg-slate-50 focus:ring-2 focus:ring-indigo-500 outline-none transition"></textarea>
                        <p class="text-[10px] text-slate-400 mt-2">*Deskripsi Anda akan dianalisis oleh sistem untuk mencari solusi tercepat.</p>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <a href="{{ route('user.tickets.index') }}" class="flex-1 text-center py-4 rounded-2xl font-bold text-slate-500 bg-slate-100 hover:bg-slate-200 transition">Batal</a>
                        <button type="submit" class="flex-[2] py-4 rounded-2xl font-bold text-white bg-indigo-600 shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition">Kirim Laporan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-indigo-600 rounded-3xl p-6 text-white shadow-xl shadow-indigo-100">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fas fa-robot text-lg"></i>
                    </div>
                    <h4 class="font-bold">Asisten Pintar</h4>
                </div>
                <p class="text-xs text-indigo-100 leading-relaxed mb-4">
                    Sambil menunggu teknisi, sistem kami sedang mencari solusi mandiri berdasarkan deskripsi Anda...
                </p>

                <div id="ai-recommendation" class="space-y-3">
                    <div class="p-4 bg-white/10 border border-white/20 rounded-2xl text-[11px] italic text-indigo-200">
                        Belum ada deskripsi untuk dianalisis.
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm">
                <h4 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-info-circle text-indigo-500"></i> Tips Cepat
                </h4>
                <ul class="text-xs text-slate-500 space-y-3">
                    <li class="flex gap-2">
                        <span class="text-indigo-500 font-bold">•</span>
                        Coba restart router Anda selama 5 menit.
                    </li>
                    <li class="flex gap-2">
                        <span class="text-indigo-500 font-bold">•</span>
                        Pastikan kabel kuning terpasang kencang.
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
<script>
    let timeout = null;

    // Ambil elemen textarea
    const descriptionInput = document.querySelector('textarea[name="problem_description"]');
    const recommendationBox = document.getElementById('ai-recommendation');

    descriptionInput.addEventListener('keyup', function() {
        // Hapus timeout sebelumnya agar tidak spam request
        clearTimeout(timeout);

        // Tunggu 1 detik setelah user berhenti mengetik
        timeout = setTimeout(function() {
            const text = descriptionInput.value;

            if (text.length > 5) { // Mulai cari jika teks lebih dari 5 karakter
                fetch("{{ route('user.tickets.recommendation') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: JSON.stringify({
                            text: text
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        recommendationBox.innerHTML = ''; // Kosongkan box

                        if (data.length > 0) {
                            data.forEach(item => {
                                recommendationBox.innerHTML += `
                                <div class="p-4 bg-white/20 border border-white/30 rounded-2xl mb-3 hover:bg-white/30 transition cursor-pointer group">
                                    <h5 class="font-bold text-sm mb-1 group-hover:text-white">${item.problem_title}</h5>
                                    <p class="text-[10px] text-indigo-100 line-clamp-2">${item.solution}</p>
                                    <a href="/kb/${item.id}" target="_blank" class="block mt-2 text-[10px] font-bold text-white underline">Baca Solusi</a>
                                </div>
                            `;
                            });
                        } else {
                            recommendationBox.innerHTML = `
                            <div class="p-4 bg-white/10 border border-white/20 rounded-2xl text-[11px] italic text-indigo-200">
                                Belum menemukan solusi yang cocok. Silakan kirim tiket agar teknisi membantu.
                            </div>
                        `;
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }, 1000);
    });
</script>
@endsection