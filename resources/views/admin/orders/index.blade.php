@extends('admin.layout')
@section('title', 'Order History')
@section('content')
<div class="flex justify-between items-center mb-8">
    <p class="text-black/50 text-sm font-medium">{{ $orders->total() }} Total Orders</p>
</div>

<div class="overflow-x-auto">
    <table class="w-full text-left">
        <thead>
            <tr class="border-b border-gray-100">
                <th class="pb-3 text-[10px] text-black/50 font-medium">Order ID</th>
                <th class="pb-3 text-[10px] text-black/50 font-medium">Customer</th>
                <th class="pb-3 text-[10px] text-black/50 font-medium">Date</th>
                <th class="pb-3 text-[10px] text-black/50 font-medium">Amount</th>
                <th class="pb-3 text-[10px] text-black/50 font-medium">Status</th>
                <th class="pb-3 text-[10px] text-black/50 font-medium text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($orders as $order)
            <tr class="group hover:bg-gray-50/50 transition-colors">
                <td class="py-3">
                    <p class="font-bold text-sm tracking-tight">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
                </td>
                <td class="py-3">
                    <p class="text-sm font-medium">{{ $order->customer_name }}</p>
                    <p class="text-[10px] text-black/50 font-medium mt-1">{{ $order->customer_email }}</p>
                </td>
                <td class="py-3">
                    <p class="text-sm text-black/60">{{ $order->created_at->format('M d, Y') }}</p>
                </td>
                <td class="py-3">
                    <p class="font-bold text-sm">${{ number_format($order->total, 2) }}</p>
                </td>
                <td class="py-3">
                    @php
                        $colors = ['pending' => 'bg-yellow-50 text-yellow-600', 'processing' => 'bg-blue-50 text-blue-600', 'shipped' => 'bg-purple-50 text-purple-600', 'delivered' => 'bg-green-50 text-green-600', 'cancelled' => 'bg-red-50 text-red-600'];
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $colors[$order->status] ?? 'bg-gray-50 text-gray-600' }}">
                        {{ $order->status }}
                    </span>
                </td>
                <td class="py-3 text-right">
                    <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-block bg-gray-50 hover:bg-black hover:text-white px-4 py-2 rounded-lg text-[10px] font-bold transition-all">Details</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="py-20 text-center">
                    <p class="text-black/50 text-xs font-medium">No orders found yet</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-8">
    {{ $orders->links() }}
</div>
@endsection
