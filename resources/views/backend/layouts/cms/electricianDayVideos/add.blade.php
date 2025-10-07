@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">Add New Video</h1>
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
                        <form action="{{ route('electrician-day-videos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Title -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                            </div>

                            <!-- Subtitle -->
                            <div class="mb-3">
                                <label for="subtitle" class="form-label">Subtitle</label>
                                <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ old('subtitle') }}">
                            </div>

                            <!-- Video Upload -->
                            <div class="mb-3">
                                <label for="video" class="form-label">Video <span class="text-danger">*</span></label>
                                <input type="file" name="video" id="video" class="form-control" required>
                            </div>

                            <!-- Submit -->
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-upload"></i> Upload Video
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
