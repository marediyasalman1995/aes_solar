<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes - Public Website
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [HomeController::class, 'about_us'])->name('about');
Route::get('/solutions', [HomeController::class, 'solutions'])->name('solutions');
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/suryaghar', [HomeController::class, 'suryaghar'])->name('suryaghar');
Route::get('/contact-us', [HomeController::class, 'contact'])->name('contact');
Route::get('/dealer', [HomeController::class, 'dealer'])->name('dealer');

Route::get('/cms/{slug}', [HomeController::class, 'cmsDetail'])->name('cms-detail');
Route::get('/faqs', [HomeController::class, 'faqs'])->name('faqs');
Route::post('/save-newsletter', [HomeController::class, 'saveNewsLetter'])->name('save.newsletter');
Route::post('/save-inquiry', [HomeController::class, 'saveInquiry'])->name('save-inquiry');

Route::get('/product/{slug}', [HomeController::class, 'productDetail'])->name('products.single');

/*
|--------------------------------------------------------------------------
| Customer Portal Routes (Guard: customer)
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth:customer']], function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard');
    Route::post('/customer/switch-site', [CustomerDashboardController::class, 'switchSite'])->name('customer.switchSite');
    Route::post('/customer/submit-referral', [CustomerDashboardController::class, 'submitReferral'])->name('customer.submitReferral');
    Route::post('/customer/submit-service', [CustomerDashboardController::class, 'submitServiceRequest'])->name('customer.submitService');
    Route::post('/customer/request-payout', [CustomerDashboardController::class, 'requestPayout'])->name('customer.requestPayout');
    Route::post('/customer/update-profile', [CustomerDashboardController::class, 'updateProfile'])->name('customer.updateProfile');
    Route::post('/customer/notifications/{id}/read', [CustomerDashboardController::class, 'markNotificationRead'])->name('customer.readNotification');
});

require __DIR__.'/auth.php';
require __DIR__.'/media.php';
require __DIR__.'/admin.php';
