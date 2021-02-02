<?php

namespace App\Console\Commands;

use App\Services\Communication\ImportService;
use App\Services\Data\DataBaseService;
use Illuminate\Console\Command;

class RealtyImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'realty:import';

    protected $importService;
    protected $dataBaseService;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import new data of realty';

    public function __construct(ImportService $importService, DataBaseService $dataBaseService)
    {
        parent::__construct();
        $this->importService = $importService;
        $this->dataBaseService = $dataBaseService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->importService->import();
        $this->dataBaseService->cleanOldData();
        $this->info('Done.');
    }
}
