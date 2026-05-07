<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\UniversityController;
use App\Http\Controllers\Admin\AdmissionController;
use App\Http\Controllers\Admin\FundingController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ConsultationController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Auth\AuthController;

// Admin Auth Routes
Route::prefix('admin')->name('admin.')->group(function () {
  Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout')->name('logout');
  });

  // Protected Admin Routes
  Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resources([
      'events' => EventController::class,
      'universities' => UniversityController::class,
      'admissions' => AdmissionController::class,
      'fundings' => FundingController::class,
      'blogs' => BlogController::class,
    ]);

    Route::get('events/{event}/registrations', [EventController::class, 'registrations'])
      ->name('events.registrations');
    Route::get('universities/{university}/admissions', [UniversityController::class, 'admissions'])
      ->name('universities.admissions');

    // Consultations
    Route::get('/consultations', [ConsultationController::class, 'index'])->name('consultations.index');

    // Newsletters
    Route::get('/newsletters', [NewsletterController::class, 'index'])->name('newsletters.index');

    // Settings Routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::put('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update');
    Route::post('/settings/admins', [SettingsController::class, 'createAdmin'])->name('settings.admins.store');
    Route::put('/settings/admins/{admin}', [SettingsController::class, 'updateAdmin'])->name('settings.admins.update');
    Route::delete('/settings/admins/{admin}', [SettingsController::class, 'deleteAdmin'])->name('settings.admins.destroy');
    Route::get('/settings/site', [SettingsController::class, 'getSiteSettings'])->name('settings.site.get');
    Route::post('/settings/site', [SettingsController::class, 'updateSiteSettings'])->name('settings.site.update');
  });
});
