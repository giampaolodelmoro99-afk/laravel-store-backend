<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Product;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['customer', 'products'])->get();
        
        return response()->json($orders, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'time' =>['required', 'date_format:H:i'],
            'customer_id' => ['required', 'exists:customers,id']
            ]);
            
        $order = Order::create($validated);
        return response()->json($order, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response()->json($order->load(['customer', 'products']), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'name' => ['sometimes', 'string', 'max:255'],
            'date' => ['sometimes', 'date'],
            'time' => ['sometimes', 'date_format:H:i'],
            'customer_id' => ['sometimes', 'exists:customers,id']
        ]);
        
        $order->update($validated);
        return response()->json($order, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return response()->json(null, 204);
    }


    public function attachCustomer(Order $order, Customer $customer){
        $order->customer()->associate($customer);
        $order->save();

        return response()->json(['message' => 'Cliente associato'], 200);
    }

    public function attachProduct(Order $order, Product $product){
        $order->products()->syncWithoutDetaching([$product->id]);

        return response()->json(['message' => 'Prodotto aggiunto all\'ordine'], 200);
    }

    public function detachCustomer(Order $order, Customer $customer ){
        $order->customer()->dissociate();
        $order->save();
        return response()->json(['message' => 'Cliente rimosso dall\'ordine'], 200);
    }

    public function detachProduct(Order $order, Product $product){
        $order->products()->detach($product->id);
        return response()->json(['message' => 'Prodotto rimosso dall\'ordine'], 200);
    }

}
