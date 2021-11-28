<?php
use Illuminate\Support\Facades\Route;
 //Route::prefix('api/admin/articles')->group(function(){
Route::prefix('api')->group(function(){
    // Route::get('/index',function(){
    //     return 88;
    // });
    Route::namespace('Articles\Http\Controllers')->group(function(){
        Route::prefix(config('articles.prefix.admin',config('module.prefix.admin')).'/'.config('articles.module-name'))->namespace('Admin')->group(function(){
            Route::get('index','ArticleController@index');
            Route::get('show/{id}','ArticleController@show');
            Route::post('update/{id}','ArticleController@update');
            Route::get('destroy/{id}','ArticleController@destroy');
        });
});
// Route::get('/index',"Articles\Http\Controllers\Admin\ArticleController@index");
 });
//});
