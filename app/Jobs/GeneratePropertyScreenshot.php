<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\PropertyScreenshotService;
use App\Models\ClientDocumentUploaded;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;
use Exception;

class GeneratePropertyScreenshot implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * The number of times the job may be attempted.
     */
    public $tries = 3;

    /**
     * The maximum number of seconds the job can run.
     */
    public $timeout = 300; // 5 minutes

    /**
     * The number of seconds to wait before retrying the job.
     */
    public $backoff = 30;

    protected $url;
    protected $clientId;
    protected $address;
    protected $propertyId; // Optional: to update database when complete

    /**
     * Create a new job instance.
     */
    public function __construct($url, $clientId, $address, $propertyId = null)
    {
        $this->url = $url;
        $this->clientId = $clientId;
        $this->address = $address;
        $this->propertyId = $propertyId;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        try {
            // Increase memory limit for this job
            ini_set('memory_limit', '512M');


            $result = PropertyScreenshotService::generateScreenshot(
                $this->url,
                $this->clientId,
                $this->address
            );

            if ($result['status']) {

                // Upload PDF to attorney document system
                $uploadSuccess = $this->uploadPdfToDocumentSystem($result);

                // Clean up local files after successful upload
                if ($uploadSuccess) {
                    $this->cleanupLocalFiles($result);
                }

            } else {
                Log::error("Background screenshot failed", [
                    'client_id' => $this->clientId,
                    'address' => $this->address,
                    'error' => $result['message']
                ]);
            }

        } catch (Exception $e) {
            Log::error("Background screenshot job failed", [
                'client_id' => $this->clientId,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Upload PDF to attorney document system using upload_client_date method
     */
    private function uploadPdfToDocumentSystem($result)
    {
        try {
            // Check if PDF was generated
            if (!isset($result['pdf']) || !isset($result['pdf']['file_path'])) {
                return false;
            }

            $pdfPath = $result['pdf']['file_path'];
            $pdfFilename = $result['pdf']['filename'];

            // Check if file exists
            if (!file_exists($pdfPath)) {
                return false;
            }

            // Create a temporary uploaded file object
            $tempFile = new UploadedFile(
                $pdfPath,
                $pdfFilename,
                'application/pdf',
                null,
                true // test mode
            );

            // Upload directly using ClientDocumentUploaded::storeClientSideDocument
            // This is the same method that upload_client_date uses internally
            $documentType = 'Mortgage_property_value_' . ($this->propertyId ?? 'unknown');

            $documentId = ClientDocumentUploaded::storeClientSideDocument(
                $this->clientId,
                $tempFile,
                $documentType,
                'Property Screenshot - ' . $this->address,
                1, // added_by_attorney = 1 (system generated)
                0, // defaultStatus
                'pdf' // extension
            );

            if (is_numeric($documentId)) {
                Log::info("PDF uploaded to client document system successfully", [
                    'client_id' => $this->clientId,
                    'address' => $this->address,
                    'document_id' => $documentId,
                    'document_type' => $documentType,
                    'pdf_filename' => $pdfFilename
                ]);

                return true;
            } else {
                return false;
            }

        } catch (Exception $e) {
            Log::error("Error uploading PDF to document system", [
                'client_id' => $this->clientId,
                'error' => $e->getMessage()
            ]);

            return false;
        }
    }

    /**
     * Ultra-fast cleanup: Delete entire client directory at once
     * Much faster than individual file deletion
     */
    private function cleanupLocalFiles($result)
    {
        try {
            // Get the client directory path (two levels up from the file)
            $directoryPath = null;
            foreach (['png', 'pdf'] as $type) {
                if (isset($result[$type]['file_path'])) {
                    // Go up two levels: file -> address directory -> client ID directory
                    $directoryPath = dirname(dirname($result[$type]['file_path']));
                    break; // We only need one path to get the client directory
                }
            }

            if (!$directoryPath || !is_dir($directoryPath)) {
                return; // No directory to clean up
            }

            // Ultra-fast: Delete entire client directory recursively (includes all addresses)
            $this->deleteDirectoryRecursively($directoryPath);

        } catch (Exception $e) {
            Log::error("Error during directory cleanup", [
                'client_id' => $this->clientId,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Ultra-fast recursive directory deletion
     * Uses system commands for maximum speed with proper debugging
     */
    private function deleteDirectoryRecursively($directory)
    {
        try {

            // Check if directory is empty first
            $items = array_diff(scandir($directory), ['.', '..']);
            if (empty($items)) {
                // Directory is empty, try to remove it
                if (rmdir($directory)) {
                    return; // Success!
                }
            }

            // Check if directory still exists
            if (!is_dir($directory)) {
                return;
            }

            // Check if exec is available
            if (!function_exists('exec') || in_array('exec', explode(',', ini_get('disable_functions')))) {
                $this->fallbackDirectoryDeletion($directory);

                return;
            }

            // Ultra-fast: Use system command for recursive deletion with permission fixes
            $command = null;
            if (PHP_OS_FAMILY === 'Windows') {
                // Windows command
                $command = "rmdir /s /q \"{$directory}\" 2>nul";
            } else {
                // Unix/Linux command with permission fixes - much faster than PHP loops
                $command = "chmod -R 755 \"{$directory}\" 2>/dev/null && rm -rf \"{$directory}\" 2>/dev/null";
            }

            $output = [];
            $returnCode = 0;
            exec($command, $output, $returnCode);

            // Check if deletion was successful
            if (!is_dir($directory)) {
                return; // Success!
            } else {
                // Fallback: Try PHP-based deletion
                $this->fallbackDirectoryDeletion($directory);
            }

        } catch (Exception $e) {
            Log::error("Exception during directory deletion", [
                'client_id' => $this->clientId,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Fallback PHP-based directory deletion
     * Used when system commands fail
     */
    private function fallbackDirectoryDeletion($directory)
    {
        try {
            if (!is_dir($directory)) {
                return;
            }

            // Get all items in directory with error handling
            $items = @scandir($directory);
            if ($items === false) {
                return; // Directory already deleted by system command - SUCCESS!
            }
            $items = array_diff($items, ['.', '..']);

            if (empty($items)) {
                // Directory is empty, remove it
                chmod($directory, 0755);
                rmdir($directory);

                return;
            }

            // Delete all files and subdirectories with permission fixes
            foreach ($items as $item) {
                $itemPath = $directory . DIRECTORY_SEPARATOR . $item;

                if (is_dir($itemPath)) {
                    // Recursively delete subdirectory
                    $this->fallbackDirectoryDeletion($itemPath);
                } else {
                    // Delete file with permission fix
                    chmod($itemPath, 0644);
                    unlink($itemPath);
                }
            }

            // Remove the now-empty directory
            chmod($directory, 0755);
            rmdir($directory);

        } catch (Exception $e) {
            // Only log if directory actually still exists (not a race condition)
            if (@is_dir($directory)) {
                Log::error("Fallback deletion failed", [
                    'client_id' => $this->clientId,
                    'error' => $e->getMessage()
                ]);
            }
            // If directory is gone, that's SUCCESS - no error to log!
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(Exception $exception)
    {
        Log::error("Screenshot generation job failed permanently", [
            'client_id' => $this->clientId,
            'address' => $this->address,
            'error' => $exception->getMessage()
        ]);
    }
}
