<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avoir extends Model
{
    protected $fillable = ['total_ht_articlesf','total_ht_apres_remise_genf','tvaf','total_facturef','condition_reglf','user_id','remised'];

    //  protected $hidden = ['tvaf'];

    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    public function cles()
    {
        return $this->hasMany('App\Cle');
    }
    public function articles()
    {
        return $this->hasMany('App\Article');
    }
    public function debourses()
    {
        return $this->hasMany('App\Debours');
    }
    public function getClient($client_id)
    {
        if ($client_id == null) {
            return null;
        } else {
            return Client::where('id', $client_id)->first();
        }
    }
    public function getArticle($avoir_id)
    {
        if ($avoir_id == null) {
            return null;
        } else {
            return Article::where('avoir_id', $avoir_id)->first();
        }
    }
    public function getDebours($avoir_id)
    {
        if ($avoir_id == null) {
            return null;
        } else {
            return Debours::where('avoir_id', $avoir_id)->first();
        }
    }
}
