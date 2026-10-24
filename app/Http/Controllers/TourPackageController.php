<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use Illuminate\Http\Request;

class TourPackageController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->query('keyword');
        $duration = $request->query('duration', 'Semua');
        $sort = $request->query('sort', 'rekomendasi');

        $query = TourPackage::query();

        if ($duration && $duration !== 'Semua') {
            $query->where('duration', 'like', "%{$duration}%");
        }

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('hotel', 'like', "%{$keyword}%")
                  ->orWhere('badge', 'like', "%{$keyword}%");
            });
        }

        switch ($sort) {
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $query->orderBy('price', 'desc');
                break;
            case 'rekomendasi':
            default:
                $query->orderBy('is_featured', 'desc')->orderBy('price', 'asc');
                break;
        }

        $packages = $query->get();
        $totalCount = TourPackage::count();

        return view('packages.index', compact('packages', 'keyword', 'duration', 'sort', 'totalCount'));
    }

    public function show($slug)
    {
        $package = TourPackage::where('slug', $slug)->firstOrFail();
        $otherPackages = TourPackage::where('id', '!=', $package->id)->take(2)->get();

        return view('packages.show', compact('package', 'otherPackages'));
    }
}
