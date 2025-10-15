<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterCreditor;
use Exception;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;

class MasterCreditorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $creditors = MasterCreditor::where("creditor_name", "!=", null)->orderBy('active_status', 'asc')->orderBy('creditor_name', 'asc')->select('creditor_id', 'creditor_name', 'creditor_address', 'creditor_city', 'creditor_state', 'creditor_zip', 'creditor_website', 'creditor_id', 'added_by_id', 'active_status', 'category');
        if (!empty($request->query('q'))) {
            $creditors->Where(function ($query) use ($request) {
                $query->Where('creditor_name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('creditor_address', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('creditor_city', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('creditor_state', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('creditor_zip', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('creditor_website', 'like', '%' . $request->query('q') . '%');
            });
        }
        $creditors = $creditors->paginate(10);
        $keyword = $request->query('q') ?? '';

        return view('admin.creditors.show')->with(['keyword' => $keyword,'creditors' => $creditors]);
    }




    public function create(Request $request)
    {
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'creditor_name' => 'required',
                'creditor_address' => 'required',
                'creditor_city' => 'required',
                'creditor_state' => 'required',
                'creditor_zip' => 'required',
            ]);


            $creditor = new MasterCreditor();
            $creditor->creditor_name = $request->creditor_name;
            $creditor->creditor_address = $request->creditor_address;
            $creditor->creditor_city = $request->creditor_city;
            $creditor->creditor_state = $request->creditor_state;
            $creditor->creditor_zip = $request->creditor_zip;
            $creditor->creditor_contact = $request->creditor_contact ?? '';
            $creditor->creditor_website = $request->creditor_website ?? '';
            $creditor->added_by_id = Auth::user()->id;
            $creditor->active_status = 1;
            $creditor->category = $request->category ?? '';

            if ($creditor->save()) {
                return redirect()->route('admin_creditors_index')->with('success', 'Record has been added successfully.');
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
        $creditor = MasterCreditor::where('creditor_id', $id)->first();

        return view('admin.creditors.edit')->with('creditor', $creditor);
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
            'creditor_name' => 'required',
            'creditor_address' => 'required',
            'creditor_city' => 'required',
            'creditor_state' => 'required',
            'creditor_zip' => 'required',
            'category' => 'required',
        ]);
        try {
            MasterCreditor::where('creditor_id', $id)->update([
                "creditor_name" => $request->creditor_name,
                "creditor_address" => $request->creditor_address,
                "creditor_city" => $request->creditor_city,
                "creditor_state" => $request->creditor_state,
                "creditor_zip" => $request->creditor_zip,
                "creditor_contact" => $request->creditor_contact,
                "creditor_website" => $request->creditor_website,
                "category" => $request->category
            ]);

            return redirect()->route('admin_creditors_index')->with('success', 'Record has been updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }

    }

    public function update_category(Request $request)
    {
        if ($request->isMethod('post')) {
            MasterCreditor::where('creditor_id', $request->creditor_id)->update(['category' => $request->category]);

            return response()->json(Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        return response()->json(Helper::renderJsonError('Not a valid request, Please check'))->header('Content-Type: application/json;', 'charset=utf-8');

    }

    public function activate(Request $request, $id)
    {
        try {
            MasterCreditor::where('creditor_id', $id)->update(["active_status" => 1]);

            return redirect()->route('admin_creditors_index')->with('success', 'Record has been updated successfully.');
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
        MasterCreditor::where('creditor_id', $request->id)->delete();

        return response()->json(Helper::renderJsonSuccess('Record Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function multiple_delete(Request $request)
    {
        $selectedIds = $request->selectedIds;
        if (!empty($selectedIds)) {
            MasterCreditor::whereIn('creditor_id', $selectedIds)->delete();

            return response()->json(Helper::renderJsonSuccess('Record Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        } else {
            return response()->json(Helper::renderJsonError('No creditor selected'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }
}
