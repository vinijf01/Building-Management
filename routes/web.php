<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', [UserController::class, 'beranda'])->name('home');

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

Route::get('/transaction-history', function () {
    return view('transactionHistory'); // ganti 'nama_view' dengan nama file blade
})->name('transactionHistory');

Route::get('/contact-us', function () {
    return view('contact-us'); // ganti 'nama_view' dengan nama file blade
})->name('contact-us');

Route::get('/detail/{slug}', [UserController::class, 'show'])
    ->name('detail');

Route::get('/products', [UserController::class, 'collection'])->name('products.list');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
