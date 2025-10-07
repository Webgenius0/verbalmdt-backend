
{{--@extends('backend.partials.master')--}}

{{--@section('content')--}}
{{--    <div class="content-wrapper">--}}
{{--        <!-- Header -->--}}
{{--        <div class="content-header">--}}
{{--            <div class="container-fluid">--}}
{{--                <div class="row mb-2">--}}
{{--                    <div class="col-sm-6"><h1 class="m-0">All Global Multimedia</h1></div>--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <a href="{{ route('global-multimedia.create') }}" class="btn bg-gradient-success btn-sm float-right">--}}
{{--                            <i class="fa fa-plus text-light"></i> Add New Multimedia--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Card -->--}}
{{--        <div class="card">--}}
{{--            <div class="card-body">--}}

{{--                <!-- Success Message -->--}}
{{--                @if(session('success'))--}}
{{--                    <div class="alert alert-success alert-dismissible col-md-6">--}}
{{--                        <button type="button" class="close" data-dismiss="alert">&times;</button>--}}
{{--                        {{ session('success') }}--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                <!-- Year Filter -->--}}
{{--                <form method="GET" action="{{ route('global-multimedia.index') }}" class="mb-4">--}}
{{--                    <div class="row g-2 align-items-center">--}}
{{--                        <div class="col-auto">--}}
{{--                            <input type="number" name="year" value="{{ request('year') }}" class="form-control" placeholder="Enter year">--}}
{{--                        </div>--}}
{{--                        <div class="col-auto">--}}
{{--                            <button type="submit" class="btn btn-primary">Filter</button>--}}
{{--                            <a href="{{ route('global-multimedia.index') }}" class="btn btn-secondary">Reset</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}

{{--                <!-- Table -->--}}
{{--                <div class="table-responsive">--}}
{{--                    <table class="table table-bordered table-striped">--}}
{{--                        <thead class="bg-gradient-success text-white">--}}
{{--                        <tr>--}}
{{--                            <th>#</th>--}}
{{--                            <th>Year</th>--}}
{{--                            <th>Images</th>--}}
{{--                            <th>Videos</th>--}}
{{--                            <th class="text-center">Actions</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @forelse($items as $item)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $loop->iteration }}</td>--}}
{{--                                <td>{{ $item->year }}</td>--}}
{{--                                <td>--}}
{{--                                    @if($item->images)--}}
{{--                                        @foreach($item->images as $image)--}}
{{--                                            <a href="{{ asset('storage/'.$image) }}" target="_blank">--}}
{{--                                                <img src="{{ asset('storage/'.$image) }}" alt="Image" style="width:50px;height:50px;object-fit:cover;margin-right:5px;margin-bottom:5px;">--}}
{{--                                            </a>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    @if($item->videos)--}}
{{--                                        @foreach($item->videos as $video)--}}
{{--                                            <video width="200" height="120" controls style="margin-bottom:5px; margin-right:5px;">--}}
{{--                                                <source src="{{ asset('storage/'.$video) }}" type="video/mp4">--}}
{{--                                                Your browser does not support the video tag.--}}
{{--                                            </video>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td class="text-center">--}}
{{--                                    <a href="{{ route('global-multimedia.edit', $item->id) }}" class="btn btn-info btn-sm mb-1">--}}
{{--                                        <i class="fa fa-edit"></i>--}}
{{--                                    </a>--}}
{{--                                    <form action="{{ route('global-multimedia.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">--}}
{{--                                        @csrf--}}
{{--                                        @method('DELETE')--}}
{{--                                        <button type="submit" class="btn btn-danger btn-sm">--}}
{{--                                            <i class="fas fa-trash-alt"></i>--}}
{{--                                        </button>--}}
{{--                                    </form>--}}

{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @empty--}}
{{--                            <tr>--}}
{{--                                <td colspan="5" class="text-center">No multimedia found</td>--}}
{{--                            </tr>--}}
{{--                        @endforelse--}}
{{--                        </tbody>--}}
{{--                    </table>--}}

{{--                    <!-- Pagination -->--}}
{{--                    @if($items instanceof \Illuminate\Pagination\LengthAwarePaginator)--}}
{{--                        <div class="mt-3">--}}
{{--                            {{ $items->links('pagination::bootstrap-5') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}


@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6"><h1 class="m-0">All Global Multimedia</h1></div>
                    <div class="col-sm-6">
                        <a href="{{ route('global-multimedia.create') }}" class="btn bg-gradient-success btn-sm float-right">
                            <i class="fa fa-plus text-light"></i> Add New Multimedia
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card -->
        <div class="card">
            <div class="card-body">

                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible col-md-6">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Year Filter -->
                <form method="GET" action="{{ route('global-multimedia.index') }}" class="mb-4">
                    <div class="row g-2 align-items-center">
                        <div class="col-auto">
                            <input type="number" name="year" value="{{ request('year') }}" class="form-control" placeholder="Enter year">
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('global-multimedia.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-gradient-success text-white">
                        <tr>
                            <th>#</th>
                            <th>Year</th>
                            <th>Images</th>
                            <th>Videos</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($items as $item)
                            <tr>
                                <td>{{ $loop->iteration + ($items->currentPage()-1) * $items->perPage() }}</td>
                                <td>{{ $item->year }}</td>
                                <td>
                                    @if(!empty($item->images))
                                        @foreach($item->images as $image)
                                            <a href="{{ asset('storage/'.$image) }}" target="_blank">
                                                <img src="{{ asset('storage/'.$image) }}"
                                                     alt="Image"
                                                     style="width:50px; height:50px; object-fit:cover; margin:2px;">
                                            </a>
                                        @endforeach
                                    @else
                                        <span class="text-muted">No images</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($item->videos))
                                        @foreach($item->videos as $video)
                                            <video width="200" height="120" controls style="margin:2px;">
                                                <source src="{{ asset('storage/'.$video) }}" type="video/mp4">
                                                Your browser does not support the video tag.
                                            </video>
                                        @endforeach
                                    @else
                                        <span class="text-muted">No videos</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('global-multimedia.edit', $item->id) }}" class="btn btn-info btn-sm mb-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('global-multimedia.destroy', $item->id) }}"
                                          method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
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
                                <td colspan="5" class="text-center text-muted">No multimedia found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    @if($items instanceof \Illuminate\Pagination\LengthAwarePaginator)
                        <div class="mt-3">
                            {{ $items->appends(request()->input())->links('pagination::bootstrap-5') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
