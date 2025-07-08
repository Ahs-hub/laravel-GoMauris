
@extends('layouts.mainlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/tourdetailed.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/tourdetailed.css') }}">
    @endif


    <div class="container py-4">
        <!-- Title Section -->
        <div class="title-section">
            <div class="subtitle paragraph-text">A shared catamaran cruise on the East Coast</div>
            <h1 class="main-title section-heading">Catamaran Cruise to Ile aux Cerfs Island</h1>

            <div class="d-flex flex-wrap justify-content-between align-items-center">
            <!-- Rating Section -->
            @if($tour->average_rating > 0)
                <div class="rating-section">
                    <div class="rating-stars">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= floor($tour->average_rating))
                                <i class='bx bxs-star'></i>
                            @elseif ($i - $tour->average_rating <= 0.5)
                                <i class='bx bxs-star-half'></i>
                            @else
                                <i class='bx bx-star'></i>
                            @endif
                        @endfor
                    </div>
                    <span class="rating-text paragraph-text">{{ $tour->average_rating }} / 5</span>
                    <span class="rating-reviews paragraph-text">  +{{ $tour->total_reviews }} Reviews</span>
                </div>
            @endif

                <!-- Wishlist -->
                <div class="d-flex align-items-center mt-2 mt-md-0">
                    <i class='bx bx-heart me-2' style="font-size: 1.5rem;"></i>
                    <a href="#" class="wishlist-link">Add to Wishlist</a>
                </div>
            </div>
        </div>
    </div>


    <div class="container py-4">
        <!-- Gallery Section at Top -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="tour-gallery">
                    <div class="row g-2">
                        <div class="col-8">
                            <img src="{{ asset('images/tours/catamaran-cruise-benitiers-island/catamaran-cruise-benitiers-island-1.jpg') }}" alt="Chamarel Waterfall" class="main-image">
                        </div>
                        <div class="col-4">
                            <div class="gallery-grid">
                                <div class="gallery-item">
                                <img src="{{ asset('images/tours/catamaran-cruise-benitiers-island/catamaran-cruise-benitiers-island-2.jpg') }}" alt="Chamarel Waterfall">
                                </div>
                                <div class="gallery-item">
                                <img src="{{ asset('images/tours/catamaran-cruise-benitiers-island/catamaran-cruise-benitiers-island-3.jpg') }}" alt="Chamarel Waterfall">
                                </div>
                                <div class="gallery-item">
                                <img src="{{ asset('images/tours/catamaran-cruise-benitiers-island/catamaran-cruise-benitiers-island-4.jpg') }}" alt="Chamarel Waterfall">
                                </div>
                                <div class="gallery-item">
                                <img src="{{ asset('images/tours/catamaran-cruise-benitiers-island/catamaran-cruise-benitiers-island-5.jpg') }}" alt="Chamarel Waterfall">
                                    <div class="more-photos">

                                        <button class="btn " data-bs-toggle="modal" data-bs-target="#galleryModal" style="color:white;">
                                            <i class='bx bx-plus'></i> More
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tour Description and Booking Card Side by Side -->
        <div class="row"  >
            <div class="col-lg-8">
                <div class="tour-info">
                    <div class="tour-title">
                        Discover the southwest of Mauritius on a private full-day tour. Marvel at the Seven Coloured Earths in Chamarel, take in views from the Alexandra Falls Viewpoint, visit Grand Bassin, and more.
                    </div>
                    
                    <div class="section-title">About this activity</div>
                    
                    <div class="feature-item">
                        <i class='bx bx-x-circle feature-icon'></i>
                        <div>
                            <strong>Free cancellation</strong><br>
                            <span class="text-muted">Cancel up to 24 hours in advance for a full refund</span>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <i class='bx bx-credit-card feature-icon'></i>
                        <div>
                            <strong>Reserve now & pay later</strong><br>
                            <span class="text-muted">Keep your travel plans flexible — book your spot and pay nothing today</span>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <i class='bx bx-time feature-icon'></i>
                        <div>
                            <strong>Duration 7.5 hours</strong><br>
                            <span class="text-muted">Check availability to see starting times</span>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <i class='bx bx-user feature-icon'></i>
                        <div>
                            <strong>Live tour guide</strong><br>
                            <span class="text-muted">English, French</span>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <i class='bx bx-car feature-icon'></i>
                        <div>
                            <strong>Pickup included</strong><br>
                            <span class="text-muted">Pick-up possible from your accommodation or the airport in Mauritius. Please wait in the lobby of your hotel if you are being picked up from there. Your driver will be outside with a sign with your name on it.</span>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <i class='bx bx-group feature-icon'></i>
                        <div>
                            <strong>Private group</strong><br>
                            <span class="text-muted">This is a private activity. Only your group will participate.</span>
                        </div>
                    </div>
                </div>
                <div class="tour-info" id="go-to-check-availability" style="background-color:#2c3e50; color:white;">

                    <div class="form-header">
                        <h2>Select participants and date</h2>

                    </div>
                    <div style="display: flex; flex-direction: row; gap:10px">

                        <div class="date-button-wrapper">
                            <div class="custom-date-button">
                                <span>                            
                                <i class='bx bx-user'></i>
                                <span>Participant</span>
    
                                </span>
    
                                <i class='bx bx-chevron-down'></i>
                              <!-- <input type="date" class="custom-date-input" onchange="alert('Date: ' + this.value)"> -->
                            </div>
                          </div>
    
                        <div class="date-button-wrapper">
                            <div class="custom-date-button">
                                <span>
                                    <i class='bx bx-calendar'></i>
                                    <span>Choose Date</span>
    
                                </span>
    
                              <i class='bx bx-chevron-down'></i>
                              <input type="date" class="custom-date-input" onchange="alert('Date: ' + this.value)">
                            </div>
                          </div>
                        
                    </div>
   
                    <button class="btn btn-primary w-100 mb-3" style="border-radius:100px;">Check availability</button>
                  
                </div>
            </div>
            
            <!-- Booking Card -->
            <div class="col-lg-4">
                <div class="booking-card">
                    <div class="mb-3">
                        <span class="text-muted">From</span>
                        <div class="price">€98</div>
                        <div class="price-subtitle">per group up to 3</div>
                    </div>
                    
                    
                    <a href="#go-to-check-availability"><button class="btn btn-primary w-100 mb-3" >Book</button></a>
                    
                    <div class="reserve-info">
                        <div class="d-flex align-items-center">
                            <i class='bx bx-check-circle'></i>
                            <small class="text-muted">Reserve now & pay later to book your spot and pay nothing today</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Modal -->
    <div class="modal fade gallery-modal" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalLabel">
                    </h5>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="photo-counter">
                        <span id="currentSlide">1</span> / <span id="totalSlides">6</span>
                    </div>
                    
                    <div class="swiper-container" id="gallerySwiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ asset('images/tours/catamaran-cruise-benitiers-island/catamaran-cruise-benitiers-island-1.jpg') }}" alt="Sunset Cruise">
       
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images/tours/catamaran-cruise-benitiers-island/catamaran-cruise-benitiers-island-2.jpg') }}" alt="Tropical Beach">

                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images/tours/catamaran-cruise-benitiers-island/catamaran-cruise-benitiers-island-1.jpg') }}" alt="Island Adventure">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images/tours/catamaran-cruise-benitiers-island/catamaran-cruise-benitiers-island-4.jpg') }}" alt="Local Culture">
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('images/tours/catamaran-cruise-benitiers-island/catamaran-cruise-benitiers-island-5.jpg') }}" alt="Snorkeling">
                            </div>
                        </div>
                        
                        <!-- Navigation arrows -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        
                        <!-- Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('js/style.js') }}"></script>

@endsection