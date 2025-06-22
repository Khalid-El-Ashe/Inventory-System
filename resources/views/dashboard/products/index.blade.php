@extends('dashboard.parent')
@section('content')

@include('components.dialog', [
'id' => $product->id,
'name' => $product->name,
'description' => $product->description,
'price' => $product->price,
'quantity' => $product->quantity,
'category_id' => $product->category_id,
'categories' => $categories,
'image' => $product->image
])

<div>
    <a href="{{route('products.create')}}" class="btn btn-outline-primary m-3">Add new Product</a>
    <div class="card m-3">
        <div class="card-header">
            <h3 class="card-title">Products Table</h3>

            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Image</th>
                        <th>Type</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>
                            @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="rounded-circle" width="50"
                                height="50">
                            @else
                            <img src="{{ asset('storage/broken-image.png')}}" class="rounded-circle" width="50"
                                height="50">
                            @endif
                        </td>
                        <td>{{ $product->category ? $product->category->name : '-' }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{route('products.show', $product->id)}}"
                                    class="btn btn-outline-success mx-1">عرض</a>
                                {{-- <a href="javascript:void(0);" class="btn btn-outline-info mx-1"
                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                    data-product-id="{{ $product->id }}" data-product-name="{{ $product->name }}"
                                    data-product-description="{{ $product->description }}"
                                    data-product-price="{{ $product->price }}"
                                    data-product-quantity="{{ $product->quantity }}"
                                    data-product-category="{{ $product->category_id }}"
                                    data-product-image="{{ $product->image }}">
                                    تعديل </a> --}}
                                <a href="{{route('products.edit', $product->id)}}"
                                    class="btn btn-outline-info mx-1">تعديل</a>
                                <form action="{{route('products.destroy', $product->id)}}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger mx-1">حذف</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- this is to get the Pagination style if i have it --}}
            {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
        <!-- /.card-body -->
    </div>
</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var dialogFormModel = document.getElementById('exampleModal');
        var form = document.getElementById('productUpdateForm');

        dialogFormModel.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;

            // i need to get the data attributes from the button
            var productId = button.getAttribute('data-product-id');
            var productName = button.getAttribute('data-product-name');
            var productDescription = button.getAttribute('data-product-description');
            var productPrice = button.getAttribute('data-product-price');
            var productQuantity = button.getAttribute('data-product-quantity');
            var categoryId = button.getAttribute('data-product-category');

            // Set the form action and values
            form.action = '/dashboard/admin/products/' + productId;
            form.querySelector('input[name="name"]').value = productName;
            form.querySelector('textarea[name="description"]').value = productDescription;
            form.querySelector('input[name="price"]').value = productPrice;
            form.querySelector('select[name="quantity"]').value = productQuantity;
            form.querySelector('select[name="category_id"]').value = categoryId;
        });
    });
</script>
@endsection