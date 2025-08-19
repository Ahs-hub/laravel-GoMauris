<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TourCategory;

class TourCategorySeeder extends Seeder
{
    public function run(): void
    {
        TourCategory::insert([
            [
                'name' => 'Sea Activities',
                
                'slug' => 'sea-activities',
                'description' => 'Enjoy water sports, cruises and more.',
            ],
            [
                'name' => 'Sightseeing Tours',

                'slug' => 'sightseeing',
                'description' => 'Explore the best scenic spots around Mauritius.',
            ],
            [
                'name' => 'Nature Park',

                'slug' => 'nature-park',
                'description' => 'Discover the rich flora and fauna of the island.',
            ],
        ]);
    }
}