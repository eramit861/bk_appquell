<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CountyFipsData;
use App\Models\StateDivisions;
use App\Models\State;
use Exception;
use App\Helpers\Helper;

class AdminCountyFipsController extends Controller
{
    public function index(Request $request)
    {
        $stateId = 1;
        if (!empty($request->query('state_id'))) {
            $stateId = $request->query('state_id');
        }
        $countyFipsData = CountyFipsData::where("state_id", "=", $stateId)->orderBy('county_name', 'asc')->select('id', 'state_id', 'state_name', 'county_name', 'fips_code');
        $stateList = State::groupBy("state_name")->orderBy('state_name', "asc")->where("state_name", "!=", null)->where('state_name', '!=', 'Jakarta')->get();
        if (!empty($request->query('q'))) {
            $countyFipsData->Where(function ($query) use ($request) {
                $query->Where('state_name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('county_name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('fips_code', 'like', '%' . $request->query('q') . '%');
            });
        }

        $countyFipsData = $countyFipsData->paginate(10);
        $keyword = $request->query('q') ?? '';

        return view('admin.county_fips.show')->with(['stateId' => $stateId,'keyword' => $keyword,'countyFipsData' => $countyFipsData, 'stateList' => $stateList]);
    }

    public function create(Request $request)
    {

        if ($request->isMethod('post')) {
            $this->validate($request, [
                'state_name' => 'required',
                'county_name' => 'required',
                'fips_code' => 'required',
            ]);
            $stateId = $request->state_name;
            $stateName = State::select("state_name")->where("state_id", "=", $stateId)->first();
            $stateName = $stateName['state_name'];
            $stateArray = explode("(", $stateName);
            $stateName = $stateArray[0] ?? '';
            $stateName = trim($stateName);
            $CountyList = new CountyFipsData();
            $CountyList->state_id = $stateId;
            $CountyList->state_name = $stateName;
            $CountyList->county_name = $request->county_name;
            $CountyList->fips_code = $request->fips_code;
            if ($CountyList->save()) {
                return redirect()->route('admin_fips_index')->with('success', 'County has been added successfully.');
            } else {
                return redirect()->back()->withError("something went wrong");
            }
        } else {
            return redirect()->back()->with('error', 'Not a valid request, Please check.');
        }
    }

    public function edit($id)
    {
        $stateCounty = CountyFipsData::where('id', $id)->first();
        $state = State::where('state_id', $stateCounty['state_id'])->first();
        $state = !empty($state) ? $state->toArray() : [];
        $divisions = StateDivisions::getDivisions($state['state_code']);

        return view('admin.county_fips.edit')->with(['stateCounty' => $stateCounty, 'divisions' => $divisions]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'state_name' => 'required',
            'county_name' => 'required',
            'fips_code' => 'required',
        ]);
        try {
            CountyFipsData::where('id', $id)->update([
                "state_name" => $request->state_name,
                "county_name" => $request->county_name,
                "fips_code" => $request->fips_code,
                "fips_division" => $request->fips_division
            ]);
            $stateCounty = CountyFipsData::where('id', $id)->first();

            return redirect()->route('admin_fips_index', ['state_id' => $stateCounty['state_id']])->with('success', 'County details has been updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }

    }

    public function delete(Request $request)
    {
        CountyFipsData::where('id', $request->id)->delete();

        return response()->json(Helper::renderJsonSuccess('County Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }
}
