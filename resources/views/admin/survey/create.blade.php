@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3>Create a new Survey</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('survey.store') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <div class="col-md-8">
                            <label for="title">Survey Title</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="col-md-4">
                            <label for="status">Status</label>
                            <select class="form-select form-control" id="status" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="title">Survey Description</label>
                        <textarea name="description" id="" cols="30" rows="3" class="form-control"></textarea>
                    </div>


                    <button type="submit" class="btn btn-primary mt-2 bt-sm btn-block mb-4">
                        Create Survey</button>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection