<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Request;

use App\Models\CourtHouses;
use Exception;
use App\Helpers\Helper;
use Maatwebsite\Excel\Facades\Excel;

class CourtHousesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courthouses = CourtHouses::where("courthouse_name", "!=", null)->orderBy('courthouse_name', 'asc')->select('courthouse_name', 'courthouse_address', 'courthouse_city', 'courthouse_state', 'courthouse_zip', 'courthouse_id');

        // Determine items per page from request (allowed values only)
        $perPage = (int) ($request->query('per_page', 10));
        $allowedPerPageOptions = [10, 25, 50, 100];
        if (!in_array($perPage, $allowedPerPageOptions)) {
            $perPage = 10;
        }
        $search_courthouse_state = $request->query('search_courthouse_state') ?? '';
        if (!empty($search_courthouse_state)) {
            $courthouses = $courthouses->where('courthouse_state', '=', $search_courthouse_state);
        }
        if (!empty($request->query('q'))) {
            $courthouses->Where(function ($query) use ($request) {
                $query->Where('courthouse_name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('courthouse_address', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('courthouse_city', 'like', '%' . $request->query('q') . '%');
                // $query->orWhere('courthouse_state', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('courthouse_zip', 'like', '%' . $request->query('q') . '%');
            });
        }

        $courthouses = $courthouses->paginate($perPage);

        $keyword = $request->query('q') ?? '';

        return view('admin.courthouses.show')->with([
            'keyword' => $keyword,
            'courthouses' => $courthouses,
            'search_courthouse_state' => $search_courthouse_state,
            'per_page' => $perPage,
        ]);
    }


    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'courthouse_name' => 'required',
                'courthouse_address' => 'required',
                'courthouse_city' => 'required',
                'courthouse_state' => 'required',
                'courthouse_zip' => 'required'

            ]);


            $courthouse = new CourtHouses();
            $courthouse->courthouse_name = $request->courthouse_name;
            $courthouse->courthouse_address = $request->courthouse_address;
            $courthouse->courthouse_city = $request->courthouse_city;
            $courthouse->courthouse_state = $request->courthouse_state;
            $courthouse->courthouse_zip = $request->courthouse_zip;
            $courthouse->courthouse_contact = $request->courthouse_contact ?? '';

            if ($courthouse->save()) {
                return redirect()->route('admin_courthouses_index')->with('success', 'Record has been added successfully.');
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
        $courthouse = CourtHouses::where('courthouse_id', $id)->first();

        return view('admin.courthouses.edit')->with('courthouse', $courthouse);
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
            'courthouse_name' => 'required',
            'courthouse_address' => 'required',
            'courthouse_city' => 'required',
            'courthouse_state' => 'required',
            'courthouse_zip' => 'required'
        ]);
        try {
            CourtHouses::where('courthouse_id', $id)->update([
                "courthouse_name" => $request->courthouse_name,
                "courthouse_address" => $request->courthouse_address,
                "courthouse_city" => $request->courthouse_city,
                "courthouse_state" => $request->courthouse_state,
                "courthouse_zip" => $request->courthouse_zip,
                "courthouse_contact" => $request->courthouse_contact
            ]);

            $queryParams = array_filter([
                'per_page' => $request->query('per_page', $request->input('per_page')),
                'search_courthouse_state' => $request->query('search_courthouse_state', $request->input('search_courthouse_state')),
                'q' => $request->query('q', $request->input('q')),
                'page' => $request->query('page', $request->input('page')),
            ], function ($value) {
                return !is_null($value);
            });

            return redirect()->route('admin_courthouses_index', $queryParams)->with('success', 'Record has been updated successfully.');
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
        CourtHouses::where('courthouse_id', $request->id)->delete();

        return response()->json(Helper::renderJsonSuccess('Record Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function multiple_delete(Request $request)
    {
        $selectedIds = $request->selectedIds;
        if (!empty($selectedIds)) {
            CourtHouses::whereIn('courthouse_id', $selectedIds)->delete();

            return response()->json(Helper::renderJsonSuccess('Record Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        } else {
            return response()->json(Helper::renderJsonError('No companies selected'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls,csv',
        ]);

        try {
            $path = $request->file('excel_file')->getRealPath();
            $data = Excel::toCollection(null, $path);

            if ($data->isEmpty() || $data->first()->isEmpty()) {
                return redirect()->back()->with('error', 'The uploaded file is empty.');
            }

            foreach ($data->first() as $row) {
                $dateTime = date('Y-m-d H:i:s');

                $dataToSave = [
                                    'courthouse_name' => Helper::validate_key_value(0, $row),
                                    'courthouse_address' => Helper::validate_key_value(1, $row),
                                    'courthouse_city' => Helper::validate_key_value(2, $row),
                                    'courthouse_state' => Helper::validate_key_value(3, $row),
                                    'courthouse_zip' => Helper::validate_key_value(4, $row),
                                    // 'courthouse_contact' => Helper::validate_key_value(5, $row),
                                    'created_at' => $dateTime,
                                    'updated_at' => $dateTime,
                                ];

                $exists = CourtHouses::where('courthouse_name', Helper::validate_key_value(0, $row))->exists();
                if ($exists) {
                    CourtHouses::where('courthouse_name', Helper::validate_key_value(0, $row))->update($dataToSave);
                } else {
                    CourtHouses::create($dataToSave);
                }
            }

            return redirect()->route('admin_courthouses_index')->with('success', 'Courthouses imported successfully.');

        } catch (\Exception $e) {
            return redirect()->route('admin_courthouses_index')->with('error', 'Error importing data: ' . $e->getMessage());
        }
    }

}
