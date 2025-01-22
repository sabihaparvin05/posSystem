<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function create()
    {
        return view('pages.category.add');
    }


    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|unique:categories|max:255',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        // Create the slug from the name
        $slug = Str::slug($request->name, '-');

        // Save the category to the database
        $category = Category::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        // Redirect back with a success message
        return redirect()->route('categories.list')->with('success', 'Category added successfully.');
    }


    public function list(){
        $categories=Category::all();
        return view('pages.category.list',compact('categories'));
    }

    public function edit($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail(); // Find by slug
    return view('pages.category.edit', compact('category'));
}

public function update(Request $request, $slug)
{
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255|unique:categories,name,' . $slug . ',slug',
        'description' => 'nullable|string',
        'status' => 'required|boolean',
    ]);

    $category = Category::where('slug', $slug)->firstOrFail();

    // Update the slug if the name changes
    $updatedSlug = ($category->name !== $request->name) ? Str::slug($request->name, '-') : $category->slug;

    // Update the category
    $category->update([
        'name' => $request->name,
        'slug' => $updatedSlug,
        'description' => $request->description,
        'status' => $request->status,
    ]);

    return redirect()->route('categories.list')->with('success', 'Category updated successfully.');
}

public function destroy($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail(); // Find by slug
    $category->delete();

    return redirect()->route('categories.list')->with('success', 'Category deleted successfully.');
}


}
