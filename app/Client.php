<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Facture;
use App\Devi;
use App\Cle;

class Client extends Model
{
    protected $fillable = ['nom_client', 'prenom_client', 'fonction_client', 'adresse_client', 'langue_client', 'codep_client', 'ville_client', 'site_client', 'tel_client', 'societe_client', 'note_client', 'user_id', 'adresse_email_client'];


    public function factures()
    {
        return $this->hasMany('App\Facture');
    }
    public function avoirs()
    {
        return $this->hasMany('App\Avoir');
    }
    public function cles()
    {
        return $this->hasMany('App\Cle');
    }
    public function devies()
    {
        return $this->hasMany('App\Devi');
    }
    public function getClient_Facture_Name($client_id)
    {
        if ($client_id == null) {
            return null;
        } else {
            return Client::where('id', $client_id)->first()->nom_client;
        }
    }
    public function getClient_Devi_Name($client_id)
    {
        if ($client_id == null) {
            return null;
        } else {
            return Client::where('id', $client_id)->first()->nom_client;
        }
    }
    public function getClient_Facture_Prenom($client_id)
    {
        if ($client_id == null) {
            return null;
        } else {
            return Client::where('id', $client_id)->first()->prenom_client;
        }
    }
    public function getClient_Devi_Prenom($client_id)
    {
        if ($client_id == null) {
            return null;
        } else {
            return Client::where('id', $client_id)->first()->prenom_client;
        }
    }
    public function get_facture_client($id)
    {
        return Facture::where('client_id', $id)->get();
    }
    public function get_devise_client($id)
    {
        return Devi::where('client_id', $id)->get();
    }
    public function get_cles_client($client_id)
    {
        return Cle::where('client_id', $client_id)->get('mot_cle');
    }
    public function get_factures_client($id)
    {
        return Facture::where('client_id', $id)->get();
    }
    public function get_devises_client($id)
    {
        // dd(Devi::where('id_client', $id)->get());
        return Devi::where('client_id', $id)->get();
    }
    public function getClient_Facture_id($client_id)
    {
        if ($client_id == null) {
            return null;
        } else {
            return Client::where('id', $client_id)->first()->id;
        }
    }
    public function getClient_devise_id($client_id)
    {
        if ($client_id == null) {
            return null;
        } else {
            return Client::where('id', $client_id)->first()->id;
        }
    }
}
