<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function purchaselist()
    {
        // Retrieve all purchase records
        $purchases = Purchase::with('product')->get();

        return view('pages.purchase.list', compact('purchases'));
    }

    public function createPurchase()
    {
        // Retrieve products for the form
        $products = Product::all();

        return view('pages.purchase.create', compact('products'));
    }

    public function storePurchase(Request $request)
    {
        // Validate the input
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'product_id' => 'nullable|exists:products,id', // Allow null for product_id if new product is entered
            'product_name' => 'nullable|string|max:255', // Validate the new product name
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0.01',
        ]);
    
        // Check if a product ID is provided
        if ($request->product_id) {
            // Use the existing product
            $product = Product::findOrFail($request->product_id);
        } else {
            // Validate that the new product name is provided
            if (!$request->product_name) {
                return back()->withErrors(['product_name' => 'Please provide a new product name or select an existing product.']);
            }
    
            // Check if the product name already exists
            $product = Product::where('name', $request->product_name)->first();
    
            if (!$product) {
                // Create a new product
                $product = Product::create([
                    'name' => $request->product_name,
                    'quantity' => 0, // Start with 0, as it will be updated below
                    'price' => $request->price,
                ]);
            }
        }
    
        // Update the product's quantity
        $product->quantity += $request->quantity;
        $product->save();
    
        // Add the purchase record
        Purchase::create([
            'supplier_name' => $request->supplier_name,
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'price' => $request->price,
        ]);
    
        return redirect()->route('purchase.list')->with('success', 'Purchase added successfully.');
    }
    
}
