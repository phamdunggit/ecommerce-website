@extends('layouts.front')
@section('title')
Products
@endsection
@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top ">
    <div class="container">
        <h6 class="mb-0">Search results </h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <h2>Search Results</h2>
            @foreach( $products as $prod)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <a href="{{url('/category/'.$prod->category->slug.'/'.$prod->slug)}}">
                        <img class="product-image" src="{{ asset('assets/uploads/product/image/'.$prod->image) }}" alt="Product Image">
                        <div class="card-body">
                            <h5>{{ $prod->name }}</h5>
                            <span class="float-start price">{{ $prod->selling_price }}</span>
                            <span class="float-end "><s class="price">{{ $prod->original_price }}</s></span>
                        </div>
                    </a>
                </div>

            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection