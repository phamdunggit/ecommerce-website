<table id="table" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="sorting" data-column_name="fname" style="cursor: pointer">Name</th>
            <th class="sorting" data-column_name="email" style="cursor: pointer">Email</th>
            <th class="sorting" data-column_name="phone" style="cursor: pointer">Phone</th>
            <th>Action</th>
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