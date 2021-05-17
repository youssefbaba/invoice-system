<?php

namespace App\Http\Controllers;

use App\User;
use Facade\FlareClient\View;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['is.admin']);

        // $this->middleware(['is.admin','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $useradmin = User::where('role', 1)->get();
        $listuser = User::where('role', 0)->get();
        return view('admin.listall')->with('users', $users)->with('useradmin', $useradmin)->with('listuser', $listuser);
    }
    public function listadmin()
    {
        $users = User::all();
        $useradmin = User::where('role', 1)->get();
        $listuser = User::where('role', 0)->get();
        return view('admin.listadministrateurs')->with('users', $users)->with('useradmin', $useradmin)->with('listuser', $listuser);
    }
    public function listuser()
    {
        $users = User::all();
        $useradmin = User::where('role', 1)->get();
        $listuser = User::where('role', 0)->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ajouteruser');
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
        $user = User::findOrfail($id);
        return view('admin.showuser')->with('user', $user);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.editroleuser')->with('user', $user);
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
        $user = User::findOrfail($id);
        $user->role = 1;
        $user->save();
        return redirect()->route('admin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteuser($user_id)
    {
        $user = User::findOrfail($user_id);
        $user->delete();
        return redirect()->route('admin');
    }
}
