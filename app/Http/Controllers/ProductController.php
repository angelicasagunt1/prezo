<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required|string|unique:products',
                'quantity' => 'required|numeric',
                'price' => 'required|numeric',
                'unit_id' => 'required|exists:units,id',
            ]);

            $product = Product::create([
                'name' => $request->name,
                'quantity' => $request->quantity,
                'price' => $request->price,
                'unit_id' => $request->unit_id,
            ]);

            return response()->json(['message' => 'Producto creado con éxito', 'product' => $product], 201);

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            return response()->json(['errors' => $errors], 422);
        }
    }

    public function getAllProduct()
    {
        try {
            $products = Product::all(['name', 'price']);
            return response()->json(['products' => $products], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error interno del servidor: ' . $e->getMessage()], 500);
        }
    }

}
