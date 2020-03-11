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

Auth::routes();
// Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
//     Route::get('/', 'Auth\LoginController@showLoginForm');
//     Route::post('login', 'Auth\LoginController@login');
//     Route::post('logout', 'Auth\LoginController@logout');
// });


// Route::middleware('auth', function() {
    Route::get('/', function(){
        return view('home');
    })->name('home');

    Route::prefix('programs')->group(function() {
        Route::get('/', 'ProgramController@index');
        Route::get('new', 'ProgramController@create')->name('programs.new');
        Route::post('new', 'ProgramController@store')->name('programs.new');
        Route::get('{id}/edit', 'ProgramController@edit')->where(['id' => '[0-9]+'])->name('programs.edit');
        Route::patch('{id}/update', 'ProgramController@update')->where(['id' => '[0-9]+'])->name('programs.update');
        Route::get('{id}/show', 'ProgramController@show')->where(['id' => '[0-9]+'])->name('programs.show');
        Route::get('list', 'ProgramController@list')->name('programs.list');
    });

    Route::prefix('recon')->group(function(){
        Route::post('{id}/start', 'CommandController@executeRecon')->where(['id' => '[0-9]+'])->name('recon.start');
    });

    // # Just somewhere to save this
    // Route::get('/dbdesign', function(){
    //     return '<a href="https://dbdiagram.io/d/5dc1ab63edf08a25543d8dd6">https://dbdiagram.io/d/5dc1ab63edf08a25543d8dd6</a>';
    // });
// });
