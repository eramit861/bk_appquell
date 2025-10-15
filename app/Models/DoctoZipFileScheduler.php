<?php

namespace App\Models;

use App\Helpers\DateTimeHelper;
use App\Helpers\ArrayHelper;
use Illuminate\Database\Eloquent\Model;
use ZipArchive;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use App\Helpers\DocumentHelper;
use App\Helpers\Helper;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheIncome;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DoctoZipFileScheduler extends Model
{
    protected $table = 'tbl_zip_file_scheduler';
    public $timestamps = false;
    public const STATUS_PENDING = 0;
    public const STATUS_INPROGRESS = 1;
    public const STATUS_COMPLETED = 2;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $fillable = [
        'client_id','job_status','scheduler_start_at','downloadable_path','created_at','updated_at','is_completed','completion_percentage','error_details','last_updated','retry_count','last_error'
    ];


    public function getZipFileforClient($client_id, $documentList, $returnZip = false)
    {
        $clientDir = public_path("documents/{$client_id}");

        // Ensure the client directory exists
        if (!File::exists($clientDir)) {
            File::makeDirectory($clientDir, 0777, true, true);
        }

        $zipPath = "{$clientDir}/Client_Document_Uploads.zip";
        $zip = new ZipArchive();

        $files = [];
        $processedNames = [];

        foreach ($documentList as $doc) {
            $documentType = $doc['document_type'];
            $count = $processedNames[$documentType] ?? 0;
            $processedNames[$documentType] = $count + 1;
            $uniqueType = $count ? "{$documentType}_{$count}" : $documentType;

            $filepath = public_path($doc['document_file']);

            if (Storage::disk('s3')->exists($doc['document_file'])) {
                $filepath = DocumentHelper::s3toTemp($client_id, $doc['document_file']);
            }

            if (File::exists($filepath)) {
                $ext = pathinfo($doc['document_file'], PATHINFO_EXTENSION);
                $relativeName = $this->getRelativeFileName($uniqueType, $ext, $doc);
                $files[] = ['key' => $relativeName, 'path' => $filepath];
            }
        }

        if (empty($files)) {
            return '';
        }

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            foreach ($files as $file) {
                $zip->addFile($file['path'], $file['key']);
            }

            if (!$returnZip) {
                $clientObj = \App\Models\User::where('id', $client_id)
                    ->select('debtor_add_profit_loss_to_client_zip', 'co_debtor_add_profit_loss_to_client_zip')
                    ->first();

                if ($clientObj && $clientObj->debtor_add_profit_loss_to_client_zip == 1) {
                    $this->addProfitLossFilesToZip($zip, $client_id, 'self');
                }
                if ($clientObj && $clientObj->co_debtor_add_profit_loss_to_client_zip == 1) {
                    $this->addProfitLossFilesToZip($zip, $client_id, 'spouse');
                }

                $this->updateProgressWithDetails($client_id, 100, $zipPath);
            }
            $zip->close();
        }

        return $zipPath;
    }

    private function getRelativeFileName($documentType, $ext, $doc)
    {
        switch ($documentType) {
            case 'Drivers_License':
                return "Debtor_Drivers_Lic_Gov_ID.$ext";
            case 'Co_Debtor_Drivers_License':
                return "Co_Debtor_Drivers_Lic_Gov_ID.$ext";
            case 'Social_Security_Card':
                return "Debtor_Social_Security_Card_ITIN.$ext";
            case 'Co_Debtor_Social_Security_Card':
                return "Co_Debtor_Social_Security_Card_ITIN.$ext";
            default:
                return !empty($doc['updated_name'])
                    ? $documentType . '_' . $doc['updated_name'] . ".$ext"
                    : "$documentType.$ext";
        }
    }


    private function addProfitLossFilesToZip($zip, $client_id, $role)
    {
        $finalIncomeData = self::getProfitLossData($client_id, $role);
        $incomeProfit = DateTimeHelper::getIncomeDescArray($finalIncomeData);

        if (empty($incomeProfit['income_profit_loss']) || !is_array($incomeProfit['income_profit_loss'])) {
            return;
        }

        $clientObj = \App\Models\User::find($client_id);
        $pdata = \App\Models\FormsStepsCompleted::where("client_id", $client_id)
            ->select('step6', 'can_edit', 'updated_on')
            ->first();
        $pdataArr = $pdata ? $pdata->toArray() : [];
        $newdate = (!empty($pdataArr) && $pdataArr['step6'] == 1 && $pdataArr['can_edit'] == 2)
            ? date('m/d/Y', strtotime($pdataArr['updated_on']))
            : '';

        $attorney_id = \App\Models\AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
        $majorLawProfitLossLabels = ArrayHelper::getMajotLawFirmProfitLossLabels($attorney_id);

        foreach ($incomeProfit['income_profit_loss'] as $value) {
            if (empty($value['profit_loss_month'])) {
                continue;
            }
            $months = explode("-", $value['profit_loss_month']);
            $dateObj = DateTime::createFromFormat('!m', $months[0]);
            $monthName = $dateObj ? $dateObj->format('F') : 'Unknown';

            $pdfData = self::getPDFData($clientObj, $value, $newdate);
            $pdfData['majorLawProfitLossLabels'] = $majorLawProfitLossLabels;
            $pdf = PDF::loadView('client.questionnaire.income.profit_loss_pdf', $pdfData);

            $pdfFileName = ($role == 'self' ? 'Month_' : 'Codebtor_Month_') . $monthName . '.pdf';
            $filePath = public_path("documents/{$client_id}/{$pdfFileName}");

            // Save PDF only if it doesn't exist, otherwise always add to zip
            if (!file_exists($filePath)) {
                $pdf->save($filePath);
            }

            $zip->addFile($filePath, $pdfFileName);
        }
    }


    private static function getProfitLossData($client_id, $clientType)
    {
        $debtorIncomeTabData = [];
        $spouseIncomeTabData = [];
        $PlStatusDebtor = 0;
        $PlStatusSpouse = 0;

        $incomeData = CacheIncome::getIncomeData($client_id);

        if ($clientType === 'self') {
            $debtorIncomeTabData = Helper::validate_key_value('debtormonthlyincome', $incomeData, 'array');
            $debtorIncomeTabData = User::getSelectedColumnsFromArray($debtorIncomeTabData, [
                    'operation_business',
                    'profit_loss_business_name', 'profit_loss_business_name_2', 'profit_loss_business_name_3',
                    'profit_loss_business_name_4', 'profit_loss_business_name_5', 'profit_loss_business_name_6',
                    'income_profit_loss', 'income_profit_loss_2', 'income_profit_loss_3',
                    'income_profit_loss_4', 'income_profit_loss_5', 'income_profit_loss_6'
                ]);
            $PlStatusDebtor = Helper::validate_key_value('operation_business', $debtorIncomeTabData, 'radio');
        } elseif ($clientType === 'spouse') {
            $spouseIncomeTabData = Helper::validate_key_value('debtorspousemonthlyincome', $incomeData, 'array');
            $spouseIncomeTabData = User::getSelectedColumnsFromArray($spouseIncomeTabData, [
                    'joints_operation_business',
                    'profit_loss_business_name', 'profit_loss_business_name_2', 'profit_loss_business_name_3',
                    'profit_loss_business_name_4', 'profit_loss_business_name_5', 'profit_loss_business_name_6',
                    'income_profit_loss', 'income_profit_loss_2', 'income_profit_loss_3',
                    'income_profit_loss_4', 'income_profit_loss_5', 'income_profit_loss_6'
                ]);
            $PlStatusSpouse = Helper::validate_key_value('joints_operation_business', $spouseIncomeTabData, 'radio');
        }

        $ClientsAssociateId = ClientsAssociate::getAssociateId($client_id);
        $is_associate = !empty($ClientsAssociateId) ? 1 : 0;
        $attProfitLossMonths = AttorneySettings::getProfitLossMonths($ClientsAssociateId, $is_associate);
        $debtorPL = [];
        $spousePL = [];
        if ($debtorIncomeTabData && $PlStatusDebtor == 1) {
            $debtorPL = (new \App\Models\IncomeDebtorMonthlyIncome())
                ->getBusinessAndPLDataArray($debtorIncomeTabData, $attProfitLossMonths);
        }
        if ($spouseIncomeTabData && $PlStatusSpouse == 1) {
            $spousePL = (new \App\Models\IncomeDebtorMonthlyIncome())
                ->getBusinessAndPLDataArray($spouseIncomeTabData, $attProfitLossMonths);
        }

        return [
            'debtor' => $debtorPL['plData'] ?? [],
            'spouse' => $spousePL['plData'] ?? [],
        ];
    }

    private static function getPDFData($clientObj, $value, $newdate)
    {
        $BIData = CacheBasicInfo::getBasicInformationData($clientObj->id);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

        return [ 'BasicInfoPartA' => $clientBasicInfoPartA, 'BasicInfo_PartB' => $clientBasicInfoPartB, 'income_profit_loss' => $value, 'final_date' => $newdate ];
    }

    public function getProfitLossZipFileforClient($client_id, $returnZip = false)
    {
        $debtor_types = ['self', 'spouse'];
        $zipFileName = "Company_Profit_Loss.zip";

        $clientDir = public_path().'/documents/'.$client_id;

        if (!File::exists($clientDir)) {
            File::makeDirectory($clientDir, 0777, true, true);
        }

        $zipPath = $clientDir.'/'.$zipFileName;

        $zip = new ZipArchive();
        $zipOpened = false;

        try {
            if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
                throw new \RuntimeException("Failed to open zip file: $zipPath");
            }
            $zipOpened = true;

            foreach ($debtor_types as $dtype) {
                $this->getsetProfitLossFilesToZip($zip, $client_id, $dtype);
            }

            if (!$zip->close()) {
                throw new \RuntimeException("Failed to close zip file: $zipPath");
            }
            $zipOpened = false;

            // Verify the file exists and is readable
            if (!file_exists($zipPath) || !is_readable($zipPath)) {
                return '';
                Log::info("Zip file not accessible: $zipPath");
            }

            if ($returnZip) {
                return '/documents/'.$client_id.'/'.$zipFileName;
            }
        } catch (\Exception $e) {
            // Clean up if something went wrong
            if ($zipOpened) {
                $zip->close();
            }
            if (file_exists($zipPath)) {
                unlink($zipPath);
            }
            throw $e;
        }
    }

    public static function getsetProfitLossFilesToZip($zip, $client_id, $role)
    {
        ini_set('max_execution_time', '300');
        $finalIncomeData = self::getProfitLossData($client_id, $role);
        $havebusiness = false;

        if (isset($finalIncomeData['debtor']) && !empty($finalIncomeData['debtor']) && is_array($finalIncomeData['debtor'])) {
            foreach ($finalIncomeData['debtor'] as $businessName => $incomeProfitLoss) {
                foreach ($incomeProfitLoss as $value) {
                    self::processProfitlosstoZip($zip, $value, $businessName, $client_id, 'Debtor P&L');
                }
            }
            $havebusiness = true;
        }

        if (isset($finalIncomeData['spouse']) && !empty($finalIncomeData['spouse']) && is_array($finalIncomeData['spouse'])) {
            foreach ($finalIncomeData['spouse'] as $businessName => $incomeProfitLoss) {
                foreach ($incomeProfitLoss as $value) {
                    self::processProfitlosstoZip($zip, $value, $businessName, $client_id, 'Co-Debtor P&L');
                }
            }
            $havebusiness = true;
        }

        if ($havebusiness == false) {
            return false;
        }

    }


    private static function processProfitlosstoZip($zip, $value, $businessName, $client_id, $role)
    {
        $mainDireName = 'Company_Profit_Loss';
        if (isset($value['profit_loss_month'])) {
            $months = explode("-", $value['profit_loss_month']);
            $dateObj = DateTime::createFromFormat('!m', $months[0]);
            $monthName = $dateObj->format('F');
            $clientObj = \App\Models\User::where('id', $client_id)->first();
            $pdata = \App\Models\FormsStepsCompleted::where("client_id", $client_id)->select('step6', 'can_edit', 'updated_on')->first();
            $pdata = !empty($pdata) ? $pdata->toArray() : [];
            $newdate = '';
            if (!empty($pdata) && $pdata['step6'] == 1 && $pdata['can_edit'] == 2) {
                $date = $pdata['updated_on'];
                $timestamp = strtotime($date);
                $newdate = date('m/d/Y', $timestamp);
            }
            $pdfData = self::getPDFData($clientObj, $value, $newdate);
            $attorney_id = \App\Models\AttorneyEmployerInformationToClient::getClientAttorneyId($client_id);
            $majorLawProfitLossLabels = ArrayHelper::getMajotLawFirmProfitLossLabels($attorney_id);

            $pdfData['majorLawProfitLossLabels'] = $majorLawProfitLossLabels;
            $pdf = PDF::loadView('client.questionnaire.income.profit_loss_pdf', $pdfData);

            $pdfFileName = "Month_" .$monthName . '.pdf';

            // Generate PDF content directly without saving to disk
            $pdfContent = $pdf->output();

            // Create path with business name subdirectory
            $zipPath = "{$mainDireName}/{$role}/{$businessName}/{$pdfFileName}";
            Log::info("zip path:".$zipPath);

            // Add PDF directly to zip from memory with subdirectory structure
            $zip->addFromString($zipPath, $pdfContent);
        }
    }

    public function updateProgressWithDetails($clientId, $progress, $currentFile, $details = [])
    {
        $values = [
            'downloadable_path' => $currentFile,
            'scheduler_start_at' => date("Y-m-d H:i:s"),
            'completion_percentage' => ($progress > 100 ? 100 : $progress),
            'job_status' => $progress == 100 ? self::STATUS_COMPLETED : self::STATUS_INPROGRESS,
            'is_completed' => $progress == 100 ? 1 : 0,
            'error_details' => json_encode($details),
            'last_updated' => now()
        ];

        return $this->updateOrCreate(
            ['client_id' => $clientId],
            $values
        )->lockForUpdate();
    }

}
