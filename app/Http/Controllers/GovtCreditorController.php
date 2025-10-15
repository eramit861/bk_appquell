<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GovtCreditor;
use App\Models\MasterCreditor;
use App\Models\Mortgages;
use App\Helpers\Helper;
use Carbon\Carbon;

class GovtCreditorController extends Controller
{
    public function index(Request $request)
    {
        $creditors = GovtCreditor::whereNotNull("creditor_name")->orderByRaw('(is_imported_to_mortgage + is_imported_to_common_creditors) asc')->orderBy('creditor_name', 'asc');

        if (!empty($request->query('q'))) {
            $creditors->Where(function ($query) use ($request) {
                $query->Where('creditor_name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('creditor_address', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('creditor_city', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('creditor_state', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('creditor_zip', 'like', '%' . $request->query('q') . '%');
            });
        }

        $creditors = $creditors->paginate(10);
        $keyword = $request->query('q') ?? '';

        $latestUpdatedAt = GovtCreditor::max('updated_at');
        if (!empty($latestUpdatedAt)) {
            $latestUpdatedAt = Carbon::parse($latestUpdatedAt)->format('M d, Y');
        }

        return view('admin.govt_creditors.show')->with(['keyword' => $keyword,'creditors' => $creditors,'latestSyncedAt' => $latestUpdatedAt]);
    }

    public function sync_with_api(Request $request)
    {
        ini_set('max_execution_time', 1800); // Set to 1800 seconds (30 minutes)
        try {
            $status = GovtCreditor::sync_with_api();
            if ($status) {
                return response()->json(Helper::renderJsonSuccess('Records Synced Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
            }

            return response()->json(Helper::renderJsonError('No Records Found'))->header('Content-Type: application/json;', 'charset=utf-8');
        } catch (\Throwable $th) {
            return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function delete(Request $request)
    {
        GovtCreditor::where('id', $request->id)->delete();

        return response()->json(Helper::renderJsonSuccess('Record Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function multiple_delete(Request $request)
    {
        $selectedIds = $request->selectedIds;
        if (!empty($selectedIds)) {
            GovtCreditor::whereIn('id', $selectedIds)->delete();

            return response()->json(Helper::renderJsonSuccess('Record Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        } else {
            return response()->json(Helper::renderJsonError('No creditor selected'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function import_to_creditor(Request $request)
    {
        $selectedIds = $request->selectedIds;
        if (!empty($selectedIds)) {
            $data = GovtCreditor::whereIn('id', $selectedIds)->get();
            $data = (isset($data) && !empty($data)) ? $data->toArray() : [] ;
            if (!empty($data)) {
                $dateCurrent = date('Y-m-d H:i:s');
                foreach ($data as $key => $creditor) {
                    $conditions = [
                                    'creditor_name' => Helper::validate_key_value('creditor_name', $creditor),
                                    'creditor_address' => Helper::validate_key_value('creditor_address', $creditor),
                                    'creditor_city' => Helper::validate_key_value('creditor_city', $creditor),
                                    'creditor_state' => Helper::validate_key_value('creditor_state', $creditor),
                                    'creditor_zip' => Helper::validate_key_value('creditor_zip', $creditor),
                                ];
                    $dataToSave = [
                                    'creditor_name' => Helper::validate_key_value('creditor_name', $creditor),
                                    'creditor_address' => Helper::validate_key_value('creditor_address', $creditor),
                                    'creditor_city' => Helper::validate_key_value('creditor_city', $creditor),
                                    'creditor_state' => Helper::validate_key_value('creditor_state', $creditor),
                                    'creditor_zip' => Helper::validate_key_value('creditor_zip', $creditor),
                                    'creditor_contact' => '',
                                    'creditor_website' => '',
                                    'added_by_id' => 1,
                                    'active_status' => 1,
                                    'category' => null,
                                    'updated_at' => $dateCurrent,
                                ];
                    $existingRecord = MasterCreditor::where($conditions)->first();
                    if ($existingRecord) {
                        MasterCreditor::where($conditions)->update($dataToSave);
                    } else {
                        $dataToSave['created_at'] = $dateCurrent;
                        MasterCreditor::create($dataToSave);
                    }

                    GovtCreditor::where([ 'id' => Helper::validate_key_value('id', $creditor) ])->update([ 'is_imported_to_common_creditors' => 1, 'import_to_common_creditors_date' => $dateCurrent ]);

                }
            }

            return response()->json(Helper::renderJsonSuccess('Records imported Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        } else {
            return response()->json(Helper::renderJsonError('No creditor selected'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function import_to_mortgage(Request $request)
    {
        $selectedIds = $request->selectedIds;
        if (!empty($selectedIds)) {
            $data = GovtCreditor::whereIn('id', $selectedIds)->get();
            $data = (isset($data) && !empty($data)) ? $data->toArray() : [] ;
            if (!empty($data)) {
                $dateCurrent = date('Y-m-d H:i:s');
                foreach ($data as $key => $creditor) {
                    $conditions = [
                                    'mortgage_name' => Helper::validate_key_value('creditor_name', $creditor),
                                    'mortgage_address' => Helper::validate_key_value('creditor_address', $creditor),
                                    'mortgage_city' => Helper::validate_key_value('creditor_city', $creditor),
                                    'mortgage_state' => Helper::validate_key_value('creditor_state', $creditor),
                                    'mortgage_zip' => Helper::validate_key_value('creditor_zip', $creditor),
                                ];
                    $dataToSave = [
                                    'mortgage_name' => Helper::validate_key_value('creditor_name', $creditor),
                                    'mortgage_address' => Helper::validate_key_value('creditor_address', $creditor),
                                    'mortgage_city' => Helper::validate_key_value('creditor_city', $creditor),
                                    'mortgage_state' => Helper::validate_key_value('creditor_state', $creditor),
                                    'mortgage_zip' => Helper::validate_key_value('creditor_zip', $creditor),
                                    'is_ocr_available' => 0,
                                    'added_by_id' => 1,
                                    'active_status' => 1,
                                    'updated_at' => $dateCurrent,
                                ];

                    $existingRecord = Mortgages::where($conditions)->first();
                    if ($existingRecord) {
                        Mortgages::where($conditions)->update($dataToSave);
                    } else {
                        $dataToSave['created_at'] = $dateCurrent;
                        Mortgages::create($dataToSave);
                    }

                    GovtCreditor::where([ 'id' => Helper::validate_key_value('id', $creditor) ])->update([ 'is_imported_to_mortgage' => 1, 'import_to_mortgage_date' => $dateCurrent ]);

                }
            }

            return response()->json(Helper::renderJsonSuccess('Records imported Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        } else {
            return response()->json(Helper::renderJsonError('No creditor selected'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }
}
