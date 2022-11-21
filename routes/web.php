<?php
// Admin
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
// End Admin

// Dashboard
use App\Http\Controllers\Admin\Dashboard\DashboardController;
// End Dashboard

// Users
use App\Http\Controllers\Admin\Users\UsersController;
// End Users

// Masterdata
use App\Http\Controllers\Admin\Masterdata\CoaController;
use App\Http\Controllers\Admin\Masterdata\ItemsController;
use App\Http\Controllers\Admin\Masterdata\PartnersController;
use App\Http\Controllers\Admin\Masterdata\PriceManagementController;
use App\Http\Controllers\Admin\Masterdata\UoMController;
// End Masterdata

// Start Procurement
use App\Http\Controllers\Admin\Procurement\PurchaseOrderController;
use App\Http\Controllers\Admin\Procurement\ItemsReceiptController;
use App\Http\Controllers\Admin\Procurement\PurchaseBasisController;
// End Procurement

// Strt Inventory
use App\Http\Controllers\Admin\Inventory\StockController;
use App\Http\Controllers\Admin\Inventory\StockInTransitController;
use App\Http\Controllers\Admin\Selling\SellingController;
// End Inventory


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

Route::middleware(['guest'])->controller(RegisterController::class)->group(function(){
    Route::post('/register/update', 'update');
    Route::post('/register/create', 'create');
    Route::get('/register_verify', 'register_verify');
    Route::post('/checkemail', 'checkemail');
});

Route::middleware(['guest'])->controller(ForgotPasswordController::class)->group(function(){
    Route::get('/forgot-password', 'show');
    Route::post('/forgot-password/sendemail', 'sendemail');
    Route::post('/forgot-password/checkemail', 'checkemail');
    Route::get('/reset-password', 'reset_password');
    Route::post('/reset-password/submit', 'reset_password_submit');
});


Auth::routes();

//Dashboard
// Route::get('/admin/checkonline', [DashboardController::class, 'checkonline'])->middleware('auth');
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/admin/useractivity', [DashboardController::class, 'useractivity'])->middleware('auth');
Route::get('/admin/readallnotif', [DashboardController::class, 'readallnotif'])->middleware('auth');
Route::get('/admin/read/{id}', [DashboardController::class, 'read'])->middleware('auth');
Route::get('/admin/listuseractivity', [DashboardController::class, 'listuseractivity'])->middleware('auth');
Route::get('/admin/checknotification', [DashboardController::class, 'checknotification'])->middleware('auth');
Route::get('/admin/listuseronline', [DashboardController::class, 'listuseronline'])->middleware(['auth']);
Route::get('/admin/listnotification ', [DashboardController::class, 'listnotification'])->middleware(['auth']);
// Route::get('/admin/openchat/{id} ', [DashboardController::class, 'openchat'])->middleware(['auth']);
//End Dashboard


// GET IP menggunakan package geoip yang sudah diinstal barangkali dibutuhkan
// Route::get('/ip', function(){
//     $checkLocation = geoip()->getLocation($_SERVER['REMOTE_ADDR']);
//     return $checkLocation->toArray();
// });
// END GET API


// Profile Start
Route::middleware(['auth'])->controller(ProfileController::class)->group(function(){
    Route::get('admin/myprofile', 'index');
    Route::get('admin/myprofile/edit', 'editmyprofile');
    Route::post('admin/myprofile/update', 'update');
});
// Profile End

//Menu Start
Route::middleware(['auth'])->controller(MenuController::class)->group(function(){
    Route::get('admin/configuration/menu',  'index');
    Route::post('admin/configuration/menu/store', 'store');
    Route::post('admin/configuration/menu/update', 'update');
    Route::get('admin/configuration/menu/editmodal/{id}', 'editmodal');
    Route::get('admin/configuration/menu/delete/{id}', 'destroy');
    Route::get('/admin/loadmenu/{parent}/{role_id}', 'loadmenu')->middleware('auth');
});
//End Menu


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
    Route::post('/admin/configuration/useraccessmenu/permissionmenu', 'permissionmenu')->name('permissionmenu');
    Route::get('admin/configuration/useraccessmenu/editcustomaccess/{id}', 'editcustomaccess');
    Route::post('/admin/configuration/useraccessmenu/blockaccess', 'blockaccess');
    Route::post('/admin/configuration/useraccessmenu/unblockaccess', 'unblockaccess');
    Route::get('/admin/configuration/useraccessmenu/editpermissionmodal/{id}', 'editpermissionmodal');
});
//UserAccessMenu End

