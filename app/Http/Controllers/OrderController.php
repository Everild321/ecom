<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function placeOrder()
    {
        $cartItems = CartItem::where('user_id', auth()->id())->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Votre panier est vide'], 400);
        }
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        // dd($total);
        $order = new Order();
        $order->user_id = auth()->id();
        $order->total = $total;
        $order->save();

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);

            $item->product->decrement('stock', $item->quantity);
        }
        CartItem::where('user_id', auth()->id())->delete();

        return redirect('/orders');
    }

    public function orderHistory()
    {
        if(Auth::user()->role === "client"){
            $orders = Order::with('orderItems.product')->where('user_id', auth()->id())->get();
        }else{
            $orders = Order::all();
        }
        $role = Auth::user()->role;
        return view('orders.index', compact('orders', 'role'));
    }
    public function allOrder()
    {
        $orders = Order::with('orderItems.product')->where('user_id', auth()->id())->get();
        return view('orders.all', compact('orders'));
    }
}