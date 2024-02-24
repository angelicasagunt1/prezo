<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Ron Havanna',
            'quantity' => 1000,
            'price' => 10.00,
            'unit_id' => 1,
        ]);

        Product::create([
            'name' => 'Coca-Cola',
            'quantity' => 1000,
            'price' => 1.50,
            'unit_id' => 1,
        ]);

        Product::create([
            'name' => 'Hielo',
            'quantity' => 1,
            'price' => 0.05,
            'unit_id' => 2,
        ]);

        // Agregar productos para hacer un Mojito
        Product::create([
            'name' => 'Ron',
            'quantity' => 1000, // ml
            'price' => 10.00,
            'unit_id' => 1,
        ]);

        Product::create([
            'name' => 'Menta',
            'quantity' => 1,
            'price' => 2.00,
            'unit_id' => 2,
        ]);

        Product::create([
            'name' => 'Limón',
            'quantity' => 1,
            'price' => 0.50,
            'unit_id' => 2,
        ]);

    }
}
