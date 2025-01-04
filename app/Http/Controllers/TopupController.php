<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TopUpHistory;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class TopUpController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    // Menampilkan halaman top-up dan histori
    public function index()
    {
        $user = auth()->user();
        $histories = TopUpHistory::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('topup.topup', compact('user', 'histories'));
    }

    // Proses membuat transaksi top-up
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|integer|min:10000', // Minimal Rp 10.000
        ]);

        $user = auth()->user();
        $amount = $request->amount;

        $user->balance += $amount;
        $user->save();

        // Simpan transaksi ke top_up_history
        $history = TopUpHistory::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'status' => 'sukses', // Awalnya pending
            'midtrans_transaction_id' => '', // Akan diupdate nanti
        ]);

        // Parameter untuk Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => $history->id,
                'gross_amount' => $amount,
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ],
        ];

        // Generate Snap Token
        $snapToken = Snap::getSnapToken($params);

        return response()->json([
            'snapToken' => $snapToken,
        ]);
    }
}

