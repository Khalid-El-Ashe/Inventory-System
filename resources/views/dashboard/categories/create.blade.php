@extends('dashboard.parent')
@section('content')

<div class="container">
    <div class="card card-secondary m-3">
        <div class="card-header">
            <h3 class="card-title">Create new Category</h3>
        </div>

        <x-toaster-error />

        <form class="needs-validation" action="{{ route('categories.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Category name"
                        value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <label>Category image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image" value="{{ old('image') }}">
                            <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection
