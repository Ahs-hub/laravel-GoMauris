@extends('layouts.mainlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/whislistpage.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/whislistpage.css') }}">
    @endif

    <section class="hero-section" style="margin-top:100px;">
        <div class="container">
        <div class="hero-content">
            <!-- <h1 class="hero-title">Premium Car Rental Experience</h1>
            <p class="hero-subtitle">Choose from our exclusive fleet of luxury and economy vehicles</p> -->
            <h3 class="section-heading">Your Wishlist</h3>
        </div>
        </div>
    </section>

    <!--Wishlist section-->
    <section class="wishlist-container" id="wishlist-display-app">


        <!-- Wishlist Items -->
        <div class="wishlist-items" id="wishlistItems">
            <!-- Tour -->
             <div class="wishlist-item">
                <div class="wishlist-card">
                  <div class="card-image">
                    <img src="img/tour/nature_2.jpg" alt="Suzuki Swift">
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Pamplemouse</h5>
                    <div class="card-price">€60/day</div>
                    <div>Tour</div>
                  </div>
                  <button class="remove-icon" onclick="removeItem(this)">
                    <i class='bx bx-x'></i>
                  </button>
                </div>
              </div>
        </div>

        <!-- Empty State -->
        <div class="empty-wishlist d-none" id="emptyState">
            <i class='bx bx-heart'></i>
            <h4>Your wishlist is empty</h4>
            <p>Start exploring our cars, tours, and activities to add items to your wishlist</p>
        </div>

        <!-- Clear Wishlist Section -->
        <div class="clear-wishlist-section" id="clearSection">
            <button class="clear-btn" onclick="clearWishlist()">
                <i class='bx bx-trash-alt'></i>
                Clear Wishlist
            </button>
        </div>
    </section>

    <!-- Car Section -->
    <section class="py-5 " style="background: var(--primary-color);">
        <div class="container">
            <div class="row align-items-center">
            
            <!-- Left Side: Text Content -->
            <div class="col-md-6 mb-4 mb-md-0" style="color:white;">
                <h2 class="fw-bold">Need a car?</h2>
                <p class="lead">Rent now and get <strong>10% discount</strong> on all our vehicles. Perfect for tours, business trips, and more!</p>
                <a href="#rent" class="btn btn-lg rounded-0" style="background-color: rgb(255, 166, 50); color:white;">Rent Car</a>
            </div>
        
            <!-- Right Side: Image -->
            <div class="col-md-6 text-center">
                <img  style="width:400px;" src="img/car/transcar.png" alt="Car Rental" class="img-fluid rounded ">
            </div>
        
            </div>
        </div>
    </section>

    <script>
      const allTours = @json($allTours); // Pass all tours from DB
  </script>

@endsection
