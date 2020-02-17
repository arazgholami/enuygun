<?php

namespace App\Console\Commands;

use App\CurrencyRecord;
use App\Support\Currency\CurrencyGateway;
use HaydenPierce\ClassFinder\ClassFinder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UpdateCurrencyRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:currency-records {--provider=}';

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

    /**
     * Fetch all available adapters.
     *
     * @param $namespace
     * @return array
     * @throws \Exception
     */
    private function getAllAdaptersNames($namespace) {

        $classes = ClassFinder::getClassesInNamespace($namespace);

        $adapters = [];
        foreach ($classes as $class) {

            $declare = explode("\\", $class);
            $adapters[] = end($declare);
        }

        return $adapters;
    }

    /**
     * Fetching currencies amounts from given provider.
     *
     * @param $provider
     * @return mixed
     */
    private function fetchData($provider){

        $gateway = new CurrencyGateway($provider);
        $adapter = $gateway->getClass();
        $response = $adapter->fetch();

        if ($response['status'] == 200){
            $this->info($response['message']);
            return $response['data'];
        }
        else{
            $this->error($response['message']);
            die();
        }

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        $provider = $this->option('provider');

        if ($provider){
            $response = $this->fetchData($provider);

            foreach ($response as $symbol => $amount){

                $parameters = [
                    'symbol' => $symbol,
                    'amount' => $amount
                ];

                $record = new CurrencyRecord();
                $record->saveRecord($parameters);
            }
        }
        else{
            $providers =  $this->getAllAdaptersNames('App\Support\Currency\Adapters');

            foreach ($providers as $provider){
                $response = $this->fetchData($provider);

                foreach ($response as $symbol => $amount){
                    $currencies[$symbol][] = $amount;
                }
            }

            foreach ($currencies as $symbol => $amounts){

                $parameters = [
                    'symbol' => $symbol,
                    'amount' => min($amounts)
                ];

                $record = new CurrencyRecord();
                $record->saveRecord($parameters);
                $this->info($symbol . ' records saved successfully');
            }
        }

        return;
    }
}
