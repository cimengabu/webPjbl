<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use App\Models\Withdraw;
use App\Models\Report;
use App\Models\EcoTrack;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Fetch data differently based on user role
        if ($user->is_admin) {
            $deposits = EcoTrack::latest()->get();
            $pickups = Pickup::with('user')->latest()->get();
            $withdrawals = Withdraw::with('user')->latest()->get();
            $reports = Report::latest()->get();
        } else {
            // Get user's own deposits
            $deposits = EcoTrack::where('user_id', $user->id)->latest()->get();

            // Get user's own pickups
            $pickups = Pickup::where('user_id', $user->id)->latest()->get();

            // Get user's own withdrawals
            $withdrawals = Withdraw::where('user_id', $user->id)->latest()->get();

            // Get user's own facility reports (matched by username as per reports schema)
            $reports = Report::where('user_name', $user->name)->latest()->get();
        }

        // Calculate total weight (completed pickups + deposits)
        $depositWeight = $deposits->sum('weight');
        $pickupWeight = $pickups->where('status', 'Completed')->sum('weight');
        $totalWeight = $depositWeight + $pickupWeight;

        // CO2 offset estimate: 1.2 kg of CO2 saved per 1 kg of recycled waste
        $carbonSaved = $totalWeight * 1.2;

        // Hitung streak harian dari aktivitas deposit menggunakan collection map untuk kompabilitas cross-database
        $streak = EcoTrack::where('user_id', $user->id)
                    ->get()
                    ->groupBy(function($item) {
                        return $item->created_at->format('Y-m-d');
                    })
                    ->count();

        return view('dashboard', compact('deposits', 'pickups', 'withdrawals', 'reports', 'carbonSaved', 'totalWeight', 'streak'));
    }
}
