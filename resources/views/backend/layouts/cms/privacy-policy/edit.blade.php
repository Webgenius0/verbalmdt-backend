{{-- resources/views/backend/partials/privacy-policy-edit.blade.php --}}

@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="col-md-8 py-5 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">
                    Edit Privacy Policy
                </div>
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('web-privacy-policies.update', $webPrivacyPolicy->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="form-group">
                            <label>Title <i class="text-danger">*</i></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $webPrivacyPolicy->title) }}" required>
                        </div>

                        {{-- Sub-title + Description --}}
                        <div class="form-group">
                            <label>Sub Title & Description</label>
                            <div id="sub-items">
                                @foreach($webPrivacyPolicy->sub_title as $i => $subtitle)
                                    <div class="sub-item mb-2">
                                        <input type="text" name="sub_title[]" class="form-control mb-1" value="{{ old('sub_title.'.$i, $subtitle) }}" placeholder="Sub Title" required>
                                        <textarea name="description[]" class="form-control" placeholder="Description">{{ old('description.'.$i, $webPrivacyPolicy->description[$i] ?? '') }}</textarea>
                                        <button type="button" class="btn btn-sm btn-danger mt-1" onclick="removeItem(this)">Remove</button>
                                    </div>
                                @endforeach
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addItem()">+ Add More</button>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">Update Policy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addItem() {
            const container = document.getElementById('sub-items');
            const div = document.createElement('div');
            div.classList.add('sub-item', 'mb-2');
            div.innerHTML = `
                <input type="text" name="sub_title[]" class="form-control mb-1" placeholder="Sub Title" required>
                <textarea name="description[]" class="form-control" placeholder="Description"></textarea>
                <button type="button" class="btn btn-sm btn-danger mt-1" onclick="removeItem(this)">Remove</button>
            `;
            container.appendChild(div);
        }

        function removeItem(button) {
            button.parentElement.remove();
        }
    </script>
@endsection
