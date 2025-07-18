@extends('layouts.maincarlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/carreservationpage.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/carreservationpage.css') }}">
    @endif

    <div id="bookingApp">

        <!-- Hero Section            -->
        <div class="hero-section" >
            <div class="hero-content">
                <div class="steps row justify-content-center text-center" >
                    <h1 class="display-4 fw-bold">Reservation</h1>
                        <!-- Reservation initiary Form Section -->
                    <div class="col-md-4 step text-start"  @click="showSection('itinerary')">
                        <h3 class="d-flex justify-content-between align-items-center">
                            <span><span class="step-number">1.</span> Your Itinerary</span>
                            <span class="text-success" v-if="isItineraryComplete">
                                <i class='bx bxs-check-circle fs-4'></i>
                            </span>
                        </h3>
                        <p><span class="fw-bold" style="font-size: 0.9rem;">Pick-up:</span></p>
                        <p>@{{ pickupLocation || '—' }}</p>
                        <p>@{{ formattedPickupDate }}</p>
                        <p><span class="fw-bold" style="font-size: 0.9rem;">Drop-off:</span></p>
                        <p>@{{ returnLocation || '—' }}</p>
                        <p>@{{ formattedReturnDate }}</p>
                    </div>
                    <!-- Select Vehicle          -->
                    <div class="col-md-4 step text-start " @click="showSection('cars')">
                        <h3 class="d-flex justify-content-between align-items-center">
                            <span><span class="step-number">2.</span> Vehicle & Add-ons</span>
                            <span class="text-success" v-if="isVehicleComplete">
                                    <i class='bx bxs-check-circle fs-4'></i>
                            </span>
                        </h3>
                        <p><span class="fw-bold" style="font-size: 0.9rem;">Vehicle: </span></p>
                        <p v-if="selectedCar">@{{ selectedCar.name || '_'}}</p>
                        <p><span class="fw-bold" style="font-size: 0.9rem;">Add-ons: </span></p>
                        <p>Additional Driver: @{{ hasDriver ? 'Yes' : 'No' }}</p>
                        <p>Child Seat: @{{ childQuantity }}</p>
                    </div>

                       <!--  Booking Form submission-->
                    <div class="col-md-4 step text-start " @click="showSection('summary')">
                        <h3 class="d-flex justify-content-between align-items-center">
                            <span><span class="step-number">3.</span> Make a Booking</span>
                            <!-- <span class="text-success"><i class='bx bxs-check-circle fs-4'></i></span> -->
                        </h3>
                        <p class="fw-bold" style="font-size: 0.9rem;">Enter Your Details</p>
                    </div>

                </div>
            </div>
        </div>

        <!-- Reservation initiary Form Section -->
        <div class="content-section py-5"  v-show="activeSection === 'itinerary'">
            <div class="container">
                <h1 class="mb-5 text-dark">Reservation Vehicle</h1>
                
                <div class="booking-box">
                    <form class="row g-4 p-4">
                    <!-- Pick-up Location -->
                    <div class="col-md-6">
                        <label for="pickupLocation" class="form-label">Place to Pick Up the Car *</label>
                        <select class="form-select" v-model="tempPickupLocation" id="pickupLocation" required>
                            <option selected disabled>Choose Location</option>
                            <option>Mahebourg</option>
                            <option>Port Louis</option>
                            <option>SSR Airport</option>
                            <option>Grand Baie</option>
                        </select>
                    </div>
                    
                    <!-- Return to Same Location Checkbox -->
                    <div class="col-md-12 d-flex align-items-end pt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="sameLocation" v-model="sameLocation">
                            <label class="form-check-label" for="sameLocation">
                            Return to the same location
                            </label>
                        </div>
                    </div>

                    <!-- Return location dropdown (shown only if checkbox is unchecked) -->
                    <div class="col-md-12">
                        <div class="col-md-6" v-if="!sameLocation">
                        <label for="returnLocation" class="form-label">Place to Return the Car *</label>
                        <select class="form-select" id="returnLocation" v-model="tempReturnLocation" required>
                            <option disabled value="">Choose Location</option>
                            <option>Mahebourg</option>
                            <option>Port Louis</option>
                            <option>SSR Airport</option>
                            <option>Grand Baie</option>
                        </select>
                        </div>
                    </div>

                    <!-- Pick-up Date/Time -->
                    <div class="col-md-6">
                        <label for="pickupDate" class="form-label">Pick-up Date/Time *</label>
                        <input type="datetime-local" class="form-control" v-model="tempPickupDate" :min="minDateTime"  required>
                    </div>

                    <!-- Drop-off Date/Time -->
                    <div class="col-md-6">
                        <label for="dropoffDate" class="form-label">Drop Date/Time *</label>
                        <input type="datetime-local" class="form-control" v-model="tempReturnDate"  :min="minDateTime" required>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-12 text-end mt-3">
                        <!-- <button type="submit" class="btn btn-primary px-4 fw-bold" @click.prevent="searchCars">
                            Continue
                        </button> -->
                        <button 
                                type="submit" 
                                class="btn btn-primary px-4 fw-bold"
                                @click.prevent="handleContinue"
                            >
                            Continue
                        </button>
                       
                    </div>
                </form>
                </div>

            </div>
        </div>        
        


        <!-- Select Vehicle          -->
        <div class="content-section" v-show="activeSection === 'cars'">
            <div class="container">
                <div class="section-content" style="margin-bottom: 50px;">
                    <h1 style="color:rgb(58, 58, 58);">Select vehicle/Add-ons</h1>
                    <div class="search-box">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="input-group" style="width: 300px;">
                                        <span class="input-group-text bg-transparent border-0">
                                            <i class="bx bx-search"></i>
                                        </span>
                                        <input type="text" v-model="searchQuery" class="form-control border-0" placeholder="Search car...">
                                    </div>
                                </div>
                            </div>
                    </div>

                </div>

                <!-- Car selection -->
                <!-- Car Cards -->
                <div class="row">
                    <div class="col-12" v-for="car in filteredCars" :key="car.id">
                        <div class="card car-card">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img class="car-image" :src="car.image_url" :alt="car.name">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body d-flex flex-row justify-content-between align-items-start gap-3">
                                        <div class="card-content flex-grow-1">
                                            <h5 class="car-title">@{{ car.name }}</h5>
                                            <div class="car-specs">
                                                <div class="spec-item"><i class='bx bx-car'></i><span>@{{ car.type }}</span></div>
                                                <div class="spec-item"><i class='bx bx-droplet'></i><span>@{{ car.fuel_type }}</span></div>
                                                <div class="spec-item"><i class='bx bx-cog'></i><span>@{{ car.transmission }}</span></div>
                                            </div>
                                        </div>
                                        <div class="text-end d-flex flex-column justify-content-between align-items-end">
                                            <div class="price-text fw-semibold">From €@{{ car.price_per_day }} /day</div>
                                            <div class="button-container mt-2">
                                                 <button class="btn btn-primary" @click="selectCar(car.id); showSection('carsaddon')">Book Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Optional: No result -->
                    <div v-if="filteredCars.length === 0" class="text-center text-muted mt-5">
                        No cars match your search.
                    </div>

                </div>
            </div>
        </div>

        <!--  Booking Form submission-->
        <div class="content-section" v-show="activeSection === 'summary'">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="details-box">
                            <h3>Driver Details</h3>
                            <form>
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" id="firstName" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" id="lastName" class="form-control" required>
                                    </div>
                                </div>
                    
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label for="driverAge" class="form-label">Driver Age</label>
                                        <input type="number" id="driverAge" class="form-control" min="16" max="100" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="mobile" class="form-label">Mobile Number <small class="text-muted">(WhatsApp)</small></label>
                                        <input type="tel" id="mobile" class="form-control" required>
                                    </div>
                                </div>
                    
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" class="form-control" required>
                                    <div class="form-text">Service voucher will be sent to this email</div>
                                </div>

                                <div class="mb-3">
                                    <label for="specialRequests" class="form-label">Message / Special Requests</label>
                                    <textarea id="specialRequests" name="specialRequests" class="form-control" rows="4" placeholder="Write your notes or special requests here..."></textarea>
                                </div>
                    
                                <!-- <div class="form-check mb-3">
                                    <input class="form-check-input" type="checkbox" id="terms" required>
                                    <label class="form-check-label" for="terms">
                                        I understand & agree with the <a href="#" target="_blank">Terms & Conditions</a>
                                    </label>
                                </div> -->
                                
                                <button type="submit" class="btn btn-primary px-5 py-2 fw-bold fs-6">
                                    Send Quote
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Rate Section -->
                        <div class="rate-section text-center" v-if="selectedCar" >
                            {{--<img class="img-fluid rounded mb-3 shadow-sm" :src="car.image_url" :alt="car.name">--}}
                            <!-- <h3 class="rate-title">@{{ selectedCar.name }</h3> -->
                    
                            <div class="rate-row fw-bold border-bottom pb-2">
                                <span>QTY</span>
                                <span>RATE</span>
                                <span>SUBTOTAL</span>
                            </div>
                    
                            <div class="rate-row">
                                <span>1 Day</span>
                                <span>$60.00</span>
                                <span>$60.00</span>
                            </div>
                    
                            <div class="rate-row">
                                <span>ADD-ON</span>
                                <span>-</span>
                                <span>$60.00</span>
                            </div>
                    
                            <div class="rate-row fw-bold border-top pt-2">
                                <span>Total</span>
                                <span></span>
                                <span>$120.00</span>
                            </div>
                        </div>
                    </div>
                    

                </div>

            </div>
            
            
        </div>

        <!-- Vehicle Add-ons Section -->
        <div class="content-section"  v-show="activeSection === 'carsaddon'"> 
            <!-- Vehicle Add-ons Section -->
            <div class="container">
                <h1 style="color:rgb(58, 58, 58); margin-bottom:50px;" >Add-ons</h1>
                
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Car Display -->
                        <div class="" v-if="selectedCar">
                            <img :src="selectedCar.image_url" :alt="selectedCar.name" class="car-image">
                            <h2 class="car-title">@{{ selectedCar.name }}</h2>
                            <p class="car-subtitle">
                                @{{ selectedCar.type }} • @{{ selectedCar.fuel_type }} • @{{ selectedCar.transmission }}
                            </p>  
                                                   
                            <!-- Additional Driver (Toggle button) -->
                            <div class="addon-item">
                                <div class="addon-info">
                                    <div class="addon-icon">
                                        <i class="bx bx-user-plus"></i>
                                    </div>
                                    <div class="addon-details">
                                        <h5>ADDITIONAL DRIVER</h5>
                                        <small>Add another authorized driver</small>
                                    </div>
                                </div>
                                <div class="addon-controls">
                                    <button class="btn-add" :class="{ active: hasDriver }" @click="toggleDriver">
                                        @{{ hasDriver ? 'REMOVE' : 'ADD' }}
                                    </button>
                                </div>
                            </div>

                            <!-- Child Seat -->
                            <div class="addon-item">
                                <div class="addon-info">
                                    <div class="addon-icon">
                                        <i class="bx bx-child"></i>
                                    </div>
                                    <div class="addon-details">
                                        <h5>CHILD SEAT</h5>
                                        <small>Safety first for young passengers</small>
                                    </div>
                                </div>
                                <div class="addon-controls">
                                    <div class="quantity-control">
                                        <button class="quantity-btn" @click="changeQuantity('child', -1)">-</button>
                                        <input type="number" class="quantity-input" v-model="childQuantity" readonly>
                                        <button class="quantity-btn" @click="changeQuantity('child', 1)">+</button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-4">
                        <!-- Rate Section -->
                        <div class="rate-section p-3 border rounded shadow-sm bg-light">
                            <h4 class="rate-title mb-3 fw-bold text-center">RATE</h4>

                            <!-- Headers -->
                            <div class="row fw-bold text-center border-bottom pb-2">
                                <div class="col">QTY</div>
                                <div class="col">RATE</div>
                                <div class="col">SUBTOTAL</div>
                            </div>

                            <!-- Base Rental -->
                            <div class="row text-center py-2 border-bottom">
                                <div class="col">@{{ rentalDays }} Days</div>
                                <div class="col">$@{{ perDayRate.toFixed(2) }}</div>
                                <div class="col">$@{{ baseSubtotal.toFixed(2) }}</div>
                            </div>

                            <!-- Additional Driver -->
                            <div class="row text-center py-2 border-bottom" v-if="hasDriver">
                                <div class="col">Additional Driver</div>
                                <div class="col">$@{{ driverRate.toFixed(2) }}</div>
                                <div class="col">$@{{ driverRate.toFixed(2) }}</div>
                            </div>

                            <!-- Child Seat -->
                            <div class="row text-center py-2 border-bottom" v-if="childQuantity > 0">
                                <div class="col">Child Seat <div> × @{{ childQuantity }}</div></div>
                                <div class="col">$@{{ childSeatRate.toFixed(2) }}</div>
                                <div class="col">$@{{ (childQuantity * childSeatRate).toFixed(2) }}</div>
                            </div>

                            <!-- Total -->
                            <div class="row text-center pt-3 fw-bold border-top">
                                <div class="col">Total</div>
                                <div class="col"></div>
                                <div class="col">$@{{ totalRate.toFixed(2) }}</div>
                            </div>

                            <!-- Button -->
                            <div class="mt-4">
                                <button class="btn w-100 fw-bold text-white" style="background-color: green;" @click="showSection('summary')">
                                    Continue
                                </button>
                            </div>
                        </div>
                    </div>


                </div>
            </div>   
            
            <!-- Car Specifications -->
            <div class="container my-5" v-if="selectedCar">
                <h2 class="mb-4">About</h2>
                
                <div class="spec-grid">
                    <div class="spec-card">
                        <i class="bx bx-cog"></i>
                        <h5>Transmission</h5>
                        <p>@{{ selectedCar.transmission }}</p>
                    </div>
                    <div class="spec-card">
                        <i class="bx bx-car"></i>
                        <h5>Type</h5>
                        <p>@{{ selectedCar.type }}</p>
                    </div>
                    <div class="spec-card">
                        <i class="bx bx-droplet"></i>
                        <h5>Fuel Type</h5>
                        <p>@{{ selectedCar.fuel_type }}</p>
                    </div>
                    <div class="spec-card">
                        <i class="bx bx-group"></i>
                        <h5>Seats</h5>
                        <p>@{{ selectedCar.seats }}</p>
                    </div>
                    <div class="spec-card">
                        <i class="bx bx-door-open"></i>
                        <h5>Doors</h5>
                        <p>@{{ selectedCar.doors }} Doors</p>
                    </div>
                    <div class="spec-card">
                        <i class="bx bx-calendar"></i>
                        <h5>Model Years</h5>
                        <p>@{{ selectedCar.model_years }}</p>
                    </div>
                    <div class="spec-card">
                        <i class="bx bx-palette"></i>
                        <h5>Available Colors</h5>
                        <div class="d-flex gap-2 justify-content-center" style="color:white;">
                            <span 
                                v-for="(color, index) in selectedCar.colors" 
                                :key="index"
                                class="badge"
                                :style="{ backgroundColor: color }"
                            >
                                @{{ color }}
                            </span>
                        </div>
                    </div>

                </div>

                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="spec-card">
                            <i class="bx bx-gas-pump"></i>
                            <h5>Engine & Consumption</h5>
                            <p><strong>Engine:</strong> @{{ selectedCar.engine }}</p>
                            <p><strong>Consumption:</strong> @{{ selectedCar.consumption }}</p>
                            <p><strong>Policy:</strong> @{{ selectedCar.policy }}</p>
                        </div>
                    </div>
                </div>


                <!-- Insurance Section -->
                <div class="insurance-section">
                    <h3 class="insurance-title"><i class="bx bx-shield-check"></i> Comprehensive Insurance Coverage</h3>

                    <!-- Highlighted Box -->
                    <div class="highlight-box">
                        <h4><i class="bx bx-check-circle"></i> Collision Damage Waiver (CDW) — No Excess Required</h4>
                        <p class="mb-0">Your peace of mind matters to us. Every Suzuki Fronx rental comes with full insurance so you can explore Mauritius worry-free.</p>
                    </div>

                    <!-- Accordion Container -->
                    <div class="accordion" id="insuranceAccordion">
                        <!-- Covered Section -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="coveredHeading">
                                <button class="accordion-button collapsed text-success" type="button" data-bs-toggle="collapse" data-bs-target="#coveredCollapse" aria-expanded="false" aria-controls="coveredCollapse">
                                    <i class="bx bx-check-circle me-2"></i> What's Covered
                                </button>
                            </h2>
                            <div id="coveredCollapse" class="accordion-collapse collapse" aria-labelledby="coveredHeading" data-bs-parent="#insuranceAccordion">
                                <div class="accordion-body">
                                    <ul class="list-unstyled mb-0">
                                        <li class="coverage-item"><i class="bx bx-check text-success me-2"></i>Collision Damages (even if at fault)</li>
                                        <li class="coverage-item"><i class="bx bx-check text-success me-2"></i>Major Scratches</li>
                                        <li class="coverage-item"><i class="bx bx-check text-success me-2"></i>Natural Disasters</li>
                                        <li class="coverage-item"><i class="bx bx-check text-success me-2"></i>Fire, Riots, and Vandalism</li>
                                        <li class="coverage-item"><i class="bx bx-check text-success me-2"></i>Theft (vehicle or parts)</li>
                                        <li class="coverage-item"><i class="bx bx-check text-success me-2"></i>Fallen Objects</li>
                                        <li class="coverage-item"><i class="bx bx-check text-success me-2"></i>Cracked Windscreens</li>
                                        <li class="coverage-item"><i class="bx bx-check text-success me-2"></i>Mechanical Breakdowns</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Not Covered Section -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="notCoveredHeading">
                                <button class="accordion-button collapsed text-danger" type="button" data-bs-toggle="collapse" data-bs-target="#notCoveredCollapse" aria-expanded="false" aria-controls="notCoveredCollapse">
                                    <i class="bx bx-x-circle me-2"></i> What's Not Covered
                                </button>
                            </h2>
                            <div id="notCoveredCollapse" class="accordion-collapse collapse" aria-labelledby="notCoveredHeading" data-bs-parent="#insuranceAccordion">
                                <div class="accordion-body">
                                    <ul class="list-unstyled mb-0">
                                        <li class="not-covered-item"><i class="bx bx-x text-danger me-2"></i>Driving under the influence</li>
                                        <li class="not-covered-item"><i class="bx bx-x text-danger me-2"></i>Reckless or dangerous driving</li>
                                        <li class="not-covered-item"><i class="bx bx-x text-danger me-2"></i>Racing or off-road driving</li>
                                        <li class="not-covered-item"><i class="bx bx-x text-danger me-2"></i>Failing to report accident within 24 hours</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Minor Damage & Fines Info -->
                    <div class="alert alert-info mt-4">
                        <h6><i class="bx bx-info-circle"></i> Minor-Damage & Fines Deposit (MDFD)</h6>
                        <p class="mb-2">We require only a <strong>refundable deposit of Rs 8,000</strong> (instead of Rs 25,000 excess) to cover:</p>
                        <ul class="mb-0">
                            <li>Traffic fines (e.g., speed cameras, parking tickets)</li>
                            <li>Minor vehicle damages during rental</li>
                        </ul>
                        <p class="mt-2 mb-0"><small>Full refund applies if no fines or damage occur.</small></p>
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
                    activeSection: 'itinerary',
                     // Final data (used for display and saved)
                    pickupLocation: '',
                    pickupDate: '',
                    returnLocation: '',
                    returnDate: '',

                    // Temporary input data (used in form only)
                    tempPickupLocation: '',
                    tempPickupDate: '',
                    tempReturnLocation: '',
                    tempReturnDate: '',
                    
                    sameLocation: true,
                    selectedCarId: null,
                    selectedCar: null,
                    searchQuery: '',
                    cars: @json($cars),
                    hasDriver: false,
                    childQuantity: 0,
                    perDayRate: 0, // dynamically filled from selectedCar.price_per_day
                    driverRate: 5,
                    childSeatRate: 35,

                    minDateTime: new Date().toISOString().slice(0, 16), // 'YYYY-MM-DDTHH:MM'

                };
            },
            mounted() {
                const saved = JSON.parse(localStorage.getItem('bookingForm'));
                if (saved) {
                    this.pickupLocation = saved.pickupLocation || '';
                    this.pickupDate = saved.pickupDate || '';
                    this.returnLocation = saved.returnLocation || '';
                    this.returnDate = saved.returnDate || '';
                    this.sameLocation = saved.sameLocation !== undefined ? saved.sameLocation : true;
                    this.selectedCarId = saved.carId || null;

                }


                const stored = localStorage.getItem('selectedAddons');
                if (stored) {
                    const addons = JSON.parse(stored);
                    this.hasDriver = addons.driver === 1;
                    this.childQuantity = addons.child ?? 1;
                }

                const savedSection = localStorage.getItem('activeReservationSection');
                if (savedSection) {
                    this.activeSection = savedSection;
                }
            },
            watch: {
                sameLocation(newVal) {
                    if (newVal) {
                        this.returnLocation = this.pickupLocation;
                    }
                },
                pickupLocation(newVal) {
                    if (this.sameLocation) {
                        this.returnLocation = newVal;
                    }
                },
                selectedCarId(newId) {
                    this.selectedCar = this.cars.find(car => car.id === newId);

                    this.perDayRate = this.selectedCar ? Number(this.selectedCar.price_per_day) : 0;
                }
            },
            computed: {
                isItineraryComplete() {
                    return (
                        this.pickupLocation &&
                        this.pickupDate &&
                        this.returnLocation &&
                        this.returnDate
                    );
                },
                isVehicleComplete(){
                    return(
                        this.selectedCar
                    );
                },
                formattedPickupDate() {
                    return this.pickupDate
                        ? new Date(this.pickupDate).toLocaleString('en-GB', {
                            day: 'numeric', month: 'long', year: 'numeric',
                            hour: '2-digit', minute: '2-digit', hour12: true
                        })
                        : '—';
                },
                formattedReturnDate() {
                    return this.returnDate
                        ? new Date(this.returnDate).toLocaleString('en-GB', {
                            day: 'numeric', month: 'long', year: 'numeric',
                            hour: '2-digit', minute: '2-digit', hour12: true
                        })
                        : '—';
                },
                filteredCars() {
                    const term = this.searchQuery.toLowerCase();
                    return this.cars.filter(car =>
                        car.name.toLowerCase().includes(term) ||
                        (car.type && car.type.toLowerCase().includes(term)) ||
                        (car.fuel_type && car.fuel_type.toLowerCase().includes(term)) ||
                        (car.transmission && car.transmission.toLowerCase().includes(term))
                    );
                },

                rentalDays() {
                    const start = new Date(this.pickupDate);
                    const end = new Date(this.returnDate);
                    const diffTime = end - start;
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    return isNaN(diffDays) || diffDays < 1 ? 1 : diffDays;
                },
                baseSubtotal() {
                    return this.perDayRate * this.rentalDays;
                },
                addonsTotal() {
                    let total = 0;
                    if (this.hasDriver) total += this.driverRate;
                    if (this.childQuantity > 0) total += this.childQuantity * this.childSeatRate;
                    return total;
                },
                totalRate() {
                    return this.baseSubtotal + this.addonsTotal;
                }
            },
            methods: {
                // ✅ Add this method
                validateDates() {
                    const now = new Date();
                    const pickup = new Date(this.pickupDate);
                    const dropoff = new Date(this.returnDate);

                    if (pickup < now) {
                        alert("Pick-up date/time cannot be in the past.");
                        return false;
                    }

                    if (dropoff <= pickup) {
                        alert("Drop-off date/time must be after pick-up date/time.");
                        return false;
                    }

                    return true;
                },

                // ✅ Add this method too
                handleContinue() {
                    const pickup = new Date(this.tempPickupDate);
                    const dropoff = new Date(this.tempReturnDate);
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
                        this.returnLocation = this.tempPickupLocation;
                    } else {
                        this.returnLocation = this.tempReturnLocation;
                    }

                    // Valid → apply values
                    this.pickupLocation = this.tempPickupLocation;

                    this.pickupDate = this.tempPickupDate;
                    this.returnDate = this.tempReturnDate;

                    this.searchCars();
                    this.showSection('cars');

                },

                searchCars() {
                    const data = {
                        pickupLocation: this.pickupLocation,
                        pickupDate: this.pickupDate,
                        returnLocation: this.returnLocation,
                        returnDate: this.returnDate,
                        sameLocation: this.sameLocation,
                        carId: this.selectedCarId
                    };
                    localStorage.setItem('bookingForm', JSON.stringify(data));
                    alert("Search triggered and form data saved.");
                },
                showSection(sectionName) {
                    this.activeSection = sectionName;
                    localStorage.setItem('activeReservationSection', sectionName);
                },
                clearForm() {
                    this.pickupLocation = '';
                    this.pickupDate = '';
                    this.returnLocation = '';
                    this.returnDate = '';
                    this.sameLocation = true;
                    this.selectedCarId = null;
                    localStorage.removeItem('bookingForm');
                },
                selectCar(id) {
                    this.selectedCarId = id;
                    const saved = JSON.parse(localStorage.getItem('bookingForm')) || {};
                    saved.carId = id;
                    localStorage.setItem('bookingForm', JSON.stringify(saved));
                    alert('Selected car ID: ' + id);
                },
                bookNow(carId) {
                    const saved = JSON.parse(localStorage.getItem('bookingForm')) || {};
                    saved.carId = carId;
                    localStorage.setItem('bookingForm', JSON.stringify(saved));
                    // Optional: redirect or change section
                    // this.showSection('addons');
                },
                toggleDriver() {
                    this.hasDriver = !this.hasDriver;
                    this.saveAddons();
                },
                changeQuantity(type, amount) {
                    if (type === 'child') {
                        this.childQuantity = Math.min(Math.max(this.childQuantity + amount, 0), 3);
                        this.saveAddons();
                    }
                },
                saveAddons() {
                    localStorage.setItem('selectedAddons', JSON.stringify({
                        driver: this.hasDriver ? 1 : 0,
                        child: this.childQuantity
                    }));
                }
            }
            
        });

        app.mount('#bookingApp');
   </script>





@endsection