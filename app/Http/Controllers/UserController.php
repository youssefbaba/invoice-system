<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Mail\EnvoiMailFeedback;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\FeedbackRequest;
use Illuminate\Support\Facades\Session;

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
    public function createfeedback()
    {
        $user = auth()->user();
        $admin = User::where('role', 1)->first();
        return view('feedback.comment')->with('user', $user)->with('admin', $admin);
    }
    public function envoiemailfeedback(FeedbackRequest $request)
    {

        $data = [
            'objet' => $request->objet,
            'message' => $request->message,
            'file' => $request->file('file'),
            'email_employe' => $request->email_employe,
            'email_admin' => $request->email_admin
        ];


        Mail::to($data['email_admin'])->send(new EnvoiMailFeedback($data));
        Session::flash('status_send_mail_feedback', ' Feedback envoyé avec succès.');
        return redirect()->route('clients.index');
    }
}
