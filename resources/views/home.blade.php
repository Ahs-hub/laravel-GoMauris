
@extends('layouts.mainlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/home.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @endif
    <!--<link rel="stylesheet" href="{{ secure_asset('css/home.css') }}"> -->

     <!-- Hero Section -->
     <section id="home" class="hero">
        <div class="video-background">
          <iframe src="https://www.youtube.com/embed/nd0w4nM1vEc?autoplay=1&mute=1&loop=1&controls=0&showinfo=0&modestbranding=1&playlist=nd0w4nM1vEc"
            frameborder="0"
            allow="autoplay; encrypted-media"
            allowfullscreen>
          </iframe>
        </div>
      
        <div class="container content hero-content">
          <h1 class="hero-title">Let Mauritius Vacation Be Your Next Escape</h1>
      
          <div class="button-group">
            <button class="btn btn-form" onclick="window.location.href='{{ route('tours.index') }}'"><i class='bx bx-map'></i> Explore Mauritius</button>
            <button class="btn btn-form"><i class='bx bx-camera'></i> Sightseeing</button>
            <button class="btn btn-form"><i class='bx bx-run'></i> Activities</button>
            <button class="btn btn-form" onclick="window.location.href='{{ route('cars.home') }}'"><i class='bx bx-car'></i> Car Rental</button>
            
          </div>
      
          <div class="cta-wrapper">
            <button class="btn btn-primary btn-lg cta-button rad-0" style="background-color:#05123E;">
             Customize Tours
            </button>
          </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="section-padding">

        <div class="container">    
            <div class="row" style="margin-bottom:10px;">
                <div class="col-lg-8 mx-auto text-center">   
                <a class="section-heading" style="text-decoration: none;">Our Service</a>
                <div style="width: 60px; height: 3px; background-color: #274993; margin: 8px auto 0;"></div>
                </div>
            </div>
                <!-- <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-heading">Your Trusted Guide to Mauritius</h2>
                    <p class="subheading " style="color: var(--gray-dark);">Our Service</p>
                </div>
            </div> -->

            <!-- Swiper Container -->
            <div class="swiper mySwiper" >
                <div class="swiper-wrapper">
                    <!-- Repeated Swiper Slides -->
                    <!-- Just showing 1 for example -->
                    <div class="swiper-slide">
                        <div class="swiper-service-card" style="background-image: url('images/services/accomodation.jpg');">
                            <div class="swiper-service-overlay">
                                <h5>Accomodation</h5>
                                <p class="description">Book a hotel or villas with a discount and save up to 60%</p>
                                <button type="submit" class="btn btn-primary btn-lg button-text description" >
                                    More
                                </button>
                                <p class="price-tag">500+ Hotels & Villas</p>
                            </div>
                        </div>
                    </div>
                    <!-- ... other slides repeated -->
                    <div class="swiper-slide">
                        <div class="swiper-service-card" style="background-image: url('images/services/private_airport_transfer.jpg');">
                            <div class="swiper-service-overlay">
                                <h5>Private Airport Transfer</h5>
                                <p class="description">Private Transfers . Cars, Minivans,SUVs, Coaster .Free Child Seat</p>
                                <button type="submit" class="btn btn-primary btn-lg button-text description" >
                                    More
                                </button>
                                <p class="price-tag">From €33 per transfer</p>
                        </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="swiper-service-card" style="background-image: url('images/services/luxury_airport_transfer.jpg');">
                            <div class="swiper-service-overlay">
                                <h5>Luxury Airport Transfer</h5>
                                <p class="description paragraph-text">Private VIP Transfer . Incl. BMW x5, x7 & similar</p>
                                <button type="submit" class="btn btn-primary btn-lg button-text description" >
                                    More
                                </button>
                                <p class="price-tag">From €140 per transfer</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="swiper-service-card" style="background-image: url('images/services/sightseeing_tour.jpg');">
                            <div class="swiper-service-overlay">
                                <h5>Sightseeing tour</h5>
                                <p class="description">Explore Mauritius with our friendly & professional drivers</p>
                                <button type="submit" class="btn btn-primary btn-lg button-text description" >
                                    More
                                </button>
                                <p class="price-tag">€83 for a party of 4</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="swiper-service-card" style="background-image: url('images/services/taxi_ride.jpg');">
                            <div class="swiper-service-overlay">
                                <h5>Taxi ride</h5>
                                <p class="description">Need a transfer from Point A to B?With a return ?It's here </p>
                                <button type="submit" class="btn btn-primary btn-lg button-text description" >
                                    More
                                </button>
                                <p class="price-tag">Round-trips for €25</p>
                            </div>
                        </div>
                    </div>



                </div>

                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>

                <!-- Add Navigation buttons -->
                <div class="swiper-button-next" style="display:none;"></div>
                <div class="swiper-button-prev" style="display:none;"></div>
            </div>

            <!-- <p class=".paragraph-text text-center " style="margin-top:50px; color:grey;">
                Mauritius is a vibrant mosaic of cultures, where people of Indian, African, Chinese, 
                and European heritage live together in harmony, creating a unique blend of traditions,
                festivals, and flavors. From the lively rhythms of Sega music to colorful celebrations 
                like Diwali and Chinese New Year, the island pulses with joy and unity. Visitors are welcomed 
                with warm smiles and rich culinary delights, making every experience a heartfelt celebration of
                Mauritius's diverse and thriving culture.
            </p> -->

        </div>



        </div>



        <!-- <div  style="margin-top: 4rem;">
            <div class="col-lg-8 mx-auto text-center">
            <button class="btn btn-primary btn-lg rad-0" onclick="window.location.href='{{ route('service') }}'">View All Services →</button>

        </div> -->
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section-padding py-5" style="background: var(--gray-light);">
        <div class="container">
            <div class="row align-items-center gy-4 gx-5">
                <!-- Image Column -->
                <div class="col-lg-6">
                    <div class="img-placeholder rounded" style="height: 400px; overflow: hidden;">
                        <img src="{{ asset('images/backgrounds/lemorne.png') }}"
                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;"
                            alt="About GoMauris Image">
                    </div>
                </div>

                <!-- Text Column -->
                <div class="col-lg-6">
                <h2 class="section-title section-heading mb-2">
                    About GoMauris Mauritius
                </h2>
                <div style="width: 60px; height: 3px; background-color: #274993; margin: 0 auto 20px 0;"></div>

                    <p class="section-subtitle subheading mb-3">
                        Your trusted partner for exploring Mauritius
                    </p>
                    <p class="paragraph-text mb-3" style="color:#262626;">
                        With years of experience in the Mauritius tourism industry, GoMauris Tours has established itself as a premier car rental and tour operator. We pride ourselves on providing exceptional service, reliable vehicles, and unforgettable experiences.
                    </p>
                    <p class="paragraph-text mb-4" style="color:#262626;">
                        Our team of local experts knows every corner of this beautiful island and is passionate about sharing its wonders with visitors from around the world.
                    </p>

                    <!-- Icon Features -->
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class='bx bx-shield-check text-primary fs-3 me-3'></i>
                                <div>
                                    <h6 class="mb-0">Fully Licensed</h6>
                                    <small class="text-muted" style="color:#262626;">Certified & Insured</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class='bx bx-support text-primary fs-3 me-3'></i>
                                <div>
                                    <h6 class="mb-0">24/7 Support</h6>
                                    <small class="text-muted" style="color:#262626;">Always Here for You</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Text Column -->
            </div>
        </div>
    </section>


    <!-- <section id="about" class="section-padding" style="background: var(--gray-light); ">
        <div class="container">
            <div class="row">
            <div class="col-lg-8 mx-auto text-center" style="margin-bottom:30px;">
                <h2 class="section-heading">We Design “Mauritius Tours” Your Way 
                Best Tailor-Made Private Mauritius Holidays Just for You</h2>

            </div>

       
            <div class="col-12">
                <p class="mb-3 mx-5  fw-medium text-center" style="color:grey;" >
                    MyVac Tours Mauritius specializes in private tours and fully personalized holiday packages across the island. 
                    Whether you're dreaming of a romantic escape, a family getaway, or a thrilling adventure, our dedicated local
                    experts are here to craft unforgettable experiences — just the way you want.We're proud to be recognized for our
                    commitment to quality, customer satisfaction, and authentic Mauritian hospitality. Our passionate team is based right here in Mauritius, ready to accompany you from start to finish, ensuring every moment of your trip is smooth, enriching, and truly memorable.
                </p>
            </div>

          
            <div class="col-12 text-center" style="margin-top:30px; margin-bottom:60px;">
                <h1 class="masked-text">mauritius</h1>
            </div>

            <div class="col-12">
                <p class="mb-3 mx-5  fw-medium text-center" style="color:grey;">
                At MyVac Tours, we don’t offer generic tour packages. 
                Every itinerary is custom-designed around your preferences — budget, travel dates,
                interests, and any special requests. Whether you want to explore hidden beaches, dive into Creole 
                culture, hike lush trails, or savor local cuisine, we’re here to make it happen.
                </p>
            </div>
            </div>
        </div>
   </section> -->


    <!-- Stats Section -->
       <section class="stats-section section-padding" style=" height: auto; background-size: cover; background-position: center;">
        <div class="container" >
            <div class="row text-center">
                <div class="col-lg-4 col-md-6">
                    <div class="stat-item">
                        <span class="stat-number">10+</span>
                        <div class="stat-label">Reviews</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-item">
                        <span class="stat-number">10+</span>
                        <div class="stat-label">Vehicles Available</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-item">
                        <span class="stat-number">15+</span>
                        <div class="stat-label">Tour Packages</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tours Section -->
    <section id="tours" class="section-padding" style="">
     <div class="container text-center">
        <p class="section-heading mt-5">
            Mauritius island is our homeland. We'll show you Mauritius, <br>
            better than anyone else!
        </p>
        <div style="width: 60px; height: 3px; background-color: #274993; margin: 0 auto 16px;"></div>
     </div>
    
        <div class="container text-center my-5">
         
            <!-- Category filter buttons -->
            <div class="d-flex flex-wrap justify-content-center my-3" >
                <button class="btn button-text category-btn active" data-category="all">All Tours</button>

                @foreach ($categories as $category)
                    <button class="btn button-text category-btn" data-category="{{ $category->slug }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>

            
            <!-- Tour cards -->
            <div class="row g-4" style="margin-top:20px;">
                @foreach ($tours as $tour)
                <div class="col-md-3 tour-card" data-category="{{ $tour->category->slug }}">
                <a href="{{ route('tours.show', $tour->slug) }}" style="text-decoration: none; color: inherit;">
                    <div class="card destination-card">
                        <img src="{{ asset($tour->main_image) }}" class="card-img-top" alt="{{ $tour->name }}">
                        <div class="card-body text-start">
                            <h5 class="card-title">{{ $tour->name }}</h5>
                            <p class="card-time">{{ floor($tour->duration_minutes / 60) }} hours &nbsp;•&nbsp; {{ $tour->pickup_included ? 'Pickup Available' : '' }}</p>
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
                            @if ($tour->is_group_priced)
                                <p>
                                    <strong class="tour-price">€{{ $tour->group_price }}</strong>
                                    <span class="per-person">per group of {{ $tour->group_size }}</span>
                                </p>
                            @else
                                <p>
                                    <strong class="tour-price">€{{ $tour->starting_price }}</strong>
                                    <span class="per-person">per person</span>
                                </p>
                            @endif
                        </div>
                    </div>
                </a>
                </div>
                @endforeach
            </div>

        </div>


        <div class="text-center" style="margin-top: 100px;">
            <button class="btn btn-primary btn-lg rad-0" onclick="window.location.href='{{ route('tours.index') }}'">
                View All Tours →
            </button>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section-padding py-5" style="background: var(--gray-light);">
        <div class="container">
            <div class="row align-items-center gy-4 gx-5">

                <!-- Text Column -->
                <div class="col-lg-6">
                    <div class="text-content">
                        <h2 class="section-title section-heading mb-3">
                            Discover the Heart of Mauritius
                        </h2>
                        <div style="width: 60px; height: 3px; background-color: #274993; margin: 0 auto 20px 0;"></div>
                        <p class="paragraph-text" style="color: #262626; font-size: 1rem; line-height: 1.7;">
                            Mauritius is a vibrant mosaic of cultures, where people of Indian, African, Chinese, 
                            and European heritage live together in harmony, creating a unique blend of traditions, 
                            festivals, and flavors. From the lively rhythms of Sega music to colorful celebrations 
                            like Diwali and Chinese New Year, the island pulses with joy and unity.
                        </p>
                        <p class="paragraph-text" style="color: #262626; font-size: 1rem; line-height: 1.7;">
                            Visitors are welcomed with warm smiles and rich culinary delights, making every experience 
                            a heartfelt celebration of Mauritius's diverse and thriving culture.
                        </p>
                    </div>
                </div> <!-- End Text Column -->

                <!-- Image Column -->
                <div class="col-lg-6">
                    <div class="img-placeholder rounded overflow-hidden" style="height: 400px;">
                        <img src="{{ asset('images/backgrounds/mauri.png') }}"
                            alt="About GoMauris Image"
                            style="width: 100%; height: 100%; object-fit: cover; border-radius: 20px;">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Why Choose us -->
    <section id="whychooseus" >
        <div class="container text-center" style="margin-bottom:30px;">
            <p class="section-heading mt-5">
               Why Choose Us?
            </p>
            <div style="width: 60px; height: 3px; background-color: #274993; margin: 0 auto 16px;"></div>
        </div>

        <div class="container">
            <div class="row">
                <!-- Expert Local Guides -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="card-front" style=" background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('../images/backgrounds/guidetourist.jpg');
                            background-position: center;
                            background-size: cover;
                            background-repeat: no-repeat;">
                            <h3 class="feature-title">Expert Local Guides</h3>
                        </div>
                        <div class="card-back">
                            <h3 class="feature-title">Expert Local Guides</h3>
                            <p class="feature-description">Our certified guides are passionate locals who bring destinations to life with authentic stories and insider knowledge.</p>
                        </div>
                    </div>
                </div>

                <!-- Customized Itineraries -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                    <div class="card-front" style=" background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('../images/backgrounds/hiking.jpg');
                            background-position: center;
                            background-size: cover;
                            background-repeat: no-repeat;">
                            <h3 class="feature-title">Custom Itineraries</h3>
                        </div>
                        <div class="card-back">
                            <h3 class="feature-title">Customized Itineraries</h3>
                            <p class="feature-description">Every traveler is unique. We craft personalized itineraries that match your interests, budget, and travel style perfectly.</p>
                        </div>
                    </div>
                </div>

                <!-- Best Price Guarantee -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                    <div class="card-front" style=" background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('../images/backgrounds/price.jpg');
                            background-position: center;
                            background-size: cover;
                            background-repeat: no-repeat;">
                            <h3 class="feature-title">Best Price Guarantee</h3>
                        </div>
                        <div class="card-back">
                            <h3 class="feature-title">Best Price Guarantee</h3>
                            <p class="feature-description">We guarantee the best value for your money with transparent pricing and no surprise charges.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection