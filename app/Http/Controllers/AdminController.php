<?php

namespace App\Http\Controllers;


use App\User;
use App\Mail\CreateNewUser;
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


    public function listuser()
    {
        $users = User::paginate(3);
        return view('admin.listusers')->with('users', $users);
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
        Session::flash('status_add_utilisateur', 'Employé  créé avec succès.');
        return redirect()->route('admin');
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
    public function update($id)
    {
        $user = User::findOrfail($id);
        $user->role = 1;
        $user->save();
        Session::flash('status_updated_role_user', 'Le role  modifié avec succès.');
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

        Session::flash('status_delete_utilisateur', 'Employé supprimé avec succès.');
        return redirect()->route('admin');
    }

    public function search(Request $request)
    {
        // dd($request);
        // $request->validate([

        //     'q' => 'required'
        // ]);

        $q = $request->q;
        $users = User::where('name', 'like', '%' . $q . '%')
            ->orWhere('lastname', 'like', '%' . $q . '%')
            ->orWhere('email', 'like', '%' . $q . '%')->paginate(3);
        $users->appends(['q' => $q]);
        return view('admin.searchuser')->with('users', $users);
    }
}
