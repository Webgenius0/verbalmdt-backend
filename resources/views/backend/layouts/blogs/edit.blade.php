@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="col-md-8 py-5 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">
                    Edit Blog
                </div>
                <div class="card-body">

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="form-group">
                            <label>Title <i class="text-danger">*</i></label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ old('title', $blog->title) }}" required>
                        </div>

                        {{-- Image --}}
                        <div class="form-group">
                            <label>Blog Image</label>
                            <input type="file" name="image" class="form-control">
                            @if($blog->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/'.$blog->image) }}"
                                         alt="Blog Image"
                                         style="width:120px; height:90px; object-fit:cover; border-radius:4px;">
                                </div>
                            @endif
                        </div>

                        {{-- Description --}}
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" rows="5" class="form-control" placeholder="Write blog description...">{{ old('description', $blog->description) }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Update Blog</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
