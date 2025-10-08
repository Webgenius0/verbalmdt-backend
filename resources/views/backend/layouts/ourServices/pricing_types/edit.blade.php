@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <!-- Header -->
        <div class="content-header">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <h1 class="m-0">Edit Pricing Type</h1>
                <a href="{{ route('pricing-types.index') }}" class="btn btn-secondary btn-sm">Back to List</a>
            </div>
        </div>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('pricing-types.update', $pricingType->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">Name <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control"
                                    value="{{ old('name', $pricingType->name) }}"
                                    placeholder="Enter pricing type name"
                                    required
                                >
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('pricing-types.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
