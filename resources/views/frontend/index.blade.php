@extends('layouts.front')
@section('title')
Ecom
@endsection
@section('content')
@include('layouts.includes.slider')
<div class="py-5">
    <div class="container">
        <div class="row">
            <h2>Trending Category</h2>
            <div class="owl-carousel featured-carousel owl-theme">
                @foreach( $trending_category as $cate)
                <a href="{{  url('/category/'.$cate->slug) }}">
                    <div class="item">
                        <div class="card">
                            <img class="product-image" src="{{ asset('assets/uploads/category/'.$cate->image) }}"
                                alt="Category Image">
                            <div class="card-body">
                                <h5>{{ $cate->name }}</h5>
                            </div>
                        </div>

                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
<div class="py-3">
    <div class="container">
        <div class="row">
            <h2>Featured Products</h2>
            <div class="owl-carousel popular-carousel owl-theme">
                @foreach( $featured_products as $prod)
                <a href="{{url('/category/'.$prod->product->category->slug.'/'.$prod->product->slug)}}">
                    <div class="item">
                        <div class="card">
                            <img class="product-image" src="{{ asset('assets/uploads/product/image/'.$prod->product->image) }}"
                                alt="Product Image">
                            <div class="card-body">
                                <h5>{{ $prod->product->name }}</h5>
                                <div class="">
                                    {{-- <span class="float-start"></span> --}}
                                    <span class="float-end">{{ $prod->product->selling_price }}VNĐ&ensp;<s>{{ $prod->product->original_price }}</s>VNĐ</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

        </div>
    </div>
</div>


@endsection
@section('scripts')
<script>
    $('.featured-carousel').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    })
    $('.popular-carousel').owlCarousel({
        loop: false,
        margin: 10,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    })
</script>
@endsection