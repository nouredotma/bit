<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wer Store</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        @include('components.navbar')
        <main>
            @yield('content')
        </main>
        @include('components.footer')
        @include('components.cart-modal')
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const nav = document.querySelector('nav');
        const hasHero = document.querySelector('.hero-home, .hero-page');
        
        if (!hasHero && nav) {
            nav.classList.remove('header-transparent');
            nav.classList.add('header-white');
        }

        window.addEventListener('scroll', () => {
            if (!nav) return;
            if (window.scrollY > 50) {
                nav.classList.remove('header-transparent');
                nav.classList.add('header-white');
            } else if (hasHero) {
                nav.classList.add('header-transparent');
                nav.classList.remove('header-white');
            }
        });
    });
    </script>
</body>
</html>
