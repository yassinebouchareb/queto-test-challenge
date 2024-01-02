<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Models\Product;
use App\Models\Recipe;
use App\Services\RecipeService;
use Illuminate\Http\Request;

class RecipeController extends Controller
{

    public function __construct(
        private RecipeService $recipeService
    ){}

    /**
     * Get all recipes
     *
     * @return View
     */
    public function index(Request $request)
    {
        // Filter recipes based on URL params
        $result = $this->recipeService->filter($request->all());
        $recipes = $result['recipes'];
        $title = $result['title'];

        return view('recipes.index', compact('recipes', 'title'));
    }

    /**
     * Show the form for creating a new recipe
     *
     * @return View
     */
    public function create()
    {
        // Get all products
        $products = Product::all();
        return view('recipes.create', compact('products'));
    }

    /**
     * Store a newly created recipe
     *
     * @param  StoreRecipeRequest $request
     * @return RedirectResponse
     * */
    public function store(StoreRecipeRequest $request)
    {
        // store recipe and attach products to it
        $recipe = $this->recipeService->create($request->validated());

        if(!$recipe) {
            return redirect()->back()->with('error', 'Recipe could not be created');
        }

        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully');
    }

    /**
     * Show recipe
     * @param  Recipe $recipe
     * @return View
     * */
    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Validate recipe
     * @param  Recipe $recipe
     * @return RedirectResponse
     * */
    public function validateRecipe(Recipe $recipe)
    {
        // Validate recipe
        if(!$this->recipeService->validate($recipe)) {
            return redirect()->back()->with('error', 'Recipe could not be validated, please update your products quantity');
        }

        return redirect()->route('recipes.show', $recipe)->with('success', 'Recipe validated and products quantity updated successfully.');
    }
}
