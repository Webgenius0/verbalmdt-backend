{{--@extends('backend.partials.master')--}}

{{--@section('content')--}}
{{--    <div class="content-wrapper">--}}
{{--        <!-- Page Header -->--}}
{{--        <div class="content-header">--}}
{{--            <div class="container-fluid d-flex justify-content-between align-items-center">--}}
{{--                <h1 class="m-0">Question Sets List</h1>--}}
{{--                <a href="{{ route('questions.create') }}" class="btn bg-gradient-teal btn-sm">--}}
{{--                    <i class="fas fa-plus"></i> Add New--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Main Content -->--}}
{{--        <section class="content">--}}
{{--            <div class="container-fluid">--}}
{{--                <!-- Success Message -->--}}
{{--                @if (session('success'))--}}
{{--                    <div class="alert alert-success alert-dismissible fade show">--}}
{{--                        {{ session('success') }}--}}
{{--                        --}}{{--                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button> --}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                <div class="card shadow-sm">--}}
{{--                    <div class="card-body table-responsive">--}}
{{--                        <table class="table table-bordered table-striped align-middle">--}}
{{--                            <thead class="bg-teal text-white">--}}
{{--                            <tr>--}}
{{--                                <th width="10%">SL</th>--}}
{{--                                <th>Title</th>--}}
{{--                                <th width="15%">Total Questions</th>--}}
{{--                                <th width="25%">Actions</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @forelse($questions as $key => $question)--}}
{{--                                <tr>--}}
{{--                                    <td class="text-center">{{ $questions->firstItem() + $key }}</td>--}}
{{--                                    <td>{{ $question->title }}</td>--}}
{{--                                    <td class="text-center">{{ count($question->questions) }}</td>--}}
{{--                                    <td class="text-center">--}}
{{--                                        <a href="{{ route('questions.show', $question->id) }}" class="btn btn-sm btn-info">--}}
{{--                                            <i class="fas fa-eye"></i>--}}
{{--                                        </a>--}}
{{--                                        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-warning">--}}
{{--                                            <i class="fas fa-edit"></i>--}}
{{--                                        </a>--}}
{{--                                        <form action="{{ route('questions.destroy', $question->id) }}" method="POST" class="d-inline">--}}
{{--                                            @csrf--}}
{{--                                            @method('DELETE')--}}
{{--                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this Question Set?')">--}}
{{--                                                <i class="fas fa-trash"></i>--}}
{{--                                            </button>--}}
{{--                                        </form>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
{{--                            @empty--}}
{{--                                <tr>--}}
{{--                                    <td colspan="4" class="text-center text-muted">No question sets found.</td>--}}
{{--                                </tr>--}}
{{--                            @endforelse--}}
{{--                            </tbody>--}}
{{--                        </table>--}}

{{--                        <!-- Pagination -->--}}
{{--                        <div class="d-flex justify-content-center mt-3">--}}
{{--                            {{ $questions->links() }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </section>--}}
{{--    </div>--}}
{{--@endsection--}}


@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Page Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">Question Sets List</h1>
                <a href="{{ route('questions.create') }}" class="btn bg-gradient-teal btn-sm">
                    <i class="fas fa-plus"></i> Add New
                </a>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Success Message -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="bg-teal text-white">
                            <tr>
                                <th width="10%">SL</th>
                                <th>Title</th>
                                <th>Questions</th>
                                <th width="25%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($questions as $key => $question)
                                <tr>
                                    <td class="text-center">{{ $questions->firstItem() + $key }}</td>
                                    <td>{{ $question->title }}</td>
                                    <td>
                                        <ul class="mb-0">
                                            @foreach($question->questions as $q)
                                                <li>{{ $q }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('questions.destroy', $question->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this Question Set?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No question sets found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $questions->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
