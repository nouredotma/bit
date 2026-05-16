@extends('shop.layout')
@section('content')
    <section class="hero-page">
        <div class="hero-inner">
            <img src="{{ asset('images/hero2.png') }}" alt="Hero Background" class="hero-video">
            <div class="absolute bottom-3 left-0 z-10 text-left text-white px-3 md:px-9 max-w-5xl">
                <h1 class="text-2xl md:text-5xl font-light mb-1 tracking-tight">Support</h1>
                <p class="text-sm md:text-base mb-5 font-light text-white/70 max-w-2xl tracking-tighter">
                    Everything you need to know about our services and policies.
                </p>
            </div>
        </div>
    </section>

    <section class="py-3 md:py-8 section-padding bg-white">
        <div class="w-full flex flex-col md:flex-row gap-10">
            <!-- Sidebar -->
            <aside class="md:w-1/5">
                <div class="sticky top-40 p-5 bg-surface border-2 border-neutral-200 rounded-xl md:rounded-3xl transition-all duration-300">
                    <h2 class="text-lg font-black tracking-tighter leading-none px-4 py-2.5">Quick Links</h2>
                    <nav id="support-nav" class="flex flex-col gap-1">
                        <a href="#shipping-delivery" class="support-nav-link text-gray-500 transition-all font-medium text-[10px] inline-block w-full px-4 py-2.5 tracking-widest rounded-full hover:bg-white/60 hover:text-[#0a0a0a] [&.nav-active]:bg-white [&.nav-active]:text-[#0a0a0a]">
                            Shipping & Delivery
                        </a>
                        <a href="#return-policy" class="support-nav-link text-gray-500 transition-all font-medium text-[10px] inline-block w-full px-4 py-2.5 tracking-widest rounded-full hover:bg-white/60 hover:text-[#0a0a0a] [&.nav-active]:bg-white [&.nav-active]:text-[#0a0a0a]">
                            Return Policy
                        </a>
                        <a href="#privacy-policy" class="support-nav-link text-gray-500 transition-all font-medium text-[10px] inline-block w-full px-4 py-2.5 tracking-widest rounded-full hover:bg-white/60 hover:text-[#0a0a0a] [&.nav-active]:bg-white [&.nav-active]:text-[#0a0a0a]">
                            Privacy Policy
                        </a>
                        <a href="#terms-of-service" class="support-nav-link text-gray-500 transition-all font-medium text-[10px] inline-block w-full px-4 py-2.5 tracking-widest rounded-full hover:bg-white/60 hover:text-[#0a0a0a] [&.nav-active]:bg-white [&.nav-active]:text-[#0a0a0a]">
                            Terms of Services
                        </a>
                    </nav>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="md:w-4/5 space-y-8">
                <!-- Shipping & Delivery -->
                <div id="shipping-delivery" class="support-section scroll-mt-48 p-6 md:p-10 bg-surface border-2 border-neutral-200 rounded-xl md:rounded-3xl transition-all duration-500">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center border border-neutral-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#0a0a0a]"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2"/><path d="M15 18H9"/><path d="M19 18h2a1 1 0 0 0 1-1v-5l-4-4h-3v10"/><circle cx="7" cy="18" r="2"/><circle cx="17" cy="18" r="2"/></svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black tracking-tighter leading-none">Shipping & Delivery</h2>
                            <div class="h-1 w-8 bg-black mt-2 rounded-full"></div>
                        </div>
                    </div>
                    
                    <div class="prose prose-neutral max-w-none space-y-6 text-gray-500 font-light leading-relaxed">
                        <p class="text-base">At WER, we strive to deliver your orders as quickly and efficiently as possible. We ship all orders from our warehouse in Morocco.</p>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="bg-white/50 p-5 rounded-xl border border-neutral-100">
                                <h3 class="text-[10px] font-bold tracking-widest text-[#0a0a0a] mb-3">Domestic (Morocco)</h3>
                                <p class="text-xs">Standard delivery typically takes 2-5 business days. Free shipping on orders over 1000 MAD.</p>
                            </div>
                            <div class="bg-white/50 p-5 rounded-xl border border-neutral-100">
                                <h3 class="text-[10px] font-bold tracking-widest text-[#0a0a0a] mb-3">International</h3>
                                <p class="text-xs">Worldwide shipping takes 7-14 business days. Costs calculated at checkout based on location.</p>
                            </div>
                        </div>
                        
                        <p class="text-xs italic">Note: International orders may be subject to import duties and taxes, which are the responsibility of the customer.</p>
                    </div>
                </div>

                <!-- Return Policy -->
                <div id="return-policy" class="support-section scroll-mt-48 p-6 md:p-10 bg-surface border-2 border-neutral-200 rounded-xl md:rounded-3xl transition-all duration-500">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center border border-neutral-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#0a0a0a]"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/><path d="m12 7-5 5 5 5"/></svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black tracking-tighter leading-none">Return Policy</h2>
                            <div class="h-1 w-8 bg-black mt-2 rounded-full"></div>
                        </div>
                    </div>
                    
                    <div class="prose prose-neutral max-w-none space-y-6 text-gray-500 font-light leading-relaxed">
                        <p class="text-base">We want you to be completely satisfied with your purchase. If for any reason you are not happy, you can return your items within 14 days of delivery.</p>
                        
                        <div class="bg-white/50 p-6 rounded-xl border border-neutral-100">
                            <h3 class="text-[10px] font-bold tracking-widest text-[#0a0a0a] mb-4">Conditions for Returns</h3>
                            <ul class="grid md:grid-cols-3 gap-4 list-none p-0 m-0">
                                <li class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-green-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <span class="text-xs">Unworn, unwashed, original condition.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-green-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <span class="text-xs">Original tags must be attached.</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <svg class="w-4 h-4 text-green-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <span class="text-xs">Returned in original packaging.</span>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="flex flex-col md:flex-row items-center justify-between gap-4 p-5 bg-black text-white rounded-xl">
                            <p class="m-0 text-sm font-medium">Ready to start a return?</p>
                            <a href="mailto:werdotma@gmail.com" class="bg-white text-black px-6 py-2.5 rounded-full font-bold text-[10px] tracking-widest hover:bg-neutral-200 transition-colors">Contact Support</a>
                        </div>
                    </div>
                </div>

                <!-- Privacy Policy -->
                <div id="privacy-policy" class="support-section scroll-mt-48 p-6 md:p-10 bg-surface border-2 border-neutral-200 rounded-xl md:rounded-3xl transition-all duration-500">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center border border-neutral-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#0a0a0a]"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black tracking-tighter leading-none">Privacy Policy</h2>
                            <div class="h-1 w-8 bg-black mt-2 rounded-full"></div>
                        </div>
                    </div>
                    
                    <div class="prose prose-neutral max-w-none space-y-6 text-gray-500 font-light leading-relaxed">
                        <p class="text-base">Your privacy is important to us. This Privacy Policy explains how we collect, use, and protect your personal information when you use our website.</p>
                        
                        <div class="space-y-4">
                            <div class="group">
                                <h3 class="text-[10px] font-bold tracking-widest text-[#0a0a0a] mb-2">Data Collection</h3>
                                <p class="text-xs">We collect information such as your name, email address, shipping address, and payment details when you place an order or sign up for our newsletter.</p>
                            </div>
                            <div class="group border-t border-neutral-200 pt-4">
                                <h3 class="text-[10px] font-bold tracking-widest text-[#0a0a0a] mb-2">How We Use Your Information</h3>
                                <p class="text-xs">We use your data to process orders, improve our services, and communicate with you about your account or our products. We never sell your personal information to third parties.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Terms of Services -->
                <div id="terms-of-service" class="support-section scroll-mt-48 p-6 md:p-10 bg-surface border-2 border-neutral-200 rounded-xl md:rounded-3xl transition-all duration-500">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center border border-neutral-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#0a0a0a]"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black tracking-tighter leading-none">Terms of Services</h2>
                            <div class="h-1 w-8 bg-black mt-2 rounded-full"></div>
                        </div>
                    </div>
                    
                    <div class="prose prose-neutral max-w-none space-y-6 text-gray-500 font-light leading-relaxed">
                        <p class="text-base">By using the WER website, you agree to comply with and be bound by the following terms and conditions of use.</p>
                        
                        <div class="grid md:grid-cols-2 gap-x-8 gap-y-6">
                            <div>
                                <h3 class="text-[10px] font-bold tracking-widest text-[#0a0a0a] mb-2">Use of Website</h3>
                                <p class="text-xs">The content of this website is for your general information and use only. It is subject to change without notice.</p>
                            </div>
                            <div>
                                <h3 class="text-[10px] font-bold tracking-widest text-[#0a0a0a] mb-2">Intellectual Property</h3>
                                <p class="text-xs">This website contains material which is owned by or licensed to us, including design, layout, and graphics.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sections = document.querySelectorAll('.support-section');
            const navLinks = document.querySelectorAll('.support-nav-link');

            const observerOptions = {
                root: null,
                rootMargin: '-5% 0px -45% 0px',
                threshold: 0
            };

            const observerCallback = (entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.getAttribute('id');
                        
                        // Update nav links
                        navLinks.forEach(link => {
                            if (link.hash === `#${id}`) {
                                link.classList.add('nav-active');
                            } else {
                                link.classList.remove('nav-active');
                            }
                        });

                        // Subtle feedback on active section
                        sections.forEach(s => {
                            if (s.id === id) {
                                s.style.borderColor = '#0a0a0a';
                            } else {
                                s.style.borderColor = '#e5e5e5';
                            }
                        });
                    }
                });
            };

            // Handle clicks for immediate feedback
            navLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    navLinks.forEach(l => l.classList.remove('nav-active'));
                    link.classList.add('nav-active');
                });
            });

            const observer = new IntersectionObserver(observerCallback, observerOptions);
            sections.forEach(section => observer.observe(section));

            // Initial check if hash exists or default to first
            if (window.location.hash) {
                navLinks.forEach(link => {
                    if (link.hash === window.location.hash) {
                        link.classList.add('nav-active');
                    }
                });
            } else {
                navLinks[0].classList.add('nav-active');
            }
        });
    </script>
@endsection