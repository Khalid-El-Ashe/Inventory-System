<?php

namespace App\Repositories\Product;

use App\Http\Requests\ProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class ProductModelRepository implements ProductRepository // you must add this class in the RepositoryServiceProvider
{

    public function get()
    {
        $products = Product::with('category')->latest()->paginate(10);
        $product = Product::with('category')->latest()->first();
        $categories = Category::all();
        return view('dashboard.products.index', ['products' => $products, 'product' => $product, 'categories' => $categories]);
    }

    public function add(ProductFormRequest $request, Product $product)
    {
        $validated = $request->validated();

        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            // $imagePath = $request->file('image')->store('products', 'public');
            $imagePath = $this->uploadFile($product, $request, 'image');
            $validated['image'] = $imagePath;
        }
        // Create the product
        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function empty() {}

    // public function total(): float
    // {
    //     return 0.0;
    // }

    public function update(ProductFormRequest $request, string $id)
    {

        // $request->validated();
        $product = Product::findOrFail($id);

        $old_image = $product->image;
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            dd($request->file('image'));
            $path = $this->uploadFile($product, $request, 'image');
            $data['image'] = $path;

            if ($old_image) {
                Storage::disk('public')->delete($old_image);
            }
        }

        dd($data);
        $product->update($data);

        return redirect()->route('products.index');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function searchProduct(Product $product)
    {
        // $query = $request->input('query');
        // $products = Product::with('category')
        //     ->active()
        //     ->where('name', 'like', '%' . $query . '%')
        //     ->orWhere('description', 'like', '%' . $query . '%')
        //     ->paginate(12);

        // return view('front.products.search', ['products' => $products, 'query' => $query]);

        // Implement search logic here if needed
        return Product::where('name', 'like', '%' . $product->name . '%')->get();
    }

    public function filter(ProductFormRequest $request)
    {
        $query = Product::with('category')->active();

        if ($request->has('category')) {
            $query->where('category_id', $request->input('category'));
        }

        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->input('price_min'));
        }

        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }

        if ($request->has('sort')) {
            $sort = $request->input('sort');
            if ($sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            } elseif ($sort === 'latest') {
                $query->latest();
            }
        }

        $products = $query->paginate(12);

        return view('front.products.filter', ['products' => $products]);
    }

    // in here you can to write all method you need to use in all controllers project
    protected function uploadFile(Product $product, ProductFormRequest $request, $filename)
    {
        if (!$request->hasFile($filename)) {
            return; // no file to upload
        }
        $file = $request->file($filename);
        // information about file
        // $file->getClientOriginalName(); // get the Original name for the image or file from computer client
        // $file->getSize(); // get the size by byte
        // $file->getClientOriginalExtension();
        // $file->getMimeType(); // image/png file/txt,pdf ....
        // $file->getError(); // 0 if no error, otherwise it will return the error code
        $path = $file->store('uploads', ['disk' => 'public']);
        return $path;
    }
}
