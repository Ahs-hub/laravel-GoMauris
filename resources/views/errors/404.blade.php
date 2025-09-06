@extends('layouts.mainlayout')

@section('title', 'Server Error')

@section('content')
<div class="d-flex align-items-center justify-content-center vh-100 bg-light text-center">
    <div>
        <h1 class="display-1 fw-bold  mb-4">400</h1>
        <h2 class="h3 fw-semibold mb-3">Oops! Something went wrong.</h2>
        <p class="text-muted mb-4">
            We’re experiencing technical difficulties. Please try again later.
        </p>
        <a href="{{ url('/') }}" class="btn btn-primary btn-lg">
            Go Back Home
        </a>
    </div>
</div>
@endsection