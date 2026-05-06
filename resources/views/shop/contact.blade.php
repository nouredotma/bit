@extends('shop.layout')
@section('content')
<section class="hero-page" style="background-image: url('https://images.unsplash.com/photo-1423666639041-f56000c27a9a?q=80&w=2000');">
    <div class="hero-overlay"></div>
    <div class="relative z-10 text-center text-white">
        <h1 class="text-6xl font-bold tracking-tighter uppercase italic">Get in Touch</h1>
        <p class="text-lg tracking-widest uppercase opacity-80 mt-4">We're here to help you</p>
    </div>
</section>

<section class="py-24 px-10 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-20">
        <div>
            <h2 class="text-4xl font-bold tracking-tighter uppercase mb-8 italic">Contact Info</h2>
            <div class="space-y-8">
                <div>
                    <h3 class="text-xs uppercase tracking-widest font-bold text-gray-400 mb-2">Our Store</h3>
                    <p class="text-xl">123 Design District, Modern City, MC 90210</p>
                </div>
                <div>
                    <h3 class="text-xs uppercase tracking-widest font-bold text-gray-400 mb-2">Email Us</h3>
                    <p class="text-xl underline decoration-2 underline-offset-4">hello@werstore.com</p>
                </div>
                <div>
                    <h3 class="text-xs uppercase tracking-widest font-bold text-gray-400 mb-2">Call Us</h3>
                    <p class="text-xl">+1 (555) 123-4567</p>
                </div>
                <div class="pt-8 border-t border-gray-100 flex gap-6">
                    <a href="#" class="uppercase tracking-widest font-bold text-xs hover:opacity-50">Instagram</a>
                    <a href="#" class="uppercase tracking-widest font-bold text-xs hover:opacity-50">Twitter</a>
                    <a href="#" class="uppercase tracking-widest font-bold text-xs hover:opacity-50">Pinterest</a>
                </div>
            </div>
        </div>
        <div>
            <h2 class="text-4xl font-bold tracking-tighter uppercase mb-8 italic">Send a Message</h2>
            <contact-form></contact-form>
        </div>
    </div>
</section>
@endsection
