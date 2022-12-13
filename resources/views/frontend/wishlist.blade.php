@extends('layouts.front')
@section('title')
My wishlist
@endsection
@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top ">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}">Home</a>
            / <a href="{{url('/wishlist')}}"> Wish list</a>
        </h6>
    </div>
</div>
<div class="container my-5">
    <div class="card shadow wishlist-items">

        @if ($wishlist->count()>0)
        <div class="card-body">
            @foreach($wishlist as $item)
            <div class="row mt-3 product_data">
                <div class="col-md-2 my-auto">
                    <img src="{{ asset('assets/uploads/product/'.$item->products->image) }}" class="w-100" alt="image">
                </div>
                <div class="col-md-2 my-auto">
                    <h6>{{$item->products->name}}</h6>
                </div>
                <div class="col-md-2 my-auto">
                    <h6 class="price">{{$item->products->selling_price}}</h6>
                </div>
                <div class="col-md-2 my-auto">
                    <input type="hidden" name="" class="prod_id" value="{{$item->prod_id}}">
                    @if($item->products->qty>$item->prod_qty)
                    <label for="Quantity">Quantity</label>
                    <div class="input-group text-center mb-3" style="width:130px;">
                        <button class="input-group-text decrement-btn">-</button>
                        <input type="text" name="quantity" class="form-control qty-input text-center"
                            value="1">
                        <button class="input-group-text increment-btn">+</button>
                    </div>
                    @else
                    <h6>Out of stock</h6>
                    @endif
                </div>
                <div class="col-md-2 my-auto">
                    <button class="btn btn-success addToCartBtn"><i class="fa fa-shopping-cart"></i> Add to
                        cart</button>
                </div>
                <div class="col-md-2 my-auto">
                    <button class="btn btn-danger remove-item-wishlist"><i class="fa fa-trash"></i> Remmove</button>
                </div>
            </div>
            @endforeach
            @else
            <h4>These is no product in your Wishlist !!</h4>
            @endif
        </div>
    </div>
</div>

@endsection
