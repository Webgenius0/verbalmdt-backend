@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">Edit Service Subcategory</h1>
                <a href="{{ route('service-subcategories.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <!-- Validation Errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Edit Form -->
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('service-subcategories.update', $serviceSubcategory->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Category -->
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ $serviceSubcategory->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Subcategory Name</label>
                                <input type="text" name="name" id="name" class="form-control"
                                       value="{{ old('name', $serviceSubcategory->name) }}" placeholder="Enter subcategory name">
                            </div>

                            <!-- Slug -->
                            <div class="mb-3">
                                <label for="slug" class="form-label">Slug</label>
                                <input type="text" name="slug" id="slug" class="form-control"
                                       value="{{ old('slug', $serviceSubcategory->slug) }}" placeholder="Enter slug">
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4"
                                          placeholder="Enter description">{{ old('description', $serviceSubcategory->description) }}</textarea>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary">Update Subcategory</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
