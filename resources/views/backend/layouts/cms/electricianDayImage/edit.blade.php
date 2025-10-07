@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">Edit Image</h1>
                <a href="{{ route('electricianDay-images.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>

        <section class="content">
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
                        <form action="{{ route('electricianDay-images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3 text-center">
                                <label class="form-label">Current Image</label><br>
                                @if ($image->image)
                                    <img src="{{ asset('storage/' . $image->image) }}" alt="Current Image" class="img-fluid rounded" style="max-height: 250px;">
                                @else
                                    <p class="text-muted">No image uploaded yet.</p>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Select New Image (optional)</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>

                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Update Image
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

