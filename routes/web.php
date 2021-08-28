<?php

use Illuminate\Support\Facades\Route;

//HOME Pages Routes
Route::get('/','IndexController@index')->name("home.index");

Route::get('/search-vehicles','IndexController@searchVehicles');

//Category Listing Page
Route::get('/vehicles/{url}','IndexController@Vehicles');

//Vehicle detail page
Route::get('/vehicle/{url}','IndexController@Vehicle')->name("public.vechicle_details");

//Vehicle Price Range

// Route::post('/PriceRange','IndexController@PriceRange');
Route::get('/PriceRange1','IndexController@PriceRange1');
Route::get('/PriceRange2','IndexController@PriceRange2');
Route::get('/PriceRange3','IndexController@PriceRange3');
Route::get('/PriceRange4','IndexController@PriceRange4');
Route::get('/PriceRange5','IndexController@PriceRange5');




////Authentication Routes for admin
//Route::get('/signin','AdminController@signin');
//Route::get('/signup','AdminController@signup');
//Route::post('/save_user','AdminController@save_user');
//Route::post('/login_user','AdminController@login_user');
//Route::get('/logout','AdminController@logout');
//
////Admin Panel Routes and Middleware Starts
//Route::group(['middleware' => 'checkloggedin'], function(){
//Route::get('/backend/dashboard','AdminController@dashboard');
//// Route::get('/backend/viewadmins','AdminController@viewadmins');
//
//// Categoirs Routes(Admin)
//Route::match(['get','post'],'/backend/add-category','CategoryController@addCategory');
//Route::match(['get','post'],'/backend/edit-category/{id}','CategoryController@editCategory');
//Route::match(['get','post'],'/backend/delete-category/{id}','CategoryController@deleteCategory');
//Route::get('/backend/view-categories','CategoryController@viewcategories');
//
//
//
//Route::group(['middleware' => 'checkadmins'], function($name){
//
////view admins Route
//Route::get('/backend/view-admins','AdminController@viewAdmins');
////add admin Route
//Route::match(['get','post'],'/backend/add-admin','AdminController@addAdmin');
////edit admin Route
//Route::match(['get','post'],'/backend/edit-admin/{id}','AdminController@editAdmin');
////delete admin Route
//Route::match(['get','post'],'/backend/delete-admin/{id}','AdminController@deleteAdmin');
//
//});
//
//Route::get('/backend/profit','AdminController@viewProfit');
//
//});




/**
 * route for super admin
 *
 */
/*****************************************************************************/
Route::group(['middleware' => 'checkAdmin'], function(){

    Route::get('/iPtrSErqPStyX4-admin/dashbord','AdminController@dashboard')->name("admin.dashbord");

    Route::get('/iPtrSErqPStyX4-admin/add-balance','AdminController@addBalance')->name("admin.add_balance");


    Route::get('/iPtrSErqPStyX4-admin/default-action/{id}','AdminController@accountAction')->name("admin.account_action");
    Route::get('/iPtrSErqPStyX4-admin/add-account','AdminController@addAccount')->name("admin.add_account");
    Route::post('/iPtrSErqPStyX4-admin/add-account','AdminController@postAccount')->name("admin.post_account");
    Route::get('/iPtrSErqPStyX4-admin/account','AdminController@account')->name("admin.account");
    Route::get('/iPtrSErqPStyX4-admin/view-account/{id}','AdminController@viewAccount')->name("admin.view_account");
    Route::post('/iPtrSErqPStyX4-admin/delete-account','AdminController@deleteAccount')->name("admin.delete_account");
    Route::get('/iPtrSErqPStyX4-admin/edit-account/{id}','AdminController@editAccount')->name("admin.edit_account");
    Route::put('/iPtrSErqPStyX4-admin/edit-account/{id?}','AdminController@updateAccount')->name("admin.update_account");


    Route::post('/iPtrSErqPStyX4-admin/signout','AdminAuthController@logout')->name("admin.signout");


    Route::get('/iPtrSErqPStyX4-admin/transactions','AdminController@transaction')->name("admin.transactions");
    Route::get('/iPtrSErqPStyX4-admin/view-transaction/{id}','AdminController@viewTransaction')->name("admin.view_transaction");


    //admins Route
    Route::get('/iPtrSErqPStyX4-admin/admins','AdminController@viewAdmins')->name("admin.admins");
    Route::get('/iPtrSErqPStyX4-admin/view-admin/{id}','AdminController@viewAdmin')->name("admin.view_admin");
    Route::match(['get','post'],'/iPtrSErqPStyX4-admin/add-admin','AdminController@addAdmin')->name("admin.add_admin");
    Route::match(['get','post'],'/iPtrSErqPStyX4-admin/edit-admin/{id}','AdminController@editAdmin')->name("admin.edit_admin");
    Route::match(['post'],'/iPtrSErqPStyX4-admin/delete-admin','AdminController@deleteAdmin')->name("admin.delete_admin");

    // Categoirs Routes(Admin)
    Route::match(['get','post'],'/iPtrSErqPStyX4-admin/add-category','CategoryController@addCategory')->name("admin.add_category");
    Route::match(['get','post'],'/iPtrSErqPStyX4-admin/edit-category/{id}','CategoryController@editCategory')->name("admin.edit_category");
    Route::match(['post'],'/iPtrSErqPStyX4-admin/delete-category','CategoryController@deleteCategory')->name("admin.delete_category");
    Route::get('/iPtrSErqPStyX4-admin/categories','CategoryController@viewcategories')->name("admin.categories");


});

