
@extends('layouts.mainlayout')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Vue + Axios -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/tourdetailed.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/tourdetailed.css') }}">
    @endif

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
            <h1 class="main-title section-heading">{{ $tour->full_title}}</h1>

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
                <div class="wishlist-heart"
                    data-tour-id="{{ $tour->id }}"
                    data-tour-slug="{{ $tour->slug }}"
                    data-tour-type="tour">
                    <div @click="toggleWishlist" style="cursor: pointer;" class="d-flex align-items-center">
                        <i :class="isInWishlist ? 'bx bxs-heart text-danger' : 'bx bx-heart'"
                        style="font-size: 1.5rem; width: 1.5em; text-align: center;"></i>
                        <span>Add to Wishlist</span>
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
                                    <i class='bx bx-plus'></i> More
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
                 
                    {!! $tour->description !!}
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
                            @php
                                $hours = floor($tour->duration_minutes / 60);
                                $minutes = $tour->duration_minutes % 60;
                            @endphp

                            <strong>Duration 
                                @if ($hours > 0)
                                    {{ $hours }} hours
                                @endif
                                @if ($minutes > 0)
                                    {{ $minutes }} minutes
                                @endif
                            </strong><br>
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
                            <strong>Private group</strong><br>
                            <span class="text-muted">This is a private activity. Only your group will participate.</span>
                        </div>
                    </div>
                </div>

                <!-- checking form -->
                 
                <div id="check-availability-app">
                    <div class="tour-info" style="background-color:#2c3e50; color:white;">
                        <div class="form-header">
                            <!-- <h2>Select participants and date</h2> -->
                            <h2>Select date</h2>
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
                            <div class="date-button-wrapper" style="width:50%">
                                <div class="custom-date-button">
                                    <span>
                                        <i class='bx bx-calendar'></i>
                                        <span v-if="selectedDate">Date: @{{ formatFullDate(selectedDate) }}</span>
                                        <span v-else>Date</span>
                                    </span>
                                    <i class='bx bx-chevron-down'></i>

                                    <!-- With auto-check enabled -->
                                    <input 
                                        v-if="enableAutoCheck"
                                        type="date" 
                                        class="custom-date-input" 
                                        v-model="selectedDate"
                                        @change="checkDateAvailability"
                                    />

                                    <!-- Without auto-check -->
                                    <input 
                                        v-else
                                        type="date" 
                                        class="custom-date-input" 
                                        v-model="selectedDate"
                                    />


                                </div>
                            </div>
                        </div>

                        <!-- Button to check availability -->
                        <button class="btn btn-primary w-100 mb-3 mt-3" style="border-radius:100px;" 
                            v-if="!enableAutoCheck" 
                            @click="activateAutoCheck">
                                Check availability
                        </button>

                        <!-- Not available message -->
                        <div v-if="selectedDate && !showForm && checked" class=" mt-3">
                            Booking not available on <strong>@{{ selectedDate }}</strong><br>
                            <small class="text-white">Available dates this month:</small>
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
                                <h5>Let us assist you with your catamaran cruise</h5>
                                <h5>If you prefer WhatsApp, let's have a chat at <span style="color:var(--secondary-color); font-weight:500;">+230 55040167</span></h5>
                            </div>

                            <h4 class="mt-4">Enter your tour details:</h4>

                            <div class="row mb-3">
                                <!-- Adults -->
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Adults <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" v-model="adults" min="1">
                                </div>

                                <!-- Children -->
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Children (0–10 yrs)</label>
                                    <input type="number" class="form-control" v-model="children" min="0">
                                </div>
                            </div>

                            <!-- Transport -->
                            <div class="mb-3">
                                <label class="form-label">Require Transport? <span class="required-field">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="transport-yes" value="yes" v-model="transport_required">
                                    <label class="form-check-label" for="transport-yes">Yes, please quote for it</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="transport-no" value="no" v-model="transport_required">
                                    <label class="form-check-label" for="transport-no">No thanks, going on my own</label>
                                </div>
                            </div>

                            <!-- Hotel Info -->
                            <div class="mb-3">
                                <label class="form-label">Hotel/Residence Name</label>
                                <input type="text" class="form-control" v-model="hotel_name" placeholder="Enter hotel or residence name">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Hotel Room Number</label>
                                <input type="text" class="form-control" v-model="room_number" placeholder="Room #">
                                <small class="form-text text-muted">Required for hotel access by the driver. Leave blank if you will confirm this later by email.</small>
                            </div>

                            <!-- Lunch -->
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Non-Veg Lunch Menu</label>
                                    <input type="number" class="form-control" v-model="lunch_non_veg" min="0">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Veg Lunch Menu</label>
                                    <input type="number" class="form-control" v-model="lunch_veg" min="0">
                                </div>
                            </div>

                            <!-- Special Requests -->
                            <div class="mb-4">
                                <label class="form-label">Special Requests / Comments</label>
                                <textarea class="form-control" v-model="special_requests" rows="3" placeholder="Any dietary requirements or comments..."></textarea>
                            </div>

                            <!-- Personal Info -->
                            <div class="section-title" style="color:#2c3e50;">
                                About you:
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Your Name <span class="required-field">*</span></label>
                                    <input type="text" class="form-control" v-model="full_name" required placeholder="Enter your full name">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Your Email <span class="required-field">*</span></label>
                                    <input type="email" class="form-control" v-model="email" required placeholder="Enter your email address">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Country <span class="required-field">*</span></label>
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
                                    <label class="form-label">Mobile Number (WhatsApp) <span class="required-field">*</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bx bxl-whatsapp"></i></span>
                                        <input type="tel" class="form-control" v-model="mobile_number" required placeholder="+230 55040167">
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button type="submit" class="book-button">
                                    <i class="bx bx-calendar-check"></i>
                                    Book 
                                </button>
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
                            <div class="mb-3">
                                <span class="text-muted">From</span>
                                <div class="price">€{{ $tour->group_price }}</div>
                                <div class="price-subtitle">per group of {{ $tour->group_size }}</div>
                            </div>
                        @elseif (is_null($tour->transfer_price))
                            <!-- Show this if transfer_price is null -->
                            <div class="mb-3">
                                <span class="text-muted">From</span>
                                <div class="price">€{{ $tour->starting_price }}</div>
                                <div class="price-subtitle">per person</div>
                            </div>
                        @else
                            <!-- Show this if transfer_price is not null -->
                            <div class="mb-3">
                                <span class="text-muted">Price options</span>
                                <div class="price">
                                    €{{ $tour->starting_price }}
                                    <small class="text-muted" style="font-size: 1.25rem; font-weight: 600;">without transfer</small>
                                </div>
                                <div class="price">
                                    €{{ $tour->transfer_price }}
                                    <small class="text-muted" style="font-size: 1.25rem; font-weight: 600;">with transfer</small>
                                </div>
                                <div class="price-subtitle">per person</div>
                            </div>
                        @endif

                        
                        <a href="#check-availability-app"><button class="btn btn-primary w-100 mb-3" >Book</button></a>
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
                    mobile_number: '',
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
                            mobile_number: this.mobile_number,
                        });

                        window.location.href = '/thank-you?type=tour';
                    } catch (error) {
                        alert('Something went wrong! Please try again.');
                        if (error.response && error.response.data && error.response.data.message) {
                            alert(error.response.data.message);
                        } else {
                            alert('Something went wrong! Please try again.');
                        }
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

