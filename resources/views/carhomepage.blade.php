@extends('layouts.maincarlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/carhomepage.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/carhomepage.css') }}">
    @endif

    <section class="hero-section">
        <div class="container-fluid d-flex justify-content-center align-items-center">
            <div class="hero-content text-center">
                <h1 class="display-4 fw-bold">#1 Car Rental </h1>
                <h2 style="margin-bottom:50px;">in Mauritius</h2>
        
                <div class="booking-form">
                    <div class="booking-form-top d-flex flex-wrap gap-3 justify-content-center">
                        <div class="form-group">
                            <label>Pick-up location</label>
                            <select id="pickupLocation" class="form-control">
                                <option>Pick up location</option>
                                <option>New York</option>
                                <option>Los Angeles</option>
                                <option>Chicago</option>
                                <option>Miami</option>
                            </select>
                        </div>
        
                        <div class="form-group">
                            <label>Pick-up date</label>
                            <input type="date" id="pickupDate" class="form-control">
                        </div>
        
                        <div class="form-group">
                            <label>Return location</label>
                            <select id="returnLocation" class="form-control">
                                <option>Return location</option>
                                <option>New York</option>
                                <option>Los Angeles</option>
                                <option>Chicago</option>
                                <option>Miami</option>
                            </select>
                        </div>
        
                        <div class="form-group">
                            <label>Return date</label>
                            <input type="date" id="returnDate" class="form-control">
                        </div> 
                        <div class="form-group">
                            <p></p>
                            <button class="btn btn-primary px-4" onclick="searchCars()" style="margin-top:5px;">Search</button>
                        </div>
                    </div>
        
                    <!-- <div class="booking-form-button mt-3 text-end">
                       
                    </div> -->
                </div>
            </div>
        </div>
        
    </section>

    <!-- Featured Cars Section -->
    <section class="featured-section">
        <div class="container">
        <div class="section-header text-start">
            <h2 class="section-heading" style="color:rgb(58, 58, 58);">Featured Vehicles</h2>
            <!-- <p class="section-subtitle">Discover our most popular vehicles with special offers</p> -->
        </div>

        <div class="car-grid">
            <!-- suzuki_swift -->
            <div class="car-card">
            <!-- <div class="car-badge">New in Stock</div> -->
            <div class="car-image">
                <img  src="{{ asset('images/cars/suzuki_swift.jpg') }}">
            </div>
            <div class="car-info">
                <div class="car-header">
                <div>
                    <h3 class="car-title">Suzuki Swift</h3>
                    <p class="car-subtitle">Automatic • Gasoline</p>
                </div>
                <div class="car-price">
                    <span class="price-amount">€60</span>
                    <span class="price-period">Per day</span>
                </div>
                </div>
                
                <div class="car-specs">
                <div class="spec-item">
                    <i class='bx bx-gas-pump spec-icon'></i>
                    <span>Gasoline</span>
                </div>
                <div class="spec-item">
                    <i class='bx bx-cog spec-icon'></i>
                    <span>Automatic</span>
                </div>
                <div class="spec-item">
                    <i class='bx bxs-user spec-icon'></i>
                    <span>5 Seats</span>
                </div>
                <div class="spec-item">
                    <i class='bx bx-wind spec-icon'></i>
                    <span>Climate Control</span>
                </div>
                </div>

                <div class="car-actions">
                <button class="btn btn-primary" onclick="window.location.href='rentcar.html'">Book Now</button>

                </div>
            </div>
            </div>

            <!-- suzuki celerio-->
            <div class="car-card">
            <!-- <div class="car-badge">New in Stock</div> -->
            <div class="car-image">
              <img src="{{ asset('images/cars/suzuki_celerio.jpg') }}">
            </div>
            <div class="car-info">
                <div class="car-header">
                <div>
                    <h3 class="car-title">Suzuki Celerio</h3>
                    <p class="car-subtitle">Automatic • Gasoline</p>
                </div>
                <div class="car-price">
                    <span class="price-amount">€60</span>
                    <span class="price-period">Per day</span>
                </div>
                </div>
                
                <div class="car-specs">
                <div class="spec-item">
                    <i class='bx bx-gas-pump spec-icon'></i>
                    <span>Gasoline</span>
                </div>
                <div class="spec-item">
                    <i class='bx bx-cog spec-icon'></i>
                    <span>Automatic</span>
                </div>
                <div class="spec-item">
                    <i class='bx bxs-user spec-icon'></i>
                    <span>5 Seats</span>
                </div>
                <div class="spec-item">
                    <i class='bx bx-wind spec-icon'></i>
                    <span>Climate Control</span>
                </div>
                </div>

                <div class="car-actions">
                <button class="btn btn-primary" onclick="window.location.href='rentcar.html'">Book Now</button>

                </div>
            </div>
            </div>

            <!-- Suzuki Spresso -->
            <div class="car-card">
            <!-- <div class="car-badge">New in Stock</div> -->
            <div class="car-image">
                <img src="{{ asset('images/cars/suzuki_spresso.jpg') }}">
            </div>
            <div class="car-info">
                <div class="car-header">
                <div>
                    <h3 class="car-title">Suzuki Spresso</h3>
                    <p class="car-subtitle">Automatic • Gasoline</p>
                </div>
                <div class="car-price">
                    <span class="price-amount">€60</span>
                    <span class="price-period">Per day</span>
                </div>
                </div>
                
                <div class="car-specs">
                <div class="spec-item">
                    <i class='bx bx-gas-pump spec-icon'></i>
                    <span>Gasoline</span>
                </div>
                <div class="spec-item">
                    <i class='bx bx-cog spec-icon'></i>
                    <span>Automatic</span>
                </div>
                <div class="spec-item">
                    <i class='bx bxs-user spec-icon'></i>
                    <span>5 Seats</span>
                </div>
                <div class="spec-item">
                    <i class='bx bx-wind spec-icon'></i>
                    <span>Climate Control</span>
                </div>
                </div>

                <div class="car-actions">
                <button class="btn btn-primary" onclick="window.location.href='rentcar.html'">Book Now</button>

                </div>
            </div>
            </div>


        </div>
        </div>
    </section>

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


    
@endsection