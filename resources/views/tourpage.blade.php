
@extends('layouts.mainlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/tourpage.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/tourpage.css') }}">
    @endif



    <!-- Hero Section -->
    <section class="services-hero">
        <div class="container">
            <h1 class="hero-title mb-4">Tour</h1>
        </div>
    </section>

    <!-- Search and Filter Section -->
    <section class="search-filter-section">
        <div class="container">
            <div class="search-box">
                <div class="row align-items-center">

                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="bx bx-search"></i>
                            </span>
                            <input type="text" class="form-control border-0" placeholder="Search tours..." id="searchInput">
                        </div>

                </div>
            </div>
        </div>
        <div class="filter-buttons text-center" style="margin-top:25px;">
           <button class="btn button-text category-btn active" data-category="all">All Tours</button>
            @foreach ($categories as $category)
                <button class="btn button-text category-btn" data-category="{{ $category->slug }}">
                    {{ $category->name }}
                </button>
            @endforeach
        </div>
    </section>


    <!-- Services Section -->
    <section class="py-5">
        <div class="container">
            <div class="row" id="servicesContainer">
                

            @foreach ($tours as $tour)
                <div class="col-md-3 tour-card" data-category="{{ $tour->category->slug }}">
                    <div class="card destination-card">
                        <img src="{{ asset($tour->main_image) }}" class="card-img-top" alt="{{ $tour->name }}">
                        <div class="card-body text-start">
                            <h5 class="card-title">{{ $tour->name }}</h5>
                            <p class="card-time">{{ floor($tour->duration_minutes / 60) }} hours &nbsp;•&nbsp; {{ $tour->pickup_included ? 'Pickup Included' : '' }}</p>
                            <div class="tour-rating mb-2">
                                @for ($i = 0; $i < floor($tour->average_rating); $i++)
                                    <i class="bx bxs-star"></i>
                                @endfor
                                @if ($tour->average_rating - floor($tour->average_rating) >= 0.5)
                                    <i class="bx bxs-star-half"></i>
                                @endif
                                <span class="rating-text">{{ $tour->average_rating }} ({{ $tour->total_reviews }})</span>
                            </div>
                            <p class="from-text">From</p>
                            <p><strong class="tour-price">${{ $tour->starting_price }}</strong> <span class="per-person">per person</span></p>
                        </div>
                    </div>
                </div>
                @endforeach
                 

            </div>
        </div>
    </section>

    <!-- Section Divider -->
    <div class="container">
        <div class="section-divider"></div>
    </div>

    <!-- Marriage Planning Special Section -->
    <section class="marriage-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1606216794074-735e91aa2c92?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Wedding Planning" class="marriage-image">
                </div>
                <div class="col-lg-6">
                    <div class="marriage-content">
                        <h2 class="section-heading mb-4" style="font-weight: 700; color:var(--primary-color);">We Offer Marriage Planning</h2>
                        <p class="paragraph-text mb-4" style=" color: grey;">Make your special day unforgettable with our comprehensive marriage planning services. From intimate beach ceremonies to grand destination weddings, we handle every detail with precision and care.</p>
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bx bx-check-circle text-success me-3" style="font-size: 1.5rem;"></i>
                                    <span style="color:grey">Venue Selection</span>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bx bx-check-circle text-success me-3" style="font-size: 1.5rem;"></i>
                                    <span style="color:grey">Decoration & Catering</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bx bx-check-circle text-success me-3" style="font-size: 1.5rem;"></i>
                                    <span style="color:grey">Photography & Video</span>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bx bx-check-circle text-success me-3" style="font-size: 1.5rem;"></i>
                                    <span style="color:grey;">Honeymoon Packages</span>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="service-btn" style="padding: 15px 40px; font-size: 1.1rem;">Start Planning Your Dream Wedding</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


     


     <script src="{{ asset('js/style.js') }}"></script>

@endsection