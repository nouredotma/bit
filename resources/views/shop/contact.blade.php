@extends('shop.layout')
@section('content')
<section class="hero-page">
    <div class="hero-inner">
        <img src="{{ asset('images/hero2.png') }}" alt="Hero Background" class="hero-video">
        <div class="absolute bottom-3 left-0 z-10 text-left text-white px-3 md:px-9 max-w-5xl">
            <h1 class="text-2xl md:text-6xl font-light mb-2 tracking-tight">Get in Touch</h1>
            <p class="text-sm md:text-lg mb-5 font-light text-white/70 max-w-2xl tracking-tighter">
                We're here to help you.
            </p>
        </div>
    </div>
</section>

<section class="py-3 md:py-24 section-padding bg-transparent">
    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-20">
        <div>
            <h2 class="text-2xl md:text-5xl font-light text-[#0a0a0a] mb-10 leading-[1.1] tracking-tighter">Contact Info</h2>
            <div class="space-y-8">
                <div>
                    <h3 class="text-sm font-light text-gray-500 tracking-tighter mb-2">Our Store</h3>
                    <p class="text-lg text-[#0a0a0a] font-light tracking-tighter">Martil, Morocco</p>
                </div>
                <div>
                    <h3 class="text-sm font-light text-gray-500 tracking-tighter mb-2">Email Us</h3>
                    <p class="text-lg text-[#0a0a0a] font-light tracking-tighter underline decoration-gray-300 underline-offset-4 hover:decoration-[#0a0a0a] transition-colors">werdotma@gmail.com</p>
                </div>
                <div>
                    <h3 class="text-sm font-light text-gray-500 tracking-tighter mb-2">Call Us</h3>
                    <p class="text-lg text-[#0a0a0a] font-light tracking-tighter">+212704749027</p>
                </div>
                <div class="pt-8 border-t border-gray-100 flex gap-6">
                    <a href="https://instagram.com/wer.ma" target="_blank" class="font-light tracking-tighter text-sm hover:text-gray-500 transition-colors">Instagram</a>
                    <a href="https://x.com/wer.ma" target="_blank" class="font-light tracking-tighter text-sm hover:text-gray-500 transition-colors">Twitter</a>
                    <a href="https://facebook.com/wer.ma" target="_blank" class="font-light tracking-tighter text-sm hover:text-gray-500 transition-colors">Facebook</a>
                </div>
            </div>
        </div>
        <div>
            <h2 class="text-2xl md:text-5xl font-light text-[#0a0a0a] mb-10 leading-[1.1] tracking-tighter">Send a Message</h2>
            <contact-form></contact-form>
        </div>
    </div>
</section>
@endsection
