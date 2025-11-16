<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * Toggle favorite status for a destination
     */
    public function toggle($destinationId)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $destination = Destination::findOrFail($destinationId);
        
        $favorite = Favorite::where('user_id_232136', Auth::id())
                           ->where('destination_id_232136', $destinationId)
                           ->first();

        if ($favorite) {
            // Remove from favorites
            $favorite->delete();
            return response()->json([
                'status' => 'removed',
                'message' => 'Dihapus dari favorit'
            ]);
        } else {
            // Add to favorites
            Favorite::create([
                'user_id_232136' => Auth::id(),
                'destination_id_232136' => $destinationId,
            ]);
            return response()->json([
                'status' => 'added',
                'message' => 'Ditambahkan ke favorit'
            ]);
        }
    }

    /**
     * Check if destination is favorited by current user
     */
    public function check($destinationId)
    {
        if (!Auth::check()) {
            return response()->json(['favorited' => false]);
        }

        $favorited = Favorite::where('user_id_232136', Auth::id())
                            ->where('destination_id_232136', $destinationId)
                            ->exists();

        return response()->json(['favorited' => $favorited]);
    }

    /**
     * Display user's favorite destinations
     */
    public function index()
    {
        $favorites = Auth::user()
                        ->favoriteDestinations()
                        ->with(['category', 'galleries', 'reviews'])
                        ->paginate(12);

        return view('favorites.index', compact('favorites'));
    }
}
