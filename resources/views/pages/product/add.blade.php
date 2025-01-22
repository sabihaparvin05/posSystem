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
                    <h4 class="card-title">Product Name</h4>
                    <p class="text-muted m-b-15 f-s-12">Enter the product name below.</p>
                    <div class="basic-form">
                        <form method="POST" action="{{ route('products.store') }}">
                            @csrf <!-- CSRF Protection -->
                            <div class="form-group">
                                <input type="text" class="form-control input-default" placeholder="Product Name" name="name" value="{{ old('name') }}" required>
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
                    <p class="text-muted m-b-15 f-s-12">Provide a description for the product.</p>
                    <div class="basic-form">
                        <div class="form-group">
                            <textarea class="form-control h-150px" rows="6" placeholder="Enter description" name="description">{{ old('description') }}</textarea>
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
                    <p class="text-muted m-b-15 f-s-12">Select the category for the product.</p>
                    <div class="basic-form">
                        <div class="form-group">
                            <select class="form-control" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Price and Quantity Card -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Price and Quantity</h4>
                    <p class="text-muted m-b-15 f-s-12">Enter the price and quantity for the product.</p>
                    <div class="basic-form">
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ old('price') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Quantity:</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Optional Fields Card -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Optional Fields</h4>
                    <p class="text-muted m-b-15 f-s-12">Enter additional details about the product (optional).</p>
                    <div class="basic-form">
                        <div class="form-group">
                            <label for="brand">Brand:</label>
                            <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand') }}">
                        </div>
                        <div class="form-group">
                            <label for="part_number">Part Number:</label>
                            <input type="text" class="form-control" id="part_number" name="part_number" value="{{ old('part_number') }}">
                        </div>
                        <div class="form-group">
                            <label for="vehicle_type">Vehicle Type:</label>
                            <input type="text" class="form-control" id="vehicle_type" name="vehicle_type" value="{{ old('vehicle_type') }}">
                        </div>
                        <div class="form-group">
                            <label for="compatible_models">Compatible Models:</label>
                            <input type="text" class="form-control" id="compatible_models" name="compatible_models" value="{{ old('compatible_models') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Status Card -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Status</h4>
                    <p class="text-muted m-b-15 f-s-12">Select the status of the product.</p>
                    <div class="basic-form">
                        <div class="form-group">
                            <div class="radio mb-3">
                                <label>
                                    <input type="radio" name="status" value="1" {{ old('status', '1') == '1' ? 'checked' : '' }}> Active
                                </label>
                            </div>
                            <div class="radio mb-3">
                                <label>
                                    <input type="radio" name="status" value="0" {{ old('status') == '0' ? 'checked' : '' }}> Inactive
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
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </div>
            </div>
        </div>
        </form> <!-- Closing the form here -->
    </div>
</div>

@endsection
