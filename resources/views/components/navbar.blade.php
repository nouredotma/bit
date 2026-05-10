{{-- Logo: Separate fixed element so mix-blend-mode can blend against page content --}}
<a href="{{ route('home') }}" class="nav-logo section-padding">wer.</a>

{{-- Nav pill: Fixed on the right --}}
<nav id="main-nav" class="nav-header section-padding">
    <div class="nav-pill">
        <div class="hidden md:flex items-center gap-1">
            <a href="{{ route('products') }}" class="nav-link">Products</a>
            <a href="{{ route('about') }}" class="nav-link">About</a>
            <a href="{{ route('contact') }}" class="nav-link">Contact</a>
        </div>
        <mini-cart></mini-cart>
    </div>
</nav>
