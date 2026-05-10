@extends('shop.layout')
@section('content')
<section class="hero-page" style="background-image: url('https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=2000');">
    <div class="hero-overlay"></div>
    <div class="relative z-10 text-center text-white section-padding">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">About Wer</h1>
        <p class="text-lg font-medium">Redefining modern retail since 2025.</p>
    </div>
</section>

<section class="py-24 section-padding bg-transparent">
    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
        <div class="aspect-square bg-[#f5f5f7] overflow-hidden rounded-2xl border border-gray-100">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2000" alt="Team" class="w-full h-full object-cover">
        </div>
        <div>
            <h2 class="text-3xl font-bold mb-6">Our Story</h2>
            <div class="space-y-4 text-gray-500 leading-relaxed">
                <p>At WER, we believe that quality should never be a luxury. We started with a simple idea: create a marketplace that prioritizes craftsmanship, sustainability, and transparency. Our curated selection of products is designed for those who value both style and substance.</p>
                <p>Every item in our store is handpicked for its unique story and exceptional quality. We partner with makers and brands that share our commitment to ethical production and timeless design.</p>
            </div>
        </div>
    </div>
</section>

<section class="bg-[#f5f5f7] py-24 section-padding border-t border-gray-100">
    <div class="w-full">
        <h2 class="text-3xl font-bold mb-12 text-center">Why Choose Us?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="bg-white p-8 rounded-2xl border border-gray-100">
                <div class="w-12 h-12 bg-[#f5f5f7] rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#0a0a0a]"><path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/></svg>
                </div>
                <h3 class="text-lg font-bold mb-3">Curated Quality</h3>
                <p class="text-gray-500 text-sm leading-relaxed">We don't just sell products; we curate experiences. Every item undergoes rigorous testing to ensure it meets our standards.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl border border-gray-100">
                <div class="w-12 h-12 bg-[#f5f5f7] rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#0a0a0a]"><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><circle cx="12" cy="12" r="4"/></svg>
                </div>
                <h3 class="text-lg font-bold mb-3">Ethical Sourcing</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Transparency is at our core. We work directly with artisans and manufacturers who prioritize fair labor and sustainable materials.</p>
            </div>
            <div class="bg-white p-8 rounded-2xl border border-gray-100">
                <div class="w-12 h-12 bg-[#f5f5f7] rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-[#0a0a0a]"><path d="M2 12h20"/><path d="M12 2v20"/><path d="m4.93 4.93 14.14 14.14"/><path d="m19.07 4.93-14.14 14.14"/></svg>
                </div>
                <h3 class="text-lg font-bold mb-3">Modern Design</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Minimalism meets functionality. Our products are designed to fit seamlessly into the modern, aesthetic lifestyle.</p>
            </div>
        </div>
    </div>
</section>
@endsection
