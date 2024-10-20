<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Models\Nationality;
use App\Models\Rol;
use App\Models\User;
use App\Models\Shift;
use App\Models\Employee;


Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

// Route::get('/', function () {
//     return view('welcome');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::resource('nationalities',NationalityController::class);
Route::resource('rols',RolController::class);
Route::resource('users',UserController::class);
Route::resource('shifts',ShiftController::class);
Route::resource('employees',EmployeeController::class);
