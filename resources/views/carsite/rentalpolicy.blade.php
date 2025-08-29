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
        <h1>{{ __('rentalpolicy.title') }}</h1>

        {{-- 1. Insurance --}}
        <h4>{{ __('rentalpolicy.insurance.title') }}</h4>
        <p>{{ __('rentalpolicy.insurance.intro') }}</p>

        <p><strong>{{ __('rentalpolicy.insurance.includes_title') }}</strong></p>
        <ul>
            @foreach(__('rentalpolicy.insurance.includes') as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>

        <p><strong>{{ __('rentalpolicy.insurance.excludes_title') }}</strong></p>
        <ul>
            @foreach(__('rentalpolicy.insurance.excludes') as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
        <p><em>{{ __('rentalpolicy.insurance.note') }}</em></p>

        {{-- 2. Insurance Excess --}}
        <h4>{{ __('rentalpolicy.excess.title') }}</h4>
        @foreach(__('rentalpolicy.excess.text') as $text)
            <p>{{ $text }}</p>
        @endforeach

        {{-- 3. MDFD --}}
        <h4>{{ __('rentalpolicy.mdfd.title') }}</h4>
        <ul>
            @foreach(__('rentalpolicy.mdfd.items') as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>

        {{-- 4. Delivery --}}
        <h4>{{ __('rentalpolicy.delivery.title') }}</h4>
        <ul>
            @foreach(__('rentalpolicy.delivery.items') as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>

        {{-- 5. Requirements --}}
        <h4>{{ __('rentalpolicy.requirements.title') }}</h4>
        <ul>
            @foreach(__('rentalpolicy.requirements.items') as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>

        {{-- 6. Return --}}
        <h4>{{ __('rentalpolicy.return.title') }}</h4>
        <ul>
            @foreach(__('rentalpolicy.return.items') as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>

        {{-- 7. Amendments --}}
        <h4>{{ __('rentalpolicy.amendments.title') }}</h4>
        <ul>
            @foreach(__('rentalpolicy.amendments.items') as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>

        {{-- 8. Payment --}}
        <h4>{{ __('rentalpolicy.payment.title') }}</h4>
        <ul>
            @foreach(__('rentalpolicy.payment.items') as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>

        {{-- 9. Accident --}}
        <h4>{{ __('rentalpolicy.accident.title') }}</h4>
        <ul>
            @foreach(__('rentalpolicy.accident.items') as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>

        {{-- 10. Maintenance --}}
        <h4>{{ __('rentalpolicy.maintenance.title') }}</h4>
        <ul>
            @foreach(__('rentalpolicy.maintenance.items') as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>

        {{-- 11. Mechanical --}}
        <h4>{{ __('rentalpolicy.mechanical.title') }}</h4>
        <ul>
            @foreach(__('rentalpolicy.mechanical.items') as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>

        {{-- 12. Assistance --}}
        <h4>{{ __('rental.assistance.title') }}</h4>
        <ul>
            @foreach(__('rentalpolicy.assistance.items') as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>

        {{-- 13. Cancellation --}}
        <h4>{{ __('rentalpolicy.cancellation.title') }}</h4>
        <ul>
            @foreach(__('rentalpolicy.cancellation.items') as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>

        <hr>

        <p><strong>{{ __('rentalpolicy.closing') }}</strong></p>
    </div>
     

@endsection