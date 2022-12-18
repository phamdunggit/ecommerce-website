@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h4>Registered Users</h4>
        <hr>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-10"></div>
            <div class="col-md-2 float-end">
                <form action="{{url('/users-search')}}" method="post">
                    @csrf
                    <div class="input-group no-border">
                        <input type="text" value="" name="user_search" class="form-control"
                            placeholder="Search...">
                        <button type="submit" class="btn btn-white btn-round btn-just-icon">
                            <i class="material-icons">search</i>
                            <div class="ripple-container"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <table id="table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th onclick="sortTable(0)">Name</th>
                    <th onclick="sortTable(1)">Email</th>
                    <th onclick="sortTable(2)">Phone</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $item)
                <tr>
                    <td>{{ $item->fname.' '.$item->lname }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>
                        <a href="{{ url('/view-user/'.$item->id) }}" class="btn btn-primary btn-sm">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-9"></div>
            <div class="col-md-3">{{ $users->onEachSide(5)->links() }}</div>
        </div>
    </div>
</div>
@endsection