<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\NationalityController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomTypeController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Models\Nationality;
use App\Models\Rol;
use App\Models\User;
use App\Models\Shift;
use App\Models\Employee;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('users',UserController::class);
});
// Route::get('/', function () {
//     return view('welcome');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('reservations',ReservationController::class);
});

require __DIR__.'/auth.php';


Route::resource('nationalities',NationalityController::class);
Route::resource('rols',RolController::class);
// Route::resource('users',UserController::class);
Route::resource('shifts',ShiftController::class);
Route::resource('employees',EmployeeController::class);

Route::resource('room_types',RoomTypeController::class);
Route::resource('rooms',RoomController::class);
Route::resource('reservations', ReservationController::class);



Route::get('/', [RoomTypeController::class, 'welcome'])->name('dashboard');
Route::get('/Administration/ReservationList.index', [ReservationController::class, 'reservationList'])->name('reservationList');