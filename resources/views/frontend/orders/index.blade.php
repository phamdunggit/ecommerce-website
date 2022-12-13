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
<div class="container py-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>My Orders</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Order Date</th>
                                <th>Tracking Number</th>
                                <th>Toltal Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item )
                            <tr>
                                <td>{{ date('d-m-Y',strtotime($item->created_at)) }}</td>
                                <td>{{$item->tracking_no}}</td>
                                <td>{{$item->total_price}}</td>
                                <td>
                                    @if ($item->status==1)
                                        Pomplete
                                    @elseif ($item->status==0) 
                                        Pending
                                    @else
                                        Cancel
                                    @endif
                                </td>
                                <td><a href="{{url('/view-order/'.$item->id)}}" class="btn btn-primary">View</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection