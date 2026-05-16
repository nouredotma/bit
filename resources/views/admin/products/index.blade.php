@extends('admin.layout')
@section('title', 'Product Inventory')
@section('content')
<div class="flex justify-between items-center mb-8">
    <p class="text-black/50 text-sm font-medium">Total: {{ $products->total() }} items</p>
    <a href="{{ route('admin.products.create') }}" class="bg-black text-white px-6 py-3 rounded-lg text-xs font-bold hover:bg-black/80 transition-all">+ Add Product</a>
</div>

<div class="overflow-x-auto">
    <table class="w-full text-left">
        <thead>
            <tr class="border-b border-gray-100">
                <th class="pb-3 text-[10px] text-black/50 font-medium">Product</th>
                <th class="pb-3 text-[10px] text-black/50 font-medium">Price</th>
                <th class="pb-3 text-[10px] text-black/50 font-medium">Stock</th>
                <th class="pb-3 text-[10px] text-black/50 font-medium">Status</th>
                <th class="pb-3 text-[10px] text-black/50 font-medium text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @foreach($products as $product)
            <tr class="group hover:bg-gray-50/50 transition-colors">
                <td class="py-3">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-gray-50 rounded-lg overflow-hidden shrink-0">
                            <img src="{{ $product->main_image }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="font-bold text-sm tracking-tight">{{ $product->name }}</p>
                            <p class="text-[10px] text-black/50 font-medium mt-1">ID: #{{ str_pad($product->id, 4, '0', STR_PAD_LEFT) }}</p>
                        </div>
                    </div>
                </td>
                <td class="py-3">
                    <p class="font-bold text-sm">${{ number_format($product->price, 2) }}</p>
                </td>
                <td class="py-3">
                    <p class="text-sm {{ $product->stock < 10 ? 'text-red-500 font-bold' : 'text-black/60' }}">{{ $product->stock }} units</p>
                </td>
                <td class="py-3">
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-bold {{ $product->stock > 0 ? 'text-green-500' : 'text-red-500' }}">
                        <span class="h-1.5 w-1.5 {{ $product->stock > 0 ? 'bg-green-500' : 'bg-red-500' }} rounded-full"></span>
                        {{ $product->stock > 0 ? 'Active' : 'Out of Stock' }}
                    </span>
                </td>
                <td class="py-3 text-right">
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 hover:bg-white hover:shadow-sm rounded-md transition-all text-black/20 hover:text-black">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                        </a>
                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 hover:bg-white hover:shadow-sm rounded-md transition-all text-black/20 hover:text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-8">
    {{ $products->links() }}
</div>
@endsection
