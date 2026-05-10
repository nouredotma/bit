<nav id="main-nav" class="header-transparent flex items-center justify-between section-padding py-3">
    <div class="flex items-center gap-8">
        <a href="{{ route('home') }}" class="text-3xl font-black tracking-tighter">wer.</a>
        <div class="hidden md:flex items-center gap-6 text-sm font-medium">
            <a href="{{ route('products') }}" class="hover:opacity-70 transition-opacity">Products</a>
            <a href="{{ route('about') }}" class="hover:opacity-70 transition-opacity">About</a>
            <a href="{{ route('contact') }}" class="hover:opacity-70 transition-opacity">Contact</a>
        </div>
    </div>
    <div class="flex items-center gap-4">
        <mini-cart></mini-cart>
    </div>
</nav>
