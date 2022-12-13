@extends('layouts.admin')
@section('title')
Orders
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Order Hitory
                        <a href="{{url('/orders')}}" class="btn btn-warning float-right">New Orders </a>
                    </h4>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-bordered">
                        <thead>
                            <tr>
                                <th onclick="sortTable(0)">Order Date</th>
                                <th onclick="sortTable(1)">Tracking Number</th>
                                <th onclick="sortTable(2)">Toltal Price</th>
                                <th onclick="sortTable(3)">Status</th>
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
                                <td><a href="{{url('/admin/view-order/'.$item->id)}}" class="btn btn-primary">View</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-9"></div>
                        <div class="col-md-3">{{ $orders->onEachSide(5)->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection