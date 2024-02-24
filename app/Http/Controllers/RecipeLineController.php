<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeLine;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RecipeLineController extends Controller
{
    public function store(Request $request, Recipe $recipe)
    {
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'net_quantity' => 'required|numeric',
            ]);

            $recipeLine = new RecipeLine([
                'product_id' => $request->product_id,
                'net_quantity' => $request->net_quantity
            ]);

            $recipe->recipeLines()->save($recipeLine);

            return response()->json(['message' => 'Línea de receta creada con éxito', 'recipe_line' => $recipeLine], 201);

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
        }
    }
}
