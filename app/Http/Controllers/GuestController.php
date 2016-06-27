<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Dusterio\LinkPreview\Client;
use LinkPreview\LinkPreview;
use LinkPreview\Model\VideoLink;

use App\Engagement;
use App\Article;
use App\Categorie;
use App\Commentaire;
use App\Etat;
use App\Secteur;

use DB;
use Preview;
use JavaScript;
use stdClass;

class GuestController extends Controller
{

    

    public function test(){
      $hello = 'Hello';
      $sourceChart["credits"] = array("enabled"=>false);
      $sourceChart["chart"] = array("type" => "bar");
      $sourceChart["title"] = array("text" => "Fruit Consumption");
      $sourceChart["xAxis"] = array("categories" => ['Apples', 'Bananas', 'Oranges']);
      $sourceChart["yAxis"] = array("title" => array("text" => "Fruit eaten"));

      $sourceChart["series"] = [
          array("name" => "Jane", "data" => [1,0,4]),
          array("name" => "John", "data" => [5,7,3])
      ];
      return view('test',compact('hello','sourceChart'));
    }



    public function home(){
      $active = 'home';
      return view('default',compact('active'));
    }
    /**
     * Accueil function.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $linkPreview = new LinkPreview('http://www.youtube.com/watch?v=8ZcmTl_1ER8');
        // $parsed = $linkPreview->getParsed();
        // foreach ($parsed as $parserName => $link) {
        //     echo $parserName . PHP_EOL . PHP_EOL;

        //     echo $link->getUrl() . PHP_EOL;
        //     echo $link->getRealUrl() . PHP_EOL;
        //     echo $link->getTitle() . PHP_EOL;
        //     echo $link->getDescription() . PHP_EOL;
        //     echo $link->getImage() . PHP_EOL;
        //     if ($link instanceof VideoLink) {
        //         echo $link->getEmbedCode() . PHP_EOL;
        //     }
        // }

        
         $articlesblog = Article::where('etat',1)->where('type','blog')->orderBy('updated_at','desc')->take(3)->get();
        foreach ($articlesblog as $key => $value) {
          if($value->lien!=null){
            $linkPreview = new LinkPreview($value->lien);
            $parsed = $linkPreview->getParsed();
            foreach ($parsed as $parserName => $link) {
              $value->linkUrl = $link->getRealUrl();
              $value->linkTitle = $link->getTitle();
              $value->linkDescription = $link->getDescription();
              $value->linkImage = $link->getImage();
              if ($link instanceof VideoLink) {
                  $value->linkVideoId = $link->getVideoId();
                  $value->linkVideo = $link->getEmbedCode();
              }
            }
          } 
        }


      /************************************ Chart Etat ****************************************/
      $etats = Etat::withCount('engagements')->where('etat',1)->get();

      foreach ($etats as $key => $value) {
        $data_etats[]= ["name"=>$value->designation,"y"=>$value->engagements_count,"url"=>"'http://bing.com/search?q=foo'"];

      }


      $etatChart["chart"] = ["type" => "pie"];
      $etatChart['credits'] = ['enabled'=>false];
      $etatChart['legend'] = ['enabled'=>false];
      $etatChart["title"] = ["text" => "","verticalAlign"=>"bottom"];
      // $etatChart["subtitle"] = ["text" => "Cliquez sur la colonne pour plus de détails"];
      $etatChart["xAxis"] = ["type"=>"category"];
      $etatChart["yAxis"] = ["title"=>["text"=>"Nombre de promesses"]];
      $etatChart['plotOptions']['pie'] = ["allowPointSelect"=>true];
      $etatChart['plotOptions']['series']['cursor'] = "pointer";
      $etatChart['plotOptions']['series']['point']['events']['click'] = "function(){ location.href = this.options.url;}";
       
      $etatChart["series"] =[["name"=>"Nombre de promesse","colorByPoint"=>true,"data"=>$data_etats]];


    /************************************ Chart Secteur ****************************************/
      
