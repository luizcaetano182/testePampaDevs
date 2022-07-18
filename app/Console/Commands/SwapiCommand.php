<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SwapiCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swapi:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command SwapiCommand';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $service = new \App\Services\SwapiService;
        try
        {
            $response = $service->fetchAll(); 
            $this->info('Dados criados com sucesso');
        }
        catch
        (\Exception $e){
            Log::error($e->getMessage());
            $this->error($e->getMessage());
        }
        return 0;
    }
}
