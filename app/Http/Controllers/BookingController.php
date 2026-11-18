<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Destination;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name' => 'required|string',
            'customer_name' => 'required|string|max:100',
            'customer_phone' => 'required|string|max:30',
            'customer_email' => 'nullable|email|max:100',
            'travel_date' => 'required|string',
            'pax' => 'required|integer|min:1|max:50',
            'addon_drone' => 'nullable',
            'addon_vip' => 'nullable',
            'promo_code' => 'nullable|string|max:30',
            'notes' => 'nullable|string|max:500',
        ]);

        $itemName = $validated['item_name'];
        $pax = (int) $validated['pax'];

        // Determine price from TourPackage or Destination
        $package = TourPackage::where('name', $itemName)->first();
        $unitPrice = 2500000;

        if ($package) {
            $unitPrice = $package->price;
        } else {
            $dest = Destination::where('name', $itemName)->first();
            if ($dest) {
                $unitPrice = $dest->price;
            }
        }

        $baseTotal = $unitPrice * $pax;
        $addonDrone = !empty($request->addon_drone);
        $addonVip = !empty($request->addon_vip);

        $addonTotal = ($addonDrone ? 450000 : 0) + ($addonVip ? (650000 * $pax) : 0);
        $subtotal = $baseTotal + $addonTotal;

        $promoCode = strtoupper(trim($request->promo_code ?? ''));
        $discount = 0;
        if ($promoCode === 'PESONAID') {
            $discount = (int) round($subtotal * 0.15);
        }

        $totalPrice = max(0, $subtotal - $discount);

        // Generate unique booking code
        do {
            $code = 'NW-' . mt_rand(10000, 99999);
        } while (Booking::where('booking_code', $code)->exists());

        $booking = Booking::create([
            'booking_code' => $code,
            'item_name' => $itemName,
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_email' => $validated['customer_email'] ?? (auth()->check() ? auth()->user()->email : null),
            'travel_date' => $validated['travel_date'],
            'pax' => $pax,
            'addon_drone' => $addonDrone,
            'addon_vip' => $addonVip,
            'promo_code' => $promoCode ?: null,
            'discount_amount' => $discount,
            'total_price' => $totalPrice,
            'status' => 'confirmed',
            'notes' => $request->notes,
        ]);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Simulasi pemesanan berhasil dikonfirmasi!',
                'booking' => [
                    'code' => $booking->booking_code,
                    'customer_name' => $booking->customer_name,
                    'item_name' => $booking->item_name,
                    'travel_date' => $booking->travel_date->format('d M Y'),
                    'pax' => $booking->pax,
                    'total_price' => $booking->formatted_total_price,
                    'receipt_url' => route('bookings.receipt', $booking->booking_code),
                ]
            ]);
        }

        return redirect()->route('bookings.receipt', $booking->booking_code)
            ->with('success', 'Pemesanan berhasil! Berikut e-tiket simulasi Anda.');
    }

    public function receipt($booking_code)
    {
        $booking = Booking::where('booking_code', $booking_code)->firstOrFail();
        return view('bookings.receipt', compact('booking'));
    }

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
                  ->orWhere('item_name', 'like', "%{$search}%");
            });
        }

        $bookings = $query->paginate(15);
        $totalConfirmed = Booking::where('status', 'confirmed')->count();
        $totalRevenue = Booking::where('status', 'confirmed')->sum('total_price');

        return view('admin.bookings', compact('bookings', 'status', 'search', 'totalConfirmed', 'totalRevenue'));
    }

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $validated = $request->validate([
            'status' => 'required|in:confirmed,pending,completed,cancelled',
        ]);

        $booking->update(['status' => $validated['status']]);

        return back()->with('success', 'Status reservasi ' . $booking->booking_code . ' berhasil diperbarui menjadi ' . ucfirst($validated['status']));
    }
}
