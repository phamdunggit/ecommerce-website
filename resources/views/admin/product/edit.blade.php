@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Edit Product</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('update-product/'.$product->slug) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12 mb-3">
                    <select class="form-select" name="cate_id" aria-label=".form-select-sm example">
                        @foreach($category as $item)
                        @if ($item->id==$product->category->id)
                        <option selected value="{{$item->id}}">{{$item->name}}</option>
                        @else
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Name</label>
                    <input type="text" value="{{$product->name}}" name="name" class="form-control">
                    @if ($errors->first('name'))
                    <p> class="error">{{ $errors->first('name') }}</p>
                    @endif
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{$product->description}}</textarea>
                    @if ($errors->first('description'))
                    <p class="error">{{ $errors->first('description') }}</p>
                    @endif
                    
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Original price</label>
                    <input type="text" value="{{$product->original_price}}" name="original_price" class="form-control">
                    @if ($errors->first('original_price'))
                    <p class="error">{{ $errors->first('original_price') }}</p>
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Selling Price</label>
                    <input type="text" value="{{$product->selling_price}}" name="selling_price" class="form-control">
                    @if ($errors->first('selling_price'))
                    <p class="error">{{ $errors->first('selling_price') }}</p>
                    @endif
                </div>
                <div class="col-md-4 mb-3">
                    <label for="">Quantity</label>
                    <input type="text" value="{{$product->qty}}" name="qty" class="form-control">
                    @if ($errors->first('qty'))
                    <p class="error">{{ $errors->first('qty') }}</p>
                    @endif

                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-check-label" for="">Status</label>
                    <input type="checkbox" {{ $product->status ? 'checked':'' }} name="status" class="form-check-input">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-check-label" for="">Hot</label>
                    <input type="checkbox" {{ $product->producttype->hot ? 'checked':'' }} name="hot"
                    class="form-check-input">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-check-label" for="">Best selling</label>
                    <input type="checkbox" {{ $product->producttype->best_selling ? 'checked':'' }} name="best_selling"
                    class="form-check-input">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-check-label" for="">New</label>
                    <input type="checkbox" {{ $product->producttype->new ? 'checked':'' }} name="new"
                    class="form-check-input">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-check-label" for="">Image</label>
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-check-label" for="">Image Detail</label>
                    <input type="file" name="image_details[]" multiple class="form-control">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-check-label" for="">Image Banner</label>
                    <input type="file" name="banner" class="form-control">
                </div>
                @if( $product->image )
                <div class="col-md-4">
                    <img src="{{ asset('assets/uploads/product/image/'.$product->image) }}" class="cate-image"
                        alt="Product Image Here">
                </div>
                @endif
                @if( $product->productimage )
                <div class="col-md-4">
                    @foreach ($product->productimage as $item)
                    <img src="{{ asset('assets/uploads/product/image_detail/'.$item->images) }}" class="cate-image"
                        alt="Product Image Here">
                    @endforeach
                </div>
                @endif
                @if( $product->banner->banners )
                <div class="col-md-4">
                    <img src="{{ asset('assets/uploads/product/banner/'.$product->banner->banners) }}"
                        class="cate-image" alt="Product Image Here">
                </div>
                @endif
                <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection