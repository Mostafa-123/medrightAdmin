<?php

use App\Http\Controllers\LevelController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RequestHiringController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/', [ProfileController::class, 'redirect'])->name('redirect');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('logout');

                Route::post('/roles/rolesPermissions', [UserController::class, 'rolesPermissions'])->name('roles.rolesPermissions');
        Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');
        Route::get('/destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::put('/profile', [UserController::class, 'profileUpdate'])->name('users.profile_update');
        Route::delete('/delete-multi', [UserController::class, 'deleteMulti'])->name('users.multi_destroy');

    Route::get('pages/{page}/editor', 'PageController@editor');
    Route::get('pages/{page}/editor', [PageController::class,'editor'])->name('pages.editor');

    Route::post('createone', [RequestHiringController::class,'one'])->name('request.one');
    Route::get('requesth', [RequestHiringController::class,'getone']);


    Route::get('/get/roles', [RoleController::class, 'getAllRolesList'])->name('getAllRolesList');
    Route::get('/get/pages', [PageController::class, 'getAllPagesList'])->name('getAllPagesList');



});
Route::middleware(['auth','checkRole'])->prefix('admin')->group(function () {

    // Route::get('/requests', [RequestHiringController::class, 'index'])->name('requests.index');
    // Route::get('/requests/delete/{id}', [RequestHiringController::class, 'destroy'])->name('requests.destroy');

    Route::group(['prefix' => 'users'], function () {

        Route::resource('/', UserController::class)->names([
            'index' => 'users.index',
            'create' => 'users.create',
            'store' => 'users.store',
            'update' => 'users.update',
            'edit' => 'users.edit',
            // 'destroy' => 'users.destroy',
            'show' => 'users.show',
        ])->parameter('', 'user');
    });
    Route::group(['prefix' => 'requests'], function () {
        Route::post('/export_requests', [RequestHiringController::class, 'export'])->name('requests.export');

        Route::resource('/', RequestHiringController::class)->names([
            'index' => 'requests.index',
            'destroy' => 'requests.destroy',
            'show' => 'requests.show',
        ])->parameter('', 'request');
    });

    Route::group(['prefix' => 'positions'], function () {

        Route::resource('/', PositionController::class)->names([
            'index' => 'positions.index',
            'create' => 'positions.create',
            'store' => 'positions.store',
            'update' => 'positions.update',
            'edit' => 'positions.edit',
            'destroy' => 'positions.destroy',
            'show' => 'positions.show',
        ])->parameter('', 'position');
    });

    Route::group(['prefix' => 'levels'], function () {

        Route::resource('/', LevelController::class)->names([
            'index' => 'levels.index',
            'create' => 'levels.create',
            'store' => 'levels.store',
            'update' => 'levels.update',
            'edit' => 'levels.edit',
            'destroy' => 'levels.destroy',
            'show' => 'levels.show',
        ])->parameter('', 'level');
    });

    Route::group(['prefix' => 'roles'], function () {

        Route::post('/export', [RoleController::class, 'export'])->name('roles.export');
        Route::get('/roles/delete/{id}/', [RoleController::class, 'delete'])->name('roles.destroy');
        Route::resource('/', RoleController::class)->names([
            'index' => 'roles.index',
            'create' => 'roles.create',
            'store' => 'roles.store',
            'update' => 'roles.update',
            'edit' => 'roles.edit',
            'show' => 'roles.show',
        ])->parameter('', 'role');
    });

    Route::group(['prefix' => 'permissions'], function () {

        Route::post('/export', [PermissionController::class, 'export'])->name('permissions.export');
        Route::get('/delete/{id}/', [PermissionController::class, 'delete'])->name('permissions.destroy');
        Route::resource('/', PermissionController::class)->names([
            'index' => 'permissions.index',
            'create' => 'permissions.create',
            'store' => 'permissions.store',
            'update' => 'permissions.update',
            'edit' => 'permissions.edit',

            'show' => 'permissions.show',
        ])->parameter('', 'permission');
    });




    Route::group(['prefix' => 'pages'], function () {
        Route::get('pages/{page}/editor', [PageController::class,'editor'])->name('pages.editor');
        Route::resource('/', PageController::class)->names([
            'index' => 'pages.index',
            'create' => 'pages.create',
            'store' => 'pages.store',
            'update' => 'pages.update',
            'edit' => 'pages.edit',
            'destroy' => 'pages.destroy',
            // 'show' => 'pages.show',
        ])->parameter('', 'page');
    });

    Route::group(['prefix' => 'forms'], function () {
        Route::post('/export', [FormController::class, 'export'])->name('forms.export');
        Route::get('data/{id}', [FormController::class, 'formData'])->name('forms.data');
        Route::resource('/', FormController::class)->names([
            'index' => 'forms.index',
            'create' => 'forms.create',
            'store' => 'forms.store',
            'update' => 'forms.update',
            'edit' => 'forms.edit',
            'destroy' => 'forms.destroy',
            'show' => 'forms.show',
        ])->parameter('', 'form');
    });



});
Route::get('/error', [RoleController::class, 'error'])->name('error.view');
Route::get('pro',function(){
    return view('Dashboard.dashboard.requests.show');
});
Route::get('/form', [FormController::class, 'create']);

require __DIR__.'/auth.php';
