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
    <h1>Rental Conditions</h1>

    <h4>1. Comprehensive Insurance Coverage</h4>
    <p>At <strong>GoMauris</strong>, your peace of mind is our priority. Our Comprehensive Insurance Coverage—including a Collision Damage Waiver (CDW)—provides robust protection beyond just accidents. When you book directly through our website, you receive full insurance coverage without the need for additional policies.</p>
    <p><strong>Our rentals include:</strong></p>
    <ul>
        <li>Accident Coverage: Protection even if you’re at fault, provided you complete an on-site Agreed Statement of Facts (Accident Form)</li>
        <li>Theft Protection: Coverage for theft incidents (excluding personal belongings)</li>
        <li>Fire, Natural Disasters, and Vandalism: Protection for fire, flash floods, and vandalism</li>
        <li>Additional Damage: Covers hail, falling branches, cracked windscreens, major mechanical breakdowns</li>
    </ul>
    <p><strong>Not Covered:</strong></p>
    <ul>
        <li>Driving under the influence</li>
        <li>Reckless/illegal/off-road driving</li>
        <li>Racing or unauthorized use</li>
        <li>Driving without a valid license</li>
        <li>Personal items left in the car</li>
        <li>Failure to inform office within 24 hrs of the accident</li>
    </ul>
    <p><em>** Breaching any of these will make you fully liable for all vehicle repair costs.</em></p>

    <h4>2. Insurance Excess/Deductible – No Deposit</h4>
    <p>We do not hold a deposit on your card. You only pay an excess if you’re found at fault. The excess is shown on the vehicle page, rental quote, and agreement.</p>
    <p>If at fault, pay within 48 hrs. If not at fault (confirmed by police/insurer), it will be refunded. Refunds may take 7–14 days after confirmation.</p>

    <h4>3. Refundable Minor-Damage & Fines Security Deposit (MDFD)</h4>
    <ul>
        <li>Rs6,000–Rs15,000 depending on vehicle type</li>
        <li>Covers minor damage & traffic fines</li>
        <li>Fully refunded in 14–21 days if no fines/damage</li>
        <li>Tourists must pay online before delivery (link in booking email)</li>
    </ul>

    <h4>4. Delivery Locations</h4>
    <ul>
        <li><strong>Airport:</strong> Meet at Paul Coffee Shop in arrivals</li>
        <li><strong>Hotels:</strong> Delivery to reception</li>
        <li>Original ID and driving license required for all deliveries</li>
    </ul>

    <h4>5. Car Rental Requirements</h4>
    <ul>
        <li>Valid local or international license</li>
        <li>Age 21–75 years</li>
        <li>Age 18–20: Rs300/day fee applies</li>
        <li>Car models are examples—similar alternatives may be provided</li>
        <li>Inspect the car and take photos at delivery</li>
        <li>Meet only uniformed TRAVELHUB staff</li>
    </ul>

    <h4>6. Car Return Guidelines</h4>
    <ul>
        <li>Return to airport departure area</li>
        <li>No refund for early returns</li>
        <li>Late return: Charge applies after 3 hours</li>
        <li>Fuel: Return with same level or pay Rs400/bar</li>
        <li>Lost items: Shipping at your cost</li>
    </ul>

    <h4>7. Booking Amendments</h4>
    <ul>
        <li>Email for extensions at least 48 hrs prior</li>
        <li>If car unavailable, we provide a similar/upgraded one</li>
        <li>If not possible, full refund is given</li>
    </ul>

    <h4>8. Pricing & Payment Terms</h4>
    <ul>
        <li>Rates are per 24-hour period</li>
        <li>Minimum 4-day rental</li>
        <li>Pay 50% on reservation, 50% on delivery</li>
        <li>Full payment option available online</li>
        <li>Separate payment links for rental & MDFD</li>
    </ul>

    <h4>9. In Case of an Accident</h4>
    <ul>
        <li>Call emergency services if needed (114 for medical, 999 for police)</li>
        <li>Take photos/videos of the scene</li>
        <li>Contact our hotline for assistance</li>
        <li>Complete the Accident Form (in glovebox)</li>
        <li>Exchange info with the other driver, sign the form, and submit it to us</li>
        <li>We’ll send a tow and replacement car if vehicle is immobilized</li>
        <li>Email a copy of the form to 
            <a href="https://mailto:gomauristours@gmail.com" style="color:blue; text-decoration: none;">
                gomauristours@gmail.com
            </a> within 24 hrs
        </li>
    </ul>

    <h4>10. Maintenance Alerts</h4>
    <ul>
        <li>Check oil, water, tyre pressure regularly</li>
        <li>Long-term rentals: oil changes every 5,000–10,000 km</li>
        <li>Replacement vehicle provided during maintenance</li>
    </ul>

    <h4>11. Mechanical Issues</h4>
    <ul>
        <li>Report issues immediately to avoid further damage</li>
        <li>Failure to report may void MDFD refund</li>
    </ul>

    <h4>12. Assistance Fee</h4>
    <ul>
        <li><strong>Tyres:</strong> Repair/replacement covered. €35 transport fee if we come to you</li>
        <li><strong>Keys:</strong> Replacement fee + €35 delivery fee (waived if collected)</li>
        <li><strong>Battery:</strong> Recharge = €35 if we come to your location. Free if you come to our office</li>
    </ul>

    <h4>13. Cancellation / Refund Policy</h4>
    <ul>
        <li><strong>Standard:</strong> Full refund if cancelled 72+ hrs before delivery</li>
        <li><strong>Unforeseen events:</strong> Full refund minus €15 fee</li>
        <li><strong>Late cancellations:</strong> 50% refund minus €15 fee</li>
        <li><strong>Processing time:</strong> 7–14 days</li>
        <li><strong>MDFD:</strong> Always refunded 100%</li>
    </ul>

    <hr>

    <p><strong>Enjoy a seamless and transparent car rental experience with TRAVELHUB!</strong></p>
</div>
     

@endsection