<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserAccessMenuController;
use App\Http\Controllers\Admin\UserMenuController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\UserSubmenuController;
use App\Http\Controllers\LokasiController;
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
Route::get('/admin/useractivity', [DashboardController::class, 'useractivity'])->middleware('auth');
//End Dashboard

// My Profile Start
Route::middleware(['auth'])->controller(DashboardController::class)->group(function(){
    Route::get('admin/myprofile', 'myprofile');
    Route::get('admin/myprofile/edit', 'editmyprofile');
    Route::post('admin/myprofile/updateprofile', 'updateprofile');
});

// End My Profile

//UserMenu Start
Route::middleware(['auth'])->controller(UserMenuController::class)->group(function(){
    Route::get('admin/configuration/menu',  'index');
    Route::post('admin/configuration/menu/store', 'store');
    Route::post('admin/configuration/menu/update', 'update');
    Route::get('admin/configuration/menu/editmodal/{id}', 'editmodal');
    Route::get('admin/configuration/menu/delete/{id}', 'destroy');
});
//End UserMenu

//UserSubmenu Start
Route::middleware(['auth'])->controller(UserSubmenuController::class)->group(function(){
    Route::get('admin/configuration/submenu', 'index');
    Route::post('/admin/configuration/submenu/store', 'store');
    Route::post('/admin/configuration/submenu/update', 'update');
    Route::get('/admin/configuration/submenu/delete/{id}', 'destroy');
    Route::get('/admin/configuration/submenu/editmodal/{id}', 'editmodal');
});
//UserSubmenu End

//UserAccessMenu Start
Route::middleware(['auth'])->controller(UserRoleController::class)->group(function(){
    Route::get('admin/configuration/userrole/viewrole/{id}', 'viewrole');
    Route::post('admin/configuration/userrole/store', 'store');
    Route::post('admin/configuration/userrole/update', 'update');
    Route::get('admin/configuration/userrole/editmodalrole/{id}', 'editmodalrole');
    Route::get('admin/configuration/userrole/delete/{id}', 'destroy');
    Route::get('admin/configuration/useraccessmenu/{id}', 'viewuseraccess')->name('viewaccess');
    Route::get('admin/configuration/useraccessmenu/editmodalaccess/{id}', 'editmodalaccess');
    Route::post('/admin/configuration/useraccessmenu/change', 'changeaccess')->name('changeaccess');
    Route::get('admin/configuration/useraccessmenu/editcustomaccess/{id}', 'editcustomaccess');
    Route::post('/admin/configuration/useraccessmenu/blockaccess', 'blockaccess');
    Route::post('/admin/configuration/useraccessmenu/unblockaccess', 'unblockaccess');

});
//UserAccessMenu End

//Users Start
Route::middleware(['auth'])->controller(UsersController::class)->group(function(){
    Route::get('admin/users', 'index');
    Route::get('admin/users/show/{id}', 'show');
    Route::get('admin/users/create', 'create');
    Route::post('admin/users/store', 'store');
    Route::get('admin/users/edit/{id}', 'edit');
    Route::post('admin/users/update', 'update');
    Route::get('admin/users/delete/{id}', 'destroy');
    Route::post('admin/users/checkusername', 'checkusername');
    Route::post('admin/users/checkemail', 'checkemail');
    Route::get('admin/users/editmodal/{id}', 'editmodal');
});
//Users END

// Profile Start
Route::middleware(['auth'])->controller(ProfileController::class)->group(function(){
    Route::get('admin/profile', 'index');
    Route::post('admin/profile/update', 'update');
});
// Profile End

// Lokasi Start
Route::middleware(['auth'])->controller(LokasiController::class)->group(function(){
    Route::get('admin/configuration/location/editmodal/{id}', 'editmodal');
    Route::get('admin/configuration/location/delete/{id}', 'destroy');
    Route::post('admin/configuration/location/store', 'store');
    Route::post('admin/configuration/location/update', 'update');
});

// Lokasi End

//Blocked Page Start
Route::get('/blocked', function(){
    return view('admin.blocked');
});
//Blocked Page End


