<?php

use App\Http\Controllers\BusinessController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/business/{id}/qr', [BusinessController::class, 'showQRPage'])->name('business.qr');
    Route::get('/business/{id}/rating', [BusinessController::class, 'showRating'])->name('business.rating');
    
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('permission/index',[PermissionController::class,'index'])->name('permission.index');
    Route::get('permission/create',[PermissionController::class,'create'])->name('permission.create');
    Route::post('permission/store',[PermissionController::class,'store'])->name('permission.store');
    Route::get('permission/edit/{permission}',[PermissionController::class,'edit'])->name('permission.edit');
    Route::post('permission/update/{permission}',[PermissionController::class,'update'])->name('permission.update');
    Route::get('permission/delete/{permission}',[PermissionController::class,'delete'])->name('permission.delete');


    
    Route::get('role/index',[RoleController::class,'index'])->name('role.index');
    Route::get('role/create',[RoleController::class,'create'])->name('role.create');
    Route::post('role/store',[RoleController::class,'store'])->name('role.store');
    Route::get('role/edit/{role}',[RoleController::class,'edit'])->name('role.edit');
    Route::post('role/update/{role}',[RoleController::class,'update'])->name('role.update');
    Route::get('role/delete/{role}',[RoleController::class,'delete'])->name('role.delete');


    Route::get('user/index',[UserController::class,'index'])->name('user.index');
    Route::get('user/create',[UserController::class,'create'])->name('user.create');
    Route::post('user/store',[UserController::class,'store'])->name('user.store');
    Route::get('user/edit/{user}',[UserController::class,'edit'])->name('user.edit');
    Route::post('user/update/{user}',[UserController::class,'update'])->name('user.update');
    Route::get('user/delete/{user}',[UserController::class,'delete'])->name('user.delete');


    Route::get('businesses/index',[BusinessController::class,'index'])->name('business.index');
    Route::get('businesses/create',[BusinessController::class,'create'])->name('business.create');
    Route::post('businesses/store',[BusinessController::class,'store'])->name('business.store');
    Route::get('businesses/edit/{business}',[BusinessController::class,'edit'])->name('business.edit');
    Route::post('businesses/update/{business}',[BusinessController::class,'update'])->name('business.update');
    Route::get('businesses/delete/{business}',[BusinessController::class,'delete'])->name('business.delete');
    Route::get('/business/{id}/qr', [BusinessController::class, 'showQRPage'])->name('business.qr');
    Route::get('/business/{id}/rating', [BusinessController::class, 'showRating'])->name('business.rating');
    
    Route::post('/business/{id}/review', [BusinessController::class, 'submitReview'])->name('business.review');
});

require __DIR__.'/auth.php';
