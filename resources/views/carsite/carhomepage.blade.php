@extends('layouts.maincarlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/carhomepage.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/carhomepage.css') }}">
    @endif

    <div id="bookingApp">

    <section class="hero-section">
        <div class="container-fluid d-flex justify-content-center align-items-center">
            <div class="hero-content text-center">
                <h1 class="display-4 fw-bold">#1 Car Rental </h1>
                <h2 style="margin-bottom:50px;">in Mauritius</h2>
        
                <div class="booking-form">
                    <div class="booking-form-top d-flex flex-wrap gap-3 justify-content-center">
                        <!-- Pick-up location -->
                        <div class="form-group">
                        <label>Pick-up location</label>
                        <select v-model="pickupLocation" class="form-control">
                            <option disabled value="">Pick up location</option>
                            <option>Mahebourg</option>
                            <option>Port Louis</option>
                            <option>SSR Airport</option>
                            <option>Grand Baie</option>
                        </select>
                        </div>
                        
        
                        <!-- Pick-up date -->
                        <div class="form-group">
                        <label>Pick-up date</label>
                        <input type="datetime-local" v-model="pickupDate" :min="minDateTime" class="form-control">
                        </div>
        
                        <!-- Return location -->
                        <!-- <div class="form-group">
                        <label>Return location</label>
                        <select v-model="returnLocation" class="form-control">
                            <option disabled value="">Return location</option>
                            <option>Mahebourg</option>
                            <option>Port Louis</option>
                            <option>SSR Airport</option>
                            <option>Grand Baie</option>
                        </select>
                        </div> -->
        
                        <!-- Return date -->
                        <div class="form-group">
                        <label>Return date</label>
                        <input type="datetime-local"v-model="returnDate" :min="minDateTime" class="form-control">
                        </div> 

                        <div class="form-group">
                            <p></p>
                            <!-- <button class="btn btn-primary px-4" style="margin-top:5px;" @click="searchCars">Search</button> -->
                            <button class="btn btn-primary px-4" style="margin-top:5px;"  @click.prevent="handleContinue">Search</button>
                        </div>

                        <div class="form-group">
                            <p></p>
                            <button class="btn btn-primary px-4" style="margin-top:5px;" @click="clearForm">Clear</button>
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
                <h2 class="section-heading" style="color:rgb(58, 58, 58);">Featured Vehicles</h2>
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
                                    <p class="car-subtitle">{{ $car->transmission }} • {{ $car->fuel_type }}</p>
                                </div>
                                <div class="car-price">
                                    <span class="price-amount">€{{ $car->price_per_day }}</span>
                                    <span class="price-period">Per day</span>
                                </div>
                            </div>

                            <div class="car-specs">
                                @if($car->fuel_type)
                                    <div class="spec-item">
                                        <i class='bx bx-gas-pump spec-icon'></i>
                                        <span>{{ $car->fuel_type }}</span>
                                    </div>
                                @endif
                                @if($car->transmission)
                                    <div class="spec-item">
                                        <i class='bx bx-cog spec-icon'></i>
                                        <span>{{ $car->transmission }}</span>
                                    </div>
                                @endif
                                @if($car->seats)
                                    <div class="spec-item">
                                        <i class='bx bxs-user spec-icon'></i>
                                        <span>{{ $car->seats }} Seats</span>
                                    </div>
                                @endif
                                @if($car->climate_control)
                                    <div class="spec-item">
                                        <i class='bx bx-wind spec-icon'></i>
                                        <span>Climate Control</span>
                                    </div>
                                @endif
                            </div>

                            <div class="car-actions">
                                    <button class="btn btn-primary" @click="bookNow({{ $car->id }}, '{{ route('reservation') }}')">Book Now</button>
                            </div>  
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    </div>


    <!-- Why choose us-->
    <section class="why-choose-section" style="background-color: rgb(208, 212, 231);">
        <div class="container">
            <!-- <h2 class="section-title">Why Choose Us</h2> -->
            <div class="section-header text-center mx-auto">
                <h2 class="section-heading" style="color:rgb(58, 58, 58);">Why Choose Us</h2>
                <!-- <p class="section-subtitle">Discover our most popular vehicles with special offers</p> -->
            </div>
            
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class='bx bx-like'></i>
                        </div>
                        <div class="feature-content">
                            <h3>No Excess Deposit</h3>
                            <p>Unlike others, we never pre-authorize or charge your credit card for an excess deposit on your car rental.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class='bx bx-shield-quarter'></i>
                        </div>
                        <div class="feature-content">
                            <h3>Premium Insurance (CDW)</h3>
                            <p>Included with all rentals. Covers accidents (even if at fault), theft, fire, cracked windscreen, flood, and more.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class='bx bx-infinite'></i>
                        </div>
                        <div class="feature-content">
                            <h3>Unlimited Mileage</h3>
                            <p>Drive as much as you want with no extra fees—enjoy unlimited mileage and explore Mauritius without limits.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class='bx bx-child'></i>
                        </div>
                        <div class="feature-content">
                            <h3>Baby Chairs/Booster Seats</h3>
                            <p>You will have at your disposal Baby car seats or booster for safety of your child.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class='bx bx-cog'></i>
                        </div>
                        <div class="feature-content">
                            <h3>AT/MT Transmission</h3>
                            <p>You will have the choice as per your comfort for Automatic or Manual transmission vehicle.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class='bx bx-support'></i>
                        </div>
                        <div class="feature-content">
                            <h3>24/7 Roadside Assistance</h3>
                            <p>Enjoy peace of mind with 24/7 roadside assistance—wherever you are in Mauritius, we're always ready to help.</p>
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
                    pickupLocation: '',
                    pickupDate: '',
                    returnLocation: '',
                    returnDate: '',
                    selectedCarId: null,
                    minDateTime: new Date().toISOString().slice(0, 16), // 'YYYY-MM-DDTHH:MM'
                };
            },
            mounted() {
                const savedData = JSON.parse(localStorage.getItem('bookingForm'));
                if (savedData) {
                    this.pickupLocation = savedData.pickupLocation || '';
                    this.pickupDate = savedData.pickupDate || '';
                    this.returnLocation = savedData.returnLocation || '';
                    this.returnDate = savedData.returnDate || '';
                    this.selectedCarId = savedData.carId || null;
                }
            },
            methods: {
                searchCars() {
                    const formData = {
                        pickupLocation: this.pickupLocation,
                        pickupDate: this.pickupDate,
                        returnLocation: this.returnLocation,
                        returnDate: this.returnDate,
                        carId: this.selectedCarId
                    };
                    localStorage.setItem('bookingForm', JSON.stringify(formData));
                    localStorage.setItem('activeReservationSection', 'itinerary');
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
                    } else {
                        this.returnLocation = this.returnLocation;
                    }
                    this.searchCars();
                },
                clearForm() {
                    this.pickupLocation = '';
                    this.pickupDate = '';
                    this.returnLocation = '';
                    this.returnDate = '';
                    this.selectedCarId = null;
                    localStorage.removeItem('bookingForm');
                    localStorage.removeItem('activeReservationSection');
                    localStorage.removeItem('selectedAddons');
                },
                bookNow(carId, route) {
                    this.selectedCarId = carId;
                    const formData = {
                        pickupLocation: this.pickupLocation,
                        pickupDate: this.pickupDate,
                        returnLocation: this.returnLocation,
                        returnDate: this.returnDate,
                        carId: carId
                    };
                    localStorage.setItem('bookingForm', JSON.stringify(formData));
                    localStorage.setItem('activeReservationSection', 'carsaddon');
                    window.location.href = route;
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
