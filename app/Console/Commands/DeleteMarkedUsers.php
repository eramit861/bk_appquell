<?php

namespace App\Console\Commands;

use App\Helpers\Helper;
use App\Models\User;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Services\AttorneyClientService;
use Illuminate\Support\Facades\DB;

class DeleteMarkedUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DeleteMarkedUsers:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete users who were marked for deletion 60+ days ago.';

    protected AttorneyClientService $attorneyClientService;

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
        $cutoffDate = Carbon::now()->subDays(60);

        $totalDeleted = 0;
        $totalErrors = 0;

        User::whereNotNull('date_marked_delete')
            ->where('user_status', Helper::REMOVED)
            ->where('date_marked_delete', '<=', $cutoffDate->toDateString())
            ->chunk(10, function ($users) use (&$totalDeleted, &$totalErrors) {
                foreach ($users as $user) {
                    DB::beginTransaction();
                    try {
                        $this->info("Deleting user ID: {$user->id}");

                        // Log user data before deletion
                        ActivityLog::create([
                            'data' => json_encode([
                                'id' => $user->id,
                                'name' => $user->name,
                                'phone_no' => $user->phone_no,
                                'email' => $user->email,
                                'date_marked_delete' => $user->date_marked_delete,
                                'date_deleted' => Carbon::now()->toDateTimeString()
                            ]),
                            'created_at' => Carbon::now()
                        ]);

                        $this->attorneyClientService->deleteClient($user->id);
                        DB::commit();
                        $totalDeleted++;
                    } catch (\Exception $e) {
                        DB::rollBack();
                        $this->error("Failed to delete user ID {$user->id}: " . $e->getMessage());
                        $totalErrors++;
                    }
                }
                $this->info("Processed batch of {$users->count()} users. Total deleted so far: {$totalDeleted}, Errors: {$totalErrors}");
            });

        $this->info("Cleanup complete. Successfully deleted {$totalDeleted} users.");
        if ($totalErrors > 0) {
            $this->warn("Failed to delete {$totalErrors} users due to errors.");
        }
    }
}
