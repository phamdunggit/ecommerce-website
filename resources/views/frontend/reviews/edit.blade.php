@extends('layouts.front')
@section('title',"Edit your review")

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                        <h5>You are writing a review for {{$review->product->name}}</h5>
                        <form action="/update-review" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="review_id" value="{{$review->id}}">
                            <textarea name="user_review" class="form-control" rows="5" placeholder="">{{$review->user_review}}</textarea>
                            <button type="submit" class="btn btn-primary mt-3 float-end">Update Review</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection