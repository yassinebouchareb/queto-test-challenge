<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Get all products
     *
     * @return View
     */
    public function index()
    {
        // Get all products
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product
     *
     * @return View
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created product
     *
     * @param  StoreProductRequest $request
     * @return RedirectResponse
     * */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->validated());

        if(!$product) {
            return redirect()->back()->with('error', 'Product could not be created');
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }
}
