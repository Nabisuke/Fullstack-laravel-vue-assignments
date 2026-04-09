<?php
use App\Http\Controllers\TicketBookingController;
use Illuminate\Support\Facades\Route;

Route::get('ticketbooking', [TicketBookingController::class, 'send']);