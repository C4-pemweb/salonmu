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
    // Validasi input
    $request->validate([
        'amount' => 'required|integer|min:10000', // Minimal Rp 10.000
    ]);

    // Ambil data user yang sedang login
    $user = auth()->user();
    $amount = $request->amount;

    // Parameter untuk Midtrans
    $params = [
        'transaction_details' => [
            'order_id' => 'topup_' . uniqid(), // Unik ID untuk order_id
            'gross_amount' => $amount,
        ],
        'customer_details' => [
            'first_name' => $user->name,
            'email' => $user->email,
        ],
    ];

    try {
        // Generate Snap Token
        $snapToken = Snap::getSnapToken($params);

        // Jika Snap Token berhasil, simpan transaksi ke top_up_history
        $history = TopUpHistory::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'status' => 'sukses', // Status awal adalah pending
            'midtrans_transaction_id' => '', // Akan diupdate nanti
        ]);

        // Update saldo pengguna
        $user->balance += $amount;
        $user->save();

        // Kembalikan Snap Token sebagai respons
        return response()->json([
            'snapToken' => $snapToken,
        ]);
        
    } catch (\Exception $e) {
        // Jika terjadi error saat pembuatan Snap Token
        return response()->json([
            'error' => 'Gagal membuat Snap Token: ' . $e->getMessage(),
        ], 500);
    }
}

}

