@extends('shop.layout')
@section('content')
<div class="pt-32 pb-24 section-padding bg-transparent">
    <div class="w-full">
        <h1 class="text-4xl font-bold mb-4 text-center">Checkout</h1>
        <p class="text-gray-500 text-center text-sm mb-16">Complete your order</p>
        <checkout-form></checkout-form>
    </div>
</div>
@endsection
