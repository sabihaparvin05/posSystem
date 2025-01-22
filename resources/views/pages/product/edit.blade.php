@extends('master')
@section('content')

<div class="container-fluid">
    <h1>Edit Product</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->slug) }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="form-group">
            <label for="slug">Slug (optional):</label>
            <input type="text" id="slug" name="slug" class="form-control" value="{{ old('slug', $product->slug) }}">
        </div>

        <div class="form-group">
            <label for="category_id">Category:</label>
            <select id="category_id" name="category_id" class="form-control" required>
                <option value="">Select a Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" required>
        </div>

        <div class="form-group">
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" class="form-control" value="{{ old('brand', $product->brand) }}">
        </div>

        <div class="form-group">
            <label for="part_number">Part Number:</label>
            <input type="text" id="part_number" name="part_number" class="form-control" value="{{ old('part_number', $product->part_number) }}">
        </div>

        <div class="form-group">
            <label for="vehicle_type">Vehicle Type:</label>
            <input type="text" id="vehicle_type" name="vehicle_type" class="form-control" value="{{ old('vehicle_type', $product->vehicle_type) }}">
        </div>

        <div class="form-group">
            <label for="compatible_models">Compatible Models:</label>
            <input type="text" id="compatible_models" name="compatible_models" class="form-control" value="{{ old('compatible_models', $product->compatible_models) }}">
        </div>

        <div class="form-group">
            <label>Status:</label>
            <div>
                <label>
                    <input type="radio" name="status" value="1" {{ old('status', $product->status) == '1' ? 'checked' : '' }}> Active
                </label>
                <label>
                    <input type="radio" name="status" value="0" {{ old('status', $product->status) == '0' ? 'checked' : '' }}> Inactive
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>

@endsection
