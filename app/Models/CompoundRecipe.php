<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompoundRecipe extends Model
{
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
