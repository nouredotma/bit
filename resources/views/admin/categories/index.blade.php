@extends('admin.layout')
@section('title', 'Categories')
@section('content')
<div class="flex justify-between items-center mb-8">
    <p class="text-gray-400 text-sm uppercase tracking-widest">{{ count($categories) }} Categories Found</p>
    <a href="{{ route('admin.categories.create') }}" class="bg-black text-white px-6 py-3 rounded-lg text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-all">+ New Category</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($categories as $category)
    <div class="group bg-gray-50/50 p-6 rounded-2xl border border-gray-100 hover:bg-white hover:shadow-xl hover:shadow-black/5 transition-all">
        <div class="flex justify-between items-start mb-6">
            <div class="h-12 w-12 bg-white rounded-xl shadow-sm flex items-center justify-center font-bold text-lg italic">
                {{ substr($category->name, 0, 1) }}
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="p-2 text-gray-300 hover:text-black transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"/></svg>
                </a>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category and ALL its products?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 text-gray-300 hover:text-red-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                    </button>
                </form>
            </div>
        </div>
        <h3 class="text-xl font-bold tracking-tight uppercase mb-1">{{ $category->name }}</h3>
        <p class="text-gray-400 text-xs uppercase tracking-widest mb-6">/{{ $category->slug }}</p>
        
        <div class="flex justify-between items-center pt-6 border-t border-gray-100">
            <span class="text-[10px] uppercase tracking-[0.2em] font-bold text-gray-400">{{ $category->products_count }} Products</span>
            <span class="h-2 w-2 bg-green-500 rounded-full"></span>
        </div>
    </div>
    @endforeach
</div>
@endsection
