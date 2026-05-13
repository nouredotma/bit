@php
    $scrollerProducts = \App\Models\Product::all();
@endphp

<footer class="relative overflow-hidden pt-28 pb-2 section-padding bg-[#0a0a0a]">
    <div class="relative z-10">
        {{-- Row 1: 4 columns --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-10 md:gap-16 items-start">
            {{-- Column 1: Logo + Subtitle + Social Icons --}}
            <div class="col-span-2 md:col-span-1">
                <h2 class="text-8xl font-black tracking-tighter leading-none -mt-7 mb-2 text-white">wer.</h2>
                <p class="text-white text-sm tracking-tighter mb-8 max-w-xs font-light">Minimalist approach to modern essentials. Designed for the future, crafted for now.</p>
                <p class="text-sm text-white/80 font-light">Created by <a href="https://noure.ma" target="_blank" class="footer-link text-white link-underline"><span class="footer-link-text" data-text="Noureddine">Noureddine</span></a></p>
            </div>

            {{-- Column 2: Navigation --}}
            <div>
                <h3 class="text-sm md:text-base font-semibold mb-4 text-white tracking-tight">Navigation</h3>
                <ul class="space-y-3 text-sm text-white/50 font-light">
                    <li><a href="{{ route('home') }}" class="footer-link"><span class="footer-link-text" data-text="Home">Home</span></a></li>
                    <li><a href="{{ route('home') }}#products-section" class="footer-link"><span class="footer-link-text" data-text="Products">Products</span></a></li>
                    <li><a href="{{ route('about') }}" class="footer-link"><span class="footer-link-text" data-text="About">About</span></a></li>
                    <li><a href="{{ route('contact') }}" class="footer-link"><span class="footer-link-text" data-text="Contact">Contact</span></a></li>
                </ul>
            </div>

            {{-- Column 3: Support --}}
            <div>
                <h3 class="text-sm md:text-base font-semibold mb-4 text-white tracking-tight">Support</h3>
                <ul class="space-y-3 text-sm text-white/50 font-light">
                    <li><a href="#" class="footer-link"><span class="footer-link-text" data-text="Shipping & Delivery">Shipping & Delivery</span></a></li>
                    <li><a href="#" class="footer-link"><span class="footer-link-text" data-text="Return Policy">Return Policy</span></a></li>
                    <li><a href="#" class="footer-link"><span class="footer-link-text" data-text="Privacy Policy">Privacy Policy</span></a></li>
                    <li><a href="#" class="footer-link"><span class="footer-link-text" data-text="Terms of Service">Terms of Service</span></a></li>
                </ul>
            </div>

            {{-- Column 4: Products --}}
            <div>
                <h3 class="text-sm md:text-base font-semibold mb-4 text-white tracking-tight">Products</h3>
                <ul class="space-y-3 text-sm text-white/50 font-light">
                    @foreach($scrollerProducts as $product)
                    <li><a href="{{ route('products.show', $product->slug) }}" class="footer-link"><span class="footer-link-text" data-text="{{ $product->name }}">{{ $product->name }}</span></a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- Row 2: Bottom bar --}}
        <div class="mt-12 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between font-light items-center gap-4 text-sm text-white/50">
            <p>&copy; {{ date('Y') }} wer. All rights reserved.</p>
            <div class="flex items-center gap-8">
                <a href="https://instagram.com/wer.ma" target="_blank" class="footer-link"><span class="footer-link-text" data-text="Instagram">Instagram</span></a>
                <a href="https://x.com/wer.ma" target="_blank" class="footer-link"><span class="footer-link-text" data-text="X (Twitter)">X (Twitter)</span></a>
                <a href="https://facebook.com/wer.ma" target="_blank" class="footer-link"><span class="footer-link-text" data-text="Facebook">Facebook</span></a>
            </div>
        </div>

        {{-- Row 3: Infinite Scroller (Images) --}}
        @if($scrollerProducts->count() > 0)
            <div class="mt-4 -mx-3 md:-mx-12">
                <div class="scroller" data-animated="true" data-speed="slow">
                    <div class="scroller__inner">
                        @foreach($scrollerProducts->concat($scrollerProducts)->concat($scrollerProducts) as $product)
                            <a href="{{ route('home') }}#products-section" class="block">
                                <img src="{{ $product->main_image }}" alt="{{ $product->name }}" class="h-24 md:h-32 aspect-square object-cover rounded-sm">
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</footer>
