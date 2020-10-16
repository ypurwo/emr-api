<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('GetToken','TokenController@GetToken');
Route::group(['middleware' => 'auth:sanctum'], function ($router) {

// auth get user
    Route::get('GetUser','TokenController@GetUser');

    // IGD calls
    Route::post('get_all_active_rj','IGDController@get_all_active_rj');
    Route::post('get_dashboard_data_episode','IGDController@get_dashboard_data_episode');
    Route::post('save_nrassigd','IGDController@save_nrassigd');

// logout
    Route::get('/logout', 'TokenController@logout');

    // poli api routes
    Route::post('get_allvisit','poliController@get_allvisit');
    Route::post('get_antrianpoli','poliController@getAntrianPoli');

    // upload pdf route

    Route::post('upload_pdf','pdfuploadController@upload_pdf');
    Route::post('get_all_pdf','pdfuploadController@get_all_pdf');


});

