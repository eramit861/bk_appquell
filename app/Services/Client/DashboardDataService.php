<?php

namespace App\Services\Client;

use App\Models\AttorneySubscription;
use App\Helpers\ArrayHelper;
use App\Helpers\Helper;
use App\Helpers\ClientHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardDataService
{
    /**
     * Build the full dashboard view model.
     * Call this in controller and pass the array to the blade.
     */
    public function buildDashboardData(array $inputs = []): array
    {
        $authUser = Auth::user();
        $clientId = $authUser->id;

        $progress = $inputs['progress'] ?? ['all_percentage' => 0];
        $tab = $inputs['tab'] ?? null;
        $step = $inputs['step'] ?? null;

        $documentsMeta = $this->getDocumentsMeta($clientId);
        $progressMeta = $this->getProgressMeta((int)($progress['all_percentage'] ?? 0));
        $sessionMeta = $this->getSessionMeta();
        $uiLabels = $this->getUiLabels($authUser);
        $questionnaireMeta = $this->getQuestionnaireMeta($authUser);
        $namesMeta = $this->getDebtorNames($clientId, (int)$authUser->client_type);

        return [
            'user' => $this->getUserMeta(),
            'documents' => $documentsMeta,
            'progress' => $progressMeta,
            'session' => $sessionMeta,
            'labels' => $uiLabels,
            'questionnaire' => $questionnaireMeta,
            'names' => $namesMeta,
            'route' => [
                'tab' => $tab,
                'step' => $step,
            ],
        ];
    }

    public function getUserMeta(): array
    {
        $u = Auth::user();

        return [
            'id' => $u->id,
            'name' => $u->name,
            'client_type' => $u->client_type,
            'client_subscription' => $u->client_subscription,
            'phone_no' => $u->phone_no,
            'email' => $u->email,
            'hide_questionnaire' => (int)$u->hide_questionnaire === 1,
        ];
    }

    public function getDocumentsMeta(int $clientId): array
    {
        $signed = \App\Models\SignedDocuments::where('client_id', $clientId)->orderBy('id', 'desc')->select('is_sent')->first();

        return [
            'signed_sent' => !empty($signed?->is_sent),
        ];
    }

    public function getProgressMeta(int $percentage): array
    {
        $class = '';
        if ($percentage === 0) {
            $class = 'bg-danger';
        } elseif ($percentage > 50 && $percentage < 75) {
            $class = 'bg-warning';
        } elseif ($percentage > 75 && $percentage < 90) {
            $class = 'bg-info';
        } elseif ($percentage === 100) {
            $class = 'bg-success';
        }

        $message = $percentage === 100 ? '100%' : ($percentage . '%');
        $width = $percentage === 0 ? 100 : $percentage;

        return [
            'all_percentage' => $percentage,
            'class' => $class,
            'message' => $message,
            'width' => $width,
        ];
    }

    public function getSessionMeta(): array
    {
        return [
            'reference_parent' => Session::get('refrence_parent'),
            'reference_admin' => Session::get('refrence_admin'),
            'web_view' => Session::get('web_view'),
            'user_just_login' => (bool) Session::get('userJustLogin', false),
        ];
    }

    public function getUiLabels($authUser): array
    {
        $clientId = $authUser->id;
        $clientType = (int)$authUser->client_type;

        return [
            'debtor_tab_name' => ArrayHelper::getClientName($clientId, 'Debtor', true),
            'codebtor_tab_name' => ArrayHelper::getCoDebtorName($clientId, 'Co-Debtor', true),
            'spouse_tab_text' => $clientType === 2
                ? ArrayHelper::getCoDebtorName($clientId, 'Non-Filing Spouse', true)
                : ArrayHelper::getCoDebtorName($clientId, 'Co-Debtor', true),
        ];
    }

    public function getQuestionnaireMeta($authUser): array
    {
        return [
            'show_questionnaire' => ($authUser->client_subscription != AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION)
                && ((int)$authUser->hide_questionnaire === 0),
        ];
    }

    public function getDebtorNames(int $clientId, int $clientType): array
    {
        $biData = CacheBasicInfo::getBasicInformationData($clientId);
        $partA = Helper::validate_key_value('BasicInfoPartA', $biData, 'array');
        $partB = Helper::validate_key_value('BasicInfoPartB', $biData, 'array');

        $debtorName = ClientHelper::getDebtorName($partA, "Debtor's");
        $spouseName = $clientType === 2
            ? "Non-Filing Spouse's"
            : ClientHelper::getDebtorName($partB, "Co-Debtor's");

        return [
            'debtor' => $debtorName,
            'spouse' => $spouseName,
            'part_a' => $partA,
            'part_b' => $partB,
        ];
    }
}
