<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;
use App\Models\ZipCode;
use Exception;

class AdminZipCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $district_names = ZipCode::groupBy("district_name")->orderBy('short_name', "asc")->where("short_name", "!=", null)->get();

        return view('admin.zipcode.show')->with('district_names', $district_names);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $local_forms = Form::where('type', 'local')->get();

        return view('admin.zipcode.add')->with('local_forms', $local_forms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'district_name' => 'required',
            'division_name' => 'required',
            'zip_code' => 'required'
        ]);

        $data = "";
        $split = explode(" ", $request->district_name);
        $data = $split[count($split) - 1];
        $all_zip_codes = explode(',', trim($request->zip_code));

        $zipcode = new ZipCode();
        $zipcode->district_name = $request->district_name;
        $zipcode->short_name = $data;
        $zipcode->division_name = $request->division_name;
        $zipcode->assign_forms = $request->assign_forms;
        $zipcode->zip_code = $all_zip_codes;
        if ($zipcode->save()) {
            return redirect()->route('admin_zipcode_index');
        } else {
            return redirect()->back()->withError("something went wrong");
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
        $local_forms = Form::where('type', 'local')->get();
        // $zip_code = ZipCode::whereJsonContains('zip_code', '95646')->get();
        $zip_code = ZipCode::where('id', $id)->first();

        return view('admin.zipcode.edit')->with('zip_code', $zip_code)->with('local_forms', $local_forms);
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
            'district_name' => 'required',
            'division_name' => 'required',
            'zip_code' => 'required'
        ]);
        try {
            $data = "";
            $split = explode(" ", $request->district_name);
            $data = $split[count($split) - 1];
            $all_zip_codes = explode(',', trim($request->zip_code));
            ZipCode::where('id', $id)->update([
                "district_name" => $request->district_name,
                "short_name" => $data,
                "division_name" => $request->division_name,
                "zip_code" => $all_zip_codes,
                "assign_forms" => $request->assign_forms
            ]);

            return redirect()->route('admin_zipcode_index');
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
    public function destroy($id)
    {
        ZipCode::where('id', $id)->delete();

        return redirect()->route('admin_zipcode_index')->with('success', 'Record deleted successfully.');

    }

    public function getDivisionNames(Request $request)
    {

        $data = ZipCode::where("id", $request->district_id)
                    ->get(["division_name"]);

        return response()->json($data);
    }

    public function getZipCodes(Request $request)
    {

        $data = ZipCode::where("id", $request->district_id)->where("division_name", $request->division_name)
                    ->get(["zip_code","id"]);

        return response()->json($data);
    }
}
