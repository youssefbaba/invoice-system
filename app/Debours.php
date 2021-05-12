<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Debours extends Model
{
    public function facture()
    {
        return $this->belongsTo('App\Facture');
    }
    public function avoir()
    {
        return $this->belongsTo('App\Avoir');
    }
}
