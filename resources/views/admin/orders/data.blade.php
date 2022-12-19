<table id="table" class="table table-bordered">
    <thead>
        <tr>
            <th class="sorting"  data-column_name="created_at" style="cursor: pointer">Order Date</th>
            <th class="sorting" data-column_name="fname" style="cursor: pointer">Name</th>
            <th class="sorting" data-column_name="email" style="cursor: pointer">Email</th>
            <th class="sorting" data-column_name="phone" style="cursor: pointer">Phone</th>
            <th class="sorting"  data-column_name="tracking_no" style="cursor: pointer">Tracking Number</th>
            <th class="sorting"  data-column_name="total_price" style="cursor: pointer">Toltal Price</th>
            <th>
                @if ($status)
                <select class="form-select" id="status">
                    @if ($status==1)
                    <option value="1" selected>Pending</option>
                    <option value="2">Completed</option>
                    <option value="3">Canceled</option>
                    @elseif ($status==2)
                    <option value="1">Pending</option>
                    <option value="2" selected>Completed</option>
                    <option value="3">Canceled</option>
                    @else
                    <option value="1">Pending</option>
                    <option value="2">Completed</option>
                    <option value="3" selected>Canceled</option>
                    @endif
                  </select>
                @else
                <select class="form-select" id="status">
                    <option selected>Status</option>
                    <option value="1">Pending</option>
                    <option value="2">Completed</option>
                    <option value="3">Canceled</option>
                  </select>
                @endif
            </th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $item )
        <tr>
            <td>{{ date('d-m-Y',strtotime($item->created_at)) }}</td>
            <td>{{ $item->fname.' '.$item->lname }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->phone }}</td>
            <td>{{$item->tracking_no}}</td>
            <td>{{$item->total_price}}</td>
            <td>
                @if ($item->status==2)
                <button type="button" class="btn btn-success">Complete</button>
                
                @elseif ($item->status==1)
                <button type="button" class="btn btn-primary">Pending</button>
                @else
                <button type="button" class="btn btn-danger">Canceled</button>
                @endif
            </td>
            <td><a href="{{url('/admin/view-order/'.$item->id)}}" class="btn btn-primary">View</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-md-9"></div>
    <div class="col-md-3">{{ $orders->onEachSide(5)->links() }}</div>
</div>