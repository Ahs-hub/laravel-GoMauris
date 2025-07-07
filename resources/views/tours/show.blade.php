
@extends('layouts.mainlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/home.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @endif

    <style>
            .error-page {
                text-align: center;
                margin-top: 100px;
                font-family: Arial, sans-serif;
            }
            .error-page h1 {
                font-size: 3rem;
                color: #dc3545; /* Bootstrap danger color */
            }
            .error-page p {
                font-size: 1.25rem;
                color: #555;
            }
            .error-page a {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #007bff;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            }
            .error-page a:hover {
                background-color: #0056b3;
            }
    </style>

    <div class="container text-center my-5">
        <h1 class="display-4 text-danger">404 - Page Not Found</h1>
        <p class="lead">Oops! The page you’re looking for doesn’t exist or has been moved.</p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go Back Home</a>
     </div>

    <script src="{{ asset('js/style.js') }}"></script>

@endsection