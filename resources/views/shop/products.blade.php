@extends('shop.layout')
@section('content')
<section class="hero-page" style="background-image: url('https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=2000');">
    <div class="hero-overlay"></div>
    <div class="relative z-10 text-center text-white section-padding">
        <h1 class="text-5xl md:text-6xl font-bold mb-4">The Collection</h1>
        <p class="text-lg font-medium">Browse our curated essentials.</p>
    </div>
</section>

<section class="py-16 section-padding bg-transparent">
    <div class="w-full flex flex-col md:flex-row gap-12">
        <!-- Sidebar Filter -->
        <aside class="w-full md:w-56 shrink-0">
            <h2 class="text-sm font-bold text-[#0a0a0a] mb-6 border-b border-gray-100 pb-3">Categories</h2>
            <ul class="space-y-3 text-sm font-medium text-gray-500">
                <li>
                    <a href="{{ route('products', ['sort' => $activeSort]) }}" class="{{ !$activeCategory ? 'text-[#0a0a0a] font-semibold' : 'hover:text-[#0a0a0a] transition-colors' }}">All Products</a>
                </li>
                @foreach($categories as $category)
                <li>
                    <a href="{{ route('products', ['category' => $category->slug, 'sort' => $activeSort]) }}" class="{{ $activeCategory === $category->slug ? 'text-[#0a0a0a] font-semibold' : 'hover:text-[#0a0a0a] transition-colors' }}">
                        {{ $category->name }} <span class="text-xs ml-1">({{ $category->products_count }})</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </aside>

        <!-- Product Grid -->
        <div class="flex-1">
            <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-100">
                <span class="text-sm text-gray-500">{{ $products->total() }} Products</span>
                <div class="flex items-center gap-3 text-sm">
                    <span class="font-semibold">Sort by:</span>
                    <a href="{{ route('products', ['category' => $activeCategory, 'sort' => 'newest']) }}" class="px-3 py-1.5 rounded-lg transition-colors {{ $activeSort === 'newest' || !$activeSort ? 'bg-[#f5f5f7] text-[#0a0a0a] font-semibold' : 'text-gray-500 hover:bg-[#f5f5f7]' }}">Newest</a>
                    <a href="{{ route('products', ['category' => $activeCategory, 'sort' => 'price_asc']) }}" class="px-3 py-1.5 rounded-lg transition-colors {{ $activeSort === 'price_asc' ? 'bg-[#f5f5f7] text-[#0a0a0a] font-semibold' : 'text-gray-500 hover:bg-[#f5f5f7]' }}">Price: Low</a>
                    <a href="{{ route('products', ['category' => $activeCategory, 'sort' => 'price_desc']) }}" class="px-3 py-1.5 rounded-lg transition-colors {{ $activeSort === 'price_desc' ? 'bg-[#f5f5f7] text-[#0a0a0a] font-semibold' : 'text-gray-500 hover:bg-[#f5f5f7]' }}">Price: High</a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($products as $product)
                    <div>
                        <a href="{{ route('products.show', $product->slug) }}">
                            <div class="aspect-[3/4] overflow-hidden bg-[#f5f5f7] mb-4 relative rounded-xl">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                            </div>
                        </a>
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold text-base mb-1">{{ $product->name }}</h3>
                                <p class="text-gray-500 text-sm">{{ $product->category->name }}</p>
                            </div>
                            <p class="font-semibold text-sm">${{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($products->isEmpty())
            <div class="py-20 text-center">
                <p class="text-gray-500 text-sm">No products found in this category.</p>
            </div>
            @endif

            <div class="mt-12">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
