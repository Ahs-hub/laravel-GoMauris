@extends('layouts.mainlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/taxipage.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/taxipage.css') }}">
    @endif

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Include Vue -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>

    <!-- Hero Section -->
    <section class="row hero-section d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8 text-center">
                    <h5>If you prefer WhatsApp, let's have a chat at</h5>
                    <h1 style="color:var(--white); font-weight:500;">+230 55040167</h1>
                </div>
            </div>

            <!-- Booking Form -->
            <div id="taxiApp" class="booking-form">
                <div class="col-lg-10 col-xl-8 text-center">
                    <div class="tour-info shadow p-4 p-md-5 rounded">
                    <!-- Step 1: Tour Details -->
                    <form v-if="step === 1" @submit.prevent="goToNext">
                        <div class="form-header text-center mb-4">
                        <h5 class="fw-bold">Let us assist you with your taxi booking</h5>
                        </div>

                        <h6 class="fw-semibold mb-3 text-start">Tour Details</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3 text-start">
                                <label for="pickup" class="form-label">Pick-up Location</label>
                                <input type="text" class="form-control" v-model="form.pickup" required>
                            </div>
                            <div class="col-md-6 mb-3 text-start">
                                <label for="destination" class="form-label">Destination</label>
                                <input type="text" class="form-control" v-model="form.destination" required>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-3 mb-4 text-start">
                        <div class="flex-fill">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control"  v-model="form.date" :min="minDate"  required>
                        </div>
                        <div class="flex-fill">
                            <label class="form-label">Time</label>
                            <input type="time" class="form-control" v-model="form.time" required>
                        </div>
                        <div class="flex-fill">
                            <label class="form-label">Passengers</label>
                            <input type="number" class="form-control" v-model="form.passengers" required>
                        </div>
                        </div>

                        <div class="mb-4 text-start">
                        <label class="form-label">Choose Ride Category</label>
                        <div class="d-flex flex-wrap gap-3">
                          <div class="form-check" v-for="option in ['Economy', 'Comfort', 'Luxury']" :key="option">
                            <input class="form-check-input" type="radio" :id="option" v-model="form.category" :value="option">
                            <label class="form-check-label" :for="option">@{{ option }}</label>
                          </div>
                        </div>
                        </div>

                        <div class="text-end">
                        <button class="btn text-white" style="background-color: var(--primary-color); width: 100px; font-weight: 600;">
                            Next
                        </button>
                        </div>
                    </form>

                    <!-- Step 2: About You -->
                    <form v-if="step === 2" @submit.prevent="submitForm">
                        <div class="form-header text-center mb-4">
                        <h5 class="fw-bold">About You</h5>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 text-start">
                                 <label class="form-label">Your Name</label>
                                 <input type="text" class="form-control" v-model="form.name" required>
                            </div>
                            <div class="col-md-6 mb-3 text-start">
                                 <label class="form-label">Your Email</label>
                                 <input type="email" class="form-control" v-model="form.email" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 text-start">
                                  <label class="form-label">Country</label>
                                 <input type="text" class="form-control" v-model="form.country" required>
                            </div>
                            <div class="col-md-6 mb-3 text-start">
                                  <label class="form-label">Mobile Number (Whatsapp)</label>
                                   <input type="text" class="form-control" placeholder="Include country/area codes. eg. +23052514555" v-model="form.mobile" required>
                            </div>
                        </div>

                        <div class="mb-3 text-start">
                        <label class="form-label">Your Comments</label>
                        <textarea class="form-control" rows="3" v-model="form.comments"></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-secondary" @click="step--">Back</button>
                        <button type="submit" class="btn text-white" style="background-color: var(--primary-color); font-weight: 600;">
                            Send Quote
                        </button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>


        </div>
    </section>

    <!-- About Taxi Services -->
    <section id="about" class="section-padding py-5 about-taxi">
        <div class="container">
            <div class="row align-items-center gy-4 gx-5">
                <!-- Image -->
                <div class="col-lg-6">
                    <div class="img-placeholder rounded overflow-hidden" style="height: 400px;">
                        <img src="{{ asset('images/cars/taxi_ride.jpg') }}"
                             alt="Taxi Ride"
                             style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;">
                    </div>
                </div>

                <!-- Text -->
                <div class="col-lg-6">
                    <div class="text-content">
                        <h2 class="section-title section-heading mb-3">Reliable Taxi Services Across Mauritius</h2>
                        <div style="width: 60px; height: 3px; background-color: #274993; margin: 0 auto 20px 0;"></div>
                        <p style="color: #262626; font-size: 1rem; line-height: 1.7;">
                            Explore Mauritius with ease and comfort using our trusted taxi services. Whether you’re arriving at the airport, heading to a hotel, or planning a full-day island tour, our professional drivers ensure a safe, smooth, and timely ride.
                        </p>
                        <p style="color: #262626; font-size: 1rem; line-height: 1.7;">
                            With 24/7 availability, fixed pricing, and clean, air-conditioned vehicles, we’re committed to making your travel across Mauritius worry-free. Book your ride today and discover the island your way.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section style="margin-top:100px;">
        <div class="container">
            <div class="row">
                <!-- Standard Taxi -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="card-front" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('../images/backgrounds/guidetourist.jpg');">
                            <h3 class="feature-title">STANDARD</h3>
                        </div>
                        <div class="card-back">
                            <h3 class="feature-title">STANDARD TAXI</h3>
                            <p class="feature-description">Affordable and convenient, our standard taxis are perfect for daily rides, city transfers, and short trips around Mauritius.</p>
                        </div>
                    </div>
                </div>

                <!-- Airport Transfer -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="card-front" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('../images/backgrounds/hiking.jpg');">
                            <h3 class="feature-title">AIRPORT TRANSFER</h3>
                        </div>
                        <div class="card-back">
                            <h3 class="feature-title">ON-TIME AIRPORT PICKUPS</h3>
                            <p class="feature-description">Start or end your trip stress-free with our reliable airport transfer services. Always punctual and ready to assist with luggage.</p>
                        </div>
                    </div>
                </div>

                <!-- Luxury Car -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="card-front" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('../images/backgrounds/price.jpg');">
                            <h3 class="feature-title">LUXURY CAR</h3>
                        </div>
                        <div class="card-back">
                            <h3 class="feature-title">PREMIUM COMFORT</h3>
                            <p class="feature-description">Travel in style with our luxury vehicles, offering spacious interiors, air-conditioning, and professional chauffeurs for VIP experiences.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<script>
    const { createApp } = Vue;

    createApp({
        data() {
            return {
                step: 1,
                form: {
                    pickup: '',
                    destination: '',
                    date: '',
                    time: '',
                    passengers: 1,
                    category: 'Economy',
                    name: '',
                    email: '',
                    country: '',
                    mobile: '',
                    comments: ''
                },
                minDate: ''
            };
        },
        mounted() {
            const today = new Date().toISOString().split('T')[0];
            this.minDate = today;
        },
        methods: {
            goToNext() {
                this.step = 2;
            },
            submitForm() {
                fetch("{{ route('taxi.booking.submit') }}", {
                    method: "POST",
                    headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify(this.form)
                })
                .then(async response => {
                    if (!response.ok) {
                    const text = await response.text();
                    console.error("Server response (not ok):", text);
                    alert("Submission failed. See console for details.");
                    throw new Error("Submission failed");
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    }
                })
                .catch(error => {
                    console.error("Fetch error:", error);
                });
            },
            resetForm() {
                this.step = 1;
                this.form = {
                    pickup: '',
                    destination: '',
                    date: '',
                    time: '',
                    passengers: 1,
                    category: 'Economy',
                    name: '',
                    email: '',
                    country: '',
                    mobile: '',
                    comments: ''
                };
            }
        }
    }).mount('#taxiApp');
</script>

@endsection
