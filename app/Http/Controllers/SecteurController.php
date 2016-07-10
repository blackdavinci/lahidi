<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateSecteurRequest;

use App\Secteur;
use App\Engagement;

class SecteurController extends Controller
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
        $active = 'secteur';
        $secteurs = Secteur::where('etat',1)->orderBy('nom','asc')->get();
        $nombre_secteur = count($secteurs);
        return view('admin.list-secteurs',compact('active','secteurs','nombre_secteur'));
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
    public function store(CreateSecteurRequest $request)
    {
        //

        Secteur::create($request->all());
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
        //
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
    public function update(CreateSecteurRequest $request, $id)
    {
        $secteur = Secteur::findOrFail($id);
        $secteur->update($request->all());
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
       $secteur = Secteur::findOrFail($id);
       $engagements = Engagement::where('secteur_id',$id)->get();
       foreach ($engagements as $key => $value) {
           $value->update(['etat'=>0]);
       }
       
       $secteur->update(['etat'=>0]);

       return back();
    }
}
