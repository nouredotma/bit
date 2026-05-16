@extends('shop.layout')
@section('content')
<section class="pt-24 md:pt-32 pb-24 section-padding">
    <!-- Breadcrumb -->
    <nav class="flex text-[10px] md:text-xs font-light mb-6 md:mb-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-2">
            <li class="inline-flex items-center">
                <a href="{{ route('home') }}" class="text-gray-400 hover:text-black transition-colors duration-300">
                    Home
                </a>
            </li>
            <li>
                <div class="flex items-center">
                    <svg class="w-2 h-2 text-gray-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="text-black ml-1 md:ml-2">{{ $product->name }}</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 lg:gap-12 items-start">
        <!-- Image Gallery -->
        <div class="grid grid-cols-1 lg:grid-cols-6 gap-1 items-start">
            <!-- Thumbnails Column -->
            <div class="order-2 lg:order-1 lg:col-span-1">
                @if($product->thumbnail_images && count($product->thumbnail_images) > 0)
                <div class="flex flex-row lg:flex-col gap-1 overflow-x-auto lg:overflow-y-hidden pb-2 lg:pb-0">
                    <!-- Main Image Thumbnail -->
                    <div class="thumb-btn relative aspect-square w-20 lg:w-full bg-neutral-50 rounded-2xl overflow-hidden cursor-pointer hover:opacity-80 transition-opacity active-thumb"
                         onclick="document.getElementById('mainImage').src='{{ $product->main_image }}'; document.querySelectorAll('.thumb-btn').forEach(b => b.classList.remove('active-thumb')); this.classList.add('active-thumb')">
                        <div class="absolute inset-0 bg-neutral-200 animate-pulse z-0"></div>
                        <img src="{{ $product->main_image }}" class="absolute inset-0 w-full h-full object-cover opacity-0 z-10 transition-opacity duration-300" onload="this.classList.remove('opacity-0'); this.previousElementSibling.classList.add('hidden');">
                        <div class="absolute inset-0 border-2 border-black rounded-2xl pointer-events-none opacity-0 transition-opacity active-indicator z-20"></div>
                    </div>
                    <!-- Additional Thumbnails -->
                    @foreach($product->thumbnail_images as $thumb)
                    <div class="thumb-btn relative aspect-square w-20 lg:w-full bg-neutral-50 rounded-2xl overflow-hidden cursor-pointer hover:opacity-80 transition-opacity"
                         onclick="document.getElementById('mainImage').src='{{ $thumb }}'; document.querySelectorAll('.thumb-btn').forEach(b => b.classList.remove('active-thumb')); this.classList.add('active-thumb')">
                        <div class="absolute inset-0 bg-neutral-200 animate-pulse z-0"></div>
                        <img src="{{ $thumb }}" class="absolute inset-0 w-full h-full object-cover opacity-0 z-10 transition-opacity duration-300" onload="this.classList.remove('opacity-0'); this.previousElementSibling.classList.add('hidden');">
                        <div class="absolute inset-0 border-2 border-black rounded-2xl pointer-events-none opacity-0 transition-opacity active-indicator z-20"></div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Main Image Column -->
            <div class="order-1 lg:order-2 lg:col-span-5">
                <div class="aspect-square bg-neutral-50 rounded-3xl overflow-hidden relative">
                    <div class="absolute inset-0 bg-neutral-200 animate-pulse z-0"></div>
                    <img id="mainImage" src="{{ $product->main_image }}" alt="{{ $product->name }}" class="absolute inset-0 w-full h-full object-cover opacity-0 z-10 transition-opacity duration-300" onload="this.classList.remove('opacity-0'); this.previousElementSibling.classList.add('hidden');">
                </div>
            </div>
        </div>

        <!-- Product Details -->
        <div class="flex flex-col">
            <div class="mb-4 md:mb-6">
                <p class="text-[10px] text-gray-400 mb-1">Product #{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</p>
                <div class="flex flex-row items-baseline justify-between gap-x-2 md:gap-x-4 mb-4">
                    <h1 class="text-2xl md:text-5xl font-light tracking-tight">{{ $product->name }}</h1>
                    <p class="text-lg md:text-2xl font-medium text-gray-800 shrink-0">{{ number_format($product->price, 2) }} MAD</p>
                </div>
                <p class="text-gray-500 leading-relaxed font-light text-sm md:text-lg mb-4 md:mb-6 max-w-xl">
                    {{ $product->description ?? 'No description provided.' }}
                </p>
            </div>

            <div class="space-y-4 md:space-y-6">
                @if($product->sizes_available && count($product->sizes_available) > 0)
                <div class="space-y-3">
                    <h4 class="text-xs font-bold">Select Size</h4>
                    <div class="flex flex-wrap gap-3" id="size-selector">
                        @foreach($product->sizes_available as $size)
                        <button 
                            onclick="selectSize(this, '{{ $size }}')"
                            class="size-btn px-8 py-3 border-2 border-neutral-100 rounded-full text-sm font-medium transition-all duration-300 cursor-pointer hover:border-black">
                            {{ $size }}
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($product->colors_available && count($product->colors_available) > 0)
                <div class="space-y-3">
                    <h4 class="text-xs font-bold">Select Color</h4>
                    <div class="flex flex-wrap gap-3" id="color-selector">
                        @foreach($product->colors_available as $color)
                        <button 
                            onclick="selectColor(this, '{{ $color }}')"
                            class="color-btn px-8 py-3 border-2 border-neutral-100 rounded-full text-sm font-medium transition-all duration-300 cursor-pointer hover:border-black">
                            {{ $color }}
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="pt-4 md:pt-6 border-t border-neutral-100 space-y-4 md:space-y-6">
                    <div class="space-y-3">
                        <h4 class="text-xs font-bold">Quantity</h4>
                        <div class="flex items-center border-2 border-neutral-100 rounded-full w-fit px-4 py-2 bg-neutral-50/30">
                            <button onclick="updateQty(-1)" class="text-xl px-3 hover:text-gray-400 transition-colors cursor-pointer">-</button>
                            <input type="text" id="qty-input" value="1" readonly class="w-10 text-center bg-transparent outline-none font-medium text-sm">
                            <button onclick="updateQty(1)" class="text-xl px-3 hover:text-gray-400 transition-colors cursor-pointer">+</button>
                        </div>
                    </div>
                    
                    <button 
                        onclick="addToBag()"
                        class="w-full bg-black text-white px-12 py-5 rounded-full font-bold text-sm hover:bg-neutral-800 hover:scale-[1.01] active:scale-[0.99] transition-all duration-300 cursor-pointer">
                        Add to Cart — <span id="total-price">{{ number_format($product->price, 2) }}</span> MAD
                    </button>
                    <div id="error-message" class="text-red-500 text-xs font-medium mt-2 hidden"></div>
                </div>
            </div>
            
            <script>
                let selectedSize = '';
                let selectedColor = '';
                let quantity = 1;
                const basePrice = {{ $product->price }};

                function selectSize(btn, size) {
                    document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('border-black', 'bg-black', 'text-white'));
                    btn.classList.add('border-black', 'bg-black', 'text-white');
                    selectedSize = size;
                    document.getElementById('error-message').classList.add('hidden');
                }

                function selectColor(btn, color) {
                    document.querySelectorAll('.color-btn').forEach(b => b.classList.remove('border-black', 'bg-black', 'text-white'));
                    btn.classList.add('border-black', 'bg-black', 'text-white');
                    selectedColor = color;
                    document.getElementById('error-message').classList.add('hidden');
                }

                function updateQty(delta) {
                    quantity = Math.max(1, quantity + delta);
                    document.getElementById('qty-input').value = quantity;
                    document.getElementById('total-price').innerText = (basePrice * quantity).toLocaleString(undefined, {minimumFractionDigits: 2});
                }

                function addToBag() {
                    const availableSizes = {{ count($product->sizes_available ?? []) }};
                    const availableColors = {{ count($product->colors_available ?? []) }};
                    const errorEl = document.getElementById('error-message');

                    if (availableSizes > 0 && !selectedSize) {
                        errorEl.innerText = 'Please select a size before adding to cart';
                        errorEl.classList.remove('hidden');
                        return;
                    }
                    if (availableColors > 0 && !selectedColor) {
                        errorEl.innerText = 'Please select a color before adding to cart';
                        errorEl.classList.remove('hidden');
                        return;
                    }

                    errorEl.classList.add('hidden');

                    window.dispatchEvent(new CustomEvent('add-to-cart', {
                        detail: {
                            id: {{ $product->id }},
                            name: '{{ $product->name }}',
                            price: basePrice,
                            image: '{{ $product->main_image }}',
                            quantity: quantity,
                            size: selectedSize,
                            color: selectedColor
                        }
                    }));
                }
            </script>
            
            <div class="mt-6 md:mt-10 pt-6 md:pt-8 border-t border-neutral-100 grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-50/50 border border-emerald-100/50 transition-colors">
                    <div class="w-8 h-8 rounded-full bg-emerald-100/80 flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-emerald-900">Secure Checkout</p>
                        <p class="text-[10px] text-emerald-700/70">Encrypted payments</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 p-4 rounded-2xl bg-emerald-50/50 border border-emerald-100/50 transition-colors">
                    <div class="w-8 h-8 rounded-full bg-emerald-100/80 flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-emerald-900">Free Shipping</p>
                        <p class="text-[10px] text-emerald-700/70">On all local orders</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
