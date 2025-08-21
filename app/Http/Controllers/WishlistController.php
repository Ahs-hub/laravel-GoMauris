<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tour;

class WishlistController extends Controller
{
    public function showWishlistPage()
    {
        $locale = app()->getLocale(); // en, fr, es
        $nameColumn = 'name_' . $locale;       // e.g. name_en, name_fr, name_es
        $fullTitleColumn = 'full_title_' . $locale;
    
        $allTours = Tour::select(
            'id',
            'slug',
            $nameColumn . ' as name',
            $fullTitleColumn . ' as full_title',
            'starting_price as price',
            'main_image as thumbnail'
        )->get();
    
        return view('wishlistpage', compact('allTours'));
    }
}
