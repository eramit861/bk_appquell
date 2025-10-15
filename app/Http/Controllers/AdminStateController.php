<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\State;
use App\Models\StateDivisions;
use Exception;
use App\Helpers\Helper;
use App\Models\StateTrustee;

class AdminStateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $states = State::where("state_code", "!=", null)->where('state_name', '!=', 'Jakarta')->orderBy('state_name', 'asc')->select('state_name', 'state_code', 'state_status', 'state_id');

        if (!empty($request->query('q'))) {
            $states->Where(function ($query) use ($request) {
                $query->Where('state_name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('state_code', 'like', '%' . $request->query('q') . '%');
            });
        }
        $states = $states->paginate(10);
        $keyword = $request->query('q') ?? '';

        return view('admin.state.show')->with(['keyword' => $keyword,'states' => $states]);
    }


    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'state_name' => 'required|alpha_dash_space|unique:App\Models\State,state_name',
                'state_code' => 'required|alpha_dash_space|unique:App\Models\State,state_code',
                'state_status' => 'required',
            ]);



            $state = new State();
            $state->state_code = $request->state_code;
            $state->state_name = $request->state_name;
            $state->state_status = $request->state_status;
            if ($state->save()) {
                return redirect()->route('admin_state_index')->with('success', 'State has been added successfully.');
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
    public function edit($state_id)
    {
        $state = State::where('state_id', $state_id)->first();

        return view('admin.state.edit')->with('state', $state);
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
            'state_code' => 'required',
            'state_status' => 'required',
        ]);
        try {
            State::where('state_id', $id)->update([
                "state_name" => $request->state_name,
                "state_code" => $request->state_code,
                "state_status" => $request->state_status,
            ]);

            return redirect()->route('admin_state_index')->with('success', 'State has been updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $state_id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        State::where('state_id', $request->state_id)->delete();

        return response()->json(Helper::renderJsonSuccess('State Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function list_divisions(Request $request)
    {
        $input = $request->all();
        $state_code = $input['state_code'];
        $divisions = StateDivisions::getDivisions($state_code);

        return view('admin.state.popup', ['state_code' => $state_code, 'divisions' => $divisions]);
    }

    public function add_division_to_state(Request $request, $state_code)
    {
        $input = $request->all();
        $division_name = $input['division_name'];
        StateDivisions::updateOrCreate(['state_code' => $state_code,'division_name' => $division_name], ['state_code' => $state_code,'division_name' => $division_name]);

        return redirect()->Route('admin_state_index')->with('success', 'Information updated successfully.');
    }

    public function update_id_in_jubliee(Request $request)
    {
        $input = $request->all();
        $id_in_table = $input['id'];
        $id_to_update = $input['id_value'];
        StateDivisions::where(['id' => $id_in_table])->update(['id_in_jubliee' => $id_to_update]);

        return response()->json(Helper::renderJsonSuccess('ID in Jubliee saved Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function list_trustee(Request $request)
    {
        $input = $request->all();
        $state_code = $input['state_code'];
        $trustee = StateTrustee::getTrustee($state_code);

        return view('admin.state.trustee_popup', ['state_code' => $state_code, 'trustee' => $trustee]);
    }

    public function add_trustee_to_state(Request $request, $state_code)
    {
        $input = $request->all();
        $trustee_name = $input['trustee_name'];
        StateTrustee::updateOrCreate(['state_code' => $state_code,'trustee_name' => $trustee_name], ['state_code' => $state_code,'trustee_name' => $trustee_name]);

        return redirect()->Route('admin_state_index')->with('success', 'Trustee added successfully.');
    }
}
