<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Review;
use App\Models\User;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Favorite;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        // Basic Statistics
        $stats = [
            'destinations' => Destination::count(),
            'categories' => Category::count(),
            'reviews' => Review::count(),
            'users' => User::where('role', 'user')->count(),
            'galleries' => Gallery::count(),
            'favorites' => Favorite::count(),
        ];

        // Top 5 Most Popular Destinations (by review count)
        $popularDestinations = Destination::withCount('reviews')
            ->with('category')
            ->orderBy('reviews_count', 'desc')
            ->take(5)
            ->get();

        // Top 5 Highest Rated Destinations
        $topRatedDestinations = Destination::withAvg('reviews as average_rating', 'rating_232136')
            ->with('category')
            ->having('average_rating', '>', 0)
            ->orderByDesc('average_rating')
            ->take(5)
            ->get();

        // Recent Destinations
        $recentDestinations = Destination::with('category')
            ->latest()
            ->take(5)
            ->get();

        // Recent Reviews
        $recentReviews = Review::with(['destination'])
            ->latest()
            ->take(5)
            ->get();

        // Reviews per Month (last 6 months)
        $reviewsPerMonth = Review::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('YEAR(created_at) as year'),
                DB::raw('COUNT(*) as count')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Destinations per Category
        $destinationsPerCategory = Category::withCount('destinations')
            ->having('destinations_count', '>', 0)
            ->get();

        // Rating Distribution
        $ratingDistribution = Review::select(
                'rating_232136',
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('rating_232136')
            ->orderBy('rating_232136', 'desc')
            ->get();

        return view('dashboard', compact(
            'stats',
            'popularDestinations',
            'topRatedDestinations',
            'recentDestinations',
            'recentReviews',
            'reviewsPerMonth',
            'destinationsPerCategory',
            'ratingDistribution'
        ));
    }
}
