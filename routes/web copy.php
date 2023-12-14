<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Sales\SalesManagementController;
use App\Http\Controllers\Dealer\DealerController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\DealerManagementController;
use App\Http\Controllers\Auth\CustomCheckAuth;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Dealer\DealerLeadController;
use App\Http\Controllers\Dealer\InventoryController;
use App\Http\Controllers\Frontend\LeadController;
use App\Http\Controllers\Frontend\SiteController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\listing\DealerListingController;
use App\Http\Controllers\listing\InventorylistingController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('frontend.home');
// });

Route::get('/cleareverything', function () {
    $data = [];
    $clearcache = Artisan::call('cache:clear');
    echo "Cache cleared<br>";

    $clearview = Artisan::call('view:clear');
    echo "View cleared<br>";

    $clearconfig = Artisan::call('config:cache');
    echo "Config cleared<br>";

    // $cleardebugbar = Artisan::call('debugbar:clear');
    // echo "Debug Bar cleared<br>";
});

Auth::routes(['register' => false]);

Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/autos/{param?}', [SiteController::class, 'autos'])->name('autos');
Route::get('/auto/{id}', [SiteController::class, 'autoDetails'])->name('auto.details');


//ajax request
Route::get('frontend/model',[InventoryController::class,'makeModelData'])->name('frontend.ajax.model');
Route::post('/update_wishlist',[InventoryController::class,'updateWishList'])->name('update.wishlist');
Route::post('/product-search', [InventoryController::class,'productSearch'])->name('product_search');
Route::get('/auto_ajax',[SiteController::class,'autoAjax'])->name('auto.ajax');
Route::get('/auto_filter_ajax',[SiteController::class,'autoFilterAjax'])->name('auto_filter.ajax');


Route::get('/dealer/register', [DealerController::class, 'register'])->name('dealer.register');
Route::post('/dealer/save', [DealerController::class, 'saveData'])->name('dealer.submit');


Route::middleware('auth')->group(function(){

Route::get('/admin/dashboard', [AdminLoginController::class, 'index'])->name('dashboard');

// Route::get('/dealer-car-import',[DealerController::class,'import'])->name('car.import');
Route::get('/dealer-car-import',[InventoryController::class,'import'])->name('car.import');
Route::post('/dealer-car-import-store',[InventoryController::class,'importStore'])->name('car.import.store');
//temporary inventory import
Route::get('/dealer-inventory-import',[InventoryController::class,'tmpInventoryImport'])->name('inventory.import');
Route::post('/dealer-inventory-import-store',[InventoryController::class,'tmpInventoryImportStore'])->name('inventory.import.store');

// inventory search route
// Route::post('/vechile/search',[DealerLeadController::class,'vechileSearch'])->name('vechile.search');
Route::post('/select/car',[DealerLeadController::class,'selectCar'])->name('select.car');
// lead save route
Route::post('/lead/post',[DealerLeadController::class,'leadSave'])->name('lead.post');
Route::get('/lead/details',[DealerLeadController::class,'showleadModal'])->name('get.lead.details');
Route::get('/edit-lead',[DealerLeadController::class,'EditModal'])->name('edit-lead');
Route::post('/update/lead',[DealerLeadController::class,'updateLead'])->name('update.lead');
Route::get('/email/lead/delete',[DealerLeadController::class,'deleteLead'])->name('email.lead.delete');

// email lead message

Route::post('/email/send/sms',[DealerLeadController::class,'emailLeadSend'])->name('email.send.lead');

// buyer route dashboard
Route::get('buyer/dashboard',[BuyerController::class,'dashboard'])->name('buyer.dashboard');
Route::post('update/buyer/info',[BuyerController::class,'updateInfo'])->name('update.buyer.info');
Route::get('buyer/favorite',[BuyerController::class,'favourite'])->name('buyer.favourite');


// favourite wishlist add login register check from frontend home page
/////////////////////////// Inventory Add route start here ///////////////////////////////////////////////
Route::get('add/inventory',[InventoryController::class,'index'])->name('add.inventory');
Route::post('store/inventory',[InventoryController::class,'store'])->name('store.inventory');
/////////////////////////// Inventory Add route start here ///////////////////////////////////////////////

/////////////////////////// Inventory Edit route start here ///////////////////////////////////////////////

Route::get('inventory/edit/{id}',[InventoryController::class,'edit'])->name('inventory.edit');
Route::post('inventory/update/{id}',[InventoryController::class,'update'])->name('update.inventory');

/////////////////////////// Inventory Edit route End here ///////////////////////////////////////////////

/////////////////////////// Inventory Edit route End here ///////////////////////////////////////////////
Route::get('dealer/invoice/{id}',[DealerController::class,'invoice'])->name('dealer.invoice');
Route::get('generate/invoice/{id}',[DealerController::class,'invoice_generate'])->name('generate.invoice');
/////////////////////////// Inventory Edit route End here ///////////////////////////////////////////////

});




