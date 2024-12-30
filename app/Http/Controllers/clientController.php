<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class clientController extends Controller
{
    //
    public function dashboard()
    {
        $products = Product::all();
       
        return view('client.dashboard', compact('products'));
    }

}