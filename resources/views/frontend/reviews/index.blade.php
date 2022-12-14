@extends('layouts.front')
@section('title',"Write a review")

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    @if ($verified_purchase->count()>0)
                        <h5>You are writing a review for {{$products->name}}</h5>
                        <form action="/add-review" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{$products->id}}">
                            <textarea name="user_review" class="form-control" rows="5" placeholder="Write a review"></textarea>
                            <button type="submit" class="btn btn-primary mt-3 float-end">Submit Review</button>
                        </form>
                    @else
                        <div class="alert alert-danger">
                            <h5>You are not eligible to review this product</h5>
                            <p>
                                For the trust worthiess of reviews, onlu customers who purchased
                                the product can write a review about the product.
                            </p>    
                            <a href="{{url('/')}}" class="btn btn-primary mt-3 float-end">Go to the home page</a> 
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection