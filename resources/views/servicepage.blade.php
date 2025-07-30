@extends('layouts.mainlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/servicepage.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/servicepage.css') }}">
    @endif

    <!-- Vue.js -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>


    <!-- Hero Section -->
    <section class="services-hero">
        <div class="container">
            <h1 class="hero-title mb-4">Our Services</h1>
        </div>
    </section>

    <!-- Search and Filter Section -->
    <section class="search-filter-section" id="app">
        <div class="container">
            <div class="search-box">
                <div class="row align-items-center">
                    <div class="">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="bx bx-search"></i>
                            </span>
                            <input type="text" class="form-control border-0" placeholder="Search services..." v-model="searchQuery">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="filter-buttons text-center" style="margin-top:25px; margin-bottom:25px;">
            <button class="btn button-text filter-btn" :class="{ active: activeFilter === 'all' }" @click="setFilter('all')">All Services</button>
            <button class="btn button-text filter-btn" :class="{ active: activeFilter === 'transport' }" @click="setFilter('transport')">Transport</button>
            <button class="btn button-text filter-btn" :class="{ active: activeFilter === 'tours' }" @click="setFilter('tours')">Tours</button>
            <button class="btn button-text filter-btn" :class="{ active: activeFilter === 'travel' }" @click="setFilter('travel')">Travel</button>
        </div>
    <!-- Services Section -->
        <div class="container">
        <div class="row" id="servicesContainer">
            <div
                v-for="(service, index) in filteredServices"
                :key="index"
                class="col-lg-4 col-md-6 service-card"
                :data-category="service.category"
            >
                <a class="service-item" :href="service.buttonLink || '#'" style="text-decoration: none;">
                    <div class="position-relative">
                        <img :src="service.image" :alt="service.title" class="service-image">
                        <div class="service-overlay">
                        <i class="bx text-white" :class="service.icon" style="font-size: 4rem;"></i>
                        </div>
                    </div>
                    <div class="service-content">
                        <h3 class="service-title">@{{ service.title }}</h3>
                        <p class="service-description">@{{ service.description }}</p>
                        <!-- <p class="service-price">
                           <i class="bx bx-check-circle text-success me-3" style="font-size: 1.5rem;"></i>
                            @{{ service.price }}
                        </p>  -->
                        <!-- <div class="d-flex align-items-center mb-3">
                              
                                <span style="color:grey;"> @{{ service.price }}</span>
                        </div> -->
                        

                        
                    </div>
                   
                </a>
            </div>
            </div>
        </div>
    </section>

    <!-- Section Divider -->
    <!-- <div class="container">
        <div class="section-divider"></div>
    </div> -->

    <!-- Marriage Planning Special Section -->
    <!-- <section class="marriage-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1606216794074-735e91aa2c92?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Wedding Planning" class="marriage-image">
                </div>
                <div class="col-lg-6">
                    <div class="marriage-content">
                        <h2 class="section-heading mb-4" style="font-weight: 700; color:var(--primary-color);">We Offer Marriage Planning</h2>
                        <p class="paragraph-text mb-4" style=" color: grey;">Make your special day unforgettable with our comprehensive marriage planning services. From intimate beach ceremonies to grand destination weddings, we handle every detail with precision and care.</p>
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bx bx-check-circle text-success me-3" style="font-size: 1.5rem;"></i>
                                    <span style="color:grey">Venue Selection</span>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bx bx-check-circle text-success me-3" style="font-size: 1.5rem;"></i>
                                    <span style="color:grey">Decoration & Catering</span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bx bx-check-circle text-success me-3" style="font-size: 1.5rem;"></i>
                                    <span style="color:grey">Photography & Video</span>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <i class="bx bx-check-circle text-success me-3" style="font-size: 1.5rem;"></i>
                                    <span style="color:grey;">Honeymoon Packages</span>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="service-btn" style="padding: 15px 40px; font-size: 1.1rem;">Start Planning Your Dream Wedding</a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

