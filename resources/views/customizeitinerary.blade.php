@extends(request('type') === 'car' ? 'layouts.maincarlayout' : 'layouts.mainlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/customizeitinerary.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/customizeitinerary.css') }}">
    @endif

    <!-- Add Vue.js CDN once in your page (before </body>) -->
   <script src="https://unpkg.com/vue@3/dist/vue.global.prod.js"></script>

    <div class="d-flex justify-content-center align-items-center min-vh-100" style="margin-bottom:100px;">
        <div class="container" style="max-width: 800px; width: 100%;">

            <h1 class="text-center mb-4 section-heading" style="margin-top:50px; color:#262626; margin-bottom:70px;">{{ __('messages.hero_title_customize') }}</h1>

            <div class="tour-info shadow p-4 p-md-5 rounded custom-tour" style="color:#2c3e50; border: 2px solid var(--accent-color);">

                <form method="POST" action="{{ route('custom-tour.store') }}">
                    @csrf
                    <div class="form-header text-center mb-4">
                        <h5>{{ __('messages.subtitle_customized') }}</h5>
                        <h5>{{ __('messages.call_hero_title') }} 
                            <span>
                                <a href="https://wa.me/23055040167" target="_blank" class="whatsapp-link" style="color: var(--secondary-color); font-weight: 500;">
                                    +230 55040167
                                </a>
                            </span>
                        </h5>
                    </div>

                    <!-- Tour Details -->
                    <div class="section-title h4 mb-3" style="color:#2c3e50;">{{ __('messages.enter_your_tour_detail') }} :</div>

                    <div class="row mb-3">
                        <!-- <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.vehicle_category') }} <span class="text-danger">*</span></label>
                            <select class="form-select" name="vehicle_category" required>
                                <option value="">{{ __('messages.select_a_category') }}</option>
                                <option value="standard">{{ __('messages.standard') }}</option>
                                <option value="accommodate">{{ __('messages.accommodate') }}</option>
                                <option value="luxury">{{ __('messages.luxury') }}</option>
                            </select>
                        </div> -->

                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.passengers') }} <span class="text-danger">*</span></label>
                            <input type="number" min="1" name="passengers" class="form-control" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.tour_date') }}  <span class="text-danger">*</span></label>
                            <input 
                                type="date" 
                                name="tour_date" 
                                class="form-control" 
                                required 
                                min="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
                            >
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.preferred_start_time') }}</label>
                            <input type="time" name="start_time" class="form-control">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.hotel_residence_name') }}</label>
                            <input type="text" name="hotel_name" class="form-control" placeholder="{{ __('messages.enter_hotel_or_residence_name') }}">
                        </div>

                        <div id="tour-app"  class="col-md-12 mb-3" style="position:relative">
                            <label class="form-label">{{ __('messages.preferred_tour') }}</label>
                            <!-- <input type="text" name="preferred_tour" class="form-control" placeholder="e.g., South Tour, Catamaran">    -->   
                        
                            <!-- Input field -->
                            <input 
                                type="text" 
                                name="preferred_tour"   
                                class="form-control"
                                v-model="preferredTourString"
                                @focus="showList = true"
                                @blur="hideList"
                                placeholder="e.g., South Tour, Catamaran"
                            >

                            <!-- Dropdown list -->
                            <ul v-if="showList" 
                                class="list-group mt-1 position-absolute w-100" 
                                style="z-index: 1000; max-height: 200px;  overflow-y: auto;">
                                <li 
                                    v-for="(tour, index) in tours" 
                                    :key="index" 
                                    class="list-group-item list-group-item-action"
                                    @mousedown.prevent="addTour(tour)" 
                                    style="cursor: pointer;"
                                >
                                    @{{ tour }}
                                </li>
                            </ul>
                      
                        </div> 
                        <!-- <div class="col-md-12 mb-3">
                            <label class="form-label">{{ __('messages.preferred_tour') }}</label>
                            <input list="tour-options" 
                                type="text" 
                                name="preferred_tour" 
                                class="form-control" 
                                placeholder="e.g., South Tour, Catamaran">

                            <datalist id="tour-options">
                                <option value="South Tour">
                                <option value="North Tour">
                                <option value="Catamaran">
                                <option value="Ile aux Cerfs">
                                <option value="Port Louis City Tour">
                            </datalist>
                        </div> -->


                    </div>

                    <div class="mb-4">
                        <label class="form-label">{{ __('messages.preferred_itinerary_comments') }}</label>
                        <textarea name="comments" class="form-control" rows="3" placeholder="{{ __('messages.preferred_itinerary_desc') }}..."></textarea>
                    </div>

                    <!-- Choose Ride Category  -->
                    <div class="section-title h4 mb-3 form-label" style="color:#2c3e50;">{{ __('messages.choose_ride_category') }}:</div>
                   
                    <div class="row g-3">
                        <!-- Economy -->
                        <div class="col-6 col-md-3">
                            <label class="vehicle-card w-100">
                                <input type="radio" name="vehicle_category" value="economy" class="d-none">
                                <img src="{{ asset('images/services/economy_small.png') }}" alt="{{ __('messages.economy') }}">
                                <div class="fw-bold">{{ __('messages.economy') }}</div>
                                <div class="vehicle-info">
                                    <i class='bx bx-user'></i> x 3
                                    <i class='bx bx-briefcase'></i> x 3
                                </div>
                            </label>
                        </div>

                        <!-- Comfort -->
                        <div class="col-6 col-md-3">
                            <label class="vehicle-card w-100">
                                <input type="radio" name="vehicle_category" value="comfort" class="d-none">
                                <img src="{{ asset('images/services/comfort_small.png') }}" alt="{{ __('messages.comfort') }}">
                                <div class="fw-bold">{{ __('messages.comfort') }}</div>
                                <div class="vehicle-info">
                                    <i class='bx bx-user'></i> x 3
                                    <i class='bx bx-briefcase'></i> x 3
                                </div>
                            </label>
                        </div>

                        <!-- Business -->
                        <div class="col-6 col-md-3">
                            <label class="vehicle-card w-100">
                                <input type="radio" name="vehicle_category" value="business" class="d-none">
                                <img src="{{ asset('images/services/business_small.png') }}" alt="{{ __('messages.business') }}">
                                <div class="fw-bold">{{ __('messages.business') }}</div>
                                <div class="vehicle-info">
                                    <i class='bx bx-user'></i> x 3
                                    <i class='bx bx-briefcase'></i> x 3
                                </div>
                            </label>
                        </div>

                        <!-- Minibus -->
                        <div class="col-6 col-md-3">
                            <label class="vehicle-card w-100">
                                <input type="radio" name="vehicle_category" value="minibus" class="d-none">
                                <img src="{{ asset('images/services/minibus_small.png') }}" alt="{{ __('messages.minibus') }}">
                                <div class="fw-bold">{{ __('messages.minibus') }}</div>
                                <div class="vehicle-info">
                                    <i class='bx bx-user'></i> x 16
                                    <i class='bx bx-briefcase'></i> x 16
                                </div>
                            </label>
                        </div>
                    </div>


                    <!-- About You -->
                    <div class="section-title h4 mb-3" style="color:#2c3e50;">{{ __('messages.about_you') }}:</div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.your_name') }} <span class="text-danger">*</span></label>
                            <input type="text" name="full_name" class="form-control" required placeholder="{{ __('messages.enter_your_full_name') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.your_email') }} <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" required placeholder="{{ __('messages.enter_your_email_address') }}">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('messages.country') }} <span class="text-danger">*</span></label>
                            <input 
                                list="country-options" 
                                name="country" 
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
                            <label class="form-label">{{ __('messages.mobile_number_whatsapp') }} <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bx bxl-whatsapp"></i></span>
                                <input type="tel" name="phone" class="form-control" required placeholder="+230 55040167">
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="book-button" id="customtourSubmitBtn">
                        {{ __('messages.send_a_quote') }}
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
        {{ __('messages.tours_activities') }}
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

    </section>


    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    selectedTours: [],
                    tours: @json($tours->map(fn($t) => $t->{'name_' . app()->getLocale()})), // ✅ inject names from Laravel
                    showList: false
                }
            },
            computed: {
                preferredTourString: {
                    get() {
                        return this.selectedTours.join(", ");
                    },
                    set(val) {
                        this.selectedTours = val.split(",").map(v => v.trim()).filter(v => v !== "");
                    }
                }
            },
            methods: {
                addTour(tour) {
                    if (!this.selectedTours.includes(tour)) {
                        this.selectedTours.push(tour);
                    }
                },
                hideList() {
                    setTimeout(() => { this.showList = false }, 200);
                }
            }
        }).mount("#tour-app");
    </script>



@endsection