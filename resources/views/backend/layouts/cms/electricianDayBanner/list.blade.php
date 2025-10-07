@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">Electrician Day Banners</h1>
                <a href="{{ route('electrician-day-banners.create') }}" class="btn bg-gradient-teal btn-sm float-right">
                    <i class="fas fa-plus"></i> Add New Banner
                </a>
            </div>
        </div>

        <section class="content mt-3">
            <div class="container-fluid">

                <!-- Success message -->
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        @if($banners->isEmpty())
                            <div class="alert alert-info text-center">
                                No banners found. <a href="{{ route('electrician-day-banners.create') }}">Add a new banner</a>
                            </div>
                        @else
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>Subtitle</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($banners as $banner)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($banner->image)
                                                <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" style="height: 60px; width: auto;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>{{ $banner->title }}</td>
                                        <td>{{ $banner->subtitle }}</td>
                                        <td style="display: flex; align-items: center; gap: 10px;">
                                            <a href="{{ route('electrician-day-banners.edit', $banner->id) }}" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('electrician-day-banners.destroy', $banner->id) }}" method="POST" style="margin: 0;" onsubmit="return confirm('Are you sure you want to delete this banner?');">
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
                        @endif
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
