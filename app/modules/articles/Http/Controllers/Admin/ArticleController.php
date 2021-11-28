<?php

namespace Articles\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Articles\Http\Requests\Admin\Article as RequestsArticle;
use Articles\Models\Article as ModelsArticle;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RequestsArticle $request){
        //    return 222;
        // return view('articles::admin.index');
        $articles=ModelsArticle::get();
        return \response()->json([
            'status'=>200,
            'data'=>$articles
        ]);
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $article=new ModelsArticle();
        $article->insert($request);
        return \response()->json([
            'status'=>200,
            'message'=>'created successfully'
        ]);
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
        return \response()->json([
            'status'=>200,
            'data'=>$article
        ]);
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }

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
        $article->update($request);
        return \response()->json([
            'status'=>200,
            'message'=>'updated successfully'
        ]);

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
        $article->delete($article);
        return \response()->json([
            'status'=>200,
            'message'=>'deleted successfully'
        ]);
    }
}
