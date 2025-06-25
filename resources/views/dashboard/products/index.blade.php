@extends('dashboard.parent')
@section('content')

{{-- @include('components.dialog', [
'id' => $product->id,
'name' => $product->name,
'description' => $product->description,
'price' => $product->price,
'quantity' => $product->quantity,
'category_id' => $product->category_id,
'categories' => $categories,
'image' => $product->image
]) --}}

<div>
    <div class="btn-group mr-2" role="group" aria-label="First group">
        <a href="{{route('products.create')}}" class="btn btn-primary ms-3">Add new Product</a>
        <a href="{{route('products.trashed')}}" class="btn btn-secondary ms-1">Trashes</a>
    </div>
    <div class="card m-3">
        <div class="card-header">
            <div class="card-tools">
                <form action="{{URL::current()}}" method="get" class="d-flex justify-content-between mb-4 mx-2">

                    {{--
                    <x-form.input name="name" placeholder="Name" :value="request('name')" /> --}}
                    <input type="text" name="name" class="form-control float-right" placeholder="Search"
                        value="{{ request('name') }}">
                    <span class="input-group-append">
                        <button type="submit" class="btn btn-info btn-flat">Seach</button>
                    </span>
                </form>
            </div>
        </div>

        <!-- /.card-header -->
        <div class="card-body p-0">
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
                    @forelse($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td class="fs-5 fw-bold">{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>
                            @if ($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" class="rounded" width="50" height="50">
                            @else
                            <img src="{{ asset('storage/broken-image.png')}}" class="rounded" width="50" height="50">
                            @endif
                        </td>
                        <td><span class="badge fs-6 bg-info tx">{{ $product->category ? $product->category->name :
                                '-' }}</span></td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" href="{{route('products.show', $product->id)}}">
                                <i class="fas fa-folder">
                                </i>
                                View
                            </a>
                            <a class="btn btn-info btn-sm" href="{{route('products.edit', $product->id)}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <form action="{{route('products.destroy', $product->id)}}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash">
                                    </i>
                                    Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">nothing</td>
                    </tr>
                    @endforelse
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
{{-- <script>
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
</script> --}}
@endsection