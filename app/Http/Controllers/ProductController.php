<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Get all products
     */
    public function index()
    {
        // Get all products
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }
}
