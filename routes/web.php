<?php

use App\Http\Controllers\AttendanceEventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\KioskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/kiosk', [KioskController::class, 'show'])->name('kiosk.show');
Route::post('/kiosk/check-in', [KioskController::class, 'store'])->name('kiosk.check-in');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{employee}/qr', [EmployeeController::class, 'showQr'])->name('employees.qr.show');

    Route::get('/attendance/events', [AttendanceEventController::class, 'index'])->name('attendance.events.index');
    Route::post('/attendance/events', [AttendanceEventController::class, 'store'])->name('attendance.events.store');
    Route::patch('/attendance/events/{attendanceEvent}/activate', [AttendanceEventController::class, 'activate'])->name('attendance.events.activate');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
