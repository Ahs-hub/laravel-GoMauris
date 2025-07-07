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

        Tour::create([
            'name' => 'Catamaran Cruise to Ile Aux Gabriel Island',
            'slug' => 'catamaran-cruise-gabriel',
            'description' => 'A full-day sea activity on a luxurious catamaran with BBQ and snorkeling.',
            'duration_minutes' => 420,
            'pickup_included' => true,
            'starting_price' => 42.00,
            'average_rating' => 4.7,
            'total_reviews' => 932,
            'tour_category_id' => $seaActivities->id,
            'main_image' => 'images/tours/catamaran-cruise-gabriel-island/catamaran-cruise-gabriel-island-1.jpg',
        ]);

        Tour::create([
            'name' => 'North Coast Sightseeing Tour',
            'slug' => 'north-coast-sightseeing',
            'description' => 'Visit Grand Bay, Cap Malheureux and other iconic coastal sights.',
            'duration_minutes' => 360,
            'pickup_included' => false,
            'starting_price' => 30.00,
            'average_rating' => 4.5,
            'total_reviews' => 550,
            'tour_category_id' => $sightseeing->id,
            'main_image' => 'images/tours/north-coast-sightseeing/north-coast-1.jpg',
        ]);

        Tour::create([
            'name' => 'Casela Nature Park Explorer',
            'slug' => 'casela-nature-park',
            'description' => 'Walk with lions, ride a safari jeep, and zipline across rivers.',
            'duration_minutes' => 300,
            'pickup_included' => true,
            'starting_price' => 50.00,
            'average_rating' => 4.8,
            'total_reviews' => 700,
            'tour_category_id' => $naturePark->id,
            'main_image' => 'images/tours/casela-nature-park/casela-1.jpg',
        ]);
    }
}