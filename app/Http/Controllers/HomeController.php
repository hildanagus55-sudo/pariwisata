<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\GalleryItem;
use App\Models\Testimonial;
use App\Models\TourPackage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category', 'Semua');
        $region = $request->query('region', 'Semua');
        $keyword = $request->query('keyword');
        $sort = $request->query('sort', 'popular');

        $destinationsQuery = Destination::query();

        if ($category && $category !== 'Semua') {
            $destinationsQuery->where('category', $category);
        }

        if ($region && $region !== 'Semua') {
            $destinationsQuery->where('region', $region);
        }

        if ($keyword) {
            $destinationsQuery->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('location', 'like', "%{$keyword}%")
                  ->orWhere('description', 'like', "%{$keyword}%");
            });
        }

        switch ($sort) {
            case 'price-asc':
                $destinationsQuery->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $destinationsQuery->orderBy('price', 'desc');
                break;
            case 'rating':
                $destinationsQuery->orderBy('rating', 'desc');
                break;
            case 'popular':
            default:
                $destinationsQuery->orderBy('reviews_count', 'desc');
                break;
        }

        $destinations = $destinationsQuery->get();
        $allDestinations = Destination::all();
        $packages = TourPackage::where('is_featured', true)->get();
        $testimonials = Testimonial::all();
        $gallery = GalleryItem::all();

        // Items for booking modal dropdown
        $bookingOptions = [];
        foreach ($packages as $pkg) {
            $bookingOptions[] = [
                'type' => 'package',
                'name' => $pkg->name,
                'price' => $pkg->price,
                'label' => '[Paket] ' . $pkg->name . ' (' . $pkg->formatted_price . '/org)',
            ];
        }
        foreach ($allDestinations as $dest) {
            $bookingOptions[] = [
                'type' => 'destination',
                'name' => $dest->name,
                'price' => $dest->price,
                'label' => '[Destinasi] ' . $dest->name . ' (' . $dest->formatted_price . '/org)',
            ];
        }

        if ($request->wantsJson()) {
            return response()->json([
                'destinations' => $destinations,
                'packages' => $packages,
            ]);
        }

        return view('home', compact(
            'destinations',
            'allDestinations',
            'packages',
            'testimonials',
            'gallery',
            'bookingOptions',
            'category',
            'region',
            'keyword',
            'sort'
        ));
    }
}
