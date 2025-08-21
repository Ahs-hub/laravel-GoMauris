@extends('layouts.maincarlayout')

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

    <div class="container py-5 privacy-policy">
        <h1>{{ __('cancellationpolicy.cancellation_policy') }}</h1>
        <p>{!! __('cancellationpolicy.cancellation_intro') !!}</p>

        <h4>{{ __('cancellationpolicy.standard_cancellations') }}</h4>
        <p>{!! __('cancellationpolicy.standard_cancellations_desc') !!}</p>

        <h4>{{ __('cancellationpolicy.unexpected_event_cancellations') }}</h4>
        <p>{!! __('cancellationpolicy.unexpected_event_cancellations_desc') !!}</p>

        <h4>{{ __('cancellationpolicy.late_cancellations') }}</h4>
        <p>{!! __('cancellationpolicy.late_cancellations_desc') !!}</p>

        <h4>{{ __('cancellationpolicy.refund_processing') }}</h4>
        <p>{!! __('cancellationpolicy.refund_processing_desc') !!}</p>

        <hr>

        <p>{!! __('cancellationpolicy.closing_note') !!}</p>
    </div>
@endsection