<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
        $search = $request->query('search');

        $query = Booking::latest();

        if ($status && $status !== 'all') {
            $query->where('status', $status);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('booking_code', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_phone', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%")
                  ->orWhere('item_name', 'like', "%{$search}%");
            });
        }

        $bookings = $query->paginate(15)->withQueryString();
        $totalConfirmed = Booking::where('status', 'confirmed')->count();
        $totalPending = Booking::where('status', 'pending')->count();
        $totalCompleted = Booking::where('status', 'completed')->count();
        $totalCancelled = Booking::where('status', 'cancelled')->count();
        $totalRevenue = Booking::whereIn('status', ['confirmed', 'completed'])->sum('total_price');

        return view('admin.bookings.index', compact(
            'bookings',
            'status',
            'search',
            'totalConfirmed',
            'totalPending',
            'totalCompleted',
            'totalCancelled',
            'totalRevenue'
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $validated = $request->validate([
            'status' => 'required|in:confirmed,pending,completed,cancelled',
        ]);

        $booking->update(['status' => $validated['status']]);

        return back()->with('success', 'Status reservasi #' . $booking->booking_code . ' berhasil diubah menjadi ' . ucfirst($validated['status']));
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $code = $booking->booking_code;
        $booking->delete();

        return back()->with('success', 'Reservasi #' . $code . ' berhasil dihapus dari sistem.');
    }
}
