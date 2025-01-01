<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function orders()
    {
        $orders = Cart::with('product')->where('status', '!=', 'Done')->get();

        $allOrders = $orders->map(function ($order) {
            return [
                'order_id' => $order->id,
                'id' => $order->product->id,
                'name' => $order->product->name,
                'description' => $order->product->description,
                'image' => $order->product->image,
                'amount' => $order->amount,
                'status' => $order->status,
                'store_id' => $order->product->store_id,
            ];
        });

        return response()->json($allOrders);
    }

    public function switchStatus(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:carts,id',
            'status' => 'required|in:New,Delivering,Done',
        ]);

        $order = Cart::find($validated['order_id']);

        $order->status = $validated['status'];
        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Order status updated successfully'
        ]);
    }

}
