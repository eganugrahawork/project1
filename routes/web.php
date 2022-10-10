<?php
// Admin
use App\Http\Controllers\Admin\CoaController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ItemsController;
use App\Http\Controllers\Admin\PriceManagementController;
use App\Http\Controllers\Admin\PrincipalController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\UoMController;
use App\Http\Controllers\Admin\UserMenuController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\UserSubmenuController;
// End Admin

// Utils
use Illuminate\Support\Facades\Route;

// End Utils
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


// Profile Start
Route::middleware(['auth'])->controller(ProfileController::class)->group(function(){
    Route::get('admin/myprofile', 'index');
    Route::get('admin/myprofile/edit', 'editmyprofile');
    Route::post('admin/myprofile/update', 'update');
});
// Profile End

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
    Route::post('/admin/configuration/useraccessmenu/changesubmenu', 'changeaccesssubmenu')->name('changeaccesssubmenu');
    Route::post('/admin/configuration/useraccessmenu/permissionmenu', 'permissionmenu')->name('permissionmenu');
    Route::post('/admin/configuration/useraccessmenu/permissionsubmenu', 'permissionsubmenu')->name('permissionsubmenu');
    Route::get('admin/configuration/useraccessmenu/editcustomaccess/{id}', 'editcustomaccess');
    Route::post('/admin/configuration/useraccessmenu/blockaccess', 'blockaccess');
    Route::post('/admin/configuration/useraccessmenu/unblockaccess', 'unblockaccess');
    Route::get('/admin/configuration/useraccessmenu/editpermissionmodal/{id}', 'editpermissionmodal');
    Route::post('/admin/configuration/useraccessmenu/storepermissionmenu', 'storepermissionmenu');
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


// Lokasi Start
Route::middleware(['auth'])->controller(RegionController::class)->group(function(){
    Route::get('admin/configuration/location/editmodal/{id}', 'editmodal');
    Route::get('admin/configuration/location/delete/{id}', 'destroy');
    Route::post('admin/configuration/location/store', 'store');
    Route::post('admin/configuration/location/update', 'update');
});
// Lokasi End


// Items start
Route::middleware(['auth'])->controller(ItemsController::class)->group(function(){
    Route::get('admin/masterdata/items', 'index');
    Route::post('admin/masterdata/items/store', 'store');
    Route::post('admin/masterdata/items/update', 'update');
    Route::get('admin/masterdata/items/addmodal', 'addmodal');
    Route::get('admin/masterdata/items/editmodal/{id}', 'editmodal');
    Route::get('admin/masterdata/items/delete/{id}', 'destroy');

});

// Principal Start
Route::middleware(['auth'])->controller(PrincipalController::class)->group(function(){
    Route::get('admin/masterdata/principal', 'index');
    Route::post('admin/masterdata/principal/store', 'store');
    Route::post('admin/masterdata/principal/update', 'update');
    Route::get('admin/masterdata/principal/delete/{id}', 'destroy');
    Route::get('admin/masterdata/principal/editmodal/{id}', 'editmodal');
    Route::get('admin/masterdata/principal/addmodal', 'addmodal');
});
// Principal End

// UoM Start
Route::middleware(['auth'])->controller(UoMController::class)->group(function(){
    Route::get('admin/masterdata/uom', 'index');
    Route::get('admin/masterdata/uom/addmodal', 'addmodal');
    Route::get('admin/masterdata/uom/editmodal/{id}', 'editmodal');
    Route::get('admin/masterdata/uom/delete/{id}', 'destroy');
    Route::post('admin/masterdata/uom/store', 'store');
    Route::post('admin/masterdata/uom/update', 'update');
});
//End UoM

//Customer
Route::middleware(['auth'])->controller(CustomerController::class)->group(function(){
    Route::get('admin/masterdata/customer', 'index');
    Route::get('admin/masterdata/customer/addmodal', 'addmodal');
    Route::get('admin/masterdata/customer/editmodal/{id}', 'editmodal');
    Route::get('admin/masterdata/customer/delete/{id}', 'destroy');
    Route::post('admin/masterdata/customer/store', 'store');
    Route::post('admin/masterdata/customer/update', 'update');
});
// End

// PriceManagement
Route::middleware(['auth'])->controller(PriceManagementController::class)->group(function(){
    Route::get('admin/masterdata/pricemanagement','index');
    Route::get('admin/masterdata/pricemanagement/editmodal/{id}','editmodal');
    Route::post('admin/masterdata/pricemanagement/update', 'update');
});
// End PriceManagement

// Coa
Route::middleware(['auth'])->controller(CoaController::class)->group(function(){
    Route::get('admin/masterdata/coa', 'index');
    Route::get('admin/masterdata/coa/addmodal', 'addmodal');
    Route::get('admin/masterdata/coa/editmodal/{id}','editmodal');
    Route::post('admin/masterdata/coa/store', 'store');
    Route::post('admin/masterdata/coa/update', 'update');
    Route::get('admin/masterdata/coa/delete/{id}', 'destroy');
});

// End Coa
//Blocked Page Start
Route::get('/blocked', function(){
    return view('admin.blocked');
});
//Blocked Page End




