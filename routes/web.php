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

Route::group(['prefix' => 'admin', 'namespace' => 'Auth'], function () {
    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::post('logout', 'LoginController@logout')->name('logout');
    Route::get('logout', 'LoginController@logout');


    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.token');
});
Route::post('password.reset', 'Auth\ResetPasswordController@reset')->name('password.request');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');

Route::group(['prefix' => '/', 'middleware' => ['role:admin']], function () {
    Route::resource('addPost', 'adminController');
    Route::resource('editTitles', 'headingsController');
    Route::resource('edit', 'adminController');
    Route::resource('findDonations', 'donorController');
});

Route::resource('search', 'searchController');
Route::resource('contact', 'contactController');

Route::get('/', 'HomeController@index');
Route::get('/changePost', 'HomeController@nextPrev');
Route::get('/archives', 'HomeController@getArchives');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/biography', 'HomeController@getBio');

Route::resource('/donate', 'donateController');
