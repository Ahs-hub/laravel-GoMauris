<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tour;

class WishlistController extends Controller
{
    public function showWishlistPage()
    {
        $allTours = Tour::select('id', 'slug', 'name as title', 'starting_price as price', 'main_image as thumbnail')->get();
        return view('wishlistpage', compact('allTours'));
    }
}
