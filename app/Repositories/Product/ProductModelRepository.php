<?php

namespace App\Repositories\Product;

use App\Http\Requests\ProductFormRequest;
use App\Models\Product;

class ProductModelRepository implements ProductRepository // you must add this class in the RepositoryServiceProvider
{

    public function get()
    {
        $products = Product::with('category')->get();
        return view('dashboard.products.index', ['products' => $products]);
    }

    public function add(ProductFormRequest $request)
    {
        $validated = $request->validated();

        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }
        // Create the product
        $product = Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function delete($id) {}

    public function empty() {}

    // public function total(): float
    // {
    //     return 0.0;
    // }

    public function update(ProductFormRequest $request) {

    }
}
