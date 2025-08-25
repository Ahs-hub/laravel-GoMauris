@extends('layouts.mainlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/taxipage.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/taxipage.css') }}">
    @endif

    @php
        // Remove spaces and plus signs
        $whatsappNumber = isset($siteSettings->whatsapp) 
            ? preg_replace('/[\s+]/', '', $siteSettings->whatsapp) 
            : '';
     @endphp

    <!-- Leaflet CSS -->
    <link 
        rel="stylesheet" 
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
    />
    
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Include Vue -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    
    <div style="overflow-y:hidden;">
        <!-- Hero Section -->
        <section class="row hero-section d-flex align-items-center" >
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-8 text-center">
                        <h5>{{ __('messages.call_hero_title') }}</h5>
                        <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="whatsapp-link" style="text-decoration:none;">
                            <h1 style="color:var(--white); font-weight:500;">{{ $siteSettings->whatsapp }}</h1>
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
                            <h5 class="fw-bold">{{ __('messages.call_bookingform_title') }}</h5>
                            </div>

                            <h6 class="fw-semibold mb-3 text-start">{{ __('messages.tour_details') }}</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3 text-start">
                                    <label for="pickup" class="form-label">{{ __('messages.pick_up_location') }}</label>
                                    <!-- <input type="text" class="form-control" v-model="form.pickup" required> -->
                                    <div class="dropdown form-control p-0 ">
                                        <button class="btn selectinput-place dropdown-toggle w-100 text-start d-flex align-items-center justify-content-between"
                                                type="button" data-bs-toggle="dropdown">
                                                <div>
                                                    <i class='bx bx-map me-2'></i> 
                                                    @{{ form.pickup || defaultPickupText  }}
                                                </div>
                                        </button>
                                        <ul class="dropdown-menu w-100">
                                            <li class="dropdown-item" @click="getCurrentLocationFor('pickup')">
                                                <i class='bx bx-map'></i> {{ __('messages.use_current_location') }}
                                            </li>

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
                                                <i class='bx bx-map-pin'></i> {{ __('messages.choose_on_map') }}
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                                <div class="col-md-6 mb-3 text-start">
                                    <label for="destination" class="form-label">{{ __('messages.destination') }}</label>
                                    <!-- <input type="text" class="form-control" v-model="form.destination" required> -->
                                    <div class="dropdown form-control p-0 ">
                                        <button class="btn selectinput-place dropdown-toggle w-100 text-start d-flex align-items-center justify-content-between"
                                                type="button" data-bs-toggle="dropdown">
                                                <div>
                                                    <i class='bx bx-map me-2'></i> 
                                                    @{{ form.destination || defaultReturnText }}
                                                </div>
                                        </button>
                                        <ul class="dropdown-menu w-100">

                                            <li class="dropdown-item" @click="getCurrentLocationFor('destination')">
                                                <i class='bx bx-map'></i> {{ __('messages.use_current_location') }}
                                            </li>
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
                                                <i class='bx bx-map-pin'></i> {{ __('messages.choose_on_map') }}
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-3 mb-4 text-start">
                                <div class="flex-fill">
                                    <label class="form-label">{{ __('messages.date') }}</label>
                                    <input type="date" class="form-control"  v-model="form.date" :min="minDate"  required>
                                </div>
                                <div class="flex-fill">
                                    <label class="form-label">{{ __('messages.time') }}</label>
                                    <input type="time" class="form-control" v-model="form.time" required>
                                </div>
                                <div class="flex-fill">
                                    <label class="form-label">{{ __('messages.passengers') }}</label>
                                    <input type="number" class="form-control" v-model="form.passengers" required>
                                </div>
                            </div>

                            <div class="form-check mb-3 text-start">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="has_return_ride"
                                    v-model="form.has_return_ride"
                                >
                                <label class="form-check-label" for="has_return_ride">
                                   {{ __('messages.add_return_ride') }}
                                </label>
                            </div>

                            <!-- Show return date/time only if checkbox is checked -->
                            <div v-if="form.has_return_ride" class="d-flex flex-wrap gap-3 mb-4 text-start">
                                <div class="flex-fill">
                                    <label class="form-label"> {{ __('messages.return_date') }}</label>
                                    <input
                                        type="date"
                                        class="form-control"
                                        v-model="form.return_date"
                                        :min="minDate"
                                    >
                                </div>
                                <div class="flex-fill">
                                    <label class="form-label">{{ __('messages.return_time') }}</label>
                                    <input
                                        type="time"
                                        class="form-control"
                                        v-model="form.return_time"
                                    >
                                </div>
                            </div>

                            <div class="text-end">
                                <button class="btn text-white" style="background-color: var(--primary-color); width: 100px; font-weight: 600;">
                                   {{ __('messages.next') }}
                                </button>
                            </div>
                        </form> 

                    <!-- Step 2: Taxi Detail -->
                        <form v-if="step ===2" @submit.prevent="goToNext">
                            <div class="form-header text-center mb-4">
                                <h5 class="fw-bold">{{ __('messages.choose_your_ride') }}</h5>
                            </div>
                                    
                            <div class="mb-4 text-start">
                                <label class="form-label">{{ __('messages.choose_ride_category') }}</label>

                                <div class="row g-3">
                                    <div class="col-6 col-md-3" v-for="option in rideOptions" :key="option.value">
                                        <div class="vehicle-card"
                                            :class="{ active: form.category === option.value }"
                                            @click="form.category = option.value">

                                            <input type="radio" class="d-none"
                                                :id="option.value"
                                                v-model="form.category"
                                                :value="option.value">

                                            <img :src="option.img" :alt="option.label">

                                            <div class="fw-bold">@{{ option.label }}</div>
                                            <div class="vehicle-info">
                                                <i class='bx bx-user'></i> x @{{ option.passengers }}
                                                <i class='bx bx-briefcase'></i> x @{{ option.luggage }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 text-start">
                                <label class="form-label">{{ __('messages.child_seat') }}</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    v-model.number="form.child_seat"
                                    min="0"
                                    max="5"
                                >
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" @click="step--">{{ __('messages.back') }}</button>
                                <div class="text-end">
                                    <button class="btn text-white" style="background-color: var(--primary-color); width: 100px; font-weight: 600;">
                                        {{ __('messages.next') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <!-- Step 3: About You -->
                        <form v-if="step === 3" @submit.prevent="submitForm">
                            <div class="form-header text-center mb-4">
                                <h5 class="fw-bold">{{ __('messages.about_you') }}</h5>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3 text-start">
                                    <label class="form-label">{{ __('messages.your_name') }}</label>
                                    <input type="text" class="form-control" v-model="form.name" required>
                                </div>
                                <div class="col-md-6 mb-3 text-start">
                                    <label class="form-label">{{ __('messages.your_email') }}</label>
                                    <input type="email" class="form-control" v-model="form.email" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3 text-start">
                                    <label class="form-label">{{ __('messages.country') }}</label>
                                    <input type="text" class="form-control" v-model="form.country" required>
                                </div>
                                <div class="col-md-6 mb-3 text-start">
                                    <label class="form-label">{{ __('messages.mobile_number_whatsapp') }}</label>
                                    <input type="text" class="form-control" placeholder="Include country/area codes. eg. +23052514555" v-model="form.phone" required>
                                </div>
                            </div>

                            <div class="mb-3 text-start">
                            <label class="form-label">{{ __('messages.your_comments') }}</label>
                            <textarea class="form-control" rows="3" v-model="form.comments"></textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" @click="step--">{{ __('messages.back') }}</button>
                                <!-- Send Button (hide when loading) -->
                                <button
                                    v-if="!loading"
                                    type="submit"
                                    class="btn text-white"
                                    style="background-color: var(--primary-color); font-weight: 600;"
                                >
                                     {{ __('messages.get_offers') }}
                                </button>

                                <!-- Spinner (show when loading) -->
                                <div v-if="loading" class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">{{ __('messages.loading') }}...</span>
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
                                <h5>{{ __('messages.select_location_on_map') }}</h5>
                                <button type="button" class="btn-close" @click="showMapModal = false"></button>
                            </div>
                            <div class="modal-body" style="height: 400px;">
                                <div :key="showMapModal" id="map" style="height: 100%;"></div>
                            </div>
                            <div class="modal-footer d-flex justify-content-end">
                                <span style="width: 500px;"></span>
                                <button class="btn btn-primary"  @click="confirmLocation">{{ __('messages.select') }}</button>
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
                            <h2 class="section-title section-heading mb-3">{{ __('messages.about_taxi_text') }}</h2>
                            <div style="width: 60px; height: 3px; background-color: #274993; margin: 0 auto 20px 0;"></div>
                            <p style="color: #262626; font-size: 1rem; line-height: 1.7;">
                            {{ __('messages.about_taxi_paragraph_one') }}
                            </p>
                            <p style="color: #262626; font-size: 1rem; line-height: 1.7;">
                            {{ __('messages.about_taxi_paragraph_two') }}
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
                                <h3 class="feature-title"> {{ __('messages.standard') }}</h3>
                            </div>
                            <div class="card-back">
                                <h3 class="feature-title">{{ __('messages.standard_taxi') }}</h3>
                                <p class="feature-description">{{ __('messages.standard_taxi_description') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Airport Transfer -->
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card">
                            <div class="card-front" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('../images/services/private_airport_transfer.png');">
                                <h3 class="feature-title">{{ __('messages.airport_transfer') }}</h3>
                            </div>
                            <div class="card-back">
                                <h3 class="feature-title">{{ __('messages.on_time_airport_pickup') }}</h3>
                                <p class="feature-description">{{ __('messages.airport_transfer_description') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Luxury Car -->
                    <div class="col-lg-4 col-md-6">
                        <div class="feature-card">
                            <div class="card-front" style="background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('../images/services/luxury_airport_transfer.png');">
                                <h3 class="feature-title">{{ __('messages.luxury_car') }}</h3>
                            </div>
                            <div class="card-back">
                                <h3 class="feature-title">{{ __('messages.premium_comfort') }}</h3>
                                <p class="feature-description">{{ __('messages.luxury_car_description') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

<script>
    const { createApp } = Vue;

    createApp({
        data() {
            return {
                rideOptions: [
                    { value: "economy", label: "{{ __('messages.economy') }}", img: "{{ asset('images/services/economy_small.png') }}", passengers: 3, luggage: 3 },
                    { value: "comfort", label: "{{ __('messages.comfort') }}", img: "{{ asset('images/services/comfort_small.png') }}", passengers: 3, luggage: 3 },
                    { value: "business", label: "{{ __('messages.business') }}", img: "{{ asset('images/services/business_small.png') }}", passengers: 3, luggage: 3 },
                    { value: "minibus", label: "{{ __('messages.minibus') }}", img: "{{ asset('images/services/minibus_small.png') }}", passengers: 16, luggage: 16 }
                ],
                step: 1,
                loading: false,
                defaultPickupText: "{{ __('messages.select_pick_up_location') }}",
                defaultReturnText: "{{ __('messages.select_return_up_location') }}",
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
                    child_seat: '',
                    has_return_ride: false, 
                    return_date: '',
                    return_time: '',
                    
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
                if (this.step < 3) {
                    this.step++;
                }
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
                    child_seat: '',
                    has_return_ride: '',
                    return_date: '',
                    return_time: '',
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

            getCurrentLocationFor(field) {
                if (!navigator.geolocation) {
                alert("Geolocation is not supported by your browser.");
                return;
                }

                navigator.geolocation.getCurrentPosition(
                async (pos) => {
                    const { latitude, longitude } = pos.coords;

                    try {
                    // Call reverse geocoding (Nominatim)
                    const response = await fetch(
                        `https://nominatim.openstreetmap.org/reverse?lat=${latitude}&lon=${longitude}&format=json`
                    );
                    const data = await response.json();

                    // Pick a nice readable name (city/town/village/road)
                    const place =
                        data.address.city ||
                        data.address.town ||
                        data.address.village ||
                        data.address.suburb ||
                        data.display_name ||
                        "Unknown Location";

                    // Dynamically assign pickup or destination
                    this.form[field] = place;
                    this.form[`${field}_latitude`] = latitude;
                    this.form[`${field}_longitude`] = longitude;

                    } catch (e) {
                    alert("Failed to fetch location name.");
                    }
                },
                (err) => {
                    alert("Could not get your location: " + err.message);
                },
                { enableHighAccuracy: true, timeout: 10000 }
                );
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