    $secteurs = Secteur::withCount(['engagements'=>function($query){$query->where('etat',1);}])->where('etat',1)->get();

    $count_categorie_type=0;
    $i=0;
    $categorie_type ="";
    $secteur_categorie_nom="";
    $c = 1;

    foreach ($secteurs as $key => $value) {
        $data_secteurs[]= ["name"=>$value->nom,"y"=>$value->engagements_count,"drilldown"=>$value->nom];
        foreach ($value->engagements as $keyc => $valuec) {
          
        }
    }

    $secteurChart["chart"] = ["type" => "pie"];
    $secteurChart['credits'] = ['enabled'=>false];
    $secteurChart['legend'] = ['enabled'=>false];
    $secteurChart["title"] = ["text" => "","verticalAlign"=>"bottom"];
    // $secteurChart["subtitle"] = ["text" => "Cliquez sur la colonne pour plus de détails"];
    $secteurChart["xAxis"] = ["type"=>"category"];
    $secteurChart["yAxis"] = ["title"=>["text"=>"Nombre de promesses"]];
    $secteurChart['plotOptions']['pie'] = ["allowPointSelect"=>true,"dataLabels"=>["enabled"=>true]];


    $secteurChart["series"] =[["name"=>"Nombre de promesse","colorByPoint"=>true,"data"=>$data_secteurs]];


    /************************************ Chart Source ****************************************/

     $sources_president = Categorie::withCount(['engagements'=>function($query){
          $query->where('etat',1);}])->where('etat',1)->where('type','president')->get();

       $sources_gouvernement = Categorie::withCount(['engagements'=>function($query){
          $query->where('etat',1);}])->where('etat',1)->where('type','gouvernement')->get();
      // Variables de compte 
        $count_sources_president =0;
        $count_sources_gouvernement =0;

      // Président
        foreach ($sources_president as $key => $value) {
          $count_sources_president += count($value->engagements);
        }
        foreach ($sources_president as $key => $value) {
         if($key==0){
            $data_sources[]= ["name"=>$value->type,"y"=>$count_sources_president,"drilldown"=>$value->type];
         }
         $data_sources_drilldown_president [] =[$value->designation,$value->engagements_count];
        }

      // Gouvernement
        foreach ($sources_gouvernement as $key => $value) {
          $count_sources_gouvernement += count($value->engagements);
        }
        
        foreach ($sources_gouvernement as $key => $value) {
         if($key==0){
            $data_sources[]= ["name"=>$value->type,"y"=>$count_sources_gouvernement,"drilldown"=>$value->type];
         }
            $data_sources_drilldown_gouvernement [] =[$value->designation,$value->engagements_count];

        }


      $sourceChart["chart"] = ["type" => "column"];
      $sourceChart['credits'] = ['enabled'=>false];
      $sourceChart['legend'] = ['enabled'=>false];
      $sourceChart["title"] = ["text" => "","verticalAlign"=>"bottom"];
      $sourceChart["subtitle"] = ["text" => "Cliquez sur la colonne pour plus de détails"];
      $sourceChart["xAxis"] = ["type"=>"category"];
      $sourceChart["yAxis"] = ["title"=>["text"=>"Nombre de promesses"]];


      $sourceChart["series"] =[["name"=>"Nombre de promesse","colorByPoint"=>true,"data"=>$data_sources]];

      $sourceChart["drilldown"]["series"]=[["name"=>"Président","id"=>"Président","data"=>$data_sources_drilldown_president ],["name"=>"Gouvernement","id"=>"Gouvernement","data"=>$data_sources_drilldown_gouvernement]];

      // var_dump($sourceChart["drilldown"]["series"]);
      // var_dump($data_sources);
      // var_dump(json_encode($sourceChart["series"]));
      // dd(json_encode($sourceChart));
      // dd();
    
    	$active = 'home';

      $engagements = Engagement::where('etat',1)->orderBy('updated_at')->take(4)->get();
      $articlesLahidi = Article::where('etat',1)->where('type','lahidi')->orderBy('updated_at','desc')->take(3)->get();
     

