@extends('shop.layout')
@section('content')
<div class="pt-32 pb-24 section-padding bg-transparent">
    <div class="w-full grid grid-cols-1 lg:grid-cols-2 gap-16">
        <!-- Left: Image -->
        <div class="space-y-6">
            <div class="aspect-[4/5] bg-[#f5f5f7] overflow-hidden rounded-2xl">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            </div>
        </div>

        <!-- Right: Product Info -->
        <div class="flex flex-col">
            <nav class="flex gap-2 text-sm font-medium text-gray-500 mb-8">
                <a href="{{ route('home') }}" class="hover:text-[#0a0a0a] transition-colors">Home</a>
                <span>/</span>
                <a href="{{ route('products') }}" class="hover:text-[#0a0a0a] transition-colors">Products</a>
                <span>/</span>
                <span class="text-[#0a0a0a]">{{ $product->name }}</span>
            </nav>

            <h1 class="text-4xl font-bold mb-4">{{ $product->name }}</h1>
            <p class="text-2xl font-semibold mb-6">${{ number_format($product->price, 2) }}</p>
            
            <div class="flex items-center gap-4 mb-8 pb-8 border-b border-gray-100">
                <span class="inline-flex items-center gap-2 text-sm font-medium {{ $product->stock > 0 ? 'text-green-600' : 'text-red-500' }}">
                    <span class="h-2 w-2 {{ $product->stock > 0 ? 'bg-green-600' : 'bg-red-500' }} rounded-full"></span>
                    {{ $product->stock > 0 ? $product->stock . ' in stock' : 'Out of Stock' }}
                </span>
                @if($product->category)
                <span class="text-sm text-gray-500 bg-[#f5f5f7] px-3 py-1 rounded-full">{{ $product->category->name }}</span>
                @endif
            </div>

            <div class="prose prose-sm text-gray-500 mb-10 leading-relaxed">
                <p>{{ $product->description }}</p>
            </div>

            <div class="space-y-6 mt-auto">
                @if($product->stock > 0)
                <div class="flex flex-col gap-2">
                    <span class="text-sm font-medium text-[#0a0a0a]">Quantity</span>
                    <div class="flex items-center w-32 border border-gray-200 rounded-lg p-1 bg-[#f5f5f7]">
                        <button onclick="decrement()" class="w-10 h-10 flex items-center justify-center hover:bg-white rounded-md transition-colors text-lg font-medium">-</button>
                        <input id="qty" type="number" value="1" min="1" max="{{ $product->stock }}" class="w-full text-center font-semibold bg-transparent focus:outline-none [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                        <button onclick="increment()" class="w-10 h-10 flex items-center justify-center hover:bg-white rounded-md transition-colors text-lg font-medium">+</button>
                    </div>
                </div>

                <button onclick="addToCart()" class="w-full btn-primary py-4 flex items-center justify-center gap-3">
                    <span>Add to Cart</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </button>
                @else
                <button disabled class="w-full bg-gray-200 text-gray-500 py-4 rounded-lg font-semibold cursor-not-allowed">
                    Out of Stock
                </button>
                @endif

                <div class="grid grid-cols-2 gap-4 pt-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#f5f5f7] rounded-full flex items-center justify-center text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                        </div>
                        <span class="text-sm font-medium">Secure Payment</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#f5f5f7] rounded-full flex items-center justify-center text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/></svg>
                        </div>
                        <span class="text-sm font-medium">2 Year Warranty</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->count() > 0)
    <section class="w-full mt-24 pt-16 border-t border-gray-100">
        <h2 class="text-2xl font-bold mb-8">You May Also Like</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($relatedProducts as $related)
            <div>
                <a href="{{ route('products.show', $related->slug) }}">
                    <div class="aspect-[3/4] overflow-hidden bg-[#f5f5f7] mb-4 relative rounded-xl">
                        <img src="{{ $related->image }}" alt="{{ $related->name }}" class="w-full h-full object-cover">
                    </div>
                </a>
                <h3 class="font-semibold text-base mb-1">{{ $related->name }}</h3>
                <p class="text-gray-500 text-sm">${{ number_format($related->price, 2) }}</p>
            </div>
            @endforeach
        </div>
    </section>
    @endif
</div>

<script>
    const maxStock = {{ $product->stock }};
    function increment() {
        const input = document.getElementById('qty');
        if (parseInt(input.value) < maxStock) {
            input.value = parseInt(input.value) + 1;
        }
    }
    function decrement() {
        const input = document.getElementById('qty');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
    function addToCart() {
        const product = @json($product);
        const qty = parseInt(document.getElementById('qty').value);
        window.dispatchEvent(new CustomEvent('add-to-cart', {
            detail: {
                id: product.id,
                name: product.name,
                price: product.price,
                image: product.image,
                quantity: qty
            }
        }));
    }
</script>
@endsection
