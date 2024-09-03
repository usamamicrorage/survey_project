@extends('layouts.authlayout')

@section('content')
    <div class="container">
        <form action="{{ route('survey_reponse.submit', $survey->id) }}" method="POST">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h1>{{ $survey->title }}</h1>
                                    <p>{{ $survey->description }}</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="profession">Profession:</label>
                                        <select name="profession_id" class="form-select form-control" required>
                                            <option value="">Select your profession</option>
                                            @foreach ($professions as $profession)
                                                <option value="{{ $profession->id }}">{{ $profession->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            {{-- Display success message --}}
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @csrf
                            @foreach ($survey->questions as $index => $question)
                                <div class="form-group">
                                    <p class="m-0 font-bold">{{ $index + 1 }}. {{ $question->title }}</p>

                                    <div class="d-flex justify-content-between">
                                        <div class="form-check form-check-inline">
                                            <input id="question_{{ $question->id }}_agree" class="form-check-input"
                                                type="radio" name="responses[{{ $question->id }}]" value="agree"
                                                required>
                                            <label for="question_{{ $question->id }}_agree"
                                                class="form-check-label">Agree</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input id="question_{{ $question->id }}_disagree" class="form-check-input"
                                                type="radio" name="responses[{{ $question->id }}]" value="disagree"
                                                required>
                                            <label for="question_{{ $question->id }}_disagree"
                                                class="form-check-label">Disagree</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input id="question_{{ $question->id }}_not_applicble" class="form-check-input"
                                                type="radio" name="responses[{{ $question->id }}]" value="not_applicable"
                                                required>
                                            <label for="question_{{ $question->id }}_not_applicble"
                                                class="form-check-label">Not Applicable</label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit Survey</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
