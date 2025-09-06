
@extends('layouts.mainlayout')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">




    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/tourdetailed.css') }}">

        <!-- Production build of Vue 3 -->
        <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>
    @else
        <link rel="stylesheet" href="{{ asset('css/tourdetailed.css') }}">

        <!-- Vue -->
        <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    @endif

    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
        /* remove delay for vue  heart icon*/
        [v-cloak] {
        display: none;
        }
        .available-dates-container {
        margin-top: 10px;
        color: #fff;
        }

        .available-dates-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 6px;
        }

        .available-date {
        padding: 6px 12px;
        font-weight: 600;
        cursor: default;
        user-select: none;
        }

        .book-button {
            background: linear-gradient(135deg, #1976d2 0%, #1565c0 100%);
            border: none;
            color: white;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 8px;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(25, 118, 210, 0.3);
        }
        
        .book-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(25, 118, 210, 0.4);
            background: linear-gradient(135deg, #1565c0 0%, #0d47a1 100%);
        }
        

    </style>


    <div class="container py-4">
        <!-- Title Section -->
        <div class="title-section">
            <!-- <div class="subtitle paragraph-text">A shared catamaran cruise on the East Coast</div> -->
            <h1 class="main-title section-heading">{{ $tour->{'full_title_' . app()->getLocale()} }}</h1>

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
                        <span class="rating-reviews paragraph-text">  +{{ $tour->total_reviews }} {{ __('messages.reviews') }}</span>
                    </div>
                @endif

                <!-- Wishlist -->
                <div class="wishlist-heart"
                    data-tour-id="{{ $tour->id }}"
                    data-tour-slug="{{ $tour->slug }}"
                    data-tour-type="tour">
                    <div @click="toggleWishlist" style="cursor: pointer;" class="d-flex align-items-center">
                        <i :class="isInWishlist ? 'bx bxs-heart text-danger' : 'bx bx-heart'"
                        style="font-size: 1.5rem; width: 1.5em; text-align: center;"></i>
                        <span>{{ __('messages.add_to_wishlist') }}</span>
                    </div>
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
                    <!-- Left: Large Image -->
                    <div class="col-md-6">
                        <img src="{{ asset('images/tours/' . $tour->slug . '/' . $tour->slug . '-1.jpg') }}" alt="{{ $tour->name }} 1"  class="img-fluid w-100 h-100 object-fit-cover rounded">
                    </div>

                    <!-- Middle: Single Image -->
                    <div class="col-md-3">
                        <img src="{{ asset('images/tours/' . $tour->slug . '/' . $tour->slug . '-2.jpg') }}" alt="{{ $tour->name }} 2"  class="img-fluid w-100 h-100 object-fit-cover rounded">
                    </div>

                    <!-- Right: Two stacked images -->
                    <div class="col-md-3 d-flex flex-column gap-2">
                        <div class="flex-fill">
                            <img src="{{ asset('images/tours/' . $tour->slug . '/' . $tour->slug . '-3.jpg') }}" alt="{{ $tour->name }} 3"  class="img-fluid w-100 h-100 object-fit-cover rounded">
                        </div>
                        <div class="flex-fill position-relative">
                            <img src="{{ asset('images/tours/' . $tour->slug . '/' . $tour->slug . '-4.jpg') }}" alt="{{ $tour->name }} 4"  class="img-fluid w-100 h-100 object-fit-cover rounded">
                            <!-- Overlay Button -->
                            <div class="position-absolute top-50 start-50 translate-middle">
                                <button class="btn btn-dark text-white" data-bs-toggle="modal" data-bs-target="#galleryModal">
                                    <i class='bx bx-plus'></i> {{ __('messages.more') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        </div>
        
        <!-- Tour Description and Booking Card Side by Side -->
        <div class="row"  >

             <!-- Tour Description  and form-->
            <div class="col-lg-8">
                <div class="tour-info">
                    <div class="tour-title">
                    {!! $tour->{'description_' . app()->getLocale()} !!}
                    </div>
                    
                    <div class="section-title">{{ __('messages.about_this_activity') }}</div>
                    
                    <div class="feature-item">
                        <i class='bx bx-x-circle feature-icon'></i>
                        <div>
                            <strong>{{ __('messages.free_cancellation') }}</strong><br>
                            <span class="text-muted">{{ __('messages.free_cancellation_des') }}</span>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <i class='bx bx-credit-card feature-icon'></i>
                        <div>
                            <strong>{{ __('messages.reserve_now_pay_later') }}</strong><br>
                            <span class="text-muted">{{ __('messages.reserve_now_pay_later_des') }}</span>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <i class='bx bx-time feature-icon'></i>
                        <div>
                            @php
                                $hours = floor($tour->duration_minutes / 60);
                                $minutes = $tour->duration_minutes % 60;
                            @endphp

                            <strong>{{ __('messages.duration') }} 
                                @if ($hours > 0)
                                    {{ $hours }} {{ __('messages.hours') }} 
                                @endif
                                @if ($minutes > 0)
                                    {{ $minutes }} {{ __('messages.minutes') }} 
                                @endif
                            </strong><br>
                            <span class="text-muted">{{ __('messages.duration_des') }}</span>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <i class='bx bx-user feature-icon'></i>
                        <div>
                            <strong>{{ __('messages.live_tour_guide') }}</strong><br>
                            <span class="text-muted">{{ __('messages.live_tour_guide_des') }}</span>
                        </div>
                    </div>
                    
                    <!-- <div class="feature-item">
                        <i class='bx bx-car feature-icon'></i>
                        <div>
                            <strong>Pickup included</strong><br>
                            <span class="text-muted">Pick-up possible from your accommodation or the airport in Mauritius. Please wait in the lobby of your hotel if you are being picked up from there. Your driver will be outside with a sign with your name on it.</span>
                        </div>
                    </div> -->
                    
                    <div class="feature-item">
                        <i class='bx bx-group feature-icon'></i>
                        <div>
                            <strong>{{ __('messages.private_group') }}</strong><br>
                            <span class="text-muted">{{ __('messages.private_group_des') }}</span>
                        </div>
                    </div>
                </div>

                <!-- checking form -->
                 
                <div id="check-availability-app">
                    <div class="tour-info" style="background-color:#2c3e50; color:white;">
                        <div class="form-header">
                            <!-- <h2>Select participants and date</h2> -->
                            <h2>{{ __('messages.select_date') }}</h2>
                        </div>

                        <div style="display: flex; flex-direction: row; gap:10px">
                            <!-- Participants button -->
                            <!-- <div class="date-button-wrapper">
                                <div class="custom-date-button">
                                    <span>
                                        <i class='bx bx-user'></i>
                                        <span>Participant</span> <span>x 3</span>
                                    </span>
                                    <i class='bx bx-chevron-down'></i>
                                </div>
                            </div> -->

                            <!-- Date picker (no auto check) -->
                            <div class="date-button-wrapper" style="width:50%; position:relative;">
                                <button class="custom-date-button" @click="openDatePicker">
                                    <span>
                                        <i class='bx bx-calendar'></i>
                                        <span v-if="selectedDate">Date: @{{ formatFullDate(selectedDate) }}</span>
                                        <span v-else>{{ __('messages.date') }}</span>
                                    </span>
                                    <i class='bx bx-chevron-down'></i>

                                    <!-- With auto-check enabled -->
                                    <input 
                                        ref="dateInput"
                                        v-if="enableAutoCheck"
                                        type="date" 
                                        class="custom-date-input" 
                                        v-model="selectedDate"
                                        @change="checkDateAvailability"
                                        :min="today"
                                    />

                                    <!-- Without auto-check -->
                                    <input 
                                        ref="dateInput"
                                        v-else
                                        type="date" 
                                        class="custom-date-input" 
                                        v-model="selectedDate"
                                        :min="today"
                                    />


                                 </button>
                            </div>


                        </div>

                        <!-- Button to check availability -->
                        <button class="btn btn-primary w-100 mb-3 mt-3" style="border-radius:100px;" 
                            v-if="!enableAutoCheck" 
                            @click="activateAutoCheck">
                                {{ __('messages.check_availability') }}
                        </button>

                        <!-- Not available message -->
                        <div v-if="selectedDate && !showForm && checked" class=" mt-3">
                        {{ __('messages.booking_not_available_on') }} <strong>@{{ selectedDate }}</strong><br>
                            <small class="text-white">{{ __('messages.booking_not_available_on') }}:</small>
                            <div class="available-dates-grid">
                                <!-- <li v-for="date in availableDates" :key="date">@{{ date }}</li> -->
                                <span v-for="date in availableDates" :key="date" class="available-date">
                                    @{{ getDayFromDate(date) }}
                                </span>
                                
                            </div>
                        </div>
                         
                    </div>
                     <!--form to fill -->
                    <div class="tour-info" v-if="showForm && checked" style="color:#2c3e50; border: 2px solid var(--accent-color);">    
                        <form @submit.prevent="submitForm">
                            <div class="form-header text-center">
                                <h5>{{ __('messages.let_us_assist_you_with_your') }} catamaran cruise</h5>
                                <h5>{{ __('messages.call_hero_title') }} <span style="color:var(--secondary-color); font-weight:500;">{{ $siteSettings->whatsapp }}</span></h5>
                            </div>

                            <h4 class="mt-4">{{ __('messages.enter_your_tour_details') }}:</h4>

                            <div class="row mb-3">
                                <!-- Adults -->
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">{{ __('messages.adults') }} <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" v-model="adults" min="1">
                                </div>

                                <!-- Children -->
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">{{ __('messages.children_zero_ten') }}</label>
                                    <input type="number" class="form-control" v-model="children" min="0">
                                </div>
                            </div>

                            <!-- Transport -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.require_transport') }}? <span class="required-field">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="transport-yes" value="yes" v-model="transport_required">
                                    <label class="form-check-label" for="transport-yes">{{ __('messages.yes_please_quote_it') }}</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="transport-no" value="no" v-model="transport_required">
                                    <label class="form-check-label" for="transport-no">{{ __('messages.no_thank_going_on_my_own') }}</label>
                                </div>
                            </div>

                            <!-- Hotel Info -->
                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.hotel_residence_name') }}</label>
                                <input type="text" class="form-control" v-model="hotel_name" placeholder="{{ __('messages.enter_hotel_or_residence_name') }}">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('messages.hotel_room_number') }}</label>
                                <input type="text" class="form-control" v-model="room_number" placeholder="{{ __('messages.room') }} #">
                                <small class="form-text text-muted">{{ __('messages.hotel_require_driver') }}</small>
                            </div>

                            <!-- Lunch -->
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('messages.non_veg_lunch_menu') }}</label>
                                    <input type="number" class="form-control" v-model="lunch_non_veg" min="0">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('messages.veg_lunch_menu') }}</label>
                                    <input type="number" class="form-control" v-model="lunch_veg" min="0">
                                </div>
                            </div>

                            <!-- Special Requests -->
                            <div class="mb-4">
                                <label class="form-label">{{ __('messages.special_requests_comments') }}</label>
                                <textarea class="form-control" v-model="special_requests" rows="3" placeholder="{{ __('messages.special_requests_comments_des') }}..."></textarea>
                            </div>

                            <!-- Personal Info -->
                            <div class="section-title" style="color:#2c3e50;">
                               {{ __('messages.about_you') }}:
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('messages.your_name') }} <span class="required-field">*</span></label>
                                    <input type="text" class="form-control" v-model="full_name" required placeholder="{{ __('messages.enter_your_full_name') }}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('messages.your_email') }} <span class="required-field">*</span></label>
                                    <input type="email" class="form-control" v-model="email" required placeholder="{{ __('messages.enter_your_email_address') }}">
                                </div>
                            </div>

                            <div class="row mb-3">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('messages.country') }} <span class="text-danger">*</span></label>
                                    <input 
                                        list="country-options" 
                                        v-model="country" 
                                        class="form-control" 
                                        required 
                                        placeholder="{{ __('messages.select_your_country') }}"
                                    >

                                    <datalist id="country-options">
                                        <option value="Mauritius">
                                        <option value="France">
                                        <option value="United Kingdom">
                                        <option value="Germany">
                                        <option value="United States">
                                        <option value="Canada">
                                        <option value="Australia">
                                        <option value="South Africa">
                                    </datalist>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">{{ __('messages.mobile_number_whatsapp') }}<span class="required-field">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bx bxl-whatsapp"></i></span>
                                        <input type="tel" class="form-control" v-model="phone" required placeholder="+230 55040167">
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button 
                                    v-if="!loading"
                                    type="submit"
                                    class="book-button"
                                    >
                                    <i class="bx bx-calendar-check"></i>
                                    {{ __('messages.book') }} 
                                </button>

                                <!-- Spinner (show when loading) -->
                                <div v-if="loading" class="spinner-border text-primary" role="status">
                                    <span class="visually-hidden">{{ __('messages.loading') }} ...</span>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

                 
            </div>
            
            <!-- Booking Card -->
            <div class="col-lg-4">
                <div class="booking-card">
                    <div class="mb-3">
                     

                    @if ($tour->is_group_priced)
                        {{-- Group Price --}}
                        <div class="mb-3">
                            @if ($tour->group_price_promotion_price)
                                <div class="text-muted text-decoration-line-through">
                                    {{ __('messages.from') }} €{{ $tour->group_price }}
                                </div>
                                <div class="price text-danger">€{{ $tour->group_price_promotion_price }}</div>
                            @else
                                <span class="text-muted">{{ __('messages.from') }}</span>
                                <div class="price">€{{ $tour->group_price }}</div>
                            @endif
                            <div class="price-subtitle">{{ __('messages.per_group_of') }} {{ $tour->group_size }}</div>
                        </div>
                    
                    @elseif (is_null($tour->transfer_price))
                        {{-- Per Person (No Transfer Option) --}}
                        <div class="mb-3">
                            @if ($tour->starting_promotion_price)
                                <div class="text-muted text-decoration-line-through">
                                    {{ __('messages.from') }} €{{ $tour->starting_price }}
                                </div>
                                <div class="price text-danger">€{{ $tour->starting_promotion_price }}</div>
                            @else
                                <span class="text-muted">{{ __('messages.from') }}</span>
                                <div class="price">€{{ $tour->starting_price }}</div>
                            @endif
                            <div class="price-subtitle">{{ __('messages.per_person') }}</div>
                        </div>
                    
                    @else
                        {{-- With / Without Transfer --}}
                        <div class="mb-3">
                            <span class="text-muted">{{ __('messages.price_options') }}</span>

                            {{-- Without Transfer --}}
                            <div class="price">
                                @if ($tour->starting_promotion_price)
                                    <span class="text-decoration-line-through text-muted">€{{ $tour->starting_price }}</span>
                                    <span class="text-danger ms-2">€{{ $tour->starting_promotion_price }}</span>
                                @else
                                    €{{ $tour->starting_price }}
                                @endif
                                <small class="text-muted" style="font-size: 1.25rem; font-weight: 600;">
                                    {{ __('messages.without_transfer') }}
                                </small>
                            </div>

                            {{-- With Transfer --}}
                            <div class="price">
                                @if ($tour->transfer_promotion_price ?? false)
                                    <span class="text-decoration-line-through text-muted">€{{ $tour->transfer_price }}</span>
                                    <span class="text-danger ms-2">€{{ $tour->transfer_promotion_price }}</span>
                                @else
                                    €{{ $tour->transfer_price }}
                                @endif
                                <small class="text-muted" style="font-size: 1.25rem; font-weight: 600;">
                                    {{ __('messages.with_transfer') }}
                                </small>
                            </div>

                            <div class="price-subtitle">{{ __('messages.per_person') }}</div>
                        </div>
                    @endif

                        
                        <a href="#check-availability-app"><button class="btn btn-primary w-100 mb-3" >{{ __('messages.book') }}</button></a>
                        <!--
                        <div class="reserve-info">
                            <div class="d-flex align-items-center">
                                <i class='bx bx-check-circle'></i>
                                <small class="text-muted">Reserve now & pay later to book your spot and pay nothing today</small>
                            </div>
                        </div> -->
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
                    <h5 class="modal-title" id="galleryModalLabel"></h5>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="photo-counter">
                        <span id="currentSlide">1</span> / <span id="totalSlides">{{ $tour->number_of_pictures }}</span>
                    </div>

                    <div class="swiper-container" id="gallerySwiper">
                        <div class="swiper-wrapper">
                            @for ($i = 1; $i <= $tour->number_of_pictures; $i++)
                                <div class="swiper-slide">
                                    <img src="{{ asset('images/tours/' . $tour->slug . '/' . $tour->slug . '-' . $i . '.jpg') }}"
                                        alt="{{ $tour->title }} Image {{ $i }}">
                                </div>
                            @endfor
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
    

    @if (app()->environment('production'))
        <script src="{{ secure_asset('js/style.js') }}"></script>
    @else
        <script src="{{ asset('js/style.js') }}"></script>
    @endif


    <script>
    //#region  check-availability and sent form
        axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    today: new Date().toISOString().split('T')[0], // e.g., "2025-07-31"
                    loading: false,

                    selectedDate: '',
                    blockedDates: [],
                    availableDates: [],
                    showForm: false,
                    checked: false,
                    tourId: @json($tour->id),
                    enableAutoCheck: false, // flag to enable @change

                    
                    tour: @json($tour), // tour name

                    // All required fields
                    adults: 1,
                    children: 0,
                    transport_required: '',
                    hotel_name: '',
                    tour_date: '',
                    room_number: '',
                    lunch_non_veg: 0,
                    lunch_veg: 0,
                    special_requests: '',
                    full_name: '',
                    email: '',
                    country: '',
                    phone: '',
                };
            },
            methods: {
                fetchBlockedDates() {
                    axios.get(`/api/public/tours/blocked-dates/${this.tourId}`)
                    .then(res => {
                        this.blockedDates = res.data.blocked_dates || [];
                    })
                    .catch(err => {
                        console.error("Error fetching blocked dates", err);
                        this.blockedDates = [];
                    });
                },
                activateAutoCheck() {
                    this.enableAutoCheck = true;
                    this.checkDateAvailability(); // initial check
                },
                checkDateAvailability() {
                    if (!this.selectedDate) return;
                    this.checked = true;

                    const isBlocked = this.blockedDates.includes(this.selectedDate);
                    if (isBlocked) {
                        this.showForm = false;
                        this.getAvailableDatesInMonth(this.selectedDate);
                    } else {
                        this.showForm = true;
                        this.availableDates = [];
                    }
                },
                getDayFromDate(dateStr) {
                    const date = new Date(dateStr);
                    return date.getDate(); // returns only the day number
                },
                formatFullDate(dateStr) {
                    const date = new Date(dateStr + 'T00:00:00'); // ensures it's parsed correctly
                    return date.toLocaleDateString('en-US', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    });
                },
                getAvailableDatesInMonth(dateStr) {
                    const selected = new Date(dateStr);
                    const year = selected.getFullYear();
                    const month = selected.getMonth();
                    const daysInMonth = new Date(year, month + 1, 0).getDate();

                    this.availableDates = [];

                    for (let day = 1; day <= daysInMonth; day++) {
                        const d = new Date(year, month, day);
                        const iso = d.toISOString().split('T')[0];
                        if (!this.blockedDates.includes(iso)) {
                            this.availableDates.push(iso);
                        }
                    }
                },
                
                async submitForm() {
                    this.loading = true; // Show spinner, hide button

                    try {
                        console.log('Submitting tour_date:', this.selectedDate); // ✅ Add this
                        
                        await axios.post('/tour-bookings', {
                            tour_type: this.tour.name, // or title, as per your DB
                            tour_id: this.tour.id, // ✅ Include this!
                            tour_date: this.selectedDate,
                            adults: this.adults,
                            children: this.children,
                            transport_required: this.transport_required,
                            hotel_name: this.hotel_name,
                            room_number: this.room_number,
                            lunch_non_veg: this.lunch_non_veg,
                            lunch_veg: this.lunch_veg,
                            special_requests: this.special_requests,
                            full_name: this.full_name,
                            email: this.email,
                            country: this.country,
                            phone: this.phone,
                        });

                        window.location.href = '/thank-you?type=tour';
                    } catch (error) {
                        alert('Something went wrong! Please try again.');
                        if (error.response && error.response.data && error.response.data.message) {
                            alert(error.response.data.message);
                        } else {
                            alert('Something went wrong! Please try again.');
                        }
                    }finally {
                        this.loading = false; // Always hide spinner after submission
                    }
                },

                openDatePicker() {
                    if (this.$refs.dateInput && this.$refs.dateInput.showPicker) {
                    // Modern browsers (Chrome, Edge, Safari)
                    this.$refs.dateInput.showPicker();
                    } else if (this.$refs.dateInput) {
                    // Fallback for browsers without showPicker
                    this.$refs.dateInput.click();
                    }
                },


            },
            mounted() {
                this.fetchBlockedDates();
            }
        }).mount("#check-availability-app");
    //#endregion  check-availability and sent form

    //#region    heart whislist vue.js
        document.querySelectorAll('.wishlist-heart').forEach(el => {
        const tourId = parseInt(el.dataset.tourId);
        const tourSlug = el.dataset.tourSlug;
        const tourType = el.dataset.tourType;

        Vue.createApp({
            data() {
                return {
                    wishlist: [],
                    item: {
                        id: tourId,
                        slug: tourSlug,
                        type: tourType
                    }
                };
            },
            mounted() {
                const stored = localStorage.getItem('wishlist');
                this.wishlist = stored ? JSON.parse(stored) : [];
            },
            computed: {
                isInWishlist() {
                    return this.wishlist
                        .filter(item => item !== null)
                        .some(item => item.id === this.item.id && item.type === this.item.type);
                }
            },
            methods: {
                toggleWishlist() {
                    if (this.isInWishlist) {
                        this.wishlist = this.wishlist
                            .filter(item => item !== null)
                            .filter(item => !(item.id === this.item.id && item.type === this.item.type));
                    } else {
                        this.wishlist.push(this.item);
                    }
                    localStorage.setItem('wishlist', JSON.stringify(this.wishlist));
                }
            }
            }).mount(el);
           });

    //#endregion heart whislist vue.js
    </script>

@endsection

