<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $guard = [];

    public function getRouteKeyName()
    {
        return 'symbol';
    }

    public function lastRecord(){
        return CurrencyRecord::where('currency_id', $this->id)->get()->last();
    }

    public function lastUpdate(){
        return CurrencyRecord::where('currency_id', $this->id)->get()->last();
    }
}