<script>
    const { createApp } = Vue;

    createApp({
    data() {
        return {
        searchQuery: '',
        activeFilter: 'all',
        services: [
                {
                    title: "Private Airport Transfer",
                    category: "transport",
                    image: "images/services/luxury_airport_transfer.png",
                    icon: "bx-car",
                    description: "Comfortable and reliable door-to-door airport transfers with professional drivers and luxury vehicles.",
                    buttonText: "Book Now",
                    buttonLink: "{{ route('taxi') }}"
                    // price: "From $33 per transfer"
                },
                {
                    title: "Private Sightseeing Tour",
                    category: "tours",
                    image: "images/services/sightseeing_tour.png",
                    icon: "bx-map",
                    description: "Explore breathtaking destinations with our expert guides and customized itineraries for unforgettable experiences.",
                    buttonText: "Explore Tours",
                    buttonLink: "{{ route('tours.index') }}",
                    //price: "$28 for  a party of 4"
                },
                // {
                //     title: "Activities & Tour",
                //     category: "tours",
                //     image: "https://images.unsplash.com/photo-1682687220742-aba13b6e50ba?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80",
                //     icon: "bx-run",
                //     description: "Thrilling adventures and cultural experiences including water sports, hiking, and local attractions.",
                //     buttonText: "View Activities",
                //     buttonLink: "#",
                //     //price: "Sea & Land Activities"
                // },
                {
                    title: "Car Rental",
                    category: "transport",
                    image: "images/services/car_rental.png",
                    icon: "bx-key",
                    description: "Premium fleet of vehicles available for self-drive adventures with flexible rental options and competitive rates.",
                    buttonText: "Rent Now",
                    buttonLink: "{{ route('cars.home') }}",
                    //price: "Cars from $24 per day"
                },
                {
                    title: "Taxi Services",
                    category: "transport",
                    image: "images/services/taxi_ride.png",
                    icon: "bx-taxi",
                    description: "24/7 taxi services with experienced drivers for convenient city transportation and local travel needs.",
                    buttonText: "Book Taxi",
                    buttonLink: "{{ route('taxi') }}",
                   // price: "Round-trips from $25"
                },
                {
                    title: "Luxury Airport Transfers",
                    category: "transport",
                    image: "images/services/private_airport_transfer.png",
                    icon: "bx-diamond",
                    description: "Premium luxury vehicles with VIP treatment, perfect for business travelers and special occasions.",
                    buttonText: "Book Luxury",
                    buttonLink: "{{ route('taxi') }}",
                   // price: "From $140 per transfer"
                },
              //  {
              //      title: "Accommodations",
               //     category: "travel",
              //      image: "https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80",
               //     icon: "bx-bed",
               //     description: "Handpicked hotels, resorts, and vacation rentals offering comfort and luxury for every budget and preference.",
               //     buttonText: "Find Hotels",
                //    buttonLink: "#",
                  //  price: "500 + Hotels & Villas"
              //  }
                //,
                // {
                //     title: "Marriage Planner",
                //     category: "tours",
                //     image: "https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80",
                //     icon: "bx-heart",
                //     description: "Complete wedding planning services including destination weddings, venue selection, and honeymoon packages.",
                //     buttonText: "Plan Wedding",
                //     buttonLink: "#",
                //     price: "10+ Famous places"
                // }
            ]

        };
    },
    computed: {
        filteredServices() {
        return this.services.filter(service => {
            const matchesCategory =
            this.activeFilter === 'all' || service.category === this.activeFilter;
            const matchesSearch = service.title
            .toLowerCase()
            .includes(this.searchQuery.toLowerCase());
            return matchesCategory && matchesSearch;
        });
        }
    },
    methods: {
        setFilter(filter) {
        this.activeFilter = filter;
        }
    }
    }).mount('#app');
</script>

@endsection