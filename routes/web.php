<?php

use App\Http\Controllers\DashboardController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsApprover;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\ActivityLogsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login_form');
Route::post('login', [AuthenticationController::class, 'login'])->name('login');
Route::get('/logout', [AuthenticationController::class,'logout'])->name('logout');

Route::middleware([Authenticate::class])->group(function () {
    Route::middleware(IsAdmin::class)->group(function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/admin/requests', [RequestController::class, 'index'])->name('requests');
        Route::post('/admin/requests', [RequestController::class,'store'])->name('requests.store');
        Route::get('/admin/requests/export', [RequestController::class,'export'])->name('request.export');
        Route::get('/admin/logs', [ActivityLogsController::class, 'index'])->name('log');
    });

    Route::middleware(IsApprover::class)->group(function () {
        Route::get('/approver/dashboard', [RequestController::class, 'approverIndex'])->name('approver.dashboard');
        Route::post('/approver/update/{id}', [RequestController::class, 'update'])->name('approver.update');
    });
});
