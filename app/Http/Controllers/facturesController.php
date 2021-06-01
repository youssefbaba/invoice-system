<?php

namespace App\Http\Controllers;

use App\Cle;
use App\Client;
use App\Article;
use App\Debours;
use App\Facture;
use Carbon\Carbon;
use App\Mail\EnvoiMail;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\factureRequest;
use App\Mail\EnvoiMailFacture;
use Illuminate\Support\Facades\Session;

class facturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $factures = Facture::where('user_id', $user->id)->get();
        $cle = Cle::all();
        return \view('factures.showfactures')->with('factures', $factures)->with('clients', Client::all())->with('user', $user)->with('cles', $cle);
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
        return \view('factures.addfacture')->with('clients', $clients)->with('user', $user)->with('cles', $cle);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(factureRequest $request)
    {
        //  dd($request);
        $user = auth()->user();
        DB::table('factures')->insert([
            'etat_facture' => 'Provisoire',
            'remised' => $request->remise,
            'total_ht_articlesf' => $request->totalht_final_last,
            'remise_genf' => $request->remise_final_last,
            'total_ht_apres_remise_genf' => $request->total_ht_final_last,
            'tvaf' => $request->tva_final_last,
            'total_debours' => $request->debours_final_last,
            'total_facturef' => $request->total_total_last,
            'condition_reglf' => $request->condition_reglement,
            'mode_reglf' => $request->mode_reglement,
            'interet_reglf' => $request->interet,
            'code_bancf' => $request->compte_bancaire,
            'text_introductionf' => $request->text_intro,
            'text_conclusionf' => $request->text_concl,
            'pied_pagef' => $request->text_pied,
            'client_id' => $request->clients,
            'devis' => $request->devis,
            'user_id' => $user->id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
        //


        $id = DB::getPdo()->lastInsertId();
        $facture = Facture::where('id', $id)->first();
        $facture->code_facture = 'F' . $facture->created_at->format('Y') . $id;
        $facture->save();

        for ($i = 0; $i < \count($request->quantité); $i++) {
            DB::table('articles')->insert(array(
                array(
                    'type_article' => $request->type[$i],
                    'quantité_article' => $request->quantité[$i],
                    'prix_ht_article' => $request->prixht[$i],
                    'tva' => $request->tva[$i],
                    'reduction_article' => $request->reduction[$i],
                    'total_ht_article' => $request->totalht[$i],
                    'total_ttc_article' => $request->totalttc[$i],
                    'description_article' => $request->description[$i],
                    'facture_id' => $id,
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                )
            ));
        };
        $test = $request->montant_ht[0];
        //insert mor cles
        $test2 = $request->motcle[0];
        if ($test2 == null) {
            for ($t = 0; $t < 0; $t++) {
                break;
                DB::table('cles')->insert(array(
                    array(
                        'facture_id' => $id,
                        'mot_cle' => $request->motcle[$t]
                    )
                ));
            };
        } else {
            for ($n = 0; $n < \count($request->motcle); $n++) {
                DB::table('cles')->insert(array(
                    array(
                        'facture_id' => $id,
                        'mot_cle' => $request->motcle[$n]
                    )
                ));
            };
        }
        //insert debours
        if ($test == null) {
            for ($j = 0; $j < 0; $j++) {
                break;
                DB::table('debours')->insert(array(
                    array(
                        'ref_debours' => $request->references[$j],
                        'montant_ht_debours' => $request->montant_ht[$j],
                        'description_debours' => $request->descriptiond[$j],
                        'facture_id' => $id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    )
                ));
            };
        } else {
            for ($k = 0; $k < \count($request->montant_ht); $k++) {
                DB::table('debours')->insert(array(
                    array(
                        'ref_debours' => $request->references[$k],
                        'montant_ht_debours' => $request->montant_ht[$k],
                        'description_debours' => $request->descriptiond[$k],
                        'facture_id' => $id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    )
                ));
            };
        }
        $user = auth()->user();
        $factures = Facture::where('user_id', $user->id)->get();
        // $cle = Cle::where("devi_id",);
        // return redirect()->route('factures.index')->with('factures', $factures)->with('clients', Client::all())->with('user', $user)->with('cle', $cle);

        if ($request->check === 'duplicate') {
            Session::flash('status_duplicate_devi_en_facture', 'Devi dupliqué  en facture avec succès.');
            return redirect()->route('factures.index')->with('factures', $factures)->with('clients', Client::all())->with('user', $user);
        }
        if ($request->check === 'dupliquer_factutre') {
            Session::flash('status_dupliquer_facture', 'Facture dupliqué  avec succès.');
            return redirect()->route('factures.index')->with('factures', $factures)->with('clients', Client::all())->with('user', $user);
        }
        if ($request->dupliquer_avoir === 'dupliquer') {
            Session::flash('status_dupliquer_avoir_en_facture', 'Avoir dupliqué  en facture avec succès.');
            return redirect()->route('factures.index')->with('factures', $factures)->with('clients', Client::all())->with('user', $user);
        } else {
            Session::flash('status_add_facture', 'Facture créé avec succès.');
            return redirect()->route('factures.index')->with('factures', $factures)->with('clients', Client::all())->with('user', $user);
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
    public function edit(Facture $facture)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(factureRequest $request, Facture $facture)
    {
        // dd($request);
        $facture->total_ht_articlesf = $request->totalht_final_last;
        $facture->remise_genf = $request->remise_final_last;
        $facture->remised = $request->remise;
        $facture->total_ht_apres_remise_genf = $request->total_ht_final_last;
        $facture->tvaf = $request->tva_final_last;
        $facture->total_debours = $request->debours_final_last;
        $facture->total_facturef = $request->total_total_last;
        $facture->condition_reglf = $request->condition_reglement;
        $facture->mode_reglf = $request->mode_reglement;
        $facture->interet_reglf = $request->interet;
        $facture->code_bancf = $request->compte_bancaire;
        $facture->text_introductionf = $request->text_intro;
        $facture->text_conclusionf = $request->text_concl;
        $facture->pied_pagef = $request->text_pied;
        $facture->client_id = $request->clients;
        $facture->devis = $request->devis;
        $facture->updated_at = \Carbon\Carbon::now();
        $facture->save();
        //article update
        $test_article = $request->quantité[0];
        if ($test_article == null) {
            for ($m = 0; $m < 0; $m++) {
                break;
                DB::table('articles')->where('facture_id', $facture->id)->delete();
                DB::table('articles')->insert(array(
                    array(
                        'type_article' => $request->type[$m],
                        'quantité_article' => $request->quantité[$m],
                        'prix_ht_article' => $request->prixht[$m],
                        'tva' => $request->tva[$m],
                        'reduction_article' => $request->reduction[$m],
                        'total_ht_article' => $request->totalht[$m],
                        'total_ttc_article' => $request->totalttc[$m],
                        'description_article' => $request->description[$m],
                        'facture_id' => $facture->id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    )
                ));
            };
        } else {
            DB::table('articles')->where('facture_id', $facture->id)->delete();
            for ($i = 0; $i < \count($request->quantité); $i++) {
                DB::table('articles')->insert(array(
                    array(
                        'type_article' => $request->type[$i],
                        'quantité_article' => $request->quantité[$i],
                        'prix_ht_article' => $request->prixht[$i],
                        'tva' => $request->tva[$i],
                        'reduction_article' => $request->reduction[$i],
                        'total_ht_article' => $request->totalht[$i],
                        'total_ttc_article' => $request->totalttc[$i],
                        'description_article' => $request->description[$i],
                        'facture_id' => $facture->id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    )
                ));
            };
        }
        //debours update
        $test_debours = $request->montant_ht[0];
        if ($test_debours == null) {
            DB::table('debours')->where('facture_id', $facture->id)->delete();
            for ($d = 0; $d < 0; $d++) {
                break;

                DB::table('debours')->insert(array(
                    array(
                        'ref_debours' => $request->references[$d],
                        'montant_ht_debours' => $request->montant_ht[$d],
                        'description_debours' => $request->descriptiond[$d],
                        'facture_id' => $facture->id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    )
                ));
            };
        } else {
            DB::table('debours')->where('facture_id', $facture->id)->delete();
            for ($q = 0; $q < \count($request->montant_ht); $q++) {
                DB::table('debours')->insert(array(
                    array(
                        'ref_debours' => $request->references[$q],
                        'montant_ht_debours' => $request->montant_ht[$q],
                        'description_debours' => $request->descriptiond[$q],
                        'facture_id' => $facture->id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    )
                ));
            };
        }
        //cles update
        $test = $request->motcle[0];
        if ($test == null) {
            DB::table('cles')->where('facture_id', $facture->id)->delete();
            for ($j = 0; $j < 0; $j++) {
                break;
                DB::table('cles')->insert(array(
                    array(
                        'facture_id' => $facture->id,
                        'mot_cle' => $request->motcle[$j]
                    )
                ));
            };
        } else {
            DB::table('cles')->where('facture_id', $facture->id)->delete();
            for ($k = 0; $k < \count($request->motcle); $k++) {
                DB::table('cles')->insert(array(
                    array(
                        'facture_id' => $facture->id,
                        'mot_cle' => $request->motcle[$k]
                    )
                ));
            };
        }
        $user = auth()->user();
        $factures = Facture::where('user_id', $user->id)->get();

        Session::flash('status_update_facture', 'Facture modifié avec succès.');

        return redirect()->to('/factures')->with('factures', $factures)->with('clients', Client::all())->with('user', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facture $facture)
    {
        $facture->delete();

        Session::flash('status_destroy_facture', 'Facture supprimé avec succès.');
        return redirect()->back();
    }
    public function deletefacture($facture_id)
    {
        $facture = Facture::where('id', $facture_id)->first();
        $facture->delete();
        $user = auth()->user();
        $factures = Facture::where('user_id', $user->id)->first();
        Session::flash('status_delete_facture', 'Facture supprimé avec succès.');
        return redirect()->to('/factures')->with('factures', $factures)->with('clients', Client::all())->with('user', $user);
    }
    public function create_facture_client($id)
    {
        $user = auth()->user();
        $client_determiner = Client::where('id', $id)->first();
        $cle = Cle::select('mot_cle')->distinct()->get();
        return \view('factures.addfacture')->with('client_determiner', $client_determiner)->with('user', $user)->with('cles', $cle);
    }

    public function editfacture($facture_id, $client_id)
    {

        $user = auth()->user();
        $arr = ['(DH)', '($)', '(€)'];
        $arr = [];
        $client = Client::where('id', $client_id)->first();
        $clientes = Client::whereNotIn('id', [$client_id])->get();
        $factures = Facture::where('id', $facture_id)->first();
        //$facture = Facture::where('id',$facture_id)->first();
        $articles = Article::where('facture_id', $facture_id)->get();
        $debours = Debours::where('facture_id', $facture_id)->get();
        // dd($debours);
        $cles = Cle::where('facture_id', $facture_id)->get();
        $cle = Cle::select('mot_cle')->distinct()->get();

        if ($debours->count()) {
            return \view('factures.editfacture')->with('facture', $factures)->with('clients', $client)->with('arrs', $arr)->with('articles', $articles)->with('debours', $debours)->with('cles', $cles)->with('user', $user)->with('clientes', $clientes)->with('cle', $cle);
        } else {
            return \view('factures.editfacture')->with('facture', $factures)->with('clients', $client)->with('arrs', $arr)->with('articles', $articles)->with('debours', [])->with('cles', $cles)->with('user', $user)->with('clientes', $clientes)->with('cle', $cle);
        }
    }
    public function editfacture_vide($facture_id)
    {
        $user = auth()->user();
        $arr = ['(DH)', '($)', '(€)'];
        $arr = [];
        $facture = Facture::where('id', $facture_id)->first();
        $articles = Article::where('facture_id', $facture_id)->get();
        $debours = Debours::where('facture_id', $facture_id)->get();
        $cles = Cle::where('facture_id', $facture_id)->get();
        $clients = Client::all();
        return \view('factures.editfacturevide')->with('facture', $facture)->with('arrs', $arr)->with('articles', $articles)->with('debours', $debours)->with('cles', $cles)->with('clients', $clients)->with('user', $user);
    }
    public function duplicatefacture($facture_id, $client_id)
    {
        $user = auth()->user();
        $arr = ['(DH)', '($)', '(€)'];
        $arr = [];
        $client = Client::where('id', $client_id)->first();
        $clientes = Client::whereNotIn('id', [$client_id])->get();
        $factures = Facture::where('id', $facture_id)->first();
        //$facture = Facture::where('id',$facture_id)->first();
        $articles = Article::where('facture_id', $facture_id)->get();
        $debours = Debours::where('facture_id', $facture_id)->get();
        // dd($debours);
        $cles = Cle::where('facture_id', $facture_id)->get();
        $cle = Cle::select('mot_cle')->distinct()->get();


        if ($debours->count()) {
            return \view('factures.duplicatefacture')->with('facture', $factures)->with('clients', $client)->with('arrs', $arr)->with('articles', $articles)->with('debours', $debours)->with('cles', $cles)->with('user', $user)->with('clientes', $clientes)->with('cle', $cle);
        } else {
            return \view('factures.duplicatefacture')->with('facture', $factures)->with('clients', $client)->with('arrs', $arr)->with('articles', $articles)->with('debours', [])->with('cles', $cles)->with('user', $user)->with('clientes', $clientes)->with('cle', $cle);
        }
    }
    public function duplicatefacture_vide($facture_id)
    {
        $arr = ['(DH)', '($)', '(€)'];
        $arr = [];
        $user = auth()->user();
        $factures = Facture::where([['user_id', $user->id], ['id', $facture_id]])->first();
        //$facture = Facture::where('id',$facture_id)->first();
        $articles = Article::where('facture_id', $facture_id)->get();
        $debours = Debours::where('facture_id', $facture_id)->get();
        $cles = Cle::where('facture_id', $facture_id)->get();
        $clients = Client::all();
        return \view('factures.duplicatefacture_vide')->with('facture', $factures)->with('arrs', $arr)->with('articles', $articles)->with('debours', $debours)->with('cles', $cles)->with('clients', $clients)->with('user', $user);
    }
    public function factureprovi()
    {
        $user = auth()->user();
        $factures = Facture::where([['user_id', $user->id], ['etat_facture', 'Provisoire']])->get();
        $cles = Cle::all();
        return \view('factures.showfactureprovi')->with('factures', $factures)->with('clients', Client::all())->with('user', $user)->with('cles', $cles);
    }
    public function facturefinalisechange($id)
    {
        DB::table('factures')
            ->where('id', $id)
            ->update(['etat_facture' => 'Finalisé', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]);
        Session::flash('status_finalise_facture', 'Facture finalisé avec succès.');
        return redirect()->back();
    }
    public function facturefinalise()
    {
        $user = auth()->user();
        // $factures = Facture::where([['user_id',$user->id],['etat_facture','Finalisé']])->orWhere('etat_facture','Payée')->get();
        $factures = Facture::where([['user_id', $user->id], ['etat_facture', 'Finalisé']])->get();
        $cles = Cle::all();
        return \view('factures.showfacturefinalise')->with('factures', $factures)->with('clients', Client::all())->with('user', $user)->with('cles', $cles);
    }
    public function facturepayéchange($id)
    {

        DB::table('factures')
            ->where('id', $id)
            ->update(['etat_facture' => 'Payée', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]);
        Session::flash('status_paye_facture', 'Facture payé avec succès.');
        return \redirect()->back();
    }
    public function facturepaye()
    {
        $user = auth()->user();
        $factures = Facture::where([['user_id', $user->id], ['etat_facture', 'Payée']])->get();
        $cles = Cle::all();
        return \view('factures.showfacturepaye')->with('factures', $factures)->with('clients', Client::all())->with('user', $user)->with('cles', $cles);
    }
    public function annulepaiement($id)
    {
        DB::table('factures')
            ->where('id', $id)
            ->update(['etat_facture' => 'Finalisé', 'created_at' => \Carbon\Carbon::now()->format('Y-m-d'), 'updated_at' => \Carbon\Carbon::now()]);
        Session::flash('status_annuler_paiement', 'Paiement de facture annulé avec succès.');
        return \redirect()->back();
    }
    public function facture_voirplus($id)
    {
        $user = auth()->user();
        $facture = Facture::find($id);
        $articles = Article::where('facture_id', $id)->get();
        $debours = Debours::where('facture_id', $id)->get();
        $cles = Cle::all();
        return view('factures.facture_voirplus')->with('facture', $facture)->with('articles', $articles)->with('debourses', $debours)->with('user', $user)->with('cles', $cles);
    }
    public function genererpdff($facture_id)
    {
        $user = auth()->user();
        $facture = Facture::find($facture_id);
        $articles = Article::where('facture_id', $facture_id)->get();
        $debourses = Debours::where('facture_id', $facture_id)->get();
        $pdf = PDF::loadView('factures.facturepdf', compact('facture', 'articles', 'debourses'));
        return $pdf->download('Facture_' . $facture->etat_facture . '.pdf');
        // return view('factures.facturepdf', compact('facture', 'articles', 'debourses'));
    }
    public function duplicateen_devise($facture_id)
    {
        $user = auth()->user();
        $arr = ['(DH)', '($)', '(€)'];
        $arr = [];
        // $clientes = Client::where('user_id', $user->id)->get();
        $client = Client::where('user_id', $user->id)->get();
        $facture = Facture::where('id', $facture_id)->first();
        // dd($facture);
        $articles = Article::where('facture_id', $facture_id)->get();
        $cles = Cle::where('facture_id', $facture_id)->get();
        $cle = Cle::select('mot_cle')->distinct()->get();
        return \view('factures.duplicateen_devise')->with('facture', $facture)->with('clients', $client)->with('arrs', $arr)->with('articles', $articles)->with('cles', $cles)->with('user', $user)->with('cle', $cle);
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
        $factures_cles_clients = Facture::where('etat_facture', 'like', '%' . $q . '%')
            ->orWhere('code_facture', 'like', '%' . $q . '%')
            ->orWhereHas('cles', function ($query) use ($q) {
                $query->where('mot_cle', 'like', '%' . $q . '%');
            })->orWhereHas('client', function ($query) use ($q) {
                $query->where('nom_client', 'like', '%' . $q . '%')
                    ->orWhere('prenom_client', 'like', '%' . $q . '%');
            })->get();
        // dd($devis_cles_clients);
        if ($factures_cles_clients->count()) {

            return view('factures.showfacturesearch')->with('factures_cles_clients', $factures_cles_clients)->with('cles', $cle)->with('user', $user)->with('clients', Client::all());
        } else {
            return view('factures.showfacturesearch')->with('status', 'recherche failed')->with('user', $user)->with('factures_cles_clients', [])->with('clients', Client::all());
        }
    }
    public function create_email($facture_id, $client_id)
    {
        $user = auth()->user();
        $client = Client::where('id', $client_id)->first();
        $clientes = Client::whereNotIn('id', [$client_id])->get();
        $facture = Facture::where('id', $facture_id)->first();
        return view('factures.factureemail')->with('facture', $facture)->with('client', $client)->with('clientes', $clientes)->with('user', $user);
    }
    public function store_email(Request $request)
    {

        $data = request()->validate([
            'objet_email' => 'required',
            'message_email' => 'required',
            'email_client' => 'required',
            'facture_id' => 'required'
        ]);

        $user = auth()->user();
        $facture = Facture::find($data['facture_id']);
        $articles = Article::where('facture_id', $data['facture_id'])->get();
        $debourses = Debours::where('facture_id', $data['facture_id'])->get();
        $pdf = PDF::loadView('factures.facturepdf', compact('facture', 'articles', 'debourses'));

        $message = new EnvoiMailFacture($data);
        $message->attachData($pdf->output(), "facture.pdf");
        $to_email = $request->email_client;
        Mail::to($to_email)->send($message);
        Session::flash('status_send_mail_facture', ' Email envoyé avec succès.');
        return redirect()->route('factures.index');
    }
}
