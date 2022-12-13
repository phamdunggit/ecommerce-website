@extends('layouts.front')
@section('title')
Category
@endsection
@section('content')

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>All categories</h2>
                <div class="row">
                    @foreach($category as $cate)
                    <div class="col-md-3 mb-3">
                        <a href="{{  url('/category/'.$cate->slug) }}">
                            <div class="card">
                                <img src="{{ asset('assets/uploads/category/'.$cate->image) }}" alt="Category Image">
                                <div class="card-body">
                                    <h5>{{$cate->name}}</h5>
                                    <p>{{$cate->description}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                    <div class="row">
                        <div class="col-12">
                            {{ $category->onEachSide(5)->links() }}
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>
</div>
@endsection