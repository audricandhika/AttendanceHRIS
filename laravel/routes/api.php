<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\API\ScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get("/user/{id}", [UserController::class, "show_user"]);

Route::post("/login", [AuthController::class, "login"]);
Route::post("/register", [AuthController::class, "register"])->middleware(
    "auth:sanctum",
);


Route::get('/absen/status', [AttendanceController::class, 'statusHariIni']);
Route::post('/absen/in', [AttendanceController::class, 'clockIn']);
Route::post('/absen/out', [AttendanceController::class, 'clockOut']);
Route::post('/lembur/in', [AttendanceController::class, 'lemburIn']);
Route::post('/lembur/out', [AttendanceController::class, 'lemburOut']);

Route::prefix('schedule')->group(function () {
    Route::get('/year/{year?}', [ScheduleController::class, 'getYearSchedule']);
    Route::post('/holiday', [ScheduleController::class, 'addHoliday']);
});
