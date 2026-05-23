<?php

namespace App\Http\Controllers;

use App\Models\EcoTrack;
use App\Models\Update;  
use Illuminate\Http\Request;

class EcoTrackController extends Controller
{
    /**
     * Menampilkan Dashboard Utama
     */
    public function index()
    {
        if (auth()->check()) {
            $tracks = EcoTrack::where('user_id', auth()->id())->latest()->get();
        } else {
            $tracks = EcoTrack::latest()->take(10)->get();
        }
        // Mengambil data update terbaru untuk tampilan banner
        $latestUpdate = Update::latest()->first(); 
        
        $totalPoints = auth()->check() ? auth()->user()->total_points : 0;
        
        // Ambil 3 artikel terbaru
        $articles = \App\Models\Article::latest()->take(3)->get();

        // Hitung total berat (Total Sampah), mengecualikan yang Rejected
        $totalWeight = EcoTrack::where('status', '!=', 'Rejected')->sum('weight');

        return view('ecotrack.index', compact('tracks', 'latestUpdate', 'totalPoints', 'articles', 'totalWeight'));
    }

    /**
     * Menyimpan data deposit baru (Fitur Execute Deposit)
     */
    public function store(Request $request)
    {
        $request->validate([
            'item_name' => 'required',
            'qr_code' => 'required|unique:eco_tracks',
            'weight' => 'required|numeric',
        ]);

        // Misal: 1kg = 3000 poin
        $totalPoints = $request->weight * 3000;

        EcoTrack::create([
            'user_id' => auth()->id(), // Supaya poin masuk ke akun yang login
            'item_name' => $request->item_name,
            'qr_code' => $request->qr_code,
            'status' => 'AI Optimized',
            'weight' => $request->weight,
            'points' => $totalPoints,
        ]);

        // Tambahkan ke total_points user
        $user = auth()->user();
        $user->total_points += $totalPoints;
        $user->save();

        return redirect()->back()->with('success', 'DEPOSIT SUCCESS: Points has been added to your account.');
    }

    public function destroy($id)
    {
        $track = EcoTrack::findOrFail($id);

        // Pastikan yang menghapus adalah admin atau pemilik deposit
        if (auth()->user()->is_admin || auth()->id() === $track->user_id) {
            // Kurangi poin user jika deposit dihapus (mencegah abuse)
            if ($track->user_id) {
                $user = \App\Models\User::find($track->user_id);
                if ($user) {
                    $user->total_points -= $track->points;
                    $user->save();
                }
            }

            $track->delete();
            return redirect()->route('ecotrack.index')->with('success', 'PROTOCOL TERMINATED: Record has been removed from system.');
        }

        abort(403, 'Unauthorized action.');
    }
}