@extends(request('type') === 'car' ? 'layouts.maincarlayout' : 'layouts.mainlayout')

@section('title', 'Booking Confirmation')

@section('content')
<div class="container text-center py-5" style="min-height: 60vh;">
        <h1 class="text-success mb-3">
            <i class="bx bx-check-circle"></i> Thank You!
        </h1>
        <p class="lead">Your request has been received successfully.</p>
        <p>Our team will get back to you within 24 hours with confirmation and further details.</p>
        <a href="{{ request('type') === 'car' ? url('/rent-cars') : url('/') }}" class="btn btn-outline-primary mt-4">
            <i class="bx bx-home"></i> Back to Home
        </a>
</div>
@endsection
