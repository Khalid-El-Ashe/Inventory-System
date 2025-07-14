<?php

namespace App\Repositories\Product;

use App\Http\Requests\ProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class ProductModelRepository implements ProductRepository // you must add this class in the RepositoryServiceProvider
{

    public function get()
    {
        // $request = request();
        // ->filter($request->query())
        $products = Product::withoutTrashed()->with('category')->latest()->paginate(10);
        $product = Product::with('category')->latest()->first(); // this attribute to the dialog form data
        $categories = Category::all();
        return view('dashboard.products.index', ['products' => $products, 'product' => $product, 'categories' => $categories]);
    }

    public function add(ProductFormRequest $request, Product $product)
    {
        $validated = $request->validated();

        // Handle file upload if an image is provided
        if ($request->hasFile('image')) {
            // $imagePath = $request->file('image')->store('products', 'public');
            $imagePath = $this->uploadFile($request, 'image');
            $validated['image'] = $imagePath;
        }
        // Create the product
        $iscreated = Product::create($validated);

        if ($iscreated) {
            return response()->json([
                'title' => 'Successfully.',
                'icon' => 'success',
                'text' => 'Product created successfully.',
                'redirect' => route('products.index')
            ], Response::HTTP_CREATED);
        } else {
            return response()->json([
                    'title' => 'Oops...',
                'icon' => 'error',
                'text'=> 'Failed to create product, please try again.'
            ], Response::HTTP_BAD_REQUEST);
        }
        // return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }


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
            $path = $this->uploadFile($request, 'image');
            $data['image'] = $path;

            if ($old_image) {
                Storage::disk('public')->delete($old_image);
            }
        }

        $product->update($data);
        // dd($product->fresh());

        return redirect()->route('products.index');
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function searchProduct(FormRequest $request)
    {
        $query = $request->input('query');
        $products = Product::with('category')
            ->where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->paginate(5);

        // $categories = Category::all();
        return view('dashboard.products.index', ['products' => $products, 'query' => $query]);
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
    protected function uploadFile(ProductFormRequest $request, $filename)
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
        $path = $file->store('products', 'public');
        return $path;
    }

    public function getTrashedProducts()
    {
        $productsTrashed = Product::with('category')->onlyTrashed()->paginate(10);
        $categories = Category::all();
        return view('dashboard.products.trashed', ['products' => $productsTrashed, 'categories' => $categories]);
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('products.trashed')->with('success', 'Product restored successfully.');
    }
}
