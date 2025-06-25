@extends('dashboard.parent')
@section('content')

<div>
    <a href="{{route('categories.create')}}" class="btn btn-primary ms-3">Add new Category</a>
    <div class="card text-white bg-secondary m-3">

        <x-toaster-success />

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
                        <td class="fs-5 fw-bold">{{$category->name}}</span></td>
                        <td><span class="badge fs-6 bg-info tx"> {{$category->products->count() }}</span></td>
                        <td>
                            <div class="btn-groub">
                                <a href="{{ route('categories.show', $category->id) }}"
                                    class="btn btn-outline-success mx-1">عرض</a>
                                <form action="{{route('categories.destroy', $category->id)}}" method="POST"
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
        </div>
        <!-- /.card-body -->
    </div>
</div>

@endsection