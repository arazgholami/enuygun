<?php

namespace App\Support\Currency\Adapters;

use App\Support\Currency\CurrencyBase;
use App\Support\Currency\CurrencyInterface;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class Provider2 extends CurrencyBase implements CurrencyInterface
{
    protected $map = [
        'DOLAR'            => 'usd',
        'AVRO'             => 'eur',
        'İNGİLİZ STERLİNİ' => 'gbp'
    ];

    /**
     * @return array|mixed
     */
    public function fetch()
    {
        try {

            $client = new Client();
            $request = $client->get('http://www.mocky.io/v2/5a74524e2d0000430bfe0fa3')->getBody()->getContents();
            $response = json_decode($request);

            $data = [];
            foreach($response as $currency){
                $symbol = $this->map[$currency->kod];
                $data[$symbol] = (float)$currency->oran;
            }

            return $this->currencyResponse(200, 'Adapter 2 currency records fetched successfully.', $data);

        } catch (\Exception $error) {
            return $this->currencyResponse(503, 'Error: ' . $error->getMessage(), $error);
        }
    }
}
