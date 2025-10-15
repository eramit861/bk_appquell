<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use App\Helpers\Helper;
use App\Models\User;

trait Common
{
    private function getFilesArrayFromPath($files, $fullpath = false)
    {
        $listOfFiles = [];
        foreach ($files as $file) {
            $filename = basename($file);
            if ($fullpath) {
                $file = \Storage::disk('s3')->temporaryUrl($file, now()->addDays(2));
            }
            $listOfFiles[] = ['name' => $filename, 'path' => $file];
        }

        return $listOfFiles;
    }

    protected function checkOrCreateDir($path)
    {

        if (!file_exists($path)) {
            File::makeDirectory($path, 0777, true);
        }
    }

    protected function setPaystuAccordintToDebtor($documentTypes, $payrollType, $clientType, $client_subscription, $fromAttorney = 0)
    {
        return $documentTypes;
        //return  $this->addPayrollTypeFilter($documentTypes, $payrollType,$client_subscription,$clientType,$fromAttorney);

    }

    private function addPayrollTypeFilter($documentTypes, $payrollType, $client_subscription, $clientType, $fromAttorney = 0)
    {
        if ($fromAttorney == 0) {
            foreach (array_keys($documentTypes) as $key) {
                if (($key == \App\Models\ClientDocumentUploaded::DEBTOR_PAY_STUB && in_array($payrollType, [Helper::PAYROLL_ASSISTANT_TYPE_DEBTOR,Helper::PAYROLL_ASSISTANT_TYPE_BOTH]))) {
                    unset($documentTypes[$key]);
                }

                if (($key == \App\Models\ClientDocumentUploaded::CO_DEBTOR_PAY_STUB && in_array($payrollType, [Helper::PAYROLL_ASSISTANT_TYPE_CODEBTOR,Helper::PAYROLL_ASSISTANT_TYPE_BOTH]))) {
                    unset($documentTypes[$key]);
                }
            }
        }

        return $documentTypes;
    }

    private function addBankStatementTypeFilter($documentTypes, $client_bank_statement, $client_profit_loss, $clientType, $client_subscription, $fromAttorney = 0)
    {
        if ($fromAttorney == 0) {
            foreach (array_keys($documentTypes) as $key) {
                if (($key == 'bank_assistant_debtor' && (in_array($client_bank_statement, [Helper::BANK_STATEMENTS_DEBTOR,Helper::BANK_STATEMENTS_BOTH]) || in_array($client_bank_statement, [Helper::PROFIT_LOSS_ASSISTANT_TYPE_DEBTOR,Helper::PROFIT_LOSS_ASSISTANT_TYPE_BOTH])))) {
                    unset($documentTypes[$key]);
                }

                if (($key == "bank_assistant_codebtor" && (in_array($client_bank_statement, [Helper::BANK_STATEMENTS_CODEBTOR,Helper::BANK_STATEMENTS_BOTH]) || in_array($client_bank_statement, [Helper::PROFIT_LOSS_ASSISTANT_TYPE_CODEBTOR,Helper::PROFIT_LOSS_ASSISTANT_TYPE_BOTH])))) {
                    unset($documentTypes[$key]);
                }
            }
        }
        foreach (array_keys($documentTypes) as $key) {
            if ($key == 'bank_assistant_debtor' && !in_array($client_bank_statement, [Helper::BANK_STATEMENTS_DEBTOR,Helper::BANK_STATEMENTS_BOTH,Helper::PROFIT_LOSS_ASSISTANT_TYPE_DEBTOR,Helper::PROFIT_LOSS_ASSISTANT_TYPE_BOTH])) {
                unset($documentTypes[$key]);
            }

            if ($key == "bank_assistant_codebtor" && !in_array($client_bank_statement, [Helper::BANK_STATEMENTS_CODEBTOR,Helper::BANK_STATEMENTS_BOTH,Helper::PROFIT_LOSS_ASSISTANT_TYPE_CODEBTOR,Helper::PROFIT_LOSS_ASSISTANT_TYPE_BOTH])) {
                unset($documentTypes[$key]);
            }
        }

        return $documentTypes;
    }

    protected function checkIfUploaded($key, $documentuploaded)
    {
        $is_uploaded = false;
        if (in_array($key, @$documentuploaded)) {
            $is_uploaded = true;
        }

        return $is_uploaded;
    }

    protected function getAutoloanDocs($documentTypes, $documentuploaded, $clientside = 0)
    {
        /** Removing removing from main listing if document not uploaded */
        return self::getDefaultAutoLoans($documentTypes, $documentuploaded, $clientside);
    }

    public static function getDefaultAutoLoans($documentTypes, $documentuploaded, $clientside = 0)
    {
        $vtype = $clientside == 1 ? 'Current_Auto_Loan_Statement_1' : 'Current_Auto_Loan_Statement';
        $vehicleBasic = Helper::getVehicle();
        if (empty($documentTypes)) {
            $documentTypes[$vtype] = 'Current Auto Loan Statement';
        }
        $uploadedVehicle = [];
        foreach ($documentuploaded as $autoloan) {
            if (in_array($autoloan, array_keys($vehicleBasic))) {
                $uploadedVehicle[] = $autoloan;
            }
        }
        foreach ($documentTypes as $document_type => $value) {
            if (in_array($document_type, array_keys($vehicleBasic)) && !in_array($document_type, $uploadedVehicle) && $document_type != $vtype && !empty($value)) {
                unset($documentTypes[$document_type]);
            }
        }

        return $documentTypes;
    }

