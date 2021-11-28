<?php
namespace Articles\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Articles\Http\Requests\Admin\Article;

class ArticleController extends Controller{
    public function index(Article $request){
        return view('articles::admin.index');
        //    return 222;
    }
}