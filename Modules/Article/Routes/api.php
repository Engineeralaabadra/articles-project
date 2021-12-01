<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/article', function (Request $request) {
//     return $request->user();
// });
// Route::prefix('admin/articles')->group(function(){
    // Route::get('index',ArticleController::class,'index');
   Route::get('show/{id}','ArticleController@show');
   Route::post('update/{id}','ArticleController@update');
   Route::get('destroy/{id}','ArticleController@destroy');
// });