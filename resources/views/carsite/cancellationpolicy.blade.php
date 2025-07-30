@extends('layouts.mainlayout')

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
        <h1>Cancellation Policy</h1>
        <p>
            At <strong>GoMauris Mauritius Car Rental</strong>, we understand that travel plans can change unexpectedly.
            To provide clarity and transparency, we have outlined our cancellation policy below.
        </p>

        <h4>1. Standard Cancellations</h4>
        <p>
            If you need to cancel your booking, please email <a href="mailto:rentals@travelhub.mu">rentals@travelhub.mu</a>
            at least <strong>72 hours before</strong> the scheduled vehicle delivery. Cancellations made within this
            timeframe will be eligible for a <strong>full refund</strong>.
        </p>

        <h4>2. Cancellations Due to Unexpected Events</h4>
        <p>
            We recognize unforeseen circumstances, such as global health crises or natural disasters, may arise.
            If your cancellation is due to an extraordinary event beyond your control, you will still receive a
            <strong>full refund</strong>, even if the cancellation is made within 72 hours of delivery.
        </p>

        <h4>3. Late Cancellations</h4>
        <p>
            Cancellations made <strong>less than 72 hours</strong> before the scheduled delivery are considered
            late and are <strong>non-refundable</strong>. However, if you have paid the full rental amount upfront,
            you will receive a <strong>50% refund</strong>, with the remaining amount retained to cover operational costs.
            <strong>MDFD</strong> is also <strong>fully refunded</strong> no matter when you cancel.
        </p>

        <h4>4. Refund Processing</h4>
        <p>
            Refunds are processed via the original payment method. Please allow <strong>3 to 5 weeks</strong> for bank refunds
            to be completed, as processing times vary depending on financial institutions.
        </p>

        <hr>

        <p>
            For any questions or assistance regarding cancellations, please contact us at
            <a href="mailto:rentals@travelhub.mu">rentals@travelhub.mu</a>.
            We appreciate your understanding and look forward to assisting you with future car rental needs.
        </p>
    </div>

@endsection