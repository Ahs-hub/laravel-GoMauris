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
        <h1>Refund Policy</h1>

        <p>Welcome to Travelhub Mauritius! We aim to provide an exceptional and hassle-free experience for our valued customers. Our refund policy is designed to ensure fairness and transparency, making your booking experience with us smooth and worry-free. Please read the following guidelines carefully:</p>

        <h4>Customer-Initiated Cancellations:</h4>
        <ul>
            <li><strong>Full Refund Eligibility:</strong> Customers who cancel their tour at least 24 hours before the scheduled commencement will receive a full refund. To initiate a cancellation, please send an email to <a href="mailto:hello@travelhub.mu">hello@travelhub.mu</a>.</li>
            <li><strong>Effective Cancellation Notice:</strong> Your cancellation request will only be effective upon receipt of your email. Ensure to include your booking details for prompt processing.</li>
        </ul>

        <h4>Weather-Related Cancellations:</h4>
        <ul>
            <li><strong>Full Refund Guarantee:</strong> If an activity is canceled due to adverse weather conditions, we guarantee a full refund to all affected customers.</li>
            <li><strong>No Refund for Operational Activities:</strong> If the activity operates as scheduled and the customer decides not to participate, they will be charged for a last-minute cancellation.</li>
        </ul>

        <h4>No Show and Late Arrivals:</h4>
        <ul>
            <li><strong>Strict No Show Policy:</strong> In case of a “No Show” or late arrival by a customer, the tour will depart on time as scheduled. Customers will be charged 100% of the tour cost.</li>
        </ul>

        <h4>Refund Processing:</h4>
        <ul>
            <li><strong>Refund Request Processing:</strong> Once the refund request is submitted, our accounting team will process it within 2 working days.</li>
            <li><strong>Bank Refund Time:</strong> After processing, it may take up to 7 days for the bank to issue the refund.</li>
        </ul>

        <hr>

        <p>At Travelhub Mauritius, we strive to deliver exceptional service and unforgettable experiences. Our refund policy is designed to give you peace of mind, knowing your investment is secure. For inquiries, contact us at <a href="mailto:hello@travelhub.mu">hello@travelhub.mu</a>.</p>
    </div>
</div>




    
@endsection