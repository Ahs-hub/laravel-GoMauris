@extends('layouts.mainlayout')

@section('content')
    <!-- Vue -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
  
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/whislistpage.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/whislistpage.css') }}">
    @endif

    <section class="hero-section" style="margin-top:100px;">
        <div class="container">
        <div class="hero-content">
            <!-- <h1 class="hero-title">Premium Car Rental Experience</h1>
            <p class="hero-subtitle">Choose from our exclusive fleet of luxury and economy vehicles</p> -->
            <h3 class="section-heading">Your Wishlist</h3>
        </div>
        </div>
    </section>

    <!--Wishlist section-->
    <section id="wishlist-display-app" v-cloak>
        <div v-if="filteredWishlist.length > 0" class=" wishlist-container">
            <!-- Single grid for all wishlist items -->
            <div class="wishlist-items">
                
                <!-- Each card -->
                <div v-for="item in filteredWishlist" :key="item.id" class="wishlist-card">
                    <div class="card-image">
                        <img :src="`${item.thumbnail}`" :alt="item.title">
                    </div>
                    <div class="card-body">
                        <a :href="getTourUrl(item.slug)" style="text-decoration: none;">
                            <h5>@{{ item.title }}</h5> 
                        </a>
                        <div class="card-price">€@{{ item.price }}/day</div>
                        <div class="type">@{{ item.type }}</div>
                    </div>
                    <button class="remove-icon" @click="removeItem(item.id)">
                        <i class='bx bx-x'></i>
                    </button>
                </div>
            </div>

            <!-- Clear All Button -->
            <div class="clear-wishlist-section">
                <button @click="clearWishlist" class="clear-btn">
                    <i class='bx bx-trash'></i> Clear Wishlist
                </button>
            </div>
        </div>

        <div v-else class="empty-wishlist">
            <i class='bx bx-heart'></i>
            <h4>Your wishlist is empty</h4>
            <p>Start exploring our tours to add items to your wishlist</p>
        </div>
    </section>


    
    <!-- Car Section -->
    <section class="py-5 " style="background: var(--primary-color);">
        <div class="container">
            <div class="row align-items-center">
            
            <!-- Left Side: Text Content -->
            <div class="col-md-6 mb-4 mb-md-0" style="color:white;">
                <h2 class="fw-bold">Need a car?</h2>
                <p class="lead">Rent now and get <strong>10% discount</strong> on all our vehicles. Perfect for tours, business trips, and more!</p>
                <a href="#rent" class="btn btn-lg rounded-0" style="background-color: rgb(255, 166, 50); color:white;">Rent Car</a>
            </div>
        
            <!-- Right Side: Image -->
            <div class="col-md-6 text-center">
                <img  style="width:400px;" src="images/cars/transcar.png" alt="Car Rental" class="img-fluid rounded ">
            </div>
        
            </div>
        </div>
    </section>

    <script>
      const allTours = @json($allTours); // Pass all tours from DB
    </script>

  <script>
      const { createApp } = Vue;

      createApp({
          data() {
              return {
                  wishlist: [],
                  tours: allTours
              };
          },
          computed: {
              filteredWishlist() {
                  return this.wishlist
                      .filter(item => item && item.type === 'tour')
                      .map(item => {
                          const tour = this.tours.find(t => t.id === item.id);
                          return tour ? { ...tour, type: item.type } : null;
                      })
                      .filter(Boolean);
              }
          },
          mounted() {
              const stored = localStorage.getItem('wishlist');
              this.wishlist = stored ? JSON.parse(stored).filter(item => item !== null) : [];


              this.wishlist.forEach(item => {
                const imagePath = `/images/tours/${item.slug}/${item.slug}-1.jpg`;
                console.log(imagePath);
              });
          },
          methods: {
              getTourUrl(slug) {
                  return `/tours/${slug}`;
              },
              removeItem(id) {
                  this.wishlist = this.wishlist.filter(item => item.id !== id);
                  localStorage.setItem('wishlist', JSON.stringify(this.wishlist));
              },
              clearWishlist() {
                  this.wishlist = [];
                  localStorage.removeItem('wishlist');
              }
          }
      }).mount('#wishlist-display-app');
  </script>

@endsection
