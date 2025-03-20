@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8">
    <h1 class="text-3xl font-bold mb-6">Order Details</h1>

    <div class="bg-white p-6 rounded-lg shadow-md mb-4">
        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Customer:</strong> {{ $order->user->name }}</p>
        <p><strong>Email:</strong> {{ $order->user->email }}</p>
        <p><strong>Total Amount:</strong> ${{ number_format($order->total_amount, 2) }}</p>
        <p><strong>Status:</strong> {{ $order->order_status }}</p>
        <p><strong>Order Date:</strong> {{ $order->created_at->format('F j, Y') }}</p>
        
        <h2 class="text-xl font-semibold mt-6 mb-4">Items:</h2>
        <ul>
            @foreach($order->items as $item)
                <li>{{ $item->product_name }} - ${{ number_format($item->price, 2) }} (x{{ $item->quantity }})</li>
            @endforeach
        </ul>

        <a href="{{ route('orders.edit', $order->id) }}" class="inline-block mt-6 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Edit Order</a>
        <a href="{{ route('orders.index') }}" class="inline-block mt-6 ml-4 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Back to Orders</a>
    </div>
</div>
@endsection
