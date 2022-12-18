@extends('layouts.admin')
@section('title')
Orders
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2 float-end">
                        <form action="{{url('/orders-search')}}" method="post">
                            @csrf
                            <div class="input-group no-border">
                                <input type="text" value="" name="order_search" class="form-control"
                                    placeholder="Search...">
                                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="table">
                    @include('admin.orders.data')
                </div>
                <input type="hidden" name="hidden_search_input" id="hidden_search_input" value="" />
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="created_at" />
                <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
            </div>
        </div>
    </div>
</div>
@endsection