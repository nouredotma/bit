@extends('shop.layout')
@section('content')
<section class="hero-page" style="background-image: url('https://images.unsplash.com/photo-1423666639041-f56000c27a9a?q=80&w=2000');">
    <div class="hero-overlay"></div>
    <div class="relative z-10 text-center text-white section-padding">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">Get in Touch</h1>
        <p class="text-lg font-medium">We're here to help you.</p>
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
                    <p class="text-lg text-[#0a0a0a] font-medium underline decoration-gray-300 underline-offset-4 hover:decoration-[#0a0a0a] transition-colors">hello@werstore.com</p>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-gray-500 mb-2">Call Us</h3>
                    <p class="text-lg text-[#0a0a0a] font-medium">+1 (555) 123-4567</p>
                </div>
                <div class="pt-8 border-t border-gray-100 flex gap-6">
                    <a href="#" class="font-semibold text-sm hover:text-gray-500 transition-colors">Instagram</a>
                    <a href="#" class="font-semibold text-sm hover:text-gray-500 transition-colors">Twitter</a>
                    <a href="#" class="font-semibold text-sm hover:text-gray-500 transition-colors">Pinterest</a>
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
