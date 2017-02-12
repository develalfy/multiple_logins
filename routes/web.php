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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('confirmation', 'ConfirmationController@confirm')->name('confirmation.view');
Route::get('confirmation/resend', 'ConfirmationController@resend')->name('confirmation.resend');
Route::get('confirmation/activate/{token}', 'ConfirmationController@activate')->name('confirmation.activate');

Route::get('/role/select', 'RolesController@select')->name('role.select');
Route::get('/role/update/{role}', 'RolesController@update')->name('roles.update');