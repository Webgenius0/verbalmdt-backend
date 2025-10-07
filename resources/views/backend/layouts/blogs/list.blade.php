


@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">All Blogs</h1>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('blogs.create') }}" class="btn bg-gradient-teal btn-sm float-right">
                            <i class="fa fa-plus text-light"></i> Add New Blog
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card Section --}}
        <div class="container-fluid">
            <div class="row">
                @forelse($blogs as $blog)
                    <div class="col-md-4 col-sm-6 mb-4">
                        <div class="card h-100 shadow-sm">
                            {{-- Blog Image --}}
                            @if($blog->image)
                                <img src="{{ asset('storage/'.$blog->image) }}"
                                     class="card-img-top"
                                     style="height:200px; object-fit:cover; border-radius:4px 4px 0 0;"
                                     alt="Blog Image">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light"
                                     style="height:200px; border-radius:4px 4px 0 0;">
                                    <span class="text-muted">No Image</span>
                                </div>
                            @endif

                            <div class="card-body d-flex flex-column">
                                {{-- Title --}}
                                <h5 class="card-title text-truncate">{{ $blog->title }}</h5>

                                {{-- Description --}}
                                <p class="card-text">
                                    {{ Str::limit($blog->description, 100) }}
                                </p>

                                {{-- Actions --}}
                                <div class="mt-auto text-center">
                                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="alert alert-info">No blogs found</div>
                    </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $blogs->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
