<table id="table" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th class="sorting" data-column_name="name" style="cursor: pointer">Name
            </th>
            <th class="sorting"  data-column_name="description" style="cursor: pointer">
                Description</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($category as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->description }}</td>
            <td><img src="{{ asset('assets/uploads/category/'.$item->image) }}" class="cate-image" alt="Image Here">
            </td>
            <td>
                <a href="{{ url('edit-cate/'.$item->slug) }}" class="btn btn-primary">Edit</a>
                <a href="{{ url('/delete-category/'.$item->slug) }}" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
<div class="row">
    <div class="col-md-9"></div>
    <div class="col-md-3">{{ $category->onEachSide(5)->links() }}</div>
</div>