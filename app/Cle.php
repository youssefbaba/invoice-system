<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cle extends Model
{
    protected $fillable = ['mot_cle'];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    public function facture()
    {
        return $this->belongsTo('App\Facture');
    }
    public function avoir()
    {
        return $this->belongsTo('App\Avoir');
    }
    public function devi()
    {
        return $this->belongsTo('App\Devi');
    }
    public function getCleClient($id)
    {
        return Cle::where('client_id', $id)->get('mot_cle');
    }
    public function getCleFacture($id)
    {
        return Cle::where('facture_id', $id)->get('mot_cle');
    }
    public function getCleAvoir($id)
    {
        return Cle::where('avoir_id', $id)->get('mot_cle');
    }
    public function getCleDevi($id)
    {
        return Cle::where('devi_id', $id)->get('mot_cle');
    }
}
