<?php
use Illuminate\Support\Facades\Route;
 Route::prefix('api/admin/articles')->group(function(){
    Route::get('/index',function(){
        return 88;
    });
    // Route::get('/index',"Articles\Http\Controllers\Admin\ArticleController@index");
 });
 