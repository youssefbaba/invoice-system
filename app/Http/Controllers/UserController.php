<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return view('user.info')->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        return view('user.finichinformations')->with('user', $user);
    }
    public function store(Request $request, $user_id)
    {
        $user = User::findOrfail($user_id);
        $user->adresse = $request->adresse;
        $user->name_company = $request->societe;
        $user->codepostal = $request->postal;
        $user->ville = $request->ville;
        $user->pays = $request->pays;
        $user->tel = $request->phone;
        $user->save();
        return redirect()->route('clients.index');
    }
}
