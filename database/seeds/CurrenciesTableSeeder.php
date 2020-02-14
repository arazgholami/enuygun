<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            [
                'name' => 'USD',
                'symbol' => 'usd',
            ],
            [
                'name' => 'Euro',
                'symbol' => 'eur',
            ],
            [
                'name' => 'UK Pound',
                'symbol' => 'gbp',
            ]
        ];

        foreach ($currencies as $currency)
        {
            DB::table('currencies')->insert([
                'name' => $currency['name'],
                'slug' => Str::slug($currency['name']),
                'symbol' => $currency['symbol'],
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }
    }
}
