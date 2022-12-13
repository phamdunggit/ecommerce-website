@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Add Product</h4>
    </div>
    <div class="card-body">
        <form action="{{ url('insert-product') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12 mb-3">
                    <select class="form-select" name="cate_id" aria-label=".form-select-sm example">
                        <option value="" >Select a Category</option>
                        @foreach($category as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                    <p class="error">{{ $errors->first('cate_id') }}</p>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control">
                    <p class="error">{{ $errors->first('name') }}</p>
                </div>
                <div class="col-md-12 mb-3">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                    <p class="error">{{ $errors->first('description') }}</p>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="">Original price</label>
                    <input type="text" name="original_price" class="form-control">
                    <p class="error">{{ $errors->first('original_price') }}</p>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="">Selling Price</label>
                    <input type="text" name="selling_price" class="form-control">
                    <p class="error">{{ $errors->first('selling_price') }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="">Quantity</label>
                    <input type="text" name="qty" class="form-control">
                    <p class="error">{{ $errors->first('qty') }}</p>
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-check-label" for="">Status</label>
                    <input type="checkbox" name="status" class="form-check-input">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-check-label" for="">Hot</label>
                    <input type="checkbox" name="hot" class="form-check-input">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-check-label" for="">Best selling</label>
                    <input type="checkbox" name="best_selling" class="form-check-input">
                </div>
                <div class="col-md-2 mb-3">
                    <label class="form-check-label" for="">New</label>
                    <input type="checkbox" name="new" class="form-check-input">
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-check-label" for="">Image</label>
                    <input type="file" name="image" class="form-control">
                    <p class="error">{{ $errors->first('image') }}</p>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-check-label" for=""  >Image Detail</label>
                    <input type="file" name="image_details[]" multiple class="form-control">
                    @foreach (range(0,count($errors->get('image_details.*'))) as $item)
                        <p class="error">{{$errors->first('image_details.'.$item)}}</p>
                    @endforeach
                    <p class="error">{{$errors->first('image_details')}}</p>
                    {{-- <p class="error">{{count($errors->get('image_details.*'))  }}</p> --}}
                    {{-- @foreach ($errors->get('image_details') as $mess)
                        <p class="error">{{$mess}}</p>
                     @endforeach --}}
                    
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-check-label" for="">Image Banner</label>
                    <input type="file" name="banner" class="form-control">
                    <p class="error">{{ $errors->first('banner') }}</p>
                </div>
                <div class="col-md-12 mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    
                </div>
            </div>
        </form>
    </div>
</div>
@endsection