<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Customer\AuthController as CustomerAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Website Customer Authentication Routes (Guard: customer, Mobile + OTP 1234)
|--------------------------------------------------------------------------
*/
Route::get('/login', [CustomerAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [CustomerAuthController::class, 'loginWithOtp'])->name('login.otp');
Route::get('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
Route::post('/logout', [CustomerAuthController::class, 'logout']);

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes (Guard: web, Email/Username + Password)
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AuthenticatedSessionController::class, 'create'])->name('admin.login');
Route::post('/admin/login', [AuthenticatedSessionController::class, 'store'])->name('admin.login.submit');
Route::get('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroy']);

Route::get('/admin/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

Route::post('/admin/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

Route::get('/admin/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

Route::post('/admin/reset-password', [NewPasswordController::class, 'store'])
                ->name('password.update');
