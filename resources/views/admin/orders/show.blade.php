@extends('admin.layout')
@section('title', 'Order #' . str_pad($order->id, 6, '0', STR_PAD_LEFT))
@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Order Details -->
    <div class="lg:col-span-2 space-y-8">
        <div>
            <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Order Items</h3>
            <div class="space-y-4">
                @foreach($order->items as $item)
                <div class="flex items-center gap-4 p-4 bg-gray-50/50 rounded-xl">
                    @if($item->product && $item->product->image)
                    <div class="w-16 h-16 bg-white rounded-lg overflow-hidden shrink-0">
                        <img src="{{ $item->product->image }}" class="w-full h-full object-cover">
                    </div>
                    @endif
                    <div class="flex-1">
                        <p class="font-bold text-sm tracking-tight">{{ $item->product->name ?? 'Deleted Product' }}</p>
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest mt-1">Qty: {{ $item->quantity }} × ${{ number_format($item->price, 2) }}</p>
                    </div>
                    <p class="font-bold text-sm">${{ number_format($item->price * $item->quantity, 2) }}</p>
                </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-between items-center pt-6 border-t border-gray-100">
            <span class="text-xs font-bold uppercase tracking-widest text-gray-400">Order Total</span>
            <span class="text-2xl font-bold tracking-tighter">${{ number_format($order->total, 2) }}</span>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
            <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Customer</h3>
            <p class="font-bold text-sm">{{ $order->customer_name }}</p>
            <p class="text-sm text-gray-500 mt-1">{{ $order->customer_email }}</p>
            @if($order->customer_phone)
            <p class="text-sm text-gray-500 mt-1">{{ $order->customer_phone }}</p>
            @endif
        </div>

        <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
            <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Shipping Address</h3>
            <p class="text-sm text-gray-600">{{ $order->address }}</p>
        </div>

        <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
            <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Order Date</h3>
            <p class="text-sm font-medium">{{ $order->created_at->format('F j, Y \a\t g:i A') }}</p>
        </div>

        <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100">
            <h3 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Update Status</h3>
            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                @csrf
                @method('PUT')
                <select name="status" class="admin-input mb-3">
                    @foreach(['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                        <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="w-full bg-black text-white py-3 rounded-lg text-xs font-bold uppercase tracking-widest hover:bg-gray-800 transition-all">Update Status</button>
            </form>
        </div>

        <a href="{{ route('admin.orders.index') }}" class="block text-center text-xs font-bold uppercase tracking-widest text-gray-400 hover:text-black transition-colors">← Back to Orders</a>
    </div>
</div>
@endsection
