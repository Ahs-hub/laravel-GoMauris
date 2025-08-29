<?php
// resources/lang/fr/rental.php

return [

    'title' => 'Conditions de location',

    'insurance' => [
        'title' => '1. Assurance tous risques',
        'intro' => 'Chez GoMauris, votre tranquillité d’esprit est notre priorité. Notre assurance tous risques — incluant une garantie dommages collision (CDW) — vous offre une protection complète au-delà des simples accidents. Lorsque vous réservez directement sur notre site, vous bénéficiez d’une couverture complète sans avoir besoin de souscrire à des polices supplémentaires.',
        'includes_title' => 'Nos locations incluent :',
        'includes' => [
            'accident' => 'Couverture accident : protection même en cas de responsabilité, à condition de remplir sur place un constat amiable (formulaire d’accident)',
            'theft' => 'Protection vol : couverture en cas de vol du véhicule (hors effets personnels)',
            'fire' => 'Incendie, catastrophes naturelles et vandalisme : protection en cas d’incendie, d’inondations, ou de vandalisme',
            'damage' => 'Dommages supplémentaires : grêle, branches tombées, pare-brise fissuré, panne mécanique majeure',
        ],
        'excludes_title' => 'Non couvert :',
        'excludes' => [
            'alcohol' => 'Conduite sous l’influence d’alcool ou de drogues',
            'reckless' => 'Conduite imprudente / illégale / hors route',
            'racing' => 'Courses ou utilisation non autorisée',
            'license' => 'Conduite sans permis valide',
            'personal' => 'Objets personnels laissés dans le véhicule',
            'reporting' => 'Absence de déclaration à notre bureau dans les 24h suivant l’accident',
        ],
        'note' => '** Toute violation de ces conditions vous rend entièrement responsable des frais de réparation du véhicule.',
    ],

    'excess' => [
        'title' => '2. Franchise d’assurance – Sans dépôt',
        'text' => [
            'no_deposit' => 'Aucun dépôt n’est bloqué sur votre carte. Vous ne payez une franchise que si vous êtes reconnu responsable. Le montant de la franchise est indiqué sur la page du véhicule, le devis et le contrat.',
            'refund' => 'En cas de responsabilité, paiement sous 48h. Si vous n’êtes pas en tort (confirmé par la police/l’assureur), le montant est remboursé. Les remboursements prennent 7 à 14 jours après confirmation.',
        ],
    ],

    'mdfd' => [
        'title' => '3. Dépôt de garantie remboursable (dommages mineurs & amendes)',
        'items' => [
            'amount' => 'Rs6 000 – Rs15 000 selon le type de véhicule',
            'coverage' => 'Couvre les petits dommages et les amendes de circulation',
            'refund' => 'Entièrement remboursé sous 14 à 21 jours si aucune amende/dommage',
            'tourists' => 'Les touristes doivent payer en ligne avant la livraison (lien dans l’email de réservation)',
        ],
    ],

    'delivery' => [
        'title' => '4. Lieux de livraison',
        'items' => [
            'airport' => 'Aéroport : rendez-vous au Paul Coffee Shop dans le hall d’arrivée',
            'hotels' => 'Hôtels : livraison à la réception',
            'id' => 'Pièce d’identité et permis de conduire originaux obligatoires pour toute livraison',
        ],
    ],

    'requirements' => [
        'title' => '5. Conditions de location',
        'items' => [
            'license' => 'Permis local ou international valide',
            'age' => 'Âge requis : 21 à 75 ans',
            'age_fee' => 'Âge 18–20 ans : supplément de Rs300/jour',
            'model' => 'Les modèles de voitures sont donnés à titre d’exemple — un véhicule similaire peut être fourni',
            'inspection' => 'Inspectez le véhicule et prenez des photos lors de la livraison',
            'staff' => 'Rencontrez uniquement le personnel GoMauris en uniforme',
        ],
    ],

    'return' => [
        'title' => '6. Conditions de retour du véhicule',
        'items' => [
            'airport' => 'Retour à la zone départ de l’aéroport',
            'no_refund' => 'Aucun remboursement pour un retour anticipé',
            'late' => 'Retard : des frais s’appliquent après 3 heures',
            'fuel' => 'Carburant : restituez avec le même niveau ou payez Rs400/barre',
            'lost' => 'Objets perdus : expédition à vos frais',
        ],
    ],

    'amendments' => [
        'title' => '7. Modifications de réservation',
        'items' => [
            'extensions' => 'Envoyez un email au moins 48h avant pour prolonger la location',
            'alternative' => 'Si le véhicule n’est pas disponible, un modèle similaire/équivalent sera fourni',
            'refund' => 'Si cela n’est pas possible, remboursement intégral',
        ],
    ],

    'payment' => [
        'title' => '8. Tarifs & conditions de paiement',
        'items' => [
            'period' => 'Tarifs calculés par tranche de 24 heures',
            'minimum' => 'Durée minimale de location : 4 jours',
            'split' => '50% à la réservation, 50% à la livraison',
            'full' => 'Option de paiement total disponible en ligne',
            'separate' => 'Liens de paiement séparés pour la location & le dépôt MDFD',
        ],
    ],

    'accident' => [
        'title' => '9. En cas d’accident',
        'items' => [
            'emergency' => 'Appelez les services d’urgence si nécessaire (114 pour médical, 999 pour police)',
            'photos' => 'Prenez des photos/vidéos de la scène',
            'hotline' => 'Contactez notre hotline pour assistance',
            'form' => 'Remplissez le formulaire d’accident (dans la boîte à gants)',
            'exchange' => 'Échangez vos informations avec l’autre conducteur, signez le constat et transmettez-le nous',
            'replacement' => 'Nous enverrons une dépanneuse et un véhicule de remplacement si la voiture est immobilisée',
            'email' => 'Envoyez une copie du constat à gomauristours@gmail.com dans les 24h',
        ],
    ],

    'maintenance' => [
        'title' => '10. Entretien du véhicule',
        'items' => [
            'check' => 'Vérifiez régulièrement huile, eau, pression des pneus',
            'long_term' => 'Locations longue durée : vidange tous les 5 000–10 000 km',
            'replacement' => 'Véhicule de remplacement fourni pendant l’entretien',
        ],
    ],

    'mechanical' => [
        'title' => '11. Problèmes mécaniques',
        'items' => [
            'report' => 'Signalez immédiatement tout problème afin d’éviter des dommages supplémentaires',
            'void' => 'Le défaut de signalement peut annuler le remboursement du dépôt MDFD',
        ],
    ],

    'assistance' => [
        'title' => '12. Frais d’assistance',
        'items' => [
            'tyres' => 'Pneus : réparation/remplacement pris en charge. Frais de transport de 35 € si nous venons sur place',
            'keys' => 'Clés : frais de remplacement + 35 € de livraison (gratuit si retrait au bureau)',
            'battery' => 'Batterie : recharge = 35 € si nous venons à vous. Gratuit si vous venez à notre bureau',
        ],
    ],

    'cancellation' => [
        'title' => '13. Politique d’annulation / remboursement',
        'items' => [
            'standard' => 'Standard : remboursement intégral si annulation 72h+ avant la livraison',
            'events' => 'Événements imprévus : remboursement intégral moins 15 € de frais',
            'late' => 'Annulations tardives : remboursement de 50% moins 15 € de frais',
            'processing' => 'Délai de traitement : 7 à 14 jours',
            'mdfd' => 'MDFD : toujours remboursé à 100%',
        ],
    ],

    'closing' => 'Profitez d’une expérience de location transparente et sans souci avec TRAVELHUB !',
];
