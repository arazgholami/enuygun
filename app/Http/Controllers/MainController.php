<?php

namespace App\Http\Controllers;

use App\CurrencyRecord;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $record = CurrencyRecord::all()->last();
        $record->date = $record->created_at->format('M d, H:i:s');
        return view('welcome', compact('record'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh()
    {
        Artisan::call('update:currency-records');
        $record = CurrencyRecord::all()->last();
        $record->date = $record->created_at->format('M d, H:i:s');
        return $record;
    }
}
