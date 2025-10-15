<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\GeneratePropertyScreenshot;

class ProcessScreenshots extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'screenshot:process {url} {client_id} {address} {property_id?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process screenshot generation in background';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = $this->argument('url');
        $clientId = $this->argument('client_id');
        $address = $this->argument('address');
        $propertyId = $this->argument('property_id');

        $this->info("Dispatching screenshot generation job...");
        $this->info("URL: {$url}");
        $this->info("Client ID: {$clientId}");
        $this->info("Address: {$address}");
        $this->info("Property ID: " . ($propertyId ?? 'Not provided'));
        $this->newLine();

        // Dispatch the job
        GeneratePropertyScreenshot::dispatchSync($url, $clientId, $address, $propertyId);

        $this->info("✅ Job dispatched successfully!");
        $this->info("Estimated completion: 30-60 seconds");
        $this->newLine();

        $this->info("Screenshot will be generated in the background.");
        $this->info("Check the storage directory for generated files:");
        $this->info("storage/app/property_screenshots/{$clientId}/");

        return 0;
    }
}
