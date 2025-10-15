<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExemptionList;
use App\Models\ZipCode;
use App\Models\State;
use Exception;
use App\Helpers\Helper;

class ExemptionListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $state = State::select('state_code', 'state_name')->orderBy('state_name', "asc")->where("state_code", "!=", null)->where('state_name', '!=', 'Jakarta')->first();

        $district_id = $request->query('district') ?? $state['state_code'];
        $exemption_type = $request->query('exemption_type') ?? 'State';
        $exemptions = ExemptionList::where("exemption_type", "!=", null)->orderBy('exemption_type', 'asc');

        $exemptions->where('state_name', '=', $district_id);
        $exemptions->where('exemption_type', '=', $exemption_type);
        $exemptions->select(['id','relate', 'exemption_type', 'exemption_description', 'state_name', 'exemption_statute', 'exemption_limit_individual', 'exemption_limit_joint']);
        if (!empty($request->query('q'))) {
            $exemptions->Where(function ($query) use ($request) {
                $query->Where('exemption_type', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('relate', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('exemption_description', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('state_name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('exemption_statute', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('exemption_limit_individual', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('exemption_limit_joint', 'like', '%' . $request->query('q') . '%');
            });
        }


        $exemptions = $exemptions->orderBy('id', 'DESC')->get();
        $keyword = $request->query('q') ?? '';

        return view('admin.exemption.show')->with(['exemption_type' => $exemption_type, 'district' => $district_id, 'keyword' => $keyword, 'exemptions' => $exemptions]);
    }




    public function create(Request $request)
    {
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'state_name' => 'required',
                'exemption_type' => 'required',
                'exemption_description' => 'required',
                'exemption_statute' => 'required',
                'exemption_limit_individual' => 'nullable|string',
                'exemption_limit_joint' => 'nullable|string',
                'relate' => 'nullable|string',
            ]);
            $timestamp = date("Y-m-d H:i:s");
            $exemption = new ExemptionList();
            $exemption->state_name = $request->state_name;
            $exemption->exemption_type = $request->exemption_type;
            $exemption->exemption_description = $request->exemption_description;
            $exemption->exemption_statute = $request->exemption_statute;
            $exemption->exemption_limit_individual = $request->exemption_limit_individual;
            $exemption->exemption_limit_joint = $request->exemption_limit_joint;
            $exemption->created_at = $timestamp;
            $exemption->updated_at = $timestamp;
            $exemption->relate = $request->relate;

            if ($exemption->save()) {
                return redirect()->route('exemption_list')->with('success', 'Record has been added successfully.');
            } else {
                return redirect()->back()->withError("something went wrong");
            }
        } else {
            return redirect()->back()->with('error', 'Not a valid request, Please check.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $exemption = ExemptionList::find($id);
        $district_names = ZipCode::select('district_name', 'id', 'short_name')->groupBy("short_name")->orderBy('short_name', "asc")->where("short_name", "!=", null)->get();

        return view('admin.exemption.edit')->with(['district_names' => $district_names, 'exemption' => $exemption]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'state_name' => 'required',
            'exemption_type' => 'required',
            'exemption_description' => 'required',
            'exemption_statute' => 'required',
            'exemption_limit_individual' => 'nullable|string',
            'exemption_limit_joint' => 'nullable|string',
            'relate' => 'nullable|string',
        ]);
        $timestamp = date("Y-m-d H:i:s");
        try {
            ExemptionList::where('id', $id)->update([
                "state_name" => $request->state_name,
                "exemption_type" => $request->exemption_type,
                "exemption_description" => $request->exemption_description,
                "exemption_statute" => $request->exemption_statute,
                "exemption_limit_individual" => $request->exemption_limit_individual,
                "exemption_limit_joint" => $request->exemption_limit_joint,
                "updated_at" => $timestamp,
                "relate" => $request->relate
            ]);

            return redirect()->route('exemption_list')->with('success', 'Record has been updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        ExemptionList::where('id', $request->id)->delete();

        return response()->json(Helper::renderJsonSuccess('Record Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }
}
