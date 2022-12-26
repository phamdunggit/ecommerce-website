@foreach( $products as $prod)
<div class="col-md-3 mb-3">
    <div class="card">
        <a href="{{url('/category/'.$category->slug.'/'.$prod->slug)}}">
            <img class="product-image" src="{{ asset('assets/uploads/product/image/'.$prod->image) }}"
                alt="Product Image">
            <div class="card-body">
                <h5>{{ $prod->name }}</h5>
                <div class="price-wrapper clearfix">
                    <span class="selling_price float-end price" style="color: red">{{ $prod->selling_price }} VNĐ</span>
                </div>
                <span class="fw-lighter" >Đã bán:{{$prod->sold}}</span>
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