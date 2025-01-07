<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Booking;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'booking_id' => 'required|exists:bookings,id|unique:reviews,booking_id',
            'rate' => 'required|integer|min:1|max:5',
            'description' => 'required|string|max:255',
        ]);

        // Ambil data user yang sedang login
        $user = auth()->user();

        // Simpan review ke database
        $review = Review::create([
            'user_id' => $user->id,
            'booking_id' => $request->booking_id,
            'rate' => $request->rate,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Review berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'rate' => 'required|integer|min:1|max:5',
            'description' => 'required|string|max:255',
        ]);

        // Cari review berdasarkan ID
        $review = Review::findOrFail($id);

        // Pastikan hanya user yang membuat review dapat mengeditnya
        if ($review->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak diizinkan untuk mengedit review ini.');
        }

        // Update review
        $review->update([
            'rate' => $request->rate,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Review berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari review berdasarkan ID
        $review = Review::findOrFail($id);

        // Pastikan hanya user yang membuat review dapat menghapusnya
        if ($review->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Anda tidak diizinkan untuk menghapus review ini.');
        }

        // Hapus review
        $review->delete();

        return redirect()->back()->with('success', 'Review berhasil dihapus.');
    }
}
