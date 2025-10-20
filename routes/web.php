<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Profile;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Dashboard;
use App\Livewire\Penerima\PenerimaCreate;
use App\Livewire\Penerima\PenerimaEdit;
use App\Livewire\Penerima\PenerimaIndex;
use App\Livewire\Rekap\RekapCreate;
use App\Livewire\Rekap\RekapEdit;
use App\Livewire\Rekap\RekapIndex;
use App\Livewire\User\UserIndex;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('dashboard');
});

Route::middleware('guest')->group(function () {
    // Route::get('/register', Register::class)->name('register');
    Route::get('/login', Login::class)->name('login');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('/reset-password/{token}', ResetPassword::class)->name('password.reset');
});

// Route::prefix('rekap-transfer')->group(function () {
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/rekap', RekapIndex::class)->name('rekap.index');
    Route::get('/rekap/create', RekapCreate::class)->name('rekap.create');
    Route::get('/rekap/{id}/edit', RekapEdit::class)->name('rekap.edit');

    Route::get('/penerima', PenerimaIndex::class)->name('penerima.index');
    Route::get('/penerima/create', PenerimaCreate::class)->name('penerima.create');
    Route::get('/penerima/{id}/edit', PenerimaEdit::class)->name('penerima.edit');

    Route::get('/profile', Profile::class)->name('profile');
    Route::get('/user', UserIndex::class)->name('user');

    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login');
    })->name('logout');
});

// });
