

@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">All Posts</h1>
                <a href="{{ route('electricianDay-posts.create') }}" class="btn bg-gradient-teal btn-sm">
                    <i class="fas fa-plus"></i> Add New Post
                </a>
            </div>
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Success message -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body table-responsive">
                        @if($posts->isEmpty())
                            <p class="text-center text-muted my-4">No posts found.</p>
                        @else
                            <table class="table table-bordered table-striped align-middle text-center">
                                <thead class="bg-teal text-white">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="20%">Title</th>
                                    <th width="35%">Description</th>
                                    <th width="25%">Image</th>
                                    <th width="15%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $key => $post)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><strong>{{ $post->title }}</strong></td>
                                        <td>{{ Str::limit($post->description, 80) }}</td>
                                        <td>
                                            @if($post->image)
                                                <img src="{{ asset('storage/' . $post->image) }}"
                                                     alt="{{ $post->title }}"
                                                     style="width: 100px; height: 70px; object-fit: cover; border-radius: 5px;">
                                            @else
                                                <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div style="display: flex; justify-content: center; gap: 8px;">
                                                <a href="{{ route('electricianDay-posts.edit', $post->id) }}"
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('electricianDay-posts.destroy', $post->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this post?');"
                                                      style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
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
