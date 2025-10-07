
@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="col-md-10 py-5 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">
                    Add New Movement
                </div>

                <div class="card-body">

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('movements.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Image --}}
                        <div class="form-group">
                            <label>Image <i class="text-danger">*</i></label>
                            <input type="file" name="image" class="form-control" required>
                        </div>

                        {{-- Titles & Descriptions --}}
                        <div class="form-group">
                            <label>Titles & Descriptions</label>
                            <div id="title-desc-items">
                                <div class="item border rounded p-3 mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <input type="text" name="title[]" class="form-control w-75" placeholder="Enter Title" required>
                                        <button type="button" class="btn btn-danger btn-sm ml-2" onclick="removeItem(this)">Remove</button>
                                    </div>
                                    <div class="mt-2 desc-container">
                                        <div class="desc-item mb-2">
                                            <textarea name="description[0][]" class="form-control" placeholder="Enter Description"></textarea>
                                            <button type="button" class="btn btn-sm btn-outline-danger mt-1" onclick="removeDesc(this)">Remove Description</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-primary mt-2" onclick="addDesc(this)">+ Add Description</button>
                                </div>
                            </div>

                            <button type="button" class="btn btn-sm btn-outline-success mt-3" onclick="addTitleDesc()">+ Add Another Title</button>
                        </div>

                        {{-- Submit --}}
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success">Save Movement</button>
                            <a href="{{ route('movements.index') }}" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        function addTitleDesc() {
            const container = document.getElementById('title-desc-items');
            const index = container.querySelectorAll('.item').length;
            const div = document.createElement('div');
            div.classList.add('item', 'border', 'rounded', 'p-3', 'mb-3');
            div.innerHTML = `
            <div class="d-flex justify-content-between align-items-center">
                <input type="text" name="title[]" class="form-control w-75" placeholder="Enter Title" required>
                <button type="button" class="btn btn-danger btn-sm ml-2" onclick="removeItem(this)">Remove</button>
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
            const item = button.closest('.item');
            const index = Array.from(document.querySelectorAll('.item')).indexOf(item);
            const descContainer = item.querySelector('.desc-container');
            const div = document.createElement('div');
            div.classList.add('desc-item', 'mb-2');
            div.innerHTML = `
            <textarea name="description[${index}][]" class="form-control" placeholder="Enter Description"></textarea>
            <button type="button" class="btn btn-sm btn-outline-danger mt-1" onclick="removeDesc(this)">Remove Description</button>
        `;
            descContainer.appendChild(div);
        }

        function removeItem(button) {
            button.closest('.item').remove();
        }

        function removeDesc(button) {
            button.closest('.desc-item').remove();
        }
    </script>
@endsection

