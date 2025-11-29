<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['destination', 'user'])
            ->where('user_id_232136', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('bookings.index', compact('bookings'));
    }

    public function create(Destination $destination)
    {
        return view('bookings.create', compact('destination'));
    }

    public function store(Request $request, $destinationId)
    {
        $request->validate([
            'visit_date_232136' => 'required|date|after_or_equal:today',
            'number_of_people_232136' => 'required|integer|min:1|max:50',
            'special_requests_232136' => 'nullable|string|max:1000',
        ], [
            'visit_date_232136.required' => 'Tanggal kunjungan harus diisi.',
            'visit_date_232136.date' => 'Format tanggal tidak valid.',
            'visit_date_232136.after_or_equal' => 'Tanggal kunjungan tidak boleh di masa lalu.',
            'number_of_people_232136.required' => 'Jumlah orang harus diisi.',
            'number_of_people_232136.integer' => 'Jumlah orang harus berupa angka.',
            'number_of_people_232136.min' => 'Minimal 1 orang.',
            'number_of_people_232136.max' => 'Maksimal 50 orang per booking.',
        ]);

        $destination = Destination::findOrFail($destinationId);

        // Check if destination has available capacity for the requested date
        if (!$destination->canBookForDate($request->visit_date_232136, $request->number_of_people_232136)) {
            $availableCapacity = $destination->getAvailableCapacityForDate($request->visit_date_232136);
            
            if ($availableCapacity === 0) {
                return back()->withInput()->with('error', 
                    "⚠️ DESTINASI PENUH - Tidak ada kapasitas tersedia untuk tanggal " . 
                    date('d/m/Y', strtotime($request->visit_date_232136)) . 
                    ". Silakan pilih tanggal lain untuk melakukan booking."
                );
            } else {
                return back()->withInput()->with('error', 
                    "⚠️ KAPASITAS TIDAK MENCUKUPI - Hanya tersedia {$availableCapacity} slot untuk tanggal tersebut, tetapi Anda memilih {$request->number_of_people_232136} orang. Silakan kurangi jumlah orang atau pilih tanggal lain."
                );
            }
        }

        // Calculate total price
        $totalPrice = $destination->price_232136 * $request->number_of_people_232136;

        $booking = Booking::create([
            'user_id_232136' => Auth::id(),
            'destination_id_232136' => $destinationId,
            'booking_code_232136' => Booking::generateBookingCode(),
            'visit_date_232136' => $request->visit_date_232136,
            'number_of_people_232136' => $request->number_of_people_232136,
            'special_requests_232136' => $request->special_requests_232136,
            'status_232136' => 'pending',
            'total_price_232136' => $totalPrice,
        ]);

        return redirect()->route('bookings.show', $booking->id)
            ->with('success', 'Booking berhasil dibuat! Kode booking Anda: ' . $booking->booking_code_232136);
    }

    public function show($id)
    {
        $booking = Booking::with(['destination', 'user'])
            ->where('id', $id)
            ->where('user_id_232136', Auth::id())
            ->firstOrFail();

        return view('bookings.show', compact('booking'));
    }

    public function cancel($id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id_232136', Auth::id())
            ->firstOrFail();

        if ($booking->status_232136 === 'cancelled') {
            return back()->with('error', 'Booking ini sudah dibatalkan.');
        }

        if ($booking->status_232136 === 'confirmed') {
            return back()->with('error', 'Booking yang sudah dikonfirmasi tidak dapat dibatalkan.');
        }

        $booking->update(['status_232136' => 'cancelled']);

        return back()->with('success', 'Booking berhasil dibatalkan.');
    }

    // Admin methods
    public function adminIndex()
    {
        $bookings = Booking::with(['destination', 'user'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_232136' => 'required|in:pending,confirmed,cancelled',
        ]);

        $booking = Booking::findOrFail($id);
        $booking->update(['status_232136' => $request->status_232136]);

        return back()->with('success', 'Status booking berhasil diperbarui.');
    }
}
