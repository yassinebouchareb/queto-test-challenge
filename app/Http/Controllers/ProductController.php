<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Carbon\Carbon;
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
    public function index(Request $request)
    {
        $query = Product::query();

        $query->when($request->has('status'), function($query) use ($request) {
            switch ($request->status) {
                case 'in_stock':
                    $query->inStock();
                    break;
                case 'out_of_stock':
                    $query->outOfStock();
                    break;
                case 'expired':
                    $query->expired();
                    break;
            }
        });

        // Get all products
        $products = $query->latest()->paginate(10);
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

    /**
     * Show the form for editing the specified product
     *
     * @param  Product $product
     * @return View
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified product
     *
     * @param  StoreProductRequest $request
     * @param  Product $product
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }
}
