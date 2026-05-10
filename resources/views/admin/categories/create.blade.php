@extends('admin.layout')
@section('title', 'Add Category')
@section('content')
<form action="{{ route('admin.categories.store') }}" method="POST" class="max-w-lg">
    @csrf

    <div class="space-y-6">
        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Category Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="admin-input" placeholder="e.g. Electronics" required>
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-widest text-gray-400 mb-2 ml-1">Slug (optional)</label>
            <input type="text" name="slug" value="{{ old('slug') }}" class="admin-input" placeholder="Auto-generated from name if empty">
            @error('slug') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="bg-black text-white px-8 py-3 rounded-lg text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-all">Create Category</button>
            <a href="{{ route('admin.categories.index') }}" class="text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-black transition-colors">Cancel</a>
        </div>
    </div>
</form>
@endsection
