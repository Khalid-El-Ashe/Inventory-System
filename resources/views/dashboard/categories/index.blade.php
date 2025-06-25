@extends('dashboard.parent')
@section('content')

<div>
    <a href="{{route('categories.create')}}" class="btn btn-primary ms-3">Add new Category</a>
    <div class="card m-3">

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
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Products</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                    <tr>
                        <td>{{$category->id}}</td>
                        <td class="fs-5 fw-bold">{{$category->name}}</span></td>
                        <td><span class="badge fs-6 bg-info tx"> {{$category->products->count() }}</span></td>
                        <td class="project-actions text-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('categories.show', $category->id) }}">
                                <i class="fas fa-folder">
                                </i>
                                View</a>
                            <form action="{{route('categories.destroy', $category->id)}}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash">
                                    </i>
                                    Delete
                                </button>
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
        </div>
        <!-- /.card-body -->
    </div>
</div>

@endsection