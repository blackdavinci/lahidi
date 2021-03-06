<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateEtatRequest;

use App\Etat;
use App\Commentaire;
use App\Engagement;
use Auth;

class EtatController extends Controller
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
        if(Auth::user()->role=='admin'){
            $active = 'etat';
            $etats = Etat::where('etat',1)->orderBy('designation')->get();
            $nombre_etat = count($etats);

            return view('admin.list-etats',compact('active','etats','nombre_etat'));
        }else{
            return redirect('/logout')->withErrors("Vueillez vous connecter en tant qu\'administrateur");
        }
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
    public function store(CreateEtatRequest $request)
    {
        if(Auth::user()->role=='admin'){
           Etat::create($request->all());
           return back(); 
        }else{
            return redirect('/logout')->withErrors("Vueillez vous connecter en tant qu\'administrateur");
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
    public function update(CreateEtatRequest $request, $id)
    {
        if(Auth::user()->role=='admin'){
            $etat = Etat::findOrFail($id);
            $etat->update($request->all());
            return back();
        }else{
            return redirect('/logout')->withErrors("Vueillez vous connecter en tant qu\'administrateur");
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
        if(Auth::user()->role=='admin'){
            $etat = Etat::findOrFail($id);
            $etat->update(['etat'=>0]);
            // Detach all engagements from the etats
            $etat->engagements()->detach();
            return back();
        }else{
            return redirect('/logout')->withErrors("Vueillez vous connecter en tant qu\'administrateur");
        }
    }
}
