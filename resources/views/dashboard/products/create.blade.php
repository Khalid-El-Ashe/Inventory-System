@extends('dashboard.parent')
@section('content')

<div class="container">
    <div class="card card-secondary w-75  m-3">
        <div class="card-header">
            <h3 class="card-title">Create new Product</h3>
        </div>

        <x-toaster-error />

        {{-- <form id="create-form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            --}}
            <form class="needs-validation" id="create-form" onsubmit="event.preventDefault(); storeProduct();">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="product name"
                            value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label>Product Price</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="price"
                            value="{{ old('price') }}">
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <select class="form-control" id="quantity" name="quantity">
                            @for ($i = 1; $i < 100; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" id="category_id" name="category_id">
                            {{-- Loop through categories --}}
                            <option value="">-- None --</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id')==$category->id ? 'selected' : ''
                                }}>
                                {{ $category->name }}
                            </option>
                            {{-- <option value="{{ old($category->id) }}">{{ $category->name }}</option> --}}
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Choose Image</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image"
                                    value="{{ old('image') }}">
                                <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                            </div>
                        </div>

                        <img id="preview-image" src="#" alt="Selected Image" style="display: none; max-height: 150px;"
                            class="mt-2 rounded">
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info">Submit</button>
                </div>
            </form>
    </div>
</div>

@endsection

@section('scripts')

<script>
    function storeProduct() {
        const url = "{{ route('products.store') }}";

        const data = {
        name: document.getElementById("name").value,
        price: document.getElementById("price").value,
        quantity: document.getElementById("quantity").value,
        category_id: document.getElementById("category_id").value,
        image: document.getElementById("image").files[0]
        };

        const formData = new FormData();
        for (const key in data) {
        formData.append(key, data[key]);
        }

        store(url, formData);
    }
</script>
@endsection