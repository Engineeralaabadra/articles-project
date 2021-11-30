<?php

namespace Modules\Article\Http\Controllers\Admin;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Article\Http\Requests\Admin\Article as RequestsArticle;
use Modules\Article\Entities\Article as ModelsArticle;


class ArticleController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        try{
            $articles=ModelsArticle::get();
            if(!empty($articles)){
            return \response()->json([
                'status'=>200,
                'data'=>$articles
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'there is no data'
            ]);
        }
        }catch(\Exception $ex){
            return response()->json([
                'status'=>500,
                'message'=>'There is something wrong, please try again'
            ]);  
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestsArticle $request)
    {
        try{
            $article=new ModelsArticle();
            $article->insert(['title'=>$request->title,'body'=>$request->body]);
            return \response()->json([
                'status'=>200,
                'message'=>'created successfully'
            ]);
        }catch(\Exception $ex){
            return response()->json([
                'status'=>500,
                'message'=>'There is something wrong, please try again'
            ]);  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article=ModelsArticle::findOrFail($id);
        try{
            return \response()->json([
                'status'=>200,
                'data'=>$article
            ]);
        }catch(\Exception $ex){
            return response()->json([
                'status'=>500,
                'message'=>'There is something wrong, please try again'
            ]);  
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestsArticle $request, $id)
    {
        $article=ModelsArticle::findOrFail($id);
        try{
            $article->update(['title'=>$request->title,'body'=>$request->body]);
            return \response()->json([
                'status'=>200,
                'message'=>'updated successfully'
            ]);
        }catch(\Exception $ex){
            return response()->json([
                'status'=>500,
                'message'=>'There is something wrong, please try again'
            ]);  
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article=ModelsArticle::findOrFail($id);
        try{
            $article->delete($article);
            return \response()->json([
                'status'=>200,
                'message'=>'deleted successfully'
            ]);
        }catch(\Exception $ex){
            return response()->json([
                'status'=>500,
                'message'=>'There is something wrong, please try again'
            ]);  
        }
    }

}
