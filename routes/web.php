<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Models\Nationality;
use App\Models\Rol;
use App\Models\User;
use App\Models\Shift;
use App\Models\Employee;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::resource('nationalities',Nationality::class);
Route::resource('rols',Rol::class);
Route::resource('users',User::class);
Route::resource('shifts',Shift::class);
Route::resource('employees',Employee::class);
