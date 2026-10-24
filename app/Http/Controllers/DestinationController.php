<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category', 'Semua');
        $region = $request->query('region', 'Semua');
        $keyword = $request->query('keyword');
        $sort = $request->query('sort', 'popular');

        $query = Destination::query();

        if ($category && $category !== 'Semua') {
            $query->where('category', $category);
        }

        if ($region && $region !== 'Semua') {
            $query->where('region', $region);
        }

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('name', 'like', "%{$keyword}%")
                  ->orWhere('location', 'like', "%{$keyword}%");
            });
        }

        switch ($sort) {
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price-desc':
                $query->orderBy('price', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            case 'popular':
            default:
                $query->orderBy('reviews_count', 'desc');
                break;
        }

        $destinations = $query->paginate(24);
        $totalCount = Destination::count();

        return view('destinations.index', compact('destinations', 'category', 'region', 'keyword', 'sort', 'totalCount'));
    }

    public function show($slug)
    {
        $destination = Destination::where('slug', $slug)->firstOrFail();
        $relatedDestinations = Destination::where('id', '!=', $destination->id)
            ->where(function ($q) use ($destination) {
                $q->where('category', $destination->category)
                  ->orWhere('region', $destination->region);
            })
            ->take(3)
            ->get();

        return view('destinations.show', compact('destination', 'relatedDestinations'));
    }

    public function apiDetail($id)
    {
        $destination = Destination::findOrFail($id);

        return response()->json([
            'id' => $destination->id,
            'name' => $destination->name,
            'slug' => $destination->slug,
            'region' => $destination->region,
            'location' => $destination->location,
            'category' => $destination->category,
            'rating' => $destination->rating,
            'reviews_count' => $destination->reviews_count,
            'price' => $destination->price,
            'formatted_price' => $destination->formatted_price,
            'duration' => $destination->duration,
            'best_time' => $destination->best_time,
            'image' => $destination->image,
            'description' => $destination->description,
            'highlights' => $destination->highlights ?? [],
        ]);
    }
}
