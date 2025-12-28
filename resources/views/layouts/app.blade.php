<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Violet Network - Helpdesk System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-gradient {
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
        }

        [x-cloak] {
            display: none !important;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-900" x-data="{ sidebarOpen: true }">
    <div class="flex h-screen overflow-hidden">

        <aside
            class="sidebar-gradient text-white flex flex-col shadow-2xl transition-all duration-300 ease-in-out"
            :class="sidebarOpen ? 'w-72' : 'w-20'">

            <div class="p-6 flex items-center h-20" :class="sidebarOpen ? 'justify-start' : 'justify-center'">
                <div class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-indigo-500 shadow-lg shadow-indigo-500/20 shrink-0">
                    <i class="fas fa-network-wired text-white"></i>
                </div>
                <div x-show="sidebarOpen" x-transition.opacity class="ml-4 overflow-hidden whitespace-nowrap">
                    <h2 class="text-xl font-bold tracking-tight">VIOLET <span class="text-indigo-400">NET</span></h2>
                    <p class="text-[9px] text-slate-400 uppercase tracking-widest font-semibold">Helpdesk System</p>
                </div>
            </div>

            <nav class="flex-1 px-3 space-y-1 overflow-y-auto mt-4 custom-scrollbar">

                @if(Auth::user()->role == 'admin')
                <div x-show="sidebarOpen" class="text-[10px] uppercase text-slate-500 font-bold px-4 pt-6 pb-2 tracking-widest">Admin Control</div>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}"
                    :class="sidebarOpen ? '' : 'justify-center'">
                    <i class="fas fa-tachometer-alt w-6 text-lg"></i>
                    <span x-show="sidebarOpen" x-transition.opacity class="ml-3">Dashboard</span>
                </a>
                <a href="{{ route('admin.users.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('users.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}"
                    :class="sidebarOpen ? '' : 'justify-center'">
                    <i class="fas fa-users-cog w-6"></i>
                    <span x-show="sidebarOpen" x-transition.opacity class="ml-3">Kelola User</span>
                </a>

                <a href="{{ route('admin.tickets.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('admin.tickets.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}"
                    :class="sidebarOpen ? '' : 'justify-center'">
                    <i class="fas fa-ticket-alt w-6"></i>
                    <span x-show="sidebarOpen" x-transition.opacity class="ml-3">Kelola Tiket</span>
                </a>

                <a href="{{ route('admin.knowledge-base.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('knowledge-base.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}"
                    :class="sidebarOpen ? '' : 'justify-center'">
                    <i class="fas fa-book-open w-6"></i>
                    <span x-show="sidebarOpen" x-transition.opacity class="ml-3">Basis Pengetahuan</span>
                </a>

                <a href="{{ route('admin.logs.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('logs.index') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}"
                    :class="sidebarOpen ? '' : 'justify-center'">
                    <i class="fas fa-history w-6"></i>
                    <span x-show="sidebarOpen" x-transition.opacity class="ml-3">Log Aktivitas</span>
                </a>
                @endif

                @if(Auth::user()->role == 'teknisi')
                <div x-show="sidebarOpen" class="text-[10px] uppercase text-slate-500 font-bold px-4 pt-6 pb-2 tracking-widest">Workspace</div>
                <a href="{{ route('teknisi.assignments.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('assignments.*') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}"
                    :class="sidebarOpen ? '' : 'justify-center'">
                    <i class="fas fa-clipboard-list w-6"></i>
                    <span x-show="sidebarOpen" x-transition.opacity class="ml-3">Penugasan Saya</span>
                </a>
                @endif

                @if(Auth::user()->role == 'pelanggan')
                <div x-show="sidebarOpen" class="text-[10px] uppercase text-slate-500 font-bold px-4 pt-6 pb-2 tracking-widest">Support</div>
                <a href="{{ route('tickets.create') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('tickets.create') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}"
                    :class="sidebarOpen ? '' : 'justify-center'">
                    <i class="fas fa-plus-circle w-6"></i>
                    <span x-show="sidebarOpen" x-transition.opacity class="ml-3">Buat Tiket</span>
                </a>
                <a href="{{ route('tickets.index') }}"
                    class="flex items-center px-4 py-3 text-sm font-medium rounded-xl transition-all {{ request()->routeIs('tickets.index') ? 'bg-indigo-600 text-white shadow-lg' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}"
                    :class="sidebarOpen ? '' : 'justify-center'">
                    <i class="fas fa-list-ul w-6"></i>
                    <span x-show="sidebarOpen" x-transition.opacity class="ml-3">Tiket Saya</span>
                </a>
                @endif
            </nav>

            <div class="p-4 bg-slate-900/50 m-4 rounded-xl border border-slate-700/50">
                <div class="flex items-center" :class="sidebarOpen ? 'justify-start gap-3' : 'justify-center'">
                    <div class="relative flex shrink-0">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-ping absolute opacity-75"></div>
                        <div class="w-2 h-2 bg-green-500 rounded-full relative"></div>
                    </div>
                    <span x-show="sidebarOpen" x-transition.opacity class="text-[10px] font-medium text-slate-400">System Online</span>
                </div>
            </div>
        </aside>

        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">

            <header class="sticky top-0 z-20 flex w-full bg-white/80 backdrop-blur-md border-b border-gray-100 h-16 items-center px-6 justify-between">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = !sidebarOpen" class="w-10 h-10 flex items-center justify-center rounded-lg hover:bg-gray-100 text-slate-600 transition-colors focus:outline-none">
                        <i class="fas fa-bars text-lg" :class="!sidebarOpen ? 'rotate-90' : ''"></i>
                    </button>
                    <h1 class="text-lg font-semibold text-slate-800">@yield('header_title')</h1>
                </div>

                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="flex items-center gap-3 p-1 rounded-full hover:bg-gray-100 transition-all outline-none">
                        <div class="text-right hidden sm:block">
                            <p class="text-xs font-bold text-slate-800 leading-none">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-slate-400 font-medium">{{ ucfirst(Auth::user()->role) }}</p>
                        </div>
                        <div class="w-9 h-9 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold shadow-md shadow-indigo-200">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <i class="fas fa-chevron-down text-[10px] text-slate-400 mr-2 transition-transform" :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="open" x-cloak
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-gray-100 py-2 z-50">

                        <div class="px-4 py-3 border-b border-gray-50">
                            <p class="text-xs text-slate-400 font-medium">Masuk sebagai:</p>
                            <p class="text-sm font-bold text-slate-800">{{ Auth::user()->email }}</p>
                        </div>

                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-slate-600 hover:bg-indigo-50 hover:text-indigo-600 transition-all">
                            <i class="fas fa-user-circle opacity-50"></i> Lihat Profil
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 underline">
                                Log out
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="p-8">
                @yield('content')
            </main>

        </div>
    </div>
    <div x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 4000)"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform translate-y-4"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform translate-y-4"
        class="fixed bottom-10 right-10 z-[100]">

        @if(session('success'))
        <div class="bg-emerald-500 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-4">
            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-check text-sm"></i>
            </div>
            <div>
                <p class="font-bold text-sm">Berhasil!</p>
                <p class="text-xs opacity-90">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="ml-4 opacity-50 hover:opacity-100">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif

        @if($errors->any())
        <div class="bg-red-500 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-4">
            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-sm"></i>
            </div>
            <div>
                <p class="font-bold text-sm">Ups! Ada Kesalahan</p>
                <ul class="text-[10px] opacity-90">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button @click="show = false" class="ml-4 opacity-50 hover:opacity-100">
                <i class="fas fa-times"></i>
            </button>
        </div>
        @endif
    </div>
</body>

</html>