@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Add Questions in {{ $survey_title->title }}</h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('questions.store', $survey_id) }}">
                        @csrf
                        <div class="text-end">
                            <button type="button" id="add-question-btn" class="btn btn-secondary">Add Another
                                Question</button>
                        </div>
                        <div id="questions-container">
                            <div class="form-group question-item">
                                <label for="questions[]">Question 1:</label>
                                <input type="text" name="questions[]" class="form-control" required>
                            </div>
                        </div>
                        <br><br>
                        <button type="submit" class="btn btn-primary">Add Questions</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let questionCount = 1;
        // Function to add a new question
        document.getElementById('add-question-btn').addEventListener('click', function() {
            questionCount++;
            const questionDiv = document.createElement('div');
            questionDiv.classList.add('form-group', 'question-item', 'mt-2');
            questionDiv.innerHTML = `
                <label for="questions[]">Question ${questionCount}:</label>
                <div class="input-group">
                    <input type="text" name="questions[]" class="form-control" required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-danger remove-question-btn">Remove</button>
                    </div>
                </div>
            `;
            document.getElementById('questions-container').appendChild(questionDiv);
        });

        // Function to remove a question
        document.getElementById('questions-container').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-question-btn')) {
                event.target.closest('.question-item').remove();
                updateQuestionLabels();
            }
        });

        // Function to update question labels after removal
        function updateQuestionLabels() {
            const questionItems = document.querySelectorAll('.question-item');
            questionItems.forEach((item, index) => {
                const label = item.querySelector('label');
                label.textContent = `Question ${index + 1}:`;
            });
            questionCount = questionItems.length;
        }
    </script>
@endsection
