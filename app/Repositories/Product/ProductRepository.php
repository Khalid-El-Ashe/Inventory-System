<?php

namespace App\Repositories\Product;

use App\Http\Requests\ProductFormRequest;
use App\Models\Product;

interface ProductRepository // you must add this class in the RepositoryServiceProvider
{
    // public function get(): Collection;
    public function get();
    public function add(ProductFormRequest $request);
    public function delete($id);
    public function empty();
    // public function total(): float;
    public function update(ProductFormRequest $request);
}
