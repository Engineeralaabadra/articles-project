<?php
namespace Articles\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Article;

class ArticleController extends Controller{
    public function index(){
        return view('articles::admin.index');
        //    return 222;
    }
}