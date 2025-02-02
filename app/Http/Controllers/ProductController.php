<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list()
    {
        $products = Product::with('category')->get(); // Load category relationship
        return view('pages.product.list', compact('products'));
    }

    /**
     * Show the form to create a new product.
     */
    public function create()
    {
        $categories = Category::all(); // Fetch all categories
        return view('pages.product.add', compact('categories'));
    }

    /**
     * Store a new product in the database.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable|string|max:255',
            'part_number' => 'nullable|string|max:255',
            'vehicle_type' => 'nullable|string|max:255',
            'compatible_models' => 'nullable|string|max:255',
            'status' => 'required|boolean',
        ]);

         // Create the slug from the name
         $slug = Str::slug($request->name, '-');

        // Create the product
        Product::create([
            'name' => $request->name,
            'slug' => $slug , 
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category_id' => $request->category_id,
            'brand' => $request->brand,
            'part_number' => $request->part_number,
            'vehicle_type' => $request->vehicle_type,
            'compatible_models' => $request->compatible_models,
            'status' => $request->status,
        ]);

        return redirect()->route('products.list')->with('success', 'Product added successfully.');
    }

    public function edit($slug)
{
    $product = Product::where('slug', $slug)->firstOrFail();
    $categories = Category::all(); // Fetch categories for dropdown
    return view('pages.product.edit', compact('product', 'categories'));
}

public function update(Request $request, $slug)
{
    

    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'quantity' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'brand' => 'nullable|string|max:255',
        'part_number' => 'nullable|string|max:255',
        'vehicle_type' => 'nullable|string|max:255',
        'compatible_models' => 'nullable|string|max:255',
        'status' => 'required|boolean',
    ]);


    $product = Product::where('slug', $slug)->firstOrFail();

    // Update the slug if the name changes
    $updatedSlug = ($product->name !== $request->name) ? Str::slug($request->name, '-') : $product->slug;


    // Update the product
    $product->update([
        'name' => $request->name,
        'slug' => $updatedSlug,
        'description' => $request->description,
        'price' => $request->price,
        'quantity' => $request->quantity,
        'category_id' => $request->category_id,
        'brand' => $request->brand,
        'part_number' => $request->part_number,
        'vehicle_type' => $request->vehicle_type,
        'compatible_models' => $request->compatible_models,
        'status' => $request->status,
    ]);

    return redirect()->route('products.list')->with('success', 'Product updated successfully.');
}

public function destroy($slug)
{
    $product = Product::where('slug', $slug)->firstOrFail();
    $product->delete();

    return redirect()->route('products.list')->with('success', 'Product deleted successfully.');
}

}
