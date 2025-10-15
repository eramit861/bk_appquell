<?php

namespace App\Console\Commands;

use App\Helpers\ArrayHelper;
use App\Helpers\ClientHelper;
use Illuminate\Console\Command;
use App\Models\NotificationTemplate;
use App\Models\User;
use App\Helpers\Helper;
use App\Mail\AutomatedNotificationTemplateNotLoggedInUser;
use App\Mail\AutomatedNotificationTemplateLoggedInUser;
use App\Models\FormsStepsCompleted;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AutomatedNotificationTemplateCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AutomatedNotificationTemplateCron:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automated notification template processing';

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
    public function handle(): void
    {
        // Add your automated notification template logic here
        $this->info('Automated notification template processing started...');

        // Get all notification templates where time_frame is greater than 0
        $notificationTemplates = NotificationTemplate::where('time_frame', '>', 0)->get();

        $this->info('Found ' . $notificationTemplates->count() . ' notification templates');

        // Only process if there are notification templates
        if ($notificationTemplates->isNotEmpty()) {
            // Process each notification template
            foreach ($notificationTemplates as $template) {
                $this->info('Processing template ID: ' . $template->id . ' - Subject: ' . $template->noti_tenp_subject);

                // Check if it's time to send emails for this template
                if ($this->shouldSendEmail($template)) {
                    $this->info('Time to send emails for template ID: ' . $template->id);
                    $this->processTemplate($template);
                } else {
                    $this->info('Not time to send emails yet for template ID: ' . $template->id);
                }
            }
        } else {
            $this->info('No notification templates found with time_frame > 0. Exiting...');
        }

        $this->info('Automated notification template processing completed successfully.');
    }

    /**
    * Check if it's time to send email based on template time_frame
    */
    private function shouldSendEmail($template): bool
    {
        $today = Carbon::now();
        $templateCreatedAt = Carbon::parse($template->created_at);

        // Always return true if today and templateCreatedAt are the same date
        if ($today->isSameDay($templateCreatedAt)) {
            $this->info('Same day as template creation - sending email');

            return true;
        }

        $weeksDiff = $templateCreatedAt->diffInWeeks($today);
        switch ($template->time_frame) {
            case 1: // Weekly
                // Send if today is the same day of week as template creation
                return $today->dayOfWeek === $templateCreatedAt->dayOfWeek;

            case 2: // Biweekly (every 2 weeks)
                // Send if it's been 2 weeks since template creation
                $weeksDiff = $templateCreatedAt->diffInWeeks($today);

                return $weeksDiff > 0 && $weeksDiff % 2 === 0;

            case 3: // Every Three Weeks
                // Send if it's been 3 weeks since template creation
                $weeksDiff = $templateCreatedAt->diffInWeeks($today);

                return $weeksDiff > 0 && $weeksDiff % 3 === 0;

            case 4: // Monthly
                // Send if today is the same day of month as template creation
                return $today->day === $templateCreatedAt->day;

            default:
                return false;
        }
    }


    /**
     * Process individual notification template
     */
    private function processTemplate($template)
    {
        // Add your specific template processing logic here
        $this->info('Processing template with time_frame: ' . ArrayHelper::getTimeFrameLabelFromArray($template->time_frame) . ' for attorney ID: ' . $template->attorney_id);

        $attorney_id = $template->attorney_id;

        $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', $attorney_id)->first();
        $attorney_company = (!empty($attorney_company)) ? $attorney_company : [];
        $company_name = !empty($attorney_company) ? $attorney_company->company_name : '';
        $filtered_name = Helper::validate_doc_type($company_name, true);
        $filtered_name = str_replace('_', '', $filtered_name);
        $filtered_mail = strtolower($filtered_name).'@bkquestionnaire.com';

        // Process clients in batches of 10 to avoid performance impact
        User::select('users.*')
        ->join('tbl_clients_attorney', 'users.id', '=', 'tbl_clients_attorney.client_id')
        ->leftJoin('tbl_client_settings', 'tbl_client_settings.client_id', '=', 'users.id')
        ->where('users.role', User::CLIENT)
        ->where('tbl_clients_attorney.attorney_id', $attorney_id)
        ->where('users.user_status', '!=', Helper::INACTIVE)
        ->where('users.user_status', '!=', Helper::REMOVED)
        ->where(function ($query) {
            $query->whereNull('tbl_client_settings.is_case_filed')
                  ->orWhere('tbl_client_settings.is_case_filed', '!=', 1);
        })
        ->where(function ($query) {
            $query->whereNull('tbl_client_settings.auto_mail_unsubscribed')
                  ->orWhere('tbl_client_settings.auto_mail_unsubscribed', '=', 0);
        })
        ->where(function ($query) {
            $query->where('users.logged_in_ever', Helper::YES)
                  ->orWhere('users.logged_in_ever', Helper::NO);
        })
        ->chunk(10, function ($clients) use ($template, $filtered_mail) {
            foreach ($clients as $client) {
                $this->info('Processing client ID: ' . $client->id . ' - Name: ' . $client->name);

                // Add your client-specific processing logic here
                $this->processClientNotification($template, $client, $filtered_mail);
            }

            $this->info('Completed batch of ' . $clients->count() . ' clients');
        });

    }

    /**
     * Process notification for individual client
     */
    private function processClientNotification($template, $client, $filtered_mail)
    {
        // Check if client has ever logged in
        if ($client->logged_in_ever == 0 && $template->noti_tenp_body == NotificationTemplate::NOTLOGGEDINUSER) {
            // Client has never logged in
            $this->info('Client has never logged in - running first-time user function');
            $this->handleFirstTimeUser($template, $client, $filtered_mail);
        } elseif ($client->logged_in_ever == 1 && $template->noti_tenp_body == NotificationTemplate::LOGGEDINUSER) {
            // Client has logged in before
            $this->info('Client has logged in before - running returning user function');
            $this->handleReturningUser($template, $client, $filtered_mail);
        }
    }

    /**
     * Handle notification for first-time users (never logged in)
     */
    private function handleFirstTimeUser($template, $client, $filtered_mail)
    {
        $this->info('Processing first-time user: ' . $client->name);

        try {

            Mail::to($client->email)->send(new AutomatedNotificationTemplateNotLoggedInUser($client->name, $template->noti_tenp_subject, $filtered_mail, $client->id, $client->email));

            // Log the email send
            Log::info("AutomatedNotificationTemplate - First-time user email sent | Client ID: {$client->id} | Name: {$client->name} | Email: {$client->email} | Template ID: {$template->id} | Subject: {$template->noti_tenp_subject}");

            // Replace with your actual email sending logic
            $this->info('Email sent successfully to: ' . $client->email);

        } catch (\Exception $e) {
            $this->error('Failed to send email to ' . $client->email . ': ' . $e->getMessage());
        }
    }

    /**
     * Handle notification for returning users (have logged in before)
     */
    private function handleReturningUser($template, $client, $filtered_mail)
    {
        // Add your returning user logic here
        $this->info('Processing returning user: ' . $client->name);

        try {

            $client_percent = FormsStepsCompleted::getStepCompletionDataForNotificationTemplate($client->id, $client->client_type);
            $documentProgress = ClientHelper::get_uploaded_docs_progress($client, $client->id, $template->attorney_id);

            // Extract tab percentages
            $tab1_percentage = $client_percent['tab1_percentage'] ?? 0;
            $tab2_percentage = $client_percent['tab2_percentage'] ?? 0;
            $tab3_percentage = $client_percent['tab3_percentage'] ?? 0;
            $tab4_percentage = $client_percent['tab4_percentage'] ?? 0;
            $tab5_percentage = $client_percent['tab5_percentage'] ?? 0;
            $tab6_percentage = $client_percent['tab6_percentage'] ?? 0;
            $all_percentage = $client_percent['all_percentage'] ?? 0;
            $document_percentage = $documentProgress['progress'] ?? 0;

            // Log progress information
            $this->info("Document progress: {$document_percentage}%, All progress: {$all_percentage}%");

            if ($all_percentage < 100 || $document_percentage < 100) {
                $this->info('Client has incomplete sections - sending notification email');

                $message = $this->getEmailMessage($tab1_percentage, $tab2_percentage, $tab3_percentage, $tab4_percentage, $tab5_percentage, $tab6_percentage, $document_percentage);

                Mail::to($client->email)->send(new AutomatedNotificationTemplateLoggedInUser($client->name, $template->noti_tenp_subject, $message, $filtered_mail, $client->id, $client->email));

                // Log the email send
                Log::info("AutomatedNotificationTemplate - Returning user email sent | Client ID: {$client->id} | Name: {$client->name} | Email: {$client->email} | Template ID: {$template->id} | Subject: {$template->noti_tenp_subject} | Progress: {$all_percentage}% | Doc Progress: {$document_percentage}%");

                $this->info('Email sent successfully to: ' . $client->email);
            } else {
                $this->info('Client ' . $client->name . ' has completed all sections (100%) - skipping email');
            }

        } catch (\Exception $e) {
            $this->error('Failed to send email to ' . $client->email . ': ' . $e->getMessage());
        }
    }

    /**
     * Get email message based on tab1 completion status
     */
    private function getEmailMessage($tab1_percentage, $tab2_percentage, $tab3_percentage, $tab4_percentage, $tab5_percentage, $tab6_percentage, $document_percentage)
    {
        $message = '';
        // Build list of incomplete sections
        $incompleteSections = [];
        if ($tab1_percentage < 100) {
            $incompleteSections[] = "• Basic Info Section";
        }
        if ($tab2_percentage < 100) {
            $incompleteSections[] = "• Property Section";
        }
        if ($tab3_percentage < 100) {
            $incompleteSections[] = "• Debts Section";
        }
        if ($tab4_percentage < 100) {
            $incompleteSections[] = "• Current Income Section";
        }
        if ($tab5_percentage < 100) {
            $incompleteSections[] = "• Current Expenses Section";
        }
        if ($tab6_percentage < 100) {
            $incompleteSections[] = "• Statement of Financial Affairs Section";
        }
        if ($document_percentage < 100) {
            $incompleteSections[] = "• Documents uploaded";
        }

        $sectionsList = implode("\n", $incompleteSections);
        if ($tab1_percentage == 100) {
            $message = "We're glad to see you have completed the Basic Info section, please log back into BK Questionnaire and let's get the:\n\n" .
                      $sectionsList . "\n\n" .
                      "Let's get the above sections finished up so you can get the stress relief you need.";
        } else {
            $message = "Please log back into BK Questionnaire and let's get the:\n\n" .
                        $sectionsList . "\n\n" .
                        "Let's get the above sections finished up so you can get the stress relief you need.";
        }

        return $message;
    }


}
