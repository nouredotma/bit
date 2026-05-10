<footer class="relative overflow-hidden py-64 section-padding" style="-webkit-mask-image: linear-gradient(to bottom, transparent 0%, black 30%); mask-image: linear-gradient(to bottom, transparent 0%, black 30%);">
    <video autoplay muted loop playsinline class="footer-video">
        <source src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260428_193507_4286c423-2fd9-4efd-92bd-91a939453fc1.mp4" type="video/mp4">
    </video>
    <div class="hero-overlay"></div>
    <div class="relative z-10">
        {{-- Row 1: 4 columns --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-10 md:gap-16 items-start">
            {{-- Column 1: Logo + Subtitle + Social Icons --}}
            <div class="col-span-2 md:col-span-1">
                <h2 class="text-8xl font-black tracking-tighter leading-none -mt-7 mb-2 text-white">wer.</h2>
                <p class="text-white/60 text-sm leading-relaxed mb-8 max-w-xs">Minimalist approach to modern essentials. Designed for the future, crafted for now.</p>
                <div class="flex items-center gap-4">
                    <a href="#" class="text-white/50 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"/>
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/>
                            <line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/>
                        </svg>
                    </a>
                    <a href="#" class="text-white/50 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 4s-.7 2.1-2 3.4c1.6 10-9.4 17.3-18 11.6 2.2.1 4.4-.6 6-2C3 15.5.5 9.6 3 5c2.2 2.6 5.6 4.1 9 4-.9-4.2 4-6.6 7-3.8 1.1 0 3-1.2 3-1.2z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-white/50 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                        </svg>
                    </a>
                    <a href="#" class="text-white/50 hover:text-white transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/>
                            <rect width="4" height="12" x="2" y="9"/>
                            <circle cx="4" cy="4" r="2"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Column 2: Navigation --}}
            <div>
                <h3 class="text-sm font-semibold mb-5 text-white uppercase tracking-wider">Navigation</h3>
                <ul class="space-y-3 text-sm text-white/50">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                    <li><a href="{{ route('products') }}" class="hover:text-white transition-colors">Products</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white transition-colors">About</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white transition-colors">Contact</a></li>
                </ul>
            </div>

            {{-- Column 3: Support --}}
            <div>
                <h3 class="text-sm font-semibold mb-5 text-white uppercase tracking-wider">Support</h3>
                <ul class="space-y-3 text-sm text-white/50">
                    <li><a href="#" class="hover:text-white transition-colors">Shipping & Delivery</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Return Policy</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                </ul>
            </div>

            {{-- Column 4: Products --}}
            <div>
                <h3 class="text-sm font-semibold mb-5 text-white uppercase tracking-wider">Products</h3>
                <ul class="space-y-3 text-sm text-white/50">
                    <li><a href="{{ route('products') }}" class="hover:text-white transition-colors">All Products</a></li>
                    <li><a href="{{ route('products', ['sort' => 'newest']) }}" class="hover:text-white transition-colors">New Arrivals</a></li>
                    <li><a href="{{ route('products', ['sort' => 'popular']) }}" class="hover:text-white transition-colors">Best Sellers</a></li>
                    <li><a href="{{ route('products', ['sort' => 'price_asc']) }}" class="hover:text-white transition-colors">On Sale</a></li>
                </ul>
            </div>
        </div>

        {{-- Row 2: Bottom bar --}}
        <div class="mt-12 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-white/40">
            <p>&copy; {{ date('Y') }} wer. All rights reserved.</p>
            <p class="italic">Move forward. Stay minimal. Own your future.</p>
        </div>
    </div>
</footer>
