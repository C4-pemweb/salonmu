<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Kirim notifikasi ke employee ketika ada customer yang melakukan booking.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendNotificationForBooking(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'employee_id' => 'required|exists:users,id', // Pastikan employee ada
            'customer_id' => 'required|exists:users,id',  // Pastikan customer ada
            'message' => 'required|string',
        ]);

        // Mendapatkan data employee dan customer
        $employee = User::findOrFail($validated['employee_id']);
        $customer = User::findOrFail($validated['customer_id']);

        // Buat notifikasi untuk employee
        $notification = Notification::create([
            'user_id' => $employee->id,
            'title' => 'Booking Baru',
            'message' => $validated['message'],
            'is_read' => false,
        ]);

        // Kirim response sukses
        return response()->json([
            'success' => true,
            'notification' => $notification
        ]);
    }

    /**
     * Ambil notifikasi untuk user tertentu (misalnya employee).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getNotifications(Request $request)
{
    $userId = Auth::id();

    // Mendapatkan filter dari request
    $filter = $request->input('filter', 'all'); // Default: all

    // Query notifikasi berdasarkan filter
    $query = Notification::where('user_id', $userId);
    if ($filter === 'read') {
        $query->where('is_read', true);
    } elseif ($filter === 'unread') {
        $query->where('is_read', false);
    }
    $notifications = $query->orderBy('created_at', 'desc')->get();

    // Kirim notifikasi ke view
    return view('notif.notif', compact('notifications'));
}


    public function getUnreadNotifications(Request $request)
    {
        // Ambil notifikasi yang belum dibaca untuk user yang sedang login
        $userId = Auth::id();
        $unreadNotifications = Notification::where('user_id', $userId)
                                           ->where('is_read', false)
                                           ->orderBy('created_at', 'desc')
                                           ->get();

        return response()->json($unreadNotifications);
    }


    /**
     * Tandai notifikasi sebagai sudah dibaca.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function markAsRead($id)
{
    $notification = Notification::where('id', $id)->where('user_id', auth()->id())->first();

    if (!$notification) {
        return response()->json(['message' => 'Notifikasi tidak ditemukan'], 404);
    }

    $notification->update(['is_read' => true]);

    return response()->json(['message' => 'Notifikasi berhasil ditandai sebagai telah dibaca']);
}

}
