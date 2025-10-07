@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">All Uploaded Images</h1>
                <a href="{{ route('electricianDay-images.create') }}" class="btn bg-gradient-teal btn-sm float-right">
                    <i class="fas fa-plus"></i> Add New Image
                </a>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card shadow">
                    <div class="card-body">
                        @if ($images->isEmpty())
                            <p class="text-center text-muted my-4">No images found.</p>
                        @else
                            <div class="row">
                                @foreach ($images as $image)
                                    <div class="col-md-3 mb-4">
                                        <div class="card border-0 shadow-sm">
                                            <img src="{{ asset('storage/' . $image->image) }}" class="card-img-top rounded" alt="Uploaded Image" style="height: 200px; object-fit: cover;">
                                            <div class="card-body text-center">
                                                <a href="{{ route('electricianDay-images.edit', $image->id) }}" class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('electricianDay-images.destroy', $image->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this image?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
