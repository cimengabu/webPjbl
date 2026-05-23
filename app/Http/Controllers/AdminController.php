<?php

namespace App\Http\Controllers;

use App\Models\Pickup;
use App\Models\Withdraw;
use App\Models\Report;
use App\Models\EcoTrack;
use App\Models\Article;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Enforce admin check for all requests in this controller.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            abort_unless(auth()->check() && auth()->user()->is_admin, 403, 'Unauthorized. Admin access only.');
            return $next($request);
        });
    }

    /**
     * Display the Admin Command Center
     */
    public function index()
    {
        $deposits = EcoTrack::latest()->get();
        $pickups = Pickup::with('user')->latest()->get();
        $withdrawals = Withdraw::with('user')->latest()->get();
        $reports = Report::latest()->get();
        $articles = Article::latest()->get();

        return view('admin.dashboard', compact('deposits', 'pickups', 'withdrawals', 'reports', 'articles'));
    }

    /**
     * Update the status of a pickup request
     */
    public function updatePickupStatus(Request $request, Pickup $pickup)
    {
        $request->validate([
            'status' => 'required|in:Pending,Scheduled,Completed,Cancelled'
        ]);

        $pickup->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status penjemputan berhasil diperbarui menjadi ' . $request->status);
    }

    /**
     * Update the status of a withdrawal request
     */
    public function updateWithdrawStatus(Request $request, Withdraw $withdraw)
    {
        $request->validate([
            'status' => 'required|in:Pending,Completed,Rejected'
        ]);

        // If rejection from pending state, refund points to user
        if ($request->status === 'Rejected' && $withdraw->status === 'Pending') {
            $user = $withdraw->user;
            $user->total_points += $withdraw->amount;
            $user->save();
        }

        $withdraw->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status penarikan berhasil diperbarui menjadi ' . $request->status);
    }

    /**
     * Update the status of a facility report
     */
    public function updateReportStatus(Request $request, Report $report)
    {
        $request->validate([
            'status' => 'required|in:pending,process,resolved'
        ]);

        $report->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status laporan fasilitas berhasil diperbarui menjadi ' . $request->status);
    }

    /**
     * Update the status of an EcoTrack deposit
     */
    public function updateDepositStatus(Request $request, EcoTrack $ecotrack)
    {
        $request->validate([
            'status' => 'required|in:Pending,AI Optimized,Verified,Completed,Rejected'
        ]);

        $ecotrack->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status deposit EcoTrack berhasil diperbarui menjadi ' . $request->status);
    }
}
