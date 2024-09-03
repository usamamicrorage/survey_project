@extends('layouts.app')

@section('content')
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center pt-4"> {{ $mode == 'edit' ? 'Update' : 'Add' }} Profession</h3>
                </div>
                <div class="card-body">
                    <form method="post"
                        action="{{ $mode == 'edit' ? route('profession.update', $profession) : route('profession.store') }}">
                        @if ($mode == 'edit')
                            @method('PUT')
                        @endif
                        @csrf
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input id="form2Example1" type="text" value="{{ $mode == 'edit' ? $profession->title : '' }}"
                                class="form-control" name="title">
                            <label class="form-label" for="form2Example1">Enter Title</label>
                        </div>

                        <button type="submit"
                            class="btn btn-{{ $mode == 'edit' ? 'warning' : 'primary' }} bt-sm btn-block mb-4">{{ $mode == 'edit' ? 'Update' : 'Save' }}
                            Profession</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-head pt-3 px-3">
                    <h3>Professions List</h3>
                </div>
                <hr>
                <div class="card-body">
                    <table class="table table-sm table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-end">Sr#</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($professions) > 0)
                                @php
                                    $c = 1;
                                @endphp
                                @foreach ($professions as $profession)
                                    <tr>
                                        <td class="text-end">{{ $c }}</td>
                                        <td> {{ $profession->title }} </td>
                                        <td>
                                            <a href="{{ route('profession.edit', $profession) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('profession.destroy', $profession) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this?');"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php $c++ @endphp
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3" class="text-center">No Professions, Create One..</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    <div class="pagination-wrapper mt-4">
                        {{ $professions->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
