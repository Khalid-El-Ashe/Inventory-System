@extends('dashboard.parent')

@section('content')
<div class="contaner m-5">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead class="table-dark">
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
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->quantity}}</td>
                    <td>
                        @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="rounded-circle" width="50"
                            height="50">
                        @else
                        <img src="{{ asset('storage/broken-image.png')}}" class="rounded-circle" width="50" height="50">
                        @endif
                    </td>
                    <td>{{ $product->category ? $product->category->name : '-' }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{route('products.restore', $product->id)}}"
                                class="btn btn-outline-info mx-1">استرجاع</a>
                            <form action="{{route('products.destroy', $product->id)}}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger mx-1">حذف</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">no trashes</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{-- this is to get the Pagination style if i have it --}}
        {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
