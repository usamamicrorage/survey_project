@extends('layouts/authlayout')
@section('content')
    <div class="row d-flex justify-content-center align-items-center" style="height: 100vh">
        <div class="col-md-4">
            <h4 class="text-center mb-4">Admin Login</h4>
            @if ($errors->any())
                <div class="alert alert-danger pt-2 pb-0">
                    <ol>
                        @foreach ($errors->all() as $error)
                            <strong>
                                @if (count($errors->all()) == 1)
                                    {{ $error }}
                                @else
                                    <li>
                                        {{ $error }}
                                    </li>
                                @endif
                            </strong>
                        @endforeach
                    </ol>
                </div>
            @endif
            <form class="mt-3" method="POST" action="{{ route('login.post') }}">
                @csrf
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" autofocus>
                    <label class="form-label" for="form2Example1">Email address</label>
                </div>

                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" name="password" id="form2Example2" class="form-control" />
                    <label class="form-label" for="form2Example2">Password</label>
                </div>


                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">
                    Sign in
                </button>

            </form>
        </div>
        </>
    @endsection
