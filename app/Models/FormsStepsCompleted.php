<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Services\Client\FormsStepsCompletionService;

class FormsStepsCompleted extends Model
{
    protected $guarded = [];
    protected $table = 'tbl_forms_steps_completed';
    public $timestamps = false;

    public static function getTab1CompletionData($response, $clientId, $clientType)
    {
        return FormsStepsCompletionService::getTab1CompletionData($response, $clientId, $clientType);
    }

    public static function getTab2CompletionData($response, $clientId)
    {
        return FormsStepsCompletionService::getTab2CompletionData($response, $clientId);
    }

    public static function getTab3CompletionData($response, $clientId)
    {
        return FormsStepsCompletionService::getTab3CompletionData($response, $clientId);
    }

    public static function getTab4CompletionData($response, $clientId, $clientType)
    {
        return FormsStepsCompletionService::getTab4CompletionData($response, $clientId, $clientType);
    }

    public static function getPerStepQuestionPercentage($data, $conditions, $maxTabPercentage)
    {
        return FormsStepsCompletionService::getPerStepQuestionPercentage($data, $conditions, $maxTabPercentage);
    }

    public static function getPerStepQuestionPercentageProperty($data, $conditions, $singleStepPercentage)
    {
        return FormsStepsCompletionService::getPerStepQuestionPercentageProperty($data, $conditions, $singleStepPercentage);
    }

    public static function getTab5CompletionData($response, $clientId, $clientType)
    {
        return FormsStepsCompletionService::getTab5CompletionData($response, $clientId, $clientType);
    }

    public static function getTab6CompletionData($response, $clientId)
    {
        return FormsStepsCompletionService::getTab6CompletionData($response, $clientId);
    }

    public static function checkEligibleForSubmit($response, $clientId)
    {
        return FormsStepsCompletionService::checkEligibleForSubmit($response, $clientId);
    }

    public static function getStepCompletionData($clientId, $clientType)
    {
        return FormsStepsCompletionService::getStepCompletionData($clientId, $clientType);
    }

    public static function getTotalProgressForScheduler($client)
    {
        return FormsStepsCompletionService::getTotalProgressForScheduler($client);
    }

    public static function getStepCompletionDataForClients($clientIds)
    {
        return FormsStepsCompletionService::getStepCompletionDataForClients($clientIds);
    }

    public static function addStepCompletionClass(array $stepPercentages): array
    {
        return FormsStepsCompletionService::addStepCompletionClass($stepPercentages);
    }

    public static function getStepCompletionDataForNotificationTemplate($clientId, $clientType)
    {
        return FormsStepsCompletionService::getStepCompletionDataForNotificationTemplate($clientId, $clientType);
    }
}
