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
            'full_title' => 'Full Day Catamaran Cruise To the Northern Isles',
            'slug' => 'catamaran-cruise-northern-isles',
            'description' => 'Enjoy a full-day catamaran cruise from Grand Baie to the idyllic northern islets of Mauritius. Swim and snorkel in turquoise lagoons around Gabriel, Flat, and Coin de Mire, 
                              then unwind with a freshly grilled BBQ lunch at sea.',
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
            'full_title' => 'Ile aux Cerfs Catamaran Trip w/Lunch BBQ / Drinks ',
            'slug' => 'ile-aux-cerfs-catamaran-trip',
            'description' => 'Cruise the tranquil lagoons of Mauritius aboard a spacious catamaran as you soak in breathtaking mountain views.
                               Set sail for the stunning Ile aux Cerfs Island and enjoy a freshly prepared 3-course lunch served on board.',
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
            'full_title' => 'Ile aux Benitiers: Snorkelling w/Dolphins Boat Tour And Lunch',
            'slug' => 'catamaran-cruise-benitiers-island',
            'description' => 'Discover the beauty of Île aux Bénitiers on a full-day marine adventure.
                              Snorkel with dolphins in the open sea, admire the natural wonder of Crystal Rock,
                              and enjoy a 3-course BBQ lunch before relaxing on the island’s pristine shores.',
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
            'full_title' => 'East Coast Mauritius Private Scenic Seaplane Tour- Seaplane',
            'slug' => 'east-coast-activity',
            'description' => 'Lift off from the crystal-clear waters of Azuri Beachfront and take in breathtaking panoramic views of the turquoise lagoon and surrounding eastern islets — a truly unforgettable',
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
            'full_title' => 'Five Islands Speedboat w/snorkeling sea turtles + lunch & Drinks',
            'slug' => 'five-islands-speedboat-activity',
            'description' => 'Discover Mauritius’ most iconic islands and hidden waterfalls in VIP style aboard our comfortable speedboat.
                              Groups of 4 or more can enjoy a private tour for an even more exclusive experience.',
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
            'full_title' => 'Belle Mare Water Sports , Undersea Walk, Parasailing , Tude Ride',
            'slug' => 'belle-mare-activity',
            'description' => 'Dive into adventure at Belle Mare Beach with an exciting selection of lagoon watersports! Try parasailing, tube rides, 
                              and the unforgettable undersea walk — or enjoy them all with our action-packed combo package.',
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
            'full_title' => 'Blue Bay GlassBottom Boat Visit &Snorkelling',
            'slug' => 'bluebay-boat-visit-snorkelling',
            'description' => 'Explore the crystal-clear waters of Blue Bay Marine Park on a glass bottom boat tour and snorkeling adventure. Discover vibrant coral reefs and exotic marine life in one of Mauritius most stunning underwater ecosystems.',
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
            'full_title' => 'East Belle Mare Scuba Diving Tour ',
            'slug' => 'east-belle-mare-scuba-diving',
            'description' => 'Dive into an unforgettable underwater adventure from Belle Mare. Learn the basics with a certified team and explore the vibrant coral reefs and marine life that make Mauritius a world-class diving destination.',
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
            'full_title' => 'Abseiling/Canoying 3Hours (small group limited to 6)',
            'slug' => 'abseiling-canoying',
            'description' => 'Experience the wild beauty of Tamarind Falls on a 3-hour canyoning and abseiling adventure. With expert guides and all safety gear provided, descend the cascading falls, take in incredible views, and challenge yourself with optional cliff jumps.',
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
            'full_title' => 'Snorkel and Swim with Dolphins on Speedboat Tour',
            'slug' => 'snorkel-with-dolphins-speedboat',
            'description' => 'Set off from Tamarin Beach on a thrilling speedboat ride and swim alongside wild dolphins in their natural habitat. Snorkeling gear is included, so you can dive in and discover the vibrant underwater world.',
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
            'full_title' => 'Gorges , Spiritual Lake, Waterfalls & 23 colored Earth',
            'slug' => 'gorges-spiritual-lake',
            'description' => 'Spend the day uncovering the lush landscapes of Mauritius on a private guided tour. Visit Grand Bassin, the Black River Gorges, and Alexandra Falls.',
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
            'full_title' => 'Tamarind Fall GuidedHike with Swim & Lunch',
            'slug' => 'tamarind-fall-guidedhike',
            'description' => 'Trek through the forested trails of Tamarind Falls and uncover one of Mauritius’ most beautiful natural wonders. Enjoy waterfall swims, peaceful surroundings, and a picnic lunch in the heart of the island.',
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
            'full_title' => 'Full day Tour of The North with Hotel Transfer',
            'slug' => 'full-day-the-north-hotel-transfer',
            'description' => 'Discover the cultural highlights of northern Mauritius on a private day trip. With hotel transfers included, visit the famous Red Roof Church, the serene Botanical Garden, a local Tea Factory, and the lively Port-Louis markets before ending at historic Fort Adelaide.',
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
            'full_title' => 'Private Island Tour with Chauffeur/Guide ',
            'slug' => 'private-tour-with-chauffeurguide',
            'description' => 'Discover Mauritius your way with a full-day personal driver-guide. Choose the destinations you’d like to see, travel in comfort, and select between a luxury car or a standard option to suit your style and budget.<br><br>€110 per group (standard)<br>€115 per group (luxury car)',
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
            'full_title' => 'Photoshoot at Mont Choisy Beach',
            'slug' => 'photoshoot-mont-choisy-beach',
            'description' => 'Turn your Mauritius holiday into a timeless memory with a stunning sunset photoshoot. Whether you are celebrating your honeymoon or enjoying a family getaway, capture the magic of golden hour in paradise.',
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
            'full_title' => 'Horse Riding',
            'slug' => 'horse-riding',
            'description' => '
                              <ul>
                                 <li>
                                    <strong>Lavilleon Adventure Park</strong> – A 30-minute ride through the scenic southwest. 
                                    <em>Only €19 per person</em></li> <li><strong>Balaclava Equestrian Centre</strong>
                                     – Saddle up for a peaceful countryside ride. <em>€60 per person</em></li> <li><strong>
                                     Belle Mare Beach</strong> – Experience the beauty of horseback riding along the shoreline.
                                    <em>€75 per person</em></li> <li><strong>Romantic Sunset Ride (South Coast)</strong>
                                    – A magical beach ride during golden hour. <em>€105 per person</em></li> <li>
                                    <strong>Riambel Beach</strong> – 1 hour of barefoot riding on the sands. <em>€92 per person</em>
                                    </li> <li><strong>Sunset Horseback & Catamaran Cruise</strong> – The ultimate couple’s package, 
                                    including transport. <em>€450 for 2 persons</em>
                                 </li>
                              </ul>
                             ',
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
            'full_title' => 'Caudan Waterfall, Blue Penny Museum, Port Louis Central Market, Pamplemousse Garden',
            'slug' => 'caudan-waterfall-blue-penny',
            'description' => 'Explore Mauritius with a visit to Caudan Waterfront then dive into history at the Blue Penny Museum. Wander the lively Port Louis Central Market and end your day surrounded by exotic plants at the famous Pamplemousses Botanical Garden.',
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
            'full_title' => 'Sights of the South Private Tour with Rum Tasting',
            'slug' => 'sights-south-private-tour',
            'description' => 'Immerse yourself in the natural beauty and rich heritage of Mauritius on a private tour. Explore the iconic Seven Coloured Earth, witness the majestic Chamarel Waterfall, visit the sacred Grand Bassin, and enjoy a guided rum tasting at Chamarel Distillery.',
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
            'full_title' => 'Mauritius: Southern Tour w/La Vanille & Le Morne Beach',
            'slug' => 'southern-lavanille-lemorne-beach',
            'description' => 'Escape the crowds and uncover the natural wonders of southern Mauritius on a private journey. With convenient hotel transfers, explore Grand Bassin, discover wildlife at La Vanille Nature Park, marvel at Vallée des Couleurs, and unwind at stunning Le Morne Beach.',
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
            'full_title' => 'Mauritius Scenic South West Private Car/SUV/Minivan Tour',
            'slug' => 'scenic-south-west',
            'description' => 'Let us take you on a journey through the scenic southwest of Mauritius in style and comfort. Travel with a friendly chauffeur-guide and enjoy the flexibility of an SUV or spacious minivan for your group',
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
            'full_title' => 'Port Louis: Private Guided Tour and Street Food Tasting',
            'slug' => 'port-louis-private-guided-food',
            'description' => 'Spend an action-packed day exploring the heart of Port Louis. Wander through the vibrant Central Market, stroll down colorful China Town, and soak in the lively atmosphere of Caudan Waterfront. Discover the historic Citadelle Fort and AapravasiGhat, all while indulging in mouth-watering street food along the way',
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
            'full_title' => 'Mauritius: Private Guided Tour with Airport & Hotel Pickup',
            'slug' => 'guided-with-airport-hotel',
            'description' => 'Experience the true essence of Mauritius through a personalized guided journey, where the thrill of adventure blends seamlessly with serene moments of tranquility. Surrender to the island’s vibrant energy, and immerse yourself in every unforgettable moment',
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
            'full_title' => 'Casela Nature parks & Flic enFlac Beach',
            'slug' => 'casela-nature-flicenflac-beach',
            'description' => 'Experience the wild side of Mauritius at Casela Nature Park, where thrilling activities and exotic animals await, then relax on the golden shores of Flic enFlac Beach, known for its crystal-clear lagoon and peaceful atmosphere.',
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
            'full_title' => 'Valleeadvenature Park, Discovery Quad Single 1Hour',
            'slug' => 'valleeadvenature-park',
            'description' => 'Unleash your inner adventurer at Vallé! Conquer rugged trails and immerse yourself in the islands vibrant landscapes on a quad bike. Feel the rush, embrace the freedom, and discover Mauritius like never before!',
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
            'full_title' => 'Riambel: South Tour w/ Crocodile Park & Seven Colored Earth',
            'slug' => 'riambel-south-tour-crocodile-colored-earth',
            'description' => 'Explore La Vanille Nature Park, a lush sanctuary home to crocodiles, giant tortoises, and a wide range of exotic wildlife and plants. Continue your journey to the spectacular Seven-Colored Earth, where vibrant sand dunes and a picturesque waterfall create a truly unique natural landscape.',
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
            'full_title' => 'South Mauritius: Buggy Tour',
            'slug' => 'south-mauritius-buggy-tour',
            'description' => 'Explore the stunning South of Mauritius with visits to the natural marvel of the Natural Bridge, the powerful Souffleur blowhole, the lush Royal Palm Forest, and the serene BassinCamaron Beach.',
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
            'full_title' => 'ValléAdvenature Park - Adventure Tour Zipline',
            'slug' => 'valléadvenature-park-tour-zipline',
            'description' => 'Feel the thrill of soaring through nature on Vallée Adventure Park’s 6-zipline course, gliding over lush landscapes for an unforgettable adrenaline rush!',
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
            'full_title' => 'Odysseo Oceanarium: Zebra Sharks encounter and feeding',
            'slug' => 'odysseo-oceanarium',
            'description' => 'Feel the thrill of soaring through nature on Vallée Adventure Park’s 6-zipline course, gliding over lush landscapes for an unforgettable adrenaline rush!',
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
            'full_title' => 'Black River Gorges National Park -3Hour Hike',
            'slug' => 'black-river-gorges-national-park',
            'description' => 'Explore the Black River Gorges National Park on a scenic trek, where you’ll encounter rare native wildlife, breathtaking views, lush flora, and refreshing river swims along the way.',
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
            'full_title' => 'Le Morne Historic Mountain',
            'slug' => 'le-morne-historic-mountain',
            'description' => 'Embark on a personalized, intimate hike to discover the breathtaking beauty and rich history of Le Morne Mountain, a true Mauritian treasure.',
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
            'full_title' => 'Wild South Coast (Gris Gris)',
            'slug' => 'wild-south-coast',
            'description' => 'Experience the unique beauty of southern Mauritius on a 2.5-hour guided hike, exploring hidden trails and vibrant natural landscapes away from the usual paths.',
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
            'full_title' => 'Ultimate thrilling bicycle –zip-line activity',
            'slug' => 'ultimate-thrilling-bicycle-activity',
            'description' => 'Unique across the Indian Ocean.',
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
            'full_title' => 'Advenature Flight',
            'slug' => 'advenature-flight',
            'description' => 'Experience the thrill of Vallé Adventure Park’s 13-line zipline course, soaring high above lush landscapes for the ultimate adrenaline rush!',
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