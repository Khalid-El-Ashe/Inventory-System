{{-- filepath: resources/views/components/dialog.blade.php --}}
@props([
'name' => null,
'description' => null,
'price' => null,
'quantity' => null,
'category_id' => null,
'categories' => null,
'image' => null,
'id' => null
])

<div class="center">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="container">
                    <div class="card card-primary m-3">
                        <div class="card-header">
                            <h3 class="card-title">Product Update</h3>
                        </div>
                        <form id="productUpdateForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $name }}">
                                </div>
                                <div class="form-group">
                                    <label>Product Description</label>
                                    <textarea class="form-control" rows="3"
                                        name="description">{{ $description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Product Price</label>
                                    <input type="number" class="form-control" name="price" value="{{ $price }}">
                                </div>
                                <div class="form-group">
                                    <label>Quantity</label>
                                    <select class="form-control" name="quantity">
                                        @for($i = 1; $i <= 10; $i++) <option value="{{ $i }}" {{ $quantity==$i
                                            ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Category</label>
                                    <select class="form-control" name="category_id">
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category_id==$category->id ? 'selected'
                                            : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="image">Product Image</label>
                                    <div class="custom-file">
                                        <label class="custom-file-label" for="image">Choose image</label>
                                        <input type="file" class="custom-file-input" name="image" id="image">
                                    </div>
                                    <img id="preview-image"
                                        src="{{ $image ? asset('storage/' . $image) : asset('storage/broken-image.png') }}"
                                        alt="Selected Image" style="display: block; max-height: 150px;"
                                        class="mt-2 rounded">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>