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

//Route::get('/', function () {
//    return view('companyidinsert');
//});
Route::prefix( '/admin/' )->group( function () {
    Route::get( 'viewform', 'AdminController@viewform' )->name( 'admin-viewform' );
    Route::get( 'getcompanydetails', 'AdminController@getcompanydetails' )->name( 'admin-getcompanydetails' );

} );
