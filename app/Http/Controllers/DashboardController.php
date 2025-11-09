<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Review;
use App\Models\User;


class DashboardController extends Controller
{
    public function index(){
        $stats = [
            'destinations' => Destination::count(),
            'reviews' => Review::count(),
            'users' => User::count(),

        ];

        $recentDestinations = Destination::with('category')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact('stats', 'recentDestinations'));
    }
}
