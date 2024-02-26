<?php

namespace App\Utils;

class CostCalculator
{
    public static function calculateCost($recipe)
    {
        $totalCost = 0;

        foreach ($recipe->recipeLines as $line) {
            $product = $line->product;
            $unitType = $line->product->unit->abbreviation;

            if ($unitType == 'ml' || $unitType == 'kg') {
                $totalCost += $product->price / ($line->product->quantity / $line->net_quantity);
            } else {
                $totalCost += $product->price * $line->net_quantity;
            }
        }

        return $totalCost;
    }
}
