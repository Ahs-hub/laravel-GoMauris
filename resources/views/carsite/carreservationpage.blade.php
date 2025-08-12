@extends('layouts.maincarlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/carreservationpage.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/carreservationpage.css') }}">
    @endif
 
    <!-- for location map -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    />
   <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

    <div id="bookingApp">

        <!-- Hero Section            -->
        <div class="hero-section" >
            <div class="hero-content">
                <div class="steps row justify-content-center text-center" >
                    <h1 class="display-4 fw-bold">Reservation</h1>
                        <!-- Reservation initiary Form Section -->
                    <div class="col-12 col-md-4 step text-start mb-4"  @click="showSection('itinerary')">
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
                    <div class="col-12 col-md-4 step text-start mb-4"  @click="showSection('cars')">
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
                    <div class="col-12 col-md-4 step text-start mb-4" @click="showSection('summary')">
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
                        <!-- <select class="form-select" v-model="tempPickupLocation" id="pickupLocation" required>
                            <option selected disabled>Choose Location</option>
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
                                                @{{ pickupLocation || 'Select pick up location' }}
                                            </div>
                                    </button>
                                    <ul class="dropdown-menu w-100">
                                        <li @click="pickupLocation = 'SSR Airport'" class="dropdown-item">
                                            <i class='bx bx-map'></i> SSR Airport
                                        </li>
                                        <li @click="pickupLocation = 'Mahebourg'" class="dropdown-item">
                                            <i class='bx bx-map'></i> Mahebourg
                                        </li>
                                        <li @click="pickupLocation = 'Port Louis'" class="dropdown-item">
                                            <i class='bx bx-map'></i> Port Louis
                                        </li>
                                        <li @click="pickupLocation = 'Grand Baie'" class="dropdown-item">
                                            <i class='bx bx-map'></i> Grand Baie
                                        </li>
                                        <li class="dropdown-item" @click="openMap('pickup')">
                                            <i class='bx bx-map-pin'></i> Choose on map
                                        </li>
                                    </ul>
                        </div>
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
                            <!-- <select class="form-select" id="returnLocation" v-model="tempReturnLocation" required>
                                <option disabled value="">Choose Location</option>
                                <option>Mahebourg</option>
                                <option>Port Louis</option>
                                <option>SSR Airport</option>
                                <option>Grand Baie</option>
                            </select>
                            </div> -->
                            <div class="dropdown form-control p-0 ">
                                <button class="btn selectinput-place dropdown-toggle w-100 text-start d-flex align-items-center justify-content-between"
                                        type="button" data-bs-toggle="dropdown">
                                        <div>
                                            <i class='bx bx-map me-2'></i> 
                                            @{{ returnLocation || 'Select return up location' }}
                                        </div>
                                </button>
                                <ul class="dropdown-menu w-100">
                                    <li @click="returnLocation = 'SSR Airport'" class="dropdown-item">
                                        <i class='bx bx-map'></i> SSR Airport
                                    </li>
                                    <li @click="returnLocation = 'Mahebourg'" class="dropdown-item">
                                        <i class='bx bx-map'></i> Mahebourg
                                    </li>
                                    <li @click="returnLocation = 'Port Louis'" class="dropdown-item">
                                        <i class='bx bx-map'></i> Port Louis
                                    </li>
                                    <li @click="returnLocation = 'Grand Baie'" class="dropdown-item">
                                        <i class='bx bx-map'></i> Grand Baie
                                    </li>
                                    <li class="dropdown-item" @click="openMap('return')">
                                        <i class='bx bx-map-pin'></i> Choose on map
                                    </li>
                                </ul>
                            </div>
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
                    <div class="col-12 mt-3">
                        <div class="d-flex flex-column flex-md-row justify-content-center justify-content-md-end gap-2">
                            <button
                                type="submit"
                                class="btn btn-primary px-4 fw-bold"
                                @click.prevent="handleContinue"
                            >
                                Continue
                            </button>

                            <button
                                type="button"
                                class="btn btn-primary px-4 fw-bold"
                                @click.prevent="clearForm"
                            >
                                Clear all data
                            </button>
                        </div>
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
                                                 <button class="btn btn-primary" @click="selectCar(car.id,car.name); showSection('carsaddon')">Book Now</button>
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
                            <form @submit.prevent="submitDriverDetails">
                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control" v-model="form.first_name" placeholder="John" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Last Name</label>
                                        <input type="text" class="form-control" v-model="form.last_name" placeholder="Doe" required>
                                    </div>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Driver Age</label>
                                        <input type="number" class="form-control" v-model="form.driver_age" min="16" max="100" placeholder="25" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Mobile Number <small class="text-muted">(WhatsApp)</small></label>
                                        <input type="tel" class="form-control" v-model="form.phone" placeholder="+230 5504 0167" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" v-model="form.email" placeholder="john.doe@example.com" required>
                                    <div class="form-text">Service voucher will be sent to this email</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Message / Special Requests</label>
                                    <textarea class="form-control" rows="4" v-model="form.special_requests" placeholder="Write your notes or special requests here..."></textarea>
                                </div>

                                <button 
                                      v-if="!loading"
                                      type="submit" 
                                      class="btn btn-primary px-5 py-2 fw-bold fs-6"
                                      >
                                    Send Quote
                                </button>

                                <!-- Spinner (show when loading) -->
                                <div v-if="loading" class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="col-lg-4 total-esti-form">
 
                        
                        <!-- Rate Section -->
                        <div class="rate-section p-3 border rounded shadow-sm bg-light">
                            <div v-if="selectedCar" >
                                <img :src="selectedCar.image_url" :alt="selectedCar.name" class="car-image">
                                <h2 class="car-title">@{{ selectedCar.name }}</h2>
                            </div>

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

    <!-- Ensure this is within an element with id="bookingApp" -->
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const app = Vue.createApp({
            data() {
                return {
                    loading: false,

                    activeSection: 'itinerary',
                     // Final data (used for display and saved)
                    pickupLocation: '',
                    pickupDate: '',
                    returnLocation: '',
                    returnDate: '',

                    //location map
                    pickupLat: null,
                    pickupLng: null,
                    returnLat: null,
                    returnLng: null,

                    //Modal map
                    showMapModal: false,
                    selectedLatLng: null,
                    mapInstance: null,
                    marker: null,
                    mapTarget: '', // can be 'pickup' or 'return'

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

                    form : {
                        first_name: "",
                        last_name: "",
                        driver_age: null,

                        pickup_location: "",
                        pickup_date: "",
                        return_location: "",
                        return_date: "",

                        email: "",
                        phone: "",
                        car_id: null,  // <-- required! Make sure to send the selected car ID
                        has_driver: false,
                        child_seats: 0,
                        same_location: true,
                        special_requests: ""
                    }

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

                    this.sameLocation = saved.sameLocation || '';

                    this.returnDate = saved.returnDate || '';
                    this.tempReturnDate = saved.returnDate || '';

                    this.sameLocation = saved.sameLocation !== undefined ? saved.sameLocation : true;
                    this.selectedCarId = saved.carId || null;

                    // // ✅ Restore coordinates if saved
                    // this.pickupLat = savedData.pickupLat || null;
                    // this.pickupLng = savedData.pickupLng || null;
                    // this.returnLat = savedData.returnLat || null;
                    // this.returnLng = savedData.returnLng || null;

                }


                const stored = sessionStorage.getItem('selectedAddons');
                if (stored) {
                    const addons = JSON.parse(stored);
                    this.hasDriver = addons.driver === 1;
                    this.childQuantity = addons.child ?? 1;
                }

                const savedSection = sessionStorage.getItem('activeReservationSection');
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
                },
                showMapModal(Val) {
                    if (Val) {
                    this.$nextTick(() => {
                        this.initMap();
                    });
                    }
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
                        this.tempReturnLocation = this.tempPickupLocation;

                        // ✅ Copy coordinates too
                        this.returnLat = this.pickupLat;
                        this.returnLng = this.pickupLng;
                    } else {
                        this.returnLocation = this.tempReturnLocation;
                    }

                    // ✅ Basic null or empty checks
                    if (!this.tempPickupLocation || !this.tempReturnLocation || !this.tempPickupDate || !this.tempReturnDate) {
                        alert("Please fill in all required fields.");
                        return;
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
                        carId: this.selectedCarId,

                        // 💾 Save coordinates here too
                        pickupLat: this.pickupLat,
                        pickupLng: this.pickupLng,
                        returnLat: this.returnLat,
                        returnLng: this.returnLng
                    };
                    sessionStorage.setItem('bookingForm', JSON.stringify(data));
                    alert("Search triggered and form data saved.");
                },
                showSection(sectionName) {
                    this.activeSection = sectionName;
                    sessionStorage.setItem('activeReservationSection', sectionName);
                },
                clearForm() {
                    this.pickupLocation = null;
                    this.pickupDate = null;
                    this.returnLocation = null;
                    this.returnDate = null;
                    this.sameLocation = null;
                    this.selectedCarId = null;

                    this.pickupLat = "";
                    this.pickupLng = "";
                    this.returnLat = "";
                    this.returnLng = "";

                    sessionStorage.removeItem('bookingForm');
                    sessionStorage.removeItem('activeReservationSection');
                    sessionStorage.removeItem('selectedAddons');
                    window.location.href = '/reservation';
                },
                selectCar(id,name) {
                    this.selectedCarId = id;
                    const saved = JSON.parse(sessionStorage.getItem('bookingForm')) || {};
                    saved.carId = id;
                    sessionStorage.setItem('bookingForm', JSON.stringify(saved));
                    // alert('Selected car: ' + name);
                },
                bookNow(carId) {
                    const saved = JSON.parse(sessionStorage.getItem('bookingForm')) || {};
                    saved.carId = carId;
                    sessionStorage.setItem('bookingForm', JSON.stringify(saved));
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
                    sessionStorage.setItem('selectedAddons', JSON.stringify({
                        driver: this.hasDriver ? 1 : 0,
                        child: this.childQuantity
                    }));
                },
                 
                submitDriverDetails() {
                    this.loading = true;

                    const bookingForm = JSON.parse(sessionStorage.getItem('bookingForm') || '{}');
                    const selectedAddons = JSON.parse(sessionStorage.getItem('selectedAddons') || '{}');

                    // Basic validation
                    if (!bookingForm.pickupLocation || !bookingForm.pickupDate || !bookingForm.returnLocation || !bookingForm.returnDate) {
                        alert('Please fill in pickup and return location/date.');
                        return;
                    }

                    if (!bookingForm.carId) {
                        alert('Please select a car.');
                        return;
                    }

                    const payload = {
                        ...selectedAddons,
                        ...this.form,
                        pickup_location: bookingForm.pickupLocation,
                        pickup_latitude: bookingForm.pickupLat,
                        pickup_longitude: bookingForm.pickupLng,

                        pickup_date: bookingForm.pickupDate,
                        return_location: bookingForm.returnLocation,
                        return_latitude: bookingForm.returnLat,
                        return_longitude: bookingForm.returnLng,

                        return_date: bookingForm.returnDate,
                        same_location: bookingForm.sameLocation,
                        car_id: bookingForm.carId,
                        has_driver: selectedAddons.driver === 1,
                        child_seats: selectedAddons.child || 0,
                    };

                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    console.log('Sending to server:', payload);

                    fetch('/send-quote', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify(payload) // ✅ FIXED: Was `formData` before, now correct
                    })
                    .then(res => {
                        if (!res.ok) throw new Error('Network response was not ok');
                        return res.json();
                    })
                    .then(response => {
                        if (response.success) {
                            this.clearForm(); // ✅ Clear form and localStorage
                            window.location.href = '/thank-you?type=car';
                        } else {
                            alert('Something went wrong.');
                        }
                    })
                    .catch(err => {
                        console.error('Error:', err);
                        alert('Failed to send quote.');
                    })
                    .finally(() => {
                        this.loading = false;
                    });
                },


                //Add map location
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
                            this.tempPickupLocation = address;
                            this.pickupLat = lat;
                            this.pickupLng = lng;
                        } else if (this.mapTarget === 'return') {
                            this.returnLocation = address;
                            this.tempReturnLocation = address;
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


            }
            
        });

        app.mount('#bookingApp');
   </script>





@endsection