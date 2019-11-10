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


// Route::middleware('auth', function() {
    Route::get('/', function(){
        return view('home');
    })->name('home');

    Route::prefix('/programs')->group(function() {
        // Route::get('/', \App\Http\Controllers\Program\ProgramListController::class);
        // Route::get('/new', \App\Http\Controllers\Program\ProgramCreateController::class);
        // Route::post('new', 'ProgramController@store')->name('programs.new');

        // Route::get('show/{id}', 'ProgramController@show')->name('programs.show');
        // Route::get('list', 'ProgramController@list')->name('programs.list');
    });
    
// });