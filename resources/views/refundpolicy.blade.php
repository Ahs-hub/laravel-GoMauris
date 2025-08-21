@extends('layouts.mainlayout')

@section('title', 'Privacy Policy')

@section('content')
    <style>
        .privacy-policy {
            font-family: 'Segoe UI', Roboto, sans-serif;
            color: #222;
            line-height: 1.7;
            font-size: 1rem;
        }

        .privacy-policy h1 {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: #1a1a1a;
        }

        .privacy-policy h4 {
            font-weight: 600;
            font-size: 1.2rem;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #1a1a1a;
        }

        .privacy-policy a {
            color: #0078d4;
            text-decoration: none;
        }

        .privacy-policy a:hover {
            text-decoration: underline;
        }

        .privacy-policy ul {
            padding-left: 1.25rem;
        }

        .privacy-policy hr {
            border-color: #ddd;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
        }
    </style>


    <div class="container py-5">
        <div class="privacy-policy">
            <h1>{{ __('refundpolicy.refund_policy') }}</h1>

            <p>{{ __('refundpolicy.refund_intro') }} <a href="mailto:{{ $siteSettings->contact_email }}" style="color:var(--primary-color); text-decoration: none;">
                {{ __('refundpolicy.contact_email') }}
            </a></p>

            <h4>{{ __('refundpolicy.customer_cancellations') }}</h4>
            <ul>
                <li><strong>{{ __('refundpolicy.full_refund_eligibility') }}:</strong> {{ __('refundpolicy.full_refund_eligibility_desc') }} 
                    <a href="mailto:{{ $siteSettings->contact_email }}" style="color:var(--primary-color); text-decoration: none;">
                        {{ __('refundpolicy.contact_email') }}
                    </a>
                </li>
                <li><strong>{{ __('refundpolicy.effective_cancellation_notice') }}:</strong> {{ __('refundpolicy.effective_cancellation_notice_desc') }}</li>
            </ul>

            <h4>{{ __('refundpolicy.weather_cancellations') }}</h4>
            <ul>
                <li><strong>{{ __('refundpolicy.full_refund_weather') }}:</strong> {{ __('refundpolicy.full_refund_weather_desc') }}</li>
                <li><strong>{{ __('refundpolicy.no_refund_operational') }}:</strong> {{ __('refundpolicy.no_refund_operational_desc') }}</li>
            </ul>

            <h4>{{ __('refundpolicy.no_show_late') }}</h4>
            <ul>
                <li><strong>{{ __('refundpolicy.strict_no_show') }}:</strong> {{ __('refundpolicy.strict_no_show_desc') }}</li>
            </ul>

            <h4>{{ __('refundpolicy.refund_processing') }}</h4>
            <ul>
                <li><strong>{{ __('refundpolicy.refund_request_processing') }}:</strong> {{ __('refundpolicy.refund_request_processing_desc') }}</li>
                <li><strong>{{ __('refundpolicy.bank_refund_time') }}:</strong> {{ __('refundpolicy.bank_refund_time_desc') }}</li>
            </ul>

            <hr>

            <p>{{ __('refundpolicy.closing_note') }} 
            <a href="mailto:{{ __('refundpolicy.contact_email') }}" style="color:var(--primary-color); text-decoration: none;">
                    {{ __('refundpolicy.contact_email') }}
            </a>.
            </p>
        </div>
    </div>





    
@endsection