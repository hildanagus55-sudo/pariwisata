<?php

namespace App\Http\Controllers;

use App\Models\TourPackage;
use Illuminate\Http\Request;

class TourPackageController extends Controller
{
    public function index()
    {
        $packages = TourPackage::all();
        return view('packages.index', compact('packages'));
    }

    public function show($slug)
    {
        $package = TourPackage::where('slug', $slug)->firstOrFail();
        $otherPackages = TourPackage::where('id', '!=', $package->id)->take(2)->get();

        return view('packages.show', compact('package', 'otherPackages'));
    }
}
