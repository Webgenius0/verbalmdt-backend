@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">Edit Banner</h1>
                <a href="{{ route('electrician-day-banners.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>

        <section class="content mt-3">
            <div class="container-fluid">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('electrician-day-banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Title -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $banner->title) }}" required>
                            </div>

                            <!-- Subtitle -->
                            <div class="mb-3">
                                <label for="subtitle" class="form-label">Subtitle</label>
                                <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ old('subtitle', $banner->subtitle) }}">
                            </div>

                            <!-- Current Image Preview -->
                            @if($banner->image)
                                <div class="mb-3">
                                    <label class="form-label">Current Image</label>
                                    <div>
                                        <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" style="height: 150px; object-fit: cover;">
                                    </div>
                                </div>
                            @endif

                            <!-- Upload New Image -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Change Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>

                            <!-- Submit -->
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Banner
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