        return view('guest.accueil',compact('active','sourceChart','secteurChart','etatChart','articlesLahidi','engagements','articlesblog'));
    }

    /**
     * Président function.
     *
     * @return \Illuminate\Http\Response
     */
    public function promesses()
    {
    	$active = 'promesses';
    
    	
   		$engagements = Engagement::with('secteur','categorie','etats')
                                    ->where('etat',1)->orderBy('updated_at','desc')->paginate(15);
    	$categories = Categorie::with('engagements')->where('type','president')->get();
    	$secteurs = Secteur::where('etat',1)->orderBy('nom','asc')->get();
    	$categorie = Categorie::where('etat',1)->orderBy('designation','asc')->get();
    	$etats = Etat::where('etat',1)->orderBy('designation','asc')->get();
    	$commentaires = Commentaire::where('etat',1)->get();
    	

        return view('guest.president',compact('active','categorie','secteurs','categories','etats',
                                            'commentaires','engagements'));
    }

     /**
      * Président function.
      *
      * @return \Illuminate\Http\Response
      */
     public function promessesFilter(Request $request)
     {
      $active = 'promesses';
      $clauses = [];
      if(!empty($request->input('categorie'))) {
        $clauses['categorie_id'] = $request->input('categorie');
      }
      if(!empty($request->input('secteur'))) {
          $clauses['secteur_id'] = $request->input('secteur');
      }
      
      
       
      // var_dump($clauses);
      
      $engagements = Engagement::with('secteur','categorie','etats')
                                     ->where('etat',1)->where($clauses)->orderBy('updated_at','desc')->paginate(15);

      if(!empty($request->input('etat'))) {
        var_dump('etat_id');
      }
      $categories = Categorie::with('engagements')->where('type','president')->get();
      $secteurs = Secteur::where('etat',1)->get();
      $categorie = Categorie::where('etat',1)->get();
      $etats = Etat::where('etat',1)->get();
      $commentaires = Commentaire::where('etat',1)->get();
      

         return view('guest.president',compact('active','categorie','secteurs','categories','etats',
                                             'commentaires','engagements'));
     }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
       $active = 'promesses';
       $engagement = Engagement::where('etat',1)->where('slug',$slug)->first();

       return view('guest.detail',compact('active','engagement','slug'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function articleShow($slug)
    {
       $active = 'blog';
       $article = Article::where('etat',1)->where('slug',$slug)->first();

       return view('guest.detail',compact('active','article','slug'));
    }
    /**
     * Gouvernement function.
     *
     * @return \Illuminate\Http\Response
     */
    public function gouvernement()
    {
    	$engagements = Engagement::with('etats',['categories' => function ($query) {
    					$query->where('type', '=', 'gouvernement');}])->where('etat',1)->get();
        return view('guest.gouvernement',compact('engagements'));
    }

    /**
     * Mediathèque function.
     *
     * @return \Illuminate\Http\Response
     */
    public function media()
    {
    		$active = 'media';
        return view('guest.mediatheque',compact('active'));
    }

    /**
     * Langue Nko function.
     *
     * @return \Illuminate\Http\Response
     */
    public function langueNko()
    {
    	$active = 'langue';
        return view('guest.langue-nko',compact('active'));
    }


    /**
     * Langues function.
     *
     * @return \Illuminate\Http\Response
     */
    public function langues()
    {
    	$active = 'langue';
        return view('guest.langue-pular',compact('active'));
    }

    /**
     * WebActu function.
     *
     * @return \Illuminate\Http\Response
     */
    public function webactu()
    {
        return view('guest.webactu');
    }

    /**
     * Rapport function.
     *
     * @return \Illuminate\Http\Response
     */
    public function rapports()
    {
    	$active = 'rapports';
        return view('guest.rapports',compact('active'));
    }

    /**
     * Rapport function.
     *
     * @return \Illuminate\Http\Response
     */
    public function blog()
    {
    	$active = 'blog';
        return view('guest.blog',compact('active'));
    }
}
