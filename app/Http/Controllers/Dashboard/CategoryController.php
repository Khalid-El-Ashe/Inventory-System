<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('products')->latest()->paginate(10);
        return view('dashboard.categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate(
            [
                'name' => 'required|string|max:255|unique:categories,name',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            ],
            [
                'name.required' => 'The category name is required.',
                'name.unique' => 'The category name must be unique.',
                'image.required' => 'The category image is required.',
                'image.image' => 'The category image must be an image file.',
                'image.mimes' => 'The category image must be a file of type: jpeg,png,jpg,gif,svg,webp.',
                'image.max' => 'The category image must not be greater than 2MB.',
            ]
        );

        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $validator['image'] = $imagePath;
        }

        // Create the category
        Category::create($validator);
        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category_products, $id)
    {
        $category_products = Category::where('id', '=', $id)->with('products')->first();
        return view('dashboard.categories.show', ['category_products' => $category_products]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = $request->validate(
            [
                'name' => 'required|string|max:255|unique:categories,name' . $category->id, // i need to get the id of the category to do net make an error is uniqued
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            ],
            [
                'name.required' => 'The category name is required.',
                'name.unique' => 'The category name must be unique.',
                'image.required' => 'The category image is required.',
                'image.image' => 'The category image must be an image file.',
                'image.mimes' => 'The category image must be a file of type: jpeg,png,jpg,gif,webp,svg.',
                'image.max' => 'The category image must not be greater than 2MB.',
            ]
        );

        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            $validator['image'] = $imagePath;
        }

        // Update the category
        $category->update($validator);
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Delete the category
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
