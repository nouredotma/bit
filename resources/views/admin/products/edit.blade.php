@extends('admin.layout')
@section('title', 'Edit Product')
@section('content')
<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="max-w-2xl">
    @csrf
    @method('PUT')

    <div class="space-y-6">
        <div>
            <label class="block text-xs font-medium text-black/50 mb-2 ml-1">Product Name</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" class="admin-input" required>
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-medium text-black/50 mb-2 ml-1">Price ($)</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" step="0.01" min="0" class="admin-input" required>
                @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-black/50 mb-2 ml-1">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0" class="admin-input" required>
                @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-xs font-medium text-black/50 mb-2 ml-1">Main Image</label>
            <input type="file" name="main_image" class="admin-input" accept="image/*">
            @if($product->main_image)
            <div class="mt-3 w-24 h-24 bg-gray-50 rounded-lg overflow-hidden">
                <img src="{{ $product->main_image }}" class="w-full h-full object-cover">
            </div>
            @endif
            @error('main_image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-medium text-black/50 mb-2 ml-1">Thumbnail Images (Select to append, max 4 total)</label>
            <input type="file" name="thumbnail_images[]" multiple class="admin-input" accept="image/*">
            @if($product->thumbnail_images && count($product->thumbnail_images) > 0)
            <div class="mt-3 flex gap-2">
                @foreach($product->thumbnail_images as $index => $thumb)
                <div class="relative w-16 h-16 bg-gray-50 rounded-lg overflow-hidden group">
                    <img src="{{ $thumb }}" class="w-full h-full object-cover">
                    <button type="button" onclick="if(confirm('Are you sure you want to delete this thumbnail?')) document.getElementById('delete-thumb-{{ $index }}').submit();" class="absolute top-1 right-1 bg-black/50 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity cursor-pointer">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                @endforeach
            </div>
            @endif
            @error('thumbnail_images') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-medium text-black/50 mb-2 ml-1">Sizes Available (comma-separated)</label>
                <input type="text" name="sizes_available" value="{{ old('sizes_available', is_array($product->sizes_available) ? implode(', ', $product->sizes_available) : '') }}" class="admin-input" placeholder="S, M, L, XL">
                @error('sizes_available') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-medium text-black/50 mb-2 ml-1">Colors Available (comma-separated)</label>
                <input type="text" name="colors_available" value="{{ old('colors_available', is_array($product->colors_available) ? implode(', ', $product->colors_available) : '') }}" class="admin-input" placeholder="Black, White, Gray">
                @error('colors_available') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-xs font-medium text-black/50 mb-2 ml-1">Description</label>
            <textarea name="description" rows="4" class="admin-input">{{ old('description', $product->description) }}</textarea>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-black text-white px-8 py-3 rounded-lg text-xs font-bold hover:bg-black/80 transition-all">Update Product</button>
            <a href="{{ route('admin.products.index') }}" class="text-xs font-bold text-black/50 hover:text-black transition-colors">Cancel</a>
        </div>
    </div>
</form>

@if($product->thumbnail_images)
    @foreach($product->thumbnail_images as $index => $thumb)
    <form id="delete-thumb-{{ $index }}" action="{{ route('admin.products.destroyThumbnail', ['id' => $product->id, 'index' => $index]) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
    @endforeach
@endif
@endsection
