<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', [UserController::class, 'beranda']);

Route::get('/dashboard', [UserController::class, 'beranda'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/contact-us', function () {
    return view('contact-us'); // ganti 'nama_view' dengan nama file blade
})->name('contact-us');

Route::get('/booking', function () {
    return view('BookingForm'); // ganti 'nama_view' dengan nama file blade
});

Route::get('/detail/{slug}', [UserController::class, 'show'])
    ->name('detail');


// Route::get('/detail/{slug}', function ($slug) {
//     if (!Auth::check()) {
//         return redirect()->route('login'); // belum login → ke login
//     }
//     // sudah login → arahkan ke booking detail berdasarkan slug
//     return redirect()->route('detail.show', $slug);
// })->name('detail');

// Route::get('/detail/{slug}', [UserController::class, 'show'])->middleware('auth')->name('detail.show');


Route::get('/products', [UserController::class, 'collection'])->name('products.list');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
