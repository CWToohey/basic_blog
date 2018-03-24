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

Route::group(['prefix' => 'admin','namespace' => 'Auth'],function(){
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
    Route::post('password/reset', 'ResetPasswordController@reset');
});

Route::group(['prefix' => '/','middleware' => ['role:admin']],function() {
    Route::resource('addPost','adminController');
    Route::resource('edit','adminController');
    Route::resource('findDonations', 'donorController');
});

Route::resource('search', 'searchController');

Route::get('/', 'HomeController@index');
Route::get('/changePost', 'HomeController@nextPrev');
Route::get('/archives', 'HomeController@getArchives');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/biography', 'HomeController@getBio');

//Route::get('/biography', function() {
//
//
//    return view('biography')
//        ->with('subtitle', 'Biosubtitle')->with('content','bioContent')
//        ->with('pics', '')->with('id', 0)
//        ->with('last', true)->with('first', true);
//
//});

Route::get('/s', function () {
    $text = file_get_contents("sample.txt");
    return view('homepage')->with('subtitle','SubTitle')
        ->with('content', $text)->with('pics', ['images/IMG_3167.JPG'])
        ->with('first',1)->with('last',1);
});

Route::get('/test', function () {
    return view('welcome');
});

Route::resource('/donate','donateController');

Route::get('/ajx', function() {
    return view('ajax');
});
