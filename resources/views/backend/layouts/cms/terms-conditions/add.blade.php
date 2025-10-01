@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="col-md-8 py-5 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">
                    {{ isset($web_term) ? 'Edit Term & Condition' : 'Add Term & Condition' }}
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

                    <form action="{{ isset($web_term) ? route('web-terms.update', $web_term->id) : route('web-terms.store') }}" method="POST">
                        @csrf
                        @if(isset($web_term)) @method('PUT') @endif

                        {{-- Title --}}
                        <div class="form-group">
                            <label>Title <i class="text-danger">*</i></label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $web_term->title ?? '') }}" required>
                        </div>

                        {{-- Sub-title + Description --}}
                        <div class="form-group">
                            <label>Sub Title & Description</label>
                            <div id="sub-items">
                                @if(old('sub_title'))
                                    @foreach(old('sub_title') as $i => $st)
                                        <div class="sub-item mb-2">
                                            <input type="text" name="sub_title[]" class="form-control mb-1" value="{{ $st }}" placeholder="Sub Title" required>
                                            <textarea name="description[]" class="form-control" placeholder="Description">{{ old('description')[$i] ?? '' }}</textarea>
                                            <button type="button" class="btn btn-sm btn-danger mt-1" onclick="removeItem(this)">Remove</button>
                                        </div>
                                    @endforeach
                                @elseif(isset($web_term))
                                    @foreach($web_term->sub_title as $i => $st)
                                        <div class="sub-item mb-2">
                                            <input type="text" name="sub_title[]" class="form-control mb-1" value="{{ $st }}" placeholder="Sub Title" required>
                                            <textarea name="description[]" class="form-control" placeholder="Description">{{ $web_term->description[$i] ?? '' }}</textarea>
                                            <button type="button" class="btn btn-sm btn-danger mt-1" onclick="removeItem(this)">Remove</button>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="sub-item mb-2">
                                        <input type="text" name="sub_title[]" class="form-control mb-1" placeholder="Sub Title" required>
                                        <textarea name="description[]" class="form-control" placeholder="Description"></textarea>
                                        <button type="button" class="btn btn-sm btn-danger mt-1" onclick="removeItem(this)">Remove</button>
                                    </div>
                                @endif
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addItem()">+ Add More</button>
                        </div>

                        <button type="submit" class="btn btn-success mt-3">{{ isset($web_term) ? 'Update' : 'Save' }} Term</button>
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
