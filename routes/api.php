<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeLineController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {

    /* Recetas: */
    Route::post('/recipe', [RecipeController::class, 'store']);
    Route::get('/recipe', [RecipeController::class, 'getAllRecipes']);
    Route::get('/recipe/{id}', [RecipeController::class, 'getRecipeContent']);
    Route::get('/recipe/sorted-by-cost', [RecipeController::class, 'getRecipesSortedByCost']);
    Route::get('/recipe/most-profitable', [RecipeController::class, 'mostProfitableRecipe']);

    /* Agregar Linea de Receta */
    Route::post('/recipe-line/{recipe}', [RecipeLineController::class, 'store']);

    /* Productos */
    Route::post('/product', [ProductController::class, 'store']);
    Route::get('/product', [ProductController::class, 'getAllProduct']);

    /* Sub-recetas */
    Route::post('/recipe/{recipe}/subrecipes', [RecipeController::class, 'addSubRecipe']);

});
