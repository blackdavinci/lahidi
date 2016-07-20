<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateArticleRequest;

use App\Article;
use Auth;


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
        $articles = Article::where('etat',1)->orderBy('updated_at','desc')->get();
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

        if($data['type']!='audio' && $data['type']!='video'){
           $article = Article::create($data); 
        }
        

        if($data['type']=='video'){
            $data_video = $request->except('lien');
            $video_id = substr(strstr($data['lien'],'='),1);
            $article = Article::create($data_video);
            $article->lien = $data['lien'];
            $article->video = $video_id;
            $article->save();
        }

        if($data['type']=='audio'){
             $data_audio =  $request->except('lien');

            if(strpos($data['lien'],"soundcloud")==true){
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

                   

                    $article = Article::create($data_audio); 
                    $article->lien = $request->input('lien');
                    $article->audio = $track_id['id'];
                    $article->save(); 
                }

            }else{
                    $lien = substr($data['lien'],12,-1);
                    $url = "https://www.mixcloud.com/oembed/?url=https%3A//www.$lien/&format=json";
                    
                    /* gets the data from a URL */
                    function url_get_contents($url,$useragent='cURL',$headers=false,
                        $follow_redirects=false,$debug=false) {

                        # initialise the CURL library
                        $ch = curl_init();
                         
                        # specify the URL to be retrieved
                        curl_setopt($ch, CURLOPT_URL,$url);
                         
                        # we want to get the contents of the URL and store it in a variable
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                         
                        # specify the useragent: this is a required courtesy to site owners
                        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
                         
                        # ignore SSL errors
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                         
                        # return headers as requested
                        if ($headers==true){
                        curl_setopt($ch, CURLOPT_HEADER,1);
                        }
                         
                        # only return headers
                        if ($headers=='headers only') {
                        curl_setopt($ch, CURLOPT_NOBODY ,1);
                        }
                         
                        # follow redirects - note this is disabled by default in most PHP installs from 4.4.4 up
                        if ($follow_redirects==true) {
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
                        }
                         
                        # if debugging, return an array with CURL's debug info and the URL contents
                        if ($debug==true) {
                        $result['contents']=curl_exec($ch);
                        $result['info']=curl_getinfo($ch);
                        }
                         
                        # otherwise just return the contents as a variable
                        else $result=curl_exec($ch);
                         
                        # free resources
                        curl_close($ch);
                         
                        # send back the data
                        return $result;
                    }
                    $data = json_decode(url_get_contents($url));
                    if($data!=null){
                        $mixcloud = substr($data->embed,117,-47);
                    }else{
                        $mixcloud = $data;
                    }
                    $article = Article::create($data_audio); 
                    $article->lien = $request->input('lien');
                    $article->audio = $mixcloud;
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
        
        return view('admin.edit-article',compact('active','article'));
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

        if($data['type']!='audio' && $data['type']!='video'){
           $article->update($data); 
        }

        if($data['type']=='video'){
            $data_video = $request->except('lien');
            $video_id = substr(strstr($data['lien'],'='),1);

            $article->update([$data_video,'lien'=>$data['lien'],'video'=>$video_id]);
        }

        if($data['type']=='audio'){
            $article->update($data); 
            if(strpos($data['lien'],"soundcloud")==true){
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

                        $article->update(['lien'=>$request->input('lien'),'audio'=>$track_id['id']]);
                    
                    }
                    
                }elseif(strpos($data['lien'],"mixcloud")==true){

                        $lien = substr($data['lien'],12,-1);
                        $url = "https://www.mixcloud.com/oembed/?url=https%3A//www.$lien/&format=json";
                        
                        /* gets the data from a URL */
                        function url_get_contents($url,$useragent='cURL',$headers=false,
                            $follow_redirects=false,$debug=false) {

                            # initialise the CURL library
                            $ch = curl_init();
                             
                            # specify the URL to be retrieved
                            curl_setopt($ch, CURLOPT_URL,$url);
                             
                            # we want to get the contents of the URL and store it in a variable
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
                             
                            # specify the useragent: this is a required courtesy to site owners
                            curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
                             
                            # ignore SSL errors
                            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                             
                            # return headers as requested
                            if ($headers==true){
                            curl_setopt($ch, CURLOPT_HEADER,1);
                            }
                             
                            # only return headers
                            if ($headers=='headers only') {
                            curl_setopt($ch, CURLOPT_NOBODY ,1);
                            }
                             
                            # follow redirects - note this is disabled by default in most PHP installs from 4.4.4 up
                            if ($follow_redirects==true) {
                            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 
                            }
                             
                            # if debugging, return an array with CURL's debug info and the URL contents
                            if ($debug==true) {
                            $result['contents']=curl_exec($ch);
                            $result['info']=curl_getinfo($ch);
                            }
                             
                            # otherwise just return the contents as a variable
                            else $result=curl_exec($ch);
                             
                            # free resources
                            curl_close($ch);
                             
                            # send back the data
                            return $result;
                        }
                        $data = json_decode(url_get_contents($url));
                        if($data!=null){
                            $mixcloud = substr($data->embed,117,-47);
                        }else{
                            $mixcloud = $data;
                        }
                                               
                       $article->update(['lien'=>$request->input('lien'),'audio'=>$mixcloud]);
                        
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
        return redirect(route('pw-admin-article.show',$id));
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
