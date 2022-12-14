<?php
// Admin

use App\Http\Controllers\Admin\Cashier\CashierController;
use App\Http\Controllers\Admin\Configuration\ConfigurationController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
// End Admin

// Configuration
use App\Http\Controllers\Admin\Configuration\MenuController;
use App\Http\Controllers\Admin\Configuration\ProfileController;
use App\Http\Controllers\Admin\Configuration\RegionController;
use App\Http\Controllers\Admin\Configuration\UserRoleController;
// End Configuration

// Dashboard
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Inventory\ReportInventoryController;
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
use App\Http\Controllers\Admin\Masterdata\TypeItemController;
use App\Http\Controllers\Admin\Masterdata\TypePartnerController;
// End Masterdata

// Start Procurement
use App\Http\Controllers\Admin\Procurement\PurchaseOrderController;
use App\Http\Controllers\Admin\Procurement\InvoiceProcurementController;
use App\Http\Controllers\Admin\Procurement\ItemsReceiptController;
use App\Http\Controllers\Admin\Procurement\PurchaseBasisController;
// End Procurement

// Strt Inventory
use App\Http\Controllers\Admin\Inventory\StockController;
use App\Http\Controllers\Admin\Inventory\StockInTransitController;
use App\Http\Controllers\Admin\Procurement\ReportProcurementController;
use App\Http\Controllers\Admin\Procurement\ReturnProcurementController;
use App\Http\Controllers\Admin\Selling\InvoiceSellingController;
use App\Http\Controllers\Admin\Selling\ReportSellingController;
use App\Http\Controllers\Admin\Selling\SellingController;
use App\Http\Controllers\ReturnSellingController;
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
    return view('welcome');
});

Route::middleware(['guest'])->controller(RegisterController::class)->group(function () {
    Route::post('/register/update', 'update');
    Route::post('/register/create', 'create');
    Route::get('/register_verify', 'register_verify');
    Route::post('/checkemail', 'checkemail');
});

Route::middleware(['guest'])->controller(ForgotPasswordController::class)->group(function () {
    Route::get('/forgot-password', 'show');
    Route::post('/forgot-password/sendemail', 'sendemail');
    Route::post('/forgot-password/checkemail', 'checkemail');
    Route::get('/reset-password', 'reset_password');
    Route::post('/reset-password/submit', 'reset_password_submit');
});


Auth::routes();



Route::middleware(['auth'])->controller(ConfigurationController::class)->group(function () {
    Route::get('/admin/useractivity',  'useractivity');
    Route::get('/admin/readallnotif',  'readallnotif');
    Route::get('/admin/read/{id}',  'read');
    Route::get('/admin/listuseractivity',  'listuseractivity');
    Route::get('/admin/checknotification',  'checknotification');
    Route::get('/admin/listuseronline',  'listuseronline');
    Route::get('/admin/listnotification ',  'listnotification');
    Route::get('/admin/changedarkmode ',  'changedarkmode');
    // Route::get('/admin/openchat/{id} ',  'openchat']);
});


//Dashboard
// Route::get('/admin/checkonline', [DashboardController::class, 'checkonline'])->middleware('auth');
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->middleware('auth');

//End Dashboard


// GET IP menggunakan package geoip yang sudah diinstal barangkali dibutuhkan
// Route::get('/ip', function(){
//     $checkLocation = geoip()->getLocation($_SERVER['REMOTE_ADDR']);
//     return $checkLocation->toArray();
// });
// END GET API


// Profile Start
Route::middleware(['auth'])->controller(ProfileController::class)->group(function () {
    Route::get('admin/myprofile', 'index');
    Route::get('admin/myprofile/edit', 'editmyprofile');
    Route::post('admin/myprofile/update', 'update');
});
// Profile End

//Menu Start
Route::middleware(['auth'])->controller(MenuController::class)->group(function () {
    Route::get('admin/configuration/menu',  'index');
    Route::post('admin/configuration/menu/store', 'store');
    Route::post('admin/configuration/menu/update', 'update');
    Route::get('admin/configuration/menu/editmodal/{id}', 'editmodal');
    Route::get('admin/configuration/menu/delete/{id}', 'destroy');
    Route::get('/admin/loadmenu/{parent}/{role_id}', 'loadmenu')->middleware('auth');
});
//End Menu