// Lokasi Start
Route::middleware(['auth'])->controller(RegionController::class)->group(function(){
    Route::get('admin/configuration/location/editmodal/{id}', 'editmodal');
    Route::get('admin/configuration/location/delete/{id}', 'destroy');
    Route::post('admin/configuration/location/store', 'store');
    Route::post('admin/configuration/location/update', 'update');
});
// Lokasi End

//Users Start
Route::middleware(['auth'])->controller(UsersController::class)->group(function(){
    Route::get('admin/users', 'index');
    Route::get('admin/users/list', 'list');
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


// Items start
Route::middleware(['auth'])->controller(ItemsController::class)->group(function(){
    Route::get('admin/masterdata/items', 'index');
    Route::get('admin/masterdata/items/list', 'list');
    Route::post('admin/masterdata/items/store', 'store');
    Route::post('admin/masterdata/items/update', 'update');
    Route::get('admin/masterdata/items/addmodal', 'addmodal');
    Route::get('admin/masterdata/items/infomodal/{id}', 'infomodal');
    Route::get('admin/masterdata/items/getinfoitemreceipt/{id}', 'getinfoitemreceipt');
    Route::get('admin/masterdata/items/editmodal/{id}', 'editmodal');
    Route::get('admin/masterdata/items/delete/{id}', 'destroy');
    Route::get('admin/masterdata/typeitems', 'typeitems');
    Route::get('/admin/masterdata/typeitems/addmodal', 'typeitemsaddmodal');
    Route::get('/admin/masterdata/typeitems/editmodal/{id}', 'typeitemseditmodal');
    Route::post('/admin/masterdata/typeitems/store', 'typeitemsstore');
    Route::post('/admin/masterdata/typeitems/update', 'typeitemsupdate');
    Route::get('/admin/masterdata/typeitems/delete/{id}', 'typeitemsdelete');
    Route::get('/admin/masterdata/itemqty', 'itemqty');
    Route::get('/admin/masterdata/itemprice', 'itemprice');
    Route::get('/admin/masterdata/itemprice/addmodal', 'addModalItemPrice');
    Route::get('/admin/masterdata/itemprice/getdetailitem/{id}', 'getdetailitem');
    Route::post('/admin/masterdata/itemprice/store', 'storeitemprice');
    Route::get('/admin/masterdata/itemprice/editmodal/{id}', 'editmodalitemprice');
    Route::post('/admin/masterdata/itemprice/update', 'updateitemprice');
});


// Partners Start
Route::middleware(['auth'])->controller(PartnersController::class)->group(function(){
    Route::get('admin/masterdata/partners', 'index');
    Route::get('admin/masterdata/partners/list', 'list');
    Route::post('admin/masterdata/partners/store', 'store');
    Route::post('admin/masterdata/partners/update', 'update');
    Route::get('admin/masterdata/partners/delete/{id}', 'destroy');
    Route::get('admin/masterdata/partners/infomodal/{id}', 'infomodal');
    Route::get('admin/masterdata/partners/getinfoitem/{id}', 'getinfoitem');
    Route::get('admin/masterdata/partners/editmodal/{id}', 'editmodal');
    Route::get('admin/masterdata/partners/addmodal', 'addmodal');
    Route::get('admin/masterdata/typeofpartner', 'typeofpartner');
    Route::get('admin/masterdata/partners/listtypeofpartners', 'listtypeofpartners');
    Route::get('admin/masterdata/partners/addtypepartnermodal', 'addtypepartnermodal');
    Route::post('admin/masterdata/partners/storetypepartners', 'storetypepartners');
    Route::get('admin/masterdata/partners/edittypepartnermodal/{id}', 'edittypepartnermodal');
    Route::post('admin/masterdata/partners/updatetypepartners', 'updatetypepartners');
    Route::get('admin/masterdata/partners/destroytypepartners/{id}', 'destroytypepartners');
});
// Principal End


// UoM Start
Route::middleware(['auth'])->controller(UoMController::class)->group(function(){
    Route::get('admin/masterdata/uom', 'index');
    Route::get('admin/masterdata/uom/list', 'list');
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
    Route::get('admin/masterdata/coa/list', 'list');
    Route::get('admin/masterdata/coa/addmodal', 'addmodal');
    Route::get('admin/masterdata/coa/editmodal/{id}','editmodal');
    Route::post('admin/masterdata/coa/store', 'store');
    Route::post('admin/masterdata/coa/update', 'update');
    Route::get('admin/masterdata/coa/delete/{id}', 'destroy');
});
// End Coa


// Purchase Order
Route::middleware(['auth'])->controller(PurchaseOrderController::class)->group(function(){
    Route::get('/admin/procurement/purchase-order', 'index');
    Route::get('/admin/procurement/purchase-order/list', 'list');
    Route::get('/admin/procurement/purchase-order/addmodal', 'addmodal');
    Route::get('/admin/procurement/purchase-order/getitem/{id}', 'getitem');
    Route::get('/admin/procurement/purchase-order/getallitem', 'getallitem');
    Route::get('/admin/procurement/purchase-order/getbackitem/{id}', 'getbackitem');
    Route::get('/admin/procurement/purchase-order/getcurrency/{id}', 'getcurrency');
    Route::get('/admin/procurement/purchase-order/getbaseqty/{id}', 'getbaseqty');
    Route::get('/admin/procurement/purchase-order/addnewitemrow/{id}', 'addnewitemrow');
    Route::get('/admin/procurement/purchase-order/editmodal/{id}', 'editmodal');
    Route::get('/admin/procurement/purchase-order/infomodal/{id}', 'infomodal');
    Route::get('/admin/procurement/purchase-order/aprovedmodal/{id}', 'aprovedmodal');
    Route::get('/admin/procurement/purchase-order/approve/{id}', 'approve');
    Route::get('/admin/procurement/purchase-order/delete/{id}', 'destroy');
    Route::post('/admin/procurement/purchase-order/store', 'store');
    Route::post('/admin/procurement/purchase-order/update', 'update');
    Route::get('/admin/procurement/purchase-order/exportpdf/{id}', 'exportpdf');
});
//End Purchase Order

// Items Receipt
Route::middleware('auth')->controller(ItemsReceiptController::class)->group(function(){
    Route::get('/admin/procurement/items-receipt', 'index');
    Route::get('/admin/procurement/items-receipt/list', 'list');
    Route::get('/admin/procurement/items-receipt/addmodal', 'addmodal');
    Route::get('/admin/procurement/items-receipt/infomodal/{id}', 'infomodal');
    Route::get('/admin/procurement/items-receipt/editmodal/{id}', 'editmodal');
    Route::get('/admin/procurement/items-receipt/getdatapo/{id}', 'getdatapo');
    Route::post('/admin/procurement/items-receipt/store', 'store');
});
// End Items Receipt



// Purchase Basis Start
Route::middleware('auth')->controller(PurchaseBasisController::class)->group(function(){
    Route::get('/admin/procurement/purchase-basis', 'index');
    Route::post('/admin/procurement/purchase-basis/filter', 'filter');
});
// Purchase Basis End

// Stock
Route::middleware('auth')->controller(StockController::class)->group(function(){
    Route::get('/admin/inventory/stock', 'index');
    Route::post('/admin/inventory/stock/filter', 'filter');
});
// End Stock

// Stock in Transit
Route::middleware('auth')->controller(StockInTransitController::class)->group(function(){
    Route::get('/admin/inventory/stock-in-transit', 'index');
    Route::post('/admin/inventory/stock-in-transit/filter', 'filter');
    Route::get('/admin/inventory/stock-in-transit/addtransitmodal', 'addtransitmodal');
});
// End Stock In Transit


// Selling
Route::middleware('auth')->controller(SellingController::class)->group(function(){
    Route::get('/admin/selling/selling', 'index');
});
// End Selling


//Blocked Page Start
Route::get('/blocked', function(){
    return view('admin.blocked');
});
//Blocked Page End




