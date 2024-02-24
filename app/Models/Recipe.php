<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'selling_price'];

    public function recipeLines()
    {
        return $this->hasMany(RecipeLine::class);
    }

    public function calculateCost(): float|int
    {
        $totalCost = 0;

        foreach ($this->recipeLines as $line) {
            $product = $line->product;
            $quantity = $line->quantity;
            $unitType = $line->product->unit->abbreviation;

            if ($unitType == 'ml' || $unitType == 'kg') {
                $totalCost += $product->price / ($line->product->quantity / $line->net_quantity);
            } else {
                $totalCost += $product->price * $quantity;
            }
        }

        return $totalCost;
    }
}
