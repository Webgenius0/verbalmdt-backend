@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">Electrician Day Videos</h1>
                <a href="{{ route('electrician-day-videos.create') }}" class="btn bg-gradient-teal btn-sm float-right">
                    <i class="fas fa-plus"></i> Add New Video
                </a>
            </div>
        </div>

        <section class="content mt-3">
            <div class="container-fluid">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        @if($videos->count())
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Video</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($videos as $video)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $video->title }}</td>
                                        <td>{{ $video->subtitle }}</td>
                                        <td>
                                            @if($video->video)
                                                <video width="150" controls>
                                                    <source src="{{ asset('storage/' . $video->video) }}" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td style="display: flex; align-items: center; gap: 10px;">
                                            <a href="{{ route('electrician-day-videos.edit', $video->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('electrician-day-videos.destroy', $video->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Are you sure you want to delete this video?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            <p class="text-center mb-0">No videos found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
