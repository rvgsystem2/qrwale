<?php

use App\Http\Controllers\BusinessApprovalController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\BusinessQrController;
use App\Http\Controllers\BusinessTemplateController;
use App\Http\Controllers\PdfEditorController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicBusinessController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\UserController;
use App\Models\Business;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\BusinessProductController;



Route::get('/sitemap-generator', [SitemapController::class, 'index'])->name('sitemap.index');
Route::post('/sitemap-generator', [SitemapController::class, 'generate'])->name('sitemap.generate');
Route::get('/apply-business',[PublicBusinessController::class,'create'])->name('public.business.create');
Route::post('/apply-business',[PublicBusinessController::class,'store'])->name('public.business.store');
Route::get('/admin/business-requests',[BusinessApprovalController::class,'index'])->name('admin.business_requests.index');
Route::post('/admin/business-requests/{requestRow}/approve',[BusinessApprovalController::class,'approve'])->name('admin.business_requests.approve');
Route::post('/admin/business-requests/{requestRow}/reject',[BusinessApprovalController::class,'reject'])->name('admin.business_requests.reject');
Route::get('/apply-business/thanks', function () {
    return view('public.thankyou');
})->name('business.thanks');





Route::delete('/admin/business-requests/{requestRow}',
    [BusinessApprovalController::class,'destroy']
)->name('admin.business_requests.destroy');


Route::get('/choudhary_traders', function () {
    return view('business.choudhary_traders');
})->name('choudhary');


Route::get('/shorturls/index', [ShortUrlController::class, 'index'])->name('shorturls.index');
Route::get('/shorturls/create', [ShortUrlController::class, 'create'])->name('shorturls.create');

Route::post('/shorturls', [ShortUrlController::class, 'store'])->name('shorturls.store');
Route::get('/shorturls/{shorturl}/edit', [ShortUrlController::class, 'edit'])->name('shorturls.edit');
Route::put('/shorturls/{shorturl}', [ShortUrlController::class, 'update'])->name('shorturls.update');
Route::get('/shorturls/{shorturl}', [ShortUrlController::class, 'destroy'])->name('shorturls.delete');


Route::get('/s/{code}', [ShortUrlController::class, 'redirect'])->name('shorturls.redirect');

Route::get('/', function () {
    return view('front.index');
})->name('home');

Route::get('/contact', function () {
    return view('front.contact');
});

Route::post('/save-qr', [QrCodeController::class, 'store']);

Route::get('/my-qr-codes', [QrCodeController::class, 'index'])->middleware('auth')->name('qrcodes.index');
Route::delete('/qrcodes/{id}', [QrCodeController::class, 'destroy'])->name('qrcodes.destroy');




Route::post('/business/{id}/track-click', [BusinessController::class, 'trackSocialClick'])
    ->name('business.trackClick');



Route::get('/business/{identifier}/qr', [BusinessController::class, 'showQRPage'])
    ->where('identifier', '[A-Za-z0-9-_]+') // Accepts only alphanumeric, dashes, and underscores
    ->name('business.qr');


Route::get('/business/{id}/rating', [BusinessController::class, 'showRating'])->name('business.rating');
Route::post('/business/{id}/review', [BusinessController::class, 'submitReview'])->name('business.review');


Route::get('/dashboard', [BusinessController::class, 'dashboard'])->middleware(['auth','verified'])->name('dashboard');








Route::middleware('auth')->group(function () {
    Route::get(
        '/businesses/{business}/products',
        [BusinessProductController::class, 'index']
    )->name('business-products.index');

    Route::get(
        '/businesses/{business}/products/create',
        [BusinessProductController::class, 'create']
    )->name('business-products.create');

    Route::post(
        '/businesses/{business}/products',
        [BusinessProductController::class, 'store']
    )->name('business-products.store');

    Route::get(
        '/businesses/{business}/products/{product}/edit',
        [BusinessProductController::class, 'edit']
    )->name('business-products.edit');

    Route::put(
        '/businesses/{business}/products/{product}',
        [BusinessProductController::class, 'update']
    )->name('business-products.update');

    Route::delete(
        '/businesses/{business}/products/{product}',
        [BusinessProductController::class, 'destroy']
    )->name('business-products.destroy');
});




// Routes that require authentication
Route::middleware('auth')->group(function () {
    Route::get('businesses/{business}/qr/image', [BusinessQrController::class, 'image'])->name('business.qr.image');
    Route::get('businesses/{business}/qr/download', [BusinessQrController::class, 'download'])->name('business.qr.download');

    Route::get(
    '/business-templates/preview-design/{viewKey}',
    [BusinessTemplateController::class, 'previewDesign']
)
->where('viewKey', '[a-z0-9-]+')
->name('business-templates.preview-design');
    Route::resource('business-templates', BusinessTemplateController::class)->parameters(['business-templates'=>'businessTemplate'])->except(['show']);
    Route::get('business-templates/{businessTemplate}/preview', [BusinessTemplateController::class, 'preview'])->name('business-templates.preview');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Permission Routes
    Route::get('permission/index',[PermissionController::class,'index'])->name('permission.index');
    Route::get('permission/create',[PermissionController::class,'create'])->name('permission.create');
    Route::post('permission/store',[PermissionController::class,'store'])->name('permission.store');
    Route::get('permission/edit/{permission}',[PermissionController::class,'edit'])->name('permission.edit');
    Route::post('permission/update/{permission}',[PermissionController::class,'update'])->name('permission.update');
    Route::get('permission/delete/{permission}',[PermissionController::class,'delete'])->name('permission.delete');

    // Role Routes
    Route::get('role/index',[RoleController::class,'index'])->name('role.index');
    Route::get('role/create',[RoleController::class,'create'])->name('role.create');
    Route::post('role/store',[RoleController::class,'store'])->name('role.store');
    Route::get('role/edit/{role}',[RoleController::class,'edit'])->name('role.edit');
    Route::post('role/update/{role}',[RoleController::class,'update'])->name('role.update');
    Route::get('role/delete/{role}',[RoleController::class,'delete'])->name('role.delete');

    // User Routes
    Route::get('user/index',[UserController::class,'index'])->name('user.index');
    Route::get('user/create',[UserController::class,'create'])->name('user.create');
    Route::post('user/store',[UserController::class,'store'])->name('user.store');
    Route::get('user/edit/{user}',[UserController::class,'edit'])->name('user.edit');
    Route::post('user/update/{user}',[UserController::class,'update'])->name('user.update');
    Route::get('user/delete/{user}',[UserController::class,'delete'])->name('user.delete');
    Route::get('/user/permissions/{user}', [UserController::class, 'assignPermissionForm'])->name('user.permission.form');
    Route::post('/user/permissions/{user}', [UserController::class, 'assignPermissionToUser'])->name('user.assign-permission');

    // Business Routes
    Route::get('businesses/index',[BusinessController::class,'index'])->name('business.index');
    Route::get('businesses/create',[BusinessController::class,'create'])->name('business.create');
    Route::post('businesses/store',[BusinessController::class,'store'])->name('business.store');
    Route::get('businesses/edit/{business}',[BusinessController::class,'edit'])->name('business.edit');
    Route::post('businesses/update/{business}',[BusinessController::class,'update'])->name('business.update');
    Route::delete('businesses/delete/{business}',[BusinessController::class,'delete'])->name('business.delete');




});

require __DIR__.'/auth.php';
