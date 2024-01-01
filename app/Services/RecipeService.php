<?php

namespace App\Services;

use App\Models\Recipe;

class RecipeService
{
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
}
