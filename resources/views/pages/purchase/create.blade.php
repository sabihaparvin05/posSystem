@extends('master')
@section('content')

<div class="container">
    <h2>Add Purchase</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('purchase.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="supplier_name">Supplier Name</label>
            <input type="text" id="supplier_name" name="supplier_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="product_id">Select Existing Product</label>
            <select id="product_id" name="product_id" class="form-control">
                <option value="">Select Product (Optional)</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="product_name">New Product Name</label>
            <input type="text" id="product_name" name="product_name" class="form-control" placeholder="Enter new product name if not selecting from above">
        </div>

        <div class="form-group">
            <label for="quantity">Quantity</label>
            <input type="number" id="quantity" name="quantity" class="form-control" min="1" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Purchase</button>
    </form>
</div>

@endsection
