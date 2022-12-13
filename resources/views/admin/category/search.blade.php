@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Category Search Result </h4>
        <hr>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2 float-end">
                <form action="{{url('/cate-search')}}" method="post">
                    @csrf
                    <div class="input-group no-border">
                      <input type="text" value="" name="cate_search" class="form-control" placeholder="Search...">
                      <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                      </button>
                    </div>
                  </form>
            </div>
        </div>
        <table id="table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th onclick="sortTable(0)">Name</th>
                    <th onclick="sortTable(1)">Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category as $item)
                <tr>
                    
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td><img src="{{ asset('assets/uploads/category/'.$item->image) }}" class="cate-image" alt="Image Here"></td>
                    <td>
                        <a href="{{ url('edit-cate/'.$item->slug) }}" class="btn btn-primary">Edit</a>
                        <a href="{{ url('/delete-category/'.$item->slug) }}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-9"></div>
            <div class="col-md-3">{{ $category->onEachSide(5)->links() }}</div>
        </div>
    </div>
</div>
@endsection