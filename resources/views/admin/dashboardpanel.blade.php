@extends('layouts.adminlayout') {{-- Or your base layout --}}

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class=" border-0 rounded-4">
                <div class="card-body text-center p-5">
                    <i class='bx bxs-dashboard bx-lg text-primary mb-4'></i>
                    <h2 class="mb-3">Welcome to Your Admin Dashboard</h2>
                    <p class="fs-5 text-muted">
                        You are now in control of your <strong>Tour & Car Rental</strong> operations. Use the dashboard to manage tours, vehicles, and bookings effortlessly.
                    </p>
                    <p class="text-secondary">Let’s make travel easier for your customers!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection