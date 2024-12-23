<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all());
    }
     // Criar um novo produto
     public function store(Request $request)
     {
         $validated = $request->validate([
             'name' => 'required|string|max:255',
             'description' => 'required|string',
             'price' => 'required|numeric|min:0',
             'quantity' => 'required|integer|min:0',
             'active' => 'required|boolean',
         ]);
 
         $product = Product::create($validated);
 
         return response()->json($product, 201);
     }
 
     // Mostrar um produto específico
     public function show($id)
     {
         $product = Product::find($id);
 
         if (!$product) {
             return response()->json(['error' => 'Product not found'], 404);
         }
 
         return response()->json($product);
     }
 
     // Atualizar um produto existente
     public function update(Request $request, $id)
     {
         $product = Product::find($id);
 
         if (!$product) {
             return response()->json(['error' => 'Product not found'], 404);
         }
 
         $validated = $request->validate([
             'name' => 'string|max:255',
             'description' => 'string',
             'price' => 'numeric|min:0',
             'quantity' => 'integer|min:0',
             'active' => 'boolean',
         ]);
 
         $product->update($validated);
 
         return response()->json($product);
     }
 
     // Excluir um produto
     public function destroy($id)
     {
         $product = Product::find($id);
 
         if (!$product) {
             return response()->json(['error' => 'Product not found'], 404);
         }
 
         $product->delete();
 
         return response()->json(['message' => 'Product deleted successfully']);
     }
}
