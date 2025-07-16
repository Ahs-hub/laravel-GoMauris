
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
          <iframe src="https://www.youtube.com/embed/SiGbWtxeZIA?autoplay=1&mute=1&loop=1&controls=0&showinfo=0&modestbranding=1&playlist=SiGbWtxeZIA"
            frameborder="0"
            allow="autoplay; encrypted-media"
            allowfullscreen>
          </iframe>
        </div>
      
        <div class="container content hero-content">
          <h1 class="hero-title">Let Mauritius Vacation Be Your Next Escape</h1>
      
          <div class="button-group">
            <button class="btn btn-form"><i class='bx bx-map'></i> Explore Mauritius</button>
            <button class="btn btn-form"><i class='bx bx-camera'></i> Sightseeing</button>
            <button class="btn btn-form"><i class='bx bx-run'></i> Activities</button>
            <button class="btn btn-form"><i class='bx bx-car'></i> Car Rental</button>
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

            <p class=".paragraph-text  text-center" style="margin-top:50px; color:grey;">
                Mauritius is a vibrant mosaic of cultures, where people of Indian, African, Chinese, 
                and European heritage live together in harmony, creating a unique blend of traditions,
                festivals, and flavors. From the lively rhythms of Sega music to colorful celebrations 
                like Diwali and Chinese New Year, the island pulses with joy and unity. Visitors are welcomed 
                with warm smiles and rich culinary delights, making every experience a heartfelt celebration of
                Mauritius's diverse and thriving culture.
            </p>

        </div>



        </div>



        <div  style="margin-top: 4rem;">
            <div class="col-lg-8 mx-auto text-center">
            <button class="btn btn-primary btn-lg rad-0" onclick="window.location.href='{{ route('service') }}'">View All Services →</button>

        </div>
        </div>
    </section>

    <section id="about" class="section-padding" style="background: var(--gray-light); ">
        <div class="container">
            <div class="row">
            <div class="col-lg-8 mx-auto text-center" style="margin-bottom:30px;">
                <h2 class="section-heading">We Design “Mauritius Tours” Your Way 
                Best Tailor-Made Private Mauritius Holidays Just for You</h2>

            </div>

            <!-- Full-width paragraph below the heading -->
            <div class="col-12">
                <p class="mb-3 mx-5  fw-medium text-center" style="color:grey;" >
                    MyVac Tours Mauritius specializes in private tours and fully personalized holiday packages across the island. 
                    Whether you're dreaming of a romantic escape, a family getaway, or a thrilling adventure, our dedicated local
                    experts are here to craft unforgettable experiences — just the way you want.We're proud to be recognized for our
                    commitment to quality, customer satisfaction, and authentic Mauritian hospitality. Our passionate team is based right here in Mauritius, ready to accompany you from start to finish, ensuring every moment of your trip is smooth, enriching, and truly memorable.
                </p>
            </div>

            <!-- Masked word "mauritius" centered -->
            <div class="col-12 text-center" style="margin-top:30px; margin-bottom:60px;">
                <h1 class="masked-text">mauritius</h1>
            </div>

            <!-- Second paragraph -->
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
   </section>


    <!-- Tours Section -->
    <section id="tours" class="section-padding" style="">
     <div class="container text-center">
        <p class="section-heading mt-5">
            Mauritius island is our homeland. We'll show you Mauritius, <br>
            better than anyone else!
        </p>
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
                            <p><strong class="tour-price">€{{ $tour->starting_price }}</strong> <span class="per-person">per person</span></p>
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

    <!-- About Section -->
    <section id="about" class="section-padding" style="background: var(--gray-light);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="section-title section-heading">About MyVac Tours Mauritius</h2>
                    <p class="section-subtitle subheading  ">Your trusted partner for exploring Mauritius</p>
                    <p class="paragraph-text">With years of experience in the Mauritius tourism industry, MyVac Tours has established itself as a premier car rental and tour operator. We pride ourselves on providing exceptional service, reliable vehicles, and unforgettable experiences.</p>
                    <p class="paragraph-text">Our team of local experts knows every corner of this beautiful island and is passionate about sharing its wonders with visitors from around the world.</p>
                    
                    <div class="row mt-4 paragraph-text" >
                        <div class="col-6">
                            <div class="d-flex align-items-center mb-3">
                                <i class='bx bx-shield-check text-primary fs-3 me-3'></i>
                                <div>
                                    <h6 class="mb-0">Fully Licensed</h6>
                                    <small class="text-muted">Certified & Insured</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex align-items-center mb-3">
                                <i class='bx bx-support text-primary fs-3 me-3'></i>
                                <div>
                                    <h6 class="mb-0">24/7 Support</h6>
                                    <small class="text-muted">Always Here for You</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
              
                    <div class="img-placeholder" style="height: 400px; "> 
                        <img  src="{{ asset('images/backgrounds/straw-hat.png') }}" style="width: 100%; height: 100%; object-fit: cover; border-radius:100px;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <!-- <section id="contact" class="section-padding" style="background: var(--gray-light);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-title">Contact Us</h2>
                    <p class="section-subtitle">
                        Ready to start your Mauritius adventure? Get in touch with us today!
                    </p>
                </div>
            </div>
            
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="text-center">
                        <div class="service-icon mx-auto">
                            <i class='bx bx-phone'></i>
                        </div>
                        <h5>Phone</h5>
                        <p class="text-muted">+230 55040167<br>Available 24/7</p>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="text-center">
                        <div class="service-icon mx-auto">
                            <i class='bx bx-envelope'></i>
                        </div>
                        <h5>Email</h5>
                        <p class="text-muted">info@VoyageHub.mu<br>Quick Response</p>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <div class="text-center">
                        <div class="service-icon mx-auto">
                            <i class='bx bx-map'></i>
                        </div>
                        <h5>Location</h5>
                        <p class="text-muted">Mauritius Island<br>Pickup Available</p>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
@endsection