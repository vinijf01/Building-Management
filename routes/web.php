<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'beranda']);

Route::get('/book/{slug}', function ($slug) {
    if (!Auth::check()) {
        return redirect()->route('login'); // belum login → ke login
    }
    // sudah login → arahkan ke booking detail berdasarkan slug
    return redirect()->route('booking.show', $slug);
})->name('book.now');

Route::get('/booking/{slug}', [UserController::class, 'show'])->middleware('auth')->name('booking.show');






Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('products')->name('products.')->group(function () {
    // Products list
    Route::get('/', function () {
        return view('products'); 
    })->name('list');
    Route::get('/detail', function () {
         $product = (object)[
        'id' => 1, // ganti sesuai kebutuhan
        'title' => 'Luxury Downtown Loft',
        'description' => 'High ceilings and great city views with 3 bedrooms.',
        'bedrooms' => 3,
        'room_type' => 'exclusive',
        'price' => 2500,
        'image_url' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
        ];

    return view('productDetail', compact('product'));
    })->name('/detail');

    // Product detail
    // Route::get('/', function () {
    //     $product = (object)[
    //         'id' => $id,
    //         'title' => 'Luxury Downtown Loft',
    //         'description' => 'High ceilings and great city views with 3 bedrooms.',
    //         'bedrooms' => 3,
    //         'room_type' => 'exclusive',
    //         'price' => 2500,
    //         'image_url' => 'https://images.unsplash.com/photo-1472220625704-91e1462799b2?auto=format&fit=crop&w=600&q=80',
    //     ];

    //     return view('products.detail', compact('product'));
    // })->name('detail');
});


require __DIR__.'/auth.php';
