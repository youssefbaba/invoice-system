<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = ['type_article', 'quantité_article', 'prix_ht_article', 'tva', 'reduction_article', 'total_ht_article', 'total_ttc_article', 'description_article'];

    public function facture()
    {
        return $this->belongsTo('App\Facture');
    }
    public function devi()
    {
        return $this->belongsTo('App\Devi');
    }
    public function client()
    {
        return $this->belongsTo('App\Devi');
    }
    public function avoir()
    {
        return $this->belongsTo('App\Avoir');
    }
}
