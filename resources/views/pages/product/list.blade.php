@extends('master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h4>Product List</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Part Number</th>
                                    <th>Vehicle type</th>
                                    <th>Compatible model</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $index => $product)
                                    <tr>
                                        <th>{{ $index + 1 }}</th> <!-- Fixed: Removed extra `>` -->
                                        <td>{{ $product->name  }}</td> 
                                        <td>{{ $product->description }}</td> 
                                        <td>{{ $product->category->name ?? 'No Category' }}</td>
                                        <td>{{ $product->brand }}</td> 
                                        <td>{{ $product->part_number }}</td> 
                                        <td>{{ $product->vehicle_type }}</td> 
                                        <td>{{ $product->compatible_models }}</td> 
                                        <td>৳{{ number_format($product->price, 2) }}</td>
                                        <td>{{ $product->quantity  }}</td> 
                                        <td>
                                            @if ($product->status)
                                                <span class="badge badge-success px-2">Active</span>
                                            @else
                                                <span class="badge badge-danger px-2">Inactive</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->created_at->format('M d, Y') }}</td> <!-- Created date -->
                                        <td>
                                            <span>
                                                <a href="{{ route('products.edit', $product->id) }}" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-pencil color-muted m-r-5"></i>
                                                </a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure you want to delete this product?');" style="border: none; background: none; color: red;">
                                                        <i class="fa fa-close color-danger"></i>
                                                    </button>
                                                </form>
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach

                                <!-- Display if no products found -->
                                @if ($products->isEmpty())
                                    <tr>
                                        <td colspan="13" class="text-center">No products found.</td>
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
@endsection
