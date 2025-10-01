{{--@extends('backend.partials.master')--}}

{{--@section('content')--}}
{{--    <div class="content-wrapper">--}}
{{--        <div class="content-header">--}}
{{--            <div class="container-fluid">--}}
{{--                <h1 class="m-0">Upload Contact Image</h1>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="card">--}}
{{--            <div class="card-body">--}}
{{--                <form action="{{ route('web-contact-images.store') }}" method="POST" enctype="multipart/form-data">--}}
{{--                    @csrf--}}
{{--                    <div class="form-group col-md-6">--}}
{{--                        <label for="image">Select Image</label>--}}
{{--                        <input type="file" name="image" class="form-control" required>--}}
{{--                    </div>--}}
{{--                    <button type="submit" class="btn btn-success mt-3">Upload</button>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">

        {{-- Page Header --}}
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="m-0">Contact Images</h1>
            </div>
        </div>

        {{-- Upload Form --}}
        <div class="card mb-4">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible col-md-5">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> {{ session('success') }}</h5>
                    </div>
                @endif

                <form action="{{ route('web-contact-images.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-6">
                        <label for="image">Select Image</label>
                        <input type="file" name="image" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Upload</button>
                </form>
            </div>
        </div>

        {{-- Image List --}}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @forelse($contactImages as $img)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="{{ asset('storage/'.$img->image) }}" class="card-img-top" alt="Contact Image">
                                <div class="card-body text-center">
                                    <form action="{{ route('web-contact-images.destroy', $img->id) }}" method="POST" onsubmit="return confirm('Delete this image?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>No contact images found</p>
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                {{ $contactImages->links('pagination::bootstrap-5') }}
            </div>
        </div>

    </div>
@endsection

