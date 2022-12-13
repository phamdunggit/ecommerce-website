@extends('layouts.front')
@section('title')
My Orders
@endsection
@section('content')
<div class="py-3 mb-4 shadow-sm bg-warning border-top ">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{url('/')}}">Home</a>
            / <a href="{{url('/my-orders')}}"> My Orders</a>
        </h6>
    </div>
</div>
<div class="container py-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">
                        My order
                        <a href="{{url('/my-orders')}}" class="btn btn-warning text-white float-end">Back</a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 order-details">
                            <h4>Shipping Details</h4>
                            <hr>
                            <label for="">First Name</label>
                            <div class="border ">{{$orders->fname}}</div>
                            <label for="">Last Name</label>
                            <div class="border">{{$orders->lname}}</div>
                            <label for="">Email</label>
                            <div class="border">{{$orders->email}}</div>
                            <label for="">Phone</label>
                            <div class="border">{{$orders->phone}}</div>
                            <label for="">Shipping Address</label>
                            <div class="border">
                                {{$orders->address}},
                                {{$wards->name}},
                                {{$districts->name}},
                                {{$provinces->name}}.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Order Details</h4>
                            <hr>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders->orderitems as $item )
                                    <tr>
                                        <td>{{$item->products->name}}</td>
                                        <td>{{$item->qty}}</td>
                                        <td class="price">{{$item->price}} VNĐ</td>
                                        <td><img width="50px"
                                                src="{{ asset('assets/uploads/product/image/'.$item->products->image) }}"
                                                alt="Product Image"></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h4 class="px-2"><span class="float-end price">Grand Total:{{$orders->total_price}}
                                    VNĐ</span> </h4>
                            <div class="mt-5 px-2">
                                @if ($orders->status=="3")
                                <button disabled="disabled" class="btn btn-danger float-end mt-3">Canceled</button>
                                @else
                                <form action="{{url('/cancel-order/'.$orders->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-danger float-end mt-3">Cancel</button>
                                </form>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection