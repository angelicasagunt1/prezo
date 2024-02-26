<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CompoundRecipe;

class compoundRecipeController extends Controller
{
    public function addSubRecipe(Request $request, Recipe $recipe)
    {
        $request->validate([
            'sub_recipe_id' => 'required|exists:recipes,id',
        ]);

        $subRecipeId = $request->input('sub_recipe_id');

        $subRecipe = SubRecipe::create([
            'sub_recipe_id' => $subRecipeId,
        ]);

        $recipe->subRecipes()->attach($subRecipe->id);

        return response()->json(['message' => 'Subrecipe added successfully'], 201);
    }
}