//UserAccessMenu Start
Route::middleware(['auth'])->controller(UserRoleController::class)->group(function () {
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
Route::middleware(['auth'])->controller(RegionController::class)->group(function () {
    Route::get('admin/configuration/location/editmodal/{id}', 'editmodal');
    Route::get('admin/configuration/location/delete/{id}', 'destroy');
    Route::post('admin/configuration/location/store', 'store');
    Route::post('admin/configuration/location/update', 'update');
});
// Lokasi End

//Users Start
Route::middleware(['auth'])->controller(UsersController::class)->group(function () {
    Route::get('admin/users', 'index');
    Route::get('admin/users/list', 'list');
    Route::get('admin/users/create', 'create');
    Route::get('admin/users/edit/{id}', 'edit');
    Route::get('admin/users/show/{id}', 'show');
    Route::post('admin/users/store', 'store');
    Route::post('admin/users/update', 'update');
    Route::get('admin/users/delete/{id}', 'destroy');
    Route::post('admin/users/checkusername', 'checkusername');
    Route::post('admin/users/checkemail', 'checkemail');
    Route::get('admin/users/export', 'export');

});
//Users END


// Items start
Route::middleware(['auth'])->controller(ItemsController::class)->group(function () {
    Route::get('admin/masterdata/items', 'index');
    Route::get('admin/masterdata/items/list', 'list');
    Route::get('admin/masterdata/items/create', 'create');
    Route::post('admin/masterdata/items/store', 'store');
    Route::get('admin/masterdata/items/edit/{id}', 'edit');
    Route::post('admin/masterdata/items/update', 'update');
    Route::get('admin/masterdata/items/info/{id}', 'info');
    Route::get('admin/masterdata/items/getinfoitemreceipt/{id}', 'getinfoitemreceipt');
    Route::get('admin/masterdata/items/delete/{id}', 'destroy');

// Another
    Route::get('/admin/masterdata/itemqty', 'itemqty');
    Route::get('/admin/masterdata/itemprice', 'itemprice');
// End Another
});


// Type Items
Route::middleware(['auth'])->controller(TypeItemController::class)->group(function () {
    Route::get('/admin/masterdata/typeitems', 'index');
    Route::get('/admin/masterdata/typeitems/list', 'list');
    Route::get('/admin/masterdata/typeitems/create', 'create');
    Route::get('/admin/masterdata/typeitems/edit/{id}', 'edit');
    Route::post('/admin/masterdata/typeitems/store', 'store');
    Route::post('/admin/masterdata/typeitems/update', 'update');
    Route::get('/admin/masterdata/typeitems/delete/{id}', 'destroy');
});
// End Type Items

// Partners Start
Route::middleware(['auth'])->controller(PartnersController::class)->group(function () {
    Route::get('admin/masterdata/partners', 'index');
    Route::get('admin/masterdata/partners/list', 'list');
    Route::get('admin/masterdata/partners/info/{id}', 'info');
    Route::get('admin/masterdata/partners/create', 'create');
    Route::post('admin/masterdata/partners/store', 'store');
    Route::get('admin/masterdata/partners/edit/{id}', 'edit');
    Route::post('admin/masterdata/partners/update', 'update');
    Route::get('admin/masterdata/partners/delete/{id}', 'destroy');
    Route::get('admin/masterdata/partners/getinfoitem/{id}', 'getinfoitem');
});
// Partners End

// Type Partner
Route::middleware(['auth'])->controller(TypePartnerController::class)->group(function () {
    Route::get('admin/masterdata/typeofpartner', 'index');
    Route::get('admin/masterdata/typepartners/list', 'list');
    Route::get('admin/masterdata/typepartners/create', 'create');
    Route::post('admin/masterdata/typepartners/store', 'store');
    Route::get('admin/masterdata/typepartners/edit/{id}', 'edit');
    Route::post('admin/masterdata/typepartners/update', 'update');
    Route::get('admin/masterdata/typepartners/destroy/{id}', 'destroy');
});

// End Type Partner

// UoM Start
Route::middleware(['auth'])->controller(UoMController::class)->group(function () {
    Route::get('admin/masterdata/uom', 'index');
    Route::get('admin/masterdata/uom/list', 'list');
    Route::get('admin/masterdata/uom/create', 'create');
    Route::get('admin/masterdata/uom/edit/{id}', 'edit');
    Route::get('admin/masterdata/uom/delete/{id}', 'destroy');
    Route::post('admin/masterdata/uom/store', 'store');
    Route::post('admin/masterdata/uom/update', 'update');
});
//End UoM

//Customer
Route::middleware(['auth'])->controller(CustomerController::class)->group(function () {
    Route::get('admin/masterdata/customer', 'index');
    Route::get('admin/masterdata/customer/addmodal', 'addmodal');
    Route::get('admin/masterdata/customer/editmodal/{id}', 'editmodal');
    Route::get('admin/masterdata/customer/delete/{id}', 'destroy');
    Route::post('admin/masterdata/customer/store', 'store');
    Route::post('admin/masterdata/customer/update', 'update');
});
// End

// PriceManagement
Route::middleware(['auth'])->controller(PriceManagementController::class)->group(function () {
    Route::get('admin/masterdata/pricemanagement', 'index');
    Route::get('admin/masterdata/pricemanagement/editmodal/{id}', 'editmodal');
    Route::post('admin/masterdata/pricemanagement/update', 'update');
});
// End PriceManagement

// Coa
Route::middleware(['auth'])->controller(CoaController::class)->group(function () {
    Route::get('admin/masterdata/coa', 'index');
    Route::get('admin/masterdata/coa/list', 'list');
    Route::get('admin/masterdata/coa/create', 'create');
    Route::get('admin/masterdata/coa/edit/{id}', 'edit');
    Route::post('admin/masterdata/coa/store', 'store');
    Route::post('admin/masterdata/coa/update', 'update');
    Route::get('admin/masterdata/coa/delete/{id}', 'destroy');
});
// End Coa


// Purchase Order
Route::middleware(['auth'])->controller(PurchaseOrderController::class)->group(function () {
    Route::get('/admin/procurement/purchase-order', 'index');
    Route::get('/admin/procurement/purchase-order/list', 'list');
    Route::get('/admin/procurement/purchase-order/create', 'create');
    Route::get('/admin/procurement/purchase-order/getitem/{id}', 'getitem');
    Route::get('/admin/procurement/purchase-order/getallitem', 'getallitem');
    Route::get('/admin/procurement/purchase-order/getbackitem/{id}', 'getbackitem');
    Route::get('/admin/procurement/purchase-order/getcurrency/{id}', 'getcurrency');
    Route::get('/admin/procurement/purchase-order/getbaseqty/{id}', 'getbaseqty');
    Route::get('/admin/procurement/purchase-order/addnewitemrow/{id}', 'addnewitemrow');
    Route::get('/admin/procurement/purchase-order/edit/{id}', 'edit');
    Route::get('/admin/procurement/purchase-order/info/{id}', 'info');
    Route::get('/admin/procurement/purchase-order/approveview/{id}', 'approveview');
    Route::get('/admin/procurement/purchase-order/approve/{id}', 'approve');
    Route::get('/admin/procurement/purchase-order/reject/{id}', 'reject');
    Route::get('/admin/procurement/purchase-order/delete/{id}', 'destroy');
    Route::post('/admin/procurement/purchase-order/store', 'store');
    Route::post('/admin/procurement/purchase-order/update', 'update');
    Route::get('/admin/procurement/purchase-order/exportpdf/{id}', 'exportpdf');
});
//End Purchase Order

// Items Receipt
Route::middleware('auth')->controller(ItemsReceiptController::class)->group(function () {
    Route::get('/admin/procurement/items-receipt', 'index');
    Route::get('/admin/procurement/items-receipt/list', 'list');
    Route::get('/admin/procurement/items-receipt/create', 'create');
    Route::get('/admin/procurement/items-receipt/info/{id}', 'info');
    Route::get('/admin/procurement/items-receipt/edit/{id}', 'edit');
    Route::get('/admin/procurement/items-receipt/getdatapo/{id}', 'getdatapo');
    Route::post('/admin/procurement/items-receipt/store', 'store');
    Route::post('/admin/procurement/items-receipt/update', 'update');
    Route::get('/admin/procurement/items-receipt/delete/{id}', 'destroy');
});
// End Items Receipt

// Procurement Invoice
Route::middleware('auth')->controller(InvoiceProcurementController::class)->group(function () {
    Route::get('/admin/procurement/invoice', 'index');
    Route::get('/admin/procurement/invoice/list', 'list');
    Route::get('/admin/procurement/invoice/create', 'create');
    Route::post('/admin/procurement/invoice/store', 'store');
    Route::get('/admin/procurement/invoice/edit/{id}', 'edit');
    Route::post('/admin/procurement/invoice/update', 'update');
    Route::get('/admin/procurement/invoice/info/{id}', 'info');
    Route::get('/admin/procurement/invoice/delete/{id}', 'destroy');
    Route::get('/admin/procurement/invoice/getdata/{id}', 'getdata');
    Route::get('/admin/procurement/invoice/exportpdf/{id}', 'exportpdf');
});
// End Procurement Invoice


// Procurement Retur Start
Route::middleware('auth')->controller(ReturnProcurementController::class)->group(function () {
    Route::get('/admin/procurement/retur', 'index');
    Route::get('/admin/procurement/retur/list', 'list');
    Route::get('/admin/procurement/retur/create', 'create');
    Route::post('/admin/procurement/retur/store', 'store');
    Route::get('/admin/procurement/retur/approveview/{id}', 'approveview');
    Route::get('/admin/procurement/retur/approve/{id}', 'approve');
    Route::get('/admin/procurement/retur/info/{id}', 'info');
    Route::get('/admin/procurement/retur/edit/{id}', 'edit');
    Route::post('/admin/procurement/retur/update', 'update');
    Route::get('/admin/procurement/retur/delete/{id}', 'destroy');
    Route::get('/admin/procurement/retur/getdata/{id}', 'getdata');
});
// Procurement Retur End

// Report Procurement
Route::middleware('auth')->controller(ReportProcurementController::class)->group(function () {
    Route::get('/admin/procurement/report', 'index');
    Route::get('/admin/procurement/report/list/{partner_id}/{date_range}', 'list');
});
// End Report Procurement

// Stock
Route::middleware('auth')->controller(StockController::class)->group(function () {
    Route::get('/admin/inventory/stock', 'index');
    Route::get('/admin/inventory/stock/list', 'list');
});
// End Stock

// Stock in Transit
Route::middleware('auth')->controller(StockInTransitController::class)->group(function () {
    Route::get('/admin/inventory/stock-in-transit', 'index');
    Route::post('/admin/inventory/stock-in-transit/filter', 'filter');
    Route::get('/admin/inventory/stock-in-transit/create', 'create');
    Route::get('/admin/inventory/stock-in-transit/addnewitemrow', 'addnewitemrow');
});
// End Stock In Transit

// Report Inventory
Route::middleware('auth')->controller(ReportInventoryController::class)->group(function () {
    Route::get('/admin/inventory/report', 'index');
    Route::get('/admin/inventory/report/list/{partner_id}/{date_range}', 'list');
});
// End Report Inventory

// Selling
Route::middleware('auth')->controller(SellingController::class)->group(function () {
    Route::get('/admin/selling/selling', 'index');
    Route::get('/admin/selling/selling/create', 'create');
});
// End Selling

// Invoice Selling
Route::middleware('auth')->controller(InvoiceSellingController::class)->group(function () {
    Route::get('/admin/selling/invoice', 'index');
});

// End Invoice Selling

// Return Selling
Route::middleware('auth')->controller(ReturnSellingController::class)->group(function () {
    Route::get('/admin/selling/return', 'index');
    Route::get('/admin/selling/return/list/{partner_id}/{date_range}', 'list');
});
// End Return Selling

// Report selling
Route::middleware('auth')->controller(ReportSellingController::class)->group(function () {
    Route::get('/admin/selling/report', 'index');
    Route::get('/admin/selling/report/list/{partner_id}/{date_range}', 'list');
});
// End Report selling


Route::middleware('auth')->controller(CashierController::class)->group(function () {
    Route::get('/admin/cashier', 'index');
});
//Cashier


//End Cashier


//Blocked Page Start
Route::get('/blocked', function () {
    return view('admin.blocked');
});
//Blocked Page End
