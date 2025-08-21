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
            <h1 class="faq-title">{{ __('messages.frequently_asked_questions') }}</h1>
        </div>
        
        <!-- FAQ Items -->
        <div class="faq-item active">
            <a href="#" class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq1">
            {{ __('messages.what_documents_do_ect') }}?
                <i class='bx bx-plus faq-icon'></i>
            </a>
            <div class="faq-answer" id="faq1">
            {{ __('messages.you_will_need_a_valid_ect') }}.
            </div>
        </div>
        
        <div class="faq-item">
            <a href="#" class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq2">
            {{ __('messages.how_early_should_i_ect') }}?
                <i class='bx bx-plus faq-icon'></i>
            </a>
            <div class="faq-answer" id="faq2">
            {{ __('messages.it_recommended_to_book_at_ect') }}.
            </div>
        </div>
        
        <div class="faq-item">
            <a href="#" class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq3">
            {{ __('messages.can_i_drive_anywhere_ect') }}?
                <i class='bx bx-plus faq-icon'></i>
            </a>
            <div class="faq-answer" id="faq3">
            {{ __('messages.yes_you_can_drive_across_the_ect') }}.
            </div>
        </div>
        
        <div class="faq-item">
            <a href="#" class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq4">
            {{ __('messages.is_fuel_included_in_ect') }}?
                <i class='bx bx-plus faq-icon'></i>
            </a>
            <div class="faq-answer" id="faq4">
            {{ __('messages.no_fuel_is_not_includes_ect') }}.
            </div>
        </div>
        
        <div class="faq-item">
            <a href="#" class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq5">
            {{ __('messages.what_about_insurence_and_ect') }}?
                <i class='bx bx-plus faq-icon'></i>
            </a>
            <div class="faq-answer" id="faq5">
            {{ __('messages.basic_insurance_is_usually_included_ect') }}.
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