<?php
use Illuminate\Support\Facades\Route;
/** routes api admin for articles */
Route::prefix('admin/articles')->namespace('Admin')->group(function(){
    Route::get('index','ArticleController@index');
    Route::get('show/{id}','ArticleController@show');
    Route::post('store/','ArticleController@store');
    Route::post('update/{id}','ArticleController@update');
    Route::get('destroy/{id}','ArticleController@destroy');
});
