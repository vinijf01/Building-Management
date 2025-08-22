<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'beranda']);

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





Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Products routes
Route::prefix('products')->name('products.')->group(function () {
    // Products list
    Route::get('/', function () {
        return view('products');
    })->name('list');

    // Product detail
    Route::get('/detail', function () {
        $product = (object) [
            'id' => 1, // ganti sesuai kebutuhan
            'title' => 'Luxury Downtown Loft',
            'description' => 'High ceilings and great city views with 3 bedrooms.',
            'bedrooms' => 3,
            'room_type' => 'exclusive',
            'price' => 2500,
            'image_url' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
        ];

        return view('productDetail', compact('product'));
    })->name('detail');
});


require __DIR__ . '/auth.php';
