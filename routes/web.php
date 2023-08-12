<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.mainPage');
});
Route::view('/addProduct', 'pages.addProduct')->middleware(['auth', 'admin']);
Route::post('/addProduct', [ProductController::class, 'addProduct'])->middleware(['auth', 'admin']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/shop', [ProductController::class, 'showProduct']);
Route::get('/shop/{id}', [ProductController::class, 'showSingleProduct']);
Route::get('/cart', [CartController::class, 'showCart'])->middleware('auth');
Route::get('/addCart/{productId}/{quantity}', [CartController::class, 'addCart'])->middleware('auth');
Route::get('/deleteCart/{cartId}', [CartController::class, 'deleteCart'])->middleware('auth');
Route::post('/changeQuantity', [CartController::class, 'changeQuantity'])->middleware('auth');
Route::post('/addReview', [ReviewController::class, 'addReview'])->middleware('auth');
Route::get('/getReviews/{productId}', [ReviewController::class, 'getReviews']);
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
