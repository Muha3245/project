<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HighlightController;
use App\Http\Controllers\ItemImageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\HighlightImageController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'role:Admin,staff'])->name('dashboard');

Route::middleware(['auth', 'role:Admin,staff'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/permission', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/permission/store', [PermissionController::class, 'store'])->name('permission.store');
    Route::get('/permission/index', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/permission/edit{id}', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::put('/permission/{id}', [PermissionController::class, 'update'])->name('permission.update');
    Route::delete('/permission/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');

    Route::get('/role', [RoleController::class, 'create'])->name('role.create');
    Route::post('/role/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/role/index', [RoleController::class, 'index'])->name('role.index');
    Route::get('/role/edit{id}', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/role/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/role/{id}', [RoleController::class, 'destroy'])->name('role.destroy');

    Route::resource('user', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('subcategories', SubcategoryController::class);
    Route::resource('carousels', CarouselController::class);


    Route::resource('items', ItemController::class);

// Item Images routes
Route::prefix('items/{item}/item_images')->name('item_images.')->group(function () {
    Route::get('/', [ItemImageController::class, 'index'])->name('index');
    Route::get('/create', [ItemImageController::class, 'create'])->name('create');
    Route::post('/', [ItemImageController::class, 'store'])->name('store');
    Route::get('/{image}/edit', [ItemImageController::class, 'edit'])->name('edit');
    Route::delete('/{image}', [ItemImageController::class, 'destroy'])->name('destroy');
});
Route::put('item_images/{item}/{itemImage}', [ItemImageController::class, 'update'])->name('item_images.update');



Route::resource('highlights', HighlightController::class);
Route::resource('highlights.highlightImages', HighlightImageController::class);
Route::get('highlights/{highlight}/highlightImages/{highlightImage}/edit', [HighlightImageController::class, 'edit'])->name('highlights.highlightImages.edit');
Route::put('highlights/{highlight}/highlightImages/{highlightImage}', [HighlightImageController::class, 'update'])->name('highlights.highlightImages.update');

    // Route::get('categories/{category}/subcategories', [SubcategoryController::class, 'index'])->name('subcategories.index');
    // Route::get('categories/{category}/subcategories/create', [SubcategoryController::class, 'create'])->name('subcategories.create');
    Route::resource('categories.subcategories', SubcategoryController::class)->except(['show']);
});

require __DIR__.'/auth.php';
