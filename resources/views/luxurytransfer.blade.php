
@extends('layouts.mainlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/luxurytransfer.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/luxurytransfer.css') }}">
    @endif

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 text-center">
                    <h1 class="hero-title ">Luxury Airport Transfer</h1>
                    <p class="subheading mb-4">Get in touch for premium tour and car rental services</p>
                </div>
            </div>
        </div>
    </section>


    Hello

@endsection