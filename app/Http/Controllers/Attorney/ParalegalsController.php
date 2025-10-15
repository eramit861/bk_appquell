<?php

namespace App\Http\Controllers\Attorney;

use App\Helpers\ArrayHelper;
use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use App\Mail\WelcomeAboardParalegal;
use App\Models\AttorneySettings;
use App\Models\LawFirmAssociate;
use App\Models\ParalegalSettings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ParalegalsController extends AttorneyController
{
    public function index(Request $request)
    {

        $attorney_id = Helper::getCurrentAttorneyId();

        $attorney = \App\Models\User::where(['users.role' => \App\Models\User::ATTORNEY, 'users.parent_attorney_id' => $attorney_id])
            ->leftJoin(
                'tbl_paralegal_settings',
                'users.id',
                '=',
                'tbl_paralegal_settings.paralegal_id'
            )
            ->leftJoin(
                'tbl_clients_paralegal',
                'users.id',
                '=',
                'tbl_clients_paralegal.paralegal_id'
            )
            ->leftJoin(
                'users as clients',
                'tbl_clients_paralegal.client_id',
                '=',
                'clients.id'
            )
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.phone_no',
                'users.created_at',
                'users.paralegal_law_firm_id',
                'tbl_paralegal_settings.appointment_link',
                \DB::raw('COUNT(tbl_clients_paralegal.client_id) AS client_count')
            )->where('users.user_status', 1)
            ->where(function ($query) {
                $query->where('clients.role', 3)
                    ->where('clients.user_status', 1)
                    ->orWhereNull('tbl_clients_paralegal.paralegal_id');
            })
            ->groupBy(
                'users.id',
                'users.name',
                'users.email',
                'users.phone_no',
                'users.created_at',
                'tbl_paralegal_settings.appointment_link'
            );

        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'desc');
        $attorney = $attorney->orderBy('users.' . $sortBy, $sortOrder);

        if (!empty($request->query('q'))) {
            $attorney->Where(function ($query) use ($request) {
                $query->Where('users.name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('users.email', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('users.phone_no', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('users.id', '=', $request->query('q'));
            });
        }

        $searchQuery = $request->input('q') ?? '';

        $perPage = $request->input('per_page', 10);
        $attorney = $attorney->paginate($perPage)->appends([
            'q' => $searchQuery,
            'per_page' => $perPage,
            'sort_by' => $sortBy,
            'sort_order' => $sortOrder,
        ]);

        $keyword = $request->query('q') ?? '';
        $video = [
            'en' => '',
            'sp' => '',
        ];
        $totals = 10;
        $type = [];

        $isLawFirmManagementEnabled = AttorneySettings::isLawFirmManagementEnabled($attorney_id);

        $associates = LawFirmAssociate::where('attorney_id', $attorney_id);
        $associates = $associates->orderBy('id', 'DESC')->get();
        $associates = isset($associates) && !empty($associates) ? $associates->toArray() : [];

        return view('attorney.paralegal_list', ['sort_by' => $sortBy, 'sort_order' => $sortOrder,'per_page' => $perPage,'keyword' => $keyword,'attorney' => $attorney, 'video' => $video, 'totals' => $totals, 'type' => $type, 'isLawFirmManagementEnabled' => $isLawFirmManagementEnabled, 'associates' => $associates]);
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $validator = Validator::make($request->all(), [
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required|email|unique:App\Models\User,email',
                'phone_no' => 'required',
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('edit_id', true);
            }
            $password = mt_rand(100000, 999999);
            $input['password'] = Hash::make($password);
            $attorney_id = Helper::getCurrentAttorneyId();
            $input['parent_attorney_id'] = $attorney_id;
            $input['role'] = \App\Models\User::ATTORNEY;
            $input['name'] = $input['firstName'] . ' ' . $input['lastName'];

            $isLawFirmAssigned = !empty(Helper::validate_key_value('paralegal_law_firm_id', $input, 'radio'));

            unset($input['firstName']);
            unset($input['lastName']);

            $user = \App\Models\User::create($input);
            $insertedId = $user->id;
            $attorney = $user->paralegalAttorney;
            if (!empty($user['email'])) {
                $user = $user->toArray();
                $user['attorney'] = $attorney;
                $user['password'] = $password;
                $user['pass_flag'] = true;
                if ($isLawFirmAssigned) {
                    $paralegal_law_firm_id = Helper::validate_key_value('paralegal_law_firm_id', $input, 'radio');

                    $associate = LawFirmAssociate::where('id', $paralegal_law_firm_id)->select(['email','firstName', 'lastName'])->first();
                    $user['name'] = $associate->firstName . ' ' . $associate->lastName;
                    $user['email'] = $associate->email;
                }

                try {
                    Mail::to($user['email'])->send(new WelcomeAboardParalegal($user, $isLawFirmAssigned));
                } catch (\Exception $e) {

                }

                $appointment_link = Helper::validate_key_value('appointment_link', $input);
                if (!empty($appointment_link)) {
                    $settings = [
                        'paralegal_id' => $insertedId,
                        'appointment_link' => $appointment_link,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                    ];
                    \App\Models\ParalegalSettings::create($settings);
                }

            }

            if (!empty($insertedId)) {
                return redirect()->route('attorney_paralegal_management')->with('success', 'User has been added successfully.');
            } else {
                return redirect()->route('attorney_paralegal_management')->with('error', 'Record has not been saved, Please check.');
            }
        } else {
            return redirect()->back()->with('error', 'Not a valid request, Please check.');
        }
    }

    public function edit(Request $request, $id)
    {
        // $attorney =  \App\Models\User::find($id);

        $attorney = \App\Models\User::where(['users.role' => \App\Models\User::ATTORNEY, 'users.id' => $id])
        ->leftJoin(
            'tbl_paralegal_settings',
            'users.id',
            '=',
            'tbl_paralegal_settings.paralegal_id'
        )
        ->orderBy('users.id', 'DESC')
        ->select(
            'users.id',
            'users.name',
            'users.email',
            'users.phone_no',
            'users.paralegal_law_firm_id',
            'tbl_paralegal_settings.appointment_link',
            'tbl_paralegal_settings.send_all_mails_to_attorney'
        )->first();

        if ($request->isMethod('post')) {
            if (empty($id)) {
                return redirect()->route('attorney_paralegal_management')->with('error', 'Invalid Request.');
            }

            $input = $request->all();
            $validator = Validator::make($request->all(), [
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required|email|unique:App\Models\User,email,' . $id,
                'phone_no' => 'required',
            ]);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput()
                    ->with('edit_id', $id); // 👈 Pass identifier here
            }

            $input['name'] = $input['firstName'] . ' ' . $input['lastName'];

            unset($input['firstName']);
            unset($input['lastName']);
            unset($input['_token']);
            $appointment_link = Helper::validate_key_value('appointment_link', $input);
            $send_all_mails_to_attorney = Helper::validate_key_value('send_all_mails_to_attorney', $input, 'radio');
            unset($input['appointment_link']);
            unset($input['send_all_mails_to_attorney']);

            $user = User::where('id', $id)->update($input);

            $settingsExists = ParalegalSettings::where('paralegal_id', $id)->exists();

            $dateTime = date("Y-m-d H:i:s");
            $settingsDataToUpdate = [
                'paralegal_id' => $id,
                'send_all_mails_to_attorney' => $send_all_mails_to_attorney,
                'updated_at' => $dateTime
            ];


            if (!empty($appointment_link)) {
                $settingsDataToUpdate['appointment_link'] = $appointment_link;
            }

            if ($settingsExists) {
                ParalegalSettings::where('paralegal_id', $id)->update($settingsDataToUpdate);
            } else {
                $settingsDataToUpdate['created_at'] = $dateTime;
                ParalegalSettings::create($settingsDataToUpdate);
            }



            if (!empty($user)) {
                return redirect()->route('attorney_paralegal_management')->with('success', 'User has been updated successfully.');
            } else {
                return redirect()->route('attorney_paralegal_management')->with('error', 'Record has not been saved, Please check.');
            }
        } else {
            $video = [
                'en' => '',
                'sp' => '',
            ];
            $totals = 10;
            $type = [];

            return view('attorney.paralegal_edit', ['video' => $video, 'totals' => $totals, 'type' => $type, 'user' => $attorney]);
        }
    }

    public function edit_popup(Request $request, $id)
    {
        $attorney = \App\Models\User::where(['users.role' => \App\Models\User::ATTORNEY, 'users.id' => $id])
            ->leftJoin(
                'tbl_paralegal_settings',
                'users.id',
                '=',
                'tbl_paralegal_settings.paralegal_id'
            )
            ->orderBy('users.id', 'DESC')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.phone_no',
                'users.paralegal_law_firm_id',
                'tbl_paralegal_settings.appointment_link',
                'tbl_paralegal_settings.send_all_mails_to_attorney',
            )->first();
        $video = [
            'en' => '',
            'sp' => '',
        ];
        $totals = 10;
        $type = [];
        $attorney_id = Helper::getCurrentAttorneyId();
        $isLawFirmManagementEnabled = AttorneySettings::isLawFirmManagementEnabled($attorney_id);

        $associates = LawFirmAssociate::where('attorney_id', $attorney_id);
        $associates = $associates->orderBy('id', 'DESC')->get();
        $associates = isset($associates) && !empty($associates) ? $associates->toArray() : [];

        return view('attorney.paralegal_edit', ['video' => $video, 'associates' => $associates, 'isLawFirmManagementEnabled' => $isLawFirmManagementEnabled, 'totals' => $totals, 'type' => $type, 'user' => $attorney]);
    }

    public function toggle_menu_items_popup(Request $request, $id)
    {
        $name = User::find($id)->name ?? '';

        $paralegal = ParalegalSettings::where(['paralegal_id' => $id])->first();
        $paralegal = !empty($paralegal) ? $paralegal->toArray() : [];

        $enabled_menu_items = Helper::validate_key_value('enabled_menu_items', $paralegal);
        $enabled_menu_items = json_decode($enabled_menu_items, true) ?? [];

        $sidebarItems = ArrayHelper::getAttorneySidebar();

        return view('attorney.paralegal_toggle_menu_items_popup', ['paralegal_id' => $id, 'enabled_menu_items' => $enabled_menu_items, 'sidebarItems' => $sidebarItems, 'name' => $name]);
    }

    public function toggle_menu_items_popup_save(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        $id = Helper::validate_key_value('id', $input, 'radio');
        $enabled_menu_items = Helper::validate_key_value('enabled_menu_items', $input);
        $enabled_menu_items = json_encode($enabled_menu_items);

        ParalegalSettings::updateOrCreate(["paralegal_id" => $id], ['enabled_menu_items' => $enabled_menu_items]);

        return redirect()->route('attorney_paralegal_management')->with('success', 'Settings updated successfully');
    }
    public function delete(Request $request)
    {
        $attorney_id = $request->input('attorney_id');
        $user = \App\Models\User::where('id', $attorney_id)->first();
        if (!empty($user)) {
            \App\Models\Message::where(function ($query) use ($attorney_id) {
                $query->where('from_user_id', '=', $attorney_id)
                    ->orWhere('to_user_id', '=', $attorney_id);
            })->delete();
            $user->attorneyCompany()->delete();
        }

        $deletedRows = \App\Models\User::where('id', $attorney_id)->delete();
        if (empty($deletedRows)) {
            return response()->json(Helper::renderJsonError('Invalid Request'))
                ->header('Content-Type: application/json;', 'charset=utf-8');
        }

        //\App\Models\ClientsAttorney::where('attorney_id', $attorney_id)->update(['attorney_id'=>0]);
        \App\Models\RetainerDocuments::where('attorney_id', $attorney_id)->delete();
        \App\Models\SignedDocuments::where('attorney_id', $attorney_id)->delete();

        return response()->json(Helper::renderJsonSuccess('Account Deleted Successfully!'))
            ->header('Content-Type: application/json;', 'charset=utf-8');
    }

}
