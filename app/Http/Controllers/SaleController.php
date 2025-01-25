<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\SalesItem;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function saleslist()
    {
        $sales = Sale::with('product')->get(); // Fetch all sales with product information
        return view('pages.sale.salesList', compact('sales'));
    }

    public function createSales()
    {
        $products = Product::where('quantity', '>', 0)->get(); // Fetch products with stock
        return view('pages.sale.salesCreate', compact('products'));
    }

    public function storeSales(Request $request)
    {
        // Validate the input
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0.01',
        ]);
    
        $defaultVat = 10; // Default VAT percentage
        $defaultTax = 5;  // Default Tax percentage
    
        // Calculate the total sale values
        $subtotal = 0;
    
        foreach ($request->products as $product) {
            $subtotal += $product['quantity'] * $product['price'];
        }
    
        $vat = ($subtotal * $defaultVat) / 100;
        $tax = ($subtotal * $defaultTax) / 100;
        $total = $subtotal + $vat + $tax;
    
        // Create a sale record
        $sale = Sale::create([
            'invoice_number' => 'INV-' . strtoupper(uniqid()),
            'customer_name' => $request->customer_name,
            'total' => $total,
            'vat' => $vat,
            'tax' => $tax,
        ]);
    
        // Add items to the sales_items table
        foreach ($request->products as $product) {
            $productSubtotal = $product['quantity'] * $product['price'];
    
            SalesItem::create([
                'sale_id' => $sale->id,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
                'price' => $product['price'],
                'subtotal' => $productSubtotal,
            ]);
        }
    
        return redirect()->route('sales.list')->with('success', 'Sale added successfully.');
    }
    
    

    public function getProductPrice($id)
    {
        $product = Product::findOrFail($id);
        return response()->json(['price' => $product->price]);
    }

    public function generateBill($id)
    {
        $sale = Sale::with('items.product')->findOrFail($id);
    
        return view('pages.sale.bill', compact('sale'));
    }
    
}
