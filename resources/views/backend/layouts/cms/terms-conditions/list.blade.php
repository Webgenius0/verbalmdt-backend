@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">All Terms & Conditions</h1>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('web-terms.create') }}" class="btn bg-gradient-teal btn-sm float-right">
                            <i class="fa fa-plus text-light"></i> Add New Term
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible col-md-5">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> {{ session('success') }}</h5>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-gradient-teal text-white">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Sub Titles & Descriptions</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($terms as $term)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $term->title }}</td>
                                <td>
                                    @foreach($term->sub_title as $i => $subtitle)
                                        <strong>{{ $subtitle }}</strong><br>
                                        <small>{{ $term->description[$i] ?? '' }}</small>
                                        <hr>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('web-terms.edit', $term->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('web-terms.destroy', $term->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this term?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No terms found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $terms->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
