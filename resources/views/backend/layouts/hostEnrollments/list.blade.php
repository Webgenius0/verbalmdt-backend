@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header Section -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">Host Enrollment List</h1>
            </div>
        </div>

        <!-- Filter & Table Section -->
        <section class="content">
            <div class="container-fluid">

                <!-- Filter Form -->
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <form method="GET" class="row g-2">
                            <div class="col-md-4">
                                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                                       placeholder="Search by name, company, email, phone, or licence...">
                            </div>

                            <div class="col-md-2">
                                <select name="per_page" class="form-select">
                                    <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                                    <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <table class="table table-striped table-bordered mb-0">
                            <thead class="bg-teal text-white text-center">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Annual Income</th>
                                <th>Employee No.</th>
                                <th>Country</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Zip</th>
                                <th>Parish</th>
                                <th>County</th>
                                <th>Licence</th>
                                <th>Agency URL</th>
                                <th>Message</th>
                                <th>Answers</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($enrollments as $key => $enroll)
                                <tr class="text-center align-middle">
                                    <td>{{ $enrollments->firstItem() + $key }}</td>
                                    <td>{{ $enroll->name }}</td>
                                    <td>{{ $enroll->company_name ?? 'N/A' }}</td>
                                    <td>{{ $enroll->email ?? 'N/A' }}</td>
                                    <td>{{ $enroll->phone ?? 'N/A' }}</td>
                                    <td>{{ $enroll->annual_income ?? 'N/A' }}</td>
                                    <td>{{ $enroll->employee_number ?? 'N/A' }}</td>
                                    <td>{{ $enroll->country ?? 'N/A' }}</td>
                                    <td>{{ $enroll->city ?? 'N/A' }}</td>
                                    <td>{{ $enroll->state ?? 'N/A' }}</td>
                                    <td>{{ $enroll->zip_number ?? 'N/A' }}</td>
                                    <td>{{ $enroll->parish ?? 'N/A' }}</td>
                                    <td>{{ $enroll->county ?? 'N/A' }}</td>
                                    <td>{{ $enroll->licence_number ?? 'N/A' }}</td>
                                    <td>
                                        @if($enroll->licence_agency_url)
                                            <a href="{{ $enroll->licence_agency_url }}" target="_blank">
                                                Visit <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $enroll->message ?? 'N/A' }}</td>
                                    <td class="text-start">
                                        @if(is_array($enroll->answers_json))
                                            <ul class="list-unstyled m-0">
                                                @php
                                                    $questionSets = \App\Models\Question::all();
                                                @endphp
                                                @foreach($questionSets as $qSet)
                                                    <li class="mb-1">
                                                        <strong>{{ $qSet->title }}:</strong>
                                                        <ul class="list-unstyled ms-3">
                                                            @php
                                                                $subAnswers = collect($enroll->answers_json)
                                                                                ->where('question_id', $qSet->id)
                                                                                ->values();
                                                            @endphp
                                                            @foreach($subAnswers as $index => $subAnswer)
                                                                <li>
                                                                    <strong>Question {{ $index + 1 }}:</strong> {{ $subAnswer['answer'] }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @else
                                            <span class="text-muted">No Answers</span>
                                        @endif
                                    </td>
                                    <td>{{ $enroll->created_at->format('d M, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="18" class="text-center text-muted py-3">
                                        No host enrollments found
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer d-flex justify-content-end">
                        {{ $enrollments->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
