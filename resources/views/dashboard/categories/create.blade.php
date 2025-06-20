@extends('dashboard.parent')
@section('content')

<div class="card card-primary m-3">
    <div class="card-header">
        <h3 class="card-title">Create new Category</h3>
    </div>
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Category Name</label>
                <input type="text" class="form-control" name="name" placeholder="Category name">
            </div>
            <div class="form-group">
                <label>Category Description</label>
                <textarea class="form-control" rows="3" name="description"
                    placeholder="Category description ..."></textarea>
            </div>
            <div class="form-group">
                <label>Category image</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

@endsection
