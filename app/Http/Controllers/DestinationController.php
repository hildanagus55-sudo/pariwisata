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

        if ($region && $region !== 'Semua' && $region !== 'Semua Provinsi di Indonesia' && $region !== 'All Provinces in Indonesia' && $region !== 'Semua Wilayah Nusantara' && $region !== 'All Indonesian Archipelago') {
            $aliases = [$region];
            if (stripos($region, 'Nusa Tenggara Timur') !== false || stripos($region, 'NTT') !== false) {
                $aliases = array_merge($aliases, ['NTT', 'Labuan Bajo', 'Sumba', 'Flores', 'Komodo', 'Wae Rebo']);
            }
            if (stripos($region, 'Nusa Tenggara Barat') !== false || stripos($region, 'NTB') !== false) {
                $aliases = array_merge($aliases, ['NTB', 'Lombok', 'Rinjani', 'Mandalika', 'Gili']);
            }
            if (stripos($region, 'Yogyakarta') !== false || stripos($region, 'Jogja') !== false) {
                $aliases = array_merge($aliases, ['Yogyakarta', 'Jogja', 'DIY', 'Malioboro', 'Prambanan']);
            }
            if (stripos($region, 'DKI Jakarta') !== false || stripos($region, 'Jakarta') !== false) {
                $aliases = array_merge($aliases, ['Jakarta', 'DKI', 'Kepulauan Seribu']);
            }
            if (stripos($region, 'Jawa Tengah') !== false) {
                $aliases = array_merge($aliases, ['Jawa Tengah', 'Borobudur', 'Dieng', 'Magelang', 'Karimunjawa', 'Jepara', 'Solo']);
            }
            if (stripos($region, 'Jawa Timur') !== false) {
                $aliases = array_merge($aliases, ['Jawa Timur', 'Bromo', 'Ijen', 'Banyuwangi', 'Malang']);
            }
            if (stripos($region, 'Bali') !== false) {
                $aliases = array_merge($aliases, ['Bali', 'Nusa Penida', 'Ubud', 'Kelingking']);
            }
            if (stripos($region, 'Papua Barat Daya') !== false) {
                $aliases = array_merge($aliases, ['Papua Barat Daya', 'Raja Ampat', 'Sorong', 'Wayag', 'Piaynemo']);
            }
            if (stripos($region, 'Papua Pegunungan') !== false) {
                $aliases = array_merge($aliases, ['Papua Pegunungan', 'Lembah Baliem', 'Wamena']);
            }
            if (stripos($region, 'Kalimantan Timur') !== false) {
                $aliases = array_merge($aliases, ['Kalimantan Timur', 'Derawan', 'Maratua', 'Kakaban', 'Berau']);
            }
            if (stripos($region, 'Kalimantan Tengah') !== false) {
                $aliases = array_merge($aliases, ['Kalimantan Tengah', 'Tanjung Puting', 'Sekonyer']);
            }
            if (stripos($region, 'Sulawesi Selatan') !== false) {
                $aliases = array_merge($aliases, ['Sulawesi Selatan', 'Toraja', 'Lolai', 'Makassar']);
            }
            if (stripos($region, 'Sulawesi Utara') !== false) {
                $aliases = array_merge($aliases, ['Sulawesi Utara', 'Bunaken', 'Manado']);
            }
            if (stripos($region, 'Sumatera Utara') !== false) {
                $aliases = array_merge($aliases, ['Sumatera Utara', 'Toba', 'Samosir']);
            }
            if (stripos($region, 'Sumatera Barat') !== false) {
                $aliases = array_merge($aliases, ['Sumatera Barat', 'Harau', 'Bukittinggi', 'Sianok']);
            }
            if (stripos($region, 'Maluku') !== false) {
                $aliases = array_merge($aliases, ['Maluku', 'Banda Neira', 'Kei', 'Ngurbloat']);
            }

            $query->where(function ($q) use ($aliases) {
                foreach ($aliases as $alias) {
                    $q->orWhere('region', 'like', "%{$alias}%")
                      ->orWhere('location', 'like', "%{$alias}%")
                      ->orWhere('name', 'like', "%{$alias}%");
                }
            });
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
