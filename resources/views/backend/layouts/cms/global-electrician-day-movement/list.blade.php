{{--@extends('backend.partials.master')--}}

{{--@section('content')--}}
{{--    <div class="content-wrapper">--}}
{{--        <div class="content-header">--}}
{{--            <div class="container-fluid">--}}
{{--                <div class="row mb-2">--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <h1 class="m-0">All Movements</h1>--}}
{{--                    </div>--}}
{{--                    <div class="col-sm-6">--}}
{{--                        <a href="{{ route('movements.create') }}" class="btn bg-gradient-teal btn-sm float-right">--}}
{{--                            <i class="fa fa-plus text-light"></i> Add New Movement--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        --}}{{-- Table Section --}}
{{--        <div class="card">--}}
{{--            <div class="card-body">--}}

{{--                --}}{{-- Success Message --}}
{{--                @if(session('success'))--}}
{{--                    <div class="alert alert-success alert-dismissible col-md-6">--}}
{{--                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>--}}
{{--                        <h5><i class="icon fas fa-check"></i> {{ session('success') }}</h5>--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                <div class="table-responsive">--}}
{{--                    <table class="table table-bordered table-striped">--}}
{{--                        <thead class="bg-gradient-teal text-white">--}}
{{--                        <tr>--}}
{{--                            <th>#</th>--}}
{{--                            <th>Image</th>--}}
{{--                            <th>Titles & Descriptions</th>--}}
{{--                            <th class="text-center">Actions</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @forelse($movements as $movement)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $loop->iteration }}</td>--}}

{{--                                --}}{{-- Image --}}
{{--                                <td>--}}
{{--                                    @if($movement->image)--}}
{{--                                        <img src="{{ asset('storage/'.$movement->image) }}" alt="Movement Image" style="width:100px; height:auto;">--}}
{{--                                    @else--}}
{{--                                        <em>No image</em>--}}
{{--                                    @endif--}}
{{--                                </td>--}}

{{--                                --}}{{-- Titles & Descriptions --}}
{{--                                <td>--}}
{{--                                    @if(is_array($movement->title))--}}
{{--                                        @foreach($movement->title as $i => $title)--}}
{{--                                            <strong>{{ $title }}</strong><br>--}}
{{--                                            <small>{{ $movement->description[$i] ?? '' }}</small>--}}
{{--                                            <hr>--}}
{{--                                        @endforeach--}}
{{--                                    @else--}}
{{--                                        <em>No titles added</em>--}}
{{--                                    @endif--}}
{{--                                </td>--}}

{{--                                --}}{{-- Actions --}}
{{--                                <td class="text-center">--}}
{{--                                    <a href="{{ route('movements.edit', $movement->id) }}" class="btn btn-info btn-sm">--}}
{{--                                        <i class="fa fa-edit"></i>--}}
{{--                                    </a>--}}
{{--                                    <form action="{{ route('movements.destroy', $movement->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this movement?');">--}}
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
{{--                                <td colspan="4" class="text-center">No movements found</td>--}}
{{--                            </tr>--}}
{{--                        @endforelse--}}
{{--                        </tbody>--}}
{{--                    </table>--}}

{{--                    --}}{{-- Pagination --}}
{{--                    @if(method_exists($movements, 'links'))--}}
{{--                        {{ $movements->links('pagination::bootstrap-5') }}--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}


@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">All Movements</h1>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('movements.create') }}" class="btn bg-gradient-teal btn-sm float-right">
                            <i class="fa fa-plus text-light"></i> Add New Movement
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="card">
            <div class="card-body">

                {{-- Success Message --}}
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible col-md-6">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> {{ session('success') }}</h5>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-gradient-teal text-white">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Titles & Descriptions</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($movements as $movement)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                {{-- Image --}}
                                <td>
                                    @if($movement->image)
                                        <img src="{{ asset('storage/'.$movement->image) }}" alt="Movement Image" style="width:100px; height:auto;">
                                    @else
                                        <em>No image</em>
                                    @endif
                                </td>

                                {{-- Titles & Descriptions --}}
                                <td>
                                    @if(is_array($movement->title) && count($movement->title))
                                        @foreach($movement->title as $i => $title)
                                            <strong>{{ $title }}</strong><br>

                                            @if(isset($movement->description[$i]) && is_array($movement->description[$i]))
                                                @foreach($movement->description[$i] as $desc)
                                                    <small>{{ $desc }}</small><br>
                                                @endforeach
                                            @else
                                                <small><em>No description</em></small><br>
                                            @endif

                                            <hr>
                                        @endforeach
                                    @else
                                        <em>No titles added</em>
                                    @endif
                                </td>

                                {{-- Actions --}}
                                <td class="text-center">
                                    <a href="{{ route('movements.edit', $movement->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('movements.destroy', $movement->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this movement?');">
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
                                <td colspan="4" class="text-center">No movements found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    @if(method_exists($movements, 'links'))
                        {{ $movements->links('pagination::bootstrap-5') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
