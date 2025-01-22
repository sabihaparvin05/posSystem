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
                    <h4 class="card-title">Category Name</h4>
                    <p class="text-muted m-b-15 f-s-12">Enter the category name below.</p>
                    <div class="basic-form">
                        <form method="POST" action="{{ route('categories.store') }}">
                            @csrf <!-- CSRF Protection -->
                            <div class="form-group">
                                <input type="text" class="form-control input-default" placeholder="Category Name" name="name" value="{{ old('name') }}" required>
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
                    <p class="text-muted m-b-15 f-s-12">Provide a description for the category.</p>
                    <div class="basic-form">
                        <div class="form-group">
                            <textarea class="form-control h-150px" rows="6" placeholder="Enter description" name="description">{{ old('description') }}</textarea>
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
                    <p class="text-muted m-b-15 f-s-12">Select the status of the category.</p>
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
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </div>
            </div>
        </div>
        </form> <!-- Closing the form here -->
    </div>
</div>

@endsection
