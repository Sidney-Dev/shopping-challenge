<?php

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
/*
Route::get('/', function () {
    return view('home');
});*/
use App\User;


Auth::routes();

/*
Route::get('/contact/new', 'ContactController@create')->name('contact.create');

Route::post('/contact/create', 'ContactController@store');

Route::delete('/api/deleteContact/{id}', 'ContactController@destroy');
Route::put('/api/updateContact/{id}', 'ContactController@update');

Route::get('/api/auth/contacts', 'ContactController@index')->name('contacts.all');

Route::get('/api/confirmuser/{id}', 'ContactController@confirmUser')->name('confirm.user');

Route::get('/profile/edit', 'UserController@edit')->name('profile.edit');
Route::put('/profile/{id}/update', 'UserController@update')->name('profile.update');
*/

/**
 * 
 * php artisan make:model Product -m
 * php artisan make:controller ProductController
 * 
 * List of Products API
 */

Route::get('/', 'HomeController@index')->name('home');//->middleware('isLogged');

Route::get('logout', 'LoginController@logout')->middleware('logout');

Route::get('api/products', 'HomeController@products'); // returns an array with all products
         
Route::get('api/user/order', 'OrderController@index');

Route::get('api/isLogged', 'OrderController@is_logged'); // returns a string based on whether or not a user is logged in

Route::post('api/list/order', 'OrderController@list_order');

Route::post('api/order/confirm', 'OrderController@confirm_order')->middleware('auth');

/**
 * Loads the profile view, which has the vue component
 * used to alter the user details
 * 
 */
Route::view('profile', 'profile.edit')->name('profile')->middleware('auth');

/**
 * Updated the post profile
 */
Route::post('api/user/update', 'UserController@update')->middleware('auth');

/**
 * Show all the products ordered by a user
 */
Route::get('my-order/products', 'OrderController@show')->name('orders')->middleware('auth');