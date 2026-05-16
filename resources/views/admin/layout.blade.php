<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - Wer</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface">
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="px-4 mb-10 text-center">
                <h1 class="text-3xl font-bold">wer.</h1>
                <p class="text-[10px] text-white/50 mt-1 tracking-wider">v1.0.2 Stable</p>
            </div>
            
            <nav class="flex flex-col gap-1">
                <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="text-sm">Dashboard Overview</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="admin-nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <span class="text-sm">Product Inventory</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="admin-nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <span class="text-sm">Order History</span>
                </a>
                <a href="{{ route('admin.subscribers.index') }}" class="admin-nav-link {{ request()->routeIs('admin.subscribers.*') ? 'active' : '' }}">
                    <span class="text-sm">Subscribers</span>
                </a>
            </nav>
            
            <div class="mt-auto px-3 pt-4 border-t border-white/10">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm font-bold text-red-500 hover:text-red-700 transition-colors cursor-pointer flex items-center justify-between w-full">
                        Logout
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="admin-content">
            <header class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-3xl font-medium tracking-tight">@yield('title', 'Dashboard')</h2>
                    <p class="text-black/50 text-sm mt-1">Welcome back, Administrator.</p>
                </div>
                <div class="flex items-center gap-4">
                    <div class="h-10 w-10 bg-black text-white flex items-center justify-center rounded-full font-bold text-xs">AD</div>
                </div>
            </header>

            @if(session('success'))
            <div class="bg-green-50 text-green-700 px-6 py-4 rounded-xl mb-6 text-sm font-medium flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
                {{ session('success') }}
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-50 text-red-700 px-6 py-4 rounded-xl mb-6 text-sm font-medium">
                {{ $errors->first() }}
            </div>
            @endif
            
            <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
