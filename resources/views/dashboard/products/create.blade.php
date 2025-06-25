@extends('dashboard.parent')
@section('content')

<div class="container">
    <div class="card card-secondary w-75  m-3">
        <div class="card-header">
            <h3 class="card-title">Create new Product</h3>
        </div>

        <x-toaster-error />

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" name="name" placeholder="product name"
                        value="{{ old('name') }}">
                </div>
                {{-- <div class="form-group">
                    <label>Product Description</label>
                    <textarea class="form-control" rows="3" name="description" placeholder="product description ...">
                            {{ old('description') }}
                        </textarea>
                </div> --}}
                <div class="form-group">
                    <label>Product Price</label>
                    <input type="number" class="form-control" name="price" placeholder="price"
                        value="{{ old('price') }}">
                </div>
                <div class="form-group">
                    <label>Quantity</label>
                    <select class="form-control" name="quantity">
                        @for ($i = 1; $i < 100; $i++) <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label>Category</label>
                    <select class="form-control" name="category_id">
                        {{-- Loop through categories --}}
                        <option value="">-- None --</option>
                        @foreach($categories as $category)
                        <option value="{{ old($category->id) }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Choose Image</label>
                    <div class="custom-file">
                        <label class="custom-file-label" for="image">Choose image</label>
                        <input type="file" class="custom-file-input" name="image" id="image" value="{{ old('image') }}">
                        {{-- لاحظ فوق اني انا فقط معطي المستخدم يرفع بس صور accept="image*/" --}}
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
{{-- <script>
    document.getElementById("image").addEventListener("change", function (event) {
    const reader = new FileReader();
    const file = event.target.files[0];

    if (file) {
    reader.onload = function (e) {
    const preview = document.getElementById("preview-image");
    preview.src = e.target.result;
    preview.style.display = "block";
    };
    reader.readAsDataURL(file);
    }
    });
</script> --}}
@endsection
