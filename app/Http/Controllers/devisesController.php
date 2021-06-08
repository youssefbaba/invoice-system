<?php

namespace App\Http\Controllers;

use App\Cle;
use App\Devi;
use App\Client;
use App\Article;

use App\Mail\EnvoiMailDevi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\devisRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;

class devisesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $devises = Devi::where('user_id', $user->id)->paginate(3);
        // dd($devises);
        $cle = Cle::all();
        return view('devises.showdevises')->with('devises', $devises)->with('clients', Client::all())->with('user', $user)->with('cles', $cle);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $clients = Client::where('user_id', $user->id)->get();
        $cle = Cle::select('mot_cle')->distinct()->get();
        return \view('devises.adddevis')->with('clients', $clients)->with('user', $user)->with('cles', $cle);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(devisRequest $request)
    {
        // dd($request);
        $user = auth()->user();
        DB::table('devis')->insert([
            'etat_devis' => 'Provisoire',
            'remised' => $request->remise,
            'total_ht_articlesdf' => $request->totalht_final_lastd,
            'remise_gendf' => $request->remise_final_lastd,
            'total_ht_apres_remise_gendf' => $request->total_ht_final_lastd,
            'tvadf' => $request->tva_final_lastd,
            'total_facturedf' => $request->total_total_lastd,
            'condition_regld' => $request->condition_reglement,
            'mode_regld' => $request->mode_reglement,
            'interet_regld' => $request->interet,
            'text_introductiond' => $request->text_introd,
            'text_conclusiond' => $request->text_concld,
            'pied_paged' => $request->text_piedd,
            'condition_vented' => $request->text_cond,
            'client_id' => $request->clients,
            'user_id' => $user->id,
            'devis' => $request->devis,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        $id = DB::getPdo()->lastInsertId();
        $devis = Devi::where('id', $id)->first();
        $devis->code_devis = 'D' . $devis->created_at->format('Y') . $id;
        $devis->save();

        for ($i = 0; $i < \count($request->quantitéd); $i++) {
            DB::table('articles')->insert(array(
                array(
                    'type_article' => $request->typed[$i],
                    'quantité_article' => $request->quantitéd[$i],
                    'prix_ht_article' => $request->prixhtd[$i],
                    'tva' => $request->tvad[$i],
                    'reduction_article' => $request->reductiond[$i],
                    'total_ht_article' => $request->totalhtd[$i],
                    'total_ttc_article' => $request->totalttcd[$i],
                    'description_article' => $request->descriptiond[$i],
                    'devi_id' => $id,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                )
            ));
        };
        //insert mor cles
        $test2 = $request->motcled[0];
        if ($test2 == null) {
            for ($t = 0; $t < 0; $t++) {
                break;
                DB::table('cles')->insert(array(
                    array(
                        'devi_id' => $id,
                        'mot_cle' => $request->motcled[$t]
                    )
                ));
            };
        } else {
            for ($n = 0; $n < \count($request->motcled); $n++) {
                DB::table('cles')->insert(array(
                    array(
                        'devi_id' => $id,
                        'mot_cle' => $request->motcled[$n]
                    )
                ));
            };
        }
        $user = auth()->user();
        $devises = Devi::where('user_id', $user->id)->get();
        // dd($devises );
        //return view('devises.showdevises')->with('devises',$devises)->with('clients',Client::all());
        if ($request->checked === 'dupliquer') {
            Session::flash('status_duplicate_facture_en_devi', 'Facture dupliqué  en devis avec succès.');
            return redirect()->to('/devises')->with('devises', $devises)->with('clients', Client::all())->with('user', $user);
        }
        if ($request->checked === 'dupliquer_avoir_devi') {
            Session::flash('status_duplicate_avoir_en_devi', 'Avoir dupliqué  en devis avec succès.');
            return redirect()->to('/devises')->with('devises', $devises)->with('clients', Client::all())->with('user', $user);
        } else {
            Session::flash('status_add_devis', 'Devis créé avec succès.');
            return redirect()->to('/devises')->with('devises', $devises)->with('clients', Client::all())->with('user', $user);
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
    public function update(Request $request, Devi $devise)
    {

        $devise->total_ht_articlesdf = $request->total_ht_articlesdf;
        $devise->remise_gendf = $request->total_ht_apres_remise_gendf;
        $devise->total_ht_apres_remise_gendf = $request->total_ht_apres_remise_gendf;
        $devise->tvadf = $request->tvadf;
        $devise->total_facturedf = $request->total_facturedf;
        $devise->condition_regld = $request->condition_regld;
        $devise->mode_regld = $request->mode_regld;
        $devise->interet_regld = $request->interet_regld;
        $devise->text_introductiond = $request->text_introductiond;
        $devise->text_conclusiond = $request->text_conclusiond;
        $devise->pied_paged = $request->pied_paged;
        $devise->condition_vented = $request->condition_vented;
        $devise->client_id = $request->clients;
        $devise->devis = $request->devis;
        $devise->updated_at = \Carbon\Carbon::now();
        $devise->save();
        //article update
        $test_article = $request->quantitéd[0];
        if ($test_article == null) {
            for ($m = 0; $m < 0; $m++) {
                break;
                DB::table('articles')->where('devi_id', $devise->id)->delete();
                DB::table('articles')->insert(array(
                    array(
                        'type_article' => $request->typed[$m],
                        'quantité_article' => $request->quantitéd[$m],
                        'prix_ht_article' => $request->prixhtd[$m],
                        'tva' => $request->tvad[$m],
                        'reduction_article' => $request->reductiond[$m],
                        'total_ht_article' => $request->totalhtd[$m],
                        'total_ttc_article' => $request->totalttcd[$m],
                        'description_article' => $request->descriptiond[$m],
                        'devi_id' => $devise->id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    )
                ));
            };
        } else {
            DB::table('articles')->where('devi_id', $devise->id)->delete();
            for ($i = 0; $i < \count($request->quantitéd); $i++) {
                DB::table('articles')->insert(array(
                    array(
                        'type_article' => $request->typed[$i],
                        'quantité_article' => $request->quantitéd[$i],
                        'prix_ht_article' => $request->prixhtd[$i],
                        'tva' => $request->tvad[$i],
                        'reduction_article' => $request->reductiond[$i],
                        'total_ht_article' => $request->totalhtd[$i],
                        'total_ttc_article' => $request->totalttcd[$i],
                        'description_article' => $request->descriptiond[$i],
                        'devi_id' => $devise->id,
                        'updated_at' => \Carbon\Carbon::now()
                    )
                ));
            };
        }
        //cles update
        $test = $request->motcle[0];
        if ($test == null) {
            DB::table('cles')->where('devi_id', $devise->id)->delete();
            for ($j = 0; $j < 0; $j++) {
                break;
                DB::table('cles')->insert(array(
                    array(
                        'devi_id' => $devise->id,
                        'mot_cle' => $request->motcle[$j]
                    )
                ));
            };
        } else {
            DB::table('cles')->where('devi_id', $devise->id)->delete();
            for ($k = 0; $k < \count($request->motcle); $k++) {
                DB::table('cles')->insert(array(
                    array(
                        'devi_id' => $devise->id,
                        'mot_cle' => $request->motcle[$k]
                    )
                ));
            };
        }
        $user = auth()->user();
        $devises = Devi::where('user_id', $user->id)->get();
        Session::flash('status_update_devis', 'Devi modifié avec succès.');
        return redirect()->to('/devises')->with('devises', $devises)->with('clients', Client::all())->with('user', $user);
        //return dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Devi $devise)
    {
        $devise->delete();

        Session::flash('status_destroy_devis', 'Devis supprimé avec succès.');
        return redirect()->back();
    }
    public function editdevis($devi_id, $client_id)
    {
        // $user = auth()->user();
        $arr = ['(DH)', '($)', '(€)'];
        $arr = [];
        $client = Client::where('id', $client_id)->first();
        $devi = Devi::where('id', $devi_id)->first();
        $articles = Article::where('devi_id', $devi_id)->get();
        $user = auth()->user();
        $clientes = Client::where('user_id', $user->id)->get();
        $cles = Cle::where('devi_id', $devi_id)->get();
        $cle = Cle::select('mot_cle')->distinct()->get();
        return \view('devises.editdevis')->with('devis', $devi)->with('clients', $client)->with('arrs', $arr)->with('articles', $articles)->with('cles', $cles)->with('clientes', $clientes)->with('user', $user)->with('cle', $cle);
    }
    public function editdevis_vide($devi_id)
    {
        $user = auth()->user();
        $arr = ['(DH)', '($)', '(€)'];
        $arr = [];
        $devi = Devi::where('id', $devi_id)->first();
        $articles = Article::where('devi_id', $devi_id)->get();
        $cles = Cle::where('devi_id', $devi_id)->get();
        $cle = Cle::select('mot_cle')->distinct()->get();
        $user = auth()->user();
        $clients = Client::where('user_id', $user->id)->get();
        return \view('devises.editdevisvide')->with('devis', $devi)->with('arrs', $arr)->with('articles', $articles)->with('cles', $cles)->with('clients', $clients)->with('user', $user)->with('cle', $cle);
    }
    public function duplicatedevise($devi_id, $client_id)
    {
        $user = auth()->user();
        $arr = ['(DH)', '($)', '(€)'];
        $arr = [];
        $client = Client::where('id', $client_id)->first();
        $clientes = Client::where('id', '!=', $client_id)->get();
        $devi = Devi::where([['user_id', $user->id], ['id', $devi_id]])->first();
        $articles = Article::where('devi_id', $devi_id)->get();
        $cle = Cle::select('mot_cle')->distinct()->get();
        $cles = Cle::where('devi_id', $devi_id)->get();
        return \view('devises.duplicatedevise')->with('devis', $devi)->with('clients', $client)->with('arrs', $arr)->with('articles', $articles)->with('cles', $cles)->with('user', $user)->with('cle', $cle)->with('clientes', $clientes);
    }
    public function duplicatedevise_vide($devi_id)
    {
        $arr = ['(DH)', '($)', '(€)'];
        $arr = [];
        $devi = Devi::where('id', $devi_id)->first();
        $articles = Article::where('devi_id', $devi_id)->get();
        $cles = Cle::where('devi_id', $devi_id)->get();
        $user = auth()->user();
        $clients = Client::where('user_id', $user->id)->get();
        return \view('devises.duplicatedevise_vide')->with('devis', $devi)->with('arrs', $arr)->with('articles', $articles)->with('cles', $cles)->with('clients', $clients)->with('user', $user);
    }
    public function showprovi()
    {
        $user = auth()->user();
        $devises = Devi::where([['user_id', $user->id], ['etat_devis', 'Provisoire']])->paginate(3);
        // dd($devises);
        $cle = Cle::all();
        return \view('devises.showdeviprovi')->with('devises', $devises)->with('clients', Client::all())->with('user', $user)->with('cles', $cle);
    }
    public function showfinalise()
    {
        $user = auth()->user();
        $devises = Devi::where([['user_id', $user->id], ['etat_devis', 'Finalisé']])->paginate(3);
        $cle = Cle::all();
        return \view('devises.showdevisfinalise')->with('devises', $devises)->with('clients', Client::all())->with('user', $user)->with('cles', $cle);
    }
    public function showrefuse()
    {
        $user = auth()->user();
        $devises = Devi::where([['user_id', $user->id], ['etat_devis', 'Refusés']])->paginate(3);
        $cle = Cle::all();
        return \view('devises.showdevisrefuse')->with('devises', $devises)->with('clients', Client::all())->with('user', $user)->with('cles', $cle);
    }
    public function showsigne()
    {
        $user = auth()->user();
        $devises = Devi::where([['user_id', $user->id], ['etat_devis', 'Signés']])->paginate(3);
        $cle = Cle::all();
        return \view('devises.showdevissign')->with('devises', $devises)->with('clients', Client::all())->with('user', $user)->with('cles', $cle);
    }
    public function finalisedevi($id)
    {

        $etat = Devi::find($id)->etat_devis;
        switch ($etat) {
            case 'Provisoire':
                DB::table('devis')
                    ->where('id', $id)
                    ->update(['etat_devis' => 'Finalisé', 'updated_at' => \Carbon\Carbon::now()]);
                Session::flash('status_finalise_devi', 'Devis finalisé avec succès.');
                return redirect()->back();
            case 'Refusés':
                DB::table('devis')
                    ->where('id', $id)
                    ->update(['etat_devis' => 'Finalisé', 'updated_at' => \Carbon\Carbon::now()]);
                Session::flash('status_annuler_refuse', 'Refuse annulé avec succès.');
                return \redirect()->back();
            case 'Signés':
                DB::table('devis')
                    ->where('id', $id)
                    ->update(['etat_devis' => 'Finalisé', 'updated_at' => \Carbon\Carbon::now()]);
                Session::flash('status_annuler_signature', 'Signature annulé avec succès.');
                return \redirect()->back();
        }
    }
    public function signéedevi($id)
    {
        DB::table('devis')
            ->where('id', $id)
            ->update(['etat_devis' => 'Signés', 'updated_at' => \Carbon\Carbon::now()]);
        Session::flash('status_signe_devis', 'Devis signé avec succès.');
        return \redirect()->back();
    }
    public function refusedevi($id)
    {
        DB::table('devis')
            ->where('id', $id)
            ->update(['etat_devis' => 'Refusés', 'updated_at' => \Carbon\Carbon::now()]);
        Session::flash('status_refuse_devis', 'Devis refusé avec succès.');
        return \redirect()->back();
    }


    public function voirplus_devi($id)
    {
        $user = auth()->user();
        $devise = Devi::find($id);
        // dd($devise);
        $articles = Article::where('devi_id', $id)->get();
        // dd($articles);
        $client = Client::all();
        $cles = Cle::all();
        return view('devises.devis_voirplus')->with('devise', $devise)->with('articles', $articles)->with('clients', $client)->with('user', $user)->with('cles', $cles);
    }


    public function deletedevise($devi_id)
    {
        $user = auth()->user();
        $devise = Devi::where('id', $devi_id)->first();
        // dd($devise);
        $devise->delete();
        $user = auth()->user();
        $devises = Devi::where('user_id', $user->id)->get();
        $cles = Cle::all();
        Session::flash('status_delete_devi', 'Devis supprimé avec succès.');
        return redirect()->route('devises.index')->with('devises', $devises)->with('clients', Client::all())->with('user', $user)->with('cles', $cles);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_duplicate(Request $request)
    {
        // dd($request);

        $user = auth()->user();
        DB::table('devis')->insert([
            'etat_devis' => 'Provisoire',
            'remised' => $request->remise,
            'total_ht_articlesdf' => $request->total_ht_articlesdf,
            'total_ht_apres_remise_gendf' => $request->total_ht_apres_remise_gendf,
            'remise_gendf' => $request->remise_gendf,
            'tvadf' => $request->tvadf,
            'total_facturedf' => $request->total_facturedf,
            'condition_regld' => $request->condition_reglement,
            'mode_regld' => $request->mode_reglement,
            'interet_regld' => $request->interet,
            'text_introductiond' => $request->text_introd,
            'text_conclusiond' => $request->text_concld,
            'pied_paged' => $request->text_piedd,
            'condition_vented' => $request->condition_vente,
            'client_id' => $request->clients,
            'user_id' => $user->id,
            'devis' => $request->devis,
            'code_devis' => $request->code_devis,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        $id = DB::getPdo()->lastInsertId();
        $devis = Devi::where('id', $id)->first();
        $devis->code_devis = 'D' . $devis->created_at->format('Y') . $id;
        $devis->save();
        for ($i = 0; $i < \count($request->quantitéd); $i++) {
            DB::table('articles')->insert(array(
                array(
                    'type_article' => $request->typed[$i],
                    'quantité_article' => $request->quantitéd[$i],
                    'prix_ht_article' => $request->prixhtd[$i],
                    'tva' => $request->tvad[$i],
                    'reduction_article' => $request->reductiond[$i],
                    'total_ht_article' => $request->totalhtd[$i],
                    'total_ttc_article' => $request->totalttcd[$i],
                    'description_article' => $request->descriptiond[$i],
                    'devi_id' => $id,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                )
            ));
        };
        $test2 = $request->motcled[0];
        if ($test2 == null) {
            for ($t = 0; $t < 0; $t++) {
                break;
                DB::table('cles')->insert(array(
                    array(
                        'devi_id' => $id,
                        'mot_cle' => $request->motcled[$t]
                    )
                ));
            };
        } else {
            for ($n = 0; $n < \count($request->motcled); $n++) {
                DB::table('cles')->insert(array(
                    array(
                        'devi_id' => $id,
                        'mot_cle' => $request->motcled[$n]
                    )
                ));
            };
        }
        $user = auth()->user();
        $devises = Devi::where('user_id', $user->id)->get();
        Session::flash('status_duplicate_devi', 'Devis dupliqué avec succès.');
        return redirect()->to('/devises')->with('devises', $devises)->with('clients', Client::all())->with('user', $user);
    }
    public function genererpdf($devi_id)
    {
        $devise = Devi::find($devi_id);
        $articles = Article::where('devi_id', $devi_id)->get();
        $pdf = PDF::loadView('devises.devispdf', compact('devise', 'articles'));
        return $pdf->download('Devi_' . $devise->etat_devis . '.pdf');
    }
    public function create_devis_client($id)
    {
        $user = auth()->user();
        $client_determiner = Client::where('id', $id)->first();
        $cle = Cle::select('mot_cle')->distinct()->get();
        return \view('devises.adddevis')->with('client_determiner', $client_determiner)->with('user', $user)->with('cles', $cle);
    }

    public function duplicateen_facture($devi_id)
    {
        $arr = ['(DH)', '($)', '(€)'];
        $arr = [];
        $user = auth()->user();
        $devi = Devi::where('id', $devi_id)->first();
        $articles = Article::where('devi_id', $devi_id)->get();
        $user = auth()->user();
        $clientes = Client::where('user_id', $user->id)->get();
        $cles = Cle::where('devi_id', $devi_id)->get();
        $cle = Cle::select('mot_cle')->distinct()->get();
        return \view('devises.duplicateen_facture')->with('debours', [])->with('devis', $devi)->with('arrs', $arr)->with('articles', $articles)->with('cles', $cles)->with('clientes', $clientes)->with('user', $user)->with('cle', $cle);
    }
    public function search(Request $request)
    {
        // dd($request);
        $q = $request->q;
        // do things with them...

        $user = auth()->user();
        $cle = Cle::all();
        // $q = $request->q;
         $devis_cles_clients = Devi::where('etat_devis', 'like', '%' . $q . '%')
            ->orWhere('code_devis', 'like', '%' . $q . '%')
            ->orWhereHas('cles', function ($query) use ($q) {
                $query->where('mot_cle', 'like', '%' . $q . '%');
            })->orWhereHas('client', function ($query) use ($q) {
                $query->where('nom_client', 'like', '%' . $q . '%')
                    ->orWhere('prenom_client', 'like', '%' . $q . '%');
            })->paginate(3);
            // $devis_cles_clients = $devis_cles_clients->where('user_id',$user->id)->paginate(3);

            $devis_cles_clients->appends(['q' => $q]);
        if ($devis_cles_clients->count()) {

            return view('devises.showdevisearch')->with('devis_cles_clients', $devis_cles_clients)->with('cles', $cle)->with('user', $user)->with('clients', Client::all());
        } else {
            return view('devises.showdevisearch')->with('status', 'recherche failed')->with('user', $user)->with('devis_cles_clients', [])->with('clients', Client::all());
        }
    }
    public function create_email($devi_id, $client_id)
    {
        $user = auth()->user();
        $client = Client::where('id', $client_id)->first();
        $clientes = Client::whereNotIn('id', [$client_id])->get();
        $devi = Devi::where('id', $devi_id)->first();
        return view('devises.deviemail')->with('devi', $devi)->with('client', $client)->with('clientes', $clientes)->with('user', $user);
    }
    public function store_email(Request $request)
    {

        $data = request()->validate([
            'objet_email' => 'required',
            'message_email' => 'required',
            'email_client' => 'required',
            'devi_id' => 'required'
        ]);

        $devise = Devi::find($data['devi_id']);
        $articles = Article::where('devi_id', $data['devi_id'])->get();
        $pdf = PDF::loadView('devises.devispdf', compact('devise', 'articles'));

        $message = new EnvoiMailDevi($data);
        $message->attachData($pdf->output(), "devis.pdf");
        $to_email = $request->email_client;
        Mail::to($to_email)->send($message);
        Session::flash('status_send_mail_devis', ' Email envoyé avec succès.');
        return redirect()->route('devises.index');
    }
}
