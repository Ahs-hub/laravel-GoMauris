<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tour;
use App\Models\TourCategory;

class TourSeeder extends Seeder
{
    public function run(): void
    {
        $seaActivities = TourCategory::where('slug', 'sea-activities')->first();
        $sightseeing = TourCategory::where('slug', 'sightseeing')->first();
        $naturePark = TourCategory::where('slug', 'nature-park')->first();

        //Catamaran Cruise To the Northern Isles
        Tour::create([
            'name' => 'Catamaran Cruise To the Northern Isles',
            'name_fr' => 'Croisière en catamaran vers les îles du Nord',
            'name_es' => 'Crucero en catamarán a las Islas del Norte',

            'full_title_en' => 'Full Day Catamaran Cruise To the Northern Isles',
            'full_title_fr' => 'Croisière en catamaran d\'une journée vers les îles du Nord',
            'full_title_es' => 'Crucero de un día en catamarán a las Islas del Norte',

            'slug' => 'catamaran-cruise-northern-isles',
            'description_en' => 'Enjoy a full-day catamaran cruise from Grand Baie to the idyllic northern islets of Mauritius. Swim and snorkel in turquoise lagoons around Gabriel, Flat, and Coin de Mire, 
                              then unwind with a freshly grilled BBQ lunch at sea.',
            'description_fr' => 'Profitez d\'une croisière en catamaran d\'une journée complète au départ de Grand Baie vers les îlots idylliques du nord de Maurice. Nagez et faites du snorkeling dans les lagons turquoise autour de Gabriel, Flat et Coin de Mire, puis détendez-vous avec un barbecue fraîchement grillé servi en mer.',

            'description_es' => 'Disfruta de un crucero en catamarán de un día completo desde Grand Baie hacia los idílicos islotes del norte de Mauricio. Nada y haz esnórquel en las lagunas turquesas alrededor de Gabriel, Flat y Coin de Mire, y luego relájate con un almuerzo de barbacoa recién preparado en el mar.',
                              
                              
            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 70.00,
            'average_rating' => 4.8,
            'total_reviews' => 700,
            'tour_category_id' => $seaActivities->id,
            'main_image' => 'images/tours/catamaran-cruise-northern-isles/catamaran-cruise-northern-isles-1.jpg',
        ]);

        //Ile aux Cerfs Catamaran Trip
        Tour::create([
            'name' => 'Ile aux Cerfs Catamaran Trip',
            'name_en' => 'Ile aux Cerfs Catamaran Trip',
            'name_fr' => 'Excursion en catamaran à l\'Île aux Cerfs',
            'name_es' => 'Excursión en catamarán a Île aux Cerfs',

            'full_title_en' => 'Ile aux Cerfs Catamaran Trip w/Lunch BBQ / Drinks ',
            'full_title_fr' => 'Excursion en catamaran à l\'Île aux Cerfs avec déjeuner BBQ et boissons',
            'full_title_es' => 'Excursión en catamarán a Île aux Cerfs con almuerzo BBQ y bebidas',

            'slug' => 'ile-aux-cerfs-catamaran-trip',
            'description_en' => 'Cruise the tranquil lagoons of Mauritius aboard a spacious catamaran as you soak in breathtaking mountain views.
                               Set sail for the stunning Ile aux Cerfs Island and enjoy a freshly prepared 3-course lunch served on board.',

            'description_fr' => 'Naviguez sur les lagons paisibles de l\'île Maurice à bord d\'un spacieux catamaran tout en admirant des vues imprenables sur les montagnes. Mettez le cap sur la magnifique Île aux Cerfs et savourez un déjeuner de trois plats fraîchement préparé et servi à bord.',

            'description_es' => 'Navega por las tranquilas lagunas de Mauricio a bordo de un espacioso catamarán mientras disfrutas de impresionantes vistas de las montañas. Pon rumbo a la impresionante isla Île aux Cerfs y disfruta de un almuerzo de 3 platos recién preparado y servido a bordo.',
                               
                               
            'duration_minutes' => 480,
            'pickup_available' => true,
            'starting_price' => 55.00,
            'transfer_price' => 90.00,
            'average_rating' => 4.8,
            'total_reviews' => 700,
            'tour_category_id' => $seaActivities->id,
            'main_image' => 'images/tours/ile-aux-cerfs-catamaran-trip/ile-aux-cerfs-catamaran-trip-1.jpg',
        ]);

        //Ile aux Benitiers
        Tour::create([
            'name' => 'Ile aux Benitiers',

            'name_en' => 'Ile aux Benitiers',
            'name_fr' => 'Île aux Bénitiers',
            'name_es' => 'Isla de Benitiers',

            'full_title_en' => 'Ile aux Benitiers: Snorkelling w/Dolphins Boat Tour And Lunch',
            'full_title_fr' => 'Île aux Bénitiers : Snorkeling et excursion en bateau avec dauphins + déjeuner',
            'full_title_es' => 'Isla de Benitiers: Snorkel con delfines y tour en barco + almuerzo',

            'slug' => 'catamaran-cruise-benitiers-island',

            'description_en' => 'Discover the beauty of Île aux Bénitiers on a full-day marine adventure.
                              Snorkel with dolphins in the open sea, admire the natural wonder of Crystal Rock,
                              and enjoy a 3-course BBQ lunch before relaxing on the island’s pristine shores.',
            'description_fr' => 'Découvrez la beauté de l\'Île aux Bénitiers lors d\'une aventure marine d\'une journée complète. Faites du snorkeling avec les dauphins en pleine mer, admirez la merveille naturelle de Crystal Rock et profitez d\'un déjeuner BBQ de 3 plats avant de vous détendre sur les plages immaculées de l\'île.',
            'description_es' => 'Descubre la belleza de la Isla de Benitiers en una aventura marina de día completo. Haz snorkel con delfines en mar abierto, admira la maravilla natural de Crystal Rock y disfruta de un almuerzo BBQ de 3 platos antes de relajarte en las playas vírgenes de la isla.',
            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 85.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $seaActivities->id,
            'main_image' => 'images/tours/catamaran-cruise-benitiers-island/catamaran-cruise-benitiers-island-1.jpg',
        ]);

        //East Coast Activities
        Tour::create([
            'name' => 'East Coast Activities',
            'name_en' => 'East Coast Activities',
            'name_fr' => 'Activités de la côte Est',
            'name_es' => 'Actividades de la costa este',

            'full_title_en' => 'East Coast Mauritius Private Scenic Seaplane Tour- Seaplane',
            'full_title_fr' => 'Tour privé en hydravion panoramique de la côte Est de Maurice',
            'full_title_es' => 'Tour privado en hidroavión panorámico por la costa este de Mauricio',

            'slug' => 'east-coast-activity',

            'description_en' => 'Lift off from the crystal-clear waters of Azuri Beachfront and take in breathtaking panoramic views of the turquoise lagoon and surrounding eastern islets — a truly unforgettable',
            'description_fr' => 'Décollage depuis les eaux cristallines de la plage d\'Azuri et profitez de vues panoramiques à couper le souffle sur le lagon turquoise et les îlots de l\'est environnants — une expérience vraiment inoubliable.',
            'description_es' => 'Despegue desde las aguas cristalinas de la playa Azuri y disfrute de impresionantes vistas panorámicas de la laguna turquesa y los islotes del este circundantes — una experiencia realmente inolvidable.',



            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 207.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $seaActivities->id,
            'main_image' => 'images/tours/east-coast-activity/east-coast-activity-1.jpg',
            'number_of_pictures' => 5,
        ]);

        //Five Islands Speedboat Activity
        Tour::create([
            'name' => 'Five Islands Speedboat Activity',
            'name_en' => 'Five Islands Speedboat Activity',
            'name_fr' => 'Activité en bateau rapide aux Cinq Îles',
            'name_es' => 'Actividad en lancha rápida Cinco Islas',

            'full_title_en' => 'Five Islands Speedboat w/snorkeling sea turtles + lunch & Drinks',
            'full_title_fr' => 'Bateau rapide Cinq Îles avec snorkeling des tortues + déjeuner & boissons',
            'full_title_es' => 'Lancha rápida Cinco Islas con snorkel y tortugas + almuerzo y bebidas',

            'slug' => 'five-islands-speedboat-activity',
            'description_en' => 'Discover Mauritius’ most iconic islands and hidden waterfalls in VIP style aboard our comfortable speedboat.
                              Groups of 4 or more can enjoy a private tour for an even more exclusive experience.',
            'description_fr' => 'Découvrez les îles les plus emblématiques et les cascades cachées de Maurice en style VIP à bord de notre confortable bateau rapide. Les groupes de 4 personnes ou plus peuvent profiter d\'une visite privée pour une expérience encore plus exclusive.',
            'description_es' => 'Descubre las islas más emblemáticas y las cascadas ocultas de Mauricio con estilo VIP a bordo de nuestra cómoda lancha rápida. Los grupos de 4 o más personas pueden disfrutar de un tour privado para una experiencia aún más exclusiva.',

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 136.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $seaActivities->id,
            'main_image' => 'images/tours/five-islands-speedboat-activity/five-islands-speedboat-activity-1.jpg',
        ]);

        //Belle Mare Activity
        Tour::create([
            'name' => 'Belle Mare Activity',
            'name_en' => 'Belle Mare Activity',
            'name_fr' => 'Activité Belle Mare',
            'name_es' => 'Actividad Belle Mare',

            'full_title_en' => 'Belle Mare Water Sports , Undersea Walk, Parasailing , Tude Ride',
            'full_title_fr' => 'Sports nautiques de Belle Mare, promenade sous-marine, parachute ascensionnel, balade en bouée',
            'full_title_es' => 'Deportes acuáticos Belle Mare, paseo submarino, parasailing, paseo en tubo',

            'slug' => 'belle-mare-activity',
            'description_en' => 'Dive into adventure at Belle Mare Beach with an exciting selection of lagoon watersports! Try parasailing, tube rides, 
                              and the unforgettable undersea walk — or enjoy them all with our action-packed combo package.',
            'description_fr' => 'Plongez dans l\'aventure à la plage de Belle Mare avec une sélection passionnante de sports nautiques dans le lagon ! Essayez le parachute ascensionnel, les balades en bouée et la promenade sous-marine inoubliable — ou profitez de tout avec notre forfait combo plein d\'action.',
            'description_es' => 'Sumérgete en la aventura en la playa Belle Mare con una emocionante selección de deportes acuáticos en la laguna. Prueba el parasailing, los paseos en tubo y la inolvidable caminata submarina — o disfruta de todo con nuestro paquete combinado lleno de acción.',

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 55.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $seaActivities->id,
            'main_image' => 'images/tours/belle-mare-activity/belle-mare-activity-1.jpg',
            'number_of_pictures' => 2,
        ]);

        //Blue Bay GlassBottom & Snorkelling
        Tour::create([
            'name' => 'Blue Bay GlassBottom & Snorkelling',
            'name_en' => 'Blue Bay GlassBottom & Snorkelling',
            'name_fr' => 'Blue Bay Bateau à fond de verre & Snorkeling',
            'name_es' => 'Blue Bay Fondo de Cristal y Snorkel',

            'full_title_en' => 'Blue Bay GlassBottom Boat Visit &Snorkelling',
            'full_title_fr' => 'Visite en bateau à fond de verre & snorkeling à Blue Bay',
            'full_title_es' => 'Visita en barco de fondo de cristal y snorkel en Blue Bay',

            'slug' => 'bluebay-boat-visit-snorkelling',

            'description_en' => 'Explore the crystal-clear waters of Blue Bay Marine Park on a glass bottom boat tour and snorkeling adventure. Discover vibrant coral reefs and exotic marine life in one of Mauritius most stunning underwater ecosystems.',
            'description_fr' => 'Explorez les eaux cristallines du parc marin de Blue Bay lors d\'une excursion en bateau à fond de verre et d\'une aventure de snorkeling. Découvrez des récifs coralliens vibrants et une vie marine exotique dans l\'un des écosystèmes sous-marins les plus magnifiques de Maurice.',
            'description_es' => 'Explora las aguas cristalinas del Parque Marino Blue Bay en un tour en barco de fondo de cristal y aventura de snorkel. Descubre coloridos arrecifes de coral y vida marina exótica en uno de los ecosistemas submarinos más impresionantes de Mauricio.',

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 24.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $seaActivities->id,
            'main_image' => 'images/tours/bluebay-boat-visit-snorkelling/bluebay-boat-visit-snorkelling-1.jpg',
        ]);

        //East Belle Mare Scuba Diving Tour
        Tour::create([
            'name' => 'East Belle Mare Scuba Diving Tour',
            'name_en' => 'East Belle Mare Scuba Diving Tour',
            'name_fr' => 'Plongée sous-marine Belle Mare Est',
            'name_es' => 'Tour de buceo Belle Mare Este',

            'full_title_en' => 'East Belle Mare Scuba Diving Tour ',
            'full_title_fr' => 'Tour de plongée sous-marine Belle Mare Est',
            'full_title_es' => 'Tour de buceo Belle Mare Este',

            'slug' => 'east-belle-mare-scuba-diving',

            'description_en' => 'Dive into an unforgettable underwater adventure from Belle Mare. Learn the basics with a certified team and explore the vibrant coral reefs and marine life that make Mauritius a world-class diving destination.',
            'description_fr' => 'Plongez dans une aventure sous-marine inoubliable depuis Belle Mare. Apprenez les bases avec une équipe certifiée et explorez les récifs coralliens et la vie marine vibrante qui font de Maurice une destination de plongée de classe mondiale.',
            'description_es' => 'Sumérgete en una aventura submarina inolvidable desde Belle Mare. Aprende lo básico con un equipo certificado y explora los vibrantes arrecifes de coral y la vida marina que hacen de Mauricio un destino de buceo de clase mundial.',

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 135.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $seaActivities->id,
            'main_image' => 'images/tours/east-belle-mare-scuba-diving/east-belle-mare-scuba-diving-1.jpg',
        ]);

        //Abseiling And Canoying
        Tour::create([
            'name' => 'Abseiling And Canoying',
            'name_en' => 'Abseiling And Canoying',
            'name_fr' => 'Descente en rappel et canyoning',
            'name_es' => 'Rappel y Cañoning',

            'full_title_en' => 'Abseiling/Canoying 3Hours (small group limited to 6)',
            'full_title_fr' => 'Descente en rappel/Canyoning 3 heures (groupe limité à 6)',
            'full_title_es' => 'Rappel/Cañoning 3 horas (grupo reducido a 6)',

            'slug' => 'abseiling-canoying',

            'description_en' => 'Experience the wild beauty of Tamarind Falls on a 3-hour canyoning and abseiling adventure. With expert guides and all safety gear provided, descend the cascading falls, take in incredible views, and challenge yourself with optional cliff jumps.',
            'description_fr' => 'Vivez la beauté sauvage des Chutes de Tamarin lors d\'une aventure de 3 heures en canyoning et descente en rappel. Avec des guides experts et tout l\'équipement de sécurité fourni, descendez les cascades, profitez de vues incroyables et relevez le défi des sauts facultatifs depuis les falaises.',
            'description_es' => 'Experimenta la belleza salvaje de las Cataratas Tamarind en una aventura de 3 horas de cañoning y rappel. Con guías expertos y todo el equipo de seguridad proporcionado, desciende por las cascadas, disfruta de vistas increíbles y desafíate con saltos opcionales desde los acantilados.',

            'duration_minutes' => 180,
            'pickup_available' => false,
            'starting_price' => 99.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $seaActivities->id,
            'main_image' => 'images/tours/abseiling-canoying/abseiling-canoying-1.jpg',
            'number_of_pictures' => 5,
        ]);

        //Snorkel and Swim with Dolphins
        Tour::create([
            'name' => 'Snorkel and Swim with Dolphins',
            'name_en' => 'Snorkel and Swim with Dolphins',
            'name_fr' => 'Snorkeling et baignade avec les dauphins',
            'name_es' => 'Snorkel y nado con delfines',

            'full_title_en' => 'Snorkel and Swim with Dolphins on Speedboat Tour',
            'full_title_fr' => 'Snorkeling et baignade avec les dauphins en bateau rapide',
            'full_title_es' => 'Snorkel y nado con delfines en lancha rápida',

            'slug' => 'snorkel-with-dolphins-speedboat',

            'description_en' => 'Set off from Tamarin Beach on a thrilling speedboat ride and swim alongside wild dolphins in their natural habitat. Snorkeling gear is included, so you can dive in and discover the vibrant underwater world.',
            'description_fr' => 'Partez de la plage de Tamarin pour une excitante balade en bateau rapide et nagez aux côtés de dauphins sauvages dans leur habitat naturel. Le matériel de snorkeling est inclus pour plonger et découvrir le monde sous-marin vibrant.',
            'description_es' => 'Sal de la playa de Tamarin en una emocionante lancha rápida y nada junto a delfines salvajes en su hábitat natural. El equipo de snorkel está incluido para que puedas bucear y descubrir el vibrante mundo submarino.',

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 48.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $seaActivities->id,
            'main_image' => 'images/tours/snorkel-with-dolphins-speedboat/snorkel-with-dolphins-speedboat-1.jpg',
        ]);

        //Gorges & Spiritual Lake
        Tour::create([
            'name' => 'Gorges & Spiritual Lake',
            'name_en' => 'Gorges & Spiritual Lake',
            'name_fr' => 'Gorges et lac sacré',
            'name_es' => 'Gargantas y lago espiritual',

            'full_title_en' => 'Gorges , Spiritual Lake, Waterfalls & 23 colored Earth',
            'full_title_fr' => 'Gorges, lac sacré, cascades et Terre aux 23 couleurs',
            'full_title_es' => 'Gargantas, lago espiritual, cascadas y Tierra de 23 colores',

            'slug' => 'gorges-spiritual-lake',

            'description_en' => 'Spend the day uncovering the lush landscapes of Mauritius on a private guided tour. Visit Grand Bassin, the Black River Gorges, and Alexandra Falls.',
            'description_fr' => 'Passez la journée à découvrir les paysages luxuriants de Maurice lors d\'une visite guidée privée. Visitez le Grand Bassin, les Gorges de la Rivière Noire et les Chutes Alexandra.',
            'description_es' => 'Pasa el día descubriendo los exuberantes paisajes de Mauricio en un tour guiado privado. Visita Grand Bassin, las Gargantas del Río Negro y las Cataratas Alexandra.',

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 111.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $sightseeing->id,
            'main_image' => 'images/tours/gorges-spiritual-lake/gorges-spiritual-lake-1.jpg',
            'is_group_priced' => true,
            'group_price'=> 111.00,
            'group_size' => 4,
        ]);

        //Gorges & Spiritual Lake
        Tour::create([
            'name' => 'Tamarind Fall GuidedHike',
            'name_en' => 'Tamarind Fall GuidedHike',
            'name_fr' => 'Randonnée guidée aux Chutes de Tamarin',
            'name_es' => 'Caminata guiada Cataratas Tamarind',

            'full_title_en' => 'Tamarind Fall GuidedHike with Swim & Lunch',
            'full_title_fr' => 'Randonnée guidée aux Chutes de Tamarin avec baignade et déjeuner',
            'full_title_es' => 'Caminata guiada Cataratas Tamarind con baño y almuerzo',

            'slug' => 'tamarind-fall-guidedhike',

            'description_en' => 'Trek through the forested trails of Tamarind Falls and uncover one of Mauritius’ most beautiful natural wonders. Enjoy waterfall swims, peaceful surroundings, and a picnic lunch in the heart of the island.',
            'description_fr' => 'Parcourez les sentiers forestiers des Chutes de Tamarin et découvrez l\'une des plus belles merveilles naturelles de Maurice. Profitez de baignades dans les cascades, d\'un cadre paisible et d\'un déjeuner pique-nique au cœur de l\'île.',
            'description_es' => 'Recorre los senderos boscosos de las Cataratas Tamarind y descubre una de las maravillas naturales más bellas de Mauricio. Disfruta de baños en cascadas, un entorno tranquilo y un almuerzo picnic en el corazón de la isla.',

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 74.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $sightseeing->id,
            'main_image' => 'images/tours/tamarind-fall-guidedhike/tamarind-fall-guidedhike-1.jpg',
        ]);

        //Full day Tour of The North
        Tour::create([
            'name' => 'Full day Tour of The North',
            'name_en' => 'Full day Tour of The North',
            'name_fr' => 'Tour complet du Nord',
            'name_es' => 'Tour completo del Norte',

            'full_title_en' => 'Full day Tour of The North with Hotel Transfer',
            'full_title_fr' => 'Tour complet du Nord avec transfert hôtel',
            'full_title_es' => 'Tour completo del Norte con traslado al hotel',

            'slug' => 'full-day-the-north-hotel-transfer',

            'description_en' => 'Discover the cultural highlights of northern Mauritius on a private day trip. With hotel transfers included, visit the famous Red Roof Church, the serene Botanical Garden, a local Tea Factory, and the lively Port-Louis markets before ending at historic Fort Adelaide.',
            'description_fr' => 'Découvrez les points forts culturels du nord de Maurice lors d\'une excursion privée d\'une journée. Avec les transferts hôteliers inclus, visitez la célèbre église au toit rouge, le paisible jardin botanique, une usine de thé locale et les marchés animés de Port-Louis avant de terminer au fort historique d\'Adélaïde.',
            'description_es' => 'Descubre los puntos culturales destacados del norte de Mauricio en un tour privado de un día. Con traslados desde el hotel incluidos, visita la famosa Iglesia de Techo Rojo, el sereno Jardín Botánico, una fábrica de té local y los animados mercados de Port-Louis antes de finalizar en el histórico Fuerte Adelaide.',


            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 93.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $sightseeing->id,
            'main_image' => 'images/tours/full-day-the-north-hotel-transfer/full-day-the-north-hotel-transfer-1.jpg',
            'number_of_pictures' => 5,
            'is_group_priced' => true,
            'group_price'=> 93.00,
            'group_size' => 4,
        ]);

        //Private Island Tour
        Tour::create([
            'name' => 'Private Island Tour',
            'name_en' => 'Private Island Tour',
            'name_fr' => 'Tour privé d\'île',
            'name_es' => 'Tour privado de isla',

            'full_title_en' => 'Private Island Tour with Chauffeur/Guide ',
            'full_title_fr' => 'Tour privé d\'île avec chauffeur/guide',
            'full_title_es' => 'Tour privado de isla con chófer/guía',

            'slug' => 'private-tour-with-chauffeurguide',

            'description_en' => 'Discover Mauritius your way with a full-day personal driver-guide. Choose the destinations you’d like to see, travel in comfort, and select between a luxury car or a standard option to suit your style and budget.<br><br>€110 per group (standard car)<br>€115 per group (luxury car)',
            'description_fr' => 'Découvrez Maurice à votre façon avec un chauffeur-guide personnel pour la journée. Choisissez les destinations que vous souhaitez visiter, voyagez confortablement et choisissez entre une voiture de luxe ou standard selon votre style et votre budget.<br><br>110 € par groupe (voiture standard)<br>115 € par groupe (voiture de luxe)',
            'description_es' => 'Descubre Mauricio a tu manera con un guía/conductor personal durante todo el día. Elige los destinos que deseas ver, viaja con comodidad y selecciona entre un coche de lujo o estándar según tu estilo y presupuesto.<br><br>110 € por grupo (coche estándar)<br>115 € por grupo (coche de lujo)',

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 110.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $sightseeing->id,
            'main_image' => 'images/tours/private-tour-with-chauffeurguide/private-tour-with-chauffeurguide-1.jpg',
            'number_of_pictures' => 4,
            'is_group_priced' => true,
            'group_price'=> 110.00,
            'group_size' => 3,
        ]);

        //Photoshoot at Mont Choisy Beach
        Tour::create([
            'name' => 'Photoshoot at Mont Choisy Beach',
            'name_en' => 'Photoshoot at Mont Choisy Beach',
            'name_fr' => 'Séance photo à Mont Choisy Beach',
            'name_es' => 'Sesión de fotos en Mont Choisy Beach',

            'full_title_en' => 'Photoshoot at Mont Choisy Beach',
            'full_title_fr' => 'Séance photo à Mont Choisy Beach',
            'full_title_es' => 'Sesión de fotos en Mont Choisy Beach',

            'slug' => 'photoshoot-mont-choisy-beach',

            'description_en' => 'Turn your Mauritius holiday into a timeless memory with a stunning sunset photoshoot. Whether you are celebrating your honeymoon or enjoying a family getaway, capture the magic of golden hour in paradise.',
            'description_fr' => 'Transformez vos vacances à Maurice en un souvenir intemporel grâce à une superbe séance photo au coucher du soleil. Que vous célébriez votre lune de miel ou passiez des moments en famille, capturez la magie de l’heure dorée au paradis.',
            'description_es' => 'Convierte tus vacaciones en Mauricio en un recuerdo eterno con una impresionante sesión de fotos al atardecer. Ya sea que celebres tu luna de miel o disfrutes de unas vacaciones familiares, captura la magia de la hora dorada en el paraíso.',

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 85.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $sightseeing->id,
            'main_image' => 'images/tours/photoshoot-mont-choisy-beach/photoshoot-mont-choisy-beach-1.jpg',
            'number_of_pictures' => 4,
        ]);

        //Horse riding
        Tour::create([
            'name' => 'Horse Riding',
            'name_en' => 'Horse Riding',
            'name_fr' => 'Équitation',
            'name_es' => 'Equitación',

            'full_title_en' => 'Horse Riding',
            'full_title_fr' => 'Équitation',
            'full_title_es' => 'Equitación',

            'slug' => 'horse-riding',

            'description_en' => '<ul>
            <li><strong>Lavilleon Adventure Park</strong> – A 30-minute ride through the scenic southwest. <em>Only €19 per person</em></li>
            <li><strong>Balaclava Equestrian Centre</strong> – Saddle up for a peaceful countryside ride. <em>€60 per person</em></li>
            <li><strong>Belle Mare Beach</strong> – Experience the beauty of horseback riding along the shoreline. <em>€75 per person</em></li>
            <li><strong>Romantic Sunset Ride (South Coast)</strong> – A magical beach ride during golden hour. <em>€105 per person</em></li>
            <li><strong>Riambel Beach</strong> – 1 hour of barefoot riding on the sands. <em>€92 per person</em></li>
            <li><strong>Sunset Horseback & Catamaran Cruise</strong> – The ultimate couple’s package, including transport. <em>€450 for 2 persons</em></li>
            </ul>',
            'description_fr' => '<ul>
            <li><strong>Lavilleon Adventure Park</strong> – Balade de 30 minutes à travers le sud-ouest pittoresque. <em>Seulement 19 € par personne</em></li>
            <li><strong>Balaclava Equestrian Centre</strong> – Montez à cheval pour une promenade paisible à la campagne. <em>60 € par personne</em></li>
            <li><strong>Belle Mare Beach</strong> – Découvrez la beauté de l’équitation le long du rivage. <em>75 € par personne</em></li>
            <li><strong>Romantic Sunset Ride (South Coast)</strong> – Une balade magique sur la plage au coucher du soleil. <em>105 € par personne</em></li>
            <li><strong>Riambel Beach</strong> – 1 heure de balade pieds nus sur le sable. <em>92 € par personne</em></li>
            <li><strong>Sunset Horseback & Catamaran Cruise</strong> – Le forfait ultime pour les couples, transport inclus. <em>450 € pour 2 personnes</em></li>
            </ul>',
            'description_es' => '<ul>
            <li><strong>Lavilleon Adventure Park</strong> – Paseo de 30 minutos por el suroeste pintoresco. <em>Sólo 19 € por persona</em></li>
            <li><strong>Balaclava Equestrian Centre</strong> – Monta a caballo para un paseo tranquilo por el campo. <em>60 € por persona</em></li>
            <li><strong>Belle Mare Beach</strong> – Experimenta la belleza de montar a caballo a lo largo de la orilla. <em>75 € por persona</em></li>
            <li><strong>Romantic Sunset Ride (South Coast)</strong> – Un paseo mágico por la playa al atardecer. <em>105 € por persona</em></li>
            <li><strong>Riambel Beach</strong> – 1 hora de paseo descalzo por la arena. <em>92 € por persona</em></li>
            <li><strong>Sunset Horseback & Catamaran Cruise</strong> – El paquete definitivo para parejas, con transporte incluido. <em>450 € para 2 personas</em></li>
            </ul>',

            
            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 19.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $sightseeing->id,
            'main_image' => 'images/tours/horse-riding/horse-riding-1.jpg',
            'number_of_pictures' => 4,
        ]);

        //Caudan Waterfall,Port Louis & More
        Tour::create([
            'name' => 'Caudan Waterfall,Port Louis & More',
            'name_en' => 'Caudan Waterfall,Port Louis & More',
            'name_fr' => 'Chute Caudan, Port Louis et plus',
            'name_es' => 'Cascada Caudan, Port Louis y más',

            'full_title_en' => 'Caudan Waterfall, Blue Penny Museum, Port Louis Central Market, Pamplemousse Garden',
            'full_title_fr' => 'Chute Caudan, Musée Blue Penny, Marché central de Port Louis, Jardin de Pamplemousses',
            'full_title_es' => 'Cascada Caudan, Museo Blue Penny, Mercado Central de Port Louis, Jardín Pamplemousse',
            
            'slug' => 'caudan-waterfall-blue-penny',

            'description_en' => 'Explore Mauritius with a visit to Caudan Waterfront then dive into history at the Blue Penny Museum. Wander the lively Port Louis Central Market and end your day surrounded by exotic plants at the famous Pamplemousses Botanical Garden.',
            'description_fr' => 'Découvrez Maurice avec une visite du front de mer Caudan puis plongez dans l’histoire au Musée Blue Penny. Flânez dans le dynamique Marché central de Port Louis et terminez votre journée entouré de plantes exotiques au célèbre Jardin botanique de Pamplemousses.',
            'description_es' => 'Explora Mauricio con una visita al malecón Caudan y luego sumérgete en la historia en el Museo Blue Penny. Pasea por el animado Mercado Central de Port Louis y finaliza tu día rodeado de plantas exóticas en el famoso Jardín Botánico de Pamplemousses.',

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 100.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $sightseeing->id,
            'main_image' => 'images/tours/caudan-waterfall-blue-penny/caudan-waterfall-blue-penny-1.jpg',
            'number_of_pictures' => 4,
        ]);

        //Sights of the South Private Tour with Rum Tasting
        Tour::create([
            'name' => 'Sights of the South Private',
            'name_en' => 'Sights of the South Private',
            'name_fr' => 'Visite privée du Sud',
            'name_es' => 'Tour privado del Sur',

            'full_title_en' => 'Sights of the South Private Tour with Rum Tasting',
            'full_title_fr' => 'Visite privée du Sud avec dégustation de rhum',
            'full_title_es' => 'Tour privado del Sur con degustación de ron',

            'slug' => 'sights-south-private-tour',

            'description_en' => 'Immerse yourself in the natural beauty and rich heritage of Mauritius on a private tour. Explore the iconic Seven Coloured Earth, witness the majestic Chamarel Waterfall, visit the sacred Grand Bassin, and enjoy a guided rum tasting at Chamarel Distillery.',
            'description_fr' => 'Plongez dans la beauté naturelle et le riche patrimoine de Maurice lors d’une visite privée. Explorez les célèbres Terres des Sept Couleurs, admirez la majestueuse cascade de Chamarel, visitez le sacré Grand Bassin et profitez d’une dégustation de rhum guidée à la distillerie de Chamarel.',
            'description_es' => 'Sumérgete en la belleza natural y el rico patrimonio de Mauricio en un tour privado. Explora las icónicas Siete Tierras de Colores, contempla la majestuosa cascada de Chamarel, visita el sagrado Gran Bassin y disfruta de una cata guiada de ron en la Destilería Chamarel.',

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 100.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $sightseeing->id,
            'main_image' => 'images/tours/sights-south-private-tour/sights-south-private-tour-1.jpg',
            'number_of_pictures' => 5,
            'is_group_priced' => true,
            'group_price'=> 180.00,
            'group_size' => 5,
        ]);

        //La Vanille & Le Morne Beach
        Tour::create([
            'name' => 'La Vanille & Le Morne Beach',
            'name_en' => 'La Vanille & Le Morne Beach',
            'name_fr' => 'La Vanille & Plage de Le Morne',
            'name_es' => 'La Vanille y Playa Le Morne',

            'full_title_en' => 'Mauritius: Southern Tour w/La Vanille & Le Morne Beach',
            'full_title_fr' => 'Maurice : Circuit Sud avec La Vanille & Plage de Le Morne',
            'full_title_es' => 'Mauricio: Tour del Sur con La Vanille y Playa Le Morne',

            'slug' => 'southern-lavanille-lemorne-beach',

            'description_en' => 'Escape the crowds and uncover the natural wonders of southern Mauritius on a private journey. With convenient hotel transfers, explore Grand Bassin, discover wildlife at La Vanille Nature Park, marvel at Vallée des Couleurs, and unwind at stunning Le Morne Beach.',
            'description_fr' => 'Évadez-vous des foules et découvrez les merveilles naturelles du sud de Maurice lors d’un voyage privé. Avec des transferts pratiques depuis l’hôtel, explorez le Grand Bassin, découvrez la faune au parc naturel La Vanille, admirez la Vallée des Couleurs et détendez-vous sur la magnifique plage de Le Morne.',
            'description_es' => 'Escapa de las multitudes y descubre las maravillas naturales del sur de Mauricio en un viaje privado. Con traslados convenientes desde el hotel, explora Grand Bassin, descubre la fauna en el Parque Natural La Vanille, maravíllate con Vallée des Couleurs y relájate en la impresionante Playa Le Morne.',

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 106.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $sightseeing->id,
            'main_image' => 'images/tours/southern-lavanille-lemorne-beach/southern-lavanille-lemorne-beach-1.jpg',
            'number_of_pictures' => 5,
            'is_group_priced' => true,
            'group_price'=> 106.00,
            'group_size' => 4,
        ]);

        //Scenic South West
        Tour::create([
            'name' => 'Scenic South West',
            'name_fr' => 'Sud-Ouest pittoresque',
            'name_es' => 'Suroeste escénico',

            'full_title_en' => 'Mauritius Scenic South West Private Car/SUV/Minivan Tour',
            'full_title_fr' => 'Maurice : Circuit privé en voiture/SUV/minibus dans le Sud-Ouest pittoresque',
            'full_title_es' => 'Mauricio: Tour privado en coche/SUV/minivan por el suroeste escénico',

            'slug' => 'scenic-south-west',

            'description_en' => 'Let us take you on a journey through the scenic southwest of Mauritius in style and comfort. Travel with a friendly chauffeur-guide and enjoy the flexibility of an SUV or spacious minivan for your group',
            'description_fr' => 'Laissez-nous vous emmener à travers le sud-ouest pittoresque de Maurice avec style et confort. Voyagez avec un chauffeur-guide sympathique et profitez de la flexibilité d’un SUV ou d’un minibus spacieux pour votre groupe.',
            'description_es' => 'Déjanos llevarte a través del suroeste escénico de Mauricio con estilo y comodidad. Viaja con un guía-chófer amable y disfruta de la flexibilidad de un SUV o minivan espacioso para tu grupo.',

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 55.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $sightseeing->id,
            'main_image' => 'images/tours/scenic-south-west/scenic-south-west-1.jpg',
            'number_of_pictures' => 5,
        ]);

        //Port Louis Private Guided Tour
        Tour::create([
            'name' => 'Port Louis Private Guided Tour',
            'name_en' => 'Port Louis Private Guided Tour',
            'name_fr' => 'Visite guidée privée de Port Louis',
            'name_es' => 'Tour privado guiado de Port Louis',

            'full_title_en' => 'Port Louis: Private Guided Tour and Street Food Tasting',
            'full_title_fr' => 'Port Louis : Visite guidée privée et dégustation de street food',
            'full_title_es' => 'Port Louis: Tour privado guiado y degustación de comida callejera',

            'slug' => 'port-louis-private-guided-food',

            'description_en' => 'Spend an action-packed day exploring the heart of Port Louis. Wander through the vibrant Central Market, stroll down colorful China Town, and soak in the lively atmosphere of Caudan Waterfront. Discover the historic Citadelle Fort and AapravasiGhat, all while indulging in mouth-watering street food along the way',
            'description_fr' => 'Passez une journée pleine d’action à explorer le cœur de Port Louis. Flânez dans le dynamique Marché central, promenez-vous dans le coloré China Town et imprégnez-vous de l’ambiance animée du front de mer de Caudan. Découvrez le Fort historique de la Citadelle et l’Aapravasi Ghat tout en dégustant de délicieuses spécialités de street food.',
            'description_es' => 'Pasa un día lleno de acción explorando el corazón de Port Louis. Pasea por el vibrante Mercado Central, recorre el colorido China Town y disfruta del animado ambiente del Malecón Caudan. Descubre la histórica Fortaleza Citadelle y AapravasiGhat mientras disfrutas de deliciosa comida callejera.',

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 148.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $sightseeing->id,
            'main_image' => 'images/tours/port-louis-private-guided-food/port-louis-private-guided-food-1.jpg',
            'number_of_pictures' => 4,
        ]);

        //Private Guided Tour with Airport
        Tour::create([
            'name' => 'Private Guided Tour with Airport',
            'name_en' => 'Private Guided Tour with Airport',
            'name_fr' => 'Visite guidée privée avec transfert aéroport',
            'name_es' => 'Tour privado guiado con aeropuerto',

            'full_title_en' => 'Mauritius: Private Guided Tour with Airport & Hotel Pickup',
            'full_title_fr' => 'Maurice : Visite guidée privée avec transfert aéroport et hôtel',
            'full_title_es' => 'Mauricio: Tour privado guiado con recogida en aeropuerto y hotel',

            'slug' => 'guided-with-airport-hotel',

            'description_en' => 'Experience the true essence of Mauritius through a personalized guided journey, where the thrill of adventure blends seamlessly with serene moments of tranquility. Surrender to the island’s vibrant energy, and immerse yourself in every unforgettable moment',
            'description_fr' => 'Découvrez l’essence véritable de Maurice à travers une visite guidée personnalisée, où l’excitation de l’aventure se mêle à des moments de tranquillité. Laissez-vous emporter par l’énergie vibrante de l’île et vivez chaque instant inoubliable.',
            'description_es' => 'Experimenta la verdadera esencia de Mauricio a través de un recorrido guiado personalizado, donde la emoción de la aventura se combina con momentos de tranquilidad. Sumérgete en la vibrante energía de la isla y disfruta de cada momento inolvidable.',
           
            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 99.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $sightseeing->id,
            'main_image' => 'images/tours/guided-with-airport-hotel/guided-with-airport-hotel-1.jpg',
            'number_of_pictures' => 4,
            'is_group_priced' => true,
            'group_price'=> 99.00,
            'group_size' => 4,
        ]);

        //Nature
        //Casela Nature parks & Flic enFlac Beach
        Tour::create([
            'name' => 'Casela Nature parks & Flic enFlac Beach',
            'name_en' => 'Casela Nature parks & Flic enFlac Beach',
            'name_fr' => 'Parcs naturels Casela & Plage de Flic en Flac',
            'name_es' => 'Parques Naturales Casela & Playa de Flic en Flac',

            'full_title_en' => 'Casela Nature parks & Flic enFlac Beach',
            'full_title_fr' => 'Parcs naturels Casela & Plage de Flic en Flac',
            'full_title_es' => 'Parques Naturales Casela & Playa de Flic en Flac',

            'slug' => 'casela-nature-flicenflac-beach',

            'description_en' => 'Experience the wild side of Mauritius at Casela Nature Park, where thrilling activities and exotic animals await, then relax on the golden shores of Flic enFlac Beach, known for its crystal-clear lagoon and peaceful atmosphere.',
            'description_fr' => 'Découvrez le côté sauvage de l’île Maurice au parc naturel Casela, où vous attendent des activités palpitantes et des animaux exotiques, puis détendez-vous sur les rives dorées de la plage de Flic en Flac, connue pour son lagon cristallin et son ambiance paisible.',
            'description_es' => 'Experimenta el lado salvaje de Mauricio en el Parque Natural Casela, donde te esperan actividades emocionantes y animales exóticos, y luego relájate en las doradas playas de Flic en Flac, conocidas por su laguna cristalina y ambiente tranquilo.',
        
            
            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 110.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $naturePark->id,
            'main_image' => 'images/tours/casela-nature-flicenflac-beach/casela-nature-flicenflac-beach-1.jpg',
            'number_of_pictures' => 5,
            'is_group_priced' => true,
            'group_price'=> 110.00,
            'group_size' => 3,
        ]);

        //Valleeadvenature Park
        Tour::create([
            'name' => 'Valleeadvenature Park, Discovery Quad',
            'name_en' => 'Valleeadvenature Park, Discovery Quad',
            'name_fr' => 'Parc ValléAdvenature, Quad Découverte',
            'name_es' => 'Parque ValleAdvenature, Quad de Descubrimiento',

            'full_title_en' => 'Valleeadvenature Park, Discovery Quad Single 1Hour',
            'full_title_fr' => 'Parc ValléAdvenature, Quad Découverte 1 Heure',
            'full_title_es' => 'Parque ValleAdvenature, Quad de Descubrimiento 1 Hora',

            'slug' => 'valleeadvenature-park',

            'description_en' => 'Unleash your inner adventurer at Vallé! Conquer rugged trails and immerse yourself in the islands vibrant landscapes on a quad bike. Feel the rush, embrace the freedom, and discover Mauritius like never before!',
            'description_fr' => 'Libérez l\'aventurier qui est en vous à Vallé ! Conquérez des sentiers accidentés et immergez-vous dans les paysages vibrants de l\'île à bord d\'un quad. Ressentez l\'adrénaline, profitez de la liberté et découvrez Maurice comme jamais auparavant !',
            'description_es' => '¡Desata tu espíritu aventurero en Vallé! Conquista senderos difíciles e inmérgete en los paisajes vibrantes de la isla en un quad. Siente la emoción, disfruta de la libertad y descubre Mauricio como nunca antes.',

            'duration_minutes' => 60,
            'pickup_available' => false,
            'starting_price' => 65.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $naturePark->id,
            'main_image' => 'images/tours/valleeadvenature-park/valleeadvenature-park-1.jpg',
            'number_of_pictures' => 4,
        ]);

        //Riambel: South Tour
        Tour::create([
            'name' => 'Riambel: South Tour',
            'name_en' => 'Riambel: South Tour',
            'name_fr' => 'Riambel : Circuit Sud',
            'name_es' => 'Riambel: Tour Sur',

            'full_title_en' => 'Riambel: South Tour w/ Crocodile Park & Seven Colored Earth',
            'full_title_fr' => 'Riambel : Circuit Sud avec Parc aux Crocodiles & Terre aux Sept Couleurs',
            'full_title_es' => 'Riambel: Tour Sur con Parque de Cocodrilos y Tierra de Siete Colores',

            'slug' => 'riambel-south-tour-crocodile-colored-earth',

            'description_en' => 'Explore La Vanille Nature Park, a lush sanctuary home to crocodiles, giant tortoises, and a wide range of exotic wildlife and plants. Continue your journey to the spectacular Seven-Colored Earth, where vibrant sand dunes and a picturesque waterfall create a truly unique natural landscape.',
            'description_fr' => 'Explorez le parc naturel La Vanille, un sanctuaire luxuriant abritant des crocodiles, des tortues géantes et une grande variété de faune et flore exotiques. Continuez votre visite vers la spectaculaire Terre aux Sept Couleurs, avec ses dunes de sable colorées et sa cascade pittoresque.',
            'description_es' => 'Explora el Parque Natural La Vanille, un exuberante santuario hogar de cocodrilos, tortugas gigantes y una amplia variedad de flora y fauna exótica. Continúa tu viaje hacia la espectacular Tierra de Siete Colores, con dunas vibrantes y una cascada pintoresca.',

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 110.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $naturePark->id,
            'main_image' => 'images/tours/riambel-south-tour-crocodile-colored-earth/riambel-south-tour-crocodile-colored-earth-1.jpg',
            'number_of_pictures' => 5,
        ]);

        //South Mauritius: Buggy Tour
        Tour::create([
            'name' => 'South Mauritius: Buggy Tour',
            'name_en' => 'South Mauritius: Buggy Tour',
            'name_fr' => 'Sud Maurice : Tour en Buggy',
            'name_es' => 'Sur de Mauricio: Tour en Buggy',


            'full_title_en' => 'South Mauritius: Buggy Tour',
            'full_title_fr' => 'Sud Maurice : Tour en Buggy',
            'full_title_es' => 'Sur de Mauricio: Tour en Buggy',

            'slug' => 'south-mauritius-buggy-tour',

            'description_en' => 'Explore the stunning South of Mauritius with visits to the natural marvel of the Natural Bridge, the powerful Souffleur blowhole, the lush Royal Palm Forest, and the serene BassinCamaron Beach.',
            'description_fr' => 'Explorez le magnifique sud de l\'île Maurice avec des visites de merveilles naturelles comme le Pont Naturel, le puissant Souffleur, la luxuriante forêt de palmiers royaux et la paisible plage de Bassin Camaron.',
            'description_es' => 'Explora el impresionante sur de Mauricio con visitas a maravillas naturales como el Puente Natural, el potente Souffleur, el exuberante Bosque de Palmas Reales y la tranquila Playa Bassin Camaron.',

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 225.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $naturePark->id,
            'main_image' => 'images/tours/south-mauritius-buggy-tour/south-mauritius-buggy-tour-1.jpg',
            'number_of_pictures' => 5,
            'is_group_priced' => true,
            'group_price'=> 225.00,
            'group_size' => 4,
        ]);

        //ValléAdvenature Park
        Tour::create([
            'name' => 'ValléAdvenature Park',
            'name_en' => 'ValléAdvenature Park',
            'name_fr' => 'Parc ValléAdvenature',
            'name_es' => 'Parque ValléAdvenature',

            'full_title_en' => 'ValléAdvenature Park - Adventure Tour Zipline',
            'full_title_fr' => 'Parc ValléAdvenature - Tour Aventure Tyrolienne',
            'full_title_es' => 'Parque ValléAdvenature - Tour de Aventura en Tirolina',

            'slug' => 'valléadvenature-park-tour-zipline',

            'description_en' => 'Feel the thrill of soaring through nature on Vallée Adventure Park’s 6-zipline course, gliding over lush landscapes for an unforgettable adrenaline rush!',
            'description_fr' => 'Ressentez l\'adrénaline en survolant la nature sur le parcours de 6 tyroliennes du parc Vallée Adventure, glissant au-dessus de paysages luxuriants pour une expérience inoubliable !',
            'description_es' => '¡Siente la emoción de volar sobre la naturaleza en el recorrido de 6 tirolinas del Parque Vallée Adventure, deslizándote sobre paisajes exuberantes para una experiencia inolvidable!',

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 72.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $naturePark->id,
            'main_image' => 'images/tours/valléadvenature-park-tour-zipline/valléadvenature-park-tour-zipline-1.jpg',
            'number_of_pictures' => 5,
        ]);

        //Odysseo Oceanarium
        Tour::create([
            'name' => 'Odysseo Oceanarium',
            'name_en' => 'Odysseo Oceanarium',
            'name_fr' => 'Océanarium Odysseo',
            'name_es' => 'Oceanario Odysseo',

            'full_title_en' => 'Odysseo Oceanarium: Zebra Sharks encounter and feeding',
            'full_title_fr' => 'Océanarium Odysseo : Rencontre et nourrissage des requins zèbres',
            'full_title_es' => 'Oceanario Odysseo: Encuentro y alimentación de tiburones cebra',

            'slug' => 'odysseo-oceanarium',

            'description_en' => 'Feel the thrill of soaring through nature on Vallée Adventure Park’s 6-zipline course, gliding over lush landscapes for an unforgettable adrenaline rush!',
            'description_fr' => 'Rencontrez et nourrissez les requins zèbres dans un cadre marin spectaculaire !',
            'description_es' => '¡Encuentra y alimenta a los tiburones cebra en un espectacular entorno marino!',

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 70.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $naturePark->id,
            'main_image' => 'images/tours/odysseo-oceanarium/odysseo-oceanarium-1.jpg',
            'number_of_pictures' => 4,
        ]);

        //Black River Gorges National Park 
        Tour::create([
            'name' => 'Black River Gorges National Park ',
            'name_en' => 'Black River Gorges National Park',
            'name_fr' => 'Parc National des Gorges de la Rivière Noire',
            'name_es' => 'Parque Nacional de las Gargantas del Río Negro',

            'full_title_en' => 'Black River Gorges National Park -3Hour Hike',
            'full_title_fr' => 'Parc National des Gorges de la Rivière Noire - Randonnée de 3 Heures',
            'full_title_es' => 'Parque Nacional de las Gargantas del Río Negro - Caminata de 3 Horas',

            'slug' => 'black-river-gorges-national-park',

            'description_en' => 'Explore the Black River Gorges National Park on a scenic trek, where you’ll encounter rare native wildlife, breathtaking views, lush flora, and refreshing river swims along the way.',
            'description_fr' => 'Explorez le Parc National des Gorges de la Rivière Noire lors d\'une randonnée pittoresque, en rencontrant la faune rare, des vues à couper le souffle, une flore luxuriante et des baignades rafraîchissantes.',
            'description_es' => 'Explora el Parque Nacional de las Gargantas del Río Negro en una caminata escénica, encontrando fauna nativa rara, vistas impresionantes, flora exuberante y refrescantes baños en el río.',

            
            'duration_minutes' => 180,
            'pickup_available' => false,
            'starting_price' => 55.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $naturePark->id,
            'main_image' => 'images/tours/black-river-gorges-national-park/black-river-gorges-national-park-1.jpg',
            'number_of_pictures' => 4,
        ]);

        //Le Morne Historic Mountain Picturesque Hike
        Tour::create([
            'name' => 'Le Morne Historic Mountain Picturesque Hike',
            'name_en' => 'Le Morne Historic Mountain Picturesque Hike',
            'name_fr' => 'Randonnée Pittoresque du Mont Historique Le Morne',
            'name_es' => 'Caminata Pintoresca de la Montaña Histórica Le Morne',

            'full_title_en' => 'Le Morne Historic Mountain',
            'full_title_fr' => 'Mont Historique Le Morne',
            'full_title_es' => 'Montaña Histórica Le Morne',

            'slug' => 'le-morne-historic-mountain',

            'description_en' => 'Embark on a personalized, intimate hike to discover the breathtaking beauty and rich history of Le Morne Mountain, a true Mauritian treasure.',
            'description_fr' => 'Embarquez pour une randonnée personnalisée et intime pour découvrir la beauté à couper le souffle et l\'histoire riche du Mont Le Morne, un véritable trésor mauricien.',
            'description_es' => 'Emprende una caminata personalizada e íntima para descubrir la impresionante belleza y la rica historia de la Montaña Le Morne, un verdadero tesoro de Mauricio.',

            'duration_minutes' => 180,
            'pickup_available' => false,
            'starting_price' => 60.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $naturePark->id,
            'main_image' => 'images/tours/le-morne-historic-mountain/le-morne-historic-mountain-1.jpg',
            'number_of_pictures' => 4,
        ]);

        //Wild South Coast
        Tour::create([
            'name' => 'Wild South Coast',
            'name_en' => 'Wild South Coast',
            'name_fr' => 'Côte Sud Sauvage',
            'name_es' => 'Costa Sur Salvaje',
        
            'full_title_en' => 'Wild South Coast (Gris Gris)',
            'full_title_fr' => 'Côte Sud Sauvage (Gris Gris)',
            'full_title_es' => 'Costa Sur Salvaje (Gris Gris)',

            'slug' => 'wild-south-coast',
            'description_en' => 'Experience the unique beauty of southern Mauritius on a 2.5-hour guided hike, exploring hidden trails and vibrant natural landscapes away from the usual paths.',
            'description_fr' => 'Découvrez la beauté unique du sud de l\'île Maurice lors d\'une randonnée guidée de 2,5 heures, explorant des sentiers cachés et des paysages naturels vibrants, loin des sentiers battus.',
            'description_es' => 'Experimenta la belleza única del sur de Mauricio en una caminata guiada de 2,5 horas, explorando senderos ocultos y paisajes naturales vibrantes, lejos de los caminos habituales.',

            'duration_minutes' => 150,
            'pickup_available' => false,
            'starting_price' => 50.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $naturePark->id,
            'main_image' => 'images/tours/wild-south-coast/wild-south-coast-1.jpg',
            'number_of_pictures' => 4,
        ]);

        
        //Ultimate thrilling bicycle
        Tour::create([
            'name' => 'Ultimate thrilling bicycle',
            'name_en' => 'Ultimate thrilling bicycle',
            'name_fr' => 'Vélo Extrême et Palpitant',
            'name_es' => 'Bicicleta Extremadamente Emocionante',

            'full_title_en' => 'Ultimate thrilling bicycle –zip-line activity',
            'full_title_fr' => 'Vélo Extrême – Activité Tyrolienne',
            'full_title_es' => 'Bicicleta Extrema – Actividad de Tirolina',

            'slug' => 'ultimate-thrilling-bicycle-activity',
            'description_en' => 'Unique across the Indian Ocean.',
            'description_fr' => 'Unique dans tout l\'océan Indien.',
            'description_es' => 'Único en todo el Océano Índico.',
            

            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 191.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $naturePark->id,
            'main_image' => 'images/tours/ultimate-thrilling-bicycle-activity/ultimate-thrilling-bicycle-activity-1.jpg',
            'number_of_pictures' => 4,
        ]);

        //Advenature Flight
        Tour::create([
            'name' => 'Advenature Flight',
            'name_en' => 'Advenature Flight',
            'name_fr' => 'Vol Advenature',
            'name_es' => 'Vuelo Advenature',

            'full_title_en' => 'Advenature Flight',
            'full_title_fr' => 'Vol Advenature',
            'full_title_es' => 'Vuelo Advenature',

            'slug' => 'advenature-flight',
            'description_en' => 'Experience the thrill of Vallé Adventure Park’s 13-line zipline course, soaring high above lush landscapes for the ultimate adrenaline rush!',
            'description_fr' => 'Vivez le frisson du parcours de 13 tyroliennes du Parc Vallée Adventure, survolant les paysages luxuriants pour une poussée d’adrénaline ultime !',
            'description_es' => '¡Experimenta la emoción del recorrido de 13 tirolinas del Parque Vallée Adventure, volando alto sobre paisajes exuberantes para la máxima adrenalina!',
        
            'duration_minutes' => 480,
            'pickup_available' => false,
            'starting_price' => 136.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $naturePark->id,
            'main_image' => 'images/tours/advenature-flight/advenature-flight-1.jpg',
            'number_of_pictures' => 4,
        ]);
        

    }
}