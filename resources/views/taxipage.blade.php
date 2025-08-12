@extends('layouts.mainlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/taxipage.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/taxipage.css') }}">
    @endif

    <!-- for location map -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    />
   <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Include Vue -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>

    <!-- Hero Section -->
    <section class="row hero-section d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8 text-center">
                    <h5>If you prefer WhatsApp, let's have a chat at</h5>
                    <a href="https://wa.me/23055040167" target="_blank" class="whatsapp-link" style="text-decoration:none;">
                         <h1 style="color:var(--white); font-weight:500;">+230 55040167</h1>
                    </a>
                    
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
                                <!-- <input type="text" class="form-control" v-model="form.pickup" required> -->
                                <div class="dropdown form-control p-0 ">
                                    <button class="btn selectinput-place dropdown-toggle w-100 text-start d-flex align-items-center justify-content-between"
                                            type="button" data-bs-toggle="dropdown">
                                            <div>
                                                <i class='bx bx-map me-2'></i> 
                                                @{{ form.pickup || 'Select pick up location' }}
                                            </div>
                                    </button>
                                    <ul class="dropdown-menu w-100">
                                        <li @click="form.pickup = 'SSR Airport';  form.pickup_latitude = -20.431997;  form.pickup_longitude = 57.676868;" class="dropdown-item">
                                            <i class='bx bx-map'></i> SSR Airport
                                        </li>
                                        <li @click="form.pickup = 'Mahebourg'; form.pickup_latitude = -20.408056; form.pickup_longitude = 57.7;" class="dropdown-item">
                                            <i class='bx bx-map'></i> Mahebourg
                                        </li>
                                        <li @click="form.pickup = 'Port Louis'; form.pickup_latitude = -20.160891; form.pickup_longitude = 57.501222;" class="dropdown-item">
                                            <i class='bx bx-map'></i> Port Louis
                                        </li>
                                        <li @click="form.pickup = 'Grand Baie'; form.pickup_latitude = -20.013053; form.pickup_longitude = 57.580440;" class="dropdown-item">
                                            <i class='bx bx-map'></i> Grand Baie
                                        </li>
                                        <li class=" dropdown-item" @click="openMap('pickup')">
                                            <i class='bx bx-map-pin'></i> Choose on map
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <div class="col-md-6 mb-3 text-start">
                                <label for="destination" class="form-label">Destination</label>
                                <!-- <input type="text" class="form-control" v-model="form.destination" required> -->
                                <div class="dropdown form-control p-0 ">
                                    <button class="btn selectinput-place dropdown-toggle w-100 text-start d-flex align-items-center justify-content-between"
                                            type="button" data-bs-toggle="dropdown">
                                            <div>
                                                <i class='bx bx-map me-2'></i> 
                                                @{{ form.destination || 'Select return up location' }}
                                            </div>
                                    </button>
                                    <ul class="dropdown-menu w-100">
                                        <li @click="form.destination  = 'SSR Airport'; form.destination_latitude = -20.431997; form.destination_longitude = 57.676868;" class="dropdown-item">
                                            <i class='bx bx-map'></i> SSR Airport
                                        </li>
                                        <li @click="form.destination  = 'Mahebourg'; form.destination_latitude = -20.408056; form.destination_longitude = 57.7;" class="dropdown-item">
                                            <i class='bx bx-map'></i> Mahebourg
                                        </li>
                                        <li @click="form.destination  = 'Port Louis'; form.destination_latitude = -20.160891; form.destination_longitude = 57.501222;" class="dropdown-item">
                                            <i class='bx bx-map'></i> Port Louis
                                        </li>
                                        <li @click="form.destination  = 'Grand Baie'; form.destination_latitude = -20.013053; form.destination_longitude =  57.580440;" class="dropdown-item">
                                            <i class='bx bx-map'></i> Grand Baie
                                        </li>
                                        <li class="dropdown-item" @click="openMap('destination')">
                                            <i class='bx bx-map-pin'></i> Choose on map
                                        </li>
                                    </ul>
                                </div>

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
                            <div class="row g-3">
                                <div class="col-6 col-md-3" v-for="option in [
                                    { name: 'Economy', img: '{{ asset('images/services/economy_small.png') }}', passengers: 3, luggage: 3 },
                                    { name: 'Comfort', img: '{{ asset('images/services/comfort_small.png') }}', passengers: 3, luggage: 3 },
                                    { name: 'Business', img: '{{ asset('images/services/business_small.png') }}', passengers: 3, luggage: 3 },
                                    { name: 'Minibus', img: '{{ asset('images/services/minibus_small.png') }}', passengers: 16, luggage: 16 }
                                ]" :key="option.name">
                                    <div class="vehicle-card"
                                        :class="{ active: form.category === option.name }"
                                        @click="form.category = option.name">
                                        <input type="radio" class="d-none"
                                            :id="option.name"
                                            v-model="form.category"
                                            :value="option.name">
                                        <img :src="option.img" :alt="option.name">
                                        <div class="fw-bold">@{{ option.name }}</div>
                                        <div class="vehicle-info">
                                            <i class='bx bx-user'></i> x @{{ option.passengers }}
                                            <i class='bx bx-briefcase'></i> x @{{ option.luggage }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-end">
                            <button class="btn text-white" style="background-color: var(--primary-color); width: 100px; font-weight: 600;">
                                Next
                            </button>
                        </div>
                    </form>

                    <!-- Step 2: Taxi Detail -->

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
                                   <input type="text" class="form-control" placeholder="Include country/area codes. eg. +23052514555" v-model="form.phone" required>
                            </div>
                        </div>

                        <div class="mb-3 text-start">
                        <label class="form-label">Your Comments</label>
                        <textarea class="form-control" rows="3" v-model="form.comments"></textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" @click="step--">Back</button>
                            <!-- Send Button (hide when loading) -->
                            <button
                                v-if="!loading"
                                type="submit"
                                class="btn text-white"
                                style="background-color: var(--primary-color); font-weight: 600;"
                            >
                                Get Offers
                            </button>

                            <!-- Spinner (show when loading) -->
                            <div v-if="loading" class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>

                <!-- Map Modal -->
                <div v-if="showMapModal" class="modal" tabindex="-1" style="display: block;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5>Select Location on Map</h5>
                            <button type="button" class="btn-close" @click="showMapModal = false"></button>
                        </div>
                        <div class="modal-body" style="height: 400px;">
                            <div :key="showMapModal" id="map" style="height: 100%;"></div>
                        </div>
                        <div class="modal-footer d-flex justify-content-end">
                            <span style="width: 500px;"></span>
                            <button class="btn btn-primary"  @click="confirmLocation">Select</button>
                        </div>
                        </div>
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
                        <div class="card-front" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('../images/services/taxi_ride.png');">
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
                        <div class="card-front" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('../images/services/private_airport_transfer.png');">
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
                        <div class="card-front" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('../images/services/luxury_airport_transfer.png');">
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
                loading: false,
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
                    phone: '',
                    comments: '',
                    
                    //location map
                    pickup_latitude: null,
                    pickup_longitude: null,
                    destination_latitude: null,
                    destination_longitude: null
                },

                showMapModal: false,
                selectedLatLng: null,
                mapInstance: null,
                marker: null,
                mapTarget: '', // can be 'pickup' or 'return'

                minDate: ''
            };
        },
        mounted() {
            const today = new Date().toISOString().split('T')[0];
            this.minDate = today;
        },
        watch: {
            showMapModal(Val) {
                if (Val) {
                this.$nextTick(() => {
                    this.initMap();
                });
                }
            }
        },
        methods: {
            goToNext() {
                this.step = 2;
            },
            submitForm() {
                this.loading = true;
                
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
                })
                .finally(() => {
                    this.loading = false;
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
                    phone: '',
                    comments: '',
                    pickup_latitude: null,
                    pickup_longitude: null,
                    destination_latitude: null,
                    destination_longitude: null
                };
            },
            openMap(target) {
                this.mapTarget = target; // 'pickup' or 'return'
                this.showMapModal = true;
            },
            initMap() {
                // If already created, destroy it cleanly
                if (this.mapInstance) {
                this.mapInstance.off();         // Remove all event listeners
                this.mapInstance.remove();      // Remove the map instance
                this.mapInstance = null;
                }

                // Clear previous selection
                this.selectedLatLng = null;
                this.marker = null;

                // Initialize new map
                this.mapInstance = L.map('map').setView([-20.2, 57.5], 10);

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
                }).addTo(this.mapInstance);

                // Add marker on click
                this.mapInstance.on('click', (e) => {
                const { lat, lng } = e.latlng;
                this.selectedLatLng = { lat, lng };

                if (this.marker) {
                    this.marker.setLatLng(e.latlng);
                } else {
                    this.marker = L.marker(e.latlng).addTo(this.mapInstance);
                }
                });
            },

            async confirmLocation() {
                if (this.selectedLatLng) {
                    const { lat, lng } = this.selectedLatLng;
                    const address = await this.reverseGeocodeWithNominatim(lat, lng);

                    if (this.mapTarget === 'pickup') {
                        this.form.pickup = address;
                        this.form.pickup_latitude = lat;
                        this.form.pickup_longitude = lng;
                    } else if (this.mapTarget === 'destination') {
                        this.form.destination = address;
                        this.form.destination_latitude = lat;
                        this.form.destination_longitude = lng;
                    }

                    this.showMapModal = false;
                } else {
                    alert('Please select a location on the map');
                }
            },

            async reverseGeocodeWithNominatim(lat, lng) {
                const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`;

                try {
                    const response = await fetch(url);
                    const data = await response.json();

                    if (data && data.address) {
                        const addr = data.address;
                        const village = addr.village || addr.town || addr.suburb || '';
                        const county = addr.county || '';
                        const road = addr.road || '';
                        const parts = [village, county, road].filter(Boolean);
                        return parts.join(', ');
                    } else {
                        return 'Unknown location';
                    }
                } catch (error) {
                    console.error('Reverse geocoding failed:', error);
                    return 'Unknown location';
                }
            }
        }
    }).mount('#taxiApp');
</script>

@endsection
