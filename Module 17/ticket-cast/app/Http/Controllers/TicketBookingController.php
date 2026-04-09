<?php

namespace App\Http\Controllers;
use App\Events\MyCustomNotification;
use Illuminate\Http\Request;

class TicketBookingController extends Controller
{
    public function send(Request $request)
    {
        // Triggering the broadcast
        $message = $request->query('message');
        if (!$message) {
            $message = 'A ticket was booked for You';
        }

        event(new MyCustomNotification($message));

        return response()->json([
            'status' => 'success',
            'message' => 'Event fired!'
        ]);
    }
}
