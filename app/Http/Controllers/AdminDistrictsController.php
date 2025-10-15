<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Districts;
use App\Models\Region;
use App\Helpers\Helper;

class AdminDistrictsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function index(Request $request)
    {

        $district_names = Districts::orderBy('sort_order', "asc")->where("short_name", "!=", null)->select('short_name', 'is_chapter_thirteen_enable', 'sort_order', 'district_name', 'id', 'region_id');
        $dstricts = $district_names->get();
        $thisdistrict_names = $district_names;
        $list = $thisdistrict_names->first()->toArray();
        $regionList = Region::orderBy('id', "asc")->get()->toArray();

        return view('admin.district_list.view', ['district_names' => $dstricts, 'regionList' => $regionList]);
    }

    public function save_district_order(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $this->updateOrder($input['pageList']);
        }

        return response()->json(Helper::renderJsonSuccess('Sorting order updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function chapter_thirteen_status(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $districtId = $input['id'];
            $status = $input['status'];
            if ($status == 0) {
                $dataToUpdate = ['is_chapter_thirteen_enable' => 1];
            }
            if ($status == 1) {
                $dataToUpdate = ['is_chapter_thirteen_enable' => 0];
            }
            Districts::where('id', $districtId)->update($dataToUpdate);
        }

        return response()->json(Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function region_update(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $districtId = $input['id'];
            Districts::where('id', $districtId)->update(['region_id' => $input['region_id']]);
        }

        return response()->json(Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function updateOrder($order)
    {
        if (is_array($order) && sizeof($order) > 0) {
            foreach ($order as $i => $id) {
                if ($id < 1) {
                    continue;
                }
                Districts::where(['id' => $id])->update(['sort_order' => $i]);
            }

            return true;
        }

        return false;
    }

}
