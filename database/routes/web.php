<?php

use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Admin\AdfEmailController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminLeadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Sales\SalesManagementController;
use App\Http\Controllers\Dealer\DealerController;

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\CSVDownloadController;
use App\Http\Controllers\Admin\DealerManagementController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\admin\UploadFormUrlController;
use App\Http\Controllers\Auth\CustomCheckAuth;
use App\Http\Controllers\Auth\MigrationController;
use App\Http\Controllers\banner\BannerController;
use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\CaptaController;
use App\Http\Controllers\Dealer\DealerInvoiceController;
use App\Http\Controllers\Dealer\DealerLeadController;
use App\Http\Controllers\Dealer\DealerMonetizationController;
use App\Http\Controllers\Dealer\InventoryController;
use App\Http\Controllers\Dealer\LeadPurchaseController;
use App\Http\Controllers\Frontend\CompareListingController;
use App\Http\Controllers\Frontend\LeadController;
use App\Http\Controllers\Frontend\SiteController;
use App\Http\Controllers\Frontend\NewsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\listing\DealerListingController;
use App\Http\Controllers\listing\InventorylistingController;
use App\Http\Controllers\membership\MembershipController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\slides\SlideController;
use Illuminate\Support\Facades\Auth;
use ZipStream\Option\Archive;
use App\Models\Lead;
use App\Models\VehicleMake;
use App\Models\VehicleModel;

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

Route::get('/card',[TestController::class,'cardo'])->name('test.card');
Route::get('/make-model',function(){
    // $curl = curl_init();
    // curl_setopt($curl, CURLOPT_URL, 'https://parseapi.back4app.com/classes/Car_Model_List?count=1&limit=0&order=Make');
    // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    //     'X-Parse-Application-Id: hlhoNKjOvEhqzcVAJ1lxjicJLZNVv36GdbboZj3Z', // This is the fake app's application id
    //     'X-Parse-Master-Key: SNMJJF0CZZhTPhLDIqGhTlUNV9r60M2Z5spyWfXW' // This is the fake app's readonly master key
    // ));
    // $data = json_decode(curl_exec($curl)); // Here you have the data that you need
    // // print_r(json_encode($data, JSON_PRETTY_PRINT));
    // dd(json_encode($data, JSON_PRETTY_PRINT));
    // curl_close($curl);

    // $curl = curl_init();
    // curl_setopt($curl, CURLOPT_URL, 'https://parseapi.back4app.com/classes/Carmodels_Car_Model_List?count=1&limit=10');
    // curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    //     'X-Parse-Application-Id: 0YUYSPqnxFEVihRnWwcBzibjh13msKoPry0J8RkB', // This is your app's application id
    //     'X-Parse-REST-API-Key: ksLFnWrjtYDRYR650AEJEABqRAZ2nCjqZK7XYsl0' // This is your app's REST API key
    // ));
    // $data = json_decode(curl_exec($curl)); // Here you have the data that you need
    // $models = array_column($data['results'], 'Model');
    // return $models;
    // print_r(json_encode($data, JSON_PRETTY_PRINT));
    // curl_close($curl);

    $curl = curl_init();
curl_setopt($curl, CURLOPT_URL, 'https://parseapi.back4app.com/classes/Carmodels_Car_Model_List?count=1&limit=10000');
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'X-Parse-Application-Id: 0YUYSPqnxFEVihRnWwcBzibjh13msKoPry0J8RkB', // This is your app's application id
    'X-Parse-REST-API-Key: ksLFnWrjtYDRYR650AEJEABqRAZ2nCjqZK7XYsl0' // This is your app's REST API key
));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$data = json_decode(curl_exec($curl), true);
curl_close($curl);

// Check if there was an error with the request or if 'results' key is not present
if ($data === null || !isset($data['results'])) {
    die('Error decoding JSON or no data received.');
}

// Access the model information
$models = array_column($data['results'],'Make', 'Model');
foreach ($models as $model_data => $make_data){
    // dd($make_data);
    $vehicle_make_data = VehicleMake::where('vehicle_make',$make_data)->first();
    // dd($vehicle_make_data->vehicle_make_id);
    if(!empty($vehicle_make_data)){
        // return 'ok';
        if(strtoupper($make_data) == $vehicle_make_data->vehicle_make){

            // print_r(strtoupper($make_data) .' '. strtoupper($model_data));

            // $d = VehicleModel::all();
            // dd($d);
            VehicleModel::updateOrCreate([
                'vehicle_make_id' => $vehicle_make_data->vehicle_make_id, // Unique identifier
                'vehicle_model' => strtoupper($model_data)  // Data to update or create
            ]);
            // dd($vehicle_make_data->vehicle_make_id);
        }
    }
    return 'done';
}

