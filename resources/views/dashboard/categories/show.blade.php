@extends('dashboard.parent')

@section('content')
<div class="container">
    <button type="button" class="btn btn-danger btn-sm m-3">Clear Products</button>
    <table class="table table-striped table-bordered">
        <thead class="table-secondary">
            <tr>
                <th class="text-center align-middle">Product Name</th>
                <th class="text-center align-middle">Product Price</th>
                <th class="text-center align-middle">Image</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($category_products->products as $product)
            <tr>
                <td class="text-center">{{ $product->name }}</td>
                <td class="text-center">{{ $product->price }}</td>
                <td class="text-center">
                    @if ($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="rounded float-left" width="50"
                        height="50">
                    @else
                    <img src="{{ asset('storage/broken-image.png')}}" class="rounded float-left" width="50" height="50">
                    @endif
                </td>
                <td class="text-start">
                    <a href="" class="btn btn-dark btn-sm m-3">تفاصيل المنتج</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">لا يوجد منتجات</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
