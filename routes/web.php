<?php

use App\Http\Controllers\Guest\AdmissionController;
use App\Http\Controllers\Guest\BlogController;
use App\Http\Controllers\Guest\ConsultationController;
use App\Http\Controllers\Guest\ContactController;
use App\Http\Controllers\Guest\EventController;
use App\Http\Controllers\Guest\FundingController;
use App\Http\Controllers\Guest\HomeController;
use App\Http\Controllers\Guest\JourneyController;
use App\Http\Controllers\Guest\UniversityController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('admissions')->name('admissions.')->controller(AdmissionController::class)->group(function () {
  Route::get('/', 'index')->name('index');
  Route::get('/{id}', 'show')->name('show');
});

Route::prefix('funding')->name('funding.')->controller(FundingController::class)->group(function () {
  Route::get('/', 'index')->name('index');
  Route::get('/{id}', 'show')->name('show');
});

Route::prefix('universities')->name('universities.')->controller(UniversityController::class)->group(function () {
  Route::get('/', 'index')->name('index');
  Route::get('/{id}', 'show')->name('show');
});

Route::prefix('events')->name('events.')->controller(EventController::class)->group(function () {
  Route::get('/', 'index')->name('index');
  Route::get('/{id}', 'show')->name('show');
});

Route::prefix('blog')->name('blog.')->controller(BlogController::class)->group(function () {
  Route::get('/', 'index')->name('index');
  Route::get('/{article}', 'show')->name('show');
});

Route::prefix('contact')->name('contact.')->controller(ContactController::class)->group(function () {
  Route::get('/', 'index')->name('index');
  Route::post('/', 'submit')->name('submit');
});

Route::prefix('consultation')->name('consultation.')->controller(ConsultationController::class)->group(function () {
  Route::get('/', 'index')->name('index');
  Route::post('/', 'submit')->name('submit');
});

Route::prefix('journey')->name('journey.')->controller(JourneyController::class)->group(function () {
  Route::get('/', 'index')->name('index');
  Route::post('/', 'submit')->name('submit');
});
