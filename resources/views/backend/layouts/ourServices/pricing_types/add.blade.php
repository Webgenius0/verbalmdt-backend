@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <h1>Add Pricing Type</h1>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('pricing-types.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter pricing type">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
