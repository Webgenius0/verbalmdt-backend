@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">Edit Video</h1>
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
                        <form action="{{ route('electrician-day-videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Title -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $video->title) }}" required>
                            </div>

                            <!-- Subtitle -->
                            <div class="mb-3">
                                <label for="subtitle" class="form-label">Subtitle</label>
                                <input type="text" name="subtitle" id="subtitle" class="form-control" value="{{ old('subtitle', $video->subtitle) }}">
                            </div>

                            <!-- Current Video Preview -->
                            @if($video->video)
                                <div class="mb-3">
                                    <label class="form-label">Current Video</label>
                                    <div>
                                        <video width="250" controls>
                                            <source src="{{ asset('storage/' . $video->video) }}" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                    </div>
                                </div>
                            @endif

                            <!-- Upload New Video -->
                            <div class="mb-3">
                                <label for="video" class="form-label">Change Video</label>
                                <input type="file" name="video" id="video" class="form-control">
                            </div>

                            <!-- Submit -->
                            <div class="mb-3 text-center">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Video
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
