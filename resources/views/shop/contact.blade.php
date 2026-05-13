@extends('shop.layout')
@section('content')
<section class="hero-page">
    <div class="hero-inner">
        <video autoplay muted loop playsinline class="hero-video">
            <source
                src="https://d8j0ntlcm91z4.cloudfront.net/user_38xzZboKViGWJOttwIXH07lWA1P/hf_20260422_112520_ee819691-f2e8-4c54-bb77-3fb72c84eaa5.mp4"
                type="video/mp4">
        </video>
        <div class="hero-overlay"></div>
        <div class="absolute bottom-3 left-0 z-10 text-left text-white px-3 md:px-9 max-w-5xl">
            <h1 class="text-2xl md:text-5xl font-light mb-2 tracking-tight">Get in Touch</h1>
            <p class="text-sm md:text-base mb-5 font-light text-white/70 max-w-2xl tracking-tighter">
                We're here to help you.
            </p>
        </div>
    </div>
</section>

<section class="py-24 section-padding bg-transparent">
    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-20">
        <div>
            <h2 class="text-3xl font-bold mb-10">Contact Info</h2>
            <div class="space-y-8">
                <div>
                    <h3 class="text-sm font-bold text-gray-500 mb-2">Our Store</h3>
                    <p class="text-lg text-[#0a0a0a] font-medium">123 Design District, Modern City, MC 90210</p>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-gray-500 mb-2">Email Us</h3>
                    <p class="text-lg text-[#0a0a0a] font-medium underline decoration-gray-300 underline-offset-4 hover:decoration-[#0a0a0a] transition-colors">hello@wer.am</p>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-gray-500 mb-2">Call Us</h3>
                    <p class="text-lg text-[#0a0a0a] font-medium">+212704749027</p>
                </div>
                <div class="pt-8 border-t border-gray-100 flex gap-6">
                    <a href="https://instagram.com/wer.ma" target="_blank" class="font-semibold text-sm hover:text-gray-500 transition-colors">Instagram</a>
                    <a href="https://x.com/wer.ma" target="_blank" class="font-semibold text-sm hover:text-gray-500 transition-colors">Twitter</a>
                    <a href="https://facebook.com/wer.ma" target="_blank" class="font-semibold text-sm hover:text-gray-500 transition-colors">Facebook</a>
                </div>
            </div>
        </div>
        <div>
            <h2 class="text-3xl font-bold mb-10">Send a Message</h2>
            <contact-form></contact-form>
        </div>
    </div>
</section>
@endsection
