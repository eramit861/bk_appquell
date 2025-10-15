<?php

namespace App\Http\Controllers;

use App\Services\Client\FinancialManagementService;
use App\Services\Client\FinancialCalculationService;
use App\Helpers\ClientHelper;
use App\Helpers\DateTimeHelper;
use App\Models\DebtsTax;
use App\Models\FinancialAffairs;
use App\Models\ZipCode;
use Illuminate\Support\Facades\Auth;
use App\Helpers\VideoHelper;
use App\Helpers\Helper;
use App\Models\AttorneySettings;
use App\Models\Creditors;
use Illuminate\Http\Request;
use App\Models\FormsStepsCompleted;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheSOFA;
use Illuminate\Support\Facades\DB;

class ClientFinancialController extends Controller
{
    protected FinancialManagementService $financialManagementService;
    protected FinancialCalculationService $financialCalculationService;

    public function __construct(
        FinancialManagementService $financialManagementService,
        FinancialCalculationService $financialCalculationService,
    ) {
        $this->financialManagementService = $financialManagementService;
        $this->financialCalculationService = $financialCalculationService;
    }

    public function client_financial_affairs(Request $request)
    {
        $user = Auth::user();
        $clientId = $user->id;

        // Early redirect checks
        if ($user->client_subscription == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION) {
            return redirect()->route('client_income')->with('success', 'You are Logged in successfully');
        }

        if ($user->hide_questionnaire && empty($user->client_payroll_assistant)) {
            return redirect()->route('no_client_questionnaire')->with('success', 'You are Logged in successfully');
        }

        // Handle POST request
        if ($request->isMethod('post')) {
            if (!Helper::isTabEditable('can_edit_expenase')) {
                return redirect()->back()->with('error', 'You do not have edit permission...');
            }

            if (Helper::isTabEditable('can_edit_sofa')) {
                $this->financialManagementService->updateFinancialData($request->all(), $clientId);
            }

            $soleProprietor = $this->financialCalculationService->getSoleProprietorData($clientId);
            $redirectRoute = $this->financialCalculationService->getRedirectRoute($request->route()->getName(), $clientId, $soleProprietor);

            return redirect()->route($redirectRoute)->with('success', 'Information saved successfully');
        }

        // GET request processing
        $soleProprietor = $this->financialCalculationService->getSoleProprietorData($clientId);
        $steps = $this->financialCalculationService->getCurrentStep($request->route()->getName(), $soleProprietor);
        $videos = VideoHelper::getAdminVideos();

        // Prepare video data
        $videoData = [
            'video' => VideoHelper::getVideos($this->getHeaderVideo($videos, $steps)),
            'video1' => $this->getVideoTutorial($videos, Helper::SOFA_TAB_VIDEO_1),
            'video2' => $this->getVideoTutorial($videos, Helper::SOFA_TAB_VIDEO_2),
            'video3' => $this->getVideoTutorial($videos, Helper::SOFA_TAB_VIDEO_3),
            'video4' => $this->getVideoTutorial($videos, Helper::SOFA_TAB_VIDEO_4),
        ];
        $attorneyId = $this->financialCalculationService->getAttorneyId($clientId);
        $isConfirmPromptEnabled = AttorneySettings::isConfirmPromptEnabled($attorneyId);

        $BIData = CacheBasicInfo::getBasicInformationData($clientId);

        // Get other data
        $data = [
            'progress' => FormsStepsCompleted::getStepCompletionData($clientId, $user->client_type),
            'expenses' => $this->financialCalculationService->getClientExpenses($clientId),
            'hidebtn' => $this->financialCalculationService->getHideButtonStatus($clientId),
            'BasicInfo_PartRest' => Helper::validate_key_value('BasicInfo_PartRest', $BIData, 'array'),
            'district_names' => ZipCode::groupBy("district_name")->orderBy('short_name', "asc")->whereNotNull("short_name")->get(),
            'finacial_affairs' => CacheSOFA::getSOFAData($clientId),
            'sole_proprietor' => $soleProprietor,
            'docsUploadInfo' => ClientHelper::documentUploadInfo(),
            'progress_percentage' => ClientHelper::checkProgress(),
            'docsProgress' => ClientHelper::get_uploaded_docs_progress('', $clientId, $attorneyId),
            'appservice_codebtors' => Creditors::geCodebtors($clientId, $user->client_type),
            'backUrl' => $this->financialCalculationService->getBackUrl($steps),
            'client_type' => $user->client_type ?? '',
            'attorney_id' => $this->financialCalculationService->getAttorneyId($clientId),
            'listOfFiles' => $this->financialCalculationService->getSignedDocuments($clientId),
            'lawsuitDebts' => DebtsTax::getLawsuitDebts($clientId),
            'is_confirm_prompt_enabled' => $isConfirmPromptEnabled
        ];

        // Merge video data with other data
        $viewData = array_merge($steps, $data, $videoData);

        return view('client.dashboard', $viewData);
    }


