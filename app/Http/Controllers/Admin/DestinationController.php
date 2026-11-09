<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DestinationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $category = $request->query('category');
        $region = $request->query('region');

        $query = Destination::latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('region', 'like', "%{$search}%");
            });
        }

        if ($category && $category !== 'all') {
            $query->where('category', $category);
        }

        if ($region && $region !== 'all') {
            $query->where('region', $region);
        }

        $destinations = $query->paginate(12)->withQueryString();
        $categories = Destination::select('category')->distinct()->pluck('category');
        $regions = Destination::select('region')->distinct()->pluck('region');

        return view('admin.destinations.index', compact('destinations', 'search', 'category', 'region', 'categories', 'regions'));
    }

    public function create()
    {
        $categories = ['Bahari', 'Pegunungan', 'Budaya & Sejarah', 'Satwa & Alam Liar', 'Petualangan', 'Religi'];
        $regions = [
            'Bali', 'Nusa Tenggara Barat', 'Nusa Tenggara Timur', 'D.I. Yogyakarta', 'Jawa Tengah',
            'Jawa Timur', 'Jawa Barat', 'DKI Jakarta', 'Banten', 'Sumatera Utara', 'Sumatera Barat',
            'Aceh', 'Riau & Kepri', 'Sumatera Selatan & Lampung', 'Kalimantan Timur', 'Kalimantan Tengah',
            'Kalimantan Barat & Selatan', 'Sulawesi Selatan', 'Sulawesi Utara', 'Sulawesi Tenggara',
            'Maluku', 'Maluku Utara', 'Papua Barat Daya', 'Papua Pegunungan', 'Papua'
        ];

        return view('admin.destinations.create', compact('categories', 'regions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'region' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:100',
            'best_time' => 'required|string|max:100',
            'rating' => 'nullable|numeric|min:1|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'image' => 'required|url|max:500',
            'description' => 'required|string',
            'highlights' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        // Generate slug
        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $counter = 1;
        while (Destination::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        // Parse highlights array from textarea (separated by newline)
        $highlightsArray = [];
        if (!empty($validated['highlights'])) {
            $lines = explode("\n", $validated['highlights']);
            foreach ($lines as $line) {
                $trimmed = trim($line);
                if (!empty($trimmed)) {
                    $highlightsArray[] = ltrim($trimmed, '-*• ');
                }
            }
        }

        Destination::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'region' => $validated['region'],
            'location' => $validated['location'],
            'category' => $validated['category'],
            'price' => (int) $validated['price'],
            'duration' => $validated['duration'],
            'best_time' => $validated['best_time'],
            'rating' => $validated['rating'] ?? 5.0,
            'reviews_count' => $validated['reviews_count'] ?? 1,
            'image' => $validated['image'],
            'description' => $validated['description'],
            'highlights' => $highlightsArray,
            'is_featured' => !empty($request->is_featured),
        ]);

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi wisata "' . $validated['name'] . '" berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $destination = Destination::findOrFail($id);
        $categories = ['Bahari', 'Pegunungan', 'Budaya & Sejarah', 'Satwa & Alam Liar', 'Petualangan', 'Religi'];
        $regions = [
            'Bali', 'Nusa Tenggara Barat', 'Nusa Tenggara Timur', 'D.I. Yogyakarta', 'Jawa Tengah',
            'Jawa Timur', 'Jawa Barat', 'DKI Jakarta', 'Banten', 'Sumatera Utara', 'Sumatera Barat',
            'Aceh', 'Riau & Kepri', 'Sumatera Selatan & Lampung', 'Kalimantan Timur', 'Kalimantan Tengah',
            'Kalimantan Barat & Selatan', 'Sulawesi Selatan', 'Sulawesi Utara', 'Sulawesi Tenggara',
            'Maluku', 'Maluku Utara', 'Papua Barat Daya', 'Papua Pegunungan', 'Papua'
        ];

        return view('admin.destinations.edit', compact('destination', 'categories', 'regions'));
    }

    public function update(Request $request, $id)
    {
        $destination = Destination::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'region' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:100',
            'best_time' => 'required|string|max:100',
            'rating' => 'nullable|numeric|min:1|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'image' => 'required|url|max:500',
            'description' => 'required|string',
            'highlights' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        // If name changed, update slug
        if ($destination->name !== $validated['name']) {
            $baseSlug = Str::slug($validated['name']);
            $slug = $baseSlug;
            $counter = 1;
            while (Destination::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }
            $destination->slug = $slug;
        }

        // Parse highlights
        $highlightsArray = [];
        if (!empty($validated['highlights'])) {
            $lines = explode("\n", $validated['highlights']);
            foreach ($lines as $line) {
                $trimmed = trim($line);
                if (!empty($trimmed)) {
                    $highlightsArray[] = ltrim($trimmed, '-*• ');
                }
            }
        }

        $destination->update([
            'name' => $validated['name'],
            'region' => $validated['region'],
            'location' => $validated['location'],
            'category' => $validated['category'],
            'price' => (int) $validated['price'],
            'duration' => $validated['duration'],
            'best_time' => $validated['best_time'],
            'rating' => $validated['rating'] ?? $destination->rating,
            'reviews_count' => $validated['reviews_count'] ?? $destination->reviews_count,
            'image' => $validated['image'],
            'description' => $validated['description'],
            'highlights' => $highlightsArray,
            'is_featured' => !empty($request->is_featured),
        ]);

        return redirect()->route('admin.destinations.index')->with('success', 'Data destinasi "' . $destination->name . '" berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $destination = Destination::findOrFail($id);
        $name = $destination->name;
        $destination->delete();

        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi "' . $name . '" berhasil dihapus.');
    }
}
