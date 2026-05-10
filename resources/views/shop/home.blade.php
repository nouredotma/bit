@extends('shop.layout')
@section('content')
<section class="hero-home" style="background-image: url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=2000');">
    <div class="hero-overlay"></div>
    <div class="relative z-10 text-center text-white section-padding">
        <h1 class="text-5xl md:text-7xl font-bold mb-6">Future of Retail</h1>
        <p class="text-lg md:text-xl mb-10 font-medium">Premium essentials for the modern lifestyle.</p>
        <a href="{{ route('products') }}" class="inline-block bg-white text-[#0a0a0a] px-8 py-3 font-semibold hover:bg-gray-100 transition-colors rounded-lg">Shop Collection</a>
    </div>
</section>

<!-- Categories Section -->
<section class="py-20 section-padding">
    <div class="w-full">
        <div class="mb-10 text-center">
            <h2 class="text-3xl font-bold mb-3">Shop by Category</h2>
            <p class="text-gray-500 text-sm">Explore our curated collections</p>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($categories as $category)
                <a href="{{ route('products', ['category' => $category->slug]) }}" class="group block text-center">
                    <div class="aspect-square bg-[#f5f5f7] mb-4 rounded-xl flex items-center justify-center transition-colors">
                        <span class="text-2xl font-bold text-gray-300 group-hover:text-[#0a0a0a] transition-colors">
                            {{ substr($category->name, 0, 1) }}
                        </span>
                    </div>
                    <h3 class="font-semibold text-[#0a0a0a]">{{ $category->name }}</h3>
                    <p class="text-gray-500 text-sm">{{ $category->products_count }} items</p>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-20 section-padding bg-transparent">
    <div class="w-full">
        <div class="flex justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-bold mb-2">Featured Products</h2>
                <p class="text-gray-500 text-sm">Our most popular items this season</p>
            </div>
            <a href="{{ route('products') }}" class="font-semibold text-sm hover:text-gray-600 transition-colors">View All &rarr;</a>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($products as $product)
                <div>
                    <a href="{{ route('products.show', $product->slug) }}">
                        <div class="aspect-[3/4] overflow-hidden bg-[#f5f5f7] mb-4 relative rounded-xl">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        </div>
                    </a>
                    <a href="{{ route('products.show', $product->slug) }}">
                        <h3 class="font-semibold text-base mb-1">{{ $product->name }}</h3>
                    </a>
                    <p class="text-gray-500 text-sm">${{ number_format($product->price, 2) }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="bg-[#0a0a0a] text-white py-24 section-padding text-center" id="newsletter">
    <div class="w-full">
        <h2 class="text-4xl font-bold mb-4">Join the evolution</h2>
        <p class="text-gray-400 mb-10">Subscribe to get early access to drops and exclusive offers.</p>
        <form id="newsletterForm" class="flex flex-col md:flex-row gap-4 justify-center">
            <input type="email" id="newsletterEmail" placeholder="Enter your email" class="bg-white/10 border border-white/20 rounded-lg px-5 py-3 w-full md:w-80 focus:outline-none focus:border-white text-white placeholder-gray-400 transition-colors" required>
            <button type="submit" class="bg-white text-[#0a0a0a] px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">Subscribe</button>
        </form>
        <p id="newsletterMsg" class="mt-4 text-sm hidden"></p>
    </div>
</section>

<script>
document.getElementById('newsletterForm').addEventListener('submit', async function(e) {
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
