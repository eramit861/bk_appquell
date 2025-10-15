<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Docnotuploaded;

class DocnotuploadedCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Docnotuploaded:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $oebj = new Docnotuploaded();
        $oebj->documentNotifyProcess();
    }
}
