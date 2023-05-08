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
    Route::Get('addtocart/{id}', [ClientController::class, 'addtocart']);
    Route::Post('/update_qty/{id}', [ClientController::class, 'update_qty']);
    Route::Get('/removeitem/{id}', [ClientController::class, 'removeitem']);
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
    Route::Post('/saveslider', [SliderController::class, 'saveslider']);
    Route::Get('/edit_slider/{id}', [SliderController::class, 'edit_slider']);
    Route::Post('/updateslider', [SliderController::class, 'updateslider']);
    Route::Get('/delete_slider/{id}', [SliderController::class, 'delete_slider']);
    Route::Get('/activate_slider/{id}', [SliderController::class, 'activate_slider']);
    Route::Get('/deactivate_slider/{id}', [SliderController::class, 'deactivate_slider']);


    Route::Get('/addproduct', [ProductController::class, 'addproduct']);
    Route::Get('products', [ProductController::class, 'products']);
    Route::Get('/edit_product/{id}', [ProductController::class, 'edit_product']);
    Route::Post('/updateproduct', [ProductController::class, 'updateproduct']);
    Route::Get('/delete_product/{id}', [ProductController::class, 'delete_product']);
    Route::Get('/deactivate_product/{id}', [ProductController::class, 'deactivate_product']);
    Route::Get('/activate_product/{id}', [ProductController::class, 'activate_product']);
    Route::Post('/saveproduct', [ProductController::class, 'saveproduct']);
    Route::Get('/view_product_by_category/{category_name}', [ProductController::class, 'view_product_by_category']);


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
