<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\Newsletter;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $pendingBookings = Booking::where('status', 'pending')->count();
        $completedBookings = Booking::where('status', 'completed')->count();
        $cancelledBookings = Booking::where('status', 'cancelled')->count();

        $totalRevenue = Booking::whereIn('status', ['confirmed', 'completed'])->sum('total_price');
        $totalDestinations = Destination::count();
        $totalPackages = TourPackage::count();
        $totalSubscribers = Newsletter::count();

        $recentBookings = Booking::latest()->take(6)->get();
        $recentDestinations = Destination::latest()->take(4)->get();
        $recentSubscribers = Newsletter::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalBookings',
            'confirmedBookings',
            'pendingBookings',
            'completedBookings',
            'cancelledBookings',
            'totalRevenue',
            'totalDestinations',
            'totalPackages',
            'totalSubscribers',
            'recentBookings',
            'recentDestinations',
            'recentSubscribers'
        ));
    }
}
