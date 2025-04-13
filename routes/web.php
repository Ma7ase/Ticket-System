<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\createTicket;
use App\Http\Controllers\Authentication;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/create_ticket', [createTicket::class, 'addTicket'])->name('create.ticket');
Route::post('login-user',[Authentication::class,'loginUser'])->name('login-user');

Route::get('/verify-otp', function () {
    return view('verify-otp'); // assuming your view is named 'verify-otp'
})->name('verify-otp.show');

Route::post('/verify-otp', [Authentication::class, 'verifyOtp'])->name('verify-otp');

Route::get('/create_ticket', function () {
    return view('create_ticket'); // assuming your view is named 'verify-otp'
})->name('create_ticket.show');