@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">All Contact Messages</h1>
                    </div>
                </div>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible col-md-5">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h5><i class="icon fas fa-check"></i> {{ session('success') }}</h5>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="bg-gradient-teal text-white">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Terms</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($contacts as $contact)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->company_name ?? '-' }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone_number ?? '-' }}</td>
                                <td>{{ Str::limit($contact->message, 50) }}</td>
                                <td>
                                    @if($contact->terms)
                                        <span class="badge bg-success">Accepted</span>
                                    @else
                                        <span class="badge bg-danger">Not Accepted</span>
                                    @endif
                                </td>
                                <td>{{ $contact->created_at->format('d M, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">No contact messages found</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{ $contacts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>

        {{-- Contact Image Section --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Contact Image</h1>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{route('web-contact-images.index')}}" class="btn bg-gradient-teal btn-sm float-right">
                            <i class="fa fa-plus text-light"></i> Upload Image
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Contact Image List --}}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @forelse($contactImages as $img)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="{{ asset('storage/'.$img->image) }}" class="card-img-top" alt="Contact Image">
                                <div class="card-body text-center">
                                    <form action="{{ route('web-contact-images.destroy', $img->id) }}" method="POST" onsubmit="return confirm('Delete this image?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>No contact images found</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
