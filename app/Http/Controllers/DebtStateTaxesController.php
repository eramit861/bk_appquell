<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DebtStateTaxes;
use Exception;
use App\Helpers\Helper;

class DebtStateTaxesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $debtstaxes = DebtStateTaxes::where("stax_name", "!=", null)->orderBy('stax_name', 'asc')->select('stax_name', 'stax_address1', 'stax_address2', 'stax_address3', 'stax_city', 'stax_state', 'stax_zip', 'id');
        if (!empty($request->query('q'))) {
            $debtstaxes->Where(function ($query) use ($request) {
                $query->Where('stax_name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('stax_address1', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('stax_address2', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('stax_address3', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('stax_city', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('stax_state', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('stax_zip', 'like', '%' . $request->query('q') . '%');
            });
        }
        $debtstaxes = $debtstaxes->paginate(10);
        $keyword = $request->query('q') ?? '';

        return view('admin.debtstaxes.show')->with(['keyword' => $keyword,'debtstaxes' => $debtstaxes]);
    }



    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'stax_name' => 'required',
                'stax_city' => 'required',
                'stax_state' => 'required',
                'stax_zip' => 'required'

            ]);
            $debtstax = new DebtStateTaxes();
            $debtstax->stax_name = $request->stax_name;
            $debtstax->stax_address1 = $request->stax_address1 ?? '';
            $debtstax->stax_address2 = $request->stax_address2 ?? '';
            $debtstax->stax_address3 = $request->stax_address3 ?? '';
            $debtstax->stax_city = $request->stax_city;
            $debtstax->stax_state = $request->stax_state;
            $debtstax->stax_zip = $request->stax_zip;
            $debtstax->stax_contact = $request->stax_contact ?? '';
            if ($debtstax->save()) {
                return redirect()->route('admin_debtstaxes_index')->with('success', 'Record has been added successfully.');
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
        $debtstax = DebtStateTaxes::find($id);

        return view('admin.debtstaxes.edit')->with('debtstax', $debtstax);
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
            'stax_name' => 'required',

            'stax_city' => 'required',
            'stax_state' => 'required',
            'stax_zip' => 'required',

        ]);
        try {
            DebtStateTaxes::where('id', $id)->update([
                "stax_name" => $request->stax_name,
                "stax_address1" => $request->stax_address1 ?? '',
                "stax_address2" => $request->stax_address2 ?? '',
                "stax_address3" => $request->stax_address3 ?? '',
                "stax_city" => $request->stax_city,
                "stax_state" => $request->stax_state,
                "stax_zip" => $request->stax_zip,
                "stax_contact" => $request->stax_contact,

            ]);

            return redirect()->route('admin_debtstaxes_index')->with('success', 'Record has been updated successfully.');
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
        DebtStateTaxes::where('id', $request->id)->delete();
        header("Refresh:0");

        return response()->json(Helper::renderJsonSuccess('Record Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }
}
