@extends('layouts/app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="inline-block mx-4 my-3 text-end">
                        <a href="{{ route('questions.create', $survey_id) }}" class="btn btn-primary">Add More Questions</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered table-striped">

                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Question</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $c = 1;
                            @endphp
                            @foreach ($questions as $question)
                                <tr>
                                    <td>{{ $c }}</td>
                                    <td>{{ $question->title }}</td>
                                    <td>

                                    </td>
                                </tr>
                                @php
                                $c++;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper mt-4">
                        {{ $questions->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
