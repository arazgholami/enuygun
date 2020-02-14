<?php

namespace App\Support\Currency\Adapters;

use App\Support\Currency\CurrencyBase;
use App\Support\Currency\CurrencyInterface;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class Provider1 extends CurrencyBase implements CurrencyInterface
{
    public function fetch()
    {
        try {

            $client = new Client();
            $request = $client->get('http://www.mocky.io/v2/5a74519d2d0000430bfe0fa0')->getBody()->getContents();
            $response = json_decode($request);
            $response = $response->result;

            $data = [];
            foreach($response as $currency){
                $symbol = substr($currency->symbol, 0, 3);
                $data[Str::slug($symbol)] = $currency->amount;
            }

            return $this->currencyResponse(200, 'Currency records fetched successfully.', $data);

        } catch (\Exception $error) {
            return $this->currencyResponse(503, 'Error: ' . $error->getMessage(), $error);
        }
    }
}
