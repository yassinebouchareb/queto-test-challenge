<?php

namespace App\Services;

use App\Models\Recipe;

class RecipeService
{
    public function filter(array $data)
    {
        $query = Recipe::with('products');

        // Filter recipes
        $title = 'List of all recipes';
        $query->when(isset($data['valid']), function($query) use ($data, &$title) {
            $title = '';
            switch ($data['valid']) {
                case '1':
                    $query->valid();
                    $title = 'List of ready to cook recipes';
                    break;
                case '0':
                    $query->invalid();
                    $title = 'List of not ready to cook recipes';
                    break;
            }
        });

        // Get all recipes
        $recipes = $query->latest()->paginate(6);

        return compact('recipes', 'title');
    }

    /**
     * Create a new recipe
     * @param array $data
     * @return Recipe
     * */
    public function create(array $data)
    {
        // store recipe
        $recipe = Recipe::create($data);

        // attach products to recipe
        $products = $data['products'] ?? [];
        $quantities = $data['quantities'] ?? [];

        for ($product=0; $product < count($products); $product++) {
            if ($products[$product] != '') {
                $recipe->products()->attach($products[$product], ['quantity' => $quantities[$product]]);
            }
        }

        return $recipe;
    }

    /**
     * Validate recipe
     * @param Recipe $recipe
     * @return Recipe
     * */
    public function validate(Recipe $recipe)
    {
        // Load recipe with products
        $recipe = $recipe->load('products');

        // Validate recipe if products are in stock
        foreach ($recipe->products as $product) {
            if ($product->pivot->quantity > $product->quantity) {
                return false;
            }
        }

        // Update products quantity
        foreach ($recipe->products as $product) {
            $product->update(['quantity' => $product->quantity - $product->pivot->quantity]);
        }

        // Update recipe status
        $recipe->valid = true;
        $recipe->save();

        return true;
    }
}
