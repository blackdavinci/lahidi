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
use stdClass;

class GuestController extends Controller
{
    /**
     * Accueil function.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
      //  // Set target url
      //  Preview::setUrl('http://www.ablogui.com/droitalidentite-lettre-ouverte-gouvernement/');

      //  // Get parsed HTML tags as a plain array
      // $preview = Preview::getPreview('general')->toArray();

      //  // In case of redirects, see what the final url was
      //  Preview::getUrl();
      //   var_dump($preview);

      //   $linkPreview = new LinkPreview('https://www.youtube.com/watch?v=8ZcmTl_1ER8');
      //   $parsed = $linkPreview->getParsed();
      //   foreach ($parsed as $parserName => $link) {
      //       echo $parserName . PHP_EOL . PHP_EOL;

      //       echo $link->getUrl() . PHP_EOL;
      //       echo $link->getRealUrl() . PHP_EOL;
      //       echo $link->getTitle() . PHP_EOL;
      //       echo $link->getDescription() . PHP_EOL;
      //       echo $link->getImage() . PHP_EOL;
      //       if ($link instanceof VideoLink) {
      //           echo $link->getVideoId() . PHP_EOL;
      //           echo $link->getEmbedCode() . PHP_EOL;
      //       }
      //   }

      //   dd();
    	$active = 'home';
        return view('guest.home',compact('active'));
    }

    /**
     * Président function.
     *
     * @return \Illuminate\Http\Response
     */
    public function president()
    {
    	$active = 'promesses';
    	// $categorie = 'president';
    	// $engagements = Engagement::with('secteur', 'categorie','etats')->whereHas('categorie', function($query){
    	//     $query->where('type', '=', 'president');
    	// })->paginate(15);
    	
   		$engagements = Engagement::with('secteur','categorie','etats')->where('etat',1)->orderBy('updated_at','desc')->paginate(15);
    	$categories = Categorie::with('engagements')->where('type','president')->get();
    	$secteurs = Secteur::where('etat',1)->get();
    	$categorie = Categorie::where('etat',1)->get();
    	$etats = Etat::where('etat',1)->get();
    	$commentaires = Commentaire::where('etat',1)->get();
    	
    	
    	
    	
    	// dd();

        return view('guest.president',compact('active','categorie','secteurs','categories','etats','commentaires','engagements'));
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
