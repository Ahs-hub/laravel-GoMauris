<?php
// resources/lang/en/rental.php

return [

    'title' => 'Rental Conditions',

    'insurance' => [
        'title' => '1. Comprehensive Insurance Coverage',
        'intro' => 'At GoMauris, your peace of mind is our priority. Our Comprehensive Insurance Coverage—including a Collision Damage Waiver (CDW)—provides robust protection beyond just accidents. When you book directly through our website, you receive full insurance coverage without the need for additional policies.',
        'includes_title' => 'Our rentals include:',
        'includes' => [
            'accident' => 'Accident Coverage: Protection even if you’re at fault, provided you complete an on-site Agreed Statement of Facts (Accident Form)',
            'theft' => 'Theft Protection: Coverage for theft incidents (excluding personal belongings)',
            'fire' => 'Fire, Natural Disasters, and Vandalism: Protection for fire, flash floods, and vandalism',
            'damage' => 'Additional Damage: Covers hail, falling branches, cracked windscreens, major mechanical breakdowns',
        ],
        'excludes_title' => 'Not Covered:',
        'excludes' => [
            'alcohol' => 'Driving under the influence',
            'reckless' => 'Reckless/illegal/off-road driving',
            'racing' => 'Racing or unauthorized use',
            'license' => 'Driving without a valid license',
            'personal' => 'Personal items left in the car',
            'reporting' => 'Failure to inform office within 24 hrs of the accident',
        ],
        'note' => '** Breaching any of these will make you fully liable for all vehicle repair costs.',
    ],

    'excess' => [
        'title' => '2. Insurance Excess/Deductible – No Deposit',
        'text' => [
            'no_deposit' => 'We do not hold a deposit on your card. You only pay an excess if you’re found at fault. The excess is shown on the vehicle page, rental quote, and agreement.',
            'refund' => 'If at fault, pay within 48 hrs. If not at fault (confirmed by police/insurer), it will be refunded. Refunds may take 7–14 days after confirmation.',
        ],
    ],

    'mdfd' => [
        'title' => '3. Refundable Minor-Damage & Fines Security Deposit (MDFD)',
        'items' => [
            'amount' => 'Rs6,000–Rs15,000 depending on vehicle type',
            'coverage' => 'Covers minor damage & traffic fines',
            'refund' => 'Fully refunded in 14–21 days if no fines/damage',
            'tourists' => 'Tourists must pay online before delivery (link in booking email)',
        ],
    ],

    'delivery' => [
        'title' => '4. Delivery Locations',
        'items' => [
            'airport' => 'Airport: Meet at Paul Coffee Shop in arrivals',
            'hotels' => 'Hotels: Delivery to reception',
            'id' => 'Original ID and driving license required for all deliveries',
        ],
    ],

    'requirements' => [
        'title' => '5. Car Rental Requirements',
        'items' => [
            'license' => 'Valid local or international license',
            'age' => 'Age 21–75 years',
            'age_fee' => 'Age 18–20: Rs300/day fee applies',
            'model' => 'Car models are examples—similar alternatives may be provided',
            'inspection' => 'Inspect the car and take photos at delivery',
            'staff' => 'Meet only uniformed GoMauris staff',
        ],
    ],

    'return' => [
        'title' => '6. Car Return Guidelines',
        'items' => [
            'airport' => 'Return to airport departure area',
            'no_refund' => 'No refund for early returns',
            'late' => 'Late return: Charge applies after 3 hours',
            'fuel' => 'Fuel: Return with same level or pay Rs400/bar',
            'lost' => 'Lost items: Shipping at your cost',
        ],
    ],

    'amendments' => [
        'title' => '7. Booking Amendments',
        'items' => [
            'extensions' => 'Email for extensions at least 48 hrs prior',
            'alternative' => 'If car unavailable, we provide a similar/upgraded one',
            'refund' => 'If not possible, full refund is given',
        ],
    ],

    'payment' => [
        'title' => '8. Pricing & Payment Terms',
        'items' => [
            'period' => 'Rates are per 24-hour period',
            'minimum' => 'Minimum 4-day rental',
            'split' => 'Pay 50% on reservation, 50% on delivery',
            'full' => 'Full payment option available online',
            'separate' => 'Separate payment links for rental & MDFD',
        ],
    ],

    'accident' => [
        'title' => '9. In Case of an Accident',
        'items' => [
            'emergency' => 'Call emergency services if needed (114 for medical, 999 for police)',
            'photos' => 'Take photos/videos of the scene',
            'hotline' => 'Contact our hotline for assistance',
            'form' => 'Complete the Accident Form (in glovebox)',
            'exchange' => 'Exchange info with the other driver, sign the form, and submit it to us',
            'replacement' => 'We’ll send a tow and replacement car if vehicle is immobilized',
            'email' => 'Email a copy of the form to gomauristours@gmail.com within 24 hrs',
        ],
    ],

    'maintenance' => [
        'title' => '10. Maintenance Alerts',
        'items' => [
            'check' => 'Check oil, water, tyre pressure regularly',
            'long_term' => 'Long-term rentals: oil changes every 5,000–10,000 km',
            'replacement' => 'Replacement vehicle provided during maintenance',
        ],
    ],

    'mechanical' => [
        'title' => '11. Mechanical Issues',
        'items' => [
            'report' => 'Report issues immediately to avoid further damage',
            'void' => 'Failure to report may void MDFD refund',
        ],
    ],

    'assistance' => [
        'title' => '12. Assistance Fee',
        'items' => [
            'tyres' => 'Tyres: Repair/replacement covered. €35 transport fee if we come to you',
            'keys' => 'Keys: Replacement fee + €35 delivery fee (waived if collected)',
            'battery' => 'Battery: Recharge = €35 if we come to your location. Free if you come to our office',
        ],
    ],

    'cancellation' => [
        'title' => '13. Cancellation / Refund Policy',
        'items' => [
            'standard' => 'Standard: Full refund if cancelled 72+ hrs before delivery',
            'events' => 'Unforeseen events: Full refund minus €15 fee',
            'late' => 'Late cancellations: 50% refund minus €15 fee',
            'processing' => 'Processing time: 7–14 days',
            'mdfd' => 'MDFD: Always refunded 100%',
        ],
    ],

    'closing' => 'Enjoy a seamless and transparent car rental experience with GoMauris!',
];
