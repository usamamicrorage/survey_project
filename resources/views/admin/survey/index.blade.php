@extends('layouts/app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="inline-block mx-4 my-3 text-end">
                        <a href="{{ route('survey.create') }}" class="btn btn-primary">Create New Survey</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Sr#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Total Questions</th>
                                <th>Status</th>
                                <th>Total Responses</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $c = 1;
                            @endphp
                            @if (count($surveys) > 0)
                                @foreach ($surveys as $survey)
                                    <tr>
                                        <td>{{ $c }}</td>
                                        <td>{{ $survey->title }}</td>
                                        <td>{{ Str::limit($survey->description, 150) }}</td>
                                        <td>
                                            <span
                                                class="mx-2 badge bg-{{ $survey->questions_count == 0 ? 'danger' : 'success' }}">
                                                {{ $survey->questions_count }}
                                            </span>
                                            @if ($survey->questions_count == 0)
                                                <a class="btn btn-dark btn-sm"
                                                    href="{{ route('questions.create', $survey->id) }}">Add</a>
                                            @endif
                                            @if ($survey->questions_count > 0)
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ route('questions.show', $survey->id) }}">View</a>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $survey->status == 1 ? 'success' : 'danger' }}">
                                                {{ $survey->status == 1 ? 'Active' : 'InActive' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $survey->totalResponses() == 0 ? 'danger' : 'success' }}">
                                                {{ $survey->totalResponses() }}
                                            </span>
                                            @if ($survey->totalResponses() > 0)
                                                <a class="btn btn-dark btn-sm" href="javascript:void(0)">Analysis</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('survey.public.link', $survey->id) }}"
                                                class="btn btn-secondary btn-sm" target="_blank">Link</a>

                                        </td>
                                    </tr>
                                    @php
                                        $c++;
                                    @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No Survey Exists! Create One..</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="pagination-wrapper mt-4">
                        {{ $surveys->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