// Print or use the models

});

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

Route::get('/sitemap.xml', [SitemapController::class, 'generate']);

Auth::routes(['register' => false]);

Route::get('/downloads',[UploadFormUrlController::class,'downloadImageFromUrl'])->name('download.from.url');
Route::get('/csv-download',[CSVDownloadController::class,'downloadCSVFromFTP'])->name('download.from.ftp');
Route::get('/get-ip',[SiteController::class,'ipAddress'])->name('get.ipaddress');
Route::get('/favorite/listing',[SiteController::class,'favourite'])->name('favourite.listing');

Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/skco', [SiteController::class, 'create'])->name('dealerpage');
Route::get('contact-us/{id?}', [SiteController::class, 'contactPage'])->name('contact.us');
Route::post('send/contact/message', [SiteController::class, 'StoreSendMessage'])->name('contact.send.message');
Route::get('/inactive', [SiteController::class, 'inactive'])->name('inactive');
Route::get('/inventory/details/pdf/{id}', [SiteController::class, 'printInventory'])->name('inventory.details.pdf');
Route::get('/home', [HomeController::class, 'index']);
Route::get('/recently-added', [SiteController::class, 'recentlyAdded'])->name('recently.added');
Route::get('/used-cars-for-sale-autos/{param?}', [SiteController::class, 'autos'])->name('autos');
Route::get('/used-cars-for-sale/{vin?}/listing/{id?}', [SiteController::class, 'autoDetails'])->name('auto.details');
Route::get('/setup-password/{id}', [SiteController::class, 'setupPassword'])->name('setup.password');
Route::post('/setup/new-password/{id}', [SiteController::class, 'login'])->name('setup_new_buyer.login');
// Route::get('/used-cars-for-sale-auto/{make}/{model}/{id}', [SiteController::class, 'autoDetails'])->name('auto.details');

// capta intregrate
Route::get('/reload-capta', [CaptaController::class, 'index'])->name('reload.capcha');

// dealer contact message route
Route::post('/dealer/contact/message',[SiteController::class,'contact'])->name('dealer.contact');

//FAQS route
Route::get('/faqs', [SiteController::class, 'faqs'])->name('faqs');
//About page route
Route::get('/about-us', [SiteController::class, 'about'])->name('frontend.about');
//ajax request
Route::get('frontend/model',[InventoryController::class,'makeModelData'])->name('frontend.ajax.model');
Route::post('/update_wishlist',[InventoryController::class,'updateWishList'])->name('update.wishlist');
Route::post('/product-search', [InventoryController::class,'productSearch'])->name('product_search');
Route::get('/auto_ajax',[SiteController::class,'autoAjax'])->name('auto.ajax');
Route::get('/auto_filter_ajax',[SiteController::class,'autoFilterAjax'])->name('auto_filter.ajax');


Route::get('/dealer/register', [DealerController::class, 'register'])->name('dealer.register');
Route::post('/dealer/save', [DealerController::class, 'saveData'])->name('dealer.submit');

// frontend news management
Route::get('/car-news',[NewsController::class,'index'])->name('news');
Route::get('/car-news/details/{id}', [NewsController::class, 'newsDetails'])->name('news.details');
Route::get('/car-news/view', [NewsController::class, 'newsView'])->name('news.view');


// compare listing
Route::post('/listing/compare/add', [CompareListingController::class, 'add'])->name('compare.listing');
Route::post('/listing/comparision', [CompareListingController::class, 'index'])->name('compare.view');
Route::post('/listing/comparision/delete', [CompareListingController::class, 'delete'])->name('delete.comparision');

// buyer dashboard route

Route::get('buyer/login',[BuyerController::class,'login'])->name('buyer.login');
Route::post('buyer/login',[BuyerController::class,'loginCheck'])->name('buyer.login');
Route::get('buyer/register',[BuyerController::class,'registerView'])->name('buyer.register');
Route::post('register/store',[BuyerController::class,'register'])->name('register.store');
Route::get('register/verify/{id}/{password?}',[BuyerController::class,'userVerify'])->name('verify.user');


