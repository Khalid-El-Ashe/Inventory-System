@extends('dashboard.parent')
@section('content')

<div class="card card-primary m-3">
    <div class="card-header">
        <h3 class="card-title">Create new Product</h3>
    </div>
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" class="form-control" name="name" placeholder="product name">
            </div>
            <div class="form-group">
                <label>Product Description</label>
                <textarea class="form-control" rows="3" name="description"
                    placeholder="product description ..."></textarea>
            </div>
            <div class="form-group">
                <label>Product Price</label>
                <input type="number" class="form-control" name="price" placeholder="price">
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <select class="form-control" name="quantity">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category_id">
                    {{-- Loop through categories --}}
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Product image</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

@endsection
