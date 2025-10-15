<?php

namespace App\Services;

use App\Helpers\DocumentHelper;
use Illuminate\Support\Facades\Log;
use Exception;

class PropertyScreenshotService
{
    /**
     * Generate screenshot using Playwright with stealth capabilities.
     *
     * @param string $url The URL to screenshot
     * @param string $clientId The client ID for organizing files
     * @param string $address The property address for file naming
     * @return array Result array with status and file information
     */
    public static function generateScreenshot($url, $clientId, $address)
    {
        try {
            $addressAsDir = DocumentHelper::sanitizeDirectoryName($address);
            $timestamp = now()->format('Y-m-d_H-i-s');
            $pngFilename = "property_screenshot_{$timestamp}.png";
            $pdfFilename = "property_screenshot_{$timestamp}.pdf";

            $localPath = storage_path('app/property_screenshots/' . $clientId . '/' . $addressAsDir);
            if (!file_exists($localPath)) {
                mkdir($localPath, 0755, true);
            }

            $pngPath = $localPath . '/' . $pngFilename;
            $pdfPath = $localPath . '/' . $pdfFilename;

            // Execute the Node.js script
            $scriptPath = base_path('screenshot.js');
            $command = "node {$scriptPath} \"{$url}\" \"{$pngPath}\" 2>&1";

            Log::info("Executing screenshot command", [
                'command' => $command,
                'url' => $url,
                'png_path' => $pngPath,
                'pdf_path' => $pdfPath
            ]);

            $output = [];
            $returnCode = 0;
            exec($command, $output, $returnCode);

            Log::info("Screenshot command output", [
                'return_code' => $returnCode,
                'output' => implode("\n", $output)
            ]);

            if ($returnCode === 0 && file_exists($pngPath)) {
                $pngSize = filesize($pngPath);
                $pdfSize = file_exists($pdfPath) ? filesize($pdfPath) : 0;

                Log::info("Screenshot and PDF generated successfully", [
                    'client_id' => $clientId,
                    'address' => $address,
                    'url' => $url,
                    'png_size' => $pngSize,
                    'pdf_size' => $pdfSize,
                    'png_filename' => $pngFilename,
                    'pdf_filename' => $pdfFilename
                ]);

                $result = [
                    'status' => true,
                    'message' => 'Screenshot and PDF captured successfully',
                    'png' => [
                        'file_path' => $pngPath,
                        'filename' => $pngFilename,
                        'file_size' => $pngSize,
                        'relative_path' => 'property_screenshots/' . $clientId . '/' . $addressAsDir . '/' . $pngFilename
                    ]
                ];

                if (file_exists($pdfPath)) {
                    $result['pdf'] = [
                        'file_path' => $pdfPath,
                        'filename' => $pdfFilename,
                        'file_size' => $pdfSize,
                        'relative_path' => 'property_screenshots/' . $clientId . '/' . $addressAsDir . '/' . $pdfFilename
                    ];
                }

                return $result;
            }

            Log::warning("Screenshot generation failed", [
                'client_id' => $clientId,
                'address' => $address,
                'url' => $url,
                'return_code' => $returnCode,
                'output' => implode("\n", $output)
            ]);

            return [
                'status' => false,
                'message' => 'Screenshot generation failed: ' . implode("\n", $output)
            ];

        } catch (Exception $e) {
            Log::error("Screenshot service failed", [
                'client_id' => $clientId,
                'address' => $address,
                'url' => $url,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'status' => false,
                'message' => 'Screenshot service failed: ' . $e->getMessage()
            ];
        }
    }
}
