@extends('layouts.front')
@section('title')
Products
@endsection
@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top ">
    <div class="container">
        <h6 class="mb-0">Collections / {{$category->name}} </h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <h2>{{$category->name}} </h2>
            <div class="col-md-12 border py-3 mb-4 ">
                <label for="" class=" me-5">Sắp xếp theo</label>
                <button class="sorting btn btn-primary mx-3" data-name="new">Mới nhất</button>
                <button class="sorting btn btn-outline-primary me-3" data-name="best_sell">Bán chạy</button>
                <button id="price" class="btn btn-outline-primary dropdown-toggle" data-name="price" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Giá
                </button>
                <ul class="dropdown-menu">
                    <li><button class="sorting dropdown-item" data-name="price_asc">Thấp đến cao</button></li>
                    <li><button class="sorting dropdown-item" data-name="price_desc">Cao đến thấp</button></li>
                </ul>
            </div>

            @foreach( $products as $prod)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <a href="{{url('/category/'.$category->slug.'/'.$prod->slug)}}">
                        <img class="product-image" src="{{ asset('assets/uploads/product/image/'.$prod->image) }}"
                            alt="Product Image">
                        <div class="card-body">
                            <h5>{{ $prod->name }}</h5>
                            <span class="float-start price">{{ $prod->selling_price }}</span>
                            <span class="float-end "><s class="price">{{ $prod->original_price }}</s></span>
                        </div>
                    </a>
                </div>

            </div>
            @endforeach
            <div class="row">
                <div class="col-12">
                    {{ $products->onEachSide(5)->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection