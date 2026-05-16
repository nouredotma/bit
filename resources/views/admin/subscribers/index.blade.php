@extends('admin.layout')
@section('title', 'Subscribers')
@section('content')
<div class="flex justify-between items-center mb-8">
    <p class="text-black/50 text-sm font-medium">{{ $subscribers->total() }} Total Subscribers</p>
</div>

<div class="overflow-x-auto">
    <table class="w-full text-left">
        <thead>
            <tr class="border-b border-gray-100">
                <th class="pb-3 text-[10px] text-black/50 font-medium">Email</th>
                <th class="pb-3 text-[10px] text-black/50 font-medium">Subscribed Date</th>
                <th class="pb-3 text-[10px] text-black/50 font-medium text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($subscribers as $subscriber)
            <tr class="group hover:bg-gray-50/50 transition-colors">
                <td class="py-3">
                    <p class="font-bold text-sm tracking-tight">{{ $subscriber->email }}</p>
                </td>
                <td class="py-3">
                    <p class="text-sm text-black/60">{{ $subscriber->created_at->format('M d, Y') }}</p>
                </td>
                <td class="py-3 text-right">
                    <form action="{{ route('admin.subscribers.destroy', $subscriber->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this subscriber?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-50 hover:bg-red-600 text-red-600 hover:text-white px-4 py-2 rounded-lg text-[10px] font-bold transition-all">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="py-20 text-center">
                    <p class="text-black/50 text-xs font-medium">No subscribers found yet</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-8">
    {{ $subscribers->links() }}
</div>
@endsection
