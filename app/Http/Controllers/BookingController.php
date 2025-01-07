<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
         // Dapatkan pengguna yang sedang login
         $user = Auth::user();
     
         // Cek role pengguna
         if ($user->role === 'customer') {
            $bookings = Booking::with(['user', 'employee', 'service'])
                 ->where('user_id', $user->id)
                 ->latest()
                 ->get();
         } else {
             // Jika admin, tampilkan semua booking
             $bookings = Booking::with(['user', 'employee', 'service'])->latest()->get();
         }
     
         return view('book.book', compact('bookings'));
     }

     public function accept(Booking $booking)
    {
        // Validasi apakah booking sudah memiliki status "diterima" atau "batal"
        if ($booking->status === 'diterima' || $booking->status === 'batal') {
            return redirect()->back()->with('error', 'Booking sudah diproses sebelumnya.');
        }

        // Ambil user yang melakukan booking
        $user = $booking->user;

        // Kurangi saldo user dengan harga layanan
        if ($user->balance < $booking->service->price) {
            return redirect()->back()->with('error', 'Saldo pengguna tidak mencukupi.');
        }

        $user->balance -= $booking->service->price;
        $user->save();

        // Ubah status booking menjadi "diterima"
        $booking->update([
            'status' => 'diterima',
        ]);

        return redirect()->back()->with('success', 'Booking berhasil diterima.');
    }

    public function cancel(Booking $booking)
    {
        // Validasi apakah booking sudah memiliki status "diterima" atau "batal"
        if ($booking->status === 'diterima' || $booking->status === 'dibatal') {
            return redirect()->back()->with('error', 'Booking sudah diproses sebelumnya.');
        }

        // Ubah status booking menjadi "batal"
        $booking->update([
            'status' => 'dibatalkan',
        ]);

        return redirect()->back()->with('success', 'Booking berhasil dibatalkan.');
    }

    public function complete(Booking $booking)
    {
        // Validasi apakah booking sudah memiliki status "diterima" atau "batal"
        // if ($booking->status === 'dibatalkan') {
        //     return redirect()->back()->with('error', 'Booking sudah diproses sebelumnya.');
        // }

        // Ubah status booking menjadi "batal"
        $booking->update([
            'status' => 'selesai',
        ]);

        return redirect()->back()->with('success', 'Booking berhasil selesai.');
    }
     

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::all(); // Mengambil semua service
        $employees = User::where('role', 'employee')->get(); // Mengambil karyawan
        $users = User::where('role', 'customer')->get(); // Mengambil customer

        return view('bookings.create', compact('services', 'employees', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
            'service_id' => 'required|exists:services,id',
            'user_id' => 'required|exists:users,id',
            'employee_id' => 'required|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'status' => 'required|in:selesai,pending,diterima',
        ]);

        Booking::create([
            'user_id' => $request->user_id,
            'service_id' => $request->service_id,
            'employee_id' => $request->employee_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Booking berhasil dibuat.');
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
    public function update(Request $request, string $id)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'user_id' => 'required|exists:users,id',
            'employee_id' => 'required|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'status' => 'required|in:selesai,pending,diterima',
        ]);

        $booking->update($request->all());

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking->delete();

        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dihapus.');
    }

}
