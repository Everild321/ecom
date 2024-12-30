<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::where('user_id', Auth::id())->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('vendor.products.index')->with('success', 'Produit ajouté avec succès.');
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {

        $product->update($request->only(['name', 'description', 'price' , 'stock']));

        return redirect()->route('vendor.products.index')->with('success', 'Produit mis à jour avec succès.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('vendor.products.index')->with('success', 'Produit supprimé avec succès.');
    }
}