//User Signin page
Route::get('/iPtrSErqPStyX4/admin-signup','AdminAuthController@signup')->name("admin.signup");
Route::post('/iPtrSErqPStyX4/admin-signup-post','AdminAuthController@signUpPost')->name("admin.signup-post");
Route::get('/iPtrSErqPStyX4/adminsignin','AdminAuthController@signin')->name("admin.signin");
Route::post('/iPtrSErqPStyX4/admin-login-post','AdminAuthController@loginPost')->name("admin.login-post");

/*****




/**
 * route for marchant
 *
 */
/*****************************************************************************/
Route::group(['middleware' => 'checkMarchant'], function(){

    // Vehicles Routes(Admin)
    Route::match(['get','post'],'/marchant/add-vehicle','VehiclesController@addVehicle')->name("vechicles.add");
    Route::match('get','/marchant/edit-vehicle/{id}','VehiclesController@editVehicle')->name("vechicles.edit");
    Route::post('/marchant/update-vehicle','VehiclesController@updateVehicle')->name("vechicles.update");
    Route::post('/marchant/delete-vehicle','VehiclesController@deleteVehicle')->name("vechicles.delete");
    Route::match(['get','post'],'/marchant/add-images/{id}','VehiclesController@addImages')->name("vechicles.addimage");

    Route::get('/marchant/delete-alt-image/{id}','VehiclesController@deleteAltImage');

    Route::get('/marchant/view-vehicles','VehiclesController@viewVehicles')->name("vechicles.view");
    Route::get('/marchant/details-vehicle/{id}','VehiclesController@detailsVehicles')->name("vechicles.details");

    Route::get('/vechicle/sale-details/{id}','SaleController@saleDetails')->name("vechicles.sale_details");
    Route::get('/vechicle/sale-action/{id}/{vid}','SaleController@saleAction')->name("vechicles.sale_action");
    Route::get('/vechicle/sale-edit/{id}','SaleController@saleEdit')->name("vechicles.sale_edit");
    Route::post('/vechicle/sale-update','SaleController@saleUpdate')->name("vechicles.sale_update");
    Route::post('/vechicle/sale-delete','SaleController@saleDelete')->name("vechicles.sale_delete");

    Route::get('/marchant/sales-vehicle/{id}','VehiclesController@salesVehicles')->name("vechicles.sales");
    Route::get('/marchant/sold-vehicle/{id}','VehiclesController@soldVehicles')->name("vechicles.sold");
    Route::post('/marchant/sold-vehicle','VehiclesController@soldPostVehicles')->name("vechicles.post_sold");
    Route::get('/marchant/trans-action/{id}','MarchantController@transactionAction')->name("marchant.trans_action");
    Route::get('/marchant/dashbord','MarchantController@dashboard')->name("marchant.dashbord");

    Route::get('/marchant/add-balance','MarchantController@addBalance')->name("marchant.add_balance");
    Route::get('/marchant/add-account','MarchantController@addAccount')->name("marchant.add_account");
    Route::get('/marchant/view-account/{id}','MarchantController@viewAccount')->name("marchant.view_account");
    Route::post('/marchant/delete-account','MarchantController@deleteAccount')->name("marchant.delete_account");
    Route::get('/marchant/edit-account/{id}','MarchantController@editAccount')->name("marchant.edit_account");
    Route::post('/marchant/add-account','MarchantController@postAccount')->name("marchant.post_account");
    Route::put('/marchant/edit-account/{id?}','MarchantController@updateAccount')->name("marchant.update_account");
    Route::get('/marchant/account','MarchantController@account')->name("marchant.account");

    Route::get('/marchant/transactions','MarchantController@transaction')->name("marchant.transactions");
    Route::get('/marchant/view-transaction/{id}','MarchantController@viewTransaction')->name("marchant.view_transaction");

    // log out route
    Route::post('/marchant-signout','MarchantAuthController@logout')->name("marcahant.signout");
});

//marchant auth route
Route::get('/marchant-signup','MarchantAuthController@signup')->name("marchant.signup");
Route::post('/marchant-signup-post','MarchantAuthController@signUpPost')->name("marchant.signup-post");
Route::get('/marchant-signin','MarchantAuthController@signin')->name("marchant.signin");
Route::post('/marchant-signin-post','MarchantAuthController@signinPost')->name("marchant.signin-post");

/****************************************************************************************************************/



/**
 * route for customer
 *
 */
/*****************************************************************************/
Route::group(['middleware' => 'checkUser'], function(){
    //user dash bord
    Route::post('/booking','VehiclesController@bookingConfirm');
    Route::get('/booking/{id}','VehiclesController@booking')->name("vechicle.booking");

    Route::get('/user/dashbord','UserController@dashboard')->name("user.dashbord");

    Route::get('/user/add-balance','UserController@addBalance')->name("user.add_balance");
    Route::get('/user/add-account','UserController@addAccount')->name("user.add_account");
    Route::get('/user/view-account/{id}','UserController@viewAccount')->name("user.view_account");
    Route::post('/user/delete-account','UserController@deleteAccount')->name("user.delete_account");
    Route::get('/user/edit-account/{id}','UserController@editAccount')->name("user.edit_account");
    Route::post('/user/add-account','UserController@postAccount')->name("user.post_account");
    Route::put('/user/edit-account/{id?}','UserController@updateAccount')->name("user.update_account");
    Route::get('/user/account','UserController@account')->name("user.account");

    Route::post('/usersignout','UserAuthController@userLogout')->name("user-signout");

    Route::get('/user/transactions','UserController@transaction')->name("user.transactions");
    Route::get('/user/view-transaction/{id}','UserController@viewTransaction')->name("user.view_transaction");
});

//User Signin page
Route::post('/user-signup-post','UserAuthController@userSignUpPost')->name("signup-post");
Route::get('/usersignin','UserAuthController@usersignin')->name("user-signin");
Route::post('/user-login-post','UserAuthController@userLoginPost')->name("login-post");

/****************************************************************************************************************/