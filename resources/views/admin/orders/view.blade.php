@extends('layouts.admin')
@section('title')
My Orders
@endsection
@section('content')

<div class="container py-2">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">
                        Order Deltail
                        <a href="{{url('/orders')}}" class="btn btn-warning text-white float-right">Back</a>
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
                                        <td class="price">{{$item->price}}</td>
                                        <td><img width="50px"
                                                src="{{ asset('assets/uploads/product/image/'.$item->products->image) }}"
                                                alt="Product Image"></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <h4 class="px-2"><span class="float-end price">Grand Total:{{$orders->total_price}}</span> </h4>
                            <div class="clearfix"></div>
                            <div class="mt-3 px-2">
                                @if ($orders->status=='3')
                                    <button disabled="disabled" class="btn btn-danger float-right">Canceled</button>
                                @else
                                <label for="">Order Status</label>
                                <form action="{{url('/update-order/'.$orders->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    
                                    <select class="form-select" name="order-status" aria-label="Default select example">
                                        <option {{$orders->status=='1'?'selected ':''}} value="1">Pending</option>
                                        <option {{$orders->status=='2'?'selected ':''}}value="2">Completed</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary float-right mt-3">Update</button>
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