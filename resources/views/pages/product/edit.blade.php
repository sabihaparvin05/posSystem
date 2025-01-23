@extends('master')
@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- Success and Error Messages -->
        <div class="col-lg-12">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>

        <!-- Product Name Card -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Product Name</h4>
                    <p class="text-muted m-b-15 f-s-12">Update the product name below.</p>
                    <div class="basic-form">
                        <form method="POST" action="{{ route('products.update', $product->slug) }}">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <input type="text" class="form-control input-default" placeholder="Product Name" name="name" value="{{ old('name', $product->name) }}" required>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description Card -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Description</h4>
                    <p class="text-muted m-b-15 f-s-12">Update the description for the product.</p>
                    <div class="basic-form">
                        <div class="form-group">
                            <textarea class="form-control h-150px" rows="6" placeholder="Enter description" name="description">{{ old('description', $product->description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Card -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Category</h4>
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
                </div>
            </div>
        </div>

        <!-- Price and Quantity Card -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Price and Quantity</h4>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" id="price" name="price" class="form-control" step="0.01" min="1" value="{{ old('price', $product->price) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" value="{{ old('quantity', $product->quantity) }}" required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Information Card -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Additional Information</h4>
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
                </div>
            </div>
        </div>

        <!-- Status Card -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Status</h4>
                    <div class="basic-form">
                        <div class="form-group">
                            <div class="radio mb-3">
                                <label>
                                    <input type="radio" name="status" value="1" {{ old('status', $product->status) == '1' ? 'checked' : '' }}> Active
                                </label>
                            </div>
                            <div class="radio mb-3">
                                <label>
                                    <input type="radio" name="status" value="0" {{ old('status', $product->status) == '0' ? 'checked' : '' }}> Inactive
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body text-center">
                    <button type="submit" class="btn btn-primary">Update Product</button>
                </div>
            </div>
        </div>

        </form> <!-- Closing the form here -->

    </div>
</div>

@endsection
