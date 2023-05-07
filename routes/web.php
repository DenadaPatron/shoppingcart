<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::Get('/',[ClientController::class, 'home']);
    Route::Get('/shop', [ClientController::class, 'shop']);
    Route::Get('/cart', [ClientController::class, 'cart']);
    Route::Get('/checkout', [ClientController::class, 'checkout']);
    Route::Get('/login', [ClientController::class, 'login']);
    Route::Get('/signup', [ClientController::class, 'signup']);
    Route::Get('/orders', [ClientController::class, 'orders']);


    Route::Get('/admin', [AdminController::class, 'admin']);

    Route::Get('/addcategory', [CategoryController::class, 'addcategory']);
    Route::Post('/savecategory', [CategoryController::class, 'savecategory']);
    Route::Get('/categories', [CategoryController::class, 'categories']);
    Route::Get('/edit_category/{id}', [CategoryController::class, 'edit_category']);
    Route::Post('/updatecategory', [CategoryController::class, 'updatecategory']);
    Route::Get('/delete_category/{id}', [CategoryController::class, 'delete_category']);
    

    Route::Get('/addslider', [SliderController::class, 'addslider']);
    Route::Get('/sliders', [SliderController::class, 'sliders']);

    Route::Get('/addproduct', [ProductController::class, 'addproduct']);
    Route::Get('/products', [ProductController::class, 'products']);
    Route::Post('/saveproduct', [ProductController::class, 'saveproduct']);


// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
