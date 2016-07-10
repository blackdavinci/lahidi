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
        $articles = Article::get();
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
    public function store(CreateArticleRequest $request)
    {
        $data = $request->except('image','doc');

        if($data['type']!='audio'){
           
           $article = Article::create($data); 
        }
        
        if($data['type']=='audio'){
            function Qassim_HTTP($method, $url, $header, $data){ // Function By Qassim Hassan
                if( $method == 1 ){
                    $method_type = 1; // 1 = POST
                }else{
                    $method_type = 0; // 0 = GET
                }
             
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curl, CURLOPT_HEADER, 0);
                if( $header !== 0 ){
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
                }
                curl_setopt($curl, CURLOPT_POST, $method_type);
             
                if( $data !== 0 ){
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
             
                $response = curl_exec($curl);
                $json = json_decode($response, true);
                curl_close($curl);
             
                return $json;
            }
            if($request->input('lien')!= null){
                $data = array("url" =>$request->input('lien'), 
                    "client_id" => "4591fc5968df055745d42f52b08a53cc");
                 
                $get_location = Qassim_HTTP(0, "http://api.soundcloud.com/resolve.json", 0, $data);
                
                 
                $location = $get_location['location'];
                 
                $track_id = Qassim_HTTP(0, $location, 0, 0);

                $data_audio =  $request->except('lien');

                $article = Article::create($data_audio); 

                $article->lien = $track_id['id'];
                $article->save(); 
            }
        }
        if($request->file('image')!= null){

        $this->validate($request, [
            'photo'=>'mimes:jpg,jpeg,png,bmp,gif',
        ]);
        // getting all of the post data
          $file = $request->file('image');
          // setting up rules
         
              $destinationPath = 'images/uploads'; // upload path
              $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
              $fileName = rand(11111,99999).'.'.$extension; // renameing image
              $request->file('image')->move($destinationPath, $fileName); // uploading file to given path
              // sending back with message
            
             $article->image = $fileName;
             $article->save();     
        }

        if($request->file('doc')!= null){

        $this->validate($request, [
            'doc'=>'mimes:pdf,docx',
        ]);
        // getting all of the post data
          $file = $request->file('doc');
          // setting up rules
         
              $destinationPath = 'files/docs'; // upload path
              $extension = $request->file('doc')->getClientOriginalExtension(); // getting image extension
              $fileName = rand(11111,99999).'.'.$extension; // renameing image
              $request->file('doc')->move($destinationPath, $fileName); // uploading file to given path
              // sending back with message
            
             $article->doc = $fileName;
             $article->save();
              
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
        $active = 'article';
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
        $active = 'article';
        $article = Article::findOrFail($id);
        return veiw('admin.edit-article',compact('active','article'));
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
        $article = Article::findOrFail($id);

        $data = $request->except('image','doc');

        if($data['type']!='audio'){
           
           $article->update($data); 
        }
        
        if($data['type']=='audio'){
            function Qassim_HTTP($method, $url, $header, $data){ // Function By Qassim Hassan
                if( $method == 1 ){
                    $method_type = 1; // 1 = POST
                }else{
                    $method_type = 0; // 0 = GET
                }
             
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($curl, CURLOPT_HEADER, 0);
                if( $header !== 0 ){
                    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
                }
                curl_setopt($curl, CURLOPT_POST, $method_type);
             
                if( $data !== 0 ){
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
             
                $response = curl_exec($curl);
                $json = json_decode($response, true);
                curl_close($curl);
             
                return $json;
            }
            if($request->input('lien')!= null){
                $data = array("url" =>$request->input('lien'), 
                    "client_id" => "4591fc5968df055745d42f52b08a53cc");
                 
                $get_location = Qassim_HTTP(0, "http://api.soundcloud.com/resolve.json", 0, $data);
                
                 
                $location = $get_location['location'];
                 
                $track_id = Qassim_HTTP(0, $location, 0, 0);

                $data_audio =  $request->except('lien');

                $article = Article::create($data_audio); 

                $article->update(['lien'=>$track_id['id']]);

            
            }
        }

        if($request->file('image')!= null){

        $this->validate($request, [
            'photo'=>'mimes:jpg,jpeg,png,bmp,gif',
        ]);
        // getting all of the post data
          $file = $request->file('image');
          // setting up rules
         
              $destinationPath = 'images/uploads'; // upload path
              $extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
              $fileName = rand(11111,99999).'.'.$extension; // renameing image
              $request->file('image')->move($destinationPath, $fileName); // uploading file to given path
              // sending back with message
            
            $article->update(['image'=>$fileName]);
     
        }

        if($request->file('doc')!= null){

        $this->validate($request, [
            'doc'=>'mimes:pdf,docx',
        ]);
        // getting all of the post data
          $file = $request->file('doc');
          // setting up rules
         
              $destinationPath = 'files/docs'; // upload path
              $extension = $request->file('doc')->getClientOriginalExtension(); // getting image extension
              $fileName = rand(11111,99999).'.'.$extension; // renameing image
              $request->file('doc')->move($destinationPath, $fileName); // uploading file to given path
              // sending back with message
            
             $article->update(['doc'=>$fileName]);
              
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return back();
    }
}
