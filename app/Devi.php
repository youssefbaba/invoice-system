<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Client;
use App\Article;

class Devi extends Model
{
    // protected $fillable = ['total_ht_articlesdf','remised','total_ht_apres_remise_gend','tvad','total_factured','condition_regld','user_id'];
    protected $guarded = ['*'];
    public function client()
    {
        return $this->belongsTo('App\Client');
    }
    public function articles()
    {
        return $this->hasMany('App\Article');
    }
    public function cles()
    {
        return $this->hasMany('App\Cle');
    }
    public function getClient($client_id)
    {
        if ($client_id == null) {
            return null;
        } else {
            return Client::where('id', $client_id)->first();
        }
    }
    public function getArticle($devi_id)
    {
        if ($devi_id == null) {
            return null;
        } else {
            return Article::where('devi_id', $devi_id)->first();
        }
    }
}
