@extends('dashboard.parent')
@section('content')

<div class="card card-secondary m-3">
    <div class="card-header">
        <h3 class="card-title">Update Product</h3>
    </div>
    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" class="form-control" name="name" value="{{ $product->name }}">
            </div>
            <div class="form-group">
                <label>Product Description</label>
                <textarea class="form-control" rows="3" name="description">{{ $product->description }}</textarea>
            </div>
            <div class="form-group">
                <label>Product Price</label>
                <input type="number" class="form-control" name="price" value="{{ $product->price }}">
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <select class="form-control" name="quantity">
                    @for($i = 1; $i <= 100; $i++) <option value="{{ $i }}" {{ $product->quantity == $i ? 'selected' : ''
                        }}>{{ $i }}</option>
                        @endfor
                </select>
            </div>
            <div class="form-group">
                <label>Category</label>
                <select class="form-control" name="category_id">
                    {{-- Loop through categories --}}
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image">Choose Image</label>
                <div class="custom-file">
                    <label class="custom-file-label" for="image">Choose image</label>
                    <input type="file" class="custom-file-input" name="image" id="image">
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
<script>
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
</script>
@endsection