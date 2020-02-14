<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyRecord extends Model
{
    protected $fillable = ['currency_id','amount'];

    protected $with = ['currency'];

    public function currency(){
        return $this->belongsTo(Currency::class);
    }

    public function saveRecord($parameters){

        $currency = Currency::where('symbol', $parameters['symbol'])->first();

        return self::create([
            'currency_id' => $currency->id,
            'amount'      => $parameters['amount']
        ]);
    }
}