// lead store route start
Route::post('lead/store',[LeadController::class,'leadStore'])->name('lead.store');
Route::get('get/lead/details',[LeadController::class,'getLead'])->name('get_lead_details');



// forgot password route

Route::post('buyer/password/request',[BuyerController::class,'forgotPassword'])->name('buyer.password.request');
Route::post('dealer/password/request',[DealerController::class,'forgotPassword'])->name('dealer.password.request');
Route::post('buyer/otp/check',[BuyerController::class,'checkOtp'])->name('buyer.otp.check');
Route::post('dealer/otp/check',[BuyerController::class,'checkOtp'])->name('dealer.otp.check');

Route::post('favourte/check/auth',[CustomCheckAuth::class,'CheckAuth'])->name('favourte.check.auth');
Route::post('favourte/auth/login',[CustomCheckAuth::class,'login'])->name('favourte.auth.login');
Route::post('favourte/auth/signup',[CustomCheckAuth::class,'signup'])->name('favourte.auth.signup');



// Routes that require admin role
Route::middleware(['role:1'])->group(function () {

    Route::get('/admin/dashboard', [AdminLoginController::class, 'index'])->name('dashboard');
/////////////////////////// invoice route here ///////////////////////////////////////////////
Route::get('/admin/dealer/invoice/{id?}',[InvoiceController::class,'allInvoice'])->name('admin.dealer.invoice');
Route::get('generate/invoice/{id}',[DealerController::class,'invoice_generate'])->name('generate.invoice');

// contact message show admin panel
Route::get('admin/contact/message',[AdminController::class,'message'])->name('admin.frontend.contact.message');
Route::get('frontend/contact-message',[AdminController::class,'ShowMessage'])->name('frontend.send.message.show');
Route::post('admin/contact-message',[AdminController::class,'archiveMessage'])->name('admin.contact-message.delete');
Route::post('admin/contact-message-permanent',[AdminController::class,'adminContactMessagePermanentDelete'])->name('admin.contact-message-permanent.delete');
Route::post('admin/contact-message/status-update',[AdminController::class,'statusUpdate'])->name('admin.contact-message.status-update');


/////////////////////////// invoice route End here ///////////////////////////////////////////////
//adf email send
Route::post('/adf-email', [AdfEmailController::class,'send'])->name('email.send.adflead');
Route::post('/admin/lead/send', [AdminLeadController::class,'send'])->name('admin.email_lead.send');
/////////////////////////// cart item get automatically  ///////////////////////////////////////////////
Route::get('/admin/cart/item',[InvoiceController::class,'getcartItem'])->name('admin.get_cart_item');
Route::post('/admin/cart/delete-all',[InvoiceController::class,'deleteAllCartItem'])->name('admin.cart.deleteAll');

// sales management route
Route::get('/sales',[SalesManagementController::class,'index'])->name('sales.management');
Route::post('/sales/add',[SalesManagementController::class,'salesAdd'])->name('sales.store');
Route::post('/sales/edit',[SalesManagementController::class,'salesEdit'])->name('sales.update');
Route::post('/sales/delete',[SalesManagementController::class,'salesDelete'])->name('sales.dalete');
// admin total  leads
Route::get('/admin/leads',[AdminLeadController::class,'index'])->name('admin.leads');
Route::get('/admin/view/lead/{id}',[AdminLeadController::class,'viewLead'])->name('admin.view.lead');
Route::delete('/admin/lead/delete',[AdminLeadController::class,'deleteLead'])->name('admin.lead.delete');
Route::delete('/admin/lead/permanent/delete',[AdminLeadController::class,'permanentDeleteLead'])->name('admin.lead.permanent.delete');

Route::post('/admin/lead-contact/dealer',[AdminLeadController::class,'sendLeadContact'])->name('admin.lead-contact.dealer');


// admin individual lead
Route::get('/admin/dealer/lead/{id}',[AdminLeadController::class,'indivisualDealerLead'])->name('admin.dealer.lead');
// admin dashboard User managment
Route::get('/admin/dealermanagement',[DealerManagementController::class,'index'])->name('dealer.management');
Route::get('/admin/dealermanagement/ajax',[DealerManagementController::class,'dealarManageAjax'])->name('dealer.management.ajax');
Route::get('/admin/dealermanagement/is-active/ajax',[DealerManagementController::class,'dealarManageActiveAjax'])->name('dealer.management.is_active.ajax');
Route::get('/admin/dealer/information/{id}',[DealerManagementController::class,'information'])->name('dealer.information');
Route::post('/admin/dealear/create',[DealerManagementController::class,'create'])->name('dealer.create');
Route::post('/admin/dealear/edit',[DealerManagementController::class,'edit'])->name('dealer.edit');
Route::post('/admin/dealear/update',[DealerManagementController::class,'update'])->name('admin.dealer.update');
Route::delete('/admin/dealear/delete/{id}',[DealerManagementController::class,'delete'])->name('admin.dealer.delete');
Route::delete('/admin/dealear/permanent/delete/{id}',[DealerManagementController::class,'Permanentdelete'])->name('admin.dealer.permanent.delete');


Route::get('/admin/user/information/{id}',[DealerManagementController::class,'userInformation'])->name('admin.user.information');
Route::get('/admin/dealer/listing/{id}',[DealerManagementController::class,'userListing'])->name('admin.dealer.listing');
Route::get('/admin/dealer/banner/{id}',[DealerManagementController::class,'userBanner'])->name('admin.dealer.banner');
Route::get('/admin/dealer/slider/{id}',[DealerManagementController::class,'userSlider'])->name('admin.dealer.slider');


Route::get('/admin/dealer/account/edit/{id}',[DealerManagementController::class,'editAccount'])->name('admin.dealer.account-edit');
Route::post('/admin/user/update/account/{id}',[DealerManagementController::class,'updateAccount'])->name('admin.user.update.account');
Route::post('/admin/user/password/change',[DealerManagementController::class,'changePassword'])->name('admin.dealer.change.password');


// dealer management page admin section  route for index  invoice button

Route::get('/admin/dealer/invoice-list/{id}',[InvoiceController::class,'InvoiceList'])->name('dealer.invoice-list');
Route::post('/admin/invoice/store',[InvoiceController::class,'inventoryStore'])->name('admin.invoice.store');
// banner feature
Route::post('/admin/invoice/banner/store',[InvoiceController::class,'bannerStore'])->name('admin.banner.store');

// Slider feature
Route::post('/admin/invoice/slider/store',[InvoiceController::class,'sliderStore'])->name('admin.slider.store');

// cart data delete
Route::post('/car/data/delete',[InvoiceController::class,'deleteCart'])->name('cart.data.delete');


//admin invoice route

Route::get('/admin/invoice/create',[InvoiceController::class,'InvoiceCreate'])->name('admin.invoice-create');
Route::post('/admin/invoice/show',[InvoiceController::class,'InvoiceShow'])->name('admin.invoice.show');
Route::post('/admin/invoice/new/store',[InvoiceController::class,'invoiceNewStore'])->name('admin.invoice.new.store');
Route::get('/admin/invoice/pdf/{id}',[InvoiceController::class,'invoicePdf'])->name('admin.invoice.pdf');
Route::get('/admin/invoice/email/{id}',[InvoiceController::class,'invoiceEmail'])->name('admin.invoice.email');
Route::post('/admin/invoice/delete',[InvoiceController::class,'invoiceDelete'])->name('admin.invoice.delete');


//  invoice paid or panding
Route::post('/admin/invoice/paid_panding',[InvoiceController::class,'invoicePaidPanding'])->name('admin.invoice.paid_pending');

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
Route::post('/admin/listing/permanent/delete', [InventorylistingController::class, 'permanentDelete'])->name('admin.listing.delete.permanent');


// Archive listing route
Route::get('/admin/archived/listing',[InventorylistingController::class,'archived'])->name('admin.archived.listing');
Route::post('/admin/archived/listing/removed',[InventorylistingController::class,'Removed_archived'])->name('listing.restore');


//news route
Route::get('/admin/newsmanagement',[NewsController::class,'custom'])->name('news.management');
Route::post('/admin/news/add',[NewsController::class,'store'])->name('news.post');
Route::post('/admin/news/update',[NewsController::class,'update'])->name('news.update');
Route::post('/admin/news/delete',[NewsController::class,'delete'])->name('news.delete');
Route::post('/admin/news/permanent/delete',[NewsController::class,'permanentDelete'])->name('news.permanent.delete');

// slides route
Route::get('/admin/content/slides',[SlideController::class,'index'])->name('admin.slides');
Route::get('/admin/slider/trush/list',[SlideController::class,'trushList'])->name('admin.slider.trush.list');
Route::get('/admin/content/slide/option/disabled',[SlideController::class,'option'])->name('slider.option.disabled');

Route::post('/admin/content/slides/add',[SlideController::class,'insert'])->name('slide.insert');
Route::get('/admin/content/slides/lists',[SlideController::class,'sliderList'])->name('slider.list');
Route::post('/admin/content/slidesplan/add',[SlideController::class,'slideInsert'])->name('slidePlan.add');
Route::post('/admin/content/slide/plan/update',[SlideController::class,'planUpdate'])->name('slideplan.update');
Route::post('/admin/plan/delete',[SlideController::class,'plandelete'])->name('slide.planlist.delete');
Route::post('/admin/plan/delete/permanent',[SlideController::class,'plandeletePermanent'])->name('admin.slide.planlist.permanent.delete');
Route::post('/admin/slide/update',[SlideController::class,'update'])->name('slide.update');
Route::post('/admin/slide/delete',[SlideController::class,'delete'])->name('slides.delete');
Route::post('/admin/slide/permanent/delete',[SlideController::class,'permanentDelete'])->name('admin.permanentslides.delete');
Route::post('/admin/slide/change/status',[SlideController::class,'changeActiveInactive'])->name('admin.slide.change.status');
Route::post('/admin/slide/plan/change/status',[SlideController::class,'planchange'])->name('admin.slider.plan_change.status');
Route::patch('/admin/content/slider/payment/update',[SlideController::class,'paymentManage'])->name('pay.update');

// banner route

Route::post('/admin/banner/change/status',[BannerController::class,'changeActiveInactive'])->name('admin.banner.change.status');
Route::post('/admin/banner/package/change/status',[BannerController::class,'packagePlanStatus'])->name('admin.banner.package.change.status');
Route::get('/admin/content/banner',[BannerController::class,'index'])->name('admin.banner');
Route::get('/admin/content/banner/create',[BannerController::class,'custom'])->name('banner.form');
Route::get('/admin/content/banner/lists',[BannerController::class,'list'])->name('banner.list');

Route::post('/admin/content/banner/add',[BannerController::class,'add'])->name('admin.banner.add');
Route::post('/admin/content/banner/delete',[BannerController::class,'delete'])->name('admin.banner.delete');
Route::post('/admin/content/banner/permanent/delete',[BannerController::class,'permanentDelete'])->name('admin.banner.permanent.delete');
Route::post('/admin/content/banner/edit',[BannerController::class,'edit'])->name('admin.banner.edit');
Route::post('/admin/content/plan/add',[BannerController::class,'insert'])->name('plan.add');
Route::post('/admin/content/plan/delete',[BannerController::class,'plandelete'])->name('planlist.delete');
Route::post('/admin/content/plan/delete/permanent',[BannerController::class,'plandeletePermanent'])->name('admin.planlist.delete.permanent');
Route::post('/admin/content/plan/update',[BannerController::class,'update'])->name('admin.plan.update');
Route::patch('/admin/content/banner/payment/update',[BannerController::class,'paymentUpdate'])->name('payment.update');


//lead message route
Route::post('/admin/message/delete',[AdminController::class,'delete'])->name('admin.message.delete');
Route::post('/admin/permanent/message/delete',[AdminController::class,'permanentDelete'])->name('admin.permanent.message.delete');

// monitaization

Route::get('/admin/monetization/membership',[MembershipController::class,'index'])->name('admin.membership');
Route::post('/admin/monetization/membership/add',[MembershipController::class,'add'])->name('membership.add');
Route::post('/admin/monetization/membership/update',[MembershipController::class,'update'])->name('membership.update');
Route::post('/admin/monetization/membership/delete',[MembershipController::class,'delete'])->name('membership.delete');
Route::post('/admin/monetization/membership/permanent/delete',[MembershipController::class,'permanentDelete'])->name('admin.membership.permanent.delete');
Route::post('/admin/monetization/membership/ajax',[MembershipController::class,'monetizationAjax'])->name('membership.status.update.ajax');

// message
Route::get('/admin/message/view',[AdminController::class,'show'])->name('message.view');

});

 // Routes that require dealer role
