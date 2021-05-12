<?php

namespace App\Http\Controllers;

use DB;
use Image;
use App\User;
// use App\Client;
// use App\Facture;
use Illuminate\Http\Request;
use App\Http\Requests\userRequest;
use Illuminate\Routing\Controller;
use App\Http\Requests\compteRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\deleteCompteRequest;

class parametreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return view('parameters.cordonne')->with('user', $user);
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
    public function store(Request $request)
    {
        //
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
    public function update(userRequest $request, $id)
    {

        if ($request->hasFile('avatar')) {
            $user = User::find($id);
            $user->name = $request->prénom;
            $user->lastname = $request->nom;
            $user->adresse = $request->adresse;
            $user->name_company = $request->societe;
            $user->codepostal = $request->code_postal;
            $user->ville = $request->ville;
            $user->tel = $request->telephone;
            $user->email_profes = $request->adresse_email_pro;
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(150, 150)->save(public_path('/uploads/avatars/' . $filename));
            $user->avatar = $filename;
            $user->save();
        } else {
            $user = User::find($id);
            $user->name = $request->prénom;
            $user->lastname = $request->nom;
            $user->adresse = $request->adresse;
            $user->name_company = $request->societe;
            $user->codepostal = $request->code_postal;
            $user->ville = $request->ville;
            $user->tel = $request->telephone;
            $user->email_profes = $request->adresse_email_pro;
            $user->save();
        }
        return redirect()->back();
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
    public function parametre_compte()
    {
        $user = auth()->user();
        return view('parameters.compte')->with('user', $user);
    }
    public function updateCompte(compteRequest $request, $id_user)
    {
        $user = User::find($id_user);
        if (Hash::check($request->pass_actuel, $user->password)) {
            if ($user->email == $request->adresse_email) {
                $user->password = Hash::make($request->passnew);
                $user->save();
                session()->flash('msg', 'Votre mot de pass modifier avec succes');
                return redirect()->back();
            } else {
                $user->email = $request->adresse_email;
                $user->password = Hash::make($request->passnew);
                $user->save();
                session()->flash('msg', 'Votre modification effectuer avec succes mais notice vous devez confirmer votre nouvelle adresse email');
                return redirect()->back();
            }
        } else {
            session()->flash('error', 'Votre mot de pass actuel n\'est pas correct ');
            return redirect()->back();
        }
    }
    public function parametre_delete()
    {
        $user = auth()->user();
        return view('parameters.delete')->with('user', $user);
    }
    public function delete_account(deleteCompteRequest $request, $id_user)
    {
        $user = User::find($id_user);
        if (Hash::check($request->pass, $user->password)) {
            DB::table('raisons')->insert([
                'email' => $user->email,
                'raison' => $request->raison,
                'remarques' => $request->remarque,
            ]);
            $user->delete();
            return redirect('/deconnexion');
        } else {
            session()->flash('error', 'Le mot de pass n\'est pas correct');
            return redirect()->back();
        }
    }
}
