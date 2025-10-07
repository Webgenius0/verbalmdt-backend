@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Global Electrician Day List</h1>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{ route('global-electrician-days.create') }}" class="btn bg-gradient-teal btn-sm float-right">
                            <i class="fa fa-plus text-light"></i> Add New
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card Section --}}
        <div class="container-fluid">
            <div class="row">
                @forelse($days as $day)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm">

                            {{-- Title Section --}}
                            <div class="card-header bg-dark text-white">
                                {{ $day->title }}
                                @if($day->subtitle)
                                    <small class="d-block fw-normal">{{ $day->subtitle }}</small>
                                @endif
                            </div>

                            <div class="card-body d-flex flex-column">

                                {{-- Story Section --}}
                                <div class="mb-3 border-bottom pb-2">
                                    <h6 class="text-info fw-bold">Story</h6>
                                    @if($day->story_name)
                                        <p><strong>Name:</strong> {{ $day->story_name }}</p>
                                    @endif
                                    @if($day->story_image)
                                        <img src="{{ asset('storage/'.$day->story_image) }}" alt="Story Image" class="rounded mb-2" style="width:100%; max-height:150px; object-fit:cover;">
                                    @endif
                                    @if($day->story_description)
                                        <p><strong>Description:</strong> {{ Str::limit($day->story_description, 100) }}</p>
                                    @endif
                                </div>

                                {{-- Mission Section --}}
                                <div class="mb-3 border-bottom pb-2">
                                    <h6 class="text-success fw-bold">Mission</h6>
                                    @if($day->mission_name)
                                        <p><strong>Name:</strong> {{ $day->mission_name }}</p>
                                    @endif
                                    @if($day->mission_image)
                                        <img src="{{ asset('storage/'.$day->mission_image) }}" alt="Mission Image" class="rounded mb-2" style="width:100%; max-height:150px; object-fit:cover;">
                                    @endif
                                    @if($day->mission_description)
                                        <p><strong>Description:</strong> {{ Str::limit($day->mission_description, 100) }}</p>
                                    @endif
                                </div>

                                {{-- Matters Section --}}
                                <div class="mb-3">
                                    <h6 class="text-warning fw-bold">Matters</h6>
                                    @if($day->matters_name)
                                        <p><strong>Name:</strong> {{ $day->matters_name }}</p>
                                    @endif
                                    @if($day->matters_image)
                                        <img src="{{ asset('storage/'.$day->matters_image) }}" alt="Matters Image" class="rounded mb-2" style="width:100%; max-height:150px; object-fit:cover;">
                                    @endif
                                    @if($day->matters_description)
                                        <p><strong>Description:</strong> {{ Str::limit($day->matters_description, 100) }}</p>
                                    @endif
                                </div>

                                {{-- Edit/Delete Buttons --}}
                                <div class="mt-auto text-center">
                                    <a href="{{ route('global-electrician-days.edit', $day->id) }}" class="btn btn-info btn-sm me-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('global-electrician-days.destroy', $day->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <div class="alert alert-info">No records found. Please add a new entry.</div>
                        <a href="{{ route('global-electrician-days.create') }}" class="btn btn-primary mt-2">+ Add New</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

