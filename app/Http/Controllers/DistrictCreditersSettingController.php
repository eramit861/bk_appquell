<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DistrictCreditersSetting;
use App\Models\ZipCode;
use Exception;
use Illuminate\Database\QueryException;

class DistrictCreditersSettingController extends Controller
{
    public function index()
    {
        $settings = DistrictCreditersSetting::with('district:district_name,id')->paginate(10);

        return view('admin.district_creditor_setting.index', ['settings' => $settings]);
    }

    public function create()
    {
        $district_names = ZipCode::select('district_name', 'id', 'short_name')->groupBy("district_name")->orderBy('short_name', "asc")->where("short_name", "!=", null)->get();

        return view('admin.district_creditor_setting.add', ['district_names' => $district_names]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'destrict_id' => 'required|unique:district_crediters_settings,destrict_id',
            'text_content_field' => 'required',
            'text_align_field' => 'required',
            'text_spacing' => 'required',
            'font_size' => 'required',
            'text_capitalize' => 'required'
        ]);

        try {
            $setting = new DistrictCreditersSetting();
            $setting->destrict_id = $request->destrict_id;
            $setting->text_content_field = $request->text_content_field;
            $setting->text_align_field = $request->text_align_field;

            $setting->text_spacing = $request->text_spacing;
            $setting->font_size = $request->font_size;
            $setting->text_capitalize = $request->text_capitalize;
            $setting->save();

            return redirect()->Route('district_crediter_setting_index');
        } catch (QueryException $th) {
            return back()->withError($th->getMessage())->withInput();
        } catch (Exception $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $setting = DistrictCreditersSetting::find($id);
        $district_names = ZipCode::select('district_name', 'id', 'short_name')->groupBy("district_name")->orderBy('short_name', "asc")->where("short_name", "!=", null)->get();

        return view('admin.district_creditor_setting.edit', ['district_names' => $district_names])->with('setting', $setting);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'text_content_field' => 'required',
            'text_align_field' => 'required',
            'text_spacing' => 'required',
            'font_size' => 'required',
            'text_capitalize' => 'required'
        ]);

        try {
            $setting = DistrictCreditersSetting::find($id);
            $setting->text_content_field = $request->text_content_field;
            $setting->text_align_field = $request->text_align_field;
            $setting->text_spacing = $request->text_spacing;
            $setting->font_size = $request->font_size;
            $setting->text_capitalize = $request->text_capitalize;
            $setting->save();

            return redirect()->Route('district_crediter_setting_index');
        } catch (QueryException $th) {
            return back()->withError($th->getMessage())->withInput();
        } catch (Exception $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        DistrictCreditersSetting::where('id', $id)->delete();

        return redirect()->Route('district_crediter_setting_index')->with('success', 'Record successfully deleted.');
    }


}
