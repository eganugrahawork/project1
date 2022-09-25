<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserAccessMenuController;
use App\Http\Controllers\Admin\UserMenuController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\UserSubmenuController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
})->middleware('guest');

Auth::routes();

//Dashboard
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('auth');
//End Dashboard

//UserMenu Start
Route::middleware(['auth'])->controller(UserMenuController::class)->group(function(){
    Route::get('admin/configuration/menu',  'index');
    Route::post('admin/configuration/menu/store', 'store');
    Route::post('admin/configuration/menu/update', 'update');
    Route::get('admin/configuration/menu/delete/{id}', 'destroy');
});
//End UserMenu

//UserSubmenu Start
Route::middleware(['auth'])->controller(UserSubmenuController::class)->group(function(){
    Route::get('admin/configuration/submenu', 'index');
    Route::post('/admin/configuration/submenu/store', 'store');
    Route::post('/admin/configuration/submenu/update', 'update');
    Route::get('/admin/configuration/submenu/delete/{id}', 'destroy');
});
//UserSubmenu End

//UserAccessMenu Start
Route::middleware(['auth'])->controller(UserRoleController::class)->group(function(){
    Route::get('admin/configuration/userrole', 'index');
    Route::post('admin/configuration/userrole/store', 'store');
    Route::post('admin/configuration/userrole/update', 'update');
    Route::get('admin/configuration/userrole/delete/{id}', 'destroy');
    Route::get('admin/configuration/useraccessmenu/{id}', 'viewuseraccess')->name('viewaccess');
    Route::post('/admin/configuration/useraccessmenu/change', 'changeaccess')->name('changeaccess');
});
//UserAccessMenu End

//Users Start
Route::middleware(['auth'])->controller(UsersController::class)->group(function(){
    Route::get('admin/users', 'index');
    Route::get('admin/users/create', 'create');
    Route::post('admin/users/store', 'store');
    Route::get('admin/users/edit/{id}', 'edit');
    Route::post('admin/users/update', 'update');
    Route::get('admin/users/delete/{id}', 'destroy');
});
//Users END

// Profile Start
Route::middleware(['auth'])->controller(ProfileController::class)->group(function(){
    Route::get('admin/profile', 'index');
    Route::post('admin/profile/update', 'update');
});
// Profile End

//Blocked Page Start
Route::get('/blocked', function(){
    return view('admin.blocked');
});
//Blocked Page End


