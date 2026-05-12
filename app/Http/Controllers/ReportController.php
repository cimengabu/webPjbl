<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'location' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan foto ke folder storage/app/public/reports
        $path = $request->file('photo')->store('reports', 'public');

        Report::create([
            'user_name' => auth()->user()->name,
            'description' => $request->description,
            'location' => $request->location,
            'photo' => $path,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Laporan berhasil dikirim! Terima kasih sudah peduli lingkungan.');
    }
}