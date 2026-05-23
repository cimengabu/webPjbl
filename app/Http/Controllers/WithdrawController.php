<?php

namespace App\Http\Controllers;

use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'method' => 'required|string',
            'amount' => 'required|integer|min:50',
            'account_number' => 'required|string',
            'account_name' => 'required|string',
        ]);

        $user = auth()->user();

        if ($user->total_points < $request->amount) {
            return back()->with('error', 'Poin Anda tidak mencukupi untuk melakukan penarikan ini.');
        }

        // Deduct points
        $user->total_points -= $request->amount;
        $user->save();

        // Calculate Rp (1 Poin = Rp 1)
        $amountRp = $request->amount;

        // Create withdraw record (Otomatis selesai agar terasa seperti uang asli)
        Withdraw::create([
            'user_id' => $user->id,
            'method' => $request->method,
            'amount' => $request->amount,
            'amount_rp' => $amountRp,
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'status' => 'Completed'
        ]);

        return back()->with('success', 'TRANSAKSI BERHASIL: Dana sebesar Rp ' . number_format($amountRp, 0, ',', '.') . ' telah sukses ditransfer ke rekening ' . $request->method . ' (' . $request->account_number . ') atas nama ' . $request->account_name . '. Silakan cek mutasi rekening Anda.');
    }
}
