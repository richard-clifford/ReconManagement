<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Command;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:api')->get('/cron', function (Request $request) {
// Route::get('/cron/{id}', function (Request $request) {
//     try {
//         $cmd = new Command;
//         $cmd->executeRecon($request->id);
//     } catch(\Exception $e) {
//         dd($e->getMessage());
//     }
// });
