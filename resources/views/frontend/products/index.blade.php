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
            <h1>{{$category->name}} </h1>
            <div class="col-md-12 py-3 mb-4 ">
                <h5 class="d-flex me-5">Sắp xếp theo:</>
                <button class="sorting btn btn-primary mx-3" data-name="new">Mới nhất</button>
                <button class="sorting btn btn-outline-primary me-3" data-name="best_sell">Bán chạy</button>
                <button id="price" class="btn btn-outline-primary dropdown-toggle" data-name="price" type="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Giá
                </button>
                <ul class="dropdown-menu">
                    <li><button class="sorting dropdown-item" data-name="price_asc">Thấp đến cao</button></li>
                    <li><button class="sorting dropdown-item" data-name="price_desc">Cao đến thấp</button></li>
                </ul>
            </div>
            <div class="data row">
                @include("frontend.products.data");
            </div>
        </div>
        <input type="hidden" name="hidden_search_input" id="hidden_search_input" value="" />
        <input type="hidden" name="hidden_sort_by" id="hidden_sort_by" value="created_at" />
        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="desc" />
        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
    </div>
</div>
@endsection