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

        <!-- Category Name Card -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Category Name</h4>
                    <p class="text-muted m-b-15 f-s-12">Update the category name below.</p>
                    <div class="basic-form">
                        <form method="POST" action="{{ route('categories.update', $category->slug) }}">
                            @csrf <!-- CSRF Protection -->
                            @method('POST') <!-- Specify POST for the update action -->
                            <div class="form-group">
                                <input type="text" class="form-control input-default" placeholder="Category Name" name="name" value="{{ old('name', $category->name) }}" required>
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
                    <p class="text-muted m-b-15 f-s-12">Update the description for the category.</p>
                    <div class="basic-form">
                        <div class="form-group">
                            <textarea class="form-control h-150px" rows="6" placeholder="Enter description" name="description">{{ old('description', $category->description) }}</textarea>
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
                    <p class="text-muted m-b-15 f-s-12">Update the status of the category.</p>
                    <div class="basic-form">
                        <div class="form-group">
                            <div class="radio mb-3">
                                <label>
                                    <input type="radio" name="status" value="1" {{ old('status', $category->status) == '1' ? 'checked' : '' }}> Active
                                </label>
                            </div>
                            <div class="radio mb-3">
                                <label>
                                    <input type="radio" name="status" value="0" {{ old('status', $category->status) == '0' ? 'checked' : '' }}> Inactive
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
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
            </div>
        </div>
        </form> <!-- Closing the form here -->
    </div>
</div>

@endsection
