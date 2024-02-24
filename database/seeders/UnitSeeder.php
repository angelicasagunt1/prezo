<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            'abbreviation' => 'ml',
            'description' => 'mililitro',
        ]);

        Unit::create([
            'abbreviation' => 'u',
            'description' => 'unidad',
        ]);

        Unit::create([
            'abbreviation' => 'kg',
            'description' => 'kilos',
        ]);
    }
}
