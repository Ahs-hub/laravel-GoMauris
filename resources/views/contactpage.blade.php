@extends(request('type') === 'car' ? 'layouts.maincarlayout' : 'layouts.mainlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/contactpage.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/contactpage.css') }}">
    @endif

    @php
        // Remove spaces and plus signs
        $whatsappNumber = isset($siteSettings->whatsapp) 
            ? preg_replace('/[\s+]/', '', $siteSettings->whatsapp) 
            : '';
    @endphp

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12 text-center">
                <h1 class="hero-title ">{{ __('messages.contact_us') }}</h1>
                <!-- <p class="subheading mb-4">Get in touch for premium tour and car rental services</p>
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
                </div> -->
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section" style="overflow-y:hidden;">
    <div class="container">
        <div class="row text-center mb-5">
            <div class="col-lg-8 mx-auto">
                <h2 class=".section-heading">{{ __('messages.get_in_touch') }}</h2>
                <p class="section-subtitle">{{ __('messages.get_in_touch_des') }}</p>
            </div>
        </div>
        
        <div class="row g-5">
            <!-- Contact Form -->
            <div class="col-lg-8">
                <div class="contact-form">
                    <h3 class="subheading fw-bold mb-4" >{{ __('messages.send_us_a_message') }}</h3>
                    <form method="POST" action="{{ route('contact.submit', ['type' => $type]) }}">
                       @csrf
                        <div class="row g-3">
                            <div class="col-md-6" style="color:rgb(49, 49, 49)">
                                <label for="firstName" class="form-label fw-semibold">{{ __('messages.first_name') }}</label>
                                <input type="text" class="form-control" id="firstName" name="firstName" required>
                            </div>
                            <div class="col-md-6">
                                <label for="lastName" class="form-label fw-semibold" style="color:rgb(49, 49, 49)">{{ __('messages.last_name') }}</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-semibold" style="color:rgb(49, 49, 49)">{{ __('messages.email_address') }}</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label fw-semibold" style="color:rgb(49, 49, 49)">{{ __('messages.phone_number') }}</label>
                                <input type="tel" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="col-12">
                                <label for="service" class="form-label fw-semibold" style="color:rgb(49, 49, 49)">{{ __('messages.service_needed') }}</label>
                                <select class="form-control" id="service" name="service" required>
                                    <option value="">{{ __('messages.select_a_service') }}</option>
                                    <option value="chauffeur">{{ __('messages.chauffeur_service') }}</option>
                                    <option value="airport">{{ __('messages.airport_transfer') }}</option>
                                    <option value="sightseeing">{{ __('messages.sightseeing_tours') }}</option>
                                    <option value="car-rental">{{ __('messages.service_car_rental_title') }}</option>
                                    <option value="taxi">{{ __('messages.service_taxi_title') }}</option>
                                    <option value="other">{{ __('messages.other') }}</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="message" class="form-label fw-semibold" style="color:rgb(49, 49, 49)">{{ __('messages.message') }}</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Tell us about your requirements..." name="message"></textarea>
                            </div>
                            <div class="col-12 text-center">
                                <button 
                                      id="contactSubmitBtn"
                                      type="submit" 
                                      class="btn btn-primary btn-lg rad-0"
                                      >
                                    <i class='bx bx-send me-2'></i>{{ __('messages.send_message') }}
                                </button>

                                <!-- Spinner (hidden by default) -->
                                <div 
                                    id="contactSpinner" 
                                    class="spinner-border text-primary ms-3" 
                                    style="display: none;" 
                                    role="status"
                                >
                                    <span class="visually-hidden">{{ __('messages.loading') }}...</span>
                                </div> 

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
                            <h5 class="fw-bold mb-2" >{{ __('messages.call_us') }}</h5>
                            <p class="paragraph-text text-muted mb-0">
                                <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" class="whatsapp-link" style="text-decoration:none;">
                                {{ $siteSettings->whatsapp }}
                                </a>
                            </p>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="contact-info-card">
                            <div class="contact-icon">
                                <i class='bx bx-envelope'></i>
                            </div>
                            <h5 class="fw-bold mb-2" >{{ __('messages.email_us') }}</h5>
                            <p class="paragraph-text text-muted mb-0">

                               <a href="mailto:{{ $siteSettings->contact_email }}"  style=" text-decoration: none;">
                               {{ $siteSettings->contact_email }}
                                </a>
                            </p>
                           
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="contact-info-card">
                            <div class="contact-icon">
                                <i class='bx bx-map'></i>
                            </div>
                            <h5 class="fw-bold mb-2" >{{ __('messages.visit_us') }}</h5>
                            <p class="paragraph-text text-muted mb-0">123 Tourism Boulevard</p>
                            <p class="paragraph-text text-muted">City Center, State 12345</p>
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

<script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.querySelector('.contact-form form');
            const submitBtn = document.getElementById('contactSubmitBtn');
            const spinner = document.getElementById('contactSpinner');

            if (form && submitBtn && spinner) {
                form.addEventListener('submit', function (e) {
                    submitBtn.disabled = true;
                    submitBtn.style.display = 'none';
                    spinner.style.display = 'inline-block';

                    // Optional: Stop spinner after 5 seconds in case form hangs
                    setTimeout(() => {
                        spinner.style.display = 'none';
                        submitBtn.style.display = 'inline-block';
                        submitBtn.disabled = false;
                    }, 5000);
                });
            }
        });
</script>

@endsection