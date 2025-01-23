@extends('master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Category List</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $index => $data)
                                    <tr>
                                        <th>{{ $index + 1 }}</th> <!-- Display index -->
                                        <td>{{ $data->name }}</td> <!-- Category name -->
                                        <td>{{ $data->description }}</td> <!-- Description -->
                                        <td>
                                            @if ($data->status)
                                                <span class="badge badge-success px-2">Active</span>
                                            @else
                                                <span class="badge badge-danger px-2">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $data->created_at->format('M d, Y') }}</td> <!-- Created date -->
                                        <td>
                                            <span>
                                                <a href="{{ route('categories.edit',$data->slug) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-pencil color-muted m-r-5"></i>
                                                </a>
                                                <form action="{{ route('categories.destroy', $data->slug) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure you want to delete this category?');" style="border: none; background: none; color: red;">
                                                        <i class="fa fa-close color-danger"></i>
                                                    </button>
                                                </form>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach

                                <!-- Display if no categories found -->
                                @if ($categories->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-center">No categories found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /# column -->
    </div>
</div>

<!-- #/ container -->
</div>
@endsection