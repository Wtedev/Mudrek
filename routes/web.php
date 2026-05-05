<?php

use App\Http\Controllers\AccountSettingsController;
use App\Http\Controllers\Admin\AttendanceScanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::get('/registration', [RegistrationController::class, 'create'])->name('registration');
Route::post('/registration', [RegistrationController::class, 'store'])->name('registration.store');
Route::get('/thank-you/{participant}', [RegistrationController::class, 'thankYou'])
    ->whereUuid('participant')
    ->name('registration.thank-you');

Route::middleware(['auth'])->group(function (): void {
    Route::get('/admin/attendance-scan', [AttendanceScanController::class, 'index'])
        ->name('admin.attendance-scan');
    Route::post('/admin/attendance-scan/check', [AttendanceScanController::class, 'check'])
        ->middleware('throttle:120,1')
        ->name('admin.attendance-scan.check');
});

Route::middleware('auth')->group(function (): void {
    Route::get('/account/settings', [AccountSettingsController::class, 'edit'])->name('account.settings.edit');
    Route::put('/account/settings', [AccountSettingsController::class, 'update'])->name('account.settings.update');

    Route::post('/logout', function () {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('filament.admin.auth.login');
    })->name('logout');
});
