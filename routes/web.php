<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

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
//     return view('welcome');
// });
Route::group(['middleware' => 'revalidate'], function () {

    Auth::routes();

    Route::group(['middleware' => ['auth'], 'prefix' => 'admin'], function () {
        /*===================================== Dashboard ================================*/
        Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
        // Route::get('dashboard', fn () => view('dashboard', ['title' => 'Dashboard']))->name('dashboard');

        /*====================================== Bars ==================================*/
        Route::resource('bars', App\Http\Controllers\BarController::class)->except([
            "show",
        ]);
        Route::any('get-bars', 'App\Http\Controllers\BarController@getBars')->name('bars.getBars');
        Route::get('download-qr-code/{slug}', 'App\Http\Controllers\BarController@download_qr_code')->name('download-qr-code');

        /*====================================== items ==================================*/
        // Route::resource('items', App\Http\Controllers\ItemController::class)->only([
        //     'index', 'show', 'edit', 'update', 'delete', 'create'
        // ]);
        Route::resource('items', App\Http\Controllers\ItemController::class);
        Route::any('get-items', 'App\Http\Controllers\ItemController@getItems')->name('items.getItems');
        Route::post('get-item-category', 'App\Http\Controllers\ItemController@getItemCategoryAndIngredients')->name('get.items.category');
        /*====================================== Users ==================================*/
        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::any('get-users', 'App\Http\Controllers\UserController@getUsers')->name('users.getUsers');

        Route::get('update-password/{id}', 'App\Http\Controllers\UserController@editpassword')->name('users.update-password');
        Route::any('verify-user/{id}', 'App\Http\Controllers\UserController@verify')->name('users.verify');        

        Route::resource('request', App\Http\Controllers\RequestItemController::class);

        // Export
        Route::get("/export/{type}", "App\Http\Controllers\ExportController@export")->name("export");

        //Analytics
        // Route::get("/analytics", "App\Http\Controllers\AnalyticsController@analytics")->name("analytics");
        Route::get("/analytics/activity", "App\Http\Controllers\AnalyticsController@activity")->name("analytics.activity");
        Route::get("/analytics/items", "App\Http\Controllers\AnalyticsController@items")->name("analytics.items");
        Route::get("/analytics/drinks", "App\Http\Controllers\AnalyticsController@drinks")->name("analytics.drinks");
        Route::get("/analytics/category", "App\Http\Controllers\AnalyticsController@category")->name("analytics.category");
        Route::get("/analytics/ingredients", "App\Http\Controllers\AnalyticsController@ingredients")->name("analytics.ingredients");
        Route::get("/analytics/brands", "App\Http\Controllers\AnalyticsController@brands")->name("analytics.brands");
        Route::get("/analytics/cointreau-brands", "App\Http\Controllers\AnalyticsController@cointreau_brands")->name("analytics.cointreau_brands");

        /*===================================== TERM AJAX ================================*/
        Route::get('/term/getchildren', 'App\Http\Controllers\TermController@getChildren')->name("term.getchildren");

        // Bulk Upload
        Route::get('/bulk-upload', 'App\Http\Controllers\BulkUploadController@index')->name('bulk.upload');
        Route::post('/upload', 'App\Http\Controllers\BulkUploadController@uploadData')->name('upload');

        Route::get('/bulk-image-upload', 'App\Http\Controllers\BulkUpload\ImageUploadController@index')->name('bulk.image.upload');
        Route::post('/upload-images', 'App\Http\Controllers\BulkUpload\ImageUploadController@uploadImages')->name('upload.images');

        Route::resource('promotion', App\Http\Controllers\PromotionController::class);
        Route::post('get-promotion', 'App\Http\Controllers\PromotionController@getPromotions')->name('get.promotions');
    });
    // Admin Routes
    Route::group(['middleware' => ['auth', 'isNationalAdmin'], 'prefix' => 'admin'], function () {

        /*===================================== Category ================================*/
        Route::resource('category', App\Http\Controllers\TermController::class);
        Route::any('category/get-terms', 'App\Http\Controllers\TermController@getTerms')->name('get.category-terms');

        /*===================================== Ingredients ================================*/
        Route::resource('ingredients', App\Http\Controllers\TermController::class);
        Route::any('ingredients/get-terms', 'App\Http\Controllers\TermController@getTerms')->name('get.ingredients-terms');

        /*===================================== Brands ================================*/
        Route::resource('brands', App\Http\Controllers\TermController::class);
        Route::any('brands/get-terms', 'App\Http\Controllers\TermController@getTerms')->name('get.brands-terms');

        /*===================================== Products ================================*/
        Route::resource('products', App\Http\Controllers\TermController::class);
        Route::any('products/get-terms', 'App\Http\Controllers\TermController@getTerms')->name('get.products-terms');

        /*===================================== Category ================================*/
        Route::resource('drink', App\Http\Controllers\TermController::class);
        Route::any('drink/get-terms', 'App\Http\Controllers\TermController@getTerms')->name('get.drink-terms');

        // Route::resource('items', App\Http\Controllers\ItemController::class)->except([
        //     'index', 'show', 'edit', 'update', 'delete'
        // ]);        

        /*===================================== Enquiry ================================*/
        Route::resource('enquiry', App\Http\Controllers\EnquiryController::class)->except([
            'create', 'store',
        ]);
        Route::any('enquiry/get-enquiries', 'App\Http\Controllers\EnquiryController@getEnquiries')->name('enquiry.getEnquiries');

        /*===================================== Request Item ================================*/
        Route::resource('request', App\Http\Controllers\RequestItemController::class);
        Route::any('request/get-requests', 'App\Http\Controllers\RequestItemController@getRequests')->name('request.getRequests');
    });

    // SUper Admin Routes
    Route::group(['middleware' => ['auth', 'isSuperAdmin'], 'prefix' => 'admin'], function () {
        Route::resource('region', App\Http\Controllers\RegionController::class);
        Route::post('get-region', 'App\Http\Controllers\RegionController@getRegions')->name('get.regions');

        Route::get('page/edit/{page}', 'App\Http\Controllers\HomeController@edit')->name('page.edit');
        Route::post('page/edit/{page}/update', 'App\Http\Controllers\HomeController@update')->name('page.update');     
        
        /*====================================== Login Activity ==================================*/
        Route::resource('login-activity', App\Http\Controllers\LoginActivityController::class);
        Route::any('get-login-activity', 'App\Http\Controllers\LoginActivityController@getLoginActivity')->name('get.login-activity');   
    });
    // SUper Admin Routes
    Route::group(['middleware' => ['auth', 'isBarAdmin'], 'prefix' => 'admin'], function () {
        /*===================================== Request Item ================================*/
        Route::resource('request', App\Http\Controllers\RequestItemController::class);
        Route::any('request/get-requests', 'App\Http\Controllers\RequestItemController@getRequests')->name('request.getRequests');
    });

    // // Owner Routes
    // Route::group(['middleware' => ['auth', 'isOwner'], 'prefix' => 'admin'], function () {

    //     /*====================================== Users ==================================*/
    //     Route::resource('users', App\Http\Controllers\UserController::class)->only([
    //         'edit', 'update',
    //     ]);
    // });

    // Home Page
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // Items Listing
    Route::get('/items/{term:slug}', [App\Http\Controllers\HomeController::class, 'items'])->name('items');

    Route::get('{bar?}/item/{item?}', [App\Http\Controllers\ItemController::class, 'show'])->name('item.show');
    Route::get('{bar?}/promotion-details/{id}', [App\Http\Controllers\HomeController::class, 'promotionDetails'])->name('promotion-details');

    Route::get('/privacy-policy', [App\Http\Controllers\HomeController::class, 'privacy_policy'])->name('privacy_policy');
    Route::get('/terms-and-conditions', [App\Http\Controllers\HomeController::class, 'terms_and_conditions'])->name('terms_and_conditions');

    //Enquiry
    Route::get('/enquiry', 'App\Http\Controllers\EnquiryController@create')->name('enquiry.create');
    Route::post('/enquiry', 'App\Http\Controllers\EnquiryController@store')->name('enquiry.store');

    // Show by bars
    Route::get('/{bar:slug}', 'App\Http\Controllers\BarController@show')->name('bar.show');
    Route::get('/{bar:slug}/items/{term:slug?}', 'App\Http\Controllers\HomeController@barItems')->name('bar.items');
});
