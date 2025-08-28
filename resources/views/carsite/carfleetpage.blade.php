@extends('layouts.maincarlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/carfleetpage.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/carfleetpage.css') }}">
    @endif

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container">
      <div class="hero-content">
        <!-- <h1 class="hero-title">Premium Car Rental Experience</h1>
        <p class="hero-subtitle">Choose from our exclusive fleet of luxury and economy vehicles</p> -->
        <h1 class="hero-title">{{ __('messages.our_fleet') }}</h1>
      </div>
    </div>
  </section>

  <div id="bookingApp">

        <!-- Select Vehicle          -->
        <div class="content-section">
            <div class="container">
                <div class="section-content" style="margin-bottom: 50px;">
                    <h1 style="color:rgb(58, 58, 58);">{{ __('messages.fleet') }}</h1>
                    <div class="search-box">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="input-group" style="width: 300px;">
                                        <span class="input-group-text bg-transparent border-0">
                                            <i class="bx bx-search"></i>
                                        </span>
                                        <input type="text" v-model="searchQuery" class="form-control border-0" placeholder="{{ __('messages.search_car') }}...">
                                    </div>
                                </div>
                            </div>
                    </div>

                </div>

                <!-- Car selection -->
                <!-- Car Cards -->
                <div class="row">
                    <div class="car-grid">
                        <div v-for="car in filteredCars" :key="car.id" class="car-card" style="border: 2px solid #81879b;" >
                            <div class="car-image">
                                <img style="background-color:white;" :src="car.image_url" :alt="car.name">
                            </div>
                            <div class="car-info">
                                <div class="car-header">
                                    <div>
                                        <h3 class="car-title">@{{ car.name }}</h3>
                                        <p class="car-subtitle"> @{{ car.translated_transmission }} • @{{ car.translated_fuel_type }}</p>
                                    </div>
                                    <div class="car-price text-end">
                                        <!-- Check if promotion exists in Vue -->
                                        <template v-if="car.promotion_price_per_day">
                                            <!-- Normal price crossed out -->
                                            <small class="text-muted text-decoration-line-through">
                                                €@{{ car.price_per_day }}
                                            </small>
                                            <!-- Promotion price in red -->
                                            <span class="price-amount text-danger ms-2">
                                                €@{{ car.promotion_price_per_day }}
                                            </span>
                                        </template>
                                        <template v-else>
                                            <span class="price-amount">€@{{ car.price_per_day }}</span>
                                        </template>

                                        <span class="price-period">{{ __('messages.per_day') }}</span>
                                    </div>

                                </div>

                                <div class="car-specs">
                                    <div class="spec-item">
                                        <i class='bx bx-gas-pump spec-icon'></i>
                                        <span>@{{car.translated_fuel_type  }}</span>
                                    </div>
                                    <div class="spec-item">
                                        <i class='bx bx-cog spec-icon'></i>
                                        <span>@{{ car.translated_transmission }}</span>
                                    </div>
                                    <div class="spec-item">
                                        <i class='bx bxs-user spec-icon'></i>
                                        <span>5 {{ __('messages.seats') }}</span>
                                    </div>
                                    <div class="spec-item">
                                        <i class='bx bx-wind spec-icon'></i>
                                        <span>{{ __('messages.climate_control') }}</span>
                                    </div>
                                </div>

                                <div class="car-actions">
                                    <button class="btn btn-primary" @click="selectCar(car.id, car.name); showSection('carsaddon')">{{ __('messages.book_now') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- No results -->
                    <div v-if="filteredCars.length === 0" class="text-center text-muted mt-5">
                    {{ __('messages.no_cars_match_your_search') }}.
                    </div>
                </div>

            </div>
        </div>

  </div>

    <!-- Ensure this is within an element with id="bookingApp" -->
    <script>
        const app = Vue.createApp({
            data() {
                return {                    
                    selectedCarId: null,
                    selectedCar: null,
                    searchQuery: '',
                    cars: @json($cars),
                };
            },
            mounted() {
                const saved = JSON.parse(sessionStorage.getItem('bookingForm'));
                if (saved) {
                    this.pickupLocation = saved.pickupLocation || '';
                    this.tempPickupLocation =  saved.pickupLocation || '';

                    this.pickupDate = saved.pickupDate || '';
                    this.tempPickupDate = saved.pickupDate || '';

                    this.returnLocation = saved.returnLocation || '';
                    this.tempReturnLocation = saved.returnLocation || '';

                    this.returnDate = saved.returnDate || '';
                    this.tempReturnDate = saved.returnDate || '';

                    this.sameLocation = saved.sameLocation !== undefined ? saved.sameLocation : true;
                    this.selectedCarId = saved.carId || null;

                }
            },
            watch: {
                selectedCarId(newId) {
                    this.selectedCar = this.cars.find(car => car.id === newId);

                    this.perDayRate = this.selectedCar ? Number(this.selectedCar.price_per_day) : 0;
                }
            },
            computed: {

                isVehicleComplete(){
                    return(
                        this.selectedCar
                    );
                },
                filteredCars() {
                    const term = this.searchQuery.toLowerCase();
                    return this.cars.filter(car =>
                        car.name.toLowerCase().includes(term) ||
                        (car.type && car.type.toLowerCase().includes(term)) ||
                        (car.fuel_type && car.fuel_type.toLowerCase().includes(term)) ||
                        (car.transmission && car.transmission.toLowerCase().includes(term))
                    );
                }
            },
            methods: {
                searchCars() {
                    const data = {
                        pickupLocation: this.pickupLocation,
                        pickupDate: this.pickupDate,
                        returnLocation: this.returnLocation,
                        returnDate: this.returnDate,
                        sameLocation: this.sameLocation,
                        carId: this.selectedCarId
                    };
                    sessionStorage.setItem('bookingForm', JSON.stringify(data));
                    alert("Search triggered and form data saved.");
                },
                showSection(sectionName) {
                    // this.activeSection = sectionName;
                    sessionStorage.setItem('activeReservationSection', sectionName);
                },
                selectCar(id,name) {
                    this.selectedCarId = id;
                    const saved = JSON.parse(sessionStorage.getItem('bookingForm')) || {};
                    saved.carId = id;
                    sessionStorage.setItem('bookingForm', JSON.stringify(saved));
                    window.location.href = '/reservation';
                    // alert('Selected car: ' + name);
                },
                bookNow(carId) {
                    const saved = JSON.parse(sessionStorage.getItem('bookingForm')) || {};
                    saved.carId = carId;
                    sessionStorage.setItem('bookingForm', JSON.stringify(saved));
                    // Optional: redirect or change section
                    // this.showSection('addons');
                }

            }
            
        });

        app.mount('#bookingApp');
   </script>


@endsection
