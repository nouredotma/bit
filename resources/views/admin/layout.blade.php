<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - Wer</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50/50">
    <div class="admin-layout">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="px-4 mb-10">
                <h1 class="text-2xl font-bold tracking-tighter italic">WER ADMIN</h1>
                <p class="text-[10px] uppercase tracking-widest text-gray-400 mt-1">v1.0.2 Stable</p>
            </div>
            
            <nav class="flex flex-col gap-1">
                <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="text-sm">Dashboard Overview</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="admin-nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <span class="text-sm">Product Inventory</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="admin-nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <span class="text-sm">Categories</span>
                </a>
                <a href="{{ route('admin.orders.index') }}" class="admin-nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <span class="text-sm">Order History</span>
                </a>
            </nav>
            
            <div class="mt-auto px-4 pt-10 border-t border-gray-100">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm font-bold text-red-500 hover:text-red-700 transition-colors uppercase tracking-widest">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="admin-content">
            <header class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-bold tracking-tight">@yield('title', 'Dashboard')</h2>
                    <p class="text-gray-400 text-sm mt-1">Welcome back, Administrator.</p>
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
