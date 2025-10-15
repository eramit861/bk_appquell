<?php

namespace App\Http\Controllers;

use App\Helpers\AddressHelper;
use App\Helpers\Helper;
use App\Http\Requests\AdminFormRequest;
use Illuminate\Http\Request;
use App\Models\Form;
use App\Models\ZipCode;
use App\Models\Districts;
use App\Models\AdditionalForms;
use App\Models\StateTrustee;
use App\Services\AdminFormService;
use Exception;
use Illuminate\Database\QueryException;

class AdminFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $district_name = Districts::orderBy('sort_order', "asc")->where("short_name", "!=", null)->select('short_name', 'district_name', 'id');
        $dstricts = $district_name->get();
        $fthisdistrict_names = $district_name;
        $list = $fthisdistrict_names->first()->toArray();
        $district_id = $request->query('district') ?? $list['id'];
        $forms = Form::select('form_name', 'chapter_type', 'type', 'form_id')->where('zipcode', $district_id)->orderby('type', 'desc')->orderby('chapter_type', 'asc')->get();

        return view('admin.forms.show')->with(['district' => $district_id,'district_names' => $dstricts, 'forms' => $forms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $district_names = ZipCode::select('district_name', 'id', 'short_name')
            ->groupBy("district_name")
            ->orderBy('short_name')
            ->whereNotNull("short_name")->get();

        return view('admin.forms.add', ['district_names' => $district_names]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(AdminFormRequest $request, AdminFormService $adminFormService)
    {
        try {
            $form = $adminFormService->createForm($request);
            $adminFormService->addFormToDistrictOder($request, $form->form_id);

            return redirect()->route('admin_forms_index');
        } catch (QueryException $th) {
            return back()->withError($th->getMessage())->withInput();
        } catch (Exception $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }


    public function edit($form_id)
    {
        $form = Form::where('form_id', $form_id)->first();
        $district_names = ZipCode::select('district_name', 'id', 'short_name')
            ->groupBy("district_name")
            ->orderBy('short_name')
            ->whereNotNull("short_name")
            ->get();

        return view('admin.forms.edit', ['district_names' => $district_names])
            ->with('form', $form);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $form_id
     */
    public function update(AdminFormRequest $request, $form_id)
    {
        $adminFormService = new AdminFormService();
        try {
            $form = Form::where('form_id', $form_id)->firstOrFail();
            $adminFormService->updateForm($request, $form);

            return redirect()->route('admin_forms_index');
        } catch (QueryException $th) {
            return back()->withError($th->getMessage())->withInput();
        } catch (Exception $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy($form_id)
    {
        (new AdminFormService())->destroyForm($form_id);

        return redirect()->Route('admin_forms_index')->with('success', 'Record successfully deleted.');
    }

    public function openAdditionalFormPopup(Request $request)
    {
        $input = $request->all();
        $district_id = $input['district_id'];
        $form = AdditionalForms::where('district_id', $district_id)->first();
        $form = !empty($form) ? $form->toArray() : [];

        return view('admin.forms.popup', ['district_id' => $district_id, 'additional_form_url' => ($form['additional_form_url'] ?? '')]);
    }


    public function additional_form_update(Request $request, $district_id)
    {
        $input = $request->all();
        $additional_form_url = $input['additional_form_url'];
        AdditionalForms::updateOrCreate(['district_id' => $district_id], ['district_id' => $district_id,'additional_form_url' => $additional_form_url]);

        return redirect()->Route('admin_forms_index')->with('success', 'Information updated successfully.');
    }

    public function get_trustee_list_for_form(Request $request)
    {
        if ($request->isMethod('post')) {

            $inputData = $request->all();

            $district_name = Helper::validate_key_value('state', $inputData);
            $selected_item = Helper::validate_key_value('selected_item', $inputData);
            $state_code = AddressHelper::getStateCodeByStateNameForJubliee($district_name);
            $trustees = StateTrustee::getTrustee($state_code);

            $renderData = [
                'trustees' => $trustees,
                'selected_item' => $selected_item
            ];

            $html = view('admin.forms.trustee_list', $renderData)->render();

            return response()->json([
                'status' => true,
                'html' => $html
            ]);
        }
    }
}
