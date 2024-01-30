<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RemoveRoleFromUser;
use App\Http\Controllers\RevokePermissionFromRoleCotroller;
use App\Http\Controllers\RevokePermissionFromUser;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:admin',])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::resource('/users', UserController::class);
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::delete('/roles/{role}/permissions/{permission}', RevokePermissionFromRoleCotroller::class)->name('roles.permissions.destroy');
    Route::delete('/users/{user}/permissions/{permission}', RevokePermissionFromUser::class)->name('users.permissions.destroy');
    Route::delete('/users/{user}/roles/{role}', RemoveRoleFromUser::class)->name('users.roles.destroy');

});



require __DIR__.'/auth.php';
