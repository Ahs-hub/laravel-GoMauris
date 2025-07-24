@extends(request('type') === 'car' ? 'layouts.maincarlayout' : 'layouts.mainlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/contactpage.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/contactpage.css') }}">
    @endif

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center">
                <h1 class="hero-title ">Contact Us</h1>
                <p class="subheading mb-4">Get in touch for premium tour and car rental services</p>
                <div class="d-flex justify-content-center gap-4 flex-wrap">
                    <span class="badge bg-light text-primary px-3 py-2 paragraph-text">
                        Chauffeur Service
                    </span>
                    <span class="badge bg-light text-primary px-3 py-2 paragraph-text">
                        Airport Transfer
                    </span>
                    <span class="badge bg-light text-primary px-3 py-2 paragraph-text">
                        Sightseeing & Tours
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class=".section-heading">Get In Touch</h2>
                <p class="section-subtitle">Ready to experience premium service? Contact us today for bookings and inquiries</p>
            </div>
        </div>
        
        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="contact-form">
                    <h3 class="subheading fw-bold mb-4" >Send us a Message</h3>
                    <form method="POST" action="{{ route('contact.submit') }}">
                       @csrf
                        <div class="row g-3">
                            <div class="col-md-6" style="color:rgb(49, 49, 49)">
                                <label for="firstName" class="form-label fw-semibold">First Name</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label fw-semibold" style="color:rgb(49, 49, 49)">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold" style="color:rgb(49, 49, 49)">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-semibold" style="color:rgb(49, 49, 49)">Phone Number</label>
                                <input type="tel" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="col-12">
                                <label for="service" class="form-label fw-semibold" style="color:rgb(49, 49, 49)">Service Needed</label>
                                <select class="form-control" id="service" name="service" required>
                                    <option value="">Select a service</option>
                                    <option value="chauffeur">Chauffeur Service</option>
                                    <option value="airport">Airport Transfer</option>
                                    <option value="sightseeing">Sightseeing & Tours</option>
                                    <option value="car-rental">Car Rental</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label fw-semibold" style="color:rgb(49, 49, 49)">Message</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Tell us about your requirements..." name="message"></textarea>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg rad-0">
                                    <i class='bx bx-send me-2'></i>Send Message
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-lg-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="contact-info-card">
                            <div class="contact-icon">
                                <i class='bx bx-phone'></i>
                            </div>
                            <h5 class="fw-bold mb-2" >Call Us</h5>
                            <p class="paragraph-text text-muted mb-0">
                                <a href="https://wa.me/23055040167" target="_blank" class="whatsapp-link" style="text-decoration:none;">
                                    +230 55040167
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="contact-info-card">
                            <div class="contact-icon">
                                <i class='bx bx-envelope'></i>
                            </div>
                            <h5 class="fw-bold mb-2" >Email Us</h5>
                            <p class="paragraph-text text-muted mb-0">info@premiumtours.com</p>
                            <p class="paragraph-text text-muted">bookings@premiumtours.com</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="contact-info-card">
                            <div class="contact-icon">
                                <i class='bx bx-map'></i>
                            </div>
                            <h5 class="fw-bold mb-2" >Visit Us</h5>
                            <p class="paragraph-text text-muted mb-0">123 Tourism Boulevard</p>
                            <p class="paragraph-text text-muted">City Center, State 12345</p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="contact-info-card">
                            <div class="contact-icon">
                                <i class='bx bx-time'></i>
                            </div>
                            <h5 class="fw-bold mb-2" >Business Hours</h5>
                            <p class="paragraph-text text-muted mb-0">Mon - Fri: 8:00 AM - 8:00 PM</p>
                            <p class="paragraph-text text-muted">Sat - Sun: 9:00 AM - 6:00 PM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="map-container">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31212.05021350106!2d57.47198544695034!3d-20.263971220049186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x217c49a0c7326c75%3A0x110b02e70a943a2!2sQuatre%20Bornes!5e0!3m2!1sen!2smu!4v1720200000000!5m2!1sen!2smu" 
                        width="100%" 
                        height="400" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
        
    </div>
</section>

@endsection