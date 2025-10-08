@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">All Service Categories</h1>
                <a href="{{ route('service-categories.create') }}" class="btn bg-gradient-teal btn-sm">
                    <i class="fas fa-plus"></i> Add New Category
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
{{--                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>--}}
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body table-responsive">
                        @if($categories->isEmpty())
                            <p class="text-center text-muted my-4">No categories found.</p>
                        @else
                            <table class="table table-bordered table-striped align-middle text-center">
                                <thead class="bg-teal text-white">
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="20%">Name</th>
                                    <th width="35%">Description</th>
                                    <th width="20%">Slug</th>
                                    <th width="20%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $key => $category)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><strong>{{ $category->name }}</strong></td>
                                        <td>{{($category->description) }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            <div style="display: flex; justify-content: center; gap: 8px;">
                                                <a href="{{ route('service-categories.edit', $category->id) }}"
                                                   class="btn btn-sm btn-info">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('service-categories.destroy', $category->id) }}"
                                                      method="POST"
                                                      onsubmit="return confirm('Are you sure you want to delete this category?');"
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
