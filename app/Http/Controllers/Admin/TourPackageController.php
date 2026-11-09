<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TourPackageController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = TourPackage::latest();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('badge', 'like', "%{$search}%")
                  ->orWhere('hotel', 'like', "%{$search}%")
                  ->orWhere('duration', 'like', "%{$search}%");
            });
        }

        $packages = $query->paginate(10)->withQueryString();

        return view('admin.packages.index', compact('packages', 'search'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'badge' => 'required|string|max:100',
            'duration' => 'required|string|max:100',
            'hotel' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'facilities' => 'required|string',
            'is_featured' => 'nullable|boolean',
        ]);

        $baseSlug = Str::slug($validated['name']);
        $slug = $baseSlug;
        $counter = 1;
        while (TourPackage::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        $facilitiesArray = [];
        $lines = explode("\n", $validated['facilities']);
        foreach ($lines as $line) {
            $trimmed = trim($line);
            if (!empty($trimmed)) {
                $facilitiesArray[] = ltrim($trimmed, '-*• ');
            }
        }

        TourPackage::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'badge' => $validated['badge'],
            'duration' => $validated['duration'],
            'hotel' => $validated['hotel'],
            'price' => (int) $validated['price'],
            'original_price' => $validated['original_price'] ? (int) $validated['original_price'] : null,
            'facilities' => $facilitiesArray,
            'is_featured' => !empty($request->is_featured),
        ]);

        return redirect()->route('admin.packages.index')->with('success', 'Paket wisata "' . $validated['name'] . '" berhasil dibuat.');
    }

    public function edit($id)
    {
        $package = TourPackage::findOrFail($id);
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, $id)
    {
        $package = TourPackage::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'badge' => 'required|string|max:100',
            'duration' => 'required|string|max:100',
            'hotel' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'facilities' => 'required|string',
            'is_featured' => 'nullable|boolean',
        ]);

        if ($package->name !== $validated['name']) {
            $baseSlug = Str::slug($validated['name']);
            $slug = $baseSlug;
            $counter = 1;
            while (TourPackage::where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = "{$baseSlug}-{$counter}";
                $counter++;
            }
            $package->slug = $slug;
        }

        $facilitiesArray = [];
        $lines = explode("\n", $validated['facilities']);
        foreach ($lines as $line) {
            $trimmed = trim($line);
            if (!empty($trimmed)) {
                $facilitiesArray[] = ltrim($trimmed, '-*• ');
            }
        }

        $package->update([
            'name' => $validated['name'],
            'badge' => $validated['badge'],
            'duration' => $validated['duration'],
            'hotel' => $validated['hotel'],
            'price' => (int) $validated['price'],
            'original_price' => $validated['original_price'] ? (int) $validated['original_price'] : null,
            'facilities' => $facilitiesArray,
            'is_featured' => !empty($request->is_featured),
        ]);

        return redirect()->route('admin.packages.index')->with('success', 'Paket wisata "' . $package->name . '" berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $package = TourPackage::findOrFail($id);
        $name = $package->name;
        $package->delete();

        return redirect()->route('admin.packages.index')->with('success', 'Paket wisata "' . $name . '" berhasil dihapus.');
    }
}
