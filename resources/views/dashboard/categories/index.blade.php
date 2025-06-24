@extends('dashboard.parent')
@section('content')

{{--
<x-table /> --}}
<div>
    <a href="{{route('categories.create')}}" class="btn btn-outline-primary m-3">Add new Category</a>
    <div class="card text-white bg-secondary m-3">

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
                    {{-- <button class="btn btn-primary"></button> --}}
                </form>
                {{-- <form action="{{route('products.search')}}" method="get">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="query" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form> --}}
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Products</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td>{{$category->name}}</td>
                        <td>{{ $category->products->count() }}</td>
                        <td>
                            <a href="" class="btn btn-outline-success mx-1">عرض</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

@endsection