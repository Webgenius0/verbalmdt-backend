@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="col-md-10 py-5 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">
                    Edit Timeline
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

                    <form action="{{ route('timelines.update', $timeline->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="form-group">
                            <label>Title <i class="text-danger">*</i></label>
                            <input type="text" name="title" class="form-control"
                                   value="{{ old('title', $timeline->title) }}" placeholder="Enter Title" required>
                        </div>

                        {{-- Subtitle --}}
                        <div class="form-group">
                            <label>Subtitle</label>
                            <input type="text" name="subtitle" class="form-control"
                                   value="{{ old('subtitle', $timeline->subtitle) }}" placeholder="Enter Subtitle">
                        </div>

                        {{-- Multiple Names with Multiple Descriptions --}}
                        <div class="form-group">
                            <label>Timeline Steps (Names with Multiple Descriptions)</label>
                            <div id="name-items">
                                @foreach($timeline->name as $i => $nm)
                                    <div class="name-item border rounded p-3 mb-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <input type="text" name="name[]" class="form-control w-75" value="{{ old('name.'.$i, $nm) }}" placeholder="Enter Name" required>
                                            <button type="button" class="btn btn-danger btn-sm ml-2" onclick="removeItem(this)">Remove Name</button>
                                        </div>

                                        <div class="mt-2 desc-container">
                                            @foreach($timeline->description[$i] ?? [''] as $desc)
                                                <div class="desc-item mb-2">
                                                    <textarea name="description[{{ $i }}][]" class="form-control" placeholder="Enter Description">{{ old('description.'.$i.'.'. $loop->index, $desc) }}</textarea>
                                                    <button type="button" class="btn btn-sm btn-outline-danger mt-1" onclick="removeDesc(this)">Remove Description</button>
                                                </div>
                                            @endforeach
                                        </div>
                                        <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addDesc(this)">+ Add Description</button>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" class="btn btn-sm btn-outline-success mt-3" onclick="addName()">+ Add Another Name</button>
                        </div>

                        {{-- Submit --}}
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success">Update Timeline</button>
                            <a href="{{ route('timelines.index') }}" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript for dynamic names & descriptions --}}
    <script>
        function addName() {
            const container = document.getElementById('name-items');
            const index = container.querySelectorAll('.name-item').length;
            const div = document.createElement('div');
            div.classList.add('name-item', 'border', 'rounded', 'p-3', 'mb-3');
            div.innerHTML = `
                <div class="d-flex justify-content-between align-items-center">
                    <input type="text" name="name[]" class="form-control w-75" placeholder="Enter Name" required>
                    <button type="button" class="btn btn-danger btn-sm ml-2" onclick="removeItem(this)">Remove Name</button>
                </div>
                <div class="mt-2 desc-container">
                    <div class="desc-item mb-2">
                        <textarea name="description[${index}][]" class="form-control" placeholder="Enter Description"></textarea>
                        <button type="button" class="btn btn-sm btn-outline-danger mt-1" onclick="removeDesc(this)">Remove Description</button>
                    </div>
                </div>
                <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addDesc(this)">+ Add Description</button>
            `;
            container.appendChild(div);
        }

        function addDesc(button) {
            const nameItem = button.closest('.name-item');
            const index = Array.from(document.querySelectorAll('.name-item')).indexOf(nameItem);
            const descContainer = nameItem.querySelector('.desc-container');
            const div = document.createElement('div');
            div.classList.add('desc-item', 'mb-2');
            div.innerHTML = `
                <textarea name="description[${index}][]" class="form-control" placeholder="Enter Description"></textarea>
                <button type="button" class="btn btn-sm btn-outline-danger mt-1" onclick="removeDesc(this)">Remove Description</button>
            `;
            descContainer.appendChild(div);
        }

        function removeItem(button) {
            button.closest('.name-item').remove();
        }

        function removeDesc(button) {
            button.closest('.desc-item').remove();
        }
    </script>
@endsection
