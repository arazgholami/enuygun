<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateCurrencyRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:currency-records {provider}';

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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $provider = $this->argument('provider');
    }
}