    protected function getMortgageDocs($documentTypes, $documentuploaded, $clientside = 0)
    {
        /** Removing Mortgage loan docs if mortgage not added by clien under residents */
        return self::checkAndSetDefaultTypes($documentTypes, $documentuploaded, $clientside);
    }

    public static function checkAndSetDefaultTypes($documentTypes, $documentuploaded, $clientside = 0)
    {
        $vtype = $clientside == 1 ? 'Current_Mortgage_Statement_1_1' : 'Current_Mortgage_Statement';
        $residenceBasic = Helper::getResidence(1);
        if (empty($documentTypes)) {
            $documentTypes[$vtype] = 'Current Mortgage Statement';
        }

        $uploadedMortgage = [];
        foreach ($documentuploaded as $morloan) {
            if (in_array($morloan, array_keys($residenceBasic))) {
                $uploadedMortgage[] = $morloan;
            }
        }

        foreach ($documentTypes as $document_type => $value) {
            if (in_array($document_type, array_keys($residenceBasic)) && !in_array($document_type, $uploadedMortgage) && $document_type != $vtype && !empty($value)) {
                unset($documentTypes[$document_type]);
            }
        }

        return $documentTypes;
    }

    protected function checkMortgageLoan1($thisloan, $mortgageDocs, $proIndex)
    {
        if (!empty($thisloan)) {
            array_push($mortgageDocs, 'Current_Mortgage_Statement_1_' . $proIndex);
        }

        return $mortgageDocs;
    }

    protected function checkMortgageLoan2($val, $mortgageDocs, $proIndex)
    {
        if (!empty($val['home_car_loan2'])) {
            $thisloan = json_decode($val['home_car_loan2'], 1);
            if (isset($thisloan['additional_loan1']) && $thisloan['additional_loan1'] == 1) {
                array_push($mortgageDocs, 'Current_Mortgage_Statement_2_' . $proIndex);
            }
        }

        return $mortgageDocs;
    }

    protected function checkMortgageLoan3($val, $mortgageDocs, $proIndex)
    {
        if (!empty($val['home_car_loan3'])) {
            $thisloan = json_decode($val['home_car_loan3'], 1);
            if (isset($thisloan['additional_loan2']) && $thisloan['additional_loan2'] == 1) {
                array_push($mortgageDocs, 'Current_Mortgage_Statement_3_' . $proIndex);
            }
        }

        return $mortgageDocs;
    }

    protected function checkMortageLoanDocs($propertyresident)
    {
        $mortgageDocs = [];
        if (!empty($propertyresident)) {
            $proIndex = 1;
            foreach ($propertyresident as $val) {
                if ($val['currently_lived'] && $val['loan_own_type_property'] == 1) {
                    $thisloan = json_decode($val['home_car_loan'], 1);
                    $mortgageDocs = $this->checkMortgageLoan1($thisloan, $mortgageDocs, $proIndex);
                    $mortgageDocs = $this->checkMortgageLoan2($val, $mortgageDocs, $proIndex);
                    $mortgageDocs = $this->checkMortgageLoan3($val, $mortgageDocs, $proIndex);
                }
                $proIndex++;
            }
        }

        return $mortgageDocs;
    }

    protected function deleteAdminClient($client_id)
    {
        $user = User::where('id', $client_id)->first();

        if (!empty($user)) {
            $user->clientAnyOtherNameData()->delete();
            $user->clientBasicInfoPartA()->delete();
            $user->clientBasicInfoPartB()->delete();
            $user->clientBasicInfoPartC()->delete();
            $user->clientLivedAddressFrom730Data()->delete();
            $user->clientBasicInfoPartRest()->delete();
            $user->clientsPropertyResident()->delete();
            $user->clientsPropertyVehicle()->delete();
            $user->clientsPropertyHousehold()->delete();
            $user->clientsPropertyFinancialAssets()->delete();
            $user->clientsPropertyBusinessAssets()->delete();
            $user->ClientsPropertyFarmCommercial()->delete();
            $user->clientsPropertyMiscellaneous()->delete();

            /* Debts Model Section */
            $user->debts()->delete();
            $user->debtsTax()->delete();

            /* Income Model Section */
            $user->incomeDebtorEmployer()->delete();
            $user->incomeDebtorSpouseEmployer()->delete();
            $user->incomeDebtorMonthlyIncome()->delete();
            $user->incomeDebtorSpouseMonthlyIncome()->delete();

            $user->expenses()->delete();
            $user->spouseExpenses()->delete();

            $user->financialAffairs()->delete();

            $user->clientDocumentUploaded()->delete();
            $user->clientsApplicationPayment()->delete();
            $user->debtsDocuments()->delete();
            $user->signedDocuments()->delete();

            $user->formsStepsCompleted()->delete();
        }
    }

}
