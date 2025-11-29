<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Destination;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $featuredDestinations = Destination::with(['category', 'galleries', 'reviews'])
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::withCount('destinations')->get();
        
        return view('index', compact('featuredDestinations', 'categories'));
    }

    public function destinations(Request $request){
        $query = Destination::with(['category', 'galleries', 'reviews']);

        // Search filter
        if($request->filled('search')){
            $search = $request->search;
            $query->where(function($q) use ($search){
                $q->where('name_232136', 'like', "%{$search}%")
                ->orWhere('location_232136', 'like', "%{$search}%")
                ->orWhere('description_232136', 'like', "%{$search}%");
            });
        }

        // Category filter
        if($request->filled('category')){
            $query->where('category_id_232136', $request->category);
        }

        // Sorting
        $sort = $request->get('sort', 'newest');
        
        switch($sort) {
            case 'popular':
                // Sort by number of reviews (most popular)
                $query->withCount('reviews')
                      ->orderBy('reviews_count', 'desc');
                break;
            case 'highest_rated':
                // Sort by average rating
                $query->withAvg('reviews as average_rating', 'rating_232136')
                      ->orderByDesc('average_rating');
                break;
            case 'oldest':
                // Sort by oldest first
                $query->oldest();
                break;
            case 'name_asc':
                // Sort by name A-Z
                $query->orderBy('name_232136', 'asc');
                break;
            case 'name_desc':
                // Sort by name Z-A
                $query->orderBy('name_232136', 'desc');
                break;
            case 'newest':
            default:
                // Sort by newest (default)
                $query->latest();
                break;
        }

        $destinations = $query->paginate(12)->appends($request->except('page'));
        $categories = Category::all();

        return view('public.destinations', compact('destinations', 'categories'));
    }

    public function show($id){
        $destination = Destination::with(['category', 'galleries', 'reviews'])
            ->findOrFail($id);

        $relatedDestinations = Destination::with(['category', 'galleries', 'reviews'])
            ->where('category_id_232136', $destination->category_id_232136)
            ->where('id', '!=', $id)
            ->take(3)
            ->get();

        return view('public.destination-detail', compact('destination', 'relatedDestinations'));
    }

    public function storeReview(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login untuk memberikan review.');
        }

        $request->validate([
            'rating_232136' => 'required|integer|min:1|max:5',
            'comment_232136' => 'required|string|min:10|max:1000',
        ]);

        $destination = Destination::findOrFail($id);

        // Check if user already reviewed this destination
        $existingReview = Review::where('user_id_232136', Auth::id())
            ->where('destination_id_232136', $id)
            ->first();

        if ($existingReview) {
            return back()->with('error', 'Anda sudah memberikan review untuk destinasi ini.');
        }

        Review::create([
            'user_id_232136' => Auth::id(),
            'user_name_232136' => Auth::user()->name_232136,
            'destination_id_232136' => $id,
            'rating_232136' => $request->rating_232136,
            'comment_232136' => $request->comment_232136,
        ]);

        return back()->with('success', 'Review berhasil ditambahkan!');
    }

    public function checkCapacity(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);
        $date = $request->query('date');

        if (!$date) {
            return response()->json(['error' => 'Date is required'], 400);
        }

        $availableCapacity = $destination->getAvailableCapacityForDate($date);
        $bookedCapacity = $destination->getBookedCapacityForDate($date);

        return response()->json([
            'available_capacity' => $availableCapacity,
            'booked_capacity' => $bookedCapacity,
            'daily_capacity' => $destination->daily_capacity_232136,
        ]);
    }
}