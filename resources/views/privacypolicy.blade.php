@extends(request('type') === 'car' ? 'layouts.maincarlayout' : 'layouts.mainlayout')

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


<div class="container py-5 privacy-policy">
    <div class="row">
        <div class="col-lg-10">
            <h1>{{ __('privacypolicy.customer_privacy_policy') }}</h1>

            <p>
                <strong>{{ __('privacypolicy.last_updated') }}:</strong> 30-Jul-2025<br>
                <strong>{{ __('privacypolicy.effective_date') }}:</strong> 30-Jul-2025
            </p>

            <p>{{ __('privacypolicy.privacy_intro') }}</p>

            <p>{{ __('privacypolicy.privacy_no_payment') }}</p>

            <hr>

            <h4>{{ __('privacypolicy.information_we_collect') }}</h4>
            <ul>
                <li>{{ __('privacypolicy.info_full_name') }}</li>
                <li>{{ __('privacypolicy.info_email') }}</li>
                <li>{{ __('privacypolicy.info_phone') }}</li>
                <li>{{ __('privacypolicy.info_preferences') }}</li>
            </ul>

            <h4>{{ __('privacypolicy.how_we_use_info') }}</h4>
            <p>{{ __('messages.we_use_your_data_to') ?? 'We use your data to:' }}</p>
            <ul>
                <li>{{ __('privacypolicy.use_respond') }}</li>
                <li>{{ __('privacypolicy.use_updates') }}</li>
                <li>{{ __('privacypolicy.use_record') }}</li>
            </ul>

            <h4>{{ __('privacypolicy.data_retention') }}</h4>
            <p>{{ __('privacypolicy.data_retention_text') }}</p>

            <h4>{{ __('privacypolicy.data_sharing') }}</h4>
            <p>{{ __('privacypolicy.data_sharing_text') }}</p>
            <ul>
                <li>{{ __('privacypolicy.data_sharing_legal') }}</li>
                <li>{{ __('privacypolicy.data_sharing_fraud') }}</li>
                <li>{{ __('privacypolicy.data_sharing_booking') }}</li>
            </ul>

            <h4>{{ __('privacypolicy.your_rights') }}</h4>
            <p>
                {{ __('privacypolicy.your_rights_text') }}
                <a href="mailto:{{ $siteSettings->contact_email }}" style="color:blue; text-decoration: none;">
                {{ $siteSettings->contact_email }}
                </a>.
            </p>

            <h4>{{ __('privacypolicy.cookies') }}</h4>
            <p>{{ __('privacypolicy.cookies_text') }}</p>

            <h4>{{ __('privacypolicy.external_links') }}</h4>
            <p>{{ __('privacypolicy.external_links_text') }}</p>

            <h4>{{ __('privacypolicy.policy_updates') }}</h4>
            <p>{{ __('privacypolicy.policy_updates_text') }}</p>

            <h4>{{ __('privacypolicy.contact_us') }}</h4>
            <ul>
                <li>{{ __('privacypolicy.contact_email') }} {{ $siteSettings->contact_email }}</li>
                <li>{{ __('privacypolicy.contact_phone') }} {{ $siteSettings->whatsapp }}</li>
                <li>{{ __('privacypolicy.contact_address') }}</li>
            </ul>

            <p class="text-muted mt-4 small">{{ __('privacypolicy.copyright') }}</p>
        </div>
    </div>
</div>



    
@endsection