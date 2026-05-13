@extends('shop.layout')
@section('content')
    <section class="hero-home">
        <div class="hero-inner">
            <video autoplay muted loop playsinline class="hero-video">
                <source
                    src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260422_112520_ee819691-f2e8-4c54-bb77-3fb72c84eaa5.mp4"
                    type="video/mp4">
            </video>
            <div class="hero-overlay"></div>
            <div class="absolute bottom-3 md:bottom-9 left-0 z-10 text-left text-white px-3 md:px-9 max-w-5xl">
                <h1 class="text-2xl md:text-6xl font-light mb-2 tracking-tight">Moroccan Roots. Modern Essentials.</h1>
                <p class="text-sm md:text-lg mb-5 font-light text-white/70 max-w-2xl tracking-tighter">
                    Signature hats, heavyweight hoodies, and premium streetwear. Designed in Morocco for the modern world.
                </p>
                <a href="#products-section"
                    class="group inline-flex items-center gap-8 pl-5 pr-1 py-1 rounded-full bg-white text-black font-light transition-all duration-500 text-base tracking-tight">
                    <span>Explore the Drop</span>
                    <div class="w-11 h-11 bg-black rounded-full flex items-center justify-center overflow-hidden relative">
                        <div
                            class="relative w-5 h-5 transition-transform duration-[400ms] ease-out group-hover:translate-x-8 group-hover:-translate-y-8">
                            <svg class="absolute inset-0 w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                            <svg class="absolute inset-0 w-5 h-5 text-white -translate-x-8 translate-y-8"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                        </div>
                    </div>
                </a>
            </div>

            {{-- Bottom-right inverse-radius cutout with scroll indicator --}}
            <div class="absolute bottom-0 right-0 bg-white rounded-tl-[1rem] md:rounded-tl-[2rem] z-10">
                {{-- Top concave SVG mask --}}
                <div
                    class="absolute -top-[1.5rem] md:-top-[2.5rem] right-0 w-[1.5rem] md:w-[2.5rem] h-[1.5rem] md:h-[2.5rem] pointer-events-none">
                    <svg width="100%" height="100%" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M56 56V0C56 30.9279 30.9279 56 0 56H56Z" fill="white" />
                    </svg>
                </div>
                {{-- Left concave SVG mask --}}
                <div
                    class="absolute bottom-0 -left-[1.5rem] md:-left-[2.5rem] w-[1.5rem] md:w-[2.5rem] h-[1.5rem] md:h-[2.5rem] pointer-events-none">
                    <svg width="100%" height="100%" viewBox="0 0 56 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M56 56H0C30.9279 56 56 30.9279 56 0V56Z" fill="white" />
                    </svg>
                </div>
                {{-- Scroll indicator (centered in visible white area) --}}
                <div onclick="document.querySelector('.hero-home').nextElementSibling.scrollIntoView({behavior:'smooth'})"
                    class="flex items-center gap-3 md:gap-4 px-4 py-2 md:px-6 md:pl-3 md:py-3 cursor-pointer group">
                    <div
                        class="w-10 h-10 md:w-12 md:h-12 rounded-full bg-[#0a0a0a] flex items-center justify-center overflow-hidden relative">
                        <div
                            class="relative w-5 h-5 transition-transform duration-[400ms] ease-out group-hover:translate-y-8">
                            <svg class="absolute inset-0 w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 5v14" />
                                <path d="m19 12-7 7-7-7" />
                            </svg>
                            <svg class="absolute inset-0 w-5 h-5 text-white -translate-y-8"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 5v14" />
                                <path d="m19 12-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <span class="text-sm font-medium text-[#0a0a0a]">Scroll</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products-section" class="pt-12 section-padding scroll-mt-20">
        <div class="w-full">
            <div class="grid grid-cols-2 gap-3 md:gap-12">
                @foreach($products as $index => $product)
                    <a href="{{ route('products.show', $product->slug) }}"
                        class="group relative aspect-square overflow-hidden rounded-xl md:rounded-4xl bg-neutral-100">
                        <img src="{{ $product->main_image }}" alt="{{ $product->name }}"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">

                        <!-- Content -->
                        <div class="absolute inset-0">
                            <!-- Top Right: View Details (Hero Style) -->
                            <div class="absolute top-4 right-4 md:top-6 md:right-6 z-20">
                                <div
                                    class="inline-flex items-center gap-3 md:gap-5 pl-4 pr-1 py-1 rounded-full bg-white text-black font-light transition-all duration-500 text-[10px] md:text-sm tracking-tight opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0">
                                    <span class="hidden md:inline">View Details</span>
                                    <div
                                        class="w-7 h-7 md:w-10 md:h-10 bg-[#0a0a0a] rounded-full flex items-center justify-center overflow-hidden relative">
                                        <div
                                            class="relative w-3.5 h-3.5 md:w-5 md:h-5 transition-transform duration-[400ms] ease-out group-hover:translate-x-8 group-hover:-translate-y-8">
                                            <svg class="absolute inset-0 w-full h-full text-white"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                                <polyline points="7 7 17 7 17 17"></polyline>
                                            </svg>
                                            <svg class="absolute inset-0 w-full h-full text-white -translate-x-8 translate-y-8"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2.5" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <line x1="7" y1="17" x2="17" y2="7"></line>
                                                <polyline points="7 7 17 7 17 17"></polyline>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Bottom: Name and Price -->
                            <div class="absolute bottom-3 left-3 right-3 md:bottom-6 md:left-6 md:right-6 flex items-end justify-between text-white">
                                <h3 class="text-sm md:text-5xl font-light tracking-tight leading-none">{{ $product->name }}</h3>
                                <div class="text-right shrink-0 leading-none">
                                    <span class="text-xs md:text-3xl font-light tracking-tighter leading-none">{{ number_format($product->price, 2) }} MAD</span>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Newsletter Section -->
    <section class="py-12 section-padding" id="newsletter">
        <div class="relative overflow-hidden rounded-2xl md:rounded-4xl p-6 md:p-12">
            <!-- Video Background -->
            <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
                <source
                    src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260328_115001_bcdaa3b4-03de-47e7-ad63-ae3e392c32d4.mp4"
                    type="video/mp4">
            </video>
            <div class="absolute inset-0 bg-black/30"></div>

            <div class="relative z-10 w-full">
                <div class="grid lg:grid-cols-2 gap-5 items-center">
                    <!-- Left Content -->
                    <div class="text-left">
                        <h2 class="text-2xl md:text-5xl font-light text-white mb-2 leading-[1.1] tracking-tighter">
                            Define Your New Standard
                        </h2>
                        <p class="text-white/80 text-sm md:text-base font-light tracking-tighter">
                            At Wer, we believe in the power of intentionality. Our curated collections are more than just
                            products; they are a reflection of a modern philosophy that values quality, sustainability, and
                            timeless design. By joining our inner circle, you’ll receive early access to our limited
                            seasonal drops, exclusive behind-the-scenes insights from our studio, and curated content
                            designed to inspire your journey. This is your gateway to a refined lifestyle, where every
                            detail is considered and every piece tells a story.
                        </p>

                        <!-- Social Proof -->
                        <div class="flex items-center gap-4 mt-4">
                            <div class="flex -space-x-3">
                                <img src="https://images.pexels.com/photos/6102841/pexels-photo-6102841.jpeg"
                                    alt="Subscriber" class="w-10 h-10 rounded-full border-2 border-white/10 object-cover">
                                <img src="https://images.pexels.com/photos/10634704/pexels-photo-10634704.jpeg"
                                    alt="Subscriber" class="w-10 h-10 rounded-full border-2 border-white/10 object-cover">
                                <img src="https://images.pexels.com/photos/11718221/pexels-photo-11718221.jpeg"
                                    alt="Subscriber" class="w-10 h-10 rounded-full border-2 border-white/10 object-cover">
                                <img src="https://images.pexels.com/photos/9696165/pexels-photo-9696165.jpeg"
                                    alt="Subscriber" class="w-10 h-10 rounded-full border-2 border-white/10 object-cover">
                            </div>
                            <span class="text-white/90 text-sm font-light tracking-tighter">
                                <span class="font-medium">600+</span> individuals already joined
                            </span>
                        </div>
                    </div>

                    <!-- Right Content (Newsletter) -->
                    <div class="flex justify-center lg:justify-end">
                        <form id="newsletterForm" class="w-full max-w-md">
                            <div class="relative p-1 bg-white/10 backdrop-blur-xl border border-white/20 rounded-full focus-within:border-white transition-all">
                                <input type="email" id="newsletterEmail" placeholder="Enter your email"
                                    class="bg-transparent pl-5 md:pl-8 pr-24 md:pr-32 py-2.5 md:py-3.5 w-full focus:outline-none text-white text-sm md:text-base placeholder-white/40 font-medium"
                                    required>
                                <button type="submit"
                                    class="absolute right-1 top-1 bottom-1 bg-white text-[#0a0a0a] px-5 md:px-8 rounded-full font-bold hover:bg-neutral-100 transition-all text-[10px] md:text-xs tracking-widest cursor-pointer">
                                    Subscribe
                                </button>
                            </div>
                            <p id="newsletterMsg" class="mt-4 text-xs font-medium hidden text-center lg:text-left px-4"></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('newsletterForm').addEventListener('submit', async function (e) {
            e.preventDefault();
            const email = document.getElementById('newsletterEmail').value;
            const msg = document.getElementById('newsletterMsg');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            try {
                const res = await fetch('/newsletter', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' },
                    body: JSON.stringify({ email })
                });
                const data = await res.json();
                msg.classList.remove('hidden', 'text-red-400');
                if (data.success) {
                    msg.classList.add('text-green-400');
                    msg.textContent = data.message;
                    document.getElementById('newsletterEmail').value = '';
                } else {
                    msg.classList.add('text-red-400');
                    msg.textContent = data.message || 'Something went wrong.';
                }
            } catch (err) {
                msg.classList.remove('hidden');
                msg.classList.add('text-red-400');
                msg.textContent = err.message?.includes('email') ? 'This email is already subscribed.' : 'Something went wrong.';
            }
        });
    </script>
@endsection