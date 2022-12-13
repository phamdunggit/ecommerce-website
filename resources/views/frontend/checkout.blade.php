@extends('layouts.front')
@section('title')
Checkout
@endsection
@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top ">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}">Home</a>
            / <a href="{{url('/checkout')}}"> Checkout</a>
        </h6>
    </div>
</div>
<div class="container mt-3">
    <form action="{{url('/place-order')}}" method="POST">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6>Basic detail</h6>
                        <hr>
                        <div class="row checkout-form">
                            <div class="col-md-6 mt-3">
                                <label for="">First Name</label>
                                <input type="text" name="fname" value="{{Auth::user()->fname}}" class="form-control"
                                    placeholder="Enter First Name">
                                    <p class="error">{{ $errors->first('fname') }}</p>
                                    
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Last Name</label>
                                <input type="text" name="lname" value="{{Auth::user()->lname}}" class="form-control"
                                    placeholder="Enter Last Name">
                                    <p class="error">{{ $errors->first('lname') }}</p>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Email</label>
                                <input type="text" name="email" value="{{Auth::user()->email}}" class="form-control"
                                    disabled>
                                    <p class="error">{{ $errors->first('email') }}</p>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Phone Number</label>
                                <input type="text" name="phone" value="{{Auth::user()->phone}}" class="form-control"
                                    placeholder="Enter Phone Number">
                                    <p class="error">{{ $errors->first('phone') }}</p>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="">House Number, Street Name</label>
                                <input type="text" name="address" value="{{Auth::user()->address}}"
                                    class="form-control" placeholder="House Number, Street Name">
                                    <p class="error">{{ $errors->first('address') }}</p>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Province</label>
                                <select class="form-select" name="province" id="province" aria-label="Default select example">
                                    @if (Auth::user()->province_id)
                                        @foreach ($provinces as $item)
                                            @if (Auth::user()->province_id==$item->id)
                                                <option selected value="{{$item->id}}">{{$item->name}}</option>
                                            @else
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option disable value="">Select province</option>
                                        @foreach ($provinces as $item)
                                        
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <p class="error">{{ $errors->first('province') }}</p>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">District</label>
                                
                                <select class="form-select" name="district" id="district" aria-label="Default select example">
                                    @if (Auth::user()->district_id)
                                        @foreach ($districts as $item)
                                            @if (Auth::user()->district_id==$item->id)
                                                <option selected value="{{$item->id}}">{{$item->name}}</option>
                                            @else
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                <p class="error">{{ $errors->first('district') }}</p>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">Ward</label>
                                <select class="form-select" name="ward" id="ward" aria-label="Default select example">
                                    @if (Auth::user()->ward_id)
                                        @foreach ($wards as $item)
                                            @if (Auth::user()->ward_id==$item->id)
                                                <option selected value="{{$item->id}}">{{$item->name}}</option>
                                            @else
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
                                <p class="error">{{ $errors->first('ward') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    @if(Count($cartitems->products)>0)
                    <div class="card-body">
                        <h6>Order Deltai</h6>
                        <hr>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $total=0 @endphp
                                @foreach($cartitems->products as $item)
                                @php $total+=$item["qty"]*$item["productinfo"]->selling_price; @endphp
                                <tr>
                                    <td>{{$item["productinfo"]->name}}</td>
                                    <td>{{$item["productinfo"]->qty}}</td>
                                    <td class="price">{{$item["productinfo"]->selling_price}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <h6 class="float-end mt-3 mb-3 price">Toltal price {{$total}}</h6>
                        <button type="submit" class="btn btn-primary float-end w-100">Place Order</button>
                    </div>
                    @else

                    <div class="card-body text-center">
                        <h6>Order Deltai</h6>
                        <hr>
                        <h2>No products in cart </h2>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
</div>
@endsection