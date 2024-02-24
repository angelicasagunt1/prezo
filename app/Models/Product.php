<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quantity', 'price','unit_id'];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function formattedPrice()
    {
        return '$' . number_format($this->price, 2);
    }
}
