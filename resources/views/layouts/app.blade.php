<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>{{ $title }} - AI Survey </title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="{{ URL::asset('assets/css/mdb.min.css') }}" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <a class="navbar-brand mt-2 mt-lg-0" href="{{ route('dashboard') }}">
                AI Survey
            </a>
            <!-- Toggle button -->
            <button data-mdb-collapse-init class="navbar-toggler" type="button"
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <!-- Centered Links -->
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}"
                            href="{{ route('dashboard') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('profession.index') || Route::is('profession.edit') ? 'active' : '' }}"
                            href="{{ route('profession.index') }}">Professions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('survey.index') ? 'active' : '' }}"
                            href="{{ route('survey') }}">Surveys</a>
                    </li>
                </ul>
            </div>
            <!-- Collapsible wrapper -->
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
    <!-- Start your project here-->
    <div class="container">
        <div class="row mt-2">
            <div class="col-md-6 offset-md-3">
                @if ($errors->any())
                    <div class="alert alert-danger p-0">
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
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
            </div>
        </div>
        @yield('content')
    </div>
    <!-- End your project here-->

    <!-- MDB -->
    <script type="text/javascript" src="{{ URL::asset('assets/js/mdb.umd.min.js') }}"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
</body>

</html>
