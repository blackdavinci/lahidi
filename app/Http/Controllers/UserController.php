<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Requests\CreateUserRequest;

use App\User;
use Auth;

class UserController extends Controller
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
            $active = 'user';
            $users = User::where('etat',1)->orderBy('updated_at')->get();
            $nombre_user = count($users);
            return view('admin.list-users',compact('active','users','nombre_user'));
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
    public function store(CreateUserRequest $request)
    {
     
                 
        if(Auth::user()->role=='admin'){
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'role' => $request->input('role'),
                'password' => bcrypt($request->input('password')),
            ]);
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
    public function update(CreateUserRequest $request, $id)
    {
        if(Auth::user()->role=='admin'){
            $user = User::findOrFail($id);
            $user->update($request->all());
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
            $user = User::findOrFail($id);
            $user->delete();
            return back();
        }else{
            return redirect('/logout')->withErrors("Vueillez vous connecter en tant qu\'administrateur");
        }
    }
}
