@extends('admin.layout')
@section('title', 'Dashboard Overview')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <div class="bg-gray-50/50 p-5 rounded-2xl border border-gray-100">
        <p class="text-[10px] text-black/50 font-medium mb-2">Total Revenue</p>
        <p class="text-3xl font-bold tracking-tighter">${{ number_format($stats['totalRevenue'], 2) }}</p>
    </div>
    <div class="bg-gray-50/50 p-5 rounded-2xl border border-gray-100">
        <p class="text-[10px] text-black/50 font-medium mb-2">Total Orders</p>
        <p class="text-3xl font-bold tracking-tighter">{{ $stats['totalOrders'] }}</p>
        <p class="text-xs text-yellow-600 mt-1 font-medium">{{ $stats['pendingOrders'] }} pending</p>
    </div>
    <div class="bg-gray-50/50 p-5 rounded-2xl border border-gray-100">
        <p class="text-[10px] text-black/50 font-medium mb-2">Products</p>
        <p class="text-3xl font-bold tracking-tighter">{{ $stats['totalProducts'] }}</p>
        @if($stats['lowStock'] > 0)
        <p class="text-xs text-red-500 mt-1 font-medium">{{ $stats['lowStock'] }} low stock</p>
        @endif
    </div>
</div>

<div class="flex justify-between items-center mb-6">
    <h3 class="text-lg font-bold tracking-tight">Recent Orders</h3>
    <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-black/50 hover:text-black transition-colors">View All →</a>
</div>

<div class="overflow-x-auto">
    <table class="w-full text-left">
        <thead>
            <tr class="border-b border-gray-100">
                <th class="pb-3 text-[10px] text-black/50 font-medium">Order ID</th>
                <th class="pb-3 text-[10px] text-black/50 font-medium">Customer</th>
                <th class="pb-3 text-[10px] text-black/50 font-medium">Amount</th>
                <th class="pb-3 text-[10px] text-black/50 font-medium">Status</th>
                <th class="pb-3 text-[10px] text-black/50 font-medium">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($recentOrders as $order)
            <tr class="hover:bg-gray-50/50 transition-colors">
                <td class="py-3 font-bold text-sm">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</td>
                <td class="py-3 text-sm">{{ $order->customer_name }}</td>
                <td class="py-3 font-bold text-sm">${{ number_format($order->total, 2) }}</td>
                <td class="py-3">
                    @php
                        $colors = ['pending' => 'bg-yellow-50 text-yellow-600', 'processing' => 'bg-blue-50 text-blue-600', 'shipped' => 'bg-purple-50 text-purple-600', 'delivered' => 'bg-green-50 text-green-600', 'cancelled' => 'bg-red-50 text-red-600'];
                    @endphp
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-widest {{ $colors[$order->status] ?? 'bg-gray-50 text-gray-600' }}">
                        {{ $order->status }}
                    </span>
                </td>
                <td class="py-4 text-sm text-black/50">{{ $order->created_at->format('M d, Y') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="py-12 text-center text-gray-400 uppercase tracking-widest text-xs font-bold">No orders yet</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