Route::get('/migrations/zip', [MigrationController::class,'zippo'])->name('mzip');
Route::middleware(['role:2'])->group(function () {

Route::get('/dealer/dashboard', [DealerController::class, 'index'])->name('dealer.dashboard');
Route::get('/dealer/lead', [DealerLeadController::class, 'index'])->name('dealer.lead');
Route::get('/vichele/dealer/lead', [DealerLeadController::class, 'searchVichele'])->name('vichele.dealer.lead');

Route::get('/dealer-car-import',[InventoryController::class,'import'])->name('car.import');
Route::post('/dealer-car-import-store',[InventoryController::class,'importStore'])->name('car.import.store');
//temporary inventory import
Route::get('/dealer-inventory-import',[InventoryController::class,'tmpInventoryImport'])->name('inventory.import');
Route::get('/dealer-inventory-import-ajax', [InventoryController::class,'tmpInventoryImportAjax'])->name('inventory.import.ajax');
Route::post('/dealer-inventory-import-store',[InventoryController::class,'tmpInventoryImportStore'])->name('inventory.import.store');
Route::get('/dealer-inventory-model-ajax', [InventoryController::class,'modelAjax'])->name('inventory.model.ajax');

//sold listing route
Route::get('/dealer-sold-listing', [DealerListingController::class,'soldListing'])->name('dealer.sold.listing');
Route::get('/dealer-archive-listing', [DealerListingController::class,'archiveListing'])->name('dealer.archive.listing');

// email lead message
Route::post('/email/send/sms',[DealerLeadController::class,'emailLeadSend'])->name('email.send.lead');
Route::delete('/dealer/lead/delete',[DealerLeadController::class,'leadDelete'])->name('dealer.lead.delete');
/////////////////////////// Inventory Add route start here ///////////////////////////////////////////////
Route::get('add/inventory',[InventoryController::class,'index'])->name('add.inventory');
Route::post('store/inventory',[InventoryController::class,'store'])->name('store.inventory');
/////////////////////////// Inventory Add route start here ///////////////////////////////////////////////

/////////////////////////// Inventory Edit route start here ///////////////////////////////////////////////

Route::get('inventory/edit/{id}',[InventoryController::class,'edit'])->name('inventory.edit');
Route::post('inventory/update/{id}',[InventoryController::class,'update'])->name('update.inventory');

/////////////////////////// Inventory Edit route End here ///////////////////////////////////////////////
Route::post('/select/car',[DealerLeadController::class,'selectCar'])->name('select.car');
// lead save route
Route::post('/lead/post',[DealerLeadController::class,'leadSave'])->name('lead.post');
Route::get('/lead/details',[DealerLeadController::class,'showleadModal'])->name('get.lead.details');
Route::get('/edit-lead',[DealerLeadController::class,'EditModal'])->name('edit-lead');
Route::post('/update/lead',[DealerLeadController::class,'updateLead'])->name('update.lead');
Route::get('/email/lead/delete',[DealerLeadController::class,'deleteLead'])->name('email.lead.delete');

// dealer listings
Route::get('/dealer/listing', [DealerListingController::class, 'listingView'])->name('dealer.listing');
Route::get('/dealer/listing/image/{id}', [DealerListingController::class, 'imgAll'])->name('picture.show');
Route::get('/dealer/listing/{id}', [DealerListingController::class, 'singleListing'])->name('listing.single');
Route::post('/listing/delete', [DealerListingController::class, 'delete'])->name('listing.softdelete');
Route::post('/listing/restore', [DealerListingController::class, 'restore'])->name('listing.restore');
Route::patch('/package/insert', [DealerListingController::class, 'updatePac'])->name('package-insert');
Route::patch('/status/insert', [DealerListingController::class, 'updateAction'])->name('status-insert');

Route::get('/inventory/insert', [DealerListingController::class, 'insert'])->name('insert.inventory');

// dealer monetization
Route::get('/dealer/monetization/profile', [DealerMonetizationController::class, 'index'])->name('dealer.profile');
Route::get('/dealer/banner', [DealerMonetizationController::class, 'own'])->name('dealer.ownbanner');
// Route::get('/dealer/content/banner/create',[DealerMonetizationController::class,'custom'])->name('banner.form');
Route::post('/dealer/banner/add',[DealerMonetizationController::class,'add'])->name('banner.add');
Route::post('/dealer/banner/edit',[DealerMonetizationController::class,'edit'])->name('banner.edit');
Route::post('/dealer/banner/delete',[DealerMonetizationController::class,'bannerDelete'])->name('banner.delete');
Route::post('/dealear/DealerMonetizationController/profile/updadealerInvoiceNewStorete',[DealerMonetizationController::class,'update'])->name('dealer.update');
Route::post('/dealear/DealerMonetizationController/profile/delete',[DealerMonetizationController::class,'delete'])->name('dealer.delete');

// invoice route manage
Route::post('/dealer/function/invoice/store',[DealerInvoiceController::class,'inventoryStore'])->name('dealer.invoice.store');
Route::post('/dealer/function/invoice/show',[DealerInvoiceController::class,'Show'])->name('dealer.invoice.show');
Route::post('/dealer/function/invoice/cart/delete',[DealerInvoiceController::class,'cartDelete'])->name('dealer.cart.data.delete');
Route::post('/dealer/function/invoice/new/store',[DealerInvoiceController::class,
'dealerInvoiceNewStore'])->name('dealer.invoice.new.store');
Route::get('/dealer/invoice/{id?}',[DealerInvoiceController::class,'allInvoice'])->name('dealer.invoice');
Route::get('/dealer/function/invoice/show',[DealerInvoiceController::class,'invoice'])->name('invoice.show');
Route::post('/dealer/invoice/delete-all',[DealerInvoiceController::class,'deleteAllCartItem'])->name('dealer.cart.deleteAll');
// Route::get('/dealer/invoice/pdf/{id}',[DealerInvoiceController::class,'dealerInvoicePdf'])->name('admin.invoice.pdf');
Route::get('/dealer/invoice/pdf/{id}',[DealerInvoiceController::class,'dealerInvoicePdf'])->name('dealer.invoice.pdf');
Route::get('/dealer/cart/item',[DealerInvoiceController::class,'getcartItem'])->name('dealer.get_cart_item');

});


