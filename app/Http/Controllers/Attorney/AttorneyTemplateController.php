<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use App\Helpers\UtilityHelper;
use Illuminate\Http\Request;
use App\Helpers\VideoHelper;
use App\Models\Template;
use App\Models\TemplateDetailedProperty;

class AttorneyTemplateController extends AttorneyController
{
    public function template_management(Request $request, $type = '', $subType = '')
    {
        $type = empty($type) ? 'personal_household_items' : $type;
        $subType = empty($subType) ? 'data_household_goods_furnishings_items' : $subType;

        if (in_array($type, ['personal_household_items','financial_assets', 'money_own_to_you'])) {
            $templateData = self::getTemplateData($type);
        }
        if ($type == 'detailed_property') {
            $templateData = self::getDetailedPropertyTemplateData($subType);
        }

        $invite_video = VideoHelper::getAttorneyVideos(Helper::INVITE_CLIENT_VIDEO);
        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_CLIENT_MANAGEMENT_VIDEO);

        return view('attorney.template_management', [
                                                        'type' => $type,
                                                        'subType' => $subType,
                                                        'video' => $video,
                                                        'invite_video' => $invite_video,
                                                        'templateData' => $templateData
                                                    ]);
    }


    public function template_data_save(Request $request)
    {

        if ($request->isMethod('post')) {

            $input = $request->all();
            $type = $input['type'];

            unset($input['_token']);
            unset($input['type']);

            $dataTosave = [
                            'attorney_id' => Helper::getCurrentAttorneyId(),
                            'type' => $type,
                            'data' => json_encode($input),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                          ];

            Template::updateOrCreate(['attorney_id' => Helper::getCurrentAttorneyId(), 'type' => $type], $dataTosave);

            return redirect()->back()->with('success', 'Template Updated Successfully.');
        }

        return redirect()->back()->with('error', 'Not a valid request, Please check.');

    }

    public function detailed_property_template_data_save(Request $request)
    {

        if ($request->isMethod('post')) {

            $attorney_id = Helper::getCurrentAttorneyId();
            $input = $request->all();
            $subType = Helper::validate_key_value('subType', $input);

            unset($input['_token']);
            unset($input['subType']);

            $formattedInput = self::getFormattedDetailedPropertyInput($input);

            $dataTosave = [
                            'attorney_id' => $attorney_id,
                            $subType => json_encode($formattedInput),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                          ];

            TemplateDetailedProperty::updateOrCreate(['attorney_id' => $attorney_id], $dataTosave);

            return redirect()->back()->with('success', 'Template Updated Successfully.');
        }

        return redirect()->back()->with('error', 'Not a valid request, Please check.');

    }

    public static function getFormattedDetailedPropertyInput($input)
    {
        $data = [];

        if (!empty($input)) {
            foreach ($input as $key => $typeData) {
                $itemLabel = Helper::validate_key_value('category', $typeData);
                $itemData = Helper::validate_key_value('data', $typeData);
                if (!empty($itemData)) {
                    foreach ($itemData as $index => $dataObject) {
                        $hint = Helper::validate_key_value('hint', $dataObject);
                        if (!empty($hint)) {
                            $trimmedHint = trim($hint);
                            if (!(str_starts_with($trimmedHint, '(') && str_ends_with($trimmedHint, ')'))) {
                                $hint = '(' . $trimmedHint . ')';
                                $itemData[$index]['hint'] = $hint; // Update the itemData array
                            }
                        }
                    }
                };
                $data[$itemLabel] = !empty($itemData) ? $itemData : [];
            }
        }

        return $data;
    }
    public static function getTemplateData($type)
    {
        $template = Template::where(['attorney_id' => Helper::getCurrentAttorneyId(), 'type' => $type])->first();

        $templateData = [];
        if (!empty($template)) {
            $templateData = $template->data;
            $templateData = json_decode($templateData, true);
        }

        return $templateData;
    }

    public static function getDetailedPropertyTemplateData($subType)
    {
        $template = TemplateDetailedProperty::where(['attorney_id' => Helper::getCurrentAttorneyId()])->first();

        $templateData = [];
        switch ($subType) {
            case 'data_household_goods_furnishings_items':
                $templateData['data_household_goods_furnishings_items'] = UtilityHelper::getHouseholdGoodsFurnishingsItemsArray();
                break;
            case 'data_electronics_items':
                $templateData['data_electronics_items'] = UtilityHelper::getElectronicsItemsArray();
                break;
            case 'data_collectibles_items':
                $templateData['data_collectibles_items'] = UtilityHelper::getCollectiblesItemsArray();
                break;
            case 'data_sports_items':
                $templateData['data_sports_items'] = UtilityHelper::getSportsItemsArray();
                break;
            case 'data_firearms_items':
                $templateData['data_firearms_items'] = UtilityHelper::getFirearmsArray();
                break;
            case 'data_everyday_clothing_items':
                $templateData['data_everyday_clothing_items'] = UtilityHelper::getEverydayClothingArray();
                break;
            case 'data_everyday_and_fine_jewelry_items':
                $templateData['data_everyday_and_fine_jewelry_items'] = UtilityHelper::getEverydayAndFineJewelryItemsArray();
                break;
        }

        if (!empty($template)) {
            $subData = Helper::validate_key_value($subType, $template->toArray());
            if (!empty($subData)) {
                $templateData[$subType] = json_decode($subData, true);
            }
        }

        return $templateData;
    }

    public static function getFinancialAssetsTemplateData($subType)
    {
        $template = TemplateDetailedProperty::where(['attorney_id' => Helper::getCurrentAttorneyId()])->first();

        $templateData = [];
        switch ($subType) {
            case 'data_household_goods_furnishings_items':
                $templateData['data_household_goods_furnishings_items'] = UtilityHelper::getHouseholdGoodsFurnishingsItemsArray();
                break;
            case 'data_electronics_items':
                $templateData['data_electronics_items'] = UtilityHelper::getElectronicsItemsArray();
                break;
            case 'data_collectibles_items':
                $templateData['data_collectibles_items'] = UtilityHelper::getCollectiblesItemsArray();
                break;
            case 'data_sports_items':
                $templateData['data_sports_items'] = UtilityHelper::getSportsItemsArray();
                break;
            case 'data_firearms_items':
                $templateData['data_firearms_items'] = UtilityHelper::getFirearmsArray();
                break;
            case 'data_everyday_clothing_items':
                $templateData['data_everyday_clothing_items'] = UtilityHelper::getEverydayClothingArray();
                break;
            case 'data_everyday_and_fine_jewelry_items':
                $templateData['data_everyday_and_fine_jewelry_items'] = UtilityHelper::getEverydayAndFineJewelryItemsArray();
                break;
        }

        if (!empty($template)) {
            $subData = Helper::validate_key_value($subType, $template->toArray());
            if (!empty($subData)) {
                $templateData[$subType] = json_decode($subData, true);
            }
        }

        return $templateData;
    }

}
