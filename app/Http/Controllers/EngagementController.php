<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateEngagementRequest;

use App\Engagement;
use App\Secteur;
use App\Categorie;
use App\Etat;
use App\Commentaire;
use App\EngagementEtat;

use Illuminate\Support\Facades\Input;
use Excel;
use DB;
use stdClass;
use Carbon\Carbon;
use DateTime;

class EngagementController extends Controller
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
        $active = 'engagement';
        $engagements = Engagement::with('secteur','categorie')->where('etat',1)->orderBy('updated_at','desc')->get();
        $secteurs = Secteur::where('etat',1)->orderBy('nom','asc')->get();
        $categories = Categorie::where('etat',1)->orderBy('designation','asc')->get();
        $nombre_engagement = count($engagements);
        

        return view('admin.list-engagements',compact('active','secteurs','categories','engagements','nombre_engagement'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEngagementRequest $request)
    {
        $engagement = Engagement::create($request->all());

        $engagement->etats()->attach(12);
        
        return back();
    }

     /**
     * Import & Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function importExcel(Request $request)
    {
        
        if(Input::hasFile('import_file')){
                    $path = Input::file('import_file')->getRealPath();
                    $data = Excel::load($path, function($reader) {
                    })->get();
                    if(!empty($data) && $data->count()){
                        foreach ($data as $key => $value) {
                            if(!empty($value->intitule)){
                                $engagement = Engagement::create(['intitule' => $value->intitule, 
                                                'description' => $value->description,
                                                'secteur_id' => $value->secteur,
                                                'categorie_id' => $value->categorie,
                                                'source' => $value->source,
                                                'note' => $value->note,
                                                'localite' => $value->localite,
                                                'prefecture' => $value->prefecture,
                                                'sous_prefecture' => $value->sous_prefecture,
                                                'district' => $value->district,
                                                'date_debut' => $value->debut,
                                                'date_fin' => $value->fin]);
                                $engagement->etats()->attach(12);
                            }
                        }
                        
                    }
                }
        return back();
    }



    /**
     * Export resource storage in Excel.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportExcel($type)
        {
            $data = Item::get()->toArray();
            return Excel::create('itsolutionstuff_example', function($excel) use ($data) {
                $excel->sheet('mySheet', function($sheet) use ($data)
                {
                    $sheet->fromArray($data);
                });
            })->download($type);
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $active = 'engagement';
       $engagement = Engagement::withCount('etats')->where('etat',1)->findOrFail($id);
      
       $commentaires = Commentaire::where('etat',1)->orderBy('updated_at','desc')->get();

       $etats = Etat::where('etat',1)->get();  
       
       
       return view('admin.detail-engagement',compact('engagement','active','etats','commentaires','slug'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $active = 'engagement';
        $engagement = Engagement::findOrFail($id);
        $categories = Categorie::where('etat',1)->orderBy('updated_at','desc')->get();
        $secteurs = Secteur::where('etat',1)->orderBy('updated_at','desc')->get();
        return view('admin.edit-engagement',compact('active','engagement','categories','secteurs'));
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
        $data = $request->except('date_debut','date_fin');
        $engagement = Engagement::findOrFail($id);
        $engagement->update($data);

       $dt_debut = new DateTime($request->input('date_debut'));
       $dt_fin = new DateTime($request->input('date_fin'));

       $date_debut =  $dt_debut->format('Y-m-d');
       $date_fin =  $dt_fin->format('Y-m-d');

        $engagement->update(['date_debut'=>$date_debut,'date_fin'=>$date_fin]);
         return redirect(route('pw-admin-engagement.show',$id));

    }

    /**
     * Add the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addEtat(Request $request, $id)
    {
        
        $engagement = Engagement::findOrFail($id);
        $engagement->etats()->attach($request->input('etat_id'), ['titre_commentaire' => $request->input('titre_commentaire'),'commentaire'=>$request->input('commentaire')]);
        return back();
    }


    /**
     * Add the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateEtat(Request $request, $id)
    {
        
        return back();
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteEtat(Request $request, $id)
    {
        $engagement = Engagement::with('etats')->findOrFail($id);

        $commentaires = Commentaire::get();
        foreach ($engagement->etats as $key => $value) {
            if($value->pivot->etat_id == $request->input('etat_id')){
                $comment_id = $value->pivot->id;
            } 
           }
        foreach ($commentaires as $key => $value) {
            if($value->engagement_etat_id == $comment_id){
                $value->delete();
            }
        }
 
        $engagement->etats()->detach($request->input('etat_id'));
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
        $engagement = Engagement::findOrFail($id);
        
        $engagement->update(['etat'=>0]);
        // Detach all etats from the engagement
        $engagement->etats()->detach();

        return redirect(route('pw-admin-engagement.index'));
    }
}
