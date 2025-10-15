<?php

namespace App\Http\Controllers\Attorney\Questionnaire;

use App\Helpers\ClientHelper;
use App\Http\Controllers\AttorneyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use App\Helpers\UtilityHelper;
use App\Helpers\VideoHelper;
use App\Models\Creditors;
use App\Models\User;
use App\Models\FinancialAffairs;
use App\Models\ZipCode;
use App\Models\EditQuestionnaire\QuestionnairePropertyResident;
use App\Models\EditQuestionnaire\QuestionnaireFinancialAffairs;
use App\Models\EditQuestionnaire\QuestionnairePropertyBusinessAssets;
use App\Models\EditQuestionnaire\QuestionnairePropertyFarmCommercial;
use App\Models\EditQuestionnaire\QuestionnairePropertyFinancialAssets;
use App\Models\EditQuestionnaire\QuestionnairePropertyHousehold;
use App\Models\EditQuestionnaire\QuestionnairePropertyVehicle;
use App\Models\TemplateDetailedProperty;
use App\Models\UploadedOcrData;
use App\Services\Client\CacheBasicInfo;
use App\Services\Client\CacheSOFA;

class PropertyEditController extends AttorneyController
{
    public function property_step1_modal(Request $request)
    {
        $client_id = $request->input('client_id');
        $htmlData = $this->getHtmlData($client_id);
        $htmlData['popup_label'] = 'Property - Residence, Building, Land, Other Real Estate';
        $htmlData['step1'] = true;
        $htmlData['save_route'] = route('property_step1_modal_save', ['client_id' => $client_id]);
        $returnHTML = view('attorney.form_elements.que_models.property.step_1', $htmlData)->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function property_step2_modal(Request $request)
    {
        $client_id = $request->input('client_id');
        $htmlData = $this->getHtmlData($client_id);
        $htmlData['popup_label'] = 'Property - Vehicles';
        $htmlData['step2'] = true;
        $htmlData['save_route'] = route('property_step2_modal_save', ['client_id' => $client_id]);
        $returnHTML = view('attorney.form_elements.que_models.property.step_1', $htmlData)->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function property_step3_modal(Request $request)
    {
        $client_id = $request->input('client_id');
        $htmlData = $this->getHtmlData($client_id);
        $htmlData['popup_label'] = 'Property - Personal and Household Items';
        $htmlData['step3'] = true;
        $htmlData['save_route'] = route('property_step3_modal_save', ['client_id' => $client_id]);
        $returnHTML = view('attorney.form_elements.que_models.property.step_1', $htmlData)->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function property_step4_modal(Request $request)
    {
        $client_id = $request->input('client_id');
        $htmlData = $this->getHtmlData($client_id);
        $htmlData['popup_label'] = 'Property - Financial Assets 1';
        $htmlData['step4'] = true;
        $htmlData['paypalVideos'] = [
                'iphone' => $this->getVideos(Helper::PAYPAL_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE),
                'android' => $this->getVideos(Helper::PAYPAL_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID),
                'desktop_laptop' => $this->getVideos(Helper::PAYPAL_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE)
            ];
        $htmlData['cashAppVideos'] = [
                'iphone' => $this->getVideos(Helper::CASH_APP_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE),
                'android' => $this->getVideos(Helper::CASH_APP_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID),
                'desktop_laptop' => $this->getVideos(Helper::CASH_APP_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE),
            ];
        $htmlData['venmoVideo'] = [
                'iphone' => $this->getVideos(Helper::VENMO_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_APPLE),
                'android' => $this->getVideos(Helper::VENMO_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_ANDROID),
                'desktop_laptop' => $this->getVideos(Helper::VENMO_BANK_STATMENT_DOWNLOAD_GUIDE_FOR_WEBSITE)
            ];
        $htmlData['save_route'] = route('property_step4_modal_save', ['client_id' => $client_id]);
        $returnHTML = view('attorney.form_elements.que_models.property.step_1', $htmlData)->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function property_step5_modal(Request $request)
    {
        $client_id = $request->input('client_id');
        $htmlData = $this->getHtmlData($client_id);
        $htmlData['popup_label'] = 'Property - Financial Assets Continued';
        $htmlData['step4continue'] = 1;
        $htmlData['save_route'] = route('property_step5_modal_save', ['client_id' => $client_id]);
        $returnHTML = view('attorney.form_elements.que_models.property.step_1', $htmlData)->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function property_step6_modal(Request $request)
    {
        $client_id = $request->input('client_id');
        $htmlData = $this->getHtmlData($client_id);
        $htmlData['popup_label'] = 'Property - Business-Related Assets';
        $htmlData['step5'] = true;
        $htmlData['save_route'] = route('property_step6_modal_save', ['client_id' => $client_id]);
        $returnHTML = view('attorney.form_elements.que_models.property.step_1', $htmlData)->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function property_step7_modal(Request $request)
    {
        $client_id = $request->input('client_id');
        $htmlData = $this->getHtmlData($client_id);
        $htmlData['popup_label'] = 'Property - Farm and Commercial Fishing-Related';
        $htmlData['step6'] = true;
        $htmlData['save_route'] = route('property_step7_modal_save', ['client_id' => $client_id]);
        $returnHTML = view('attorney.form_elements.que_models.property.step_1', $htmlData)->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

    public function getPropertyData($user)
    {
        $businessAssets = $user->getPropertyBusinessAssets(true);
        $businessProperty = $businessAssets->where('type', 'is_business_property')->first();
        $farmCommercial = $user->getPropertyFarmCommercial(true);
        $isFarmProperty = $farmCommercial->where('type', 'is_farm_property')->first();
        $district_names = ZipCode::groupBy("district_name")->orderBy('short_name', "asc")->where("short_name", "!=", null)->get();

        $propertyFAData = $user->getPropertyFinancialAssets(true, Helper::PROPERTY_FINANCIAL_ASSETS_QUE_KEYS);
        $propertyFAData = (isset($propertyFAData) && !empty($propertyFAData)) ? $propertyFAData->toArray() : [];
        $propertyFAContinuedData = $user->getPropertyFinancialAssets(true, Helper::PROPERTY_FINANCIAL_ASSETS_CONTINUTED_QUE_KEYS);
        $propertyFAContinuedData = (isset($propertyFAContinuedData) && !empty($propertyFAContinuedData)) ? $propertyFAContinuedData->toArray() : [];

        $financialAssetsData = array_merge($propertyFAData, $propertyFAContinuedData);

        $resident = [
            'propertyresident' => $user->getPropertyResident(true),
            'propertyvehicle' => $user->getPropertyVehicle(true),
            'propertyhousehold' => $user->getPropertyHousehold(true),
            'financialassets' => $financialAssetsData,
            'businessassets' => $businessAssets->toArray(),
            'farmcommercial' => $farmCommercial,
            'miscellaneous' => $user->getPropertyMiscellaneous(true)->toArray(),
            'isBusinessProperty' => $businessProperty,
            'isFarmProperty' => $isFarmProperty,
            'district_names' => $district_names,
            'detailed_property' => $user->detailed_property,
            'enable_free_bank_statements' => $user->ClientsAttorneybyclient->getuserattorney->enable_free_bank_statements,
        ];

        return $resident;
    }

    public function getHtmlData($client_id)
    {
        $user = User::find($client_id);
        $attorney = Auth::user();
        $attorney_id = $attorney->id;

        $resident = $this->getPropertyData($user);

        $appservice_codebtors = Creditors::geCodebtors($client_id, Auth::user()->client_type);

        if (QuestionnaireFinancialAffairs::where('client_id', $client_id)->exists()) {
            $faModel = QuestionnaireFinancialAffairs::class;
        } else {
            $faModel = FinancialAffairs::class;
        }

        $finacial_affairs = CacheSOFA::getSOFAData($client_id, $faModel);

        $vehicles = $resident['propertyvehicle'];
        $vehicles = !empty($vehicles) ? current($vehicles->toArray()) : [];
        $vehicle_selected = !empty($vehicles) ? $vehicles['own_any_property'] : 0;
        $BIData = CacheBasicInfo::getBasicInformationData($client_id);
        $clientBasicInfoPartA = Helper::validate_key_value('BasicInfoPartA', $BIData, 'array');
        $clientBasicInfoPartB = Helper::validate_key_value('BasicInfoPartB', $BIData, 'array');
        $debtorname = ClientHelper::getDebtorName($clientBasicInfoPartA, "Debtor's");
        $spousename = ClientHelper::getDebtorName($clientBasicInfoPartB, "Co-Debtor's");
        if (Auth::user()->client_type == 2) {
            $spousename = "Non-Filing Spouse's";
        }

        $residentTypeArray = ['Current_Mortgage_Statement', 'Current_Mortgage_Statement_1_1', 'Current_Mortgage_Statement_2_1', 'Current_Mortgage_Statement_3_1', 'Current_Mortgage_Statement_1_2', 'Current_Mortgage_Statement_2_2','Current_Mortgage_Statement_3_2','Current_Mortgage_Statement_1_3','Current_Mortgage_Statement_2_3','Current_Mortgage_Statement_3_3','Current_Mortgage_Statement_1_4','Current_Mortgage_Statement_2_4','Current_Mortgage_Statement_3_4','Current_Mortgage_Statement_1_5','Current_Mortgage_Statement_2_5','Current_Mortgage_Statement_3_5'];
        $requestsort = implode(',', $residentTypeArray);

        $records = UploadedOcrData::where(['client_id' => $client_id, 'is_imported' => 0])->whereIn('document_type', $residentTypeArray)->orderByRaw(DB::raw('FIELD(document_type, ":values")', ['values' => $requestsort]))->get()->first();
        $records = isset($records) ? $records->toArray() : [];
        $mortageloanData = [];
        if (!empty($records) && in_array($records['document_type'], $residentTypeArray)) {
            $mortageloanData = $records;
        }

        $docsUploadInfo = ClientHelper::documentUploadInfo($user, $client_id, $attorney_id);

        $htmlData = [
                        'resident' => $resident,
                        'appservice_codebtors' => $appservice_codebtors,
                        'finacial_affairs' => $finacial_affairs,
                        'vehicleselected' => $vehicle_selected,
                        'BasicInfo_PartRest' => $user->getBasicInfoPartRest(true),
                        'mortageloanData' => $mortageloanData,
                        'docsUploadInfo' => $docsUploadInfo,
                        'client_user' => $user,
                        'client_id' => $client_id,
                        'can_editable' => Helper::isTabEditable('can_edit_property'),
                        'step1' => false,
                        'step2' => false,
                        'step3' => false,
                        'step4' => false,
                        'step5' => false,
                        'step6' => false,
                        'step7' => false,
                        'tab' => 'tab2',
                        'attorney_edit' => true,
                        'save_route' => '',
                        'debtorname' => $debtorname,
                        'spousename' => $spousename,
                        'traded_stocks' => [],
                        'popup_label' => '',
                    ];

        return $htmlData;
    }

    private function getVideos($step)
    {
        $videos = VideoHelper::getAdminVideos();
        $tutorial = $videos[$step] ?? [];

        return VideoHelper::getVideos($tutorial);
    }

    public function property_step1_modal_save(Request $request)
    {
        $client_id = $request->input('client_id');
        if ($request->isMethod('post')) {
            $attorney = Auth::user();
            $attorney_id = $attorney->id;
            QuestionnairePropertyResident::saveStepResident($client_id, $request, true, $attorney_id);
            $this->markReviewwedBy($attorney_id, $client_id, 'property_resident', 'Real Property', $attorney->name);

            $user = User::find($client_id);
            $propertyResident = $user->questionnairePropertyResident;
            $propertyResident = !empty($propertyResident) ? $propertyResident->toArray() : [];
            $codebtors = Creditors::geCodebtors($user->id, $user->client_type);
            $returnHTML = view('client.questionnaire.property.ajax_resident', ['appservice_codebtors' => $codebtors,'propertyresident' => $propertyResident,'attorney_edit' => true])->render();

            return response()->json(['status' => 1, 'msg' => "Data has been saved successfully.", 'display_id' => 'resident_listing_html','html' => $returnHTML, 'url' => route('attorney_form_submission_view', ['id' => $client_id]) ])->header('Content-Type: application/json;', 'charset=utf-8');
        }

        return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('error', 'Invalid Request.');
    }

    public function property_step2_modal_save(Request $request)
    {
        $client_id = $request->input('client_id');
        if ($request->isMethod('post')) {
            $attorney = Auth::user();
            $attorney_id = $attorney->id;
            QuestionnairePropertyVehicle::saveStepVehicle($client_id, $request, true, $attorney_id);
            $this->markReviewwedBy($attorney_id, $client_id, 'property_vehicle', 'Vehicles', $attorney->name);

            $user = User::find($client_id);
            $propertyVehicle = $user->questionnairePropertyVehicle()->get();
            $vehicles = !empty($propertyVehicle) ? current($propertyVehicle->toArray()) : [];
            $vehicleselected = !empty($vehicles) ? $vehicles['own_any_property'] : 0;
            $codebtors = Creditors::geCodebtors($user->id, $user->client_type);
            $returnHTML = view('client.questionnaire.property.ajax_vehicle', ['appservice_codebtors' => $codebtors,'vehicleselected' => $vehicleselected, 'propertyvehicle' => $propertyVehicle,'attorney_edit' => true])->render();

            return response()->json(['status' => 1, 'msg' => "Data has been saved successfully.", 'display_id' => 'vehicle_listing_html', 'html' => $returnHTML, 'url' => route('attorney_form_submission_view', ['id' => $client_id])  ])->header('Content-Type: application/json;', 'charset=utf-8');
        }

        return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('error', 'Invalid Request.');
    }

    public function property_step3_modal_save(Request $request)
    {
        $client_id = $request->input('client_id');
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                $attorney = Auth::user();
                $attorney_id = $attorney->id;
                QuestionnairePropertyHousehold::saveStepPersonalHouseholdItems($client_id, $request, true, $attorney_id);
                $this->markReviewwedBy($attorney_id, $client_id, 'property', "Property - Personal and Household Items", $attorney->name);
                DB::commit();

                return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('success', 'Data has been saved successfully.');
            } catch (\Exception $e) {
                DB::rollBack();

                return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('error', 'Something went wrong, try again!');
            }
        }

        return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('error', 'Invalid Request.');
    }

    public function property_step3_modal_asset_save(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $client_id = Helper::validate_key_value('client_id', $input, 'radio');
            $attorney = Auth::user();
            $attorney_id = $attorney->id;
            DB::beginTransaction();
            try {
                QuestionnairePropertyHousehold::savePropertyAsset($request, $client_id, true, $attorney_id);
                DB::commit();

                return response()->json(Helper::renderJsonSuccess("Record saved successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json(Helper::renderJsonError('Something went wrong'))->header('Content-Type: application/json;', 'charset=utf-8');
            }
        }

        return response()->json(Helper::renderJsonError('Something went wrong'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function property_step4_modal_save(Request $request)
    {
        $client_id = $request->input('client_id');
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                $attorney = Auth::user();
                $attorney_id = $attorney->id;
                QuestionnairePropertyFinancialAssets::saveStepFinancialAssets($client_id, $request, true, $attorney_id);
                $this->markReviewwedBy($attorney_id, $client_id, 'property', "Property - Financial Assets 1", $attorney->name);
                DB::commit();

                return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('success', 'Data has been saved successfully.');
            } catch (\Exception $e) {
                DB::rollBack();

                return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('error', 'Something went wrong, try again!');
            }
        }

        return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('error', 'Invalid Request.');
    }

    public function property_step5_modal_save(Request $request)
    {
        $client_id = $request->input('client_id');
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                $attorney = Auth::user();
                $attorney_id = $attorney->id;
                QuestionnairePropertyFinancialAssets::saveStepFinancialAssetsContinued($client_id, $request, true, $attorney_id);
                $this->markReviewwedBy($attorney_id, $client_id, 'property', "Property - Financial Assets Continued", $attorney->name);
                DB::commit();

                return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('success', 'Data has been saved successfully.');
            } catch (\Exception $e) {
                DB::rollBack();

                return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('error', 'Something went wrong, try again!');
            }
        }

        return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('error', 'Invalid Request.');
    }

    public function property_step6_modal_save(Request $request)
    {
        $client_id = $request->input('client_id');
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                $attorney = Auth::user();
                $attorney_id = $attorney->id;
                QuestionnairePropertyBusinessAssets::saveStepBusinessAssets($client_id, $request, true, $attorney_id);
                $this->markReviewwedBy($attorney_id, $client_id, 'property', "Property - Business-Related Assets", $attorney->name);
                DB::commit();

                return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('success', 'Data has been saved successfully.');
            } catch (\Exception $e) {
                DB::rollBack();

                return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('error', 'Something went wrong, try again!');
            }
        }

        return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('error', 'Invalid Request.');
    }

    public function property_step7_modal_save(Request $request)
    {
        $client_id = $request->input('client_id');
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                $attorney = Auth::user();
                $attorney_id = $attorney->id;
                QuestionnairePropertyFarmCommercial::saveStepPropertyFarmCommercial($client_id, $request, true, $attorney_id);
                $this->markReviewwedBy($attorney_id, $client_id, 'property', "Property - Farm and Commercial Fishing-Related", $attorney->name);
                DB::commit();

                return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('success', 'Data has been saved successfully.');
            } catch (\Exception $e) {
                DB::rollBack();

                return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('error', 'Something went wrong, try again!');
            }
        }

        return redirect()->route('attorney_form_submission_view', ['id' => $client_id])->with('error', 'Invalid Request.');
    }

    public function detailed_tab_items_popup_att_edit(Request $request)
    {
        $input = $request->all();
        $type = Helper::validate_key_value('type', $input);
        $previous_data = Helper::validate_key_value('previous_data', $input);
        $items = [];
        $title = "";
        switch ($type) {
            case 'household_goods_furnishings':
                $title = "Household Goods & Furnishings";
                $items = UtilityHelper::getHouseholdGoodsFurnishingsItemsArray();
                break;
            case 'electronics':
                $title = "Electronics";
                $items = UtilityHelper::getElectronicsItemsArray();
                break;
            case 'collectibles':
                $title = "Collectibles";
                $items = UtilityHelper::getCollectiblesItemsArray();
                break;
            case 'sports':
                $title = "Sports Equipment";
                $items = UtilityHelper::getSportsItemsArray();
                break;
            case 'everydayfinejqwl':
                $title = "Everyday and Fine Jewelry";
                $items = UtilityHelper::getEverydayAndFineJewelryItemsArray();
                break;
            case 'everydayclothing':
                $title = "Everyday Clothing";
                $items = UtilityHelper::getEverydayClothingArray();
                break;
            case 'firearms':
                $title = "Firearms";
                $items = UtilityHelper::getFirearmsArray();
                break;
            default:
                $title = '';
                $items = [];
                break;
        }

        $template = TemplateDetailedProperty::where(['attorney_id' => Helper::getCurrentAttorneyId()])->first();

        if (!empty($template)) {
            $columnName = UtilityHelper::getDetailedPropertyTableColumnNameForTemplate($type);
            $subData = Helper::validate_key_value($columnName, $template->toArray());
            if (!empty($subData)) {
                $items = json_decode($subData, true);
            }
        }

        $returnHTML = view('client.questionnaire.property.common_utility_popup')
                    ->with([
                        'type' => $type,
                        'previous_data' => $previous_data,
                        'items' => $items,
                        'title' => $title,
                        'attorney_edit' => true,
                        ])
                    ->render();

        return response()->json(['success' => true, 'html' => $returnHTML]);
    }

}
