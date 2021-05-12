<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Http\Requests\createClientRequest;
use App\Http\Requests\updateClientRequest;
use DB;
use App\Cle;
use App\Facture;


class clientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // hnaya user li authentifier
        $user = auth()->user();
        // les clients li criyahom  hadak user li authentifier
        $clients = Client::where('user_id', $user->id)->get();
        // recuperation dyal les cles kamline
        $cle = Cle::all();
        return \view('clients.showclients')->with('clients', $clients)->with('cles', $cle)->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $cle = Cle::select('mot_cle')->distinct()->get();
        // $cle = Cle::all();
        return \view('clients.addclient')->with('cles', $cle)->with('user', $user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(createClientRequest $request)
    {
        $user = auth()->user();
        // dd($request);
        Client::create([
            'adresse_email_client' => $request->adresse_email_client,
            'nom_client' => $request->nom_client,
            'prenom_client' => $request->prenom_client,
            'fonction_client' => $request->fonction_client,
            'adresse_client' => $request->adresse_client,
            'langue_client' => $request->langue,
            'codep_client' => $request->codepostal_client,
            'ville_client' => $request->ville_client,
            'site_client' => $request->site_client,
            'tel_client' => $request->tel_client,
            'societe_client' => $request->societe_client,
            'note_client' => $request->note_client,
            'user_id' => $user->id

        ]);
        $id = DB::getPdo()->lastInsertId();
        $test = $request->motcle_client[0];

        if ($test == null) {
            for ($j = 0; $j < 0; $j++) {
                break;
                DB::table('cles')->insert(array(
                    array(
                        'client_id' => $id,
                        'mot_cle' => $request->motcle_client[$j]
                    )
                ));
            };
        } else {
            for ($k = 0; $k < \count($request->motcle_client); $k++) {
                DB::table('cles')->insert(array(
                    array(
                        'client_id' => $id,
                        'mot_cle' => $request->motcle_client[$k]
                    )
                ));
            };
        }
        return redirect()->route('clients.index')->with('user', $user);
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
    public function edit(Client $client)
    {
        $user = auth()->user();
        $arr = ['Francais', 'Arabic', 'Anglais'];
        $cles = Cle::where('client_id', $client->id)->get();
        // dd($client);
        return \view('clients.editclient')->with('clients', $client)->with('arrs', $arr)->with('cles', $cles)->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(updateClientRequest $request, Client $client)
    {
        $user = auth()->user();
        $client->adresse_email_client = $request->adresse_email_client;
        $client->nom_client = $request->nom_client;
        $client->prenom_client = $request->prenom_client;
        $client->fonction_client = $request->fonction_client;
        $client->adresse_client = $request->adresse_client;
        $client->langue_client = $request->langue;
        $client->codep_client = $request->codepostal_client;
        $client->ville_client = $request->ville_client;
        $client->site_client = $request->site_client;
        $client->tel_client = $request->tel_client;
        $client->societe_client = $request->societe_client;
        $client->note_client = $request->note_client;
        $client->save();
        $test = $request->motcle_client[0];
        if ($test == null) {

            DB::table('cles')->where('client_id', $client->id)->delete();
            for ($j = 0; $j < 0; $j++) {
                break;
                DB::table('cles')->insert(array(
                    array(
                        'client_id' => $client->id,
                        'mot_cle' => $request->motcle_client[$j]
                    )
                ));
            };
        } else {

            DB::table('cles')->where('client_id', $client->id)->delete();
            for ($k = 0; $k < \count($request->motcle_client); $k++) {
                DB::table('cles')->insert(array(
                    array(
                        'client_id' => $client->id,
                        'mot_cle' => $request->motcle_client[$k]
                    )
                ));
            };
        }
        return \redirect('clients')->with('user', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $cles = DB::table('cles')->where('client_id', $client->id)->get();
        for ($k = 0; $k < \count($cles); $k++) {
            DB::table('cles')->where('client_id', $client->id)->delete();
        };
        $client->delete();
        return redirect('clients');
    }
    public function deconnexion()
    {
        auth()->logout();

        return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function voirplus($id)
    {
        $user = auth()->user();
        // kinfiltrer wa7ad client bi id dyalo
        $client = Client::find($id);
        //dd($client = Client::find($id));
        // dd($client);
        $cle = Cle::all();
        return view('clients.voirclient')->with('clients', $client)->with('user', $user)->with('cles', $cle);
    }
    public function search(Request $request)
    {
        // dd($request);
        $user = auth()->user();
        $cle = Cle::all();
        $request->validate([

            'q' => 'required'
        ]);

        $q = $request->q;
        $clients_cles = Client::where('nom_client', 'like', '%' . $q . '%')
            ->orWhere('prenom_client', 'like', '%' . $q . '%')
            ->orWhere('adresse_email_client', 'like', '%' . $q . '%')
            ->orWhere('tel_client', 'like', '%' . $q . '%')
            ->orWhereHas('cles', function ($query) use ($q) {
                $query->where('mot_cle', 'like', '%' . $q . '%');
            })->get();
        // dd($clients_cles);
        if ($clients_cles->count()) {

            return view('clients.showclientsearch')->with('clients_cles', $clients_cles)->with('cles', $cle)->with('user', $user);
        } else {
            return view('clients.showclientsearch')->with('status', 'recherche failed')->with('user', $user)->with('clients_cles', []);
        }
    }
}
