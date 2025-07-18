<?php

namespace App\Repositories\Product;

use App\Http\Requests\ProductFormRequest;
use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

interface ProductRepository // you must add this class in the RepositoryServiceProvider
{
    // public function get(): Collection;
    public function get();
    public function add(ProductFormRequest $request, Product $product);
    public function delete($id);
    // public function total(): float;
    public function update(ProductFormRequest $request, string $id);
    public function searchProduct(FormRequest $product);
    public function filter(ProductFormRequest $request);
    public function getTrashedProducts();
    public function restore($id);
}
