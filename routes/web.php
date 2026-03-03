<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CertificateController as AdminCertificateController;
use App\Http\Controllers\Admin\CertificateVerificationLogController;
use App\Http\Controllers\Admin\CertificationController as AdminCertificationController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\PageMetaController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\TrainingCategoryController;
use App\Http\Controllers\Admin\TrainingController as AdminTrainingController;
use App\Http\Controllers\Admin\WorkshopController as AdminWorkshopController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MpesaCallbackController;
use App\Http\Controllers\PortalController;
use App\Http\Controllers\Portal\BookingController as PortalBookingController;
use App\Http\Controllers\Portal\ProfileController as PortalProfileController;
use App\Http\Controllers\VerifyController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/workshops', [HomeController::class, 'workshops'])->name('workshops.index');
Route::get('/workshops/archive', [HomeController::class, 'workshopsArchive'])->name('workshops.archive');
Route::get('/trainings', [HomeController::class, 'trainings'])->name('trainings.index');
Route::get('/trainings/category/{category:slug}', [HomeController::class, 'trainingsByCategory'])->name('trainings.category');
Route::get('/trainings/{training:slug}', [HomeController::class, 'trainingShow'])->name('trainings.show');
Route::get('/certifications', [HomeController::class, 'certifications'])->name('certifications.index');
Route::get('/certifications/{certification:slug}', [HomeController::class, 'certificationShow'])->name('certifications.show');
Route::get('/reviews', [HomeController::class, 'reviews'])->name('reviews.index');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/verify', [VerifyController::class, 'show'])->name('verify');
Route::post('/verify', [VerifyController::class, 'verify'])->name('verify.check');
Route::get('/verify/result', [VerifyController::class, 'result'])->name('verify.result');
Route::get('/services', [HomeController::class, 'services'])->name('services.index');
Route::get('/services/{service:slug}', [HomeController::class, 'serviceShow'])->name('services.show');

// Student/Public auth (throttle: 5 attempts per minute)
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->middleware('throttle:5,1');
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:5,1');
});
Route::post('/logout', [LogoutController::class, '__invoke'])->name('logout')->middleware('auth');

// M-Pesa callback (no CSRF)
Route::post('/webhook/mpesa/callback', MpesaCallbackController::class)->name('mpesa.callback');

// Student portal
Route::middleware('auth')->prefix('portal')->name('portal.')->group(function () {
    Route::get('/dashboard', [PortalController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [PortalProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [PortalProfileController::class, 'update'])->name('profile.update');
    Route::post('/bookings', [PortalBookingController::class, 'store'])->name('bookings.store');
    Route::get('/bookings/{booking}', [PortalBookingController::class, 'status'])->name('bookings.status');
    Route::post('/bookings/{booking}/pay', [PortalBookingController::class, 'pay'])->name('bookings.pay');
});

// Admin auth (guest, throttle: 5 attempts per minute)
Route::middleware('guest')->prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->middleware('throttle:5,1');
});

// Admin panel (auth + admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('workshops', AdminWorkshopController::class)->except(['show']);
    Route::resource('training-categories', TrainingCategoryController::class)->except(['show']);
    Route::resource('trainings', AdminTrainingController::class)->except(['show']);
    Route::resource('certifications', AdminCertificationController::class)->except(['show']);
    Route::resource('reviews', AdminReviewController::class)->except(['show']);
    Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::post('contacts/{contact}/unread', [AdminContactController::class, 'markUnread'])->name('contacts.unread');
    Route::delete('contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
    Route::get('certificates/generate', [AdminCertificateController::class, 'generate'])->name('certificates.generate');
Route::post('certificates/generate', [AdminCertificateController::class, 'storeGenerated'])->name('certificates.store-generated');
Route::get('certificates/{certificate}/print', [AdminCertificateController::class, 'print'])->name('certificates.print');
Route::resource('certificates', AdminCertificateController::class)->except(['show']);
    Route::get('verification-logs', [CertificateVerificationLogController::class, 'index'])->name('verification-logs.index');
    Route::resource('services', AdminServiceController::class)->except(['show']);
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::get('hero', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('hero', [HeroController::class, 'update'])->name('hero.update');
    Route::get('page-meta', [PageMetaController::class, 'index'])->name('page-meta.index');
    Route::put('page-meta', [PageMetaController::class, 'update'])->name('page-meta.update');
    Route::get('users', [AdminUserController::class, 'index'])->name('users.index');
    Route::get('users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
    Route::put('users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
});
