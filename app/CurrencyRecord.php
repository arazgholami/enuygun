<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyRecord extends Model
{
    protected $fillable = ['currency_id','amount'];

    public function saveRecord($parameters){

        $currency = Currency::where('symbol', $parameters['symbol'])->first();

        return self::create([
            'currency_id' => $currency->id,
            'amount'      => $parameters['amount']
        ]);
    }
}
