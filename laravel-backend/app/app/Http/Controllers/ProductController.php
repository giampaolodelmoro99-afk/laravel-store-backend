<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $products = Product::with('orders')->get();
        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'code' =>['required', 'string','max:255']
            ]);
            
        $product = Product::create($validated);
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json($product->load(['orders']), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'code' =>['sometimes', 'string', 'max:255']
        ]);
            
        $product->update($validated);
        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }


    public function attachOrder(Product $product, Order $order){
        $product->orders()->syncWithoutDetaching([$order->id]);
        return response()->json(['message' => 'Ordine collegato'], 200);
    }

    public function detachOrder(Product $product, Order $order ){
        $product->orders()->detach($order->id);
        return response()->json(['message' => 'Ordine scollegato'], 200);
    }
}
