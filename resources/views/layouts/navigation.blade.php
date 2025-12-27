<div class="w-64 bg-slate-800 text-white flex flex-col">
    <div class="p-6 text-center border-b border-slate-700">
        <h2 class="text-2xl font-bold tracking-wider">VIOLET NET</h2>
        <p class="text-xs text-slate-400 mt-1">Helpdesk System</p>
    </div>

    <nav class="flex-1 p-4 space-y-2">
        <a href="{{ route('dashboard') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-700 transition">
            <i class="fas fa-tachometer-alt w-8"></i> Dashboard
        </a>

        @if(Auth::user()->role == 'admin')
            <div class="text-xs uppercase text-slate-500 font-bold px-3 pt-4 pb-2">Manajemen</div>
            <a href="{{ route('users.index') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-700 transition">
                <i class="fas fa-users w-8"></i> Kelola User
            </a>
            <a href="{{ route('tickets.index') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-700 transition">
                <i class="fas fa-ticket-alt w-8"></i> Kelola Tiket
            </a>
            <a href="{{ route('knowledge-base.index') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-700 transition">
                <i class="fas fa-book-open w-8"></i> Basis Pengetahuan
            </a>
            <a href="{{ route('logs.index') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-700 transition">
                <i class="fas fa-history w-8"></i> Log Aktivitas
            </a>
        @endif

        @if(Auth::user()->role == 'teknisi')
            <div class="text-xs uppercase text-slate-500 font-bold px-3 pt-4 pb-2">Tugas</div>
            <a href="{{ route('assignments.index') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-700 transition">
                <i class="fas fa-tasks w-8"></i> Penugasan Saya
            </a>
        @endif

        @if(Auth::user()->role == 'pelanggan')
            <div class="text-xs uppercase text-slate-500 font-bold px-3 pt-4 pb-2">Dukungan</div>
            <a href="{{ route('tickets.create') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-700 transition">
                <i class="fas fa-plus-circle w-8"></i> Buat Tiket
            </a>
            <a href="{{ route('tickets.index') }}" class="flex items-center p-3 rounded-lg hover:bg-slate-700 transition">
                <i class="fas fa-ticket-alt w-8"></i> Tiket Saya
            </a>
        @endif

    </nav>
</div>