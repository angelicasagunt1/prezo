<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecipeLine;
use App\Models\Product;

class CubaLibreRecipeSeeder extends Seeder
{
    public function run()
    {
        $cola = Product::where('name', 'Coca-Cola')->first();
        $ron = Product::where('name', 'Ron')->first();
        $hielo = Product::where('name', 'Hielo')->first();

        RecipeLine::create([
            'recipe_id' => 1,
            'product_id' => $cola->id,
            'net_quantity' => 200,
        ]);

        RecipeLine::create([
            'recipe_id' => 1,
            'product_id' => $ron->id,
            'net_quantity' => 200,
        ]);

        RecipeLine::create([
            'recipe_id' => 1,
            'product_id' => $hielo->id,
            'net_quantity' => 2,
        ]);
    }
}
