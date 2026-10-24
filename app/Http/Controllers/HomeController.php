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

        $totalDestinationsCount = Destination::count();
        $totalPackagesCount = TourPackage::count();

        // If no explicit filter is applied, show top 6 curated destinations on homepage
        $isFiltered = ($category && $category !== 'Semua') || ($region && $region !== 'Semua') || !empty($keyword);
        $destinations = $isFiltered ? $destinationsQuery->get() : $destinationsQuery->take(6)->get();

        $allDestinations = Destination::all();
        $allPackages = TourPackage::all();
        $packages = TourPackage::where('is_featured', true)->get();
        $testimonials = Testimonial::all();
        $gallery = GalleryItem::all();

        // Items for booking modal dropdown (all packages & all destinations)
        $bookingOptions = [];
        foreach ($allPackages as $pkg) {
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
            'sort',
            'totalDestinationsCount',
            'totalPackagesCount'
        ));
    }
}
