@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper p-4" style="background-color: #f8f9fa; min-height: 100vh;">
        <div class="container-fluid">

            <h2 class="mb-4 text-center text-primary fw-bold">Add Global Electrician Day</h2>

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

            {{-- Single full-width form card --}}
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">

                    <form action="{{ route('global-electrician-days.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

{{--                        ======== Title Section ========--}}
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-dark text-white fw-bold">Title Section</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter main title" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" name="subtitle" class="form-control" placeholder="Enter subtitle">
                                </div>
                            </div>
                        </div>

{{--                        ======== Story Section ========--}}
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-info text-white fw-bold">Story Section</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Story Name</label>
                                    <input type="text" name="story_name" class="form-control" placeholder="Enter story name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Story Image</label>
                                    <input type="file" name="story_image" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Story Description</label>
                                    <textarea name="story_description" rows="3" class="form-control" placeholder="Write story description..."></textarea>
                                </div>
                            </div>
                        </div>

{{--                        ======== Mission Section ========--}}
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-success text-white fw-bold">Mission Section</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Mission Name</label>
                                    <input type="text" name="mission_name" class="form-control" placeholder="Enter mission name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mission Image</label>
                                    <input type="file" name="mission_image" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Mission Description</label>
                                    <textarea name="mission_description" rows="3" class="form-control" placeholder="Write mission description..."></textarea>
                                </div>
                            </div>
                        </div>

{{--                        ======== Matters Section ========--}}
                        <div class="card mb-4 border-0 shadow-sm">
                            <div class="card-header bg-warning text-dark fw-bold">Matters Section</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Matters Name</label>
                                    <input type="text" name="matters_name" class="form-control" placeholder="Enter matters name">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Matters Image</label>
                                    <input type="file" name="matters_image" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Matters Description</label>
                                    <textarea name="matters_description" rows="3" class="form-control" placeholder="Write matters description..."></textarea>
                                </div>
                            </div>
                        </div>

                        {{-- ================= Submit Buttons ================= --}}
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary px-5 py-2">
                                <i class="fas fa-save me-1"></i> Save
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
