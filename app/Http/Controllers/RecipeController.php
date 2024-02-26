<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Validation\ValidationException;

class RecipeController extends Controller
{
    public function getAllRecipes()
    {
        $recipes = Recipe::all()->map(function ($recipe) {
            return [
                'name' => $recipe->name,
                'selling_price' => $recipe->selling_price
            ];
        });

        return response()->json(['recipes' => $recipes]);
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|unique:recipes',
                'selling_price' => 'required|numeric',
            ]);

            $recipe = Recipe::create([
                'name' => $request->name,
                'selling_price' => $request->selling_price,
            ]);

            return response()->json($recipe, 201);
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
        }

    }

    public function getRecipesSortedByCost()
    {
        $recipes = Recipe::with('recipeLines.product')
            ->get()
            ->map(function ($recipe) {
                $recipe->total_cost = $recipe->calculateCost();
                return $recipe;
            })
        ->sortBy('total_cost')
            ->map(function ($recipe) {
                return $recipe['name'] . ': ' . $recipe['total_cost'] . ' $';
            })

            ->values();

        return response()->json(['recipes' => $recipes]);
    }

    public function mostProfitableRecipe()
    {
        $recipes = Recipe::with('recipeLines.product')
            ->get();

        $recipes->transform(function ($recipe) {
            $recipe->total_cost = $recipe->calculateCost();
            $recipe->profitability = $recipe->selling_price - $recipe->total_cost;
            return $recipe;
        });

        $mostProfitableRecipe = $recipes->sortByDesc('profitability')->first();

        return response()->json(['most_profitable_recipe' => $mostProfitableRecipe]);
    }

    public function getRecipeContent($id){
        try {
            $recipe = Recipe::with('subRecipes', 'recipeLines.product')->findOrFail($id);

            $response = [
                'main_recipe' => [
                    'name' => $recipe->name,
                    'selling_price' => $recipe->selling_price
                ],
                'ingredients' => [
                    'product' => $recipe->recipeLines->map(function ($recipeLine) {
                        return $recipeLine->product->name;
                    })->toArray()
                ]
            ];

            foreach ($recipe->subRecipes as $subRecipe) {
                $response['sub_recipes'][] = [
                    'name' => $subRecipe->name
                ];

                $ingredients = $subRecipe->recipeLines->map(function ($recipeLine) {
                    return $recipeLine->product->name;
                })->toArray();

                $response['sub_recipes_ingredients'][] = $ingredients;
            }

            return response()->json($response);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['message' => 'Receta no encontrada'], 404);
        }
    }
    public function addSubRecipe(Request $request, Recipe $recipe)
    {
        $request->validate([
            'sub_recipe_id' => 'required|exists:recipes,id',
        ]);

        $subRecipeId = $request->input('sub_recipe_id');

        $recipe->subRecipes()->attach($subRecipeId);

        // Responder con la confirmación
        return response()->json(['message' => 'Subrecipe added successfully'], 201);
    }
}
