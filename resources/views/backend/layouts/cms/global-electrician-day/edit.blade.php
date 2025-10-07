@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper p-4" style="background-color: #f8f9fa; min-height: 100vh;">
        <div class="container-fluid">

            <h2 class="mb-4 text-center text-primary fw-bold">Edit Global Electrician Day</h2>

            {{-- Success message --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <form action="{{ route('global-electrician-days.update', $globalElectricianDay->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- ======== Title Section ======== --}}
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-dark text-white fw-bold">Title Section</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter main title"
                                           value="{{ old('title', $globalElectricianDay->title) }}" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" name="subtitle" class="form-control" placeholder="Enter subtitle"
                                           value="{{ old('subtitle', $globalElectricianDay->subtitle) }}">
                                </div>
                            </div>
                        </div>

                        {{-- ======== Story Section ======== --}}
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-info text-white fw-bold">Story Section</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Story Name</label>
                                    <input type="text" name="story_name" class="form-control" placeholder="Enter story name"
                                           value="{{ old('story_name', $globalElectricianDay->story_name) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Story Image</label>
                                    @if($globalElectricianDay->story_image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/'.$globalElectricianDay->story_image) }}"
                                                 alt="Story Image" style="height:100px; object-fit:cover;">
                                        </div>
                                    @endif
                                    <input type="file" name="story_image" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Story Description</label>
                                    <textarea name="story_description" rows="3" class="form-control" placeholder="Write story description...">{{ old('story_description', $globalElectricianDay->story_description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- ======== Mission Section ======== --}}
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-success text-white fw-bold">Mission Section</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Mission Name</label>
                                    <input type="text" name="mission_name" class="form-control" placeholder="Enter mission name"
                                           value="{{ old('mission_name', $globalElectricianDay->mission_name) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mission Image</label>
                                    @if($globalElectricianDay->mission_image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/'.$globalElectricianDay->mission_image) }}"
                                                 alt="Mission Image" style="height:100px; object-fit:cover;">
                                        </div>
                                    @endif
                                    <input type="file" name="mission_image" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mission Description</label>
                                    <textarea name="mission_description" rows="3" class="form-control" placeholder="Write mission description...">{{ old('mission_description', $globalElectricianDay->mission_description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- ======== Matters Section ======== --}}
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-warning text-dark fw-bold">Matters Section</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Matters Name</label>
                                    <input type="text" name="matters_name" class="form-control" placeholder="Enter matters name"
                                           value="{{ old('matters_name', $globalElectricianDay->matters_name) }}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Matters Image</label>
                                    @if($globalElectricianDay->matters_image)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/'.$globalElectricianDay->matters_image) }}"
                                                 alt="Matters Image" style="height:100px; object-fit:cover;">
                                        </div>
                                    @endif
                                    <input type="file" name="matters_image" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Matters Description</label>
                                    <textarea name="matters_description" rows="3" class="form-control" placeholder="Write matters description...">{{ old('matters_description', $globalElectricianDay->matters_description) }}</textarea>
                                </div>
                            </div>
                        </div>

                        {{-- ================= Submit Buttons ================= --}}
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-5 py-2">
                                <i class="fas fa-save me-1"></i> Update
                            </button>
                            <a href="{{ route('global-electrician-days.index') }}" class="btn btn-secondary px-4 py-2">
                                Cancel
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
