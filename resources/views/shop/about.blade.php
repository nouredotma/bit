@extends('shop.layout')
@section('content')
<section class="hero-page" style="background-image: url('https://images.unsplash.com/photo-1551028719-00167b16eac5?q=80&w=2000');">
    <div class="hero-overlay"></div>
    <div class="relative z-10 text-center text-white">
        <h1 class="text-6xl font-bold tracking-tighter uppercase italic">About Wer</h1>
        <p class="text-lg tracking-widest uppercase opacity-80 mt-4">Redefining modern retail since 2025</p>
    </div>
</section>

<section class="py-24 px-10 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-20 items-center">
        <div class="aspect-square bg-gray-100 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=2000" alt="Team" class="w-full h-full object-cover">
        </div>
        <div>
            <h2 class="text-4xl font-bold tracking-tighter uppercase mb-6 italic">Our Story</h2>
            <p class="text-gray-600 leading-relaxed mb-6">At WER, we believe that quality should never be a luxury. We started with a simple idea: create a marketplace that prioritizes craftsmanship, sustainability, and transparency. Our curated selection of products is designed for those who value both style and substance.</p>
            <p class="text-gray-600 leading-relaxed">Every item in our store is handpicked for its unique story and exceptional quality. We partner with makers and brands that share our commitment to ethical production and timeless design.</p>
        </div>
    </div>
</section>

<section class="bg-gray-50 py-24 px-10">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-4xl font-bold tracking-tighter uppercase mb-16 italic">Why Choose Us?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-left">
            <div>
                <h3 class="text-xl font-bold uppercase mb-4 tracking-tight">Curated Quality</h3>
                <p class="text-gray-500 text-sm leading-relaxed">We don't just sell products; we curate experiences. Every item undergoes rigorous testing to ensure it meets our standards.</p>
            </div>
            <div>
                <h3 class="text-xl font-bold uppercase mb-4 tracking-tight">Ethical Sourcing</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Transparency is at our core. We work directly with artisans and manufacturers who prioritize fair labor and sustainable materials.</p>
            </div>
            <div>
                <h3 class="text-xl font-bold uppercase mb-4 tracking-tight">Modern Design</h3>
                <p class="text-gray-500 text-sm leading-relaxed">Minimalism meets functionality. Our products are designed to fit seamlessly into the modern, aesthetic lifestyle.</p>
            </div>
        </div>
    </div>
</section>
@endsection
