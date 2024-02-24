<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipeSeeder extends Seeder
{
    public function run()
    {
        Recipe::create([
            'name' => 'Cuba Libre',
            'selling_price' => 7.50,
        ]);

        Recipe::create([
            'name' => 'Mojito',
            'selling_price' => 8.5,
        ]);
    }
}
