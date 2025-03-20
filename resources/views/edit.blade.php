@extends('layouts.app')

@section('content')
<div class="container mx-auto p-8">
    <h1 class="text-3xl font-bold mb-6">Edit Order #{{ $order->id }}</h1>

    <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
        @csrf
        <label class="block mb-4">
            <span class="text-gray-700">Customer:</span>
            <input type="text" value="{{ $order->user->name }}" disabled class="form-input mt-1 block w-full">
        </label>

        <label class="block mb-4">
            <span class="text-gray-700">Total Amount:</span>
            <input type="text" value="${{ number_format($order->total_amount, 2) }}" disabled class="form-input mt-1 block w-full">
        </label>

        <label class="block mb-4">
            <span class="text-gray-700">Order Status:</span>
            <select name="status" class="form-select mt-1 block w-full" required>
                <option value="Pending" {{ $order->order_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Processing" {{ $order->order_status == 'Processing' ? 'selected' : '' }}>Processing</option>
                <option value="Shipped" {{ $order->order_status == 'Shipped' ? 'selected' : '' }}>Shipped</option>
                <option value="Delivered" {{ $order->order_status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                <option value="Cancelled" {{ $order->order_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                <option value="Refunded" {{ $order->order_status == 'Refunded' ? 'selected' : '' }}>Refunded</option>
            </select>
        </label>

        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Update Status</button>
        <a href="{{ route('orders.show', $order->id) }}" class="ml-4 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">Cancel</a>
    </form>
</div>
@endsection
