<?php

namespace App\Http\Controllers;

use App\Models\Update; // Memanggil model Update yang tadi kita buat
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function index()
    {
        // Mengambil 1 data terbaru dari tabel updates
        $latestUpdate = Update::latest()->first();

        // Mengirim data tersebut ke file welcome.blade.php
        return view('welcome', compact('latestUpdate'));
    }
}