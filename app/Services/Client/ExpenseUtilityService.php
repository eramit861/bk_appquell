<?php

namespace App\Services\Client;

use App\Helpers\Helper;
use App\Helpers\ArrayHelper;

class ExpenseUtilityService
{
    /**
     * Get utility popup data
     */
    public function getUtilityPopupData(array $input): array
    {
        $debtorType = Helper::validate_key_value('debtor_type', $input, 'radio');
        $previousData = Helper::validate_key_value('previous_data', $input);
        $utilities = ArrayHelper::getStreamingUtilities();

        return [
            'type' => $debtorType,
            'previous_data' => $previousData,
            'utilities' => $utilities
        ];
    }

    /**
     * Generate utility popup HTML
     */
    public function generateUtilityPopupHtml(array $data): string
    {
        return view('client.questionnaire.expense.utility_popup')
            ->with($data)
            ->render();
    }

    /**
     * Handle utility popup request
     */
    public function handleUtilityPopup(array $input): array
    {
        $data = $this->getUtilityPopupData($input);
        $html = $this->generateUtilityPopupHtml($data);

        return [
            'success' => true,
            'html' => $html
        ];
    }

}
