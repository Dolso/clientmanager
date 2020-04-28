<?php

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

Route::get('download', 'DownloadControler@download');

Route::resource('/applications', 'ApplicationController');

Route::resource('/mn/applications', 'ManagerApplicationController', [
    'as' => 'manager'
]);

Route::resource('/applications.comments', 'ApplicationCommentController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
