<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AutoLoanCompanies;
use Exception;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;

class AutoLoanCompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companies = AutoLoanCompanies::where("alcomp_name", "!=", null)->orderBy('active_status', 'asc')->orderBy('alcomp_name', 'asc')->select('alcomp_name', 'alcomp_address', 'alcomp_city', 'alcomp_state', 'alcomp_zip', 'alcomp_website', 'id', 'is_ocr_available', 'added_by_id', 'active_status');
        if (!empty($request->query('q'))) {
            $companies->Where(function ($query) use ($request) {
                $query->Where('alcomp_name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('alcomp_address', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('alcomp_city', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('alcomp_state', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('alcomp_zip', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('alcomp_website', 'like', '%' . $request->query('q') . '%');
            });
        }
        $companies = $companies->paginate(10);
        //dump($client->getBindings());
        $keyword = $request->query('q') ?? '';

        return view('admin.loancompanies.show')->with(['keyword' => $keyword,'companies' => $companies]);
    }

    public function create(Request $request)
    {
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'alcomp_name' => 'required',
                'alcomp_city' => 'required',
                'alcomp_state' => 'required',
                'alcomp_zip' => 'required',
                'is_ocr_available' => 'required',

            ]);

            $company = new AutoLoanCompanies();
            $company->alcomp_name = $request->alcomp_name;
            $company->alcomp_address = $request->alcomp_address;
            $company->alcomp_city = $request->alcomp_city;
            $company->alcomp_state = $request->alcomp_state;
            $company->alcomp_zip = $request->alcomp_zip;
            $company->alcomp_website = $request->alcomp_website ?? '';
            $company->is_ocr_available = $request->is_ocr_available;
            $company->ocr_sample_image = $request->ocr_sample_image ?? '';
            $company->added_by_id = Auth::user()->id;
            $company->active_status = 1;

            if ($company->save()) {
                return redirect()->route('admin_loancompanies_index')->with('success', 'Record has been added successfully.');
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
        $company = AutoLoanCompanies::find($id);

        return view('admin.loancompanies.edit')->with('company', $company);
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
            'alcomp_name' => 'required',
            'alcomp_city' => 'required',
            'alcomp_state' => 'required',
            'alcomp_zip' => 'required',
            'is_ocr_available' => 'required'
        ]);
        try {
            AutoLoanCompanies::where('id', $id)->update([
                "alcomp_name" => $request->alcomp_name,
                "alcomp_address" => $request->alcomp_address,
                "alcomp_city" => $request->alcomp_city,
                "alcomp_state" => $request->alcomp_state,
                "alcomp_zip" => $request->alcomp_zip,
                "alcomp_website" => $request->alcomp_website ?? '',
                "is_ocr_available" => $request->is_ocr_available,
                "ocr_sample_image" => $request->ocr_sample_image ?? ''
            ]);

            return redirect()->route('admin_loancompanies_index')->with('success', 'Record has been updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }

    }

    public function activate(Request $request, $id)
    {
        try {
            AutoLoanCompanies::where('id', $id)->update(["active_status" => 1]);

            return redirect()->route('admin_loancompanies_index')->with('success', 'Record has been updated successfully.');
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
        AutoLoanCompanies::where('id', $request->id)->delete();

        return response()->json(Helper::renderJsonSuccess('Record Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function multiple_delete(Request $request)
    {
        $selectedIds = $request->selectedIds;
        if (!empty($selectedIds)) {
            AutoLoanCompanies::whereIn('id', $selectedIds)->delete();

            return response()->json(Helper::renderJsonSuccess('Record Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        } else {
            return response()->json(Helper::renderJsonError('No companies selected'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }
}
