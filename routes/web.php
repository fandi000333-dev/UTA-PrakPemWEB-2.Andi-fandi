<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Teams\TeamInvitationController;
use App\Http\Middleware\EnsureTeamMembership;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::view('/', 'home')->name('home');
Route::resource('books', BookController::class);


Route::get('/books', [BookController::class, 'index'])
    ->name('books.index');

Route::get('/books/{id}', [BookController::class, 'show'])
    ->whereNumber('id')
    ->name('books.show');


Route::view('/profil-kelas', 'profil-kelas')
    ->name('profil-kelas');

Route::inertia('/', 'welcome')->name('home');

Route::prefix('{current_team}')
    ->middleware(['auth', 'verified', EnsureTeamMembership::class])
    ->group(function () {
        Route::get('dashboard', DashboardController::class)->name('dashboard');
    });

Route::middleware(['auth'])->group(function () {
    Route::post('invitations/{invitation}/accept', [TeamInvitationController::class, 'accept'])->name('invitations.accept');
    Route::delete('invitations/{invitation}', [TeamInvitationController::class, 'decline'])->name('invitations.decline');
});

require __DIR__.'/settings.php';
