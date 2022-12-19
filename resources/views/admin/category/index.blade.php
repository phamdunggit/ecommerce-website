@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Category</h4>
        <hr>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2 float-end">
                <form action="{{url('/categories-search')}}" method="post">
                    @csrf
                    <div class="input-group no-border">
                        <input type="text" value="" name="cate_search" class="form-control" placeholder="Search..." required>
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="table">
            @include('admin.category.data')
        </div>
        <input type="hidden" name="hidden_search_input" id="hidden_search_input" value="" />
        <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
        <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="name" />
        <input type="hidden" name="hidden_sort_type" id="hidden_sort_type" value="asc" />
    </div>
</div>
@endsection