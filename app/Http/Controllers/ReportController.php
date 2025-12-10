<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Destination;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function bookings(Request $request)
    {
        $destinations = Destination::orderBy('name_232136')->get();

        $query = Booking::with(['destination', 'user']);

        if ($request->filled('start_date')) {
            $query->whereDate('visit_date_232136', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('visit_date_232136', '<=', $request->end_date);
        }

        if ($request->filled('destination_id')) {
            $query->where('destination_id_232136', $request->destination_id);
        }

        $bookings = $query->orderBy('visit_date_232136')->get();

        $revenueQuery = clone $query;
        $revenueData = $revenueQuery
            ->where('status_232136', 'confirmed')
            ->get()
            ->groupBy('destination_id_232136')
            ->map(function ($items) {
                return [
                    'destination' => $items->first()->destination,
                    'total_amount' => $items->sum('total_price_232136'),
                    'total_people' => $items->sum('number_of_people_232136'),
                    'total_bookings' => $items->count(),
                ];
            });

        $totalRevenue = $bookings
            ->where('status_232136', 'confirmed')
            ->sum('total_price_232136');

        return view('admin.reports.bookings', [
            'destinations' => $destinations,
            'bookings' => $bookings,
            'revenueData' => $revenueData,
            'totalRevenue' => $totalRevenue,
            'filters' => [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'destination_id' => $request->destination_id,
            ],
        ]);
    }

    public function bookingsPrint(Request $request)
    {
        $query = Booking::with(['destination', 'user']);

        if ($request->filled('start_date')) {
            $query->whereDate('visit_date_232136', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('visit_date_232136', '<=', $request->end_date);
        }

        if ($request->filled('destination_id')) {
            $query->where('destination_id_232136', $request->destination_id);
        }

        $bookings = $query->orderBy('visit_date_232136')->get();

        $totalRevenue = $bookings
            ->where('status_232136', 'confirmed')
            ->sum('total_price_232136');

        return view('admin.reports.bookings-print', [
            'bookings' => $bookings,
            'totalRevenue' => $totalRevenue,
            'filters' => [
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'destination_id' => $request->destination_id,
            ],
        ]);
    }
}
