<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReportController;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/destinations', [HomeController::class, 'destinations'])->name('public.destinations');
Route::get('/destination/{id}', [HomeController::class, 'show'])->name('public.destination.show');
Route::post('/destination/{id}/review', [HomeController::class, 'storeReview'])->name('destination.review.store');
Route::get('/api/destinations/{id}/capacity', [HomeController::class, 'checkCapacity'])->name('api.destinations.capacity');

Route::middleware('guest')->group(function (){
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    
    // Favorites
    Route::get('/favorites', [\App\Http\Controllers\FavoriteController::class, 'index'])->name('favorites.index');
    Route::post('/favorites/toggle/{destination}', [\App\Http\Controllers\FavoriteController::class, 'toggle'])->name('favorites.toggle');
    Route::get('/favorites/check/{destination}', [\App\Http\Controllers\FavoriteController::class, 'check'])->name('favorites.check');
    
    // Bookings
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/create/{destination}', [BookingController::class, 'create'])->name('bookings.create');
    Route::post('/bookings/{destination}', [BookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
    Route::post('/bookings/{id}/cancel', [BookingController::class, 'cancel'])->name('bookings.cancel');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function (){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('destinations', DestinationController::class);
    Route::resource('galleries', GalleryController::class);
    Route::resource('reviews', ReviewController::class);
    Route::resource('users', UserController::class);
    
    // Admin Bookings Management
    Route::get('/bookings', [BookingController::class, 'adminIndex'])->name('admin.bookings.index');
    Route::post('/bookings/{id}/status', [BookingController::class, 'updateStatus'])->name('admin.bookings.updateStatus');

    // Reports
    Route::get('/reports/bookings', [ReportController::class, 'bookings'])->name('admin.reports.bookings');
    Route::get('/reports/bookings/print', [ReportController::class, 'bookingsPrint'])->name('admin.reports.bookings.print');
});