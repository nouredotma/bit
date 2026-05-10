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
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold tracking-tighter italic mb-2">WER ADMIN</h1>
            <p class="text-gray-400 text-sm uppercase tracking-widest">Management Portal</p>
        </div>
        
        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            
            @if($errors->any())
                <div class="bg-red-50 text-red-600 p-4 rounded-lg mb-6 text-sm font-medium">
                    {{ $errors->first() }}
                </div>
            @endif
            
            <div class="mb-4">
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Username</label>
                <input type="text" name="username" class="admin-input" placeholder="admin" required autofocus>
            </div>
            
            <div class="mb-8">
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Password</label>
                <input type="password" name="password" class="admin-input" placeholder="••••••••" required>
            </div>
            
            <button type="submit" class="admin-button">Sign In to Dashboard</button>
        </form>
        
        <div class="mt-10 pt-6 border-t border-gray-50 text-center">
            <a href="{{ route('home') }}" class="text-xs text-gray-400 hover:text-black uppercase tracking-widest transition-colors font-bold">&larr; Back to Storefront</a>
        </div>
    </div>
</body>
</html>
