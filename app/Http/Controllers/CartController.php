<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $items = $request->items;
        $failedItems = [];
        $successItems = [];

        foreach ($items as $item) {
            $product = Product::find($item['product_id']);

            if ($product->amount < $item['quantity']) {
                $failedItems[] = [
                    'product_id' => $item['product_id'],
                    'message' => 'Insufficient stock for this product.',
                ];
                continue;
            }

            $cartItem = Cart::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'product_id' => $item['product_id'],
                ],
                [
                    'amount' => DB::raw('amount + ' . $item['quantity']),
                ]
            );

            $product->decrement('amount', $item['quantity']);

            $successItems[] = $cartItem;
        }

        return response()->json([
            'success' => true,
            'message' => 'Products processed.',
            'success_items' => $successItems,
            'failed_items' => $failedItems,
        ], 200);
    }

    public function viewCart()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();

        $purchasedProducts = $cartItems->map(function ($cartItem) {
            return [
                'id' => $cartItem->product->id,
                'name' => $cartItem->product->name,
                'description' => $cartItem->product->description,
                'image' => $cartItem->product->image,
                'amount' => $cartItem->amount, 
                'store_id' => $cartItem->product->store_id,
            ];
        });

        return response()->json($purchasedProducts);
    }


}
