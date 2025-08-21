@extends('layouts.maincarlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/carhomepage.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/carhomepage.css') }}">
    @endif

    <!-- for location map -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    />
   <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <div id="bookingApp">

        <section class="hero-section bg-dark text-white py-5">
            <div class="container">
                <div class="row align-items-center">
                <!-- Title Section -->
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <div class="hero-image-text d-flex flex-column justify-content-center align-items-center text-center" style="height: 100%;">
                        <h1 class="display-4 fw-bold mb-2">{{ __('messages.rent_a_car') }}</h1>
                        <h2 class="mb-0">{{ __('messages.in_mauritius') }}</h2>
                    </div>
                </div>

                <!-- Booking Form -->
                <div class="col-lg-6 d-flex justify-content-center ">
                    <div class="booking-box p-4 text-white rounded shadow booking-form" style="width: 100%; max-width: 400px; right:0px;">
                        <div>
                            <div class="mb-3 form-group">
                            <label class="fw-bold">{{ __('messages.pick_up') }}</label>
                        
                                <!-- <select v-model="pickupLocation" class="form-control" required>
                                    <option disabled value="">Select pick up location</option>
                                    <option> <i class='bx bx-map'></i>Mahebourg</option>
                                    <option>Port Louis</option>
                                    <option>SSR Airport</option>
                                    <option>Grand Baie</option>
                                </select> -->

                                <div class="dropdown form-control p-0 ">
                                    <button class="btn selectinput-place dropdown-toggle w-100 text-start d-flex align-items-center justify-content-between"
                                            type="button" data-bs-toggle="dropdown">
                                            <div>
                                                <i class='bx bx-map me-2'></i> 
                                                @{{ pickupLocation || defaultPickupText }}
                                            </div>
                                    </button>
                                    <ul class="dropdown-menu w-100">
                                        <li @click="pickupLocation = 'SSR Airport'; pickupLat = -20.431997; pickupLng = 57.676868;" class="dropdown-item">
                                            <i class='bx bx-map'></i> SSR Airport
                                        </li>
                                        <li @click="pickupLocation = 'Mahebourg'; pickupLat = -20.408056; pickupLng = 57.7;" class="dropdown-item">
                                            <i class='bx bx-map'></i> Mahebourg
                                        </li>
                                        <li @click="pickupLocation = 'Port Louis'; pickupLat = -20.160891; pickupLng = 57.501222;" class="dropdown-item">
                                            <i class='bx bx-map'></i> Port Louis
                                        </li>
                                        <li @click="pickupLocation = 'Grand Baie'; pickupLat = -20.013053; pickupLng = 57.580440;" class="dropdown-item">
                                            <i class='bx bx-map'></i> Grand Baie
                                        </li>
                                        <li class="dropdown-item" @click="openMap('pickup')">
                                            <i class='bx bx-map-pin'></i> {{ __('messages.choose_on_map') }}
                                        </li>
                                    </ul>
                                </div>

                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="sameLocation" v-model="sameLocation">
                                <label class="form-check-label" for="sameLocation">{{ __('messages.return_to_same_location') }}</label>
                            </div>

                            <transition name="fade">
                                <div class="mb-3 form-group" v-if="!sameLocation">
                                    <label class="fw-bold">{{ __('messages.return') }}</label>
                                    <!-- <select v-model="returnLocation" class="form-control" required>
                                        <option disabled value="">Select pick up location</option>
                                        <option>Mahebourg</option>
                                        <option>Port Louis</option>
                                        <option>SSR Airport</option>
                                        <option>Grand Baie</option>
                                    </select> -->
                                    <div class="dropdown form-control p-0 ">
                                        <button class="btn selectinput-place dropdown-toggle w-100 text-start d-flex align-items-center justify-content-between"
                                                type="button" data-bs-toggle="dropdown">
                                                <div>
                                                    <i class='bx bx-map me-2'></i> 
                                                    @{{ returnLocation || defaultReturnText }}
                                                </div>
                                        </button>
                                        <ul class="dropdown-menu w-100">
                                            <li @click="returnLocation = 'SSR Airport'; returnLat = -20.431997; returnLng = 57.676868;" class="dropdown-item">
                                                <i class='bx bx-map'></i> SSR Airport
                                            </li>
                                            <li @click="returnLocation = 'Mahebourg'; returnLat = -20.408056; returnLng = 57.7;" class="dropdown-item">
                                                <i class='bx bx-map'></i> Mahebourg
                                            </li>
                                            <li @click="returnLocation = 'Port Louis'; returnLat = -20.160891; returnLng = 57.501222;" class="dropdown-item">
                                                <i class='bx bx-map'></i> Port Louis
                                            </li>
                                            <li @click="returnLocation = 'Grand Baie'; returnLat = -20.013053; returnLng =  57.580440;" class="dropdown-item">
                                                <i class='bx bx-map'></i> Grand Baie
                                            </li>
                                            <li class="dropdown-item" @click="openMap('return')">
                                                <i class='bx bx-map-pin'></i> {{ __('messages.choose_on_map') }}
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </transition>

                            <div class="mb-3 form-group">
                            <label class="fw-bold">{{ __('messages.pick_up-date') }}</label>
                            <input type="datetime-local" v-model="pickupDate" :min="minDateTime" class="form-control" required>
                            </div>

                            <div class="mb-3 form-group">
                            <label class="fw-bold">{{ __('messages.return_date') }}</label>
                            <input type="datetime-local" v-model="returnDate" :min="minDateTime" class="form-control" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button @click.prevent="handleContinue" class="btn btn-primary w-50 me-2 py-2 ">{{ __('messages.find_a_vehicle') }}</button>
                                <button  @click="clearForm" class="btn btn-secondary w-50 py-2 ">{{ __('messages.clear_data') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </section>

        <!-- Featured Cars Section -->
        <section class="featured-section">
            <div class="container">
                <div class="section-header text-start">
                    <h2 class="section-heading" style="color:rgb(58, 58, 58);">{{ __('messages.fearures_vehicles') }}</h2>
                </div>

                <div class="car-grid">
                    @foreach($cars as $car)
                        <div class="car-card">
                            <div class="car-image">
                                <img src="{{ asset($car->image_path) }}" alt="{{ $car->name }}">
                            </div>

                            <div class="car-info">
                                <div class="car-header">
                                    <div>
                                        <h3 class="car-title">{{ $car->name }}</h3>
                                        {{ __('messages.' . strtolower($car->transmission)) }} • {{ __('messages.' . strtolower($car->fuel_type)) }}
                                    </div>
                                    <div class="car-price">
                                        <span class="price-amount">€{{ $car->price_per_day }}</span>
                                        <span class="price-period">{{ __('messages.per_day') }}</span>
                                    </div>
                                </div>

                                <div class="car-specs">
                                    @if($car->fuel_type)
                                        <div class="spec-item">
                                            <i class='bx bx-gas-pump spec-icon'></i>
                                            <span>{{ __('messages.' . strtolower($car->fuel_type)) }}</span>
                                        </div>
                                    @endif
                                    @if($car->transmission)
                                        <div class="spec-item">
                                            <i class='bx bx-cog spec-icon'></i>
                                            <span>{{ __('messages.' . strtolower($car->transmission)) }}</span>
                                        </div>
                                    @endif
                                    @if($car->seats)
                                        <div class="spec-item">
                                            <i class='bx bxs-user spec-icon'></i>
                                            <span>{{ $car->seats }} {{ __('messages.seats') }}</span>
                                        </div>
                                    @endif
                                    @if($car->climate_control)
                                        <div class="spec-item">
                                            <i class='bx bx-wind spec-icon'></i>
                                            <span>{{ __('messages.climate_control') }}</span>
                                        </div>
                                    @endif
                                </div>

                                <div class="car-actions">
                                        <button class="btn btn-primary" @click="bookNow({{ $car->id }}, '{{ route('reservation') }}')">{{ __('messages.book_now') }}</button>
                                </div>  
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

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


    <!-- Why choose us-->
    <section class="why-choose-section" style="background-color: rgb(208, 212, 231);">
        <div class="container">
            <!-- <h2 class="section-title">Why Choose Us</h2> -->
            <div class="section-header text-center mx-auto">
                <h2 class="section-heading" style="color:rgb(58, 58, 58);">{{ __('messages.why_choose_us_title') }}</h2>
                <!-- <p class="section-subtitle">Discover our most popular vehicles with special offers</p> -->
            </div>
            
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class='bx bx-like'></i>
                        </div>
                        <div class="feature-content">
                            <h3>{{ __('messages.no_excess_deposit') }}</h3>
                            <p>{{ __('messages.no_excess_deposit_des') }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class='bx bx-shield-quarter'></i>
                        </div>
                        <div class="feature-content">
                            <h3>{{ __('messages.premium_insurance_cdw') }}</h3>
                            <p>{{ __('messages.premium_insurance_cdw_des') }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class='bx bx-infinite'></i>
                        </div>
                        <div class="feature-content">
                            <h3>{{ __('messages.unlimited_mileage') }}</h3>
                            <p>{{ __('messages.unlimited_mileage_des') }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class='bx bx-child'></i>
                        </div>
                        <div class="feature-content">
                            <h3>{{ __('messages.baby_chairs_booster_seats') }}</h3>
                            <p>{{ __('messages.baby_chairs_booster_seats_des') }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- <div class="col-lg-4 col-md-6">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class='bx bx-cog'></i>
                        </div>
                        <div class="feature-content">
                            <h3>AT/MT Transmission</h3>
                            <p>You will have the choice as per your comfort for Automatic or Manual transmission vehicle.</p>
                        </div>
                    </div>
                </div> -->
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class='bx bx-support'></i>
                        </div>
                        <div class="feature-content">
                            <h3>{{ __('messages.24_7_roadside_assistance') }}</h3>
                            <p>{{ __('messages.24_7_roadside_assistance_des') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <script>
        const app = Vue.createApp({
            data() {
                return {
                    defaultPickupText: "{{ __('messages.select_pick_up_location') }}",
                    defaultReturnText: "{{ __('messages.select_return_up_location') }}",
                    

                    pickupLocation: '',
                    pickupDate: '',
                    returnLocation: '',
                    returnDate: '',
                    sameLocation: true,
                    selectedCarId: null,
                    minDateTime: new Date().toISOString().slice(0, 16), // 'YYYY-MM-DDTHH:MM'

                    //location map
                    pickupLat: null,
                    pickupLng: null,
                    returnLat: null,
                    returnLng: null,

                    showMapModal: false,
                    selectedLatLng: null,
                    mapInstance: null,
                    marker: null,
                    mapTarget: '', // can be 'pickup' or 'return'
                };
            },
            mounted() {
                const savedData = JSON.parse(sessionStorage.getItem('bookingForm'));
                if (savedData) {
                    this.pickupLocation = savedData.pickupLocation || '';
                    this.pickupDate = savedData.pickupDate || '';
                    this.sameLocation = typeof savedData.sameLocation === 'boolean' ? savedData.sameLocation : true;
                    this.returnLocation = savedData.returnLocation || '';
                    this.returnDate = savedData.returnDate || '';
                    this.selectedCarId = savedData.carId || null;

                    // ✅ Restore coordinates if saved
                    this.pickupLat = savedData.pickupLat || null;
                    this.pickupLng = savedData.pickupLng || null;
                    this.returnLat = savedData.returnLat || null;
                    this.returnLng = savedData.returnLng || null;
                }
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
                searchCars() {
                    const formData = {
                        pickupLocation: this.pickupLocation,
                        pickupDate: this.pickupDate,
                        returnLocation: this.returnLocation,
                        sameLocation: this.sameLocation,
                        returnDate: this.returnDate,
                        carId: this.selectedCarId,

                        // 💾 Save coordinates here too
                        pickupLat: this.pickupLat,
                        pickupLng: this.pickupLng,
                        returnLat: this.returnLat,
                        returnLng: this.returnLng
                    };
                    sessionStorage.setItem('bookingForm', JSON.stringify(formData));
                    sessionStorage.setItem('activeReservationSection', 'cars');
                    window.location.href = '/reservation'; // Redirect to reservation page
                },
                handleContinue() {
                    const pickup = new Date(this.pickupDate);
                    const dropoff = new Date(this.returnDate);
                    const now = new Date();

                    if (pickup < now) {
                        alert("Pick-up date/time cannot be in the past.");
                        return;
                    }

                    if (dropoff <= pickup) {
                        alert("Drop-off must be after pick-up.");
                        return;
                    }

                    // 👇 If sameLocation is true, returnLocation = pickupLocation
                    if (this.sameLocation) {
                        this.returnLocation = this.pickupLocation;
                    } 
                    this.searchCars();
                },
                clearForm() {
                    this.pickupLocation = '';
                    this.pickupDate = '';
                    this.returnLocation = '';
                    this.sameLocation = true;
                    this.returnDate = '';
                    this.selectedCarId = null;
                    sessionStorage.removeItem('bookingForm');
                    sessionStorage.removeItem('activeReservationSection');
                    sessionStorage.removeItem('selectedAddons');
                },
                bookNow(carId, route) {
                    this.selectedCarId = carId;
                    const formData = {
                        pickupLocation: this.pickupLocation,
                        pickupDate: this.pickupDate,
                        sameLocation: this.sameLocation,
                        returnLocation: this.returnLocation,
                        returnDate: this.returnDate,
                        carId: carId,

                        // 💾 Save coordinates
                        pickupLat: this.pickupLat,
                        pickupLng: this.pickupLng,
                        returnLat: this.returnLat,
                        returnLng: this.returnLng
                    };
                    sessionStorage.setItem('bookingForm', JSON.stringify(formData));
                    sessionStorage.setItem('activeReservationSection', 'carsaddon');
                    window.location.href = route;
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
                            this.pickupLocation = address;
                            this.pickupLat = lat;
                            this.pickupLng = lng;
                        } else if (this.mapTarget === 'return') {
                            this.returnLocation = address;
                            this.returnLat = lat;
                            this.returnLng = lng;
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

            },
            computed: {
                formattedPickupDate() {
                    return this.pickupDate
                        ? new Date(this.pickupDate).toLocaleString('en-GB', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: true
                        })
                        : '—';
                },
                formattedReturnDate() {
                    return this.returnDate
                        ? new Date(this.returnDate).toLocaleString('en-GB', {
                            day: 'numeric',
                            month: 'long',
                            year: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                            hour12: true
                        })
                        : '—';
                }
            }
        });

        app.mount('#bookingApp');
    </script>

@endsection