<?php

namespace App\Console\Commands;

use App\CurrencyRecord;
use App\Support\Currency\CurrencyGateway;
use Illuminate\Console\Command;

class UpdateCurrencyRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:currency-records {provider=Provider1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command updates currency records with the given provider';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    private function getMinimumValue($array){

        $min_key = array_search(min($array), $array);
        $min_value = $array[$min_key];

        return $parameters = [
            'symbol' => $min_key,
            'amount' => $min_value
        ];
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $provider = $this->argument('provider');
        $gateway = new CurrencyGateway($provider);
        $adapter = $gateway->getClass();
        $response = $adapter->fetch();

        if ($response['status'] == 200)
            $this->info($response['message']);
        else
            $this->error($response['message']);

        $parameters = $this->getMinimumValue($response['data']);

        $record = new CurrencyRecord();
        $record->saveRecord($parameters);

        $this->info('Currency record saved successfully');
    }
}
