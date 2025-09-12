
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
            <iframe id="heroVideo"
                src="https://www.youtube.com/embed/4LkjWzUTEu8?autoplay=1&mute=1&loop=1&controls=0&modestbranding=1&enablejsapi=1&playlist=4LkjWzUTEu8"
                frameborder="0"
                allow="autoplay; encrypted-media"
                allowfullscreen>
            </iframe>
        </div>
        <!-- <div class="video-background">
            <video  id="heroVideo" autoplay loop playsinline muted>
                <source src="{{ asset('videos/newvideoo.mp4') }}" type="video/mp4">
                <source src="videos/background.webm" type="video/webm">
                Your browser does not support the video tag.
            </video>
        </div> -->
      
        <div class="container content hero-content">
          <h1 class="hero-title">{{ __('messages.hero_title') }}</h1>
      
          <div class="button-group">
            <button class="btn btn-form" onclick="window.location.href='{{ route('tours.index') }}'"> <i class='bx bx-map'> </i> {{ __('messages.hero_btn_book_a_tour') }}</button>
            <!-- <button class="btn btn-form"><i class='bx bx-camera'></i> Sightseeing</button> -->

            <button class="btn btn-form" onclick="window.location.href='{{ route('cars.home') }}'"> <i class='bx bx-car'> </i> {{ __('messages.hero_btn_car_rental') }}</button>
            <button class="btn btn-form" onclick="window.location.href='{{ route('taxi') }}'"> <i class='bx bx-car'> </i> {{ __('messages.hero_btn_book_taxi') }}</button>
            
          </div>
      
          <div class="cta-wrapper">
            <button class="btn btn-primary btn-lg cta-button rad-0" onclick="window.location.href='{{ route('customizeTour') }}'" style="background-color:#05123E;">
                {{ __('messages.hero_btn_customize') }}
            </button>
          </div>


        </div>

                    <!-- Mute/Unmute Button -->
        <button id="muteToggle" class="mute-btn">
            <i class='bx bx-volume-mute'></i>
        </button>
    </section>

    <!-- Services Section -->
    <section id="services" class="section-padding" data-aos="fade-up">

        <div class="container">    
            <div class="row" style="margin-bottom:10px;">
                <div class="col-lg-8 mx-auto text-center">   
                <a class="section-heading" style="text-decoration: none;">{{ __('messages.service_title') }}</a>
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
                    <!-- <div class="swiper-slide">
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
                    </div> -->
                    <!-- ... other slides repeated -->
                    <div class="swiper-slide">
                        <div class="swiper-service-card" style="background-image: url('images/services/private_airport_transfer.png');">
                            <div class="swiper-service-overlay">
                                <h5>{{ __('messages.service_private_airport_transfer_title') }}</h5>
                                <p class="description">{{ __('messages.service_private_airport_transfer_description') }}</p>
                                <button type="submit"  onclick="window.location.href='{{ route('taxi') }}'" class="btn btn-primary btn-lg button-text description" >
                                    {{ __('messages.btn_more') }}
                                </button>
                                <p class="price-tag">{{ __('messages.service_private_airport_transfer_pricetag') }}</p>
                        </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="swiper-service-card" style="background-image: url('images/services/car_rental.png');">
                            <div class="swiper-service-overlay">
                                <h5>{{ __('messages.service_car_rental_title') }}</h5>
                                <p class="description">{{ __('messages.service_car_rental_description') }}</p>
                                <button type="submit"  onclick="window.location.href='{{ route('cars.home') }}'" class="btn btn-primary btn-lg button-text description" >
                                    {{ __('messages.btn_more') }}
                                </button>
                                <p class="price-tag">{{ __('messages.service_car_rental_pricetag') }}</p>
                             </div>
                        </div>
                   </div>

                    <div class="swiper-slide">
                        <div class="swiper-service-card" style="background-image: url('images/services/luxury_airport_transfer.png');">
                            <div class="swiper-service-overlay">
                                <h5>{{ __('messages.service_luxury_airport_transfer_title') }}</h5>
                                <p class="description paragraph-text">{{ __('messages.service_luxury_airport_transfer_description') }}</p>
                                <button type="submit" onclick="window.location.href='{{ route('taxi') }}'" class="btn btn-primary btn-lg button-text description" >
                                  {{ __('messages.btn_more') }}
                                </button>
                                <p class="price-tag"> {{ __('messages.service_luxury_airport_transfer_pricetag') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="swiper-service-card" style="background-image: url('images/services/sightseeing_tour.png');">
                            <div class="swiper-service-overlay">
                                <h5>{{ __('messages.service_sightseeing_title') }}</h5>
                                <p class="description">{{ __('messages.service_sightseeing_description') }}</p>
                                <button type="submit" onclick="window.location.href='{{ route('tours.index') }}'" class="btn btn-primary btn-lg button-text description" >
                                    {{ __('messages.btn_more') }}
                                </button>
                                <p class="price-tag">{{ __('messages.service_sightseeing_pricetag') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="swiper-service-card" style="background-image: url('images/services/taxi_ride.png');">
                            <div class="swiper-service-overlay">
                                <h5>{{ __('messages.service_taxi_title') }}</h5>
                                <p class="description">{{ __('messages.service_taxi_description') }} </p>
                                <button type="submit" onclick="window.location.href='{{ route('taxi') }}'" class="btn btn-primary btn-lg button-text description" >
                                   {{ __('messages.btn_more') }}
                                </button>
                                <p class="price-tag">{{ __('messages.service_taxi_pricetag') }}</p>
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
    <section id="about" class="section-padding py-5" style="background: var(--gray-light);" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center gy-4">
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
                   {{ __('messages.about_title') }}
                </h2>
                <div style="width: 60px; height: 3px; background-color: #274993; margin: 0 auto 20px 0;"></div>

                    <p class="section-subtitle subheading mb-3">
                        {{ __('messages.about_subtitle') }}
                    </p>
                    <p class="paragraph-text mb-3" style="color:#262626;">
                       {{ __('messages.about_paragraph_one') }}
            
                    </p>
                    <p class="paragraph-text mb-4" style="color:#262626;">
                       {{ __('messages.about_paragraph_two') }}
                        
                    </p>

                    <!-- Icon Features -->
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class='bx bx-shield-check text-primary fs-3 me-3'></i>
                                <div>
                                    <h6 class="mb-0">{{ __('messages.about_fully_license') }}</h6>
                                    <small class="text-muted" style="color:#262626;">{{ __('messages.about_certified_insured') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class='bx bx-support text-primary fs-3 me-3'></i>
                                <div>
                                    <h6 class="mb-0">{{ __('messages.support_24_7') }}</h6>
                                    <small class="text-muted" style="color:#262626;">{{ __('messages.about_always_here') }}</small>
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
    <section class="stats-section section-padding" style=" height: auto; background-size: cover; background-position: center;" data-aos="fade-up">
        <div class="container" >
            <div class="row text-center">
                <div class="col-lg-4 col-md-6">
                    <div class="stat-item">
                        <div class="stat-plus-sign"><span class="stat-number" data-target="10">0</span><span >+</span></div>
                        <div class="stat-label">{{ __('messages.stat_reviews') }}</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-item">
                        <div class="stat-plus-sign"><span class="stat-number" data-target="10">0</span><span >+</span></div>
                        <div class="stat-label">{{ __('messages.stat_vehicles_available') }}</div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="stat-item">
                        <div class="stat-plus-sign"><span class="stat-number" data-target="15">0</span><span >+</span></div>
                        <div class="stat-label">{{ __('messages.stat_tour_packages') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tours Section -->
    <section id="tours" class="section-padding" style="" data-aos="fade-up">
     <div class="container text-center">
        <p class="section-heading mt-5">
           {{ __('messages.tour_mauritius_title') }}
        </p>
        <div style="width: 60px; height: 3px; background-color: #274993; margin: 0 auto 16px;"></div>
     </div>
    
        <div class="container text-center my-5">
         
            <!-- Category filter buttons -->
            <div class="d-flex flex-wrap justify-content-center my-3" >
                <button class="btn button-text category-btn active" data-category="all">{{ __('messages.tour_all_tours_btn') }}</button>
                @foreach ($categories as $category)
                    <button class="btn button-text category-btn" data-category="{{ $category->slug }}">
                        {{ __('messages.' . $category->slug) }}
                    </button>
                @endforeach
            </div>

            
            <!-- Tour cards -->
            <div class="row g-4" style="margin-top:20px;">
                @foreach ($tours as $tour)
                <div class="col-md-3 tour-card" data-category="{{ $tour->category->slug }}">
                <a href="{{ route('tours.show', $tour->slug) }}" style="text-decoration: none; color: inherit;">
                    <div class="card destination-card">
                        <img src="{{ asset($tour->main_image) }}" class="card-img-top" alt="{{ $tour->{'name_' . app()->getLocale()} }}">
                        <div class="card-body text-start">
                            <h5 class="card-title">{{ $tour->{'name_' . app()->getLocale()} }}</h5>
                            <p class="card-time">{{ floor($tour->duration_minutes / 60) }} {{ __('messages.hours') }} &nbsp;•&nbsp; {{ $tour->pickup_included ? 'Pickup Available' : '' }}</p>
                            <div class="tour-rating mb-2">
                                @for ($i = 0; $i < floor($tour->average_rating); $i++)
                                    <i class="bx bxs-star"></i>
                                @endfor
                                @if ($tour->average_rating - floor($tour->average_rating) >= 0.5)
                                    <i class="bx bxs-star-half"></i>
                                @endif
                                <span class="rating-text">{{ $tour->average_rating }} ({{ $tour->total_reviews }})</span>
                            </div>

                            @if ($tour->is_group_priced)
                                {{-- Group price --}}
                                @if ($tour->group_price_promotion_price)
                                    <p class="from-text text-muted text-decoration-line-through">
                                        {{ __('messages.from') }} €{{ $tour->group_price }}
                                    </p>
                                    <strong class="tour-price text-danger ms-1">
                                        €{{ $tour->group_price_promotion_price }}
                                    </strong>
                                @else
                                    <p class="from-text">{{ __('messages.from') }}</p>
                                    <strong class="tour-price">€{{ $tour->group_price }}</strong>
                                @endif
                                <span class="per-person">{{ __('messages.per_group_of') }} {{ $tour->group_size }}</span>
                            @else
                                {{-- Starting price --}}
                                @if ($tour->starting_promotion_price)
                                    <p class="from-text text-muted text-decoration-line-through">
                                        {{ __('messages.from') }} €{{ $tour->starting_price }}
                                    </p>
                                    <strong class="tour-price text-danger ms-1">
                                        €{{ $tour->starting_promotion_price }}
                                    </strong>
                                @else
                                    <p class="from-text">{{ __('messages.from') }}</p>
                                    <strong class="tour-price">€{{ $tour->starting_price }}</strong>
                                @endif
                                <span class="per-person">{{ __('messages.per_person') }}</span>
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
                 {{ __('messages.tour_view_all_tours_btn') }}
            </button>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section-padding py-5" style="background: var(--gray-light);" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center gy-4 ">

                <!-- Text Column -->
                <div class="col-lg-6">
                    <div class="text-content">
                        <h2 class="section-title section-heading mb-3">
                        {{ __('messages.about_mur_title') }}
                        </h2>
                        <div style="width: 60px; height: 3px; background-color: #274993; margin: 0 auto 20px 0;"></div>
                        <p class="paragraph-text" style="color: #262626; font-size: 1rem; line-height: 1.7;">
                        {{ __('messages.about_mur_paragraph_one') }}
                        </p>
                        <p class="paragraph-text" style="color: #262626; font-size: 1rem; line-height: 1.7;">
                        {{ __('messages.about_mur_paragraph_two') }}
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
    <section id="whychooseus" data-aos="fade-up">
        <div class="container text-center" style="margin-bottom:30px;">
            <p class="section-heading mt-5">
            {{ __('messages.why_choose_us_title') }}
            </p>
            <div style="width: 60px; height: 3px; background-color: #274993; margin: 0 auto 16px;"></div>
        </div>

        <div class="container">
            <div class="row">
                <!-- Expert Local Guides -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="card-front" style=" background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('../images/backgrounds/guidetourist.png');
                            background-position: center;
                            background-size: cover;
                            background-repeat: no-repeat;">
                            <h3 class="feature-title">  {{ __('messages.why_choose_us_expert_local') }}</h3>
                        </div>
                        <div class="card-back">
                            <h3 class="feature-title">{{ __('messages.why_choose_us_expert_local') }}</h3>
                            <p class="feature-description">{{ __('messages.why_choose_us_expert_local_p') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Customized Itineraries -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                    <div class="card-front" style=" background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('../images/backgrounds/hiking.png');
                            background-position: center;
                            background-size: cover;
                            background-repeat: no-repeat;">
                            <h3 class="feature-title">{{ __('messages.why_choose_us_customized_itineraries') }}</h3>
                        </div>
                        <div class="card-back">
                            <h3 class="feature-title">{{ __('messages.why_choose_us_customized_itineraries') }}</h3>
                            <p class="feature-description">{{ __('messages.why_choose_us_customized_itineraries_p') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Best Price Guarantee -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                    <div class="card-front" style=" background-image: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('../images/backgrounds/price.png');
                            background-position: center;
                            background-size: cover;
                            background-repeat: no-repeat;">
                            <h3 class="feature-title">{{ __('messages.why_choose_us_best_price') }}</h3>
                        </div>
                        <div class="card-back">
                            <h3 class="feature-title">{{ __('messages.why_choose_us_best_price') }}</h3>
                            <p class="feature-description">{{ __('messages.why_choose_us_best_price_p') }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    
    <!-- You tube API -->
    <script src="https://www.youtube.com/iframe_api"></script>

@endsection