@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="col-md-10 py-5 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">
                    Add New Question Set
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
                    <form action="{{ route('questions.store') }}" method="POST">
                        @csrf

                        {{-- Title --}}
                        <div class="form-group mb-3">
                            <label>Title <i class="text-danger">*</i></label>
                            <input type="text" name="title" class="form-control" placeholder="Enter question set title" value="{{ old('title') }}" required>
                        </div>

                        {{-- Questions --}}
                        <div class="form-group mb-3">
                            <label>Questions</label>
                            <div id="question-items">
                                <div class="question-item mb-2">
                                    <input type="text" name="questions[]" class="form-control mb-1" placeholder="Enter a question" required>
                                </div>
                            </div>

                            {{-- Add / Remove Buttons --}}
                            <button type="button" class="btn btn-sm btn-outline-success mt-2" onclick="addQuestion()">+ Add Question</button>
                            <br>
                            <button type="button" class="btn btn-sm btn-outline-danger mt-2" id="remove-question">Remove Last Question</button>
                        </div>

                        {{-- Submit --}}
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success">Save Question Set</button>
                            <a href="{{ route('questions.index') }}" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    {{-- JavaScript for dynamic questions --}}
    <script>
        function addQuestion() {
            const container = document.getElementById('question-items');
            const div = document.createElement('div');
            div.classList.add('question-item', 'mb-2');
            div.innerHTML = `<input type="text" name="questions[]" class="form-control mb-1" placeholder="Enter a question" required>`;
            container.appendChild(div);
        }

        document.getElementById('remove-question').addEventListener('click', function() {
            const container = document.getElementById('question-items');
            const items = container.querySelectorAll('.question-item');
            if(items.length > 1) { // keep at least one question
                items[items.length - 1].remove();
            } else {
                alert('At least one question is required.');
            }
        });
    </script>
@endsection

