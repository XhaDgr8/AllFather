<?php

use App\Ability;
use App\Role;
use App\User;
use Illuminate\Support\Facades\DB;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');


Route::middleware('auth')->group(function(){

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/pView', 'ProfileController@pView')->name('customers.pView');
    Route::resource('customers', 'ProfileController');
    Route::post('/imageUpload/{customers}', 'ProfileController@imageUpload');

    // Customers All
    Route::get('/customer/all', 'UserController@customers')
        ->name('customer.all')->middleware('can:worker', 'can:admin');

    // Create Customer View
    Route::get('/customer/create', 'UserController@create')
        ->name('customer.create')->middleware('can:worker', 'can:admin');

    // Create Customer
    Route::patch('/customer/create', 'UserController@store')
        ->name('new.customer.create')->middleware('can:worker', 'can:admin');

    Route::middleware('can:admin')->group(function(){

        Route::resource('role', 'RoleController');
        Route::resource('ability', 'AbilityController');

        // Assign Workers to Customers
        Route::post('/assignWorker', 'AssignmentController@assignWorker')->name('assign.worker.to.customer');
        Route::post('/unAssignWorker', 'AssignmentController@unAssignWorker')->name('unAssign.worker.from.customer');

        Route::get('/ability_role', 'AssignmentController@index')->name('ability.role');

        // Assign Roles to Users
        Route::post('/user/assignRole', 'AssignmentController@storeRole')->name('assign.role.to.user');

        // Detach Roles From Users
        Route::post('/user/detachRole', 'AssignmentController@detachRoleFromUser')->name('detach.role.from.user');

        // Assign to Ability To Roles
        Route::post('/role/assignAbility', 'AssignmentController@storeAbility')->name('assign.ability.to.role');

        // Remove to Ability From Roles
        Route::post('/role/detachAbility', 'AssignmentController@detachAbilityFromRole')->name('detach.ability.from.role');
    });

});
