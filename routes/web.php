<?php

use App\Ability;
use App\Role;
use App\User;
use http\Client\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Str;

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

Route::get('/test', function () {
    echo Str::kebab('assigner');
    echo Blade::component('components.menueitems');
});

Route::get('/makeDefaults', 'AssignmentController@resetDefaults');

Route::get('/removeFromOrder/{id}', function ($id){
    foreach (session("product.id") as $key => $ses){
        if ($ses == $id){
            session()->pull('product.id.'.$key);
        }
    }
    return back();
});

Route::get('/addToOrder/{id}', function ($id){
    if (session()->has('product.id')){
        if ( in_array($id, session('product.id')) ){
            session()->flash('product.error', "The Product is already added to order");
        } else {
            session()->push('product.id', $id);
        };
    } else {
        session()->push('product.id', $id);
    }
    return back();
});

Route::get('/', function () {
//    session()->flush();
    session()->put('products.id', []);
    return view('welcome');
});

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::middleware('auth')->group(function(){
    Route::resource('order', 'OrderController');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/pView', 'ProfileController@pView')->name('customers.pView');
    Route::resource('customers', 'ProfileController');
    Route::post('/imageUpload/{customers}', 'ProfileController@imageUpload');

    // Customers All
    Route::get('/customer/all', 'UserController@customers')
        ->name('customer.all');

    // Create Customer View
    Route::get('/customer/create', 'UserController@create')
        ->name('customer.create');

    // Create Customer
    Route::patch('/customer/create', 'UserController@store')
        ->name('new.customer.create');

    // Delete Customer
    Route::delete('/customer/{user}', 'UserController@destroy');

    Route::resource('sub-product', 'SubProductController');

    // File Upload System
    Route::post('/findFolders/{user}', 'fileSystemController@folderData');
    Route::post('/fileUpload/{user}', 'fileSystemController@fileUpload');
    Route::get('/avatar/{user}/{avatar}', 'fileSystemController@avatar');
    Route::get('/subProductImage/{user}/{avatar}', 'fileSystemController@subProductImage');
    Route::get('/productImage/{user}/{avatar}', 'fileSystemController@productImage');
    Route::post('/deleteFile/{user}/{img}', 'fileSystemController@deleteFile');

    Route::resource('product', 'ProductController');
    // Attach SubProduct To Product
    Route::post('/attachToProduct/{product}/{subProduct}', 'ProductController@attachToProduct');
    Route::post('/detachFromProduct/{product}/{subProduct}', 'ProductController@detachFromProduct');
    Route::post('/productsSubProducts/{product}', 'ProductController@productsSubProducts');
    Route::post('/getQuantity/{product}/{subProduct}', 'ProductController@getQuantity');
    Route::post('/changeQuantity/{product}/{subProduct}/{quantity}', 'ProductController@changeQuantity');


    Route::resource('role', 'RoleController');
    Route::resource('ability', 'AbilityController');

    // Assign Workers to Customers
    Route::post('/assignWorker', 'AssignmentController@assignWorker')
        ->name('assign.worker.to.customer');
    Route::post('/unAssignWorker', 'AssignmentController@unAssignWorker')
        ->name('unAssign.worker.to.customer');

    Route::get('/ability_role', 'AssignmentController@index')->name('ability.role');

    // Assign Roles to Users
    Route::post('/user/assignRole', 'AssignmentController@storeRole')
        ->name('assign.role.to.user');

    // Detach Roles From Users
    Route::post('/user/detachRole', 'AssignmentController@detachRoleFromUser')
        ->name('detach.role.from.user');

    // Assign to Ability To Roles
    Route::post('/role/assignAbility', 'AssignmentController@storeAbility')
        ->name('assign.ability.to.role');

    // Remove to Ability From Roles
    Route::post('/role/detachAbility', 'AssignmentController@detachAbilityFromRole')
        ->name('detach.ability.from.role');

});

Auth::routes();


