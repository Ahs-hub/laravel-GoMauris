@extends('layouts.mainlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/taxipage.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/taxipage.css') }}">
    @endif

    <!-- Hero Section -->
    <section class="hero-section text-center text-white d-flex align-items-center justify-content-center">
        <div>
            <h1 class="display-5 fw-bold">Your Ride Awaits</h1>
            <p class="lead">Book a taxi, airport transfer, or private ride — quick and reliable</p>
            <span style="font-size: 1rem;">Economy &gt; Comfort &gt; Luxury</span>
        </div>
    </section>

<!-- Taxi Booking Form -->
<section class="d-flex align-items-center justify-content-center taxi-booking-section" style="min-height: 100vh; padding:50px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="tour-info shadow p-4 rounded" style="background: white; border: 2px solid var(--primary-color); color: #2c3e50;">
                    <form id="taxiBookingForm">
                        <div class="form-header text-center mb-4">
                            <h5 class="fw-bold">Let us assist you with your taxi booking</h5>
                            <h6>If you prefer WhatsApp, chat with us at 
                                <span style="color:var(--secondary-color); font-weight:600;">
                                    <a href="https://wa.me/23055040167" target="_blank" class="whatsapp-link" style="text-decoration:none;">
                                        +230 55040167
                                    </a>
                                </span>
                            </h6>
                        </div>

                        <h5 class="mb-3 fw-semibold">Enter your tour details:</h5>

                        <div class="mb-3">
                            <label class="form-label">Pick-up Location</label>
                            <input type="text" class="form-control" id="pickup" placeholder="Enter pick-up address" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Destination</label>
                            <input type="text" class="form-control" id="destination" placeholder="Where are you going?" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Time</label>
                                <input type="time" class="form-control" id="time" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Passengers</label>
                            <select class="form-select" id="passengers">
                                <option>1 Passenger</option>
                                <option>2 Passengers</option>
                                <option>3 Passengers</option>
                                <option>4+ Passengers</option>
                            </select>
                        </div>

                        <!-- Category Selection -->
                        <div class="mb-4">
                            <label class="form-label">Category</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="category" value="Economy" checked>
                                <label class="form-check-label">Economy (Shared ride)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="category" value="Comfort">
                                <label class="form-check-label">Comfort (Private car)</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="category" value="Luxury">
                                <label class="form-check-label">Luxury (Premium SUV)</label>
                            </div>
                        </div>

                        <button type="submit" class="btn w-100 text-white" style="background-color: var(--primary-color); font-weight: 600;">
                            Book Now via WhatsApp
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

  <!-- Trust Section -->
  <section class="trust-section text-center py-5">
        <div class="container">
            <h4 class="fw-bold mb-3">Why Travel With Us?</h4>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <i class='bx bx-shield fs-2 text-success'></i>
                    <p>Safe & Trusted Drivers</p>
                </div>
                <div class="col-md-4">
                    <i class='bx bx-timer fs-2 text-primary'></i>
                    <p>On-Time Pickups</p>
                </div>
                <div class="col-md-4">
                    <i class='bx bx-wallet-alt fs-2 text-warning'></i>
                    <p>Affordable Pricing</p>
                </div>
            </div>
        </div>
    </section>

    <script>
    document.getElementById("taxiBookingForm").addEventListener("submit", function (e) {
        e.preventDefault(); // Stop default form submission

        const pickup = document.getElementById("pickup").value;
        const destination = document.getElementById("destination").value;
        const date = document.getElementById("date").value;
        const time = document.getElementById("time").value;
        const passengers = document.getElementById("passengers").value;
        const category = document.querySelector('input[name="category"]:checked').value;

        const code = "TX" + Math.floor(100000 + Math.random() * 900000); // Random booking code
        const phoneNumber = "23059298905"; // Your WhatsApp number

        const message = `Hello, I would like to book a taxi.\n\n` +
            `📍 Pickup: ${pickup}\n` +
            `📍 Destination: ${destination}\n` +
            `📅 Date: ${date}\n` +
            `⏰ Time: ${time}\n` +
            `👥 Passengers: ${passengers}\n` +
            `🚗 Category: ${category}\n` +
            `🔖 Booking Code: ${code}`;

        const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
        window.open(whatsappUrl, "_blank");
    });
</script>


@endsection