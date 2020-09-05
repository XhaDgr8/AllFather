<?php
use Illuminate\Support\Facades\Route;
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
Auth::routes();

Route::get('/','AssignmentController@welcome');

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/makeDefaults', 'AssignmentController@resetDefaults')->middleware('auth');

Route::get('/removeFromOrder/{id}', 'HomeController@removeFromOrder')->middleware('auth');

Route::get('/addToOrder/{id}','HomeController@addToOrder')->middleware('auth');

Route::resource('order', 'OrderController')->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::get('/pView', 'ProfileController@pView')->name('customers.pView')->middleware('auth');
Route::resource('customers', 'ProfileController')->middleware('auth');
Route::post('/imageUpload/{customers}', 'ProfileController@imageUpload')->middleware('auth');

// Customers All
Route::get('/customer/all', 'UserController@customers')
    ->name('customer.all')->middleware('auth');

// Create Customer View
Route::get('/customer/create', 'UserController@create')
    ->name('customer.create')->middleware('auth');

// Create Customer
Route::patch('/customer/create', 'UserController@store')
    ->name('new.customer.create')->middleware('auth');

// Delete Customer
Route::delete('/customer/{user}', 'UserController@destroy')->middleware('auth');

Route::resource('sub-product', 'SubProductController')->middleware('auth');

// File Upload System
Route::post('/findFolders/{user}', 'fileSystemController@folderData')->middleware('auth');
Route::post('/fileUpload/{user}', 'fileSystemController@fileUpload')->middleware('auth');
Route::get('/avatar/{user}/{avatar}', 'fileSystemController@avatar')->middleware('auth');
Route::get('/subProductImage/{user}/{avatar}', 'fileSystemController@subProductImage')->middleware('auth');
Route::get('/productImage/{user}/{avatar}', 'fileSystemController@productImage')->middleware('auth');
Route::post('/deleteFile/{user}/{img}', 'fileSystemController@deleteFile')->middleware('auth');

Route::resource('product', 'ProductController')->middleware('auth');
// Attach SubProduct To Product
Route::post('/attachToProduct/{product}/{subProduct}', 'ProductController@attachToProduct')->middleware('auth');
Route::post('/detachFromProduct/{product}/{subProduct}', 'ProductController@detachFromProduct')->middleware('auth');
Route::post('/productsSubProducts/{product}', 'ProductController@productsSubProducts')->middleware('auth');
Route::post('/getQuantity/{product}/{subProduct}', 'ProductController@getQuantity')->middleware('auth');
Route::post('/changeQuantity/{product}/{subProduct}/{quantity}', 'ProductController@changeQuantity')->middleware('auth');


Route::resource('role', 'RoleController')->middleware('auth');
Route::resource('ability', 'AbilityController')->middleware('auth');

// Assign Workers to Customers
Route::post('/assignWorker', 'AssignmentController@assignWorker')
    ->name('assign.worker.to.customer')->middleware('auth');
Route::post('/unAssignWorker', 'AssignmentController@unAssignWorker')
    ->name('unAssign.worker.to.customer')->middleware('auth');

Route::get('/ability_role', 'AssignmentController@index')->name('ability.role')->middleware('auth');

// Assign Roles to Users
Route::post('/user/assignRole', 'AssignmentController@storeRole')
    ->name('assign.role.to.user')->middleware('auth');

// Detach Roles From Users
Route::post('/user/detachRole', 'AssignmentController@detachRoleFromUser')
    ->name('detach.role.from.user')->middleware('auth');

// Assign to Ability To Roles
Route::post('/role/assignAbility', 'AssignmentController@storeAbility')
    ->name('assign.ability.to.role')->middleware('auth');

// Remove to Ability From Roles
Route::post('/role/detachAbility', 'AssignmentController@detachAbilityFromRole')
    ->name('detach.ability.from.role')->middleware('auth');
