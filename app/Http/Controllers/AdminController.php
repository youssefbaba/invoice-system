<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\CreateNewUser;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreRequestNewUser;

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
        return view('admin.listusers')->with('users', $users)->with('useradmin', $useradmin)->with('listuser', $listuser);
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
    public function store(StoreRequestNewUser $request)
    {
        // dd($request);
        $user = new User();
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        // 'password' => Hash::make($data['password']),
        $user->password = Hash::make($request->password);
        $user->email = $request->email;
        $user->save();
        Mail::to($request->email)->send(new CreateNewUser($user, $request->password));
        Session::flash('statuscode', 'success');
        return redirect()->route('admin')->with('status_add_utilisateur', 'Utilisateur ajouté avec succès.');
    }
    protected function guard()
    {
        return Auth::guard();
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
        Session::flash('statuscode', 'info');
        return redirect()->route('admin')->with('status_updated_role_user', 'Le role  modifié avec succès.');
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

        Session::flash('statuscode', 'error');
        return redirect()->route('admin')->with('status_delete_utilisateur', 'Utilisateur supprimé avec succès.');
    }
}
