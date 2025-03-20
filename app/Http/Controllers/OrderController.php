<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::all(); // Fetch all orders
        return view('orders', compact('orders'));
    }

    public function updateStatus(Request $request, $orderId)
{
    $request->validate([
        'status' => 'required|string|max:20',
    ]);

    $order = Order::findOrFail($orderId);
    $order->order_status = $request->input('status');
    $order->save();

    return response()->json(['success' => true, 'message' => 'Order status updated successfully.']);
}
}