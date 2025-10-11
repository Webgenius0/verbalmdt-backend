@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header Section -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">Registrations For Global Electrician Day-2026</h1>
                <div>
                    <a href="{{ route('dashboard') }}" class="btn btn-info btn-sm">
                        <i class="fas fa-arrow-left"></i> Back
                    </a>
                </div>
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
                                       placeholder="Search by name, phone, or email...">
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
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title m-0">Registration List</h3>
                    </div>

                    <div class="card-body p-0">
                        <table class="table table-striped table-bordered mb-0">
                            <thead class="bg-teal text-white">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>City</th>
                                <th>County</th>
                                <th>Parish</th>
                                <th>Zip Code</th>
                                <th>Licence No</th>
                                <th>Licence Agency URL</th>
                                <th>Message</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($registrations as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $registrations->firstItem() + $index }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email ?? 'N/A' }}</td>
                                    <td>{{ $item->phone ?? 'N/A' }}</td>
                                    <td>{{ $item->country ?? 'N/A' }}</td>
                                    <td>{{ $item->state ?? 'N/A' }}</td>
                                    <td>{{ $item->city ?? 'N/A' }}</td>
                                    <td>{{ $item->county ?? 'N/A' }}</td>
                                    <td>{{ $item->parish ?? 'N/A' }}</td>
                                    <td>{{ $item->zip_number ?? 'N/A' }}</td>

                                    <!-- 🆕 Added Licence Fields -->
                                    <td>{{ $item->licence_number ?? 'N/A' }}</td>
                                    <td>
                                        @if($item->licence_agency_url)
                                            <a href="{{ $item->licence_agency_url }}" target="_blank" title="Visit Licence Agency">
                                                Visit <i class="fas fa-external-link-alt"></i>
                                            </a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <!-- End New Fields -->

                                    <td>{{ ($item->message) ?? 'N/A' }}</td>
                                    <td>{{ $item->created_at->format('d M, Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="14" class="text-center text-muted py-3">
                                        No registrations found
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        {{ $registrations->links('pagination::bootstrap-5') }}
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
