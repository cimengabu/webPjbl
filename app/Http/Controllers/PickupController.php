<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use Illuminate\Http\Request;

class PickupController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'pickup_date' => 'required|date|after_or_equal:today',
            'weight' => 'required|numeric|min:1',
            'address' => 'required|string|max:1000'
        ]);

        Pickup::create([
            'user_id' => auth()->id(),
            'pickup_date' => $request->pickup_date,
            'weight' => $request->weight,
            'address' => $request->address,
            'status' => 'Pending'
        ]);

        return back()->with('success', 'Permintaan penjemputan berhasil dibuat. Tim kami akan segera menghubungi Anda.');
    }
}
