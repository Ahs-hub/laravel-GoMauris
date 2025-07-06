<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VoyageHub Mauritius</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Boxicons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Google Font comic -->
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Google Fonts poppins,lato,Open_sans,Roboto-->
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Open+Sans&family=Poppins:wght@400;500;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">

     <!-- Swiper CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
     <!-- <link rel="stylesheet" href="{{ secure_asset('css/main.css') }}">
     <link rel="stylesheet" href="{{ secure_asset('css/home.css') }}"> -->
     <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <!-- Header Info -->
    <div class="header navbars-links">
        <div class="header-info">
            <div class="header-left">
                <div class="header-item">
                     <i class='bx bx-map'></i>
                     <span>Tour Operator in Mauritius</span>
                </div>
                <div class="header-item">
                    <i class='bx bx-phone'></i>
                    <span>+230 55040167</span>
                </div>
                <div class="header-item">
                    <i class='bx bx-time'></i>
                    <span>24/7</span>
                </div>
            </div>
            <div class="header-right">
                <div class="header-item">
                        <i class='bx bx-book'></i>
                        <span>Tour Catalog 2025</span>
                </div>
            </div>
        </div>
     </div>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <!-- <i class='bx bx-car'></i> -->
                <img src="{{ asset('images/logo3.png') }}" alt="Logo">
            </a>
            <div class="header-item phone-appear" style="color:white;">
                <i class='bx bx-phone'></i>
                <span>+230 55040167</span>
            </div>
            <!-- Toggler Button -->
            <button class="navbar-toggler no-border" style="color:white;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <i class='bx bx-menu icon-toggler'></i>
            </button>

            <div class="collapse navbar-collapse navbars-links" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="servicepage.html">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="fleetpage.html">Our Fleet</a>
                      </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tourpage.html">Tours</a>
                    </li>     

                    <li class="nav-item">
                        <a class="nav-link" href="whislist.html">Wishlist</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#event_planner">EN/EUR</a>
                    </li> -->         
                    
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#langCurrencyModal">
                          <i class='bx bx-globe'></i> EN/EUR(€)
                        </a>
                      </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#event_planner">Event Planner</a>
                    </li> --> 
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#contact">Language</a>
                    </li> -->
           
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#profileModal">
                          <i class='bx bx-user'></i> Profile
                        </a>
                      </li>

                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#contact">Profile</a>
                    </li> -->
                    <!-- <li class="nav-item" style="display: flex;  align-items: center;">
                       <button class="btn btn-outline-primary">Profile</button>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>

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
      
    <!-- 
    <section style="position:absolute; top: 50%; right: 0px; background-color: red;">

        </div>
    </section> -->



    <!-- Tours Section -->
    <section id="tours" class="section-padding" style="background: var(--gray-light);">
        <div class="container">
            <p class=".paragraph-text  text-center" style="margin-top:50px;">
                Mauritius island is our homeland We'll show you Mauritius,
                better than anyone else!
            </p>

        </div>


        <div class="container text-center my-5">
            <h2 class="section-heading ">Explore your ideal journey by interest</h2>
            <div class="d-flex flex-wrap justify-content-center my-3">
                <button class="btn button-text category-btn active">All Tours</button>
                <button class="btn button-text category-btn">Sea Activities</button>
                <button class="btn button-text category-btn">SightSeeing Tours</button>
                <button class="btn button-text category-btn">Nature Park</button>
            </div>
        
            <div class="row g-4">
                <!-- Destination Card -->
                <div class="col-md-3">
                    <div class="card destination-card">
                        <img src=" {{ asset('images/tours/catamaran_1.jpg') }}" class="card-img-top" alt="Catamaran Cruise to Ile Aux Gabriel Island">
                        <div class="card-body text-start">
                          <h5 class="card-title">Catamaran Cruise to Ile Aux Gabriel Island</h5>
                          <p class="card-time">7 hours &nbsp;•&nbsp; Pickup Included</p>
                          <div class="tour-rating mb-2">
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star-half"></i>
                            <span class="rating-text">4.7 (932)</span>
                          </div>
                          <p class="from-text">From</p>
                          <p><strong class="tour-price">$42</strong> <span class="per-person">per person</span></p>
                        </div>
                      </div>
                </div>
                <!-- Duplicate this card 3 more times -->
                <div class="col-md-3">
                    <div class="card destination-card">
                        <img src="img/tour/catamaran_2.jpg" class="card-img-top" alt="Catamaran Cruise to Ile Aux Gabriel Island">
                        <div class="card-body text-start">
                          <h5 class="card-title">Catamaran Cruise to Ile Aux Gabriel Island</h5>
                          <p class="card-time">7 hours &nbsp;•&nbsp; Pickup Included</p>
                          <div class="tour-rating mb-2">
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star-half"></i>
                            <span class="rating-text">4.7 (932)</span>
                          </div>
                          <p class="from-text">From</p>
                          <p><strong class="tour-price">$42</strong> <span class="per-person">per person</span></p>
                        </div>
                      </div>
                </div>

                <div class="col-md-3">
                    <div class="card destination-card">
                        <img src="img/tour/dolphine_swim.jpg" class="card-img-top" alt="Catamaran Cruise to Ile Aux Gabriel Island">
                        <div class="card-body text-start">
                          <h5 class="card-title">Catamaran Cruise to Ile Aux Gabriel Island</h5>
                          <p class="card-time">7 hours &nbsp;•&nbsp; Pickup Included</p>
                          <div class="tour-rating mb-2">
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star-half"></i>
                            <span class="rating-text">4.7 (932)</span>
                          </div>
                          <p class="from-text">From</p>
                          <p><strong class="tour-price">$42</strong> <span class="per-person">per person</span></p>
                        </div>
                      </div>
                </div>

                <div class="col-md-3">
                    <div class="card destination-card">
                        <img src="img/tour/nature_1.jpg" class="card-img-top" alt="Catamaran Cruise to Ile Aux Gabriel Island">
                        <div class="card-body text-start">
                          <h5 class="card-title">Catamaran Cruise to Ile Aux Gabriel Island</h5>
                          <p class="card-time">7 hours &nbsp;•&nbsp; Pickup Included</p>
                          <div class="tour-rating mb-2">
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star-half"></i>
                            <span class="rating-text">4.7 (932)</span>
                          </div>
                          <p class="from-text">From</p>
                          <p><strong class="tour-price">$42</strong> <span class="per-person">per person</span></p>
                        </div>
                      </div>
                </div>

                <!-- Destination Card -->
                <div class="col-md-3">
                    <div class="card destination-card">
                        <img src="img/tour/nature_2.jpg" class="card-img-top" alt="Catamaran Cruise to Ile Aux Gabriel Island">
                        <div class="card-body text-start">
                            <h5 class="card-title">Catamaran Cruise to Ile Aux Gabriel Island</h5>
                            <p class="card-time">7 hours &nbsp;•&nbsp; Pickup Included</p>
                            <div class="tour-rating mb-2">
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star-half"></i>
                            <span class="rating-text">4.7 (932)</span>
                            </div>
                            <p class="from-text">From</p>
                            <p><strong class="tour-price">$42</strong> <span class="per-person">per person</span></p>
                        </div>
                        </div>
                </div>

                <div class="col-md-3">
                    <div class="card destination-card">
                        <img src="img/tour/nature_4.jpg" class="card-img-top" alt="Catamaran Cruise to Ile Aux Gabriel Island">
                        <div class="card-body text-start">
                            <h5 class="card-title">Catamaran Cruise to Ile Aux Gabriel Island</h5>
                            <p class="card-time">7 hours &nbsp;•&nbsp; Pickup Included</p>
                            <div class="tour-rating mb-2">
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star-half"></i>
                            <span class="rating-text">4.7 (932)</span>
                            </div>
                            <p class="from-text">From</p>
                            <p><strong class="tour-price">$42</strong> <span class="per-person">per person</span></p>
                        </div>
                        </div>
                </div>

                <div class="col-md-3">
                    <div class="card destination-card">
                        <img src="img/tour/nature_3.jpg" class="card-img-top" alt="Catamaran Cruise to Ile Aux Gabriel Island">
                        <div class="card-body text-start">
                            <h5 class="card-title">Catamaran Cruise to Ile Aux Gabriel Island</h5>
                            <p class="card-time">7 hours &nbsp;•&nbsp; Pickup Included</p>
                            <div class="tour-rating mb-2">
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star-half"></i>
                            <span class="rating-text">4.7 (932)</span>
                            </div>
                            <p class="from-text">From</p>
                            <p><strong class="tour-price">$42</strong> <span class="per-person">per person</span></p>
                        </div>
                        </div>
                </div>

                <div class="col-md-3">
                    <div class="card destination-card">
                        <img src="img/tour/catamaran_1.jpg" class="card-img-top" alt="Catamaran Cruise to Ile Aux Gabriel Island">
                        <div class="card-body text-start">
                            <h5 class="card-title">Catamaran Cruise to Ile Aux Gabriel Island</h5>
                            <p class="card-time">7 hours &nbsp;•&nbsp; Pickup Included</p>
                            <div class="tour-rating mb-2">
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star"></i>
                            <i class="bx bxs-star-half"></i>
                            <span class="rating-text">4.7 (932)</span>
                            </div>
                            <p class="from-text">From</p>
                            <p><strong class="tour-price">$42</strong> <span class="per-person">per person</span></p>
                        </div>
                        </div>
                </div>
              
            </div>
            </div>

        <div class="text-center" style="margin-top: 100px;">
            <button type="submit" class="btn btn-primary btn-lg rad-0 " >
                <span style="display:flex; align-items: center; gap:10px;">View All Tours →</span>
                
            </button>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center">
                    <h2 class="section-heading">Your Trusted Guide to Mauritius</h2>
                    <p class="subheading " style="color: var(--gray-dark);">Our Service</p>
                </div>
            </div>

            <!-- Swiper Container -->
            <div class="swiper mySwiper" >
                <div class="swiper-wrapper">
                    <!-- Repeated Swiper Slides -->
                    <!-- Just showing 1 for example -->
                    <div class="swiper-slide">
                        <div class="swiper-service-card" style="background-image: url('https://images.unsplash.com/photo-1449824913935-59a10b8d2000?w=400&h=250&fit=crop');">
                            <div class="swiper-service-overlay">
                                <h5>Accomodation</h5>
                                <p class="description">Reliable and comfortable airport pickup & drop-off.</p>
                                <button type="submit" class="btn btn-primary btn-lg button-text description" >
                                    More
                                </button>
                                <p class="price-tag">$25 per person</p>
                            </div>
                        </div>
                    </div>
                    <!-- ... other slides repeated -->
                    <div class="swiper-slide">
                        <div class="swiper-service-card" style="background-image: url('img/service/private_airport_transfer.jpg');">
                            <div class="swiper-service-overlay">
                                <h5>Private Airport Transfer</h5>
                                <p class="description">Reliable and comfortable airport pickup & drop-off.</p>
                                <button type="submit" class="btn btn-primary btn-lg button-text description" >
                                    More
                                </button>
                                <p class="price-tag">$25 per person</p>
                        </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="swiper-service-card" style="background-image: url('img/service/luxury_airport_transfer.jpg');">
                            <div class="swiper-service-overlay">
                                <h5>Luxury Airport Transfer</h5>
                                <p class="description paragraph-text">Reliable and comfortable airport pickup & drop-off.</p>
                                <button type="submit" class="btn btn-primary btn-lg button-text description" >
                                    More
                                </button>
                                <p class="price-tag">$25 per person</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="swiper-service-card" style="background-image: url('img/service/sightseeing_tour.jpg');">
                            <div class="swiper-service-overlay">
                                <h5>Sightseeing tour</h5>
                                <p class="description">Reliable and comfortable airport pickup & drop-off.</p>
                                <button type="submit" class="btn btn-primary btn-lg button-text description" >
                                    More
                                </button>
                                <p class="price-tag">$25 per person</p>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="swiper-service-card" style="background-image: url('img/service/taxi_ride.jpg');">
                            <div class="swiper-service-overlay">
                                <h5>Taxi ride</h5>
                                <p class="description">Reliable and comfortable airport pickup & drop-off.</p>
                                <button type="submit" class="btn btn-primary btn-lg button-text description" >
                                    More
                                </button>
                                <p class="price-tag">$25 per person</p>
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

            <p class=".paragraph-text  text-center" style="margin-top:50px;">
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
                <button class="btn btn-primary btn-lg rad-0"  onclick="window.location.href='servicepage.html'">View All Services →</button>
            </div>
        </div>
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
                    <!-- PLACEHOLDER FOR ABOUT IMAGE -->
                    <div class="img-placeholder" style="height: 400px;"> 
                        <img src="img/straw-hat.png" style="width: 100%; height: 100%; object-fit: cover;">
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



    
    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="container">
                <div class="row g-4">
                    <!-- Company Info -->
                    <div class="col-lg-4 col-md-6">
                        
                        <a href="#" class="footer-logo">
                            <img style="width:200px; height:200px;" src="img/logo3.png">
                            <!-- <i class='bx bx-car'></i>
                            VoyageHub -->
                        </a>
                        <!-- <p class="mb-4" style="color: var(--light-color); line-height: 1.6;">
                            Your trusted partner for exploring the beautiful island of Mauritius. We provide premium car rentals, professional drivers, and unforgettable tours to make your vacation extraordinary.
                        </p> -->
                       
                        <div class="social-links">
                            <a href="#" class="social-link" title="Facebook">
                                <i class='bx bxl-facebook'></i>
                            </a>
                            <a href="#" class="social-link" title="Instagram">
                                <i class='bx bxl-instagram'></i>
                            </a>
                            <a href="#" class="social-link" title="WhatsApp">
                                <i class='bx bxl-whatsapp'></i>
                            </a>
                            <a href="#" class="social-link" title="TripAdvisor">
                                <i class='bx bx-map'></i>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-section">
                            <h5>Quick Links</h5>
                            <ul class="footer-links">
                                <li><a href="#home"><i class='bx bx-chevron-right'></i>Home</a></li>
                                <li><a href="#about"><i class='bx bx-chevron-right'></i>About Us</a></li>
                                <li><a href="#services"><i class='bx bx-chevron-right'></i>Services</a></li>
                                <li><a href="#cars"><i class='bx bx-chevron-right'></i>Our Fleet</a></li>
                                <li><a href="#tours"><i class='bx bx-chevron-right'></i>Tours</a></li>
                                <li><a href="#contact"><i class='bx bx-chevron-right'></i>Contact</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Services -->
                    <div class="col-lg-2 col-md-6">
                        <div class="footer-section">
                            <h5>Services</h5>
                            <ul class="footer-links">
                                <li><a href="#"><i class='bx bx-car'></i>Car Rental</a></li>
                                <li><a href="#"><i class='bx bx-user'></i>Driver Services</a></li>
                                <li><a href="#"><i class='bx bx-map'></i>Island Tours</a></li>
                                <li><a href="#"><i class='bx bx-shield'></i>Airport Transfer</a></li>
                                <li><a href="#"><i class='bx bx-calendar'></i>Custom Packages</a></li>
                                <li><a href="#"><i class='bx bx-support'></i>24/7 Support</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Contact & Newsletter -->
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-section">
                            <h5>Contact Info</h5>
                            <div class="contact-info">
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class='bx bx-phone'></i>
                                    </div>
                                    <div class="contact-text">
                                        <strong>Phone</strong>
                                        <span>+230 55040167</span>
                                    </div>
                                </div>
                                
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class='bx bx-envelope'></i>
                                    </div>
                                    <div class="contact-text">
                                        <strong>Email</strong>
                                        <span>info@voyagehub.mu</span>
                                    </div>
                                </div>
                                
                                <div class="contact-item">
                                    <div class="contact-icon">
                                        <i class='bx bx-map'></i>
                                    </div>
                                    <div class="contact-text">
                                        <strong>Location</strong>
                                        <span>Mauritius Island</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Newsletter -->
                            <!-- <div class="newsletter-form">
                                <h6><i class='bx bx-envelope'></i> Stay Updated</h6>
                                <p>Get the latest deals and travel tips delivered to your inbox.</p>
                                <div class="newsletter-input">
                                    <input type="email" placeholder="Enter your email" required>
                                    <button type="submit" class="newsletter-btn">
                                        <i class='bx bx-send'></i>
                                    </button>
                                </div>
                                <small style="color: var(--light-color); opacity: 0.8;">
                                    We respect your privacy. Unsubscribe anytime.
                                </small>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <div class="copyright">
                        <p>&copy; 2025 MyVac Tours Mauritius. All rights reserved. | Designed with <i class='bx bx-heart' style="color: var(--accent-color);"></i> for travelers</p>
                    </div>
                    <div class="footer-bottom-links">
                        <a href="#">Privacy Policy</a>
                        <a href="#">Terms of Service</a>
                        <a href="#">Booking Terms</a>
                        <a href="#">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- Profile Modal -->
  <div class="modal fade " id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
      <div class="modal-content custom-modal ">
        <div class="modal-body">
          <h5 class="modal-title mb-4" id="profileModalLabel">Profile</h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item profile-item">
              <i class='bx bx-log-in-circle'></i> Log In or Sign In
            </li>
            <li class="list-group-item profile-item">
              <i class='bx bx-support'></i> Support
            </li>
            <li class="list-group-item profile-item">
              <i class='bx bx-mobile'></i> Download our App
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

   <!-- Language & Currency Modal -->
    <div class="modal fade" id="langCurrencyModal" tabindex="-1" aria-labelledby="langCurrencyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content lang-modal">
    
            <!-- Modal Header with Tabs -->
            <div class="modal-header border-0">
            <ul class="nav nav-tabs nav-fill w-100" id="langCurrencyTabs" role="tablist">
                <li class="nav-item" role="presentation">
                <button class="nav-link active" id="language-tab" data-bs-toggle="tab" data-bs-target="#language" type="button" role="tab">
                    <i class='bx bx-globe'></i> Language
                </button>
                </li>
                <li class="nav-item" role="presentation">
                <button class="nav-link" id="currency-tab" data-bs-toggle="tab" data-bs-target="#currency" type="button" role="tab">
                    <i class='bx bx-dollar-circle'></i> Currency
                </button>
                </li>
            </ul>
            <button type="button" class="btn-close ms-2" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
    
            <!-- Modal Body with Tab Content -->
            <div class="modal-body tab-content">
            <!-- Language Tab -->
            <div class="tab-pane fade show active" id="language" role="tabpanel">
                <div class="row">
                <div class="col-md-6">
                    <ul class="list-unstyled lang-list">
                    <li class="active">English (United States) <i class='bx bx-check'></i></li>
                    <li>Russie</li>
                    <li>English (Australia)</li>
                    <li>Español (España)</li>
                    <li>Français</li>
                    <li>Chinese</li>
                    <li>Germany</li>
                    </ul>
                </div>
                <!-- <div class="col-md-6">
                    <ul class="list-unstyled lang-list">
                    <li>Bahasa Indonesia</li>
                    <li>Català</li>
                    <li>Dansk</li>
                    <li>Deutsch (Österreich)</li>
                    <li>Eesti</li>
                    <li>English (United Kingdom)</li>
                    <li>Español (México)</li>
                    <li>Hrvatski</li>
                    </ul>
                </div> -->
                </div>
            </div>
    
            <!-- Currency Tab -->
            <div class="tab-pane fade" id="currency" role="tabpanel">
                <div class="row gx-5">
                <!-- Common Currencies -->
                <div class="col-md-4">
                    <ul class="list-unstyled currency-list">
                    <!-- <li>Australian Dollar <span>A$</span></li> -->
                    <li class="active">Euro <span>€</span> <i class='bx bx-check'></i></li>
                    </ul>
                </div>
            
                <!-- <div class="col-md-4">
                    <ul class="list-unstyled currency-list">
                    <li>British Pound <span>£</span></li>
                    <li>Swiss Franc <span>CHF</span></li>
                    <li>Canadian Dollar <span>C$</span></li>
                    </ul>
                </div> -->
  

            </div>
    
        </div>
        </div>
    </div>
  
    <!-- Bootstrap link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>

    </script>

    <!-- Your custom JS -->
    <script src="script.js"></script>
</body>
</html>