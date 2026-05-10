@extends('shop.layout')
@section('content')
<section class="hero-page" style="background-image: url('https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?q=80&w=2000');">
    <div class="hero-overlay"></div>
    <div class="relative z-10 text-center text-white">
        <h1 class="text-6xl font-bold tracking-tighter uppercase italic">The Collection</h1>
        <p class="text-lg tracking-widest uppercase opacity-80 mt-4">Browse our curated essentials</p>
    </div>
</section>

<section class="py-20 px-10 max-w-7xl mx-auto">
    <div class="flex flex-col md:flex-row gap-12">
        <!-- Sidebar Filter -->
        <aside class="w-full md:w-64 shrink-0">
            <h2 class="text-xs uppercase tracking-[0.3em] font-bold text-gray-400 mb-8 border-b pb-4">Categories</h2>
            <ul class="space-y-4 text-sm uppercase tracking-widest font-medium">
                <li>
                    <a href="{{ route('products', ['sort' => $activeSort]) }}" class="{{ !$activeCategory ? 'underline decoration-2 underline-offset-4' : 'opacity-40 hover:opacity-100 hover:underline decoration-2 underline-offset-4' }}">All Products</a>
                </li>
                @foreach($categories as $category)
                <li>
                    <a href="{{ route('products', ['category' => $category->slug, 'sort' => $activeSort]) }}" class="{{ $activeCategory === $category->slug ? 'underline decoration-2 underline-offset-4' : 'opacity-40 hover:opacity-100 hover:underline decoration-2 underline-offset-4' }}">
                        {{ $category->name }} <span class="text-[10px] text-gray-400">({{ $category->products_count }})</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </aside>

        <!-- Product Grid -->
        <div class="flex-1">
            <div class="flex justify-between items-center mb-10 pb-4 border-b border-gray-100">
                <span class="text-[10px] uppercase tracking-widest text-gray-400">{{ $products->total() }} Products Found</span>
                <div class="flex items-center gap-2">
                    <span class="text-[10px] uppercase tracking-widest text-gray-400 font-bold">Sort:</span>
                    <a href="{{ route('products', ['category' => $activeCategory, 'sort' => 'newest']) }}" class="text-[10px] uppercase tracking-widest font-bold px-2 py-1 rounded {{ $activeSort === 'newest' || !$activeSort ? 'bg-black text-white' : 'hover:bg-gray-100' }}">Newest</a>
                    <a href="{{ route('products', ['category' => $activeCategory, 'sort' => 'price_asc']) }}" class="text-[10px] uppercase tracking-widest font-bold px-2 py-1 rounded {{ $activeSort === 'price_asc' ? 'bg-black text-white' : 'hover:bg-gray-100' }}">Price ↑</a>
                    <a href="{{ route('products', ['category' => $activeCategory, 'sort' => 'price_desc']) }}" class="text-[10px] uppercase tracking-widest font-bold px-2 py-1 rounded {{ $activeSort === 'price_desc' ? 'bg-black text-white' : 'hover:bg-gray-100' }}">Price ↓</a>
                    <a href="{{ route('products', ['category' => $activeCategory, 'sort' => 'name']) }}" class="text-[10px] uppercase tracking-widest font-bold px-2 py-1 rounded {{ $activeSort === 'name' ? 'bg-black text-white' : 'hover:bg-gray-100' }}">A-Z</a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($products as $product)
                    <div class="group">
                        <a href="{{ route('products.show', $product->slug) }}">
                            <div class="aspect-[3/4] overflow-hidden bg-gray-100 mb-4 relative">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </div>
                        </a>
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-bold uppercase tracking-tight text-sm">{{ $product->name }}</h3>
                                <p class="text-gray-400 text-xs uppercase tracking-widest mt-1">{{ $product->category->name }}</p>
                            </div>
                            <p class="font-bold text-sm">${{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($products->isEmpty())
            <div class="py-20 text-center">
                <p class="text-gray-400 uppercase tracking-widest text-xs font-bold">No products found in this category</p>
            </div>
            @endif

            <div class="mt-12">
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
</section>
@endsection
