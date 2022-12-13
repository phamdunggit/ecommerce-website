@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Add Category</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('insert-category') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12 mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control">
                    <p class="error">{{ $errors->first('name') }}</p>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                    <p class="error">{{ $errors->first('description') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-check-label" for="">Status</label>
                    <input  type="checkbox" name="status" class="form-check-input">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-check-label" for="">Popular</label>
                    <input type="checkbox" name="popular" class="form-check-input">
                </div>
                <div class="col-md-12 mb-3">
                    <input type="file" name="image" class="form-control">
                </div>
                <p class="error">{{ $errors->first('image') }}</p>
                <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection