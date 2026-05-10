@extends('admin.layout')
@section('title', 'Add Product')
@section('content')
<form action="{{ route('admin.products.store') }}" method="POST" class="max-w-2xl">
    @csrf

    <div class="space-y-6">
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Product Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="admin-input" placeholder="e.g. Wireless Headphones" required>
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Category</label>
            <select name="category_id" class="admin-input" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Price ($)</label>
                <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0" class="admin-input" placeholder="99.99" required>
                @error('price') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" class="admin-input" placeholder="0" required>
                @error('stock') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Image URL</label>
            <input type="url" name="image" value="{{ old('image') }}" class="admin-input" placeholder="https://images.unsplash.com/...">
            @error('image') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Description</label>
            <textarea name="description" rows="4" class="admin-input" placeholder="Product description...">{{ old('description') }}</textarea>
            @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-black text-white px-8 py-3 rounded-lg text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-all">Create Product</button>
            <a href="{{ route('admin.products.index') }}" class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-black transition-colors">Cancel</a>
        </div>
    </div>
</form>
@endsection
