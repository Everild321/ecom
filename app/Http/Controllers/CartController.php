<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::find($request->product_id);

        // Vérifie si le produit est déjà dans le panier
        $cartItem = CartItem::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();
        // if($product->stock > $request->quantity){
            if ($cartItem) {
                $cartItem->quantity = $request->quantity;
                $cartItem->save();
            } else {
                $cartItem = new CartItem();
                $cartItem -> user_id = auth()->id();
                $cartItem -> product_id = $product->id;
                $cartItem -> quantity = $request->quantity;
                $cartItem -> save();
    
            }
        // }else{
        //     return response()->json(['message' => 'Votre stock est insuffisant'], 400);
        // }
        

        $products = Product::all();
       
        return view('client.dashboard', compact('products'));
    }

    public function viewCart()
    {
        $cartItems = CartItem::with('product')->where('user_id', auth()->id())->get();
        return view('cart.index', compact('cartItems'));
    }
}