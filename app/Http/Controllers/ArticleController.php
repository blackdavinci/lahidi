<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateArticleRequest;

use App\Article;


class ArticleController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = 'article';
        $articles = Article::where('etat',1)->get();
        $nombre_article = count($articles);
        return view('admin.list-articles',compact('active','articles','nombre_article'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('image','doc');

        if($request->input('type')=='blog'){
            $this->validate($request, [
                'lien'=>'required',
            ]);

        }else{
            $this->validate($request, [
                'titre'=>'required',
                'contenu'=>'required'
            ]);
        }

        $article = Article::create($data);
        
    
        if($request->file('image')!= null || $request->file('doc')!=null){

            $this->validate($request, [
                'image'=>'mimes:jpg,jpeg,png',
                'doc'=>'mimes:pdf'
            ]);
        // getting all of the post data
          $img = $request->file('image');
          $doc = $request->file('doc');
          // setting up rules
             if($img!=null){
                 $destinationPathImg = 'files/img'; // upload path
                 $imgExtension = $request->file('image')->getClientOriginalExtension(); // getting image extension

                 $fileNameImg = rand(11111,99999).'.'.$extension; // renameing image

                 $request->file('image')->move($destinationPathImg, $fileNameImg); // uploading file to given path for img

                 // sending back with message
                
                $article->image = $fileNameImg;
                $article->save();
             }
             if($doc!=null){
                 $destinationPathDoc = 'files/docs'; // upload path
                 $docExtension = $request->file('doc')->getClientOriginalExtension(); // getting doc extension

                 $fileNameDoc = rand(11111,99999).'.'.$extension; // renameing doc

                 $request->file('doc')->move($destinationPathDoc, $fileNameDoc); // uploading file to given path for doc

                 // sending back with message
                
                $article->image = $fileNameDoc;
                $article->save();

             }  
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $active = 'active';
        $article = Article::where('etat',1)->findOrFail($id);

        return view('admin.detail-article',compact('active','article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
