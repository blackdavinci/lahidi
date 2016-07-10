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
use Twitter;

class GuestController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
  

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
        
        
        
         $blogsext = Article::where('etat',1)->where('type','blog')->orderBy('updated_at','desc')->take(3)->get();
        foreach ($blogsext as $key => $value) {
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
        $count = intval($value->engagements_count);
        $data_etats[]= ["name"=>$value->designation,"y"=>$count];

      }
    /************************************ Chart Secteur ****************************************/
      
    $secteurs = Secteur::withCount(['engagements'=>function($query){$query->where('etat',1);}])
                        ->where('etat',1)->get();


   
    foreach ($secteurs as $key => $value) {
        $count = intval($value->engagements_count);
        $data_secteurs[]= ["name"=>$value->nom,"y"=>$count];
    }

    /************************************ Chart Source ****************************************/

     $sources_president = Categorie::withCount(['engagements'=>function($query){
          $query->where('etat',1);}])->where('etat',1)->where('type','Président')->get();

       $sources_gouvernement = Categorie::withCount(['engagements'=>function($query){
          $query->where('etat',1);}])->where('etat',1)->where('type','Gouvernement')->get();
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
         $count = intval($value->engagements_count);
         $data_sources_drilldown_president [] =[$value->designation,$count];
        }

      // Gouvernement
        foreach ($sources_gouvernement as $key => $value) {
          $count_sources_gouvernement += count($value->engagements);
        }
        
        foreach ($sources_gouvernement as $key => $value) {
         if($key==0){
            $data_sources[]= ["name"=>$value->type,"y"=>$count_sources_gouvernement,"drilldown"=>$value->type];
         }
          $count = intval($value->engagements_count);
            $data_sources_drilldown_gouvernement [] =[$value->designation,$count];

        }


    
    	$active = 'home';

      $engagements = Engagement::where('etat',1)->orderBy('updated_at','desc')->take(4)->get();
      $nbre_engagements = Engagement::where('etat',1)->count();
     
      $articles = Article::where('etat',1)->where('type','article')->orderBy('updated_at','desc')
                                        ->take(3)->get();
      $blogs = Article::where('etat',1)->where('type','blog')->orderBy('updated_at','desc')->take(3)->get();
      $videos = Article::where('etat',1)->where('type','video')->orderBy('updated_at','desc')->take(3)->get();
      $audios = Article::where('etat',1)->where('type','audio')->orderBy('updated_at','desc')->take(3)->get();
      $docs = Article::where('etat',1)->where('type','doc')->orderBy('updated_at','desc')->take(3)->get();

     JavaScript::put([
             'sources' => $data_sources,
             'drilldown_president' => $data_sources_drilldown_president,
             'drilldown_gouvernement' => $data_sources_drilldown_gouvernement,
             'secteurs' => $data_secteurs,
             'etats' => $data_etats
         ]);

  
    $commentaires = Commentaire::where('etat',1)->get();

        return view('guest.accueil',compact('active','articles','engagements','blogs','blogsext','videos','docs','audios','nbre_engagements','commentaires'));
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
      $relation_clause = 0;
      if(!empty($request->input('categorie'))) {
        $clauses['categorie_id'] = $request->input('categorie');
      }
      if(!empty($request->input('secteur'))) {
          $clauses['secteur_id'] = $request->input('secteur');
      }
      
      if(!empty($request->input('etat'))) {
        $relation_clause = $request->input('etat');

      }
       
      if(isset($_GET)){
        if(!empty($_GET['categorie_id'])) {
          $clauses['categorie_id'] = $_GET['categorie_id'];
        }
        if(!empty($_GET['seceur_id'])) {
            $clauses['secteur_id'] = $_GET['secteur'];
        }
        
        if(!empty($_GET['etat'])) {
          $relation_clause= $_GET['etat'];

        }

      }
      
      
      $engagements = Engagement::with('secteur','categorie','etats')
                                     ->where('etat',1)->where($clauses)->orderBy('updated_at','desc')
                                     ->paginate(15);


     
      
      $categories = Categorie::with('engagements')->where('type','president')->get();
      $secteurs = Secteur::where('etat',1)->get();
      $categorie = Categorie::where('etat',1)->get();
      $etats = Etat::where('etat',1)->get();
      $commentaires = Commentaire::where('etat',1)->get();

      

         return view('guest.president',compact('active','categorie','secteurs','categories','etats',
                                             'commentaires','engagements','clauses','relation_clause'));
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

       return view('guest.article',compact('active','article','slug'));
    }
    /**
     * Formulaire participation
      function.
     *
     * @return \Illuminate\Http\Response
     */
    public function formParticiper()
    {
    	 $active = 'participer';
        return view('guest.participer',compact('active'));
    }

    /**
     * Mediathèque function.
     *
     * @return \Illuminate\Http\Response
     */
    public function media()
    {
    		$active = 'media';
        $videos = Article::where('etat',1)->where('type','video')->get();
        $audios = Article::where('etat',1)->where('type','audio')->get();
        $articles = Article::where('etat',1)->where('type','article')->orderBy('updated_at','desc')->get();
        
        return view('guest.mediatheque',compact('active','videos','audios','articles'));
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
