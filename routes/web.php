<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [UserController::class, 'beranda'])->name('home');

Route::get('/contact-us', function () {
    return view('contact-us'); 
})->name('contact-us');

Route::get('/faq', function () {
    return view('faq'); 
})->name('faq');

Route::get('/detail/{slug}', [UserController::class, 'show'])
    ->name('detail');

Route::get('/products', [UserController::class, 'collection'])->name('products.list');

// Booking routes
Route::middleware('auth')
    ->prefix('booking')
    ->name('booking.')
    ->controller(UserController::class)
    ->group(function () {
        Route::get('{slug}', 'bookingForm')->name('form');                                      // /booking/{slug}
        Route::post('{slug}', 'bookingSave')->name('save');                                     // /booking/{slug}
        Route::get('{id}/payment', 'bookingPayment')->name('payment');                          // /booking/{id}/payment
        Route::post('{booking}/payment/proof', 'uploadPaymentProof')->name('payment.proof');    // /booking/{booking}/payment/proof
    });

Route::middleware(['auth'])->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactionHistory');
});
Route::delete('/transactions/{id}', [TransactionController::class, 'destroy'])
    ->name('transactions.destroy');

Route::get('/transactions/{id}/receipt', [TransactionController::class, 'showReceipt'])
    ->name('transactions.receipt');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
