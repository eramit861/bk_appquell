<?php

namespace App\Http\Controllers\Attorney;

use App\Helpers\Helper;
use App\Helpers\VideoHelper;
use App\Http\Controllers\AttorneyController;
use App\Models\LawFirmAssociate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Database\QueryException;

class LawFirmController extends AttorneyController
{
    public function index(Request $request)
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        $associates = LawFirmAssociate::where('attorney_id', $attorney_id);
        // ->leftJoin(
        //     'tbl_clients_associate',
        //     'tbl_attorney_associated_law_firms.id',
        //     '=',
        //     'tbl_clients_associate.associate_id'
        // )

        if (!empty($request->query('q'))) {
            $associates->Where(function ($q) use ($request) {
                $q->Where('firstName', 'like', '%' . $request->query('q') . '%');
                $q->orWhere('lastName', 'like', '%' . $request->query('q') . '%');
                $q->orWhere('email', 'like', '%' . $request->query('q') . '%');
                $q->orWhere('phone_no', 'like', '%' . $request->query('q') . '%');
            });
        }

        $associates = $associates->orderBy('id', 'DESC')->get();
        $associates = isset($associates) && !empty($associates) ? $associates->toArray() : [];

        $keyword = $request->query('q') ?? '';
        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_CLIENT_MANAGEMENT_VIDEO);

        return view('attorney.law_firm_management.index', [
            'video' => $video,
            'keyword' => $keyword,
            'associates' => $associates,
        ]);
    }

    public function setup(Request $request)
    {
        if ($request->isMethod('post')) {
            DB::beginTransaction();
            try {
                $input = $request->all();
                $this->validate($request, [
                    'firstName' => 'required',
                    'lastName' => 'required',
                    'email' => 'required|email|unique:tbl_attorney_associated_law_firms,email',
                    'phone_no' => 'required',
                ], [
                    'email.unique' => 'This email address is already in use.',
                    // You can add custom messages for other rules too
                ]);
                $attorney_id = Helper::getCurrentAttorneyId();
                $input = $request->all();
                $dateTime = date('Y-m-d H:i:s');
                $dataToSave = [
                    'attorney_id' => $attorney_id,
                    'firstName' => Helper::validate_key_value('firstName', $input),
                    'lastName' => Helper::validate_key_value('lastName', $input),
                    'email' => Helper::validate_key_value('email', $input),
                    'phone_no' => Helper::validate_key_value('phone_no', $input),
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                ];
                LawFirmAssociate::create($dataToSave);
                DB::commit();

                return redirect()->route('law_firm_associate_management')->with('success', 'Associate has been saved successfully.');
            } catch (QueryException $th) {
                DB::rollBack();

                return back()->withError($th->getMessage())->withInput();
            } catch (Exception $th) {
                return back()->withError($th->getMessage())->withInput();
            }
        }
    }
    public function remove($id)
    {
        DB::beginTransaction();
        try {
            if (empty($id)) {
                DB::commit();

                return redirect()->route('law_firm_associate_management')->with('error', 'Something went wrong, try again!');
            }

            LawFirmAssociate::where('id', $id)->delete();

            DB::commit();

            return redirect()->route('law_firm_associate_management')->with('success', 'Associate has been removed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('law_firm_associate_management')->with('error', 'Something went wrong, try again!');
        }
    }

    public function edit_popup(Request $request, $id)
    {

        $associates = LawFirmAssociate::where('id', $id)->first();
        $associates = isset($associates) && !empty($associates) ? $associates->toArray() : [];

        $video = [
            'en' => '',
            'sp' => '',
        ];
        $totals = 10;
        $type = [];

        return view('modal.attorney.law_firm_management.edit', ['video' => $video, 'totals' => $totals, 'type' => $type, 'user' => $associates]);
    }

    public function edit_popup_save(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            if (!$request->isMethod('post')) {
                DB::commit();

                return redirect()->route('law_firm_associate_management')->with('error', 'Invalid Request.');
            }

            $input = $request->all();
            $this->validate($request, [
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required|email|unique:tbl_attorney_associated_law_firms,email,'.$id,
                'phone_no' => 'required',
            ], [
                'email.unique' => 'This email address is already in use.',
                // You can add custom messages for other rules too
            ]);

            $dataToSave = [
                'firstName' => Helper::validate_key_value('firstName', $input),
                'lastName' => Helper::validate_key_value('lastName', $input),
                'email' => Helper::validate_key_value('email', $input),
                'phone_no' => Helper::validate_key_value('phone_no', $input),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            LawFirmAssociate::where('id', $id)->update($dataToSave);

            DB::commit();

            return redirect()->route('law_firm_associate_management')->with('success', 'Law Firm has been updated successfully.');

        } catch (QueryException $th) {
            DB::rollBack();

            return back()->withError($th->getMessage())->withInput();
        } catch (Exception $th) {
            return back()->withError($th->getMessage())->withInput();
        }
    }

}
