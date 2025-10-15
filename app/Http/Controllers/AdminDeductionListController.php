<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\DeductionList;
use Illuminate\Support\Facades\Auth;

class AdminDeductionListController extends Controller
{
    // listing
    public function index(Request $request)
    {
        $taxList = DeductionList::where("deduction_label", "!=", null)->where("deduction_type", "=", "1")->orderBy('deduction_label', 'ASC')->get()->toArray();
        $deductionList = DeductionList::where("deduction_label", "!=", null)->where("deduction_type", "=", "2")->orderBy('deduction_label', 'ASC')->get()->toArray();

        return view('admin.deduction_list.show', [ 'taxList' => $taxList, 'deductionList' => $deductionList ]);
    }

    // create
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {

            $this->validate($request, [
                'newLabel' => 'required',
                'labelType' => 'required'
            ]);

            $domestic = new DeductionList();
            $domestic->deduction_label = $request->newLabel;
            $domestic->deduction_type = $request->labelType;
            $domestic->deduction_added_by = Auth::user()->id;
            $domestic->created_at = date("Y-m-d H:i:s");
            $domestic->updated_at = date("Y-m-d H:i:s");

            if ($domestic->save()) {
                return redirect()->route('admin_deduction_index')->with('success', 'Label has been added successfully.');
            } else {
                return redirect()->back()->withError("something went wrong");
            }

        } else {
            return redirect()->back()->with('error', 'Not a valid request, Please check.');
        }
    }

    // update
    public function update(Request $request)
    {
        $input = $request->all();
        $label_id = $input['label_id'];
        $new_label = $input['new_label'];
        $type = $input['type'];

        $labelExists = DeductionList::where("deduction_label", "=", $new_label)->where("deduction_type", "=", $type)->exists();
        if ($labelExists == true) {
            return response()->json(Helper::renderJsonError("Label already exists."))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        DeductionList::where('id', $label_id)->update(['label' => $new_label]);

        return response()->json(Helper::renderJsonSuccess("Label has been updated successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    // delete
    public function delete(Request $request)
    {
        $input = $request->all();
        DeductionList::where('id', $input['label_id'])->delete();
        header("Refresh:0");

        // return redirect()->route('admin_deduction_index')->with('success','Record Deleted Successfully!');
        return response()->json(Helper::renderJsonSuccess('Record Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

}
