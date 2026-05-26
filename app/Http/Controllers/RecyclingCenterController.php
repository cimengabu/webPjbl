<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RecyclingCenter;

class RecyclingCenterController extends Controller
{
    public function index()
    {
        $centers = RecyclingCenter::all();
        return view('recycling-centers.index', compact('centers'));
    }

    /**
     * API: Cari bank sampah terdekat berdasarkan koordinat user
     * Menghitung jarak dengan Haversine formula
     */
    public function nearby(Request $request)
    {
        $request->validate([
            'lat'    => 'required|numeric|between:-90,90',
            'lng'    => 'required|numeric|between:-180,180',
            'radius' => 'nullable|numeric|min:0.1|max:5000', // km
        ]);

        $userLat  = (float) $request->lat;
        $userLng  = (float) $request->lng;
        $radius   = (float) ($request->radius ?? 10); // default 10 km

        $centers = RecyclingCenter::all()->map(function ($center) use ($userLat, $userLng) {
            $dist = $this->haversine($userLat, $userLng, (float)$center->latitude, (float)$center->longitude);
            $center->distance_km = round($dist, 2);
            return $center;
        })
        ->filter(fn($c) => $c->distance_km <= $radius)
        ->sortBy('distance_km')
        ->values();

        return response()->json([
            'success' => true,
            'user_lat' => $userLat,
            'user_lng' => $userLng,
            'radius_km' => $radius,
            'count' => $centers->count(),
            'centers' => $centers,
        ]);
    }

    /**
     * Haversine formula — hitung jarak antara dua koordinat (dalam km)
     */
    private function haversine(float $lat1, float $lng1, float $lat2, float $lng2): float
    {
        $earthRadius = 6371; // km
        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) ** 2
           + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng / 2) ** 2;

        return $earthRadius * 2 * asin(sqrt($a));
    }
}