    private function getVideoTutorial($videos, $key)
    {
        $tutorial = $videos[$key] ?? [];

        return [
            'en' => $tutorial['english_video'] ?? null,
            'sp' => $tutorial['spanish_video'] ?? null
        ];
    }



    private function getHeaderVideo($videos, $steps)
    {
        $tutorial = $videos[Helper::SOFA_TAB_VIDEO] ?? [];
        if (!empty($steps['step3'])) {
            $tutorial = $videos[Helper::SOFA_TAB_VIDEO_STEP_3] ?? [];
        } elseif (!empty($steps['step2'])) {
            $tutorial = $videos[Helper::SOFA_TAB_VIDEO_STEP_2] ?? [];
        }

        return $tutorial;
    }


    public function sofa_seperate_save(Request $request)
    {
        $inputData = $request->all();
        $assetType = Helper::validate_key_value('assetType', $inputData);

        $editableTab = (!empty($assetType) && $assetType == 'list_all_financial_accounts') ? 'can_edit_property' : 'can_edit_sofa';

        if ($request->isMethod('post') && !Helper::isTabEditable($editableTab)) {
            return response()->json(['status' => false, 'msg' => "You do not have edit permission, please request edit permission from your attorney by using the Edit Request popup showing on the screen."])->header('Content-Type: application/json;', 'charset=utf-8');
        }

        if ($request->isMethod('post') && Helper::isTabEditable($editableTab)) {
            DB::beginTransaction();
            try {

                $fileName = Helper::validate_key_value('fileName', $inputData);
                $isDelete = Helper::validate_key_value('isDelete', $inputData);
                $assetType = Helper::validate_key_value('assetType', $inputData);
                $radioAssetType = '';
                $dataAssetType = '';

                if ($assetType == 'past_one_year_data') {
                    $radioAssetType = 'payment_past_one_year';
                    $dataAssetType = 'past_one_year_data';
                    $assetData = Helper::validate_key_value($dataAssetType, $inputData);
                } elseif (in_array($assetType, ['ytd_debtor_div', 'ytd_spouse_div'])) {
                    $radioAssetType = 'total_amount_income';

                } elseif (in_array($assetType, ['ytd_other_income_debtor_div', 'ytd_other_income_spouse_div'])) {
                    $radioAssetType = 'other_income_received_income';

                } else {
                    $assetData = Helper::validate_key_value($assetType.'_data', $inputData);
                }

                $authUser = Auth::user();
                $clientId = $authUser->id;
                $clientType = $authUser->client_type ?? '';
                $attorney = \App\Models\ClientsAttorney::where("client_id", $clientId)->first();
                $attorneyId = $attorney->attorney_id;

                $financialFields = ClientHelper::getFinancialFoields();
                $existingAsset = FinancialAffairs::where('client_id', $clientId)->select($financialFields)->first();

                // Update or create data to table
                if (in_array($assetType, ['living_domestic_partner'])) {
                    unset($inputData['assetType'], $inputData['fileName'], $inputData['isDelete']);
                    $this->financialManagementService->updateFinancialDataSingleFields($clientId, $inputData, $existingAsset, $isDelete);
                } elseif (in_array($assetType, ['ytd_debtor_div', 'ytd_spouse_div', 'ytd_other_income_debtor_div', 'ytd_other_income_spouse_div'])) {

                    $dataToSave = $inputData;

                    if (in_array($assetType, ['ytd_debtor_div', 'ytd_spouse_div'])) {
                        $dataToSave = $this->financialCalculationService->getDataToSaveForYTDGrossIncome($assetType, $inputData);
                    }

                    unset($dataToSave['assetType'], $dataToSave['fileName'], $dataToSave['isDelete']);
                    $dataToSave[$radioAssetType] = 1;
                    $dateTime = now();
                    if (!empty($existingAsset)) {
                        $dataToSave['updated_on'] = $dateTime;
                        $existingAsset->update($dataToSave);
                    } else {
                        foreach ($dataToSave as $key => $data) {
                            if (is_Array($data)) {
                                $dataToSave[$key] = json_encode($data);
                            }
                        }
                        $dataToSave['client_id'] = $clientId;
                        $dataToSave['created_on'] = $dateTime;
                        $dataToSave['updated_on'] = $dateTime;
                        FinancialAffairs::create($dataToSave);
                    }

                } else {
                    $this->financialManagementService->updateFinancialDataCommon($clientId, $assetType, $assetData, $existingAsset, $isDelete, $radioAssetType, $dataAssetType);
                }

                // Clear cache for client SOFA
                CacheSOFA::forgetSOFACache($clientId);
                //check
                $financialFields = ClientHelper::getFinancialFoields();
                $existingAsset = CacheSOFA::getSOFAData($clientId);

                $BIData = CacheBasicInfo::getBasicInformationData($clientId);
                $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
                $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');

                $debtorName = ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor's");
                $spouseName = ClientHelper::getDebtorName($clientBasicInfoPartB, "Co-Debtor's");
                $taxYears = DateTimeHelper::getOnlyYearForTaxReturn($attorneyId);

                $isCodebtor = 0;
                if ($clientType == 3) {
                    $isCodebtor = 1;
                }

                $dataToSend = [];
                $renderData = [
                    'finacial_affairs' => $dataToSend,
                ];

                $arrayForSeparateQueue = ['list_all_financial_accounts', 'living_domestic_partner', 'total_amount_income', 'other_income_received_income'];

                if (in_array($assetType, $arrayForSeparateQueue)) {
                    $renderData['finacial_affairs'] = $existingAsset;
                } elseif (in_array($assetType, ['past_one_year_data'])) {
                    $dataToSend = Helper::validate_key_value($assetType, $existingAsset);
                    $renderData['finacial_affairs'][$assetType] = $dataToSend;
                } elseif (in_array($assetType, ['ytd_debtor_div', 'ytd_spouse_div', 'ytd_other_income_debtor_div', 'ytd_other_income_spouse_div'])) {

                    $videos = VideoHelper::getAdminVideos();

                    $tutorial1 = $videos[Helper::SOFA_TAB_VIDEO_1] ?? [];
                    $video1 = ['en' => $tutorial1['english_video'] ?? '', 'sp' => $tutorial1['spanish_video'] ?? ''];

                    $tutorial2 = $videos[Helper::SOFA_TAB_VIDEO_2] ?? [];
                    $video2 = ['en' => $tutorial2['english_video'] ?? '', 'sp' => $tutorial2['spanish_video'] ?? ''];

                    $tutorial3 = $videos[Helper::SOFA_TAB_VIDEO_3] ?? [];
                    $video3 = ['en' => $tutorial3['english_video'] ?? '', 'sp' => $tutorial3['spanish_video'] ?? ''];

                    $tutorial4 = $videos[Helper::SOFA_TAB_VIDEO_4] ?? [];
                    $video4 = ['en' => $tutorial4['english_video'] ?? '', 'sp' => $tutorial4['spanish_video'] ?? ''];

                    $renderData['video1'] = $video1;
                    $renderData['video2'] = $video2;
                    $renderData['video3'] = $video3;
                    $renderData['video4'] = $video4;
                    $renderData['client_type'] = $clientType;
                    $renderData['debtorname'] = $debtorName;
                    $renderData['spousename'] = $spouseName;
                    $renderData['taxYears'] = $taxYears;
                    $renderData['isCodebtor'] = $isCodebtor;
                    $renderData['finacial_affairs'] = $existingAsset;
                } elseif ($assetType == 'list_nature_business') {
                    $dataToSend = Helper::validate_key_value($assetType.'_data', $existingAsset);
                    $renderData['finacial_affairs'][$assetType.'_data'] = $dataToSend;
                    $renderData['authUser'] = $authUser;
                } elseif ($assetType == 'list_lawsuits') {
                    $dataToSend = Helper::validate_key_value($assetType.'_data', $existingAsset);
                    $renderData['finacial_affairs'][$assetType.'_data'] = $dataToSend;
                    $renderData['client_type'] = $clientType;
                    $renderData['debtorname'] = $debtorName;
                    $renderData['spousename'] = $spouseName;
                } else {
                    $dataToSend = Helper::validate_key_value($assetType.'_data', $existingAsset);
                    $renderData['finacial_affairs'][$assetType.'_data'] = $dataToSend;
                }

                $tutorial2 = $videos[Helper::SOFA_TAB_VIDEO_2] ?? [];
                $video2 = ['en' => $tutorial2['english_video'] ?? '', 'sp' => $tutorial2['spanish_video'] ?? ''];

                // Render the updated section
                $html = view('client.questionnaire.affairs.common.'.$fileName, $renderData)->render();

                DB::commit();

                return response()->json([
                    'status' => true,
                    'html' => $html
                ]);
            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json([
                    'status' => false,
                    'msg' => 'Something went wrong, try again.'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'msg' => "You don't have permission to edit the SOFA tab, Please request edit permission."
            ]);
        }
    }
}
