@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="col-md-10 py-5 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">
                    Edit Global Multimedia
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

                    {{-- Form Start --}}
                    <form action="{{ route('global-multimedia.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Year --}}
                        <div class="form-group">
                            <label>Year <i class="text-danger">*</i></label>
                            <input type="number" name="year" class="form-control" value="{{ old('year', $item->year) }}" placeholder="Enter Year" required>
                        </div>

                        {{-- Existing Images --}}
                        <div class="form-group">
                            <label>Existing Images</label>
                            <div class="d-flex flex-wrap mb-2">
                                @if($item->images)
                                    @foreach($item->images as $index => $image)
                                        <div class="position-relative mr-2 mb-2">
                                            <img src="{{ asset('storage/'.$image) }}" alt="Image" style="width:100px;height:100px;object-fit:cover;">
                                            <input type="checkbox" name="remove_images[]" value="{{ $image }}"> Remove
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        {{-- Add New Images --}}
                        <div class="form-group">
                            <label>Add New Images</label>
                            <input type="file" name="images[]" class="form-control mb-2" id="images" multiple accept="image/*">
                            <div id="imagePreview" class="d-flex flex-wrap mt-2"></div>
                        </div>

                        {{-- Existing Videos --}}
                        <div class="form-group">
                            <label>Existing Videos</label>
                            <div class="d-flex flex-wrap mb-2">
                                @if($item->videos)
                                    @foreach($item->videos as $video)
                                        <div class="mr-2 mb-2">
                                            <video width="200" height="120" controls>
                                                <source src="{{ asset('storage/'.$video) }}" type="video/mp4">
                                            </video>
                                            <br>
                                            <input type="checkbox" name="remove_videos[]" value="{{ $video }}"> Remove
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        {{-- Add New Videos --}}
                        <div class="form-group">
                            <label>Add New Videos</label>
                            <input type="file" name="videos[]" class="form-control mb-2" id="videos" multiple accept="video/*">
                            <div id="videoPreview" class="d-flex flex-wrap mt-2"></div>
                        </div>

                        {{-- Submit --}}
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success">Update Multimedia</button>
                            <a href="{{ route('global-multimedia.index') }}" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- JS Preview --}}
    @section('scripts')
        <script>
            // Image preview
            const imageInput = document.getElementById('images');
            const imagePreview = document.getElementById('imagePreview');

            imageInput.addEventListener('change', function() {
                imagePreview.innerHTML = '';
                Array.from(this.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '100px';
                        img.style.height = '100px';
                        img.style.objectFit = 'cover';
                        img.style.marginRight = '5px';
                        img.style.marginBottom = '5px';
                        imagePreview.appendChild(img);
                    }
                    reader.readAsDataURL(file);
                });
            });

            // Video preview
            const videoInput = document.getElementById('videos');
            const videoPreview = document.getElementById('videoPreview');

            videoInput.addEventListener('change', function() {
                videoPreview.innerHTML = '';
                Array.from(this.files).forEach(file => {
                    const url = URL.createObjectURL(file);
                    const vid = document.createElement('video');
                    vid.src = url;
                    vid.controls = true;
                    vid.style.width = '200px';
                    vid.style.height = '120px';
                    vid.style.marginRight = '5px';
                    vid.style.marginBottom = '5px';
                    videoPreview.appendChild(vid);
                });
            });
        </script>
    @endsection

@endsection

