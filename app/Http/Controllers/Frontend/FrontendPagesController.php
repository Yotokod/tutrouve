<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Listing;
use Illuminate\Http\Request;

class FrontendPagesController extends Controller
{
    /**
     * Show the home page
     */
    public function home()
    {
        try {
            // Get top listings (featured and with most views)
            $topListings = Listing::where('status', 1)
                ->where('is_published', 1)
                ->where('is_featured', 1)
                ->orderBy('view', 'desc')
                ->take(8)
                ->get();

            // Get categories with listing count
            $categories = Category::withCount('listings')
                ->where('status', 1)
                ->take(8)
                ->get();

            // Get recent listings
            $recentListings = Listing::where('status', 1)
                ->where('is_published', 1)
                ->orderBy('created_at', 'desc')
                ->take(8)
                ->get();

            return view('frontend.pages.home', compact('topListings', 'categories', 'recentListings'));
        } catch (\Exception $exception) {
            \Log::error('Error in FrontendPagesController@home: ' . $exception->getMessage());
            return view('frontend.pages.home', [
                'topListings' => collect(),
                'categories' => collect(),
                'recentListings' => collect(),
            ]);
        }
    }

    /**
     * Show the about page
     */
    public function about()
    {
        return view('frontend.pages.about');
    }

    /**
     * Show the services page
     */
    public function services()
    {
        return view('frontend.pages.services');
    }

    /**
     * Show the contact page
     */
    public function contact()
    {
        return view('frontend.pages.contact');
    }
}
