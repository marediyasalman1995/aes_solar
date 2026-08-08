<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ReferralController;
use App\Http\Controllers\Admin\CustomerSiteController;
use App\Http\Controllers\Admin\ServiceRequestController;
use App\Http\Controllers\Admin\WalletTransactionController;
use App\Http\Controllers\Admin\CustomerDocumentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\NewsLetterController;
use App\Http\Controllers\Admin\ContentManagementController;
use App\Http\Controllers\Admin\WebsiteController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserTokenController;
use App\Http\Controllers\Admin\UploadMediaController;
use App\Http\Controllers\Admin\SettingController;

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth:web'],
], function () {
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    // Customer Management & Customer Detail View
    Route::resource('customers', CustomerController::class, ["as" => 'admin']);
    Route::post('customers/{customer}/add-site', [CustomerController::class, 'storeSite'])->name('admin.customers.add-site');
    Route::post('customers/{customer}/adjust-wallet', [CustomerController::class, 'adjustWallet'])->name('admin.customers.adjust-wallet');
    Route::post('customers/referrals/{referral}/update-stage', [CustomerController::class, 'updateReferralStage'])->name('admin.customers.update-referral-stage');
    Route::post('customers/services/{serviceRequest}/update', [CustomerController::class, 'updateServiceRequest'])->name('admin.customers.update-service');
    Route::post('customers/{customer}/add-document', [CustomerController::class, 'storeDocument'])->name('admin.customers.add-document');

    // Direct Modules
    Route::resource('customer-sites', CustomerSiteController::class, ["as" => 'admin']);
    Route::resource('referrals', ReferralController::class, ["as" => 'admin']);
    Route::resource('service-requests', ServiceRequestController::class, ["as" => 'admin']);
    Route::resource('wallet-transactions', WalletTransactionController::class, ["as" => 'admin']);
    Route::post('wallet-transactions/{walletTransaction}/status', [WalletTransactionController::class, 'updateStatus'])->name('admin.wallet-transactions.update-status');
    Route::resource('customer-documents', CustomerDocumentController::class, ["as" => 'admin']);

    // Admin Users, Roles, Inquiries, Content
    Route::resource('users', UserController::class, ["as" => 'admin']);
    Route::resource('inquiries', InquiryController::class, ["as" => 'admin']);
    Route::resource('faqs', FaqController::class, ["as" => 'admin']);
    Route::resource('newsletters', NewsLetterController::class, ["as" => 'admin']);
    Route::resource('contentManagements', ContentManagementController::class, ["as" => 'admin']);
    Route::resource('websites', WebsiteController::class, ["as" => 'admin']);

    Route::group(['prefix' => 'users', 'as' => 'admin.users.'], function () {
        Route::group(['prefix' => '{user}/change-password', 'as' => 'changePassword.'], function () {
            Route::get('/', [UserController::class, 'changePassword'])->name('index');
            Route::post('process', [UserController::class, 'changePassword_process'])->name('process');
        });
    });

    Route::group(['prefix' => 'roles', 'as' => 'admin.roles.'], function () {
        Route::group(['prefix' => '{role}/manage-permissions', 'as' => 'permissions.manage.'], function () {
            Route::get('/', [PermissionController::class, 'index'])->name('index');
            Route::post('update', [PermissionController::class, 'update'])->name('update');
        });
    });

    Route::resource('roles', RoleController::class, ["as" => 'admin'])->except([
        'show', 'edit', 'update'
    ]);

    Route::group(['prefix' => 'user-tokens/{user}', 'as' => 'admin.userTokens.'], function () {
        Route::get('index', [UserTokenController::class, 'index'])->name('index');
        Route::post('generate', [UserTokenController::class, 'generate'])->name('generate');
        Route::delete('destroy/{token}', [UserTokenController::class, 'destroy'])->name('destroy');
    });

    Route::group(['prefix' => 'file', 'as' => 'file.'], function () {
        Route::post('upload-media', [UploadMediaController::class, 'uploadMedia'])->name('upload');
        Route::post('remove-media', [UploadMediaController::class, 'removeMedia'])->name('remove');
    });

    Route::get('contentManagement-status-change/{contentManagement}', [ContentManagementController::class, 'statusChange'])->name('admin.contentManagements.status-change');
    Route::get('setting', [SettingController::class, 'create'])->name('admin.setting.create');
    Route::post('setting-save', [SettingController::class, 'store'])->name('admin.setting.store');
});
