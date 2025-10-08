@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Page Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">Pricing Type List</h1>
                <a href="{{ route('pricing-types.create') }}" class="btn bg-gradient-teal btn-sm">
                    <i class="fas fa-plus"></i>Add New
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
{{--                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>--}}
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="bg-teal text-white">
                            <tr>
                                <th width="10%">SL</th>
                                <th>Name</th>
                                <th width="20%">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($pricingTypes as $key => $pricingType)
                                <tr>
                                    <td class="text-center">{{ $pricingTypes->firstItem() + $key }}</td>
                                    <td>{{ $pricingType->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('pricing-types.edit', $pricingType->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('pricing-types.destroy', $pricingType->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this item?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted">No pricing types found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $pricingTypes->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
