<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ZipCode;
use App\Models\Form;
use App\Models\DistrictFormOrder;
use App\Helpers\Helper;

class DistrictFormOrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public static function defaultf()
    {
        return ["official-form-101" => ['title' => "Voluntary Petition", 'subtitle' => "(Official Form 101)", "type" => "default", "is_active" => 1,'is_uppliment' => 0],
                "official-form-106sum" => ['title' => "Summary of Schedules", 'subtitle' => "(Official Form 106Sum)", "type" => "default", "is_active" => 1,'is_uppliment' => 0],
                "official-form-106a_and_b" => ['title' => "Schedule A/B ", 'subtitle' => "(Official Form 106A/B)", "type" => "default", "is_active" => 1,'is_uppliment' => 0],
                "official-form-106c" => ['title' => "Schedule C", 'subtitle' => '(Official Form 106C)', "type" => "default", "is_active" => 1,'is_uppliment' => 0],
                "official-form-106d" => ['title' => "Schedule D", 'subtitle' => "(Official Form 106D)", "type" => "default", "is_active" => 1,'is_uppliment' => 0],
                "official-form-106e_and_f" => ['title' => "Schedule E/F", 'subtitle' => "(Official Form 106E/F)", "type" => "default", "is_active" => 1,'is_uppliment' => 0],
                "official-form-106g" => ['title' => "Schedule G", 'subtitle' => "(Official Form 106G)", "type" => "default", "is_active" => 1,'is_uppliment' => 0],
                "official-form-106h" => ['title' => "Schedule H", 'subtitle' => "(Official Form 106H)", "type" => "default", "is_active" => 1,'is_uppliment' => 0],
                "official-form-106i" => ['title' => "Schedule I", 'subtitle' => "(Official Form 106I)", "type" => "default", "is_active" => 1,'is_uppliment' => 0],
                "official-form-106j" => ['title' => "Schedule J", 'subtitle' => "(Official Form 106J)", "type" => "default", "is_active" => 1,'is_uppliment' => 0],
                "official-form-106j-2" => ['title' => "Schedule J-2", 'subtitle' => "(Official Form 106J-2)", "type" => "default", "is_active" => 1,'is_uppliment' => 0],
                "official-form-106dec" => ['title' => "Declaration Debtor's Schedules ", 'subtitle' => "(Official Form 106Dec)", "type" => "default", "is_active" => 1,'is_uppliment' => 0],
                "official-form-107" => ['title' => "Statement of Financial Affairs", 'subtitle' => "(Official Form 107)", "type" => "default", "is_active" => 1,'is_uppliment' => 0],
                "official-form-108" => ['title' => "Statement of Intent", 'subtitle' => "(Official Form 108)", "type" => "default", "is_active" => 1,'is_uppliment' => 0],
                "official-form-110" => ['title' => "Notice of Required by 11 U.S.C.§ 342(b)", 'subtitle' => "(Form 2010)", "type" => "default", "is_active" => 1,'is_uppliment' => 0],
                "official-form-111" => ['title' => "Disclosure of Compensation of Atty", 'subtitle' => "(Form 2030)", "type" => "default", "is_active" => 1,'is_uppliment' => 0],
                "official-form-109" => ['title' => "Chapter 7 Means Test", 'subtitle' => "(Official Form 122A-1)", "type" => "default", "is_active" => 1,'is_uppliment' => 0],
                "official-form-122a─1supp" => ['title' => "Means Test - Exemption", 'subtitle' => "", "type" => "default", "is_active" => 0,'is_uppliment' => 1],
                "official-form-122a─2" => ['title' => "Chapter 7 Means Test Calculation", 'subtitle' => "(Official Form 122A-2)", "type" => "default", "is_active" => 0,'is_uppliment' => 1],
                "official-form-121" => ["title" => "SSN Statement", "subtitle" => "", "type" => "default", "is_active" => 1,'is_uppliment' => 0],
                "official_form_mailing_matrix" => ["title" => "Verification of Mailing Matrix", "subtitle" => "", "type" => "local", "is_active" => 1,'is_uppliment' => 0],


    ];
    }

    public function index(Request $request)
    {

        $district_names = ZipCode::groupBy("district_name")->orderBy('short_name', "asc")->where("short_name", "!=", null)->select('short_name', 'district_name', 'id');
        $dstricts = $district_names->get();
        $thisdistrict_names = $district_names;
        $list = $thisdistrict_names->first()->toArray();
        $district_id = $request->query('district') ?? $list['id'];
        $formType = $request->query('form_type') ?? 'default';
        $forms = Form::where("form_name", "!=", null)->orderBy('sorting_order', 'asc')->select('form_name', 'zipcode', 'type', 'form_id', 'form_tab_description', 'sorting_order');
        $forms->where('zipcode', '=', $district_id);
        $forms->where('type', '=', $formType);
        $forms = $forms->get();

        return view('admin.district.view', ['district_names' => $dstricts, 'form_type' => $formType,'district' => $district_id,'forms' => $forms]);
    }

    public function importDefault()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
          CURLOPT_URL => 'https://app.bkassistant.trilloapps.com/api/v1.1/ocr/inline/DocAIProcessorInteractive',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => ['file' => curl_file_create('/Users/amitkumar/Desktop/document for scan/mortgage/Gregory Funding Mortgage Statement-07122022132719.pdf'),'processorType' => 'mortgageStatement'],
          CURLOPT_HTTPHEADER => [
            'authorization: Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOjAsInVzZXJJZCI6InRBMGJpZW1LaDV5Umx0T18iLCJyb2xlIjoic2VydmljZSIsIm9yZ05hbWUiOiJjbG91ZCIsImFwcE9yZ05hbWUiOiJjbG91ZCIsImVtYWlsIjoidEEwYmllbUtoNXlSbHRPX0BjbG91ZCIsImVtYWlsVmVyaWZpZWQiOiJ0cnVlIiwiaXNzIjoiYXBwLmJrYXNzaXN0YW50LnRyaWxsb2FwcHMuY29tIiwianRpIjoiODlmYjIyNGEtNWExMi00NGM0LTg5NGUtN2JlNmI0YzgxZjg4IiwiaWF0IjoxNjY1MDc1Njk3LCJleHAiOjE2NjUxNjIwOTd9.aBAHb6uCib4uHQaN30X2GtEYCiaK_YUKov2WPk9inkDU3Bwi2xT2AClJdygQs25DyG5ZFxfhe1BjalnQteD5Sg',
            'accept: */*',
            'x-org-name: cloud',
            'Cookie: JSESSIONID=054D07BF89975D561A5EBEEE61AAB76D; last-interaction-at=1665112539012; permitted_inactivity_duration=3600000'
          ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;

    }


    public function get_district_from_order($district_id)
    {
        $destrict_form = DistrictFormOrder::where('district_id', $district_id)->first();
        //*******15-09-2022 Start**********
        $from_data_result['default'] = [];
        $from_data_result['local'] = [];

        if (!empty($destrict_form)) {
            $form_id_arr = explode(',', $destrict_form->form_id);
            $default_check_arr = explode(',', $destrict_form->default_check);
            foreach ($form_id_arr as $key => $form) {
                $form_data = Form::find($form);
                $from_data_result['default'][$key]['id'] = $form_data->form_id;
                $from_data_result['default'][$key]['title'] = $form_data->form_name;
                $from_data_result['default'][$key]['tab_id'] = $form_data->form_tab;
                $from_data_result['default'][$key]['default_check'] = 1;
                if ($destrict_form->default_check != null) {
                    $from_data_result['default'][$key]['default_check'] = $default_check_arr[$key];
                }
            }
            //print_r($default_check_arr);
            /*New Logic*/
            $forms = Form::where('type', "default")->get();
            foreach ($forms as $key => $form) {
                if (!in_array($form->form_id, $form_id_arr)) {
                    //echo $form->form_name;
                    $from_data_result['default'][$key]['id'] = $form->form_id;
                    $from_data_result['default'][$key]['title'] = $form->form_name;
                    $from_data_result['default'][$key]['tab_id'] = $form->form_tab;
                    $from_data_result['default'][$key]['default_check'] = 1;
                    $form_id_arr[] = $form->form_id;
                }
            }

            $form_id_arr_str = implode(',', $form_id_arr);
            $destrict_form->form_id = $form_id_arr_str;
            $destrict_form->save();

            if ($destrict_form->local_form_id != null) {
                $local_form_id_arr = explode(',', $destrict_form->local_form_id);
                $local_check_arr = explode(',', $destrict_form->local_check);
                foreach ($local_form_id_arr as $key => $form) {
                    $form_data = Form::find($form);
                    $from_data_result['local'][$key]['id'] = $form_data->form_id;
                    $from_data_result['local'][$key]['title'] = $form_data->form_name;
                    $from_data_result['local'][$key]['tab_id'] = $form_data->form_tab;
                    $from_data_result['default'][$key]['local_check'] = 1;
                    if ($destrict_form->local_check != null) {
                        $from_data_result['default'][$key]['local_check'] = $local_check_arr[$key];
                    }
                }

                $forms = Form::where('zipcode', $district_id)->get();
                foreach ($forms as $key => $form) {
                    if (!in_array($form->form_id, $local_form_id_arr)) {
                        //echo $form->form_name;
                        $from_data_result['local'][$key]['id'] = $form->form_id;
                        $from_data_result['local'][$key]['title'] = $form->form_name;
                        $from_data_result['local'][$key]['tab_id'] = $form->form_tab;
                        $from_data_result['default'][$key]['local_check'] = 1;
                        $local_form_id_arr[] = $form->form_id;
                    }
                }
                $local_form_id_arr_str = implode(',', $local_form_id_arr);
                $destrict_form->local_form_id = $local_form_id_arr_str;
                $destrict_form->save();
            } else {
                $local_forms = Form::where('zipcode', $district_id)->get();
                foreach ($local_forms as $key => $local_form) {
                    $from_data_result['local'][$key]['id'] = $local_form->form_id;
                    $from_data_result['local'][$key]['title'] = $local_form->form_name;
                    $from_data_result['local'][$key]['tab_id'] = $local_form->form_tab;
                    $from_data_result['default'][$key]['local_check'] = 1;
                }
            }
        } else {
            $forms = Form::where('type', "default")->get();
            foreach ($forms as $key => $from) {
                $from_data_result['default'][$key]['id'] = $from->form_id;
                $from_data_result['default'][$key]['title'] = $from->form_name;
                $from_data_result['default'][$key]['tab_id'] = $from->form_tab;
                $from_data_result['default'][$key]['default_check'] = 1;
            }

            $local_forms = Form::where('zipcode', $district_id)->get();
            foreach ($local_forms as $key => $local_form) {
                $from_data_result['local'][$key]['id'] = $local_form->form_id;
                $from_data_result['local'][$key]['title'] = $local_form->form_name;
                $from_data_result['local'][$key]['tab_id'] = $local_form->form_tab;
                $from_data_result['default'][$key]['local_check'] = 1;
            }
        }


        //*******15-09-2022 End**********
        return json_encode($from_data_result);
    }


    public function save_district_form_order(Request $request)
    {
        // $destrict_form = DistrictFormOrder::where('district_id', $district_id)->first();
        if ($request->isMethod('post')) {
            $input = $request->all();
            $this->updateOrder($input['pageList']);
        }

        return response()->json(Helper::renderJsonSuccess('Sorting order updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function updateOrder($order)
    {
        if (is_array($order) && sizeof($order) > 0) {
            foreach ($order as $i => $id) {
                if ($id < 1) {
                    continue;
                }
                Form::where(['form_id' => $id])->update(['sorting_order' => $i]);
            }

            return true;
        }

        return false;
    }

}
