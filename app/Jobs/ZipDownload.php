<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\DoctoZipFileScheduler;
use App\Models\ClientDocumentUploaded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use ZipArchive;
use Storage;
use Carbon\Carbon;
use App\Helpers\Helper;
use App\Helpers\DocumentHelper;
use App\Models\ClientsAssociate;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheProperty;
use DateTime;

class SubFolders
{
    public const ID_SSN_INFO = 'Debtor(s) ID and SSN Info';
    public const SECURED_DEBTS = 'Secured_Debts';
    public const UNSECURED_DEBTS = 'Unsecured Debts';
    public const DEBTORS_INCOME_DOCS = 'Debtors.Income Docs';
    public const CODEBTORS_INCOME_DOCS = 'Co-Debtors.Income Docs';
    public const OTHER_INCOMES = 'Other Income & Benefits';
    public const PAY_STUBS = 'Pays stubs';
    public const TAX_RETURNS = 'Tax Returns';
    public const BANK_STATEMENTS = 'Bank Account Statements';
    public const MISC_ATTR_DOCUMENTS = 'Misc.Attorney Documents';
    public const POST_SUBMISSION = 'Post Submission Docs';

    public const BROKERAGE_ACCOUNT_DOCS = 'Brokerage Account Statements';
    public const LIFE_INSURANCE_DOCS = 'Life Insurance Policies';
    public const REQUESTED_DOCS = 'Requested Documents';
    public const RETIREMENT_DOCS = 'Retirement Account Statements';
    public const PAYPAL_CASH_VENMO_DOCS = 'Paypal, Cash App, Venmo';

    public const SCH_PETITION = 'Petition';
    public const SCH_AB = 'Sched A B – (Financial Accounts)';
    public const SCH_AB_RESIDENCE = 'Sched A B – (Residence)';
    public const SCH_AB_TAXES = 'Sched A B – (Taxes)';
    public const SCH_AB_VEHICLES = 'Schedule A B – (Vehicles)';
    public const SCH_I_J_MT_INCOME = 'Sched I J MT – (Income)';
    public const SCH_D = 'Schedule D';
    public const SCH_E = 'Schedule E';
    public const SCH_F = 'Schedule F';
    public const SCH_G = 'Schedule G';
    public const SCH_H = 'Schedule H';
    public const SCH_I = 'Schedule I';
    public const SCH_J = 'Schedule J';
    public const SOFA = 'SOFA';
    public const TRUSTEE_DOCS = 'Trustee Docs';
}

