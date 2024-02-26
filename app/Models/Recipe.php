<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Utils\CostCalculator;

class Recipe extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'selling_price'];

    public function recipeLines()
    {
        return $this->hasMany(RecipeLine::class);
    }

    public function calculateTotalCost()
    {
        $totalCost = CostCalculator::calculateCost($this);

        foreach ($this->subRecipes as $subRecipe) {
            $totalCost += CostCalculator::calculateCost($subRecipe);
        }

        return $totalCost;
    }

    public function subRecipes()
    {
        return $this->belongsToMany(Recipe::class, 'compound_recipe', 'recipe_id', 'sub_recipe_id');
    }

}
