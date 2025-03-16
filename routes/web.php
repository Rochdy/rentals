<?php

use App\Http\Middleware\AdminMiddleware;
use App\Livewire\Bookings\BookingForm;
use App\Livewire\Bookings\BookingsList;
use App\Livewire\Rentals\RentalForm;
use App\Livewire\Rentals\RentalShow;
use App\Livewire\Rentals\RentalsList;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('rentals');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('rentals/create', RentalForm::class)->name('rentals.create')->middleware(AdminMiddleware::class);
    Route::get('rentals/{rental}/edit', RentalForm::class)->name('rentals.edit')->middleware(AdminMiddleware::class);
    Route::get('rentals/{rental}/booking', BookingForm::class)->name('rentals.booking');
    Route::get('bookings', BookingsList::class)->name('bookings.index')->middleware(AdminMiddleware::class);
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});
Route::get('rentals', RentalsList::class)->name('rentals.index');
Route::get('rentals/{rental}', RentalShow::class)->name('rentals.show');

require __DIR__.'/auth.php';
