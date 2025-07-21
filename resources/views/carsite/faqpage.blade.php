@extends('layouts.maincarlayout')

@section('content')
    @if (app()->environment('production'))
        <link rel="stylesheet" href="{{ secure_asset('css/faqpage.css') }}">
    @else
        <link rel="stylesheet" href="{{ asset('css/faqpage.css') }}">
    @endif

    <div class="faq-container">
        <!-- Header -->
        <div class="faq-header">
            <h1 class="faq-title">Frequently Asked Questions</h1>
        </div>
        
        <!-- FAQ Items -->
        <div class="faq-item active">
            <a href="#" class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq1">
                 What documents do I need to rent a car in Mauritius?
                <i class='bx bx-plus faq-icon'></i>
            </a>
            <div class="faq-answer" id="faq1">
            You will need a valid driver's license (held for at least one year), your passport, and a credit card for the security deposit.
            </div>
        </div>
        
        <div class="faq-item">
            <a href="#" class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq2">
                How early should I book my car?
                <i class='bx bx-plus faq-icon'></i>
            </a>
            <div class="faq-answer" id="faq2">
                It's recommended to book at least 1-2 weeks in advance, especially during peak tourist seasons (December–March, July–August).
            </div>
        </div>
        
        <div class="faq-item">
            <a href="#" class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq3">
                Can I drive anywhere in Mauritius?
                <i class='bx bx-plus faq-icon'></i>
            </a>
            <div class="faq-answer" id="faq3">
            Yes! You can drive across the island. Most roads are well-maintained, and Google Maps works well. Just remember that driving is on the **left side**.
            </div>
        </div>
        
        <div class="faq-item">
            <a href="#" class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq4">
                Is fuel included in the rental price?
                <i class='bx bx-plus faq-icon'></i>
            </a>
            <div class="faq-answer" id="faq4">
            No, fuel is not included. Cars are typically provided with a full tank and must be returned with the same level.
            </div>
        </div>
        
        <div class="faq-item">
            <a href="#" class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq5">
                What about insurance and deposits?
                <i class='bx bx-plus faq-icon'></i>
            </a>
            <div class="faq-answer" id="faq5">
            Basic insurance is usually included. A security deposit (refundable) is required. You can also opt for full coverage at an additional cost.
            </div>
        </div>
    </div>

    <script>
        // Custom FAQ toggle functionality
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', function(e) {
                e.preventDefault();
                
                const faqItem = this.closest('.faq-item');
                const isActive = faqItem.classList.contains('active');
                
                // Close all other FAQ items
                document.querySelectorAll('.faq-item').forEach(item => {
                    item.classList.remove('active');
                });
                
                // Toggle current item
                if (!isActive) {
                    faqItem.classList.add('active');
                }
            });
        });
    </script>
    
@endsection