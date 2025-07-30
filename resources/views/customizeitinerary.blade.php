@extends(request('type') === 'car' ? 'layouts.maincarlayout' : 'layouts.mainlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/customizeitinerary.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/customizeitinerary.css') }}">
    @endif
    <div class="d-flex justify-content-center align-items-center min-vh-100" style="margin-bottom:100px;">
        <div class="container" style="max-width: 800px; width: 100%;">

            <h1 class="text-center mb-4 section-heading" style="margin-top:50px; color:#262626; margin-bottom:70px;">Send Us Your Customized Tour</h1>

            <div class="tour-info shadow p-4 p-md-5 rounded" v-if="showForm && checked" style="color:#2c3e50; border: 2px solid var(--accent-color);">

                <form @submit.prevent="submitForm">
                    <div class="form-header text-center mb-4">
                        <h5>Let us assist you in planning your personalized tour</h5>
                        <h5>If you prefer WhatsApp, contact us at 
                            <span>
                                <a href="https://wa.me/23055040167" target="_blank" class="whatsapp-link" style="color: var(--secondary-color); font-weight: 500;">
                                        +230 55040167
                                </a>
                            </span>
                        </h5>
                    </div>

                    <!-- Tour Details -->
                    <div class="section-title h4 mb-3" style="color:#2c3e50;">Enter your tour details:</div>

                    <div class="row mb-3">
                        <!-- New dropdown field -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Vehicle Category <span class="text-danger">*</span></label>
                            <select class="form-select" v-model="vehicle_category" required>
                                <option value="">Select a category</option>
                                <option value="standard">Standard</option>
                                <option value="accommodate">Accommodate</option>
                                <option value="luxury">Luxury</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Passengers <span class="text-danger">*</span></label>
                            <input type="number" min="1" class="form-control" v-model="passengers" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tour Date <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" v-model="tour_date" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Preferred Start Time</label>
                            <input type="time" class="form-control" v-model="start_time">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Hotel / Residence Name</label>
                            <input type="text" class="form-control" v-model="hotel_name" placeholder="Enter hotel or residence name">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Preferred Tour</label>
                            <input type="text" class="form-control" v-model="preferred_tour" placeholder="e.g., South Tour, Catamaran">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Preferred Itinerary / Comments</label>
                        <textarea class="form-control" v-model="comments" rows="3" placeholder="Describe your ideal route, stopovers, or any special requests..."></textarea>
                    </div>

                    <!-- About You -->
                    <div class="section-title h4 mb-3" style="color:#2c3e50;">About you:</div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Your Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" v-model="full_name" required placeholder="Enter your full name">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Your Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" v-model="email" required placeholder="Enter your email">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Country <span class="text-danger">*</span></label>
                            <select class="form-select" v-model="country" required>
                                <option value="">Select your country</option>
                                <option value="mauritius">Mauritius</option>
                                <option value="france">France</option>
                                <option value="uk">United Kingdom</option>
                                <option value="germany">Germany</option>
                                <option value="usa">United States</option>
                                <option value="canada">Canada</option>
                                <option value="australia">Australia</option>
                                <option value="south-africa">South Africa</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Mobile Number (WhatsApp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bxl-whatsapp"></i></span>
                                <input type="tel" class="form-control" v-model="mobile_number" required placeholder="+230 55040167">
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="book-button">
                             Send a Quote
                        </button>
                    </div>
                </form>
            </div>
   
        </div>
    </div>

    <!-- Tours Section -->
  <section id="tours" class="section-padding" style="">
     <div class="container text-center">
        <p class="section-heading mt-5">
             Tours & Activities
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

    </section>
@endsection