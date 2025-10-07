@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">Edit Post</h1>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
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

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('electricianDay-posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4">{{ old('description', $post->description) }}</textarea>
                            </div>

                            <div class="mb-3 text-center">
                                <label class="form-label">Current Image</label><br>
                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" class="img-fluid rounded" style="max-height: 250px;">
                                @else
                                    <p class="text-muted">No image uploaded yet.</p>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Replace Image (optional)</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Update Post
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
