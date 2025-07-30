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
            <h1>Customer Privacy Policy</h1>

            <p><strong>Last Updated:</strong> 30-Jul-2025<br>
            <strong>Effective Date:</strong> 30-Jul-2025</p>

            <p>Protecting your personal data is important to us. We collect only the essential information needed to respond to your booking requests for tours or car rentals. This includes your name, contact details, and your requested services.</p>

            <p>We do not process online payments on this website. Bookings are completed via WhatsApp or email after initial submission.</p>

            <hr>

            <h4>1. Information We Collect</h4>
            <ul>
                <li>Full Name</li>
                <li>Email Address</li>
                <li>Phone Number</li>
                <li>Tour or Car Rental Preferences</li>
            </ul>

            <h4>2. How We Use Your Information</h4>
            <p>We use your data to:</p>
            <ul>
                <li>Respond to your quote or booking request</li>
                <li>Provide service updates via email or WhatsApp</li>
                <li>Maintain a record of customer inquiries</li>
            </ul>

            <h4>3. Data Retention</h4>
            <p>We store your data securely and only as long as necessary, up to 2 years, unless legally required to retain it longer.</p>

            <h4>4. Data Sharing</h4>
            <p>We do not sell or share your data with third parties. Your data may be disclosed only to:</p>
            <ul>
                <li>Meet legal obligations</li>
                <li>Prevent fraud or misuse</li>
                <li>Fulfill booking requests when required</li>
            </ul>

            <h4>5. Your Rights</h4>
            <p>You may request to access, correct, or delete your personal data at any time. Contact us at <a href="mailto:info@yourcompany.com">info@yourcompany.com</a>.</p>

            <h4>6. Cookies</h4>
            <p>We may use basic cookies to improve performance and analytics. You can disable cookies via your browser settings.</p>

            <h4>7. External Links</h4>
            <p>Our website may contain links to other websites. We are not responsible for their privacy practices. Please review their respective policies.</p>

            <h4>8. Policy Updates</h4>
            <p>We may update this policy without notice. The latest version will always be posted on this page.</p>

            <h4>9. Contact Us</h4>
            <p>For any privacy-related concerns:</p>
            <ul>
                <li>Email: <a href="mailto:info@yourcompany.com">info@yourcompany.com</a></li>
                <li>Phone: +230 55040167</li>
                <li>Address: Royal Road, Port Louis, Mauritius</li>
            </ul>

            <p class="text-muted mt-4 small">© 2025 GoMauris. All rights reserved.</p>
        </div>
    </div>
</div>



    
@endsection