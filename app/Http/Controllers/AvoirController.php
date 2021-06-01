<?php

namespace App\Http\Controllers;

use App\Cle;
use App\Avoir;
use App\Client;
use App\Article;
use App\Debours;
use App\Facture;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\factureRequest;
use App\Mail\EnvoiMaiAvoir;
use Illuminate\Support\Facades\Session;

class AvoirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $avoirs = Avoir::where('user_id', $user->id)->get();
        $cle = Cle::all();
        return \view('avoirs.showavoirs')->with('avoirs', $avoirs)->with('clients', Client::all())->with('user', $user)->with('cles', $cle);
    }
    public function create_avoir($facture_id, $client_id)
    {
        $user = auth()->user();
        $arr = ['(DH)', '($)', '(€)'];
        $arr = [];
        $client = Client::where('id', $client_id)->first();
        $clientes = Client::whereNotIn('id', [$client_id])->get();
        $factures = Facture::where([['user_id', $user->id], ['id', $facture_id]])->first();
        //$facture = Facture::where('id',$facture_id)->first();
        $articles = Article::where('facture_id', $facture_id)->get();
        $debours = Debours::where('facture_id', $facture_id)->get();
        $cles = Cle::where('facture_id', $facture_id)->get();
        $cle = Cle::select('mot_cle')->distinct()->get();

        if ($debours->count()) {
            return \view('avoirs.addavoirs')->with('facture', $factures)->with('clients', $client)->with('arrs', $arr)->with('articles', $articles)->with('debours', $debours)->with('cles', $cles)->with('user', $user)->with('clientes', $clientes)->with('cle', $cle);
        } else {
            return \view('avoirs.addavoirs')->with('facture', $factures)->with('clients', $client)->with('arrs', $arr)->with('articles', $articles)->with('debours', [])->with('cles', $cles)->with('user', $user)->with('clientes', $clientes)->with('cle', $cle);
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
    public function store(factureRequest $request)
    {
        $user = auth()->user();
        // dd($request);
        DB::table('avoirs')->insert([
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
            'facture_id' => $request->facture_id,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        $id = DB::getPdo()->lastInsertId();
        $avoir = Avoir::where('id', $id)->first();
        $avoir->code_avoir = 'A' . $avoir->created_at->format('Y') . $id;
        $avoir->save();
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
                    'avoir_id' => $id,
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
                        'avoir_id' => $id,
                        'mot_cle' => $request->motcle[$t]
                    )
                ));
            };
        } else {
            for ($n = 0; $n < \count($request->motcle); $n++) {
                DB::table('cles')->insert(array(
                    array(
                        'avoir_id' => $id,
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
                        'avoir_id' => $id,
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
                        'avoir_id' => $id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    )
                ));
            };
        }
        $user = auth()->user();
        $avoirs = Avoir::where('user_id', $user->id)->get();
        Session::flash('status_add_avoir', 'Avoir créé avec succès.');
        return redirect()->route('avoirs.index')->with('avoirs', $avoirs)->with('clients', Client::all())->with('user', $user);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(factureRequest $request, Avoir $avoir)
    {

        $avoir->total_ht_articlesf = $request->totalht_final_last;
        $avoir->remise_genf = $request->remise_final_last;
        $avoir->remised = $request->remise;
        $avoir->total_ht_apres_remise_genf = $request->total_ht_final_last;
        $avoir->tvaf = $request->tva_final_last;
        $avoir->total_debours = $request->debours_final_last;
        $avoir->total_facturef = $request->total_total_last;
        $avoir->condition_reglf = $request->condition_reglement;
        $avoir->mode_reglf = $request->mode_reglement;
        $avoir->interet_reglf = $request->interet;
        $avoir->code_bancf = $request->compte_bancaire;
        $avoir->text_introductionf = $request->text_intro;
        $avoir->text_conclusionf = $request->text_concl;
        $avoir->pied_pagef = $request->text_pied;
        $avoir->client_id = $request->clients;
        $avoir->devis = $request->devis;
        $avoir->updated_at = \Carbon\Carbon::now();
        $avoir->save();
        //article update
        $test_article = $request->quantité[0];
        if ($test_article == null) {
            for ($m = 0; $m < 0; $m++) {
                break;
                DB::table('articles')->where('avoir_id', $avoir->id)->delete();
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
                        'avoir_id' => $avoir->id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    )
                ));
            };
        } else {
            DB::table('articles')->where('avoir_id', $avoir->id)->delete();
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
                        'avoir_id' => $avoir->id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    )
                ));
            };
        }
        //debours update
        $test_debours = $request->montant_ht[0];
        if ($test_debours == null) {
            DB::table('debours')->where('avoir_id', $avoir->id)->delete();
            for ($d = 0; $d < 0; $d++) {
                break;

                DB::table('debours')->insert(array(
                    array(
                        'ref_debours' => $request->references[$d],
                        'montant_ht_debours' => $request->montant_ht[$d],
                        'description_debours' => $request->descriptiond[$d],
                        'avoir_id' => $avoir->id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    )
                ));
            };
        } else {
            DB::table('debours')->where('avoir_id', $avoir->id)->delete();
            for ($q = 0; $q < \count($request->montant_ht); $q++) {
                DB::table('debours')->insert(array(
                    array(
                        'ref_debours' => $request->references[$q],
                        'montant_ht_debours' => $request->montant_ht[$q],
                        'description_debours' => $request->descriptiond[$q],
                        'avoir_id' => $avoir->id,
                        'created_at' => \Carbon\Carbon::now(),
                        'updated_at' => \Carbon\Carbon::now()
                    )
                ));
            };
        }
        //cles update
        $test = $request->motcle[0];
        if ($test == null) {
            DB::table('cles')->where('avoir_id', $avoir->id)->delete();
            for ($j = 0; $j < 0; $j++) {
                break;
                DB::table('cles')->insert(array(
                    array(
                        'avoir_id' => $avoir->id,
                        'mot_cle' => $request->motcle[$j]
                    )
                ));
            };
        } else {
            DB::table('cles')->where('avoir_id', $avoir->id)->delete();
            for ($k = 0; $k < \count($request->motcle); $k++) {
                DB::table('cles')->insert(array(
                    array(
                        'avoir_id' => $avoir->id,
                        'mot_cle' => $request->motcle[$k]
                    )
                ));
            };
        }
        $user = auth()->user();
        $avoirs = Avoir::where('user_id', $user->id)->get();
        Session::flash('status_update_avoir', 'Avoir modifié avec succès.');
        return redirect()->to('/avoirs')->with('avoirs', $avoirs)->with('clients', Client::all())->with('user', $user);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Avoir $avoir)
    {
        $avoir->delete();
        Session::flash('status_destroy_avoir', 'Avoir supprimé avec succès.');
        return redirect()->back();
    }

    public function avoir_voirplus($id)
    {
        $user = auth()->user();
        $avoir = Avoir::find($id);
        $articles = Article::where('avoir_id', $id)->get();
        $debours = Debours::where('avoir_id', $id)->get();
        $cles = Cle::all();
        return view('avoirs.avoir_voirplus')->with('avoir', $avoir)->with('articles', $articles)->with('debourses', $debours)->with('user', $user)->with('cles', $cles);
    }

    public function avoirfinalisechange($id)
    {
        // $user = auth()->user();
        DB::table('avoirs')
            ->where('id', $id)
            ->update(['etat_facture' => 'Finalisé', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]);
        Session::flash('status_finalise_avoir', 'Avoir finalisé avec succès.');
        return \redirect()->back();
    }

    public function editavoir($avoir_id, $client_id)
    {

        $user = auth()->user();
        $arr = ['(DH)', '($)', '(€)'];
        $arr = [];
        $client = Client::where('id', $client_id)->first();
        $clientes = Client::whereNotIn('id', [$client_id])->get();
        $avoir = Avoir::where('id', $avoir_id)->first();
        $articles = Article::where('avoir_id', $avoir_id)->get();
        $debours = Debours::where('avoir_id', $avoir_id)->get();
        $cles = Cle::where('avoir_id', $avoir_id)->get();
        $cle = Cle::select('mot_cle')->distinct()->get();

        if ($debours->count()) {
            return \view('avoirs.editavoir')->with('avoir', $avoir)->with('clients', $client)->with('arrs', $arr)->with('articles', $articles)->with('debours', $debours)->with('cles', $cles)->with('user', $user)->with('clientes', $clientes)->with('cle', $cle);
        } else {
            return \view('avoirs.editavoir')->with('avoir', $avoir)->with('clients', $client)->with('arrs', $arr)->with('articles', $articles)->with('debours', [])->with('cles', $cles)->with('user', $user)->with('clientes', $clientes)->with('cle', $cle);
        }
    }
    public function genererpdfa($id)
    {
        $user = auth()->user();
        $avoir = Avoir::find($id);
        // dd($avoir->etat_facture);
        $articles = Article::where('avoir_id', $id)->get();
        $debourses = Debours::where('avoir_id', $id)->get();
        $pdf = App::make('dompdf.wrapper');
        $pdf = PDF::loadView('avoirs.avoirpdf', compact('avoir', 'articles', 'debourses'));
        switch ($avoir->etat_facture) {
            case 'Provisoire':
                return $pdf->download('Avoir_Provisoire.pdf');

            case 'Finalisé':
                return $pdf->download('Avoir_Finalisé.pdf');

            case  'Remboursé':
                return $pdf->download('Avoir_Remboursé.pdf');
        }
    }

    public function duplicateen_devi($avoir_id)
    {
        $user = auth()->user();
        $arr = ['(DH)', '($)', '(€)'];
        $arr = [];
        // $clientes = Client::where('user_id', $user->id)->get();
        $client = Client::where('user_id', $user->id)->get();
        $avoir = Avoir::where('id', $avoir_id)->first();
        $articles = Article::where('avoir_id', $avoir_id)->get();
        $cles = Cle::where('avoir_id', $avoir_id)->get();
        $cle = Cle::select('mot_cle')->distinct()->get();
        return \view('avoirs.duplicateen_devise')->with('avoir', $avoir)->with('clients', $client)->with('arrs', $arr)->with('articles', $articles)->with('cles', $cles)->with('user', $user)->with('cle', $cle);
    }

    public function duplicateen_facture($avoir_id, $client_id)
    {
        $user = auth()->user();
        $arr = ['(DH)', '($)', '(€)'];
        $arr = [];
        $client = Client::where('id', $client_id)->first();
        $clientes = Client::whereNotIn('id', [$client_id])->get();
        $avoirs = Avoir::where('id', $avoir_id)->first();
        //$facture = Facture::where('id',$facture_id)->first();
        $articles = Article::where('avoir_id', $avoir_id)->get();
        $debours = Debours::where('avoir_id', $avoir_id)->get();
        // dd($debours);
        $cles = Cle::where('avoir_id', $avoir_id)->get();
        $cle = Cle::select('mot_cle')->distinct()->get();


        if ($debours->count()) {
            return \view('avoirs.duplicateen_facture')->with('avoir', $avoirs)->with('clients', $client)->with('arrs', $arr)->with('articles', $articles)->with('debours', $debours)->with('cles', $cles)->with('user', $user)->with('clientes', $clientes)->with('cle', $cle);
        } else {
            return \view('avoirs.duplicateen_facture')->with('avoir', $avoirs)->with('clients', $client)->with('arrs', $arr)->with('articles', $articles)->with('debours', [])->with('cles', $cles)->with('user', $user)->with('clientes', $clientes)->with('cle', $cle);
        }
    }

    public function avoirrembourséchange($avoir_id)
    {
        DB::table('avoirs')
            ->where('id', $avoir_id)
            ->update(['etat_facture' => 'Remboursé', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]);
        Session::flash('status_remboursé_devis', ' Avoir  remboursé avec succès.');
        return \redirect()->back();
    }

    public function annuleremboursement($avoir_id)
    {
        DB::table('avoirs')
            ->where('id', $avoir_id)
            ->update(['etat_facture' => 'Finalisé', 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()]);
        Session::flash('status_annuler_remboursement_avoir', ' Remboursement annulé avec succès.');
        return \redirect()->back();
    }
    public function avoirprovi()
    {
        $user = auth()->user();
        $avoirs = Avoir::where([['user_id', $user->id], ['etat_facture', 'Provisoire']])->get();
        $cles = Cle::all();
        return \view('avoirs.showavoirprovi')->with('avoirs', $avoirs)->with('clients', Client::all())->with('user', $user)->with('cles', $cles);
    }
    public function avoirfinalise()
    {
        $user = auth()->user();
        // $factures = Facture::where([['user_id',$user->id],['etat_facture','Finalisé']])->orWhere('etat_facture','Payée')->get();
        $avoirs = Avoir::where([['user_id', $user->id], ['etat_facture', 'Finalisé']])->get();
        $cles = Cle::all();
        return \view('avoirs.showavoirfinalise')->with('avoirs', $avoirs)->with('clients', Client::all())->with('user', $user)->with('cles', $cles);
    }
    public function avoirrembourse()
    {
        $user = auth()->user();
        $avoirs = Avoir::where([['user_id', $user->id], ['etat_facture', 'Remboursé']])->get();
        $cles = Cle::all();
        return \view('avoirs.showavoirrembourse')->with('avoirs', $avoirs)->with('clients', Client::all())->with('user', $user)->with('cles', $cles);
    }
    public function deleteavoir($avoir_id)
    {
        $avoir = Avoir::where('id', $avoir_id)->first();
        $avoir->delete();
        $user = auth()->user();
        $avoirs = Avoir::where('user_id', $user->id)->first();
        Session::flash('status_delete_avoir', 'Avoir supprimé avec succès.');
        return redirect()->to('/avoirs')->with('avoirs', $avoirs)->with('clients', Client::all())->with('user', $user);
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
        $avoirs_cles_clients = Avoir::where('etat_facture', 'like', '%' . $q . '%')
            ->orWhere('code_avoir', 'like', '%' . $q . '%')
            ->orWhereHas('cles', function ($query) use ($q) {
                $query->where('mot_cle', 'like', '%' . $q . '%');
            })->orWhereHas('client', function ($query) use ($q) {
                $query->where('nom_client', 'like', '%' . $q . '%')
                    ->orWhere('prenom_client', 'like', '%' . $q . '%');
            })->get();
        // dd($devis_cles_clients);
        if ($avoirs_cles_clients->count()) {

            return view('avoirs.showavoirsearch')->with('avoirs_cles_clients', $avoirs_cles_clients)->with('cles', $cle)->with('user', $user)->with('clients', Client::all());
        } else {
            return view('avoirs.showavoirsearch')->with('status', 'recherche failed')->with('user', $user)->with('avoirs_cles_clients', [])->with('clients', Client::all());
        }
    }
    public function create_email($avoir_id, $client_id)
    {
        $user = auth()->user();
        $client = Client::where('id', $client_id)->first();
        $clientes = Client::whereNotIn('id', [$client_id])->get();
        $avoir = Avoir::where('id', $avoir_id)->first();
        return view('avoirs.avoiremail')->with('avoir', $avoir)->with('client', $client)->with('clientes', $clientes)->with('user', $user);
    }
    public function store_email(Request $request)
    {

        $data = request()->validate([
            'objet_email' => 'required',
            'message_email' => 'required',
            'email_client' => 'required',
            'avoir_id' => 'required'
        ]);

        $user = auth()->user();
        $avoir = Avoir::find($data['avoir_id']);
        // dd($avoir->etat_facture);
        $articles = Article::where('avoir_id', $data['avoir_id'])->get();
        $debourses = Debours::where('avoir_id', $data['avoir_id'])->get();
        $pdf = App::make('dompdf.wrapper');
        $pdf = PDF::loadView('avoirs.avoirpdf', compact('avoir', 'articles', 'debourses'));


        $message = new EnvoiMaiAvoir($data);
        $message->attachData($pdf->output(), "avoir.pdf");
        $to_email = $request->email_client;
        Mail::to($to_email)->send($message);
        Session::flash('status_send_mail_avoir', ' Email envoyé avec succès.');
        return redirect()->route('avoirs.index');
    }
}
