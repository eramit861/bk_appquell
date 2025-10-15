<?php

namespace App\Services\Client;

use App\Models\ClientBasicInfoPartRest;
use App\Models\FormsStepsCompleted;
use App\Helpers\Helper;

class FinancialCalculationService
{
    /**
     * Get sole proprietor data
     */
    public function getSoleProprietorData(int $clientId)
    {
        return json_decode(
            ClientBasicInfoPartRest::where('client_id', $clientId)
                ->select(['used_business_ein_data', 'hazardous_property', 'proprietor_status', 'used_business_ein'])
                ->first()
        );
    }

    /**
     * Get client expenses data
     */
    public function getClientExpenses(int $clientId): array
    {
        return CacheExpense::getExpenseData($clientId);
    }

    /**
     * Get hide button status
     */
    public function getHideButtonStatus(int $clientId): int
    {
        $fdata = FormsStepsCompleted::where("client_id", $clientId)
            ->select('step6', 'can_edit')
            ->first();

        return !empty($fdata) && $fdata->step6 == 1 && $fdata->can_edit == 2 ? 1 : 0;
    }

    /**
     * Get attorney ID for client
     */
    public function getAttorneyId(int $clientId): ?int
    {
        $attorney = \App\Models\ClientsAttorney::where("client_id", $clientId)->first();

        return $attorney ? $attorney->attorney_id : null;
    }

    /**
     * Get signed documents for client
     */
    public function getSignedDocuments(int $clientId): array
    {
        $attorneyId = $this->getAttorneyId($clientId);

        return $attorneyId ? \App\Models\AttorneyDocuments::getSignedDocuments($clientId, $attorneyId) : [];
    }

    /**
     * Get redirect route based on current route and sole proprietor data
     */
    public function getRedirectRoute(string $routeName, int $clientId, $soleProprietor): string
    {
        $redirectRoute = 'client_financial_affairs2';

        if ($routeName === 'client_financial_affairs2'
            && !empty($soleProprietor)
            && !empty($soleProprietor->used_business_ein)) {
            $redirectRoute = 'client_financial_affairs3';
        } elseif ($routeName === 'client_financial_affairs2') {
            $redirectRoute = 'list_uploaded_documents';
            FormsStepsCompleted::where("client_id", $clientId)->update(['client_id' => $clientId, 'step6' => 1]);
        } elseif ($routeName === 'client_financial_affairs3') {
            $redirectRoute = 'list_uploaded_documents';
            FormsStepsCompleted::where("client_id", $clientId)->update(['client_id' => $clientId, 'step6' => 1]);
        }

        return $redirectRoute;
    }

    /**
     * Get current step based on route name and sole proprietor data
     */
    public function getCurrentStep(string $routeName, $soleProprietor): array
    {
        $steps = ['step1' => false, 'step2' => false, 'step3' => false, 'step4' => false, 'tab' => 'tab6'];

        if ($routeName === 'client_financial_affairs') {
            $steps['step1'] = true;
        } elseif ($routeName === 'client_financial_affairs2') {
            $steps['step2'] = true;
        } elseif ($routeName === 'client_financial_affairs3'
            && !empty($soleProprietor)
            && !empty($soleProprietor->used_business_ein)) {
            $steps['step3'] = true;
        }

        return $steps;
    }

    /**
     * Get back URL based on current steps
     */
    public function getBackUrl(array $steps): string
    {
        $backUrl = '';

        if (!empty($steps['step3'])) {
            $backUrl = route('client_financial_affairs2');
        } elseif (!empty($steps['step2'])) {
            $backUrl = route('client_financial_affairs');
        }

        return $backUrl;
    }

    /**
     * Get data to save for YTD gross income
     */
    public function getDataToSaveForYTDGrossIncome(string $assetType, array $inputData): array
    {
        $dataToSave = [];

        if ($assetType == 'ytd_debtor_div') {
            $dataToSave = [
                "total_amount_this_year" => Helper::validate_key_value('total_amount_this_year', $inputData, 'radio') ?? '',
                "total_amount_this_year_income" => Helper::validate_key_value('total_amount_this_year_income', $inputData) ?? '',
                "total_amount_this_year_extra" => Helper::validate_key_value('total_amount_this_year_extra', $inputData, 'radio') ?? '',
                "total_amount_this_year_income_extra" => Helper::validate_key_value('total_amount_this_year_income_extra', $inputData) ?? '',
                "total_amount_last_year" => Helper::validate_key_value('total_amount_last_year', $inputData, 'radio') ?? '',
                "total_amount_last_year_income" => Helper::validate_key_value('total_amount_last_year_income', $inputData) ?? '',
                "total_amount_last_year_extra" => Helper::validate_key_value('total_amount_last_year_extra', $inputData, 'radio') ?? '',
                "total_amount_last_year_income_extra" => Helper::validate_key_value('total_amount_last_year_income_extra', $inputData) ?? '',
                "total_amount_lastbefore_year" => Helper::validate_key_value('total_amount_lastbefore_year', $inputData, 'radio') ?? '',
                "total_amount_lastbefore_year_income" => Helper::validate_key_value('total_amount_lastbefore_year_income', $inputData) ?? '',
                "total_amount_lastbefore_year_extra" => Helper::validate_key_value('total_amount_lastbefore_year_extra', $inputData, 'radio') ?? '',
                "total_amount_lastbefore_year_income_extra" => Helper::validate_key_value('total_amount_lastbefore_year_income_extra', $inputData) ?? '',
            ];
        }

        if ($assetType == 'ytd_spouse_div') {
            $dataToSave = [
                "total_amount_spouse_this_year" => Helper::validate_key_value('total_amount_spouse_this_year', $inputData, 'radio') ?? '',
                "total_amount_spouse_this_year_income" => Helper::validate_key_value('total_amount_spouse_this_year_income', $inputData) ?? '',
                "total_amount_spouse_this_year_extra" => Helper::validate_key_value('total_amount_spouse_this_year_extra', $inputData, 'radio') ?? '',
                "total_amount_spouse_this_year_income_extra" => Helper::validate_key_value('total_amount_spouse_this_year_income_extra', $inputData) ?? '',
                "total_amount_spouse_last_year" => Helper::validate_key_value('total_amount_spouse_last_year', $inputData, 'radio') ?? '',
                "total_amount_spouse_last_year_income" => Helper::validate_key_value('total_amount_spouse_last_year_income', $inputData) ?? '',
                "total_amount_spouse_last_year_extra" => Helper::validate_key_value('total_amount_spouse_last_year_extra', $inputData, 'radio') ?? '',
                "total_amount_spouse_last_year_income_extra" => Helper::validate_key_value('total_amount_spouse_last_year_income_extra', $inputData) ?? '',
                "total_amount_spouse_lastbefore_year" => Helper::validate_key_value('total_amount_spouse_lastbefore_year', $inputData, 'radio') ?? '',
                "total_amount_spouse_lastbefore_year_income" => Helper::validate_key_value('total_amount_spouse_lastbefore_year_income', $inputData) ?? '',
                "total_amount_spouse_lastbefore_year_extra" => Helper::validate_key_value('total_amount_spouse_lastbefore_year_extra', $inputData, 'radio') ?? '',
                "total_amount_spouse_lastbefore_year_income_extra" => Helper::validate_key_value('total_amount_spouse_lastbefore_year_income_extra', $inputData) ?? '',
            ];
        }

        return $dataToSave;
    }

}
