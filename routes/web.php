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

use Illuminate\Support\Facades\Route;;

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::get('/projects', 'ProjectsController@index')->name('projects');
    Route::post('/projects', 'ProjectsController@store');
    Route::get('/projects/create', 'ProjectsController@create')->name('projects.create');
    Route::get('/projects/{project}', 'ProjectsController@show')->name('projects.show');
});