class ZipDownload implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected $clientId;
    protected $currentProgressIndex;

    public $timeout = 300;

    public const STATUS_PENDING = 0;
    public const STATUS_INPROGRESS = 1;
    public const STATUS_COMPLETED = 2;

    public const MORTGAGE_DIR = 'Mortgages (D)';
    public const VEHCILE_DIR = 'Auto Loans';
    public const VEHICLE_INFO = 'Vehicle Information';
    public const VEHCILE_REG = 'Vehicle Registration';

    public const VEHICLE_TITLE = 'Vehicle Title';
    public const RENTAL_AGREEMENT = 'Copy of Current Rental Agreement';

    public const MISC_ATTY_DOCS = 'Debt(s)Collection Statements';
    public const DEBTOR_CREDITOR_REPORT = 'Debtor Creditor Report';
    public const CO_DEBTOR_CREDITOR_REPORT = 'Co-Debtor Creditor Report';

    public const INSURANCE_DOCUMENTS = 'Proof of Auto Insurance';
    public const MISCELLANEOUS_DOCUMENTS = 'Miscellaneous Documents';

    public const SN_INFO = 'Social Security';
    /** Petition Sub folders start */
    public const DEBTOR_DL_INFO = 'Driver’s License';
    public const DEBTOR_SSN_INFO = 'Social Security Card';
    public const DEBTOR_CREDIT_COUNCELING = 'Credit Counseling Course';

    public const CO_DEBTOR_DL_INFO = 'Driver’s License';
    public const CO_DEBTOR_SSN_INFO = 'Social Security Card';
    public const CO_DEBTOR_CREDIT_COUNCELING = 'Credit Counseling Course';

    public const CREDIT_REPORT = 'Credit Report';
    /** Petition Sub folders End */


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($clientId)
    {
        //
        $this->clientId = $clientId;
        $this->currentProgressIndex = 0;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Session::save();

        $clientId = $this->clientId;
        $attorney = \App\Models\ClientsAttorney::where("client_id", $clientId)->first();
        if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
            $attorney_id = $attorney->attorney_id;
        }

        $ClientsAssociateId = ClientsAssociate::getAssociateId($clientId);
        $settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;

        $attorneySettings = \App\Models\AttorneySettings::where(['attorney_id' => $settingsAttorneyId, 'is_associate' => $is_associate])->select(['zip_in_schedule_structure','is_car_title_enabled','is_rental_agreement_enabled'])->first();
        $zip_in_schedule_structure = !empty($attorneySettings) ? Helper::validate_key_value('zip_in_schedule_structure', $attorneySettings) : 0;
        $is_car_title_enabled = !empty($attorneySettings) ? Helper::validate_key_value('is_car_title_enabled', $attorneySettings, 'radio') : 0;
        $is_rental_agreement_enabled = !empty($attorneySettings) ? Helper::validate_key_value('is_rental_agreement_enabled', $attorneySettings, 'radio') : 0;


        $notIn = ['document_sign', 'signed_document'];
        if (empty($is_rental_agreement_enabled)) {
            array_push($notIn, 'rental_agreement');
        }
        if (empty($is_car_title_enabled)) {
            $vehicle_title = \App\Models\ClientDocuments::getClientDocs($clientId, 'vehicle_title');
            $vehicleTitles = !empty($vehicle_title) ? array_keys($vehicle_title) : [];
            $notIn = array_merge($notIn, $vehicleTitles);
        }
        $documentList = ClientDocumentUploaded::where(['client_id' => $clientId, 'is_uploaded_to_s3' => 1])
            ->whereNotIn('document_type', $notIn)
            ->get()
            ->toArray();
        //\Log::info('File Counts '.count($documentList).' clientId '.$clientId);

        if (empty($documentList)) {
            $this->updateProgress($clientId, 0, 'empty docs');

            // \Log::info('Empty files  '.count($documentList).' clientId '.$clientId);
            return response()->json(['error' => 'No documents found for this client'], 404);
        }


        if ($zip_in_schedule_structure == 1) {
            $this->getScheduleZipFileForClient($clientId, $documentList);
        } else {
            $this->getZipFileForClient($clientId, $documentList);
        }


    }

    /**
    * Generate a zip file of all uploaded docs for a client.
    * @param mixed $clientId
    * @param mixed $documentList
    * @return string
    */
    public function getScheduleZipFileForClient($clientId, $documentList)
    {
        $clientInfo = \App\Models\User::getClientInfo($clientId);
        $clientName = str_replace(' ', '_', $clientInfo['client_fullname']);

        $clientDir = public_path() ."/documents/".$clientId;
        if (!File::exists($clientDir)) {
            File::makeDirectory($clientDir, 0777, true);
        }

        $profitlossZipPath = (new DoctoZipFileScheduler())->getProfitLossZipFileforClient($clientId, true);


        $toZipFoldername = "formatted_docs";
        $zippedFilename = $clientName . "_BKQ_Uploaded_Docs.zip";
        $zipFilePath = "{$clientDir}/$zippedFilename";

        // Clean up previous files
        $this->cleanTempDirectory("$clientDir/$toZipFoldername");
        if (file_exists($zipFilePath)) {
            unlink($zipFilePath);
        }

        // Recreate directories
        if (!file_exists($clientDir)) {
            File::makeDirectory($clientDir, 0777, true, true);
        }
        File::makeDirectory("$clientDir/$toZipFoldername", 0777, true, true);

        if (!empty($profitlossZipPath)) {
            $localProfitLossPath = "$clientDir/Company_Profit_Loss.zip";
            $extractPath = "$clientDir/$toZipFoldername/" . SubFolders::SCH_I_J_MT_INCOME . '/P&L';

            // Ensure the target directory exists
            File::ensureDirectoryExists($extractPath);

            // Temporary directory for extraction
            $tempExtractPath = storage_path('app/temp_extract_' . uniqid());

            File::makeDirectory($tempExtractPath, 0755, true);

            $zip = new \ZipArchive();

            if ($zip->open($localProfitLossPath) === true) {
                $zip->extractTo($tempExtractPath);
                $zip->close();
                File::delete($localProfitLossPath);

                // Get top-level contents in the temp directory
                $topLevelItems = File::directories($tempExtractPath) + File::files($tempExtractPath);

                foreach ($topLevelItems as $item) {
                    if (is_dir($item)) {
                        // If it's a folder, move its contents (flatten)
                        $files = File::allFiles($item);
                        foreach ($files as $file) {
                            $relativePath = str_replace($item . DIRECTORY_SEPARATOR, '', $file->getPathname());
                            $destination = $extractPath . '/' . $relativePath;

                            File::ensureDirectoryExists(dirname($destination));
                            File::move($file->getPathname(), $destination);
                        }
                    } else {
                        // If it's a file directly, move it as-is
                        File::move($item, $extractPath . '/' . basename($item));
                    }
                }

                // Delete temp directory
                File::deleteDirectory($tempExtractPath);
            } else {
                throw new \Exception("Failed to open the ZIP file: $localProfitLossPath");
            }
        }

        // Create subfolders structure
        $subfolders = [
            SubFolders::SCH_PETITION,
            SubFolders::SCH_AB,
            SubFolders::SCH_D,
            SubFolders::SCH_E,
            SubFolders::SCH_F,
            SubFolders::SCH_G,
            SubFolders::SCH_H,
            SubFolders::SCH_I,
            SubFolders::SCH_J,
            SubFolders::SOFA
        ];

        $BIData = CacheBasicInfo::getBasicInformationData($clientId);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

        $debtorname = \App\Helpers\ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor");
        $spousename = \App\Helpers\ClientHelper::getDebtorName($clientBasicInfoPartB, "Co-Debtor");

        // Get attorney documents if exists
        $attorneydocumentTypes = [];
        $attorney = \App\Models\ClientsAttorney::where("client_id", $clientId)->first();
        if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
            $attorney_id = $attorney->attorney_id;

            $ClientsAssociateId = ClientsAssociate::getAssociateId($clientId);
            $settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;
            $is_associate = !empty($ClientsAssociateId) ? 1 : 0;

            $attorneyDocuments = \App\Models\AttorneyDocuments::orderBy('id', 'DESC')
                ->where(['attorney_id' => $settingsAttorneyId , 'is_associate' => $is_associate])
                ->get()
                ->toArray();
            $attorneydocumentTypes = array_column($attorneyDocuments, 'document_type');
        }

        $clientBankDocs = \App\Models\ClientDocuments::getClientDocs($clientId);
        $adminDocuments = \App\Models\AdminClientDocuments::orderBy('id', 'asc')
            ->where('client_id', $clientId)
            ->pluck('document_name', 'document_type')
            ->all();
        $adminDocs = \App\Models\ClientDocuments::getAdminRequestedDocumentList($adminDocuments, $clientBankDocs);

        // Get employer lists
        $debtor_employers = \App\Models\AttorneyEmployerInformationToClient::getEmployerList($clientId, $attorney_id, 'debtor');
        $debtor_employers_list = [];
        foreach ($debtor_employers as $item) {
            $debtor_employers_list[$item['id']] = DocumentHelper::validate_dir_name($item['employer_name']);
        }

        $codebtor_employers = \App\Models\AttorneyEmployerInformationToClient::getEmployerList($clientId, $attorney_id, 'codebtor');
        $codebtor_employers_list = [];
        foreach ($codebtor_employers as $item) {
            $codebtor_employers_list[$item['id']] = DocumentHelper::validate_dir_name($item['employer_name']);
        }

        // Create all required subfolders
        foreach ($subfolders as $subfolder) {
            $path = "$clientDir/$toZipFoldername/$subfolder";
            if (!file_exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            // Special handling for certain folders
            if ($subfolder == SubFolders::SCH_PETITION) {
                $directories = [
                    $path."/".self::DEBTOR_DL_INFO,
                    $path."/".self::DEBTOR_SSN_INFO,
                    $path."/".self::DEBTOR_CREDIT_COUNCELING,
                    $path."/".self::CO_DEBTOR_DL_INFO,
                    $path."/".self::CO_DEBTOR_SSN_INFO,
                    $path."/".self::CO_DEBTOR_CREDIT_COUNCELING,
                ];
                foreach ($directories as $dir) {
                    if (!file_exists($dir)) {
                        File::makeDirectory($dir, 0777, true, true);
                    }
                }
            }

            if ($subfolder == SubFolders::UNSECURED_DEBTS) {
                $directories = [
                    $path."/".self::MISC_ATTY_DOCS,
                    $path."/".self::DEBTOR_CREDITOR_REPORT,
                    $path."/".self::CO_DEBTOR_CREDITOR_REPORT
                ];
                foreach ($directories as $dir) {
                    if (!file_exists($dir)) {
                        File::makeDirectory($dir, 0777, true, true);
                    }
                }
            }

            if ($subfolder == SubFolders::MISC_ATTR_DOCUMENTS) {
                self::createSubDire($path, $attorneydocumentTypes, self::MISCELLANEOUS_DOCUMENTS);
            }

            $bankStatements = $clientBankDocs['bank'] ?? [];
            if ($subfolder == SubFolders::BANK_STATEMENTS) {
                self::createSubDire($path, array_keys($bankStatements), '', false);
            }

            $venmo_paypal_cash = $clientBankDocs['venmo_paypal_cash'] ?? [];
            $venmo_paypal_cash = \App\Helpers\ClientHelper::getUpdatedLabelName($debtorname, $spousename, $venmo_paypal_cash, true);
            if ($subfolder == SubFolders::PAYPAL_CASH_VENMO_DOCS) {
                self::createSubDire($path, array_values($venmo_paypal_cash), '', false);
            }

            $brokerageAccount = $clientBankDocs['brokerage_account'] ?? [];
            if ($subfolder == SubFolders::BROKERAGE_ACCOUNT_DOCS) {
                self::createSubDire($path, array_keys($brokerageAccount), '', false);
            }

            $retirement_pension = $clientBankDocs['retirement_pension'] ?? [];
            if ($subfolder == SubFolders::RETIREMENT_DOCS) {
                self::createSubDire($path, array_keys($retirement_pension), '', false);
            }

            $unpaid_wages = $clientBankDocs['unpaid_wages'] ?? [];
            $unpaid_wages = \App\Helpers\ClientHelper::getUpdatedLabelName($debtorname, $spousename, $unpaid_wages, true);
            if ($subfolder == SubFolders::OTHER_INCOMES) {
                self::createSubDire($path, array_values($unpaid_wages), '', false);
            }

            if ($subfolder == SubFolders::REQUESTED_DOCS) {
                self::createSubDire($path, $adminDocs, '', false);
            }

            if ($subfolder == SubFolders::DEBTORS_INCOME_DOCS) {
                if (!empty($debtor_employers_list)) {
                    self::createSubDire($path, array_values($debtor_employers_list), 'Employer_Not_assisgned', false);
                }
            }

            if ($subfolder == SubFolders::CODEBTORS_INCOME_DOCS) {
                if (!empty($codebtor_employers_list)) {
                    self::createSubDire($path, array_values($codebtor_employers_list), 'Employer_Not_assisgned', false);
                }
            }
        }

        $debtor_paystubs_list = \App\Models\PayStubs::where(['pinwheel_account_type' => 'self', 'client_id' => $clientId])
            ->pluck('employer_id', 'document_id');
        $codebtor_paystubs_list = \App\Models\PayStubs::where(['pinwheel_account_type' => 'spouse', 'client_id' => $clientId])
            ->pluck('employer_id', 'document_id');

        $taxReturns = ClientDocumentUploaded::getCommonDocumentForAttorney($attorney_id);
        $bankDocList = [];
        $taxDocList = [];
        $docNum = 1;
        $bankDocs = \App\Models\ClientDocuments::getAllBankDocumentKeysList($clientId);

        // Process each document
        foreach ($documentList as $doc) {
            $newPath = $this->getScheduleNewFolderPath(
                $clientInfo,
                $doc,
                $docNum,
                $clientId,
                $debtorname,
                $spousename,
                $attorneydocumentTypes,
                $clientBankDocs,
                $adminDocs,
                $debtor_paystubs_list,
                $codebtor_paystubs_list,
                $debtor_employers_list,
                $codebtor_employers_list,
                $taxReturns
            );

            if (empty($newPath)) {
                continue;
            }

            // Handle both string and array paths
            $pathsToProcess = is_array($newPath) ? $newPath : [$newPath];

            foreach ($pathsToProcess as $singlePath) {
                $localFilePath = "$clientDir/$toZipFoldername/$singlePath";
                $directoryPath = dirname($localFilePath);

                if (!is_dir($directoryPath)) {
                    File::makeDirectory($directoryPath, 0777, true, true);
                }

                // Group documents for PDF merging if needed
                if (in_array($doc['document_type'], $bankDocs)) {
                    $bankDocList[$doc['document_type']][$doc['document_month']][] = [
                        'document_month' => $doc['document_month'],
                        'localFilePath' => $localFilePath,
                        'directoryPath' => $directoryPath,
                        'new_path' => $singlePath,
                        'sort_order' => $doc['sort_order'],
                        'document_type' => $doc['document_type'],
                        'updated_name' => $doc['updated_name']
                    ];
                }

                if (in_array($doc['document_type'], array_keys($taxReturns))) {
                    $taxDocList[$doc['document_type']][] = [
                        'localFilePath' => $localFilePath,
                        'directoryPath' => $directoryPath,
                        'new_path' => $singlePath,
                        'sort_order' => $doc['sort_order'],
                        'document_type' => $doc['document_type'],
                        'updated_name' => $taxReturns[$doc['document_type']]
                    ];
                }

                try {
                    if (Storage::disk('s3')->exists($doc['document_file'])) {
                        $fileContent = Storage::disk('s3')->get($doc['document_file']);
                        if ($fileContent) {
                            $writeResult = @file_put_contents($localFilePath, $fileContent);
                            if ($writeResult === false) {
                                throw new \Exception("Failed to write file at path: $localFilePath");
                            }
                        }
                    }
                } catch (\Exception $e) {
                    // Log error if needed
                }
            }

            $docNum++;
        }

        // Merge bank statements into single PDFs by month
        if (!empty($bankDocList)) {
            foreach ($bankDocList as $doc_type => $docData) {
                foreach ($docData as $month => $data) {
                    if (!empty($month) && count($data) > 1) {
                        $pdfarray = [];
                        $index = 'A';
                        $pathToCreate = '';

                        foreach ($data as $dlist) {
                            $pdfarray[$index] = $dlist['localFilePath'];
                            $pathToCreate = $dlist['directoryPath'];
                            $index++;
                        }

                        if (!empty($pdfarray)) {
                            $pdf = \App\Models\PdfData::commonPdfGenerateScript($pdfarray);
                            foreach ($pdfarray as $key => $val) {
                                $pdf->cat(1, 'end', $key);
                            }
                            $monthName = Carbon::createFromFormat('m-Y', $month)->format('F');
                            $pathToCreate = $pathToCreate.'/'.$monthName.'.pdf';
                            $pdf->saveAs($pathToCreate);

                            foreach ($pdfarray as $filePath) {
                                if (file_exists($filePath)) {
                                    unlink($filePath);
                                }
                            }
                        }
                    }
                }
            }
        }

        // Merge tax documents into single PDFs
        if (!empty($taxDocList)) {

            foreach ($taxDocList as $docType => $docGroup) {
                // Group files by directoryPath
                $groupedByPath = collect($docGroup)->groupBy('directoryPath');

                foreach ($groupedByPath as $directoryPath => $filesInDir) {
                    $filesToMerge = [];
                    $outputPath = null;
                    $updatedName = null;

                    foreach ($filesInDir as $fileData) {
                        $filesToMerge[] = $fileData['localFilePath'];
                        $updatedName = $fileData['updated_name'] . '.pdf';
                        $outputPath = $fileData['directoryPath'] . DIRECTORY_SEPARATOR . $updatedName;
                    }

                    // Make sure directory exists
                    if (!File::exists($directoryPath)) {
                        File::makeDirectory($directoryPath, 0775, true);
                    }

                    if (count($filesToMerge) > 1) {
                        // Merge PDF files
                        $pdf = \App\Models\PdfData::commonPdfGenerateScript($filesToMerge);
                        if (!$pdf->saveAs($outputPath)) {
                            \Log::error("Failed to merge PDFs: " . $pdf->getError());
                            continue;
                        }
                    } else {
                        // Single file: just move/rename it
                        File::move($filesToMerge[0], $outputPath);
                    }

                    // Delete original files
                    foreach ($filesToMerge as $file) {
                        if (File::exists($file) && $file !== $outputPath) {
                            File::delete($file);
                        }
                    }
                }
            }

        }

        $additionalSubDir = "Trustee Docs";
        $additionalSubDirPath = "$clientDir/$toZipFoldername/$additionalSubDir";
        if (!file_exists($additionalSubDirPath)) {
            File::makeDirectory($additionalSubDirPath, 0777, true, true);
        }

        $additionalSubDirs = [
            SubFolders::SOFA,
            SubFolders::SCH_I,
        ];

        $path = SubFolders::SCH_D;
        $securedDirectories = [
            $path."/".self::MORTGAGE_DIR,
            $path."/".self::VEHCILE_DIR,
            $path."/".self::VEHICLE_INFO,
            $path."/".self::VEHCILE_REG,
            $path.'/'.self::RENTAL_AGREEMENT,
            $path.'/'.self::VEHICLE_TITLE,
        ];

        $path = SubFolders::SCH_PETITION;
        $petitionDocs = [
            $path."/".self::CO_DEBTOR_DL_INFO,
            $path."/".self::DEBTOR_DL_INFO,
            $path."/".self::DEBTOR_SSN_INFO,
            $path."/".self::CO_DEBTOR_SSN_INFO,
        ];



        // Function to recursively copy all files to destination (flat structure)
        $copyAllFilesFlat = function ($sourcePath, $destinationPath) use (&$copyAllFilesFlat) {
            if (!file_exists($sourcePath)) {
                return;
            }

            $items = scandir($sourcePath);
            foreach ($items as $item) {
                if ($item === '.' || $item === '..') {
                    continue;
                }

                $source = "$sourcePath/$item";
                if (is_dir($source)) {
                    $copyAllFilesFlat($source, $destinationPath); // Recursive call for subdirectories
                } else {
                    // Handle filename conflicts by adding prefix if needed
                    $destFile = "$destinationPath/$item";
                    $counter = 1;
                    while (file_exists($destFile)) {
                        $info = pathinfo($item);
                        $destFile = "$destinationPath/{$info['filename']}_$counter.{$info['extension']}";
                        $counter++;
                    }
                    copy($source, $destFile);
                }
            }
        };

        // Process secured directories
        foreach ($securedDirectories as $dir) {
            $sourcePath = "$clientDir/$toZipFoldername/$dir";
            $copyAllFilesFlat($sourcePath, $additionalSubDirPath);
        }



        foreach ($petitionDocs as $dir) {
            $sourcePath = "$clientDir/$toZipFoldername/$dir";
            $copyAllFilesFlat($sourcePath, $additionalSubDirPath);
        }



        // Process additional directories
        foreach ($additionalSubDirs as $dir) {
            $sourcePath = "$clientDir/$toZipFoldername/$dir";
            $copyAllFilesFlat($sourcePath, $additionalSubDirPath);
        }




        // Create the final zip file
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new \Exception("Failed to create zip file at $zipFilePath");
        }

        $zip->setCompressionIndex(0, ZipArchive::CM_STORE);

        // Calculate total files for progress tracking
        $totalFiles = count($documentList);
        foreach ($additionalSubDirs as $dir) {
            $sourcePath = "$clientDir/$toZipFoldername/$dir";
            if (file_exists($sourcePath)) {
                $totalFiles += count(glob("$sourcePath/*"));
            }
        }
        foreach ($securedDirectories as $dir) {
            $sourcePath = "$clientDir/$toZipFoldername/$dir";
            if (file_exists($sourcePath)) {
                $totalFiles += count(glob("$sourcePath/*"));
            }
        }

        $sourceFolder = "$clientDir/$toZipFoldername";
        $metadata = [
            "totalFiles" => $totalFiles,
            "clientId" => $clientId
        ];

        $this->addFolderToZip($sourceFolder, $zip, strlen($sourceFolder) + 1, $metadata);
        $zip->close();

        $downloadPath = "documents/$clientId/$zippedFilename";
        $this->updateProgress($clientId, 100, $downloadPath);

        // Cleanup
        $this->cleanTempDirectory("$clientDir/$toZipFoldername");

        return $downloadPath;
    }

    /**
     * Generate a zip file of all uploaded docs for a client.
     * @param mixed $clientId
     * @param mixed $documentList
     * @return string
     */
    public function getZipFileForClient($clientId, $documentList)
    {
        $clientInfo = \App\Models\User::getClientInfo($clientId);
        $clientName = str_replace(' ', '_', $clientInfo['client_fullname']);

        $clientDir = public_path() ."/documents/".$clientId;
        if (!File::exists($clientDir)) {
            File::makeDirectory($clientDir, 0777, true);
        }

        $profitlossZipPath = (new DoctoZipFileScheduler())->getProfitLossZipFileforClient($clientId, true);

        $toZipFoldername = "formatted_docs";
        $zippedFilename = $clientName . "_BKQ_Uploaded_Docs.zip";
        $zipFilePath = "{$clientDir}/$zippedFilename";

        // Clean up previous files
        $this->cleanTempDirectory("$clientDir/$toZipFoldername");
        if (file_exists($zipFilePath)) {
            unlink($zipFilePath);
        }

        // Recreate directories
        if (!file_exists($clientDir)) {
            File::makeDirectory($clientDir, 0777, true, true);
        }
        File::makeDirectory("$clientDir/$toZipFoldername", 0777, true, true);

        if (!empty($profitlossZipPath)) {
            $localProfitLossPath = "$clientDir/Company_Profit_Loss.zip";
            $extractPath = "$clientDir/$toZipFoldername/";
            if (!file_exists($extractPath)) {
                mkdir($extractPath, 0755, true);
            }
            $zip = new \ZipArchive();
            if ($zip->open($localProfitLossPath) === true) {
                $zip->extractTo($extractPath);
                $zip->close();
                unlink($localProfitLossPath);
                $companyProfitLossPath = $extractPath . 'Company_Profit_Loss/';
                $debtorsPath = $extractPath . SubFolders::DEBTORS_INCOME_DOCS . '/';
                $codebtorsPath = $extractPath . SubFolders::CODEBTORS_INCOME_DOCS . '/';
                if (!file_exists($debtorsPath)) {
                    mkdir($debtorsPath, 0755, true);
                }
                if (!file_exists($codebtorsPath)) {
                    mkdir($codebtorsPath, 0755, true);
                }
                $debtorFolder = $companyProfitLossPath . 'Debtor Company Profit Loss/';
                if (file_exists($debtorFolder)) {
                    rename($debtorFolder, $debtorsPath . 'Company Profit Loss/');
                }
                $codebtorFolder = $companyProfitLossPath . 'Co-Debtor Company Profit Loss/';
                if (file_exists($codebtorFolder)) {
                    rename($codebtorFolder, $codebtorsPath . 'Company Profit Loss/');
                }
            } else {
                throw new \Exception("Failed to open the zip file: $localProfitLossPath");
            }
        }

        // create subfolders
        $subfolders = [
            SubFolders::ID_SSN_INFO,
            SubFolders::SECURED_DEBTS,
            SubFolders::UNSECURED_DEBTS,
            SubFolders::DEBTORS_INCOME_DOCS,
            SubFolders::CODEBTORS_INCOME_DOCS,
            SubFolders::OTHER_INCOMES,
            SubFolders::TAX_RETURNS,
            SubFolders::BANK_STATEMENTS,
            SubFolders::POST_SUBMISSION,
            SubFolders::MISC_ATTR_DOCUMENTS,
            SubFolders::BROKERAGE_ACCOUNT_DOCS,
            SubFolders::REQUESTED_DOCS,
            SubFolders::RETIREMENT_DOCS,
            SubFolders::PAYPAL_CASH_VENMO_DOCS
        ];

        $BIData = CacheBasicInfo::getBasicInformationData($clientId);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');
        $debtorname = \App\Helpers\ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor");
        $spousename = \App\Helpers\ClientHelper::getDebtorName($clientBasicInfoPartB, "Co-Debtor");
        $attorneydocumentTypes = [];
        $attorney = \App\Models\ClientsAttorney::where("client_id", $clientId)->first();
        if (isset($attorney->attorney_id) && !empty($attorney->attorney_id)) {
            $attorney_id = $attorney->attorney_id;
        }
        $ClientsAssociateId = ClientsAssociate::getAssociateId($clientId);
        $settingsAttorneyId = !empty($ClientsAssociateId) ? $ClientsAssociateId : $attorney_id;
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;

        $attorneyDocuments = \App\Models\AttorneyDocuments::orderBy('id', 'DESC')->where(['attorney_id' => $settingsAttorneyId , 'is_associate' => $is_associate])->get();
        $attorneyDocuments = !empty($attorneyDocuments) ? $attorneyDocuments->toArray() : [];
        $attorneydocumentTypes = array_column($attorneyDocuments, 'document_type');
        $clientBankDocs = \App\Models\ClientDocuments::getClientDocs($clientId);

        $adminDocuments = \App\Models\AdminClientDocuments::orderBy('id', 'asc')->where('client_id', $clientId)->pluck('document_name', 'document_type')->all();
        $adminDocs = \App\Models\ClientDocuments::getAdminRequestedDocumentList($adminDocuments, $clientBankDocs);

        $debtor_employers = \App\Models\AttorneyEmployerInformationToClient::getEmployerList($clientId, $attorney_id, 'debtor');
        $debtor_employers_list = [];
        foreach ($debtor_employers as $item) {
            $debtor_employers_list[$item['id']] = DocumentHelper::validate_dir_name($item['employer_name']);
        }

        $codebtor_employers = \App\Models\AttorneyEmployerInformationToClient::getEmployerList($clientId, $attorney_id, 'codebtor');
        $codebtor_employers_list = [];
        foreach ($codebtor_employers as $item) {
            $codebtor_employers_list[$item['id']] = DocumentHelper::validate_dir_name($item['employer_name']);
        }

        // create sub folder
        foreach ($subfolders as $subfolder) {
            $path = "$clientDir/$toZipFoldername/$subfolder";
            if (!file_exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            if ($subfolder == SubFolders::SECURED_DEBTS) {
                $directories = [
                    $path."/".self::MORTGAGE_DIR,
                    $path."/".self::VEHCILE_DIR,
                    $path."/".self::VEHICLE_INFO,
                    $path."/".self::VEHCILE_REG,
                    $path."/".self::INSURANCE_DOCUMENTS,
                    $path."/Mortgage_property_value",
                    $path."/Autoloan_property_value"
                ];
                foreach ($directories as $dir) {
                    if (!file_exists($dir)) {
                        File::makeDirectory($dir, 0777, true, true);
                    }
                }
            }

            if ($subfolder == SubFolders::UNSECURED_DEBTS) {
                $directories = [
                    $path."/".self::MISC_ATTY_DOCS,
                    $path."/".self::DEBTOR_CREDITOR_REPORT,
                    $path."/".self::CO_DEBTOR_CREDITOR_REPORT
                ];
                foreach ($directories as $dir) {
                    if (!file_exists($dir)) {
                        File::makeDirectory($dir, 0777, true, true);
                    }
                }
            }

            if ($subfolder == SubFolders::MISC_ATTR_DOCUMENTS) {
                self::createSubDire($path, $attorneydocumentTypes, self::MISCELLANEOUS_DOCUMENTS);
            }

            $bankStatements = $clientBankDocs['bank'] ?? [];
            if ($subfolder == SubFolders::BANK_STATEMENTS) {
                self::createSubDire($path, array_keys($bankStatements), '', false);
            }

            $venmo_paypal_cash = $clientBankDocs['venmo_paypal_cash'] ?? [];
            $venmo_paypal_cash = \App\Helpers\ClientHelper::getUpdatedLabelName($debtorname, $spousename, $venmo_paypal_cash, true);
            if ($subfolder == SubFolders::PAYPAL_CASH_VENMO_DOCS) {
                self::createSubDire($path, array_values($venmo_paypal_cash), '', false);
            }

            $brokerageAccount = $clientBankDocs['brokerage_account'] ?? [];
            if ($subfolder == SubFolders::BROKERAGE_ACCOUNT_DOCS) {
                self::createSubDire($path, array_keys($brokerageAccount), '', false);
            }

            $retirement_pension = $clientBankDocs['retirement_pension'] ?? [];
            if ($subfolder == SubFolders::RETIREMENT_DOCS) {
                self::createSubDire($path, array_keys($retirement_pension), '', false);
            }

            $unpaid_wages = $clientBankDocs['unpaid_wages'] ?? [];
            $unpaid_wages = \App\Helpers\ClientHelper::getUpdatedLabelName($debtorname, $spousename, $unpaid_wages, true);
            if ($subfolder == SubFolders::OTHER_INCOMES) {
                self::createSubDire($path, array_values($unpaid_wages), '', false);
            }

            if ($subfolder == SubFolders::REQUESTED_DOCS) {
                self::createSubDire($path, $adminDocs, '', false);
            }

            if ($subfolder == SubFolders::DEBTORS_INCOME_DOCS) {
                if (is_array($debtor_employers_list) && !empty($debtor_employers_list)) {
                    self::createSubDire($path, array_values($debtor_employers_list), 'Employer_Not_assisgned', false);
                }
            }

            if ($subfolder == SubFolders::CODEBTORS_INCOME_DOCS) {
                if (is_array($codebtor_employers_list) && !empty($codebtor_employers_list)) {
                    self::createSubDire($path, array_values($codebtor_employers_list), 'Employer_Not_assisgned', false);
                }
            }
        }

        $debtor_paystubs_list = \App\Models\PayStubs::where(['pinwheel_account_type' => 'self', 'client_id' => $clientId])->pluck('employer_id', 'document_id');
        $codebtor_paystubs_list = \App\Models\PayStubs::where(['pinwheel_account_type' => 'spouse', 'client_id' => $clientId])->pluck('employer_id', 'document_id');

        $taxReturns = ClientDocumentUploaded::getCommonDocumentForAttorney($attorney_id);
        $bankDocList = [];
        $taxDocList = [];
        $docNum = 1;
        $bankDocs = \App\Models\ClientDocuments::getAllBankDocumentKeysList($clientId);
        foreach ($documentList as $doc) {
            $allPaths = $this->getNewFolderPath($clientInfo, $doc, $docNum, $clientId, $debtorname, $spousename, $attorneydocumentTypes, $clientBankDocs, $adminDocs, $debtor_paystubs_list, $codebtor_paystubs_list, $debtor_employers_list, $codebtor_employers_list, $taxReturns);
            if (empty($allPaths)) {
                continue;
            }

            $pathsToProcess = is_array($allPaths) ? $allPaths : [$allPaths];

            foreach ($pathsToProcess as $newPath) {
                $localFilePath = "$clientDir/$toZipFoldername/$newPath";
                $directoryPath = dirname($localFilePath);

                if (in_array($doc['document_type'], $bankDocs)) {
                    $bankDocList[$doc['document_type']][$doc['document_month']][] = [
                        'document_month' => $doc['document_month'],
                        'localFilePath' => $localFilePath,
                        'directoryPath' => $directoryPath,
                        'new_path' => $newPath,
                        'sort_order' => $doc['sort_order'],
                        'document_type' => $doc['document_type'],
                        'updated_name' => $doc['updated_name']
                    ];
                    foreach ($bankDocList as $documentType => &$months) {
                        foreach ($months as $month => &$docs) {
                            usort($docs, function ($a, $b) {
                                return $a['sort_order'] <=> $b['sort_order'];
                            });
                        }
                    }
                    unset($months);
                }

                if (in_array($doc['document_type'], array_keys($taxReturns))) {
                    $taxDocList[$doc['document_type']][] = [
                        'localFilePath' => $localFilePath,
                        'directoryPath' => $directoryPath,
                        'new_path' => $newPath,
                        'sort_order' => $doc['sort_order'],
                        'document_type' => $doc['document_type'],
                        'updated_name' => $taxReturns[$doc['document_type']]
                    ];
                }

                if (!is_dir($directoryPath)) {
                    File::makeDirectory($directoryPath, 0777, true, true);
                }
                try {
                    if (Storage::disk('s3')->exists($doc['document_file'])) {
                        $fileContent = Storage::disk('s3')->get($doc['document_file']);
                        if ($fileContent) {
                            $writeResult = @file_put_contents($localFilePath, $fileContent);
                            if ($writeResult === false) {
                                throw new \Exception("Failed to write file at path: $localFilePath");
                            }
                        }
                    }
                } catch (\Exception $e) {
                    // Log error if needed
                }
                $docNum++;
            }
        }

        // Trustee Docs
        $additionalSubDir = "Trustee Docs";
        $additionalSubDirPath = "$clientDir/$toZipFoldername/$additionalSubDir";
        if (!file_exists($additionalSubDirPath)) {
            File::makeDirectory($additionalSubDirPath, 0777, true, true);
        }
        $additionalSubDirs = [
            SubFolders::ID_SSN_INFO,
            SubFolders::TAX_RETURNS,
            SubFolders::BANK_STATEMENTS,
        ];
        $path = SubFolders::SECURED_DEBTS;
        $securedDirectories = [
            $path."/".self::MORTGAGE_DIR,
            $path."/".self::VEHCILE_DIR,
            $path."/".self::VEHICLE_INFO,
            $path."/".self::VEHCILE_REG,
            $path.'/'.self::RENTAL_AGREEMENT,
            $path.'/'.self::VEHICLE_TITLE
        ];

        // Recursively copy all files to destination (flat structure)
        $copyAllFilesFlat = function ($sourcePath, $destinationPath) use (&$copyAllFilesFlat) {
            if (!file_exists($sourcePath)) {
                return;
            }
            $items = scandir($sourcePath);
            foreach ($items as $item) {
                if ($item === '.' || $item === '..') {
                    continue;
                }
                $source = "$sourcePath/$item";
                if (is_dir($source)) {
                    $copyAllFilesFlat($source, $destinationPath);
                } else {
                    $destFile = "$destinationPath/$item";
                    $counter = 1;
                    while (file_exists($destFile)) {
                        $info = pathinfo($item);
                        $destFile = "$destinationPath/{$info['filename']}_$counter.{$info['extension']}";
                        $counter++;
                    }
                    copy($source, $destFile);
                }
            }
        };
        foreach ($securedDirectories as $dir) {
            $sourcePath = "$clientDir/$toZipFoldername/$dir";
            $copyAllFilesFlat($sourcePath, $additionalSubDirPath);
        }
        // --- ZIP CREATION ---
        $zip = new ZipArchive();
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new \Exception("Failed to create zip file at $zipFilePath");
        }

        // Do NOT set compression index here. Let ZipArchive decide.
        // $zip->setCompressionIndex(0, ZipArchive::CM_STORE); // REMOVE THIS LINE

        // Add files/folders recursively
        $totalFiles = count($documentList);
        $additionalFilesCount = 0;
        foreach ($additionalSubDirs as $dir) {
            $sourcePath = "$clientDir/$toZipFoldername/$dir";
            if (file_exists($sourcePath)) {
                $additionalFilesCount += count(glob("$sourcePath/*"));
            }
        }
        foreach ($securedDirectories as $dir) {
            $sourcePath = "$clientDir/$toZipFoldername/$dir";
            if (file_exists($sourcePath)) {
                $additionalFilesCount += count(glob("$sourcePath/*"));
            }
        }
        $totalFiles += $additionalFilesCount;

        $sourceFolder = "$clientDir/$toZipFoldername";
        $metadata = [
            "totalFiles" => $totalFiles,
            "clientId" => $clientId
        ];
        $this->addFolderToZip($sourceFolder, $zip, strlen($sourceFolder) + 1, $metadata);

        // Ensure the zip is finalized and written to disk
        $zip->close();

        // Final progress update
        $downloadPath = "documents/$clientId/$zippedFilename";
        $this->updateProgress($clientId, 100, $downloadPath);

        // cleanup
        $this->cleanTempDirectory("$clientDir/$toZipFoldername");

        return $downloadPath;
    }

    /**
     * Recursively copy a directory to a new location.
     *
     * @param string $source      Path to the source directory.
     * @param string $destination Path to the destination directory.
     */
    private function copyDirectory($source, $destination)
    {
        if (!file_exists($destination)) {
            File::makeDirectory($destination, 0777, true, true);
        }

        $dir = opendir($source);
        while (($file = readdir($dir)) !== false) {
            if ($file != '.' && $file != '..') {
                $sourceFile = "$source/$file";
                $destinationFile = "$destination/$file";

                if (is_dir($sourceFile)) {
                    // Recursively copy subdirectories
                    $this->copyDirectory($sourceFile, $destinationFile);
                } else {
                    // Copy files
                    copy($sourceFile, $destinationFile);
                }
            }
        }
        closedir($dir);
    }

    /**
     * Add a folder to a zip object recursively
     *
     * @param mixed $folder
     * @param mixed $zip
     * @param mixed $baseLength
     * @param mixed $metadata
     * @return void
     */
    public function addFolderToZip($folder, $zip, $baseLength, $metadata)
    {
        $files = scandir($folder);

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $filePath = $folder . DIRECTORY_SEPARATOR . $file;
            // \Log::info('File path: ' . $filePath);
            if (is_dir($filePath)) {
                // Add folder and its contents
                $this->addFolderToZip($filePath, $zip, $baseLength, $metadata);
                //\Log::info('adding file to zip: ' . $filePath);
            } else {
                // Add file to the zip archive
                $relativePath = substr($filePath, $baseLength);
                $zip->addFile($filePath, $relativePath);

                // Update progress in the database
                $progress = intval(($this->currentProgressIndex / $metadata['totalFiles']) * 100);
                //\Log::info('in progress: ' . $filePath.' progress'.$progress);
                $this->updateProgress(
                    $metadata['clientId'],
                    $progress,
                    basename($filePath)
                );

                $this->currentProgressIndex++;
            }
        }
    }

    /**
     * Get the progress of a zip file job.
     *
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function getProgress(Request $request)
    {
        $clientId = $request->client_id;

        $progress = DoctoZipFileScheduler::where('client_id', $clientId)->sharedLock()->first();

        if ($progress) {
            return response()->json([
                'progress' => $progress->completion_percentage,
                'current_file' => $progress->downloadable_path,
            ]);
        }

        return response()->json(['error' => 'No progress found'], 404);
    }

    /**
     * Get a file from s3
     *
     * @param mixed $documentFile
     * @param mixed $clientId
     * @return string
     */
    private function getFileFromS3($documentFile, $clientId)
    {
        $filePath = Storage::disk('s3')->url($documentFile);

        return $filePath;
    }

    /**
     * Update the progress of a zip job.
     *
     * @param mixed $clientId
     * @param mixed $progress
     * @param mixed $currentFile
     * @return void
     */
    private function updateProgress($clientId, $progress, $currentFile)
    {
        $values = [
            'downloadable_path' => $currentFile,
            'scheduler_start_at' => date("Y-m-d H:i:s"),
            'completion_percentage' => ($progress > 100 ? 100 : $progress),
            'job_status' => $progress == 100 ? self::STATUS_COMPLETED : self::STATUS_INPROGRESS,
            'is_completed' => $progress == 100 ? 1 : 0,
        ];

        DoctoZipFileScheduler::updateOrCreate(
            ['client_id' => $clientId],
            $values,
        )->lockForUpdate();
    }


    /**
    * Get the new folder path of a document based on document type
    *
    * @param array $clientInfo
    * @param array $doc
    * @param int $docNum
    * @return string
    */
    private function getScheduleNewFolderPath($clientInfo, $doc, $docNum, $clientId, $debtorname, $spousename, $attorneydocumentTypes, $clientBankDocs, $adminDocs, $debtor_paystubs_list, $codebtor_paystubs_list, $debtor_employers_list, $codebtor_employers_list, $taxReturns)
    {

        $clientName = str_replace(' ', '_', $clientInfo['client_fullname']);
        $coDebtorName = str_replace(' ', '_', $clientInfo['co-debtor_fullname']);

        $newPath = "";


        // check clean document_type values
        switch ($doc['document_type']) {
            case ClientDocumentUploaded::DRIVING_LIC:
                $newPath = [
                    SubFolders::SCH_PETITION.'/'. self::DEBTOR_DL_INFO . "/$clientName.Drivers_Lic._Gov_ID.pdf",
                    SubFolders::TRUSTEE_DOCS .'/'. self::DEBTOR_DL_INFO. "/$clientName.Drivers_Lic._Gov_ID.pdf"
                ];
                break;
            case ClientDocumentUploaded::CO_DEBTOR_DRIVING_LIC:
                $newPath = [
                    SubFolders::SCH_PETITION.'/'. self::CO_DEBTOR_DL_INFO . "/$coDebtorName.Drivers_Lic._Gov_ID.pdf",
                    SubFolders::TRUSTEE_DOCS .'/'. self::CO_DEBTOR_DL_INFO. "/$clientName.Drivers_Lic._Gov_ID.pdf"
                ];
                break;
            case ClientDocumentUploaded::SOCIAL_SECURITY_CARD:
                $newPath = [
                    SubFolders::SCH_PETITION .'/'. self::DEBTOR_SSN_INFO. "/$clientName.Social_Security_Card_ITIN.pdf",
                    SubFolders::TRUSTEE_DOCS .'/'. self::SN_INFO. "/$clientName.Social_Security_Card_ITIN.pdf"
                ];
                break;
            case ClientDocumentUploaded::CO_DEBTOR_SECURITY_CARD:
                $newPath = [
                    SubFolders::SCH_PETITION .'/'. self::CO_DEBTOR_SSN_INFO . "/$coDebtorName.Social_Security_Card_ITIN.pdf",
                    SubFolders::TRUSTEE_DOCS .'/'. self::SN_INFO. "/$coDebtorName.Social_Security_Card_ITIN.pdf"
                ];
                break;
            case 'Pre_Filing_Bankruptcy_Certificate_CCC':
                $newPath = SubFolders::SCH_PETITION .'/'. self::DEBTOR_CREDIT_COUNCELING . "/$clientName.Pre_Filing_Bankruptcy_Certificate_CCC.pdf";
                break;
            case ClientDocumentUploaded::DEBTOR_PAY_STUB:
                $subDire = '';
                if (isset($debtor_paystubs_list[$doc['id']]) && !empty($debtor_paystubs_list[$doc['id']])) {
                    $subDire = $debtor_employers_list[$debtor_paystubs_list[$doc['id']]] ?? $subDire;
                }
                $paystubDate = $doc['document_paystub_date'] ?? $doc['updated_name'] ?? $docNum;
                $newPath = !empty($subDire) ? SubFolders::SCH_I_J_MT_INCOME.'/'.SubFolders::PAY_STUBS . "/".$subDire.'/'. $paystubDate . ".pdf" : "";
                break;
            case ClientDocumentUploaded::CO_DEBTOR_PAY_STUB:
                $subDire = '';

                if (isset($codebtor_paystubs_list[$doc['id']]) && !empty($codebtor_paystubs_list[$doc['id']])) {
                    $subDire = $codebtor_employers_list[$codebtor_paystubs_list[$doc['id']]] ?? $subDire;
                }

                $paystubDate = $doc['document_paystub_date'] ?? $doc['updated_name'] ?? $docNum;
                $newPath = !empty($subDire) ? SubFolders::SCH_I_J_MT_INCOME.'/'.SubFolders::PAY_STUBS . "/".$subDire.'/'.$paystubDate . ".pdf" : "";
                break;

            case 'Current_Mortgage_Statement_1_1':
            case 'Current_Mortgage_Statement_2_1':
            case 'Current_Mortgage_Statement_3_1':
            case 'Current_Mortgage_Statement_1_2':
            case 'Current_Mortgage_Statement_2_2':
            case 'Current_Mortgage_Statement_3_2':
            case 'Current_Mortgage_Statement_1_3':
            case 'Current_Mortgage_Statement_2_3':
            case 'Current_Mortgage_Statement_3_3':
            case 'Current_Mortgage_Statement_1_4':
            case 'Current_Mortgage_Statement_2_4':
            case 'Current_Mortgage_Statement_3_4':
            case 'Current_Mortgage_Statement_1_5':
            case 'Current_Mortgage_Statement_2_5':
            case 'Current_Mortgage_Statement_3_5':
                $clientPropertyData = CacheProperty::getPropertyData($clientId);
                $clientProperty = Helper::validate_key_value('propertyresident', $clientPropertyData, 'array');
                $clientProperty = !empty($clientProperty) ? $clientProperty->where('currently_lived', '1') : [];

                $clientDebtorResidentDocumentList = DocumentHelper::getClientDebtorResidentDocumentList($clientProperty, true, true, true);
                $mortgageUpdatedNames = $clientDebtorResidentDocumentList['mortgageUpdatedNames'] ?? [];
                //$mortgageCompanyName = $doc['updated_name'] ?? $clientName . ".$docNum";

                $mortgageCompanyName = $mortgageUpdatedNames[$doc['document_type']] ?? '';
                $newPath = !empty($mortgageCompanyName) ? SubFolders::SCH_AB_RESIDENCE . "/".self::MORTGAGE_DIR."/$mortgageCompanyName.pdf" : '';
                // $second = !empty($mortgageCompanyName) ? SubFolders::SCH_J . "/".self::MORTGAGE_DIR."/$mortgageCompanyName.pdf" : '';
                $newPath = [$newPath];
                break;
            case ClientDocumentUploaded::VEHICLE_INFORMATION:
                $filename = $doc['updated_name'] ?? "$clientName.Vehicle_information_$docNum";
                $newPath = SubFolders::SCH_AB_VEHICLES ."/".self::VEHICLE_INFO. "/$filename.pdf";
                break;
            case ClientDocumentUploaded::INSURANCE_DOCUMENTS:
                $filename = $doc['updated_name'] ?? "$clientName.Insurance_docs_$docNum";
                $newPath = SubFolders::SCH_AB_VEHICLES ."/".self::INSURANCE_DOCUMENTS. "/$filename.pdf";
                break;
            case ClientDocumentUploaded::LAST_YR_TAX_RETURNS:
            case ClientDocumentUploaded::PRIOR_YR_TAX_RETURNS:
            case ClientDocumentUploaded::PRIOR_YR_TWO_TAX_RETURNS:
            case ClientDocumentUploaded::PRIOR_YR_THREE_TAX_RETURNS:
            case ClientDocumentUploaded::W2_LAST_YEAR:
            case ClientDocumentUploaded::W2_YEAR_BEFORE:
                $subDire = $taxReturns[$doc['document_type']];
                $taxYear = $doc['updated_name'];
                $newPath = [
                    SubFolders::SCH_AB_TAXES ."/".$subDire. "/$taxYear.pdf",
                    SubFolders::TRUSTEE_DOCS ."/".$subDire. "/$taxYear.pdf"
                ];
                break;
            case ClientDocumentUploaded::MISCELLANEOUS_DOCUMENTS:
                $filename = $doc['updated_name'] ?? "Misc_$docNum";
                $newPath = SubFolders::MISC_ATTR_DOCUMENTS.'/'. self::MISCELLANEOUS_DOCUMENTS . "/$filename.pdf";
                break;

            case ClientDocumentUploaded::DEBTOR_CREDITOR_REPORT:
                $filename = $doc['updated_name'] ?? "Creditor_Report_$docNum";
                $newPath = SubFolders::REQUESTED_DOCS .'/'.self::CREDIT_REPORT. "/$filename.pdf";
                break;
            case ClientDocumentUploaded::CO_DEBTOR_CREDITOR_REPORT:
                $filename = $doc['updated_name'] ?? "Creditor_Report_$docNum";
                $newPath = SubFolders::REQUESTED_DOCS .'/'.self::CREDIT_REPORT. "/$filename.pdf";
                break;

            case ClientDocumentUploaded::OTHER_MISC_DOCUMENTS:
                $filename = $doc['updated_name'] ?? "$clientName.Misc_$docNum";
                $newPath = SubFolders::UNSECURED_DEBTS.'/'.self::MISC_ATTY_DOCS . "/$filename.pdf";
                break;

            case ClientDocumentUploaded::POST_SUBMISSION_DOCUMENTS:
                $filename = $doc['updated_name'] ?? "$clientName.Post_Submission_$docNum";
                $newPath = SubFolders::POST_SUBMISSION . "/$filename.pdf";
                break;
            default:
                if ($newPath == "") {
                    $newPath = "$clientName." . $doc['document_type'] . "_" . $doc['updated_name'] .".pdf";
                }
                break;
        }

        $rental_agreement = $clientBankDocs['rental_agreement'] ?? [];
        $vehicle_title = $clientBankDocs['vehicle_title'] ?? [];

        $vehicleCondition = str_starts_with($doc['document_type'], 'Current_Auto_Loan_Statement')
            || str_starts_with($doc['document_type'], 'Other_Loan_Statement')
            || str_starts_with($doc['document_type'], 'Autoloan_property_value')
            || (!empty($vehicle_title) && in_array($doc['document_type'], array_keys($vehicle_title)))
            || str_starts_with($doc['document_type'], 'Vehicle_Registration');

        if ($vehicleCondition) {
            $clientDebtorVehiclesDocumentList = DocumentHelper::getClientDebtorVehiclesDocumentListWithHeading($clientId, true, true, true);
            $vehicleData = $clientDebtorVehiclesDocumentList['vehicleData'] ?? [];
            $vehicleUpdatedNames = $clientDebtorVehiclesDocumentList['vehicleUpdatedNames'] ?? [];

            $newPathArray = [];
            if (is_array($vehicleData)) {
                foreach ($vehicleData as $vehicleType => $singleVehicleData) {
                    $vFolderName = 'Vehicle';
                    if (str_starts_with($vehicleType, 'vehicle_statement_')) {
                        $vFolderName = 'Vehicle #'.str_replace('vehicle_statement_', '', $vehicleType);
                    }
                    if (str_starts_with($vehicleType, 'recreational_statement_')) {
                        $vFolderName = 'Recreational #'.str_replace('recreational_statement_', '', $vehicleType);
                    }
                    if (!empty($singleVehicleData) && is_array($vehicleData)) {
                        foreach ($singleVehicleData as $documentType => $documentTypeName) {
                            if (str_starts_with($documentType, 'Autoloan_property_value') && ($documentType == $doc['document_type'])) {
                                $filename = $doc['updated_name'] ?? "$clientName.Autoloan_property_value_$docNum";
                                $newPathArray[] = SubFolders::SCH_AB_VEHICLES  . "/".$vFolderName . "/$filename.pdf";
                            }
                            if ((str_starts_with($documentType, 'Current_Auto_Loan_Statement') && ($documentType == $doc['document_type']))
                             || (str_starts_with($documentType, 'Other_Loan_Statement') && ($documentType == $doc['document_type']))) {
                                $filename = Helper::validate_key_value($documentType, $vehicleUpdatedNames);
                                $newPathArray[] = !empty($filename) ? SubFolders::SCH_AB_VEHICLES . "/".$vFolderName. "/$filename.pdf" : '';
                            }
                            if (!empty($vehicle_title) && in_array($doc['document_type'], array_keys($vehicle_title)) && ($documentType == $doc['document_type'])) {
                                $filename = $doc['updated_name'] ?? "Vehicle_title_$docNum";
                                $newPathArray[] = SubFolders::SCH_AB_VEHICLES.'/'.$vFolderName."/$filename.pdf";
                            }
                            if (str_starts_with($documentType, 'Vehicle_Registration') && ($documentType == $doc['document_type'])) {
                                $filename = $doc['updated_name'] ?? "$clientName.Vehicle_registration_$docNum";
                                $newPathArray[] = SubFolders::SCH_AB_VEHICLES.'/'.$vFolderName."/$filename.pdf";
                            }
                        }
                    }
                }
            }
            $newPath = $newPathArray;

        }

        if (str_starts_with($doc['document_type'], 'Mortgage_property_value')) {
            $filename = $doc['updated_name'] ?? "$clientName.Mortgage_property_value_$docNum";
            $newPath = SubFolders::SCH_AB_RESIDENCE ."/Mortgage_property_value". "/$filename.pdf";
        }

        if (!empty($rental_agreement) && in_array($doc['document_type'], array_keys($rental_agreement))) {
            $filename = $doc['updated_name'] ?? "Rental_Agreement_$docNum";
            $newPath = SubFolders::SCH_AB_RESIDENCE.'/'.self::RENTAL_AGREEMENT . "/$filename.pdf";
        }


        if (in_array($doc['document_type'], $attorneydocumentTypes)) {
            $filename = $doc['updated_name'] ?? "Attorney_Docs_$docNum";
            // Truncate document_type if it exceeds 100 characters to avoid Windows path length issues
            $docType = $doc['document_type'];
            if (strlen($docType) > 100) {
                $docType = substr($docType, 0, 100);
            }
            $newPath = SubFolders::MISC_ATTR_DOCUMENTS . '/' . $docType . "/$filename.pdf";
        }

        $bankStatements = $clientBankDocs['bank'] ?? [];
        if (!empty($bankStatements) && in_array($doc['document_type'], array_keys($bankStatements))) {
            $filename = $doc['updated_name'] ?? "Attorney_Docs_$docNum";
            $newPath = SubFolders::SCH_AB.'/'.SubFolders::BANK_STATEMENTS.'/'.$doc['document_type'] . "/$filename.pdf";
        }

        $venmo_paypal_cash = $clientBankDocs['venmo_paypal_cash'] ?? [];
        $venmo_paypal_cash = \App\Helpers\ClientHelper::getUpdatedLabelName($debtorname, $spousename, $venmo_paypal_cash, true);
        if (!empty($venmo_paypal_cash) && in_array($doc['document_type'], array_keys($venmo_paypal_cash))) {
            $filename = $doc['updated_name'] ?? "$docNum";
            $subDir = $venmo_paypal_cash[$doc['document_type']];
            $newPath = SubFolders::SCH_AB.'/'.SubFolders::PAYPAL_CASH_VENMO_DOCS.'/'.$subDir . "/$filename.pdf";
        }

        $brokerageAccount = $clientBankDocs['brokerage_account'] ?? [];
        if (!empty($brokerageAccount) && in_array($doc['document_type'], array_keys($brokerageAccount))) {
            $filename = $doc['updated_name'] ?? "$docNum";
            $subDir = $doc['document_type'];
            $newPath = SubFolders::SCH_AB.'/'.SubFolders::BROKERAGE_ACCOUNT_DOCS.'/'.$subDir  . "/$filename.pdf";
        }


        $lifeInsuDocs = $clientBankDocs['life_insurance'] ?? [];
        if (!empty($lifeInsuDocs) && in_array($doc['document_type'], array_keys($lifeInsuDocs))) {
            $filename = $doc['updated_name'] ?? "$docNum";
            $subDir = $doc['document_type'];
            $newPath = SubFolders::SCH_AB.'/'.SubFolders::LIFE_INSURANCE_DOCS.'/'.$subDir  . "/$filename.pdf";
        }


        $retirement_pension = $clientBankDocs['retirement_pension'] ?? [];
        if (!empty($retirement_pension) && in_array($doc['document_type'], array_keys($retirement_pension))) {
            $filename = $doc['updated_name'] ?? "$docNum";
            $subDir = $doc['document_type'];
            $newPath = SubFolders::SCH_AB.'/'.SubFolders::RETIREMENT_DOCS.'/'.$subDir  . "/$filename.pdf";
        }

        if (!empty($adminDocs) && in_array($doc['document_type'], $adminDocs)) {
            $filename = $doc['updated_name'] ?? "$docNum";
            $subDire = $doc['document_type'];
            $newPath = SubFolders::REQUESTED_DOCS.'/'.$subDire  . "/$filename.pdf";
        }

        $unpaid_wages = $clientBankDocs['unpaid_wages'] ?? [];
        $unpaid_wages = \App\Helpers\ClientHelper::getUpdatedLabelName($debtorname, $spousename, $unpaid_wages, true);
        if (!empty($unpaid_wages) && in_array($doc['document_type'], array_keys($unpaid_wages))) {
            $filename = $doc['updated_name'] ?? "$docNum";
            $subDir = $unpaid_wages[$doc['document_type']];
            $newPath = SubFolders::SCH_I_J_MT_INCOME.'/'.SubFolders::OTHER_INCOMES.'/'.$subDir  . "/$filename.pdf";
        }
        //return $newPath;

        return $this->truncatePathIfNeeded($newPath);
    }

    private function truncatePathIfNeeded($path)
    {
        // Maximum allowed path length
        $maxPathLength = 180;

        // Truncate helper
        $truncateString = function ($str, $maxLen) {
            return mb_strlen($str) > $maxLen ? mb_substr($str, 0, $maxLen) : $str;
        };

        // Only truncate if path is a string and too long
        if (is_string($path) && strlen($path) > $maxPathLength) {
            $info = pathinfo($path);
            $filename = $truncateString($info['filename'], 40);
            $dirname = $truncateString($info['dirname'], 120);
            $extension = isset($info['extension']) ? '.' . $info['extension'] : '';

            return $dirname . '/' . $filename . $extension;
        }

        return $path;
    }


    public static function startsWithValidYear($string)
    {
        if (preg_match('/^\d{4}/', $string)) {
            $year = intval(substr($string, 0, 4));
            $currentYear = intval(date("Y")) + 1;

            return $year >= 1900 && $year <= $currentYear;
        }

        return false;
    }

    /**
     * Get the new folder path of a document based on document type
     *
     * @param array $clientInfo
     * @param array $doc
     * @param int $docNum
     * @return string
     */
    private function getNewFolderPath($clientInfo, $doc, $docNum, $clientId, $debtorname, $spousename, $attorneydocumentTypes, $clientBankDocs, $adminDocs, $debtor_paystubs_list, $codebtor_paystubs_list, $debtor_employers_list, $codebtor_employers_list, $taxReturns)
    {

        $clientName = str_replace(' ', '_', $clientInfo['client_fullname']);
        $coDebtorName = str_replace(' ', '_', $clientInfo['co-debtor_fullname']);
        $newPath = "";
        // check clean document_type values
        switch ($doc['document_type']) {
            case ClientDocumentUploaded::DRIVING_LIC:
                $newPath = [
                    SubFolders::ID_SSN_INFO . "/$clientName.Drivers_Lic._Gov_ID.pdf",
                    SubFolders::TRUSTEE_DOCS . "/$clientName.Drivers_Lic._Gov_ID.pdf",
                ];

                break;
            case ClientDocumentUploaded::CO_DEBTOR_DRIVING_LIC:
                $newPath = [
                    SubFolders::ID_SSN_INFO . "/$coDebtorName.Drivers_Lic._Gov_ID.pdf",
                    SubFolders::TRUSTEE_DOCS . "/$coDebtorName.Drivers_Lic._Gov_ID.pdf"
                ];

                break;
            case ClientDocumentUploaded::SOCIAL_SECURITY_CARD:
                $newPath = [
                    SubFolders::ID_SSN_INFO."/$clientName.Social_Security_Card_ITIN.pdf",
                    SubFolders::TRUSTEE_DOCS ."/$clientName.Social_Security_Card_ITIN.pdf"
                ];

                break;
            case ClientDocumentUploaded::CO_DEBTOR_SECURITY_CARD:
                $newPath = [
                    SubFolders::ID_SSN_INFO."/$coDebtorName.Social_Security_Card_ITIN.pdf",
                    SubFolders::TRUSTEE_DOCS ."/$coDebtorName.Social_Security_Card_ITIN.pdf"
                ];

                break;
            case ClientDocumentUploaded::DEBTOR_PAY_STUB:
                $subDire = '';
                if (isset($debtor_paystubs_list[$doc['id']]) && !empty($debtor_paystubs_list[$doc['id']])) {
                    $subDire = $debtor_employers_list[$debtor_paystubs_list[$doc['id']]] ?? $subDire;
                }
                $paystubDate = $doc['document_paystub_date'] ?? $doc['updated_name'] ?? $docNum;
                $newPath = !empty($subDire) ? SubFolders::DEBTORS_INCOME_DOCS . "/".$subDire.'/'. $paystubDate . ".pdf" : "";
                break;
            case ClientDocumentUploaded::CO_DEBTOR_PAY_STUB:
                $subDire = '';

                if (isset($codebtor_paystubs_list[$doc['id']]) && !empty($codebtor_paystubs_list[$doc['id']])) {
                    $subDire = $codebtor_employers_list[$codebtor_paystubs_list[$doc['id']]] ?? $subDire;
                }

                $paystubDate = $doc['document_paystub_date'] ?? $doc['updated_name'] ?? $docNum;
                $newPath = !empty($subDire) ? SubFolders::CODEBTORS_INCOME_DOCS . "/".$subDire.'/'.$paystubDate . ".pdf" : "";
                break;
            case "Current_Auto_Loan_Statement_1":
            case "Current_Auto_Loan_Statement_2":
            case "Current_Auto_Loan_Statement_3":
            case "Current_Auto_Loan_Statement_4":
            case "Other_Loan_Statement_1":
            case "Other_Loan_Statement_2":

                $clientDebtorVehiclesDocumentList = DocumentHelper::getClientDebtorVehiclesDocumentList($clientId, true);
                $vehicleUpdatedNames = $clientDebtorVehiclesDocumentList['vehicleUpdatedNames'] ?? [];
                //$autoLoanName = $doc['updated_name'] ?? $clientName . ".$docNum";
                $autoLoanName = $vehicleUpdatedNames[$doc['document_type']] ?? '';
                $newPath = !empty($autoLoanName) ? SubFolders::SECURED_DEBTS . "/".self::VEHCILE_DIR. "/$autoLoanName.pdf" : '';
                break;
            case 'Current_Mortgage_Statement_1_1':
            case 'Current_Mortgage_Statement_2_1':
            case 'Current_Mortgage_Statement_3_1':
            case 'Current_Mortgage_Statement_1_2':
            case 'Current_Mortgage_Statement_2_2':
            case 'Current_Mortgage_Statement_3_2':
            case 'Current_Mortgage_Statement_1_3':
            case 'Current_Mortgage_Statement_2_3':
            case 'Current_Mortgage_Statement_3_3':
            case 'Current_Mortgage_Statement_1_4':
            case 'Current_Mortgage_Statement_2_4':
            case 'Current_Mortgage_Statement_3_4':
            case 'Current_Mortgage_Statement_1_5':
            case 'Current_Mortgage_Statement_2_5':
            case 'Current_Mortgage_Statement_3_5':
                $clientPropertyData = CacheProperty::getPropertyData($clientId);
                $clientProperty = Helper::validate_key_value('propertyresident', $clientPropertyData, 'array');
                $clientProperty = !empty($clientProperty) ? $clientProperty->where('currently_lived', '1') : [];
                $clientDebtorResidentDocumentList = DocumentHelper::getClientDebtorResidentDocumentList($clientProperty, true, true, true);
                $mortgageUpdatedNames = $clientDebtorResidentDocumentList['mortgageUpdatedNames'] ?? [];
                $mortgageCompanyName = $mortgageUpdatedNames[$doc['document_type']] ?? '';
                $newPath = !empty($mortgageCompanyName) ? SubFolders::SECURED_DEBTS . "/".self::MORTGAGE_DIR."/$mortgageCompanyName.pdf" : '';
                break;
            case ClientDocumentUploaded::VEHICLE_INFORMATION:
                $filename = $doc['updated_name'] ?? "$clientName.Vehicle_information_$docNum";
                $newPath = SubFolders::SECURED_DEBTS ."/".self::VEHICLE_INFO. "/$filename.pdf";
                break;
            case ClientDocumentUploaded::INSURANCE_DOCUMENTS:
                $filename = $doc['updated_name'] ?? "$clientName.Insurance_docs_$docNum";
                $newPath = SubFolders::SECURED_DEBTS ."/".self::INSURANCE_DOCUMENTS. "/$filename.pdf";
                break;
            case ClientDocumentUploaded::LAST_YR_TAX_RETURNS:
            case ClientDocumentUploaded::PRIOR_YR_TAX_RETURNS:
            case ClientDocumentUploaded::PRIOR_YR_TWO_TAX_RETURNS:
            case ClientDocumentUploaded::PRIOR_YR_THREE_TAX_RETURNS:
            case ClientDocumentUploaded::W2_LAST_YEAR:
            case ClientDocumentUploaded::W2_YEAR_BEFORE:

                $subDire = $taxReturns[$doc['document_type']];
                $taxYear = $doc['updated_name'];
                $w2Label = '';
                if (in_array($doc['document_type'], [ClientDocumentUploaded::W2_LAST_YEAR, ClientDocumentUploaded::W2_YEAR_BEFORE])) {
                    if (str_ends_with($taxYear, 'W-2 - Debtor')) {
                        $w2Label = ' W-2 - Debtor';
                    }
                    if (str_ends_with($taxYear, 'W-2 - Co-Debtor')) {
                        $w2Label = ' W-2 - Co-Debtor';
                    }
                }
                $newPath = [
                    SubFolders::TAX_RETURNS ."/".$subDire. "/$taxYear.pdf",
                    SubFolders::TRUSTEE_DOCS ."/$subDire$w2Label.pdf"
                ];

                break;

            case ClientDocumentUploaded::MISCELLANEOUS_DOCUMENTS:
                $filename = $doc['updated_name'] ?? "Misc_$docNum";
                $newPath = SubFolders::MISC_ATTR_DOCUMENTS.'/'. self::MISCELLANEOUS_DOCUMENTS . "/$filename.pdf";
                break;

            case ClientDocumentUploaded::DEBTOR_CREDITOR_REPORT:
                $filename = $doc['updated_name'] ?? "Creditor_Report_$docNum";
                $newPath = SubFolders::UNSECURED_DEBTS .'/'.self::DEBTOR_CREDITOR_REPORT. "/$filename.pdf";
                break;
            case ClientDocumentUploaded::CO_DEBTOR_CREDITOR_REPORT:
                $filename = $doc['updated_name'] ?? "Creditor_Report_$docNum";
                $newPath = SubFolders::UNSECURED_DEBTS .'/'.self::CO_DEBTOR_CREDITOR_REPORT. "/$filename.pdf";
                break;
            case ClientDocumentUploaded::OTHER_MISC_DOCUMENTS:
                $filename = $doc['updated_name'] ?? "$clientName.Misc_$docNum";
                $newPath = SubFolders::UNSECURED_DEBTS.'/'.self::MISC_ATTY_DOCS . "/$filename.pdf";
                break;

            case ClientDocumentUploaded::POST_SUBMISSION_DOCUMENTS:
                $filename = $doc['updated_name'] ?? "$clientName.Post_Submission_$docNum";
                $newPath = SubFolders::POST_SUBMISSION . "/$filename.pdf";
                break;
            default:
                if ($newPath == "") {
                    $newPath = "$clientName." . $doc['document_type'] . "_" . $doc['updated_name'] .".pdf";
                }
                break;
        }


        if (str_starts_with($doc['document_type'], 'Autoloan_property_value')) {
            $filename = $doc['updated_name'] ?? "$clientName.Autoloan_property_value_$docNum";
            $newPath = SubFolders::SECURED_DEBTS ."/Autoloan_property_value". "/$filename.pdf";
        }
        if (str_starts_with($doc['document_type'], 'Mortgage_property_value')) {
            $filename = $doc['updated_name'] ?? "$clientName.Mortgage_property_value_$docNum";
            $newPath = SubFolders::SECURED_DEBTS ."/Mortgage_property_value". "/$filename.pdf";
        }
        if (str_starts_with($doc['document_type'], 'Vehicle_Registration_')) {
            $filename = $doc['updated_name'] ?? "$clientName.Vehicle_registration_$docNum";
            $newPath = SubFolders::SECURED_DEBTS ."/".self::VEHCILE_REG. "/$filename.pdf";
        }

        if (in_array($doc['document_type'], $attorneydocumentTypes)) {
            $filename = $doc['updated_name'] ?? "Attorney_Docs_$docNum";
            // Truncate document_type if it exceeds 100 characters to avoid Windows path length issues
            $docType = $doc['document_type'];
            if (strlen($docType) > 100) {
                $docType = substr($docType, 0, 100);
            }
            $newPath = SubFolders::MISC_ATTR_DOCUMENTS.'/'. $docType . "/$filename.pdf";
        }

        $bankStatements = $clientBankDocs['bank'] ?? [];
        if (!empty($bankStatements) && in_array($doc['document_type'], array_keys($bankStatements))) {

            $docMonth = Helper::validate_key_value('document_month', $doc);
            $year = '';
            if (!empty($docMonth)) {
                $dateObj = DateTime::createFromFormat('n-Y', $docMonth);
                if ($dateObj) {
                    $year = ' ' . $dateObj->format('Y'); // Adds "_2025"
                }
            }

            $filename = $doc['updated_name'] ?? "Attorney_Docs_$docNum";
            $filename .= $year;
            $newPath = [
                SubFolders::BANK_STATEMENTS.'/'.$doc['document_type'] . "/$filename.pdf",
                SubFolders::TRUSTEE_DOCS .'/'.$doc['document_type'] . " $filename.pdf"
            ];

        }

        $vehicle_title = $clientBankDocs['vehicle_title'] ?? [];
        if (!empty($vehicle_title) && in_array($doc['document_type'], array_keys($vehicle_title))) {
            $filename = $doc['updated_name'] ?? "Vehicle_title_$docNum";
            $newPath = SubFolders::SECURED_DEBTS.'/'.self::VEHICLE_TITLE.'/'.$doc['document_type'] . "/$filename.pdf";
        }

        $rental_agreement = $clientBankDocs['rental_agreement'] ?? [];
        if (!empty($rental_agreement) && in_array($doc['document_type'], array_keys($rental_agreement))) {
            $filename = $doc['updated_name'] ?? "Rental_Agreement_$docNum";
            $newPath = SubFolders::SECURED_DEBTS.'/'.self::RENTAL_AGREEMENT . "/$filename.pdf";
        }


        $venmo_paypal_cash = $clientBankDocs['venmo_paypal_cash'] ?? [];
        $venmo_paypal_cash = \App\Helpers\ClientHelper::getUpdatedLabelName($debtorname, $spousename, $venmo_paypal_cash, true);
        if (!empty($venmo_paypal_cash) && in_array($doc['document_type'], array_keys($venmo_paypal_cash))) {
            $filename = $doc['updated_name'] ?? "$docNum";
            $subDir = $venmo_paypal_cash[$doc['document_type']];
            $newPath = SubFolders::PAYPAL_CASH_VENMO_DOCS.'/'.$subDir . "/$filename.pdf";
        }

        $brokerageAccount = $clientBankDocs['brokerage_account'] ?? [];
        if (!empty($brokerageAccount) && in_array($doc['document_type'], array_keys($brokerageAccount))) {
            $filename = $doc['updated_name'] ?? "$docNum";
            $subDir = $doc['document_type'];
            $newPath = SubFolders::BROKERAGE_ACCOUNT_DOCS.'/'.$subDir  . "/$filename.pdf";
        }


        $lifeInsuDocs = $clientBankDocs['life_insurance'] ?? [];
        if (!empty($lifeInsuDocs) && in_array($doc['document_type'], array_keys($lifeInsuDocs))) {
            $filename = $doc['updated_name'] ?? "$docNum";
            $subDir = $doc['document_type'];
            $newPath = SubFolders::REQUESTED_DOCS.'/'.$subDir  . "/$filename.pdf";
        }


        $retirement_pension = $clientBankDocs['retirement_pension'] ?? [];
        if (!empty($retirement_pension) && in_array($doc['document_type'], array_keys($retirement_pension))) {
            $filename = $doc['updated_name'] ?? "$docNum";
            $subDir = $doc['document_type'];
            $newPath = SubFolders::RETIREMENT_DOCS.'/'.$subDir  . "/$filename.pdf";
        }

        if (!empty($adminDocs) && in_array($doc['document_type'], $adminDocs)) {
            $filename = $doc['updated_name'] ?? "$docNum";
            $subDire = $doc['document_type'];
            $newPath = SubFolders::REQUESTED_DOCS.'/'.$subDire  . "/$filename.pdf";
        }

        $unpaid_wages = $clientBankDocs['unpaid_wages'] ?? [];
        $unpaid_wages = \App\Helpers\ClientHelper::getUpdatedLabelName($debtorname, $spousename, $unpaid_wages, true);
        if (!empty($unpaid_wages) && in_array($doc['document_type'], array_keys($unpaid_wages))) {
            $filename = $doc['updated_name'] ?? "$docNum";
            $subDir = $unpaid_wages[$doc['document_type']];
            $newPath = SubFolders::OTHER_INCOMES.'/'.$subDir  . "/$filename.pdf";
            //\Log::info("Unpaid_wages=".$newPath);
        }

        return $this->truncatePathIfNeeded($newPath);
    }

    private function cleanTempDirectory($directory)
    {
        if (!is_dir($directory)) {
            return false; // Not a directory
        }

        $items = array_diff(scandir($directory), ['.', '..']);
        foreach ($items as $item) {
            $itemPath = $directory . DIRECTORY_SEPARATOR . $item;
            if (is_dir($itemPath)) {
                $this->cleanTempDirectory($itemPath); // Recursive call for subdirectory
            } else {
                unlink($itemPath); // Delete file
            }
        }

        return rmdir($directory); // Remove the now-empty directory
    }
    private static function createSubDire($path, $listDir, $additional = '', $validate = true)
    {
        $directories = [];
        if (!empty($listDir)) {
            foreach ($listDir as $attrDoc) {
                if ($validate) {
                    $directories[] = $path."/".DocumentHelper::validate_dir_name($attrDoc);
                } else {
                    $directories[] = $path."/".$attrDoc;
                }
            }
            if (!empty($additional)) {
                array_push($directories, $path."/".$additional);
            }

            foreach ($directories as $dir) {
                if (!file_exists($dir)) {
                    !File::makeDirectory($dir, 0777, true, true);
                }
            }
        }
    }
}
