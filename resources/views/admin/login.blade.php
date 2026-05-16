<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Wer</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-login-body">
    <div class="admin-login-card">
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold tracking-tighter mb-1">wer.</h1>
            <p class="text-black/50 text-sm">Management Portal</p>
        </div>
        
        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            
            @if($errors->any())
                <div class="bg-red-50 text-red-600 p-3 rounded-lg mb-4 text-sm font-medium">
                    {{ $errors->first() }}
                </div>
            @endif
            
            <div class="mb-3">
                <label class="block text-xs font-medium text-black/80 mb-1 ml-1">Username</label>
                <input type="text" name="username" class="admin-input" placeholder="admin" required autofocus>
            </div>
            
            <div class="mb-6">
                <label class="block text-xs font-medium text-black/80 mb-1 ml-1">Password</label>
                <input type="password" name="password" class="admin-input" placeholder="••••••••" required>
            </div>
            
            <button type="submit" class="admin-button cursor-pointer">Sign In to Dashboard</button>
        </form>
        
        <div class="mt-6 pt-4 border-t border-surface text-center">
            <a href="{{ route('home') }}" class="text-xs text-black/50 hover:text-black transition-colors font-medium cursor-pointer flex items-center justify-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Back to Storefront
            </a>
        </div>
    </div>
</body>
</html>
