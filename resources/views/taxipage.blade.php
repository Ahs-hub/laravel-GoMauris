@extends('layouts.mainlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/taxipage.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/taxipage.css') }}">
    @endif

    <!-- Taxi Hero Section -->
<div style="background-color: var(--primary-color);" class="hero-section">
    <div class="container py-5">
        <div class="row align-items-center">
            <!-- Left: Booking Form -->
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="card shadow p-4">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Pick-up Location</label>
                            <input type="text" class="form-control" placeholder="Enter pick-up address">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Destination</label>
                            <input type="text" class="form-control" placeholder="Where are you going?">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Date</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Time</label>
                                <input type="time" class="form-control">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Passengers</label>
                            <select class="form-control">
                                <option>1 Passenger</option>
                                <option>2 Passengers</option>
                                <option>3 Passengers</option>
                                <option>4+ Passengers</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-book w-100">Next</button>
                        <div class="text-center mt-2">
                            Need an Airport Transfer?
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right: Hero Text -->
            <div class="col-md-6 text-center text-md-start">
                <div class="right-content">
                    <h1 class="hero-title">
                        Your Reliable<br>
                        <span class="highlight">Taxi Service</span> in<br>
                        Mauritius
                    </h1>
                    <p class="subheading">
                        Fast, safe, and comfortable rides across Mauritius. 
                        Available 24/7 with professional drivers.
                    </p>
                    <ul class="feature-list list-unstyled">
                        <li><i class='bx bx-check-circle'></i> 24/7 Availability</li>
                        <li><i class='bx bx-check-circle'></i> Professional Drivers</li>
                        <li><i class='bx bx-check-circle'></i> Clean & Safe Vehicles</li>
                        <li><i class='bx bx-check-circle'></i> Competitive Rates</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Taxi Info Section -->
<div style="background-color: var(--primary-color)">
    <div class="container ">
        <div class="row align-items-center">
            <!-- Left: Text -->
            <div class="col-md-6 order-2 order-md-1 text-center text-md-start" style="color:white;">
                <h1 class="section-heading">Your Toyota Alphard will provide comfort for your trip</h1>
                <p  class="subheading">Prefer calling?</p>
                <p class="paragraph-text">Call us on: <strong>+230 55040167</strong></p>
            </div>

            <!-- Right: Image -->
            <div class="col-md-6 order-1 order-md-2 text-center">
                <img src="{{ asset('images/cars/taxi_trans.png') }}" alt="White Van Taxi" class="img-fluid">
            </div>
        </div>
    </div>
</div>

<section class="info-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Hero Title -->
                <div class="text-center mb-5" style="color:grey;">
                    <h1 class="section-heading">Taking You Places, Making Moments</h1>
                    <p class="lead">Your trusted taxi service in beautiful Mauritius</p>
                </div>

                <!-- Features Grid -->
                <div class="row">
                    <!-- Airport Transfers -->
                    <div class="col-md-6 col-lg-4 card-container"  >
                        <div class="feature-card h-100">
                            <i class='bx bxs-plane-take-off  feature-icon'></i>
                            <h5 class="feature-title">Seamless Airport Transfers</h5>
                            <p class="feature-text">Arriving in a new country should be stress-free! Our Mauritius airport taxis provide private airport transfers with a diverse fleet to suit your needs.</p>
                        </div>
                    </div>

                    <!-- Best Prices -->
                    <div class="col-md-6 col-lg-4 card-container">
                        <div class="feature-card h-100">
                            <i class='bx bx-money  feature-icon'></i>
                            <h5 class="feature-title">Best Prices – Transparent & Competitive</h5>
                            <p class="feature-text">Our prices are up to 40% cheaper than hotel and airport taxis, with no hidden fees. Cancel 24 hours in advance with full flexibility.</p>
                        </div>
                    </div>

                    <!-- Safety First -->
                    <div class="col-md-6 col-lg-4 card-container">
                        <div class="feature-card h-100">
                            <i class='bx bx-check feature-icon'></i>
                            <h5 class="feature-title">Safety First – Certified & Trusted</h5>
                            <p class="feature-text">Drivers follow strict safety protocols. Our TRAVELHUB team inspects vehicles regularly. Emergency support hotline is available.</p>
                        </div>
                    </div>

                    <!-- Easy Booking -->
                    <div class="col-md-6 col-lg-4 card-container">
                        <div class="feature-card h-100">
                            <i class='bx bx-mobile  feature-icon'></i>
                            <h5 class="feature-title">Easy Online Booking</h5>
                            <p class="feature-text">Book your taxi online, via WhatsApp or email. At least 24-hour notice ensures quality service.</p>
                        </div>
                    </div>

                    <!-- Tourist Transport -->
                    <div class="col-md-6 col-lg-4 card-container">
                        <div class="feature-card h-100">
                            <i class='bx bx-map-alt feature-icon'></i>
                            <h5 class="feature-title">Tourist Transport Tailored for You</h5>
                            <p class="feature-text">Unlike Uber, we take bookings 1 day in advance and personalize your ride (child seat, luggage, sightseeing stops, etc).</p>
                        </div>
                    </div>

                    <!-- Ethical Service -->
                    <div class="col-md-6 col-lg-4 card-container">
                        <div class="feature-card h-100">
                            <i class='bx bx-block feature-icon'></i>
                            <h5 class="feature-title">No Unwanted Shop Stops</h5>
                            <p class="feature-text">No commission stops. We follow a strict "No Shop Stop" policy. Violators are suspended immediately.</p>
                        </div>
                    </div>
                </div>

                <!-- Rating and Locations -->
                <!-- <div class="row mt-5 feature-card card-container">
                    <div class="location-list">
                        <div class="d-flex align-items-center mb-3">
                            <i class='bx bxs-star text-warning me-2 bx-sm'></i>
                            <h4 class="mb-0">5-Star Rated Taxi Service</h4>
                            <span class="rating-badge ms-3">5/5 Rating</span>
                        </div>
                        <p class="mb-3 text-muted">Trusted by thousands on TripAdvisor & Google. Serving areas including:</p>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="location-item mb-2">
                                    <i class='bx bxs-car bx-sm me-2'></i> Flic en Flac
                                </div>
                                <div class="location-item mb-2">
                                    <i class='bx bxs-car bx-sm me-2'></i> Port Louis
                                </div>
                                <div class="location-item mb-2">
                                    <i class='bx bxs-car bx-sm me-2'></i> Grand Bay
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="location-item mb-2">
                                    <i class='bx bxs-car bx-sm me-2'></i> Belle Mare
                                </div>
                                <div class="location-item mb-2">
                                    <i class='bx bxs-car bx-sm me-2'></i> Bel Ombre
                                </div>
                                <div class="location-item mb-2">
                                    <i class='bx bxs-car bx-sm me-2'></i> And many more!
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

            </div> <!-- col-lg-10 -->
        </div> <!-- row -->
    </div> <!-- container -->
</section>


@endsection