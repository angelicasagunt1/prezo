<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeLine extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'product_id',
        'net_quantity',
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
