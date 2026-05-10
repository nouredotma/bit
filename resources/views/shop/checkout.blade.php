@extends('shop.layout')
@section('content')
<div class="pt-32 pb-24 px-10 max-w-5xl mx-auto">
    <h1 class="text-5xl font-bold tracking-tighter uppercase italic mb-4 text-center">Checkout</h1>
    <p class="text-gray-400 text-center uppercase tracking-widest text-sm mb-16">Complete your order</p>
    <checkout-form></checkout-form>
</div>
@endsection
