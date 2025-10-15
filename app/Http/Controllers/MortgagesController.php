<?php

namespace App\Http\Controllers;

use App\Http\Requests\MortgageRequest;
use Illuminate\Http\Request;
use App\Models\Mortgages;
use Exception;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;

class MortgagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $mortgages = Mortgages::where("mortgage_name", "!=", null)
            ->orderBy('active_status', 'asc')
            ->orderBy('mortgage_name')
            ->select(
                'mortgage_name',
                'mortgage_address',
                'mortgage_city',
                'mortgage_state',
                'mortgage_zip',
                'mortgage_id',
                'is_ocr_available',
                'added_by_id',
                'active_status'
            );
        if (!empty($request->query('q'))) {
            $mortgages->where(function ($query) use ($request) {
                $query->where('mortgage_name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('mortgage_address', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('mortgage_city', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('mortgage_state', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('mortgage_zip', 'like', '%' . $request->query('q') . '%');
            });
        }
        $mortgages = $mortgages->paginate(10);
        $keyword = $request->query('q') ?? '';

        return view('admin.mortgages.show', ['keyword' => $keyword, 'mortgages' => $mortgages]);
    }


    public function create(MortgageRequest $request)
    {

        if ($request->isMethod('post')) {

            $this->validate($request, [
                'mortgage_name' => 'required',
                'mortgage_address' => 'required',
                'mortgage_city' => 'required',
                'mortgage_state' => 'required',
                'mortgage_zip' => 'required',
                'is_ocr_available' => 'required',

            ]);

            $mortgage = new Mortgages();
            $mortgage->mortgage_name = $request->mortgage_name;
            $mortgage->mortgage_address = $request->mortgage_address;
            $mortgage->mortgage_city = $request->mortgage_city;
            $mortgage->mortgage_state = $request->mortgage_state;
            $mortgage->mortgage_zip = $request->mortgage_zip;
            $mortgage->mortgage_webiste = $request->mortgage_webiste ?? '';
            $mortgage->is_ocr_available = $request->is_ocr_available;
            $mortgage->added_by_id = Auth::user()->id;
            $mortgage->active_status = 1;

            if ($mortgage->save()) {
                return redirect()->route('admin_mortgages_index')->with('success', 'Record has been added successfully.');
            } else {
                return redirect()->back()->withError("something went wrong");
            }

        } else {
            return redirect()->back()->with('error', 'Not a valid request, Please check.');
        }

    }



    public function edit($id)
    {
        $mortgage = Mortgages::where('mortgage_id', $id)->firstOrFail();

        return view('admin.mortgages.edit', ['mortgage' => $mortgage]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return mixed
     */
    public function update(MortgageRequest $request, $id)
    {
        Mortgages::where('mortgage_id', $id)->firstOrFail();
        $post = $request->validated();
        $post['mortgage_id'] = $id;
        if (Mortgages::where('mortgage_id', $id)->update($post)) {
            return redirect()->route('admin_mortgages_index')->with('success', 'Record has been updated successfully.');
        }

        return redirect()->back()->withErrors(['error' => 'Something went wrong, please check and try again']);
    }

    public function activate(Request $request, $id)
    {
        try {
            Mortgages::where('mortgage_id', $id)->update(["active_status" => 1]);

            return redirect()->route('admin_mortgages_index')->with('success', 'Record has been updated successfully.');
        } catch (Exception $e) {
            return redirect()->back()->withError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function delete(Request $request)
    {
        Mortgages::where('mortgage_id', $request->id)->delete();
        header("Refresh:0");

        return response()->json(Helper::renderJsonSuccess('Record Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function multiple_delete(Request $request)
    {
        $selectedIds = $request->selectedIds;
        if (!empty($selectedIds)) {
            Mortgages::whereIn('mortgage_id', $selectedIds)->delete();

            return response()->json(Helper::renderJsonSuccess('Record Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        } else {
            return response()->json(Helper::renderJsonError('No companies selected'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }
}
