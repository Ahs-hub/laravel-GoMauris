@extends('layouts.mainlayout') {{-- or use your custom layout like layouts.main --}}

@section('title', 'Booking Confirmation')

@section('content')
<div class="container text-center py-5" style="min-height: 60vh;">
        <h1 class="text-success mb-3">
            <i class="bx bx-check-circle"></i> Thank You!
        </h1>
        <p class="lead">Your booking request has been received successfully.</p>
        <p>Our team will get back to you within 24 hours with confirmation and further details.</p>
        <a href="{{ url('/') }}" class="btn btn-outline-primary mt-4">
            <i class="bx bx-home"></i> Back to Home
        </a>
</div>
@endsection
