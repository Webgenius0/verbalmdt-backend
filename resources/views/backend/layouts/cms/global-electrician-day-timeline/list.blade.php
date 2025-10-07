@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6"><h1 class="m-0">All Timelines</h1></div>
                    <div class="col-sm-6">
                        <a href="{{ route('timelines.create') }}" class="btn bg-gradient-teal btn-sm float-right">
                            <i class="fa fa-plus text-light"></i> Add New Timeline
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible col-md-6">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-gradient-teal text-white">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Timeline Steps</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($timelines as $timeline)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $timeline->title }}</td>
                                <td>{{ $timeline->subtitle }}</td>
                                <td>
                                    @if(!empty($timeline->name) && is_array($timeline->name))
                                        @foreach($timeline->name as $i => $nm)
                                            <strong>{{ $nm }}</strong><br>
                                            @if(!empty($timeline->description[$i]) && is_array($timeline->description[$i]))
                                                @foreach($timeline->description[$i] as $desc)
                                                    <small>{{ $desc }}</small><br>
                                                @endforeach
                                            @endif
                                            <hr>
                                        @endforeach
                                    @else
                                        <em>No steps added</em>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('timelines.edit', $timeline->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('timelines.destroy', $timeline->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center">No timelines found</td></tr>
                        @endforelse
                        </tbody>
                    </table>

                    {{ $timelines->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection




{{--@extends('backend.partials.master')--}}

{{--@section('content')--}}
{{--    <div class="content-wrapper">--}}
{{--        <!-- Header -->--}}
{{--        <div class="content-header">--}}
{{--            <div class="container-fluid">--}}
{{--                <div class="row mb-2">--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <h1 class="m-0">All Timelines</h1>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <a href="{{ route('timelines.create') }}" class="btn bg-gradient-teal btn-sm float-right">--}}
{{--                            <i class="fa fa-plus text-light"></i> Add New Timeline--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Table Section -->--}}
{{--        <div class="card">--}}
{{--            <div class="card-body">--}}
{{--                --}}{{-- Success Message --}}
{{--                @if(session('success'))--}}
{{--                    <div class="alert alert-success alert-dismissible col-md-5">--}}
{{--                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>--}}
{{--                        <h5><i class="icon fas fa-check"></i> {{ session('success') }}</h5>--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                <div class="table-responsive">--}}
{{--                    <table class="table table-bordered table-striped">--}}
{{--                        <thead class="bg-gradient-teal text-white">--}}
{{--                        <tr>--}}
{{--                            <th>#</th>--}}
{{--                            <th>Title</th>--}}
{{--                            <th>Subtitle</th>--}}
{{--                            <th>Names & Descriptions</th>--}}
{{--                            <th class="text-center">Actions</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}

{{--                        <tbody>--}}
{{--                        @forelse($timelines as $timeline)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $loop->iteration }}</td>--}}
{{--                                <td>{{ $timeline->title }}</td>--}}
{{--                                <td>{{ $timeline->subtitle }}</td>--}}

{{--                                <td>--}}
{{--                                    @if(is_array($timeline->name))--}}
{{--                                        @foreach($timeline->name as $i => $nm)--}}
{{--                                            <strong>{{ $nm }}</strong><br>--}}
{{--                                            <small>{{ $timeline->description[$i]  }}</small>--}}
{{--                                            @if(!$loop->last)--}}
{{--                                                <hr class="my-1">--}}
{{--                                            @endif--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                </td>--}}

{{--                                <td class="text-center">--}}
{{--                                    <a href="{{ route('timelines.edit', $timeline->id) }}" class="btn btn-info btn-sm">--}}
{{--                                        <i class="fa fa-edit"></i>--}}
{{--                                    </a>--}}
{{--                                    <form action="{{ route('timelines.destroy', $timeline->id) }}" method="POST"--}}
{{--                                          class="d-inline"--}}
{{--                                          onsubmit="return confirm('Are you sure you want to delete this timeline?');">--}}
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
{{--                                <td colspan="5" class="text-center">No timelines found</td>--}}
{{--                            </tr>--}}
{{--                        @endforelse--}}
{{--                        </tbody>--}}
{{--                    </table>--}}

{{--                    --}}{{-- Pagination --}}
{{--                    {{ $timelines->links('pagination::bootstrap-5') }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}