//  invoice paid or panding
Route::post('/dealer/invoice/paid_panding',[DealerInvoiceController::class,'invoicePaidPanding'])->name('dealer.invoice.paid_pending');
Route::post('/dealer/invoice/delete',[DealerInvoiceController::class,'invoiceDelete'])->name('dealer.invoice.delete');

// banner paid or panding
Route::patch('/dealer/function/banner/payment/update',[DealerMonetizationController::class,'bannerPaymentUpdate'])->name('payment.update');

// banner active inactive
Route::patch('/dealer/function/banner/status/update',[DealerMonetizationController::class,'bannerStatusUpdate'])->name('status.change');


// lead purchase
Route::get('/dealer/lead/purchase',[LeadPurchaseController::class,'index'])->name('lead.purchase');
Route::get('/dealer/upgrade/listing',[LeadPurchaseController::class,'upgrade'])->name('upgrade.listing');

// dealer message
Route::get('/dealer/message/view',[DealerInvoiceController::class,'message'])->name('dealer.message');




// Routes that require user role
Route::middleware(['role:0'])->group(function () {


Route::get('buyer/dashboard',[BuyerController::class,'dashboard'])->name('buyer.dashboard');
Route::post('update/buyer/info',[BuyerController::class,'updateInfo'])->name('update.buyer.info');
Route::get('buyer/favorite',[BuyerController::class,'favourite'])->name('buyer.favourite');
Route::get('buyer/message',[BuyerController::class,'message'])->name('buyer.message');
Route::post('buyer/message/view',[BuyerController::class,'messageCollect'])->name('message.collect');
Route::post('buyer/message/add',[BuyerController::class,'add'])->name('byermessage.add');




});




// payment gateway route

Route::get('/payment', [PaymentController::class, 'showPaymentForm'])->name('payment.form');
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/payment/success', function () {
    return view('payment-success');
})->name('payment.success');
Route::get('/payment/failure', function () {
    return view('payment-failure');
})->name('payment.failure');




