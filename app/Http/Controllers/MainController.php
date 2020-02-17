<?php

namespace App\Http\Controllers;

use App\Currency;
use App\CurrencyRecord;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;

class MainController extends Controller
{
    /**
     * Display a listing of the currencies.
     *
     * @return Factory|View
     */
    public function index()
    {
        Artisan::call('update:currency-records');

        $records = [];
        foreach (Currency::all() as $currency){

            if ($currency->lastRecord()){
                $lastAmount = $currency->lastRecord()['amount'];
                $update = $currency->lastRecord()['created_at']->format('M d, H:i:s');
            }
            else{
                $lastAmount = 'No Record.';
                $update = today()->format('M d, H:i:s');
            }

            $parameters = [
                'currency_name' => $currency->name,
                'amount' => $lastAmount,
                'date' => $update
            ];

            array_push($records, $parameters);
        }

        return view('welcome', compact('records'));
    }

    /**
     * Refresh endpoint for ajax refreshing button.
     *
     * @return array
     */
    public function refresh()
    {
        Artisan::call('update:currency-records');

        $records = [];
        foreach (Currency::all() as $currency){

            $lastAmount = $currency->lastRecord()['amount'];
            $update = $currency->lastRecord()['created_at']->format('M d, H:i:s');

            $parameters = [
                'name' => $currency->name,
                'amount' => $lastAmount,
                'date' => $update
            ];

            array_push($records, $parameters);
        }

        return $records;
    }
}
