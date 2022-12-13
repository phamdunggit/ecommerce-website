@extends('layouts.front')
@section('title',$products->name)

@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top ">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/category')}}">Collections</a>
            / <a href="{{url('/category/'.$products->category->slug)}}">{{$products->category->name}}</a>
            / <a href="{{url('/category/'.$products->category->slug.'/'.$products->slug)}}"> {{$products->name}}</a>
        </h6>
    </div>
</div>
<div class="container pb-5">
    <div class="product_data">
        <div>
            <div class="row">
                <div class="col-md-4">
                    {{-- <img src="{{asset('assets/uploads/product/image/'.$products->image)}}" class="w-100" alt="">
                    --}}
                    @php
                    $i=0;$j=0
                    @endphp

                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            @foreach ($products->productimage as $image)
                            @if ($i==0)
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$i}}"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            @else
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$i}}"
                                aria-label="Slide 2"></button>
                            @endif
                            @php
                            $i++;
                            @endphp
                            @endforeach
                        </div>
                        <div class="carousel-inner">
                            @foreach ($products->productimage as $image)
                            @if ($j==0)
                            <div class="carousel-item active">
                                <img src="{{asset('assets/uploads/product/image_detail/'.$image->images)}}" class="d-block w-100" alt="...">
                            </div>
                            @else
                            <div class="carousel-item">
                                <img src="{{asset('assets/uploads/product/image_detail/'.$image->images)}}" class="d-block w-100" alt="...">
                            </div>
                            @endif
                            @php
                            $j++;
                            @endphp
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-8">
                    <h2 class="mb-0">
                        {{$products->name}}
                        @if($products->trending=='1')
                        <label style="font-size: 16px;" class="float-end badge bg-danger trending_tag">Trending</label>
                        @endif

                        <hr>
                        <label class="me-3">Original Price: <s class="price">{{$products->original_price}}</s></label>
                        <label class="fw-bold price">Selling Price: {{$products->selling_price}}</label>
                        @php
                        $ratenum=number_format($rating_value)
                        @endphp
                        <div class="rating">
                            @for ($i=1;$i<=$ratenum;$i++) <i class="fa fa-star checked"></i>
                                @endfor
                                @for ($j=1;$j<=5-$ratenum;$j++) <i class="fa fa-star"></i>
                                    @endfor
                                    @if ($ratings->count()==0)
                                    <span>No Ratings</span>
                                    @else
                                    <span>{{$ratings->count()}}Ratings</span>
                                    @endif
                        </div>

                        <p class="mt-3">{!! $products->small_description !!}</p>
                        <hr>
                        @if($products->qty>0)
                        <label class="badge bg-success">In stock</label>
                        @else
                        <label class="badge bg-danger">Out of stock</label>
                        @endif
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <input type="hidden" value="{{$products->id}}" class="prod_id" name="">
                                <label for="quantity">Quantity</label>
                                <div class="input-group text-center mb-3">
                                    <span class="input-group-text decrement-btn">-</span>
                                    <input type="text" name="quantity" value="1"
                                        class="form-control text-center qty-input">
                                    <span class="input-group-text increment-btn">+</span>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <br>

                                <button type="button" class="btn btn-success me-3 addToWishlist float-start">Add to
                                    Wishlist <i class="fa fa-heart"></i></button>
                                @if($products->qty>0)
                                <button type="button" class="btn btn-primary me-3 addToCartBtn float-start"> Add to cart
                                    <i class="fa fa-shopping-cart"></i></button>
                                @endif

                            </div>

                        </div>
                    </h2>
                </div>
                <div class="col-md-12">
                    <hr>
                    <h3>Description</h3>
                    <p>{!! $products->description !!}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <hr>
                    <a type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Rate this Product
                    </a>
                    <a href="{{url('/add-review/'.$products->slug.'/user-review')}}" type="button" class="btn btn-link">
                        Write a review
                    </a>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{url('/add-rating')}}" method="POST">
                                    <input type="hidden" name="product_id" value="{{$products->id}}">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"> {{$products->name}}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="rating-css">
                                            <div class="star-icon">
                                                @if ($user_rating)
                                                @for ($i=1;$i<=$user_rating->stars_rated;$i++)
                                                    <input type="radio" value="{{$i}}" name="product_rating" checked
                                                        id="rating{{$i}}">
                                                    <label for="rating{{$i}}" class="fa fa-star"></label>
                                                    @endfor
                                                    @for ($j=$user_rating->stars_rated+1;$j<=5;$j++) <input type="radio"
                                                        value="{{$j}}" name="product_rating" id="rating{{$j}}">
                                                        <label for="rating{{$j}}" class="fa fa-star"></label>
                                                        @endfor
                                                        @else
                                                        <input type="radio" value="1" name="product_rating" checked
                                                            id="rating1">
                                                        <label for="rating1" class="fa fa-star"></label>
                                                        <input type="radio" value="2" name="product_rating"
                                                            id="rating2">
                                                        <label for="rating2" class="fa fa-star"></label>
                                                        <input type="radio" value="3" name="product_rating"
                                                            id="rating3">
                                                        <label for="rating3" class="fa fa-star"></label>
                                                        <input type="radio" value="4" name="product_rating"
                                                            id="rating4">
                                                        <label for="rating4" class="fa fa-star"></label>
                                                        <input type="radio" value="5" name="product_rating"
                                                            id="rating5">
                                                        <label for="rating5" class="fa fa-star"></label>
                                                        @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-8">
                    @foreach ($reviews as $item)
                    <div class="user-review">
                        <label for="">{{$item->user->name.' '.$item->user->lname}}</label>
                        @if ($item->user_id==Auth::id())
                        <a href="{{url('/edit-review/'.$products->slug.'/user-review')}}">Edit</a>
                        @endif
                        <br>
                        @php
                        $rating_review=App\Models\Rating::where('prod_id',$products->id)->where('user_id',$item->user->id)->first();
                        @endphp
                        @if ($rating_review)
                        @php
                        $user_rated=$rating_review->stars_rated;
                        @endphp
                        @for ($i=1;$i<=$user_rated;$i++) <i class="fa fa-star checked"></i>
                            @endfor
                            @for ($j=1;$j<=5-$user_rated;$j++) <i class="fa fa-star"></i>
                                @endfor
                                @endif
                                <small>Reviewed on {{$item->created_at->format('d-M-Y')}}</small>
                                <p>{{$item->user_review}}</p>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>



</script>
@endsection