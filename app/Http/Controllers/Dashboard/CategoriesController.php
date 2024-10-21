<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $categories = Category::all();
         return view('dashboard.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parent = Category::all();
        return view('dashboard.categories.create',compact('parent'));
    }

    /**
     * Store a newly created resource in storage.
     */


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'parent_id' => 'nullable|integer',
            'status' => 'required|string',
        ]);

        $slug = Str::slug($validatedData['name']);

        // Check if the slug already exists and modify it if necessary
        $originalSlug = $slug;
        $counter = 1;
        while (\App\Models\Category::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$counter}";
            $counter++;
        }

        // Create the category with the unique slug
        \App\Models\Category::create([
            'name' => $validatedData['name'],
            'parent_id' => $validatedData['parent_id'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'status' => $validatedData['status'],
            'slug' => $slug,
        ]);

        return redirect()->route('dashboard.categories.index')->with('success', 'Category created successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id); // Single category
        $parentCategories = Category::whereNull('parent_id')->get(); // Fetch parent categories

        return view('dashboard.categories.edit', compact('category', 'parentCategories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categories = Category::findOrFail($id);
        $categories->update($request->all());
        return redirect()->route('dashboard.categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();
        return redirect()->route('dashboard.categories.index')->with('success', 'Category deleted successfully!');
    }
}
