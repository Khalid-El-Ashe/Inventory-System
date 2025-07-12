<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\Product\ProductRepository;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class ProductController extends Controller
{

    protected $repository;
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->repository->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.products.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductFormRequest $request, Product $product)
    {
        return $this->repository->add($request, $product);
    }

    public function show($id)
    {
        $product = Product::where('id', '=', $id)->with('category')->first();
        return view('dashboard.products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('dashboard.products.edit', ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductFormRequest $request, string $id)
    {
        return $this->repository->update($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return $this->repository->delete($id);
    }

    // public function total(): float
    // {
    //     return $this->repository->total();
    // }

    public function search(FormRequest $request)
    {
        return $this->repository->searchProduct($request);
    }

    public function getTrashedProducts()
    {
        return $this->repository->getTrashedProducts();
    }
    public function restore($id)
    {
        return $this->repository->restore($id);
    }
}
