<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | RRCO</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar { width: 256px; }
        .main-content { overflow-y: auto; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex">

    <aside class="sidebar bg-green-800 text-white flex-shrink-0 flex flex-col fixed h-full z-30">
        <div class="p-6 border-b border-gray-700">
            <h1 class="text-2xl font-bold text-amber-400">RRCO Admin</h1>
        </div>

        <nav class="flex-grow p-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center p-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-black text-white' : 'bg-gray-700 text-amber-400 font-semibold' }}">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.users') }}" class="flex items-center p-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.users') ? 'bg-black text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <i class="fas fa-users mr-3"></i>
                Kelola Akun
            </a>
            <a href="{{ route('admin.products') }}" class="flex items-center p-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.products') || request()->routeIs('admin.products.*') ? 'bg-black text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <i class="fas fa-shopping-cart mr-3"></i>
                Produk
            </a>
            <a href="{{ route('admin.orders') }}" class="flex items-center p-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.orders') || request()->routeIs('admin.orders.*') ? 'bg-black text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <i class="fas fa-receipt mr-3"></i>
                Pesanan
            </a>
            <a href="{{ route('admin.vouchers') }}" class="flex items-center p-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.vouchers') ? 'bg-black text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <i class="fas fa-ticket-alt mr-3"></i>
                Vouchers
            </a>
            <a href="{{ route('admin.complaints') }}" class="flex items-center p-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.complaints') ? 'bg-black text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <i class="fas fa-exclamation-circle mr-3"></i>
                Keluhan
            </a>
            <a href="{{ route('admin.sampah') }}" class="flex items-center p-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.sampah') ? 'bg-black text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <i class="fas fa-recycle mr-3"></i>
                Pengajuan Sampah
            </a>
            <a href="{{ route('admin.activity') }}" class="flex items-center p-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.activity') ? 'bg-black text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <i class="fas fa-history mr-3"></i>
                Activity Log
            </a>
            <a href="{{ route('admin.reviews') }}" class="flex items-center p-3 rounded-lg transition duration-200 {{ request()->routeIs('admin.reviews') ? 'bg-black text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                <i class="fas fa-star mr-3"></i>
                Ulasan
            </a>
            <a href="/">Kembali</a>
        </nav>

        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center p-3 rounded-lg text-red-400 hover:bg-gray-700 transition duration-200 w-full text-left">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    <div class="flex-1 flex flex-col ml-64 min-h-screen">
        <header class="bg-white shadow-md p-4 flex justify-between items-center sticky top-0 z-20">
            <h2 class="text-xl font-semibold text-gray-900">@yield('title', 'Admin Dashboard')</h2>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">{{ auth()->user()?->name ?? 'Admin' }}</span>
                <img class="h-10 w-10 rounded-full object-cover" src="{{ auth()->user()?->profile_photo_path ? Storage::url(auth()->user()->profile_photo_path) : 'https://via.placeholder.com/150/0000FF/FFFFFF?text=A' }}" alt="Foto Admin">
            </div>
        </header>

        <main class="main-content flex-1 p-6 space-y-8">
            @yield('content')
        </main>

        <footer class="p-4 text-center text-sm text-gray-500 border-t bg-white">
            &copy; {{ date('Y') }} RRCO Admin Dashboard. Hak Cipta Dilindungi.
        </footer>
    </div>

</body>
</html>
