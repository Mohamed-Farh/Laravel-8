<?php

use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\TagController;
use Illuminate\Support\Facades\Auth;
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
//دا علشان يبغت ايميل تاكيد عند التسجيل
Auth::routes(['verify'=>true]);

Auth::routes();

Route::group(['prefix' => 'admin', 'as'=>'admin.' ], function(){

    Route::group(['middleware' => 'guest' ], function(){


        Route::get('/login',               [BackendController::class, 'login'    ])->name('login');
        Route::get('/forget_password',     [BackendController::class, 'forget_password'])->name('forget_password');
    });


        //==========================================================================================================
        Route::group(['middleware' => ['roles', 'role:superAdmin|admin|user'] ], function(){

            Route::get('/',               [BackendController::class, 'index'    ])->name('index_route');
            Route::get('/index',          [BackendController::class, 'index'    ])->name('index');


            /*  Category   */
            Route::resource('categories',CategoryController::class);
            Route::post('/categories/removeImage', [CategoryController::class, 'removeImage'])->name('categories.removeImage');
            Route::post('delete-cat-img',[CategoryController::class,'deleteattachment'])->name('categories.deleteImage');
            Route::post('categories/destroyAll', [CategoryController::class,'massDestroy'])->name('categories.massDestroy');
            Route::get('changeStatus', [CategoryController::class,'changeStatus'])->name('categories.changeStatus');

            Route::post('/products/removeImage', 'Backend\ProductController@removeImage')->name('products.removeImage');
            Route::resource('products',ProductController::class);
            Route::resource('tags',TagController::class);
            // Route::resource('productCopons',ProductCoponController::class);
            // Route::resource('productReviews',ProductReviewController::class);

            // Route::resource('admins'    ,AdminController::class);
            // Route::post('/admins/removeImage', 'Backend\AdminController@removeImage')->name('admins.removeImage');

            // Route::resource('users'     ,UserController::class);
            // Route::post('/users/removeImage', 'Backend\UserController@removeImage')->name('users.removeImage');

            // Route::resource('customers' ,CustomerController::class);
            // Route::post('/customers/removeImage',   'Backend\CustomerController@removeImage')->name('customers.removeImage');
            // Route::get('/get_customer_customerSearch',   [CustomerSearchController::class, 'index'    ])->name('customers.get_customer');
            // Route::get('/get_state_customerSearch',      [CustomerSearchController::class, 'get_state_customerSearch'    ])->name('customers.get_state_customerSearch');
            // Route::get('/get_city_customerSearch',      [CustomerSearchController::class, 'get_city_customerSearch'    ])->name('customers.get_city_customerSearch');


            // Route::resource('customer_addresses' ,CustomerAddressController::class);

            // Route::resource('countries',CountryController::class);
            // Route::resource('states'   ,StateController::class);
            // Route::resource('cities'   ,CityController::class);
        });

});