Route::middleware(['role:1'])->group(function () {
    // Routes that require admin role
    Route::get('/admin/dashboard', 'AdminController@dashboard');
});

Route::middleware(['role:2'])->group(function () {
    // Routes that require dealer role
Route::get('/dealer/dashboard', [DealerController::class, 'index'])->name('dealer.dashboard');
Route::get('/dealer/lead', [DealerLeadController::class, 'index'])->name('dealer.lead');
});

Route::middleware(['role:0'])->group(function () {
    // Routes that require user role
    Route::get('/user/dashboard', 'UserController@dashboard');
});











// buyer dashboard route

Route::get('buyer/login',[BuyerController::class,'login'])->name('buyer.login');
Route::post('buyer/login',[BuyerController::class,'loginCheck'])->name('buyer.login');
Route::get('buyer/register',[BuyerController::class,'registerView'])->name('buyer.register');
Route::post('register/store',[BuyerController::class,'register'])->name('register.store');

// lead store route start
Route::post('lead/store',[LeadController::class,'leadStore'])->name('lead.store');
Route::get('get/lead/details',[LeadController::class,'getLead'])->name('get_lead_details');

// forgot password route

Route::post('buyer/password/request',[BuyerController::class,'forgotPassword'])->name('buyer.password.request');
Route::post('buyer/otp/check',[BuyerController::class,'checkOtp'])->name('buyer.otp.check');

Route::post('favourte/check/auth',[CustomCheckAuth::class,'CheckAuth'])->name('favourte.check.auth');
Route::post('favourte/auth/login',[CustomCheckAuth::class,'login'])->name('favourte.auth.login');
Route::post('favourte/auth/signup',[CustomCheckAuth::class,'signup'])->name('favourte.auth.signup');

// sales management route
Route::get('/sales',[SalesManagementController::class,'index'])->name('sales.management');
Route::post('/sales/add',[SalesManagementController::class,'salesAdd'])->name('sales.store');
Route::post('/sales/edit',[SalesManagementController::class,'salesEdit'])->name('sales.update');
Route::post('/sales/delete',[SalesManagementController::class,'salesDelete'])->name('sales.dalete');


// admin dashboard dealer managment
Route::get('/admin/dealermanagement',[DealerManagementController::class,'index'])->name('dealer.management');
Route::get('/admin/dealer/information/{id}',[DealerManagementController::class,'information'])->name('dealer.information');
Route::post('/admin/dealear/create',[DealerManagementController::class,'create'])->name('dealer.create');
Route::post('/admin/dealear/update',[DealerManagementController::class,'update'])->name('dealer.update');
Route::post('/admin/dealear/delete',[DealerManagementController::class,'delete'])->name('dealer.delete');

// frontend news management
Route::get('/news',[NewsController::class,'index'])->name('news');
Route::get('/admin/newsmanagement',[NewsController::class,'custom'])->name('news.management');
Route::post('/admin/news/add',[NewsController::class,'store'])->name('news.post');
Route::post('/admin/news/update',[NewsController::class,'update'])->name('news.update');
Route::post('/admin/news/delete',[NewsController::class,'delete'])->name('news.delete');
Route::get('/news/details/{id}', [NewsController::class, 'newsDetails'])->name('news.details');
Route::get('/news/view', [NewsController::class, 'newsView'])->name('news.view');

// admin listings
Route::get('/admin/listing', [InventorylistingController::class, 'listingPage'])->name('admin.listing');
Route::get('/admin/listing/image/{id}', [InventorylistingController::class, 'imgShow'])->name('img.show');
Route::get('/admin/listing/{id}', [InventorylistingController::class, 'listingShow'])->name('listing.show');
Route::get('listing/edit/{id}',[InventorylistingController::class,'edit'])->name('listing.edit');

// add package
Route::patch('/package/add', [InventorylistingController::class, 'updatePackage'])->name('package-add');
Route::patch('/pstatus-add/status/add', [InventorylistingController::class, 'updateStatus'])->name('status-add');
Route::patch('/pstatus-add/display/status', [InventorylistingController::class, 'displayUpdateStatus'])->name('display-status');
Route::get('/inventory/add', [InventorylistingController::class, 'add'])->name('add.carinventory');
Route::post('/admin/listing/delete', [InventorylistingController::class, 'delete'])->name('listing.delete');

// dealer listings
Route::get('/dealer/listing', [DealerListingController::class, 'listingView'])->name('dealer.listing');
Route::get('/dealer/listing/image/{id}', [DealerListingController::class, 'imgAll'])->name('picture.show');
Route::get('/dealer/listing/{id}', [DealerListingController::class, 'singleListing'])->name('listing.single');
Route::post('/listing/delete', [DealerListingController::class, 'delete'])->name('listing.softdelete');

