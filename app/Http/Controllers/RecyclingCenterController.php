<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecyclingCenterController extends Controller
{
    public function index()
    {
        $centers = \App\Models\RecyclingCenter::all();
        return view('recycling-centers.index', compact('centers'));
    }
}
