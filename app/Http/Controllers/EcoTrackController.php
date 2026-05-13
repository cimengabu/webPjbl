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
        $tracks = EcoTrack::latest()->get();
        // Mengambil data update terbaru untuk tampilan banner
        $latestUpdate = Update::latest()->first(); 
        
        return view('ecotrack.index', compact('tracks', 'latestUpdate'));
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

    return redirect()->back()->with('success', 'DEPOSIT SUCCESS: Points has been added to your account.');
}

    /**
     * Menghapus data (Fitur Terminate)
     */
    public function destroy($id)
    {
        $track = EcoTrack::findOrFail($id);
        $track->delete();

        return redirect()->route('ecotrack.index')->with('success', 'PROTOCOL TERMINATED: Record has been removed from system.');
    }
}