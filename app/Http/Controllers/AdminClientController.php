<?php

namespace App\Http\Controllers;

use App\Helpers\AddressHelper;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use App\Mail\CSatSurveyMail;
use App\Models\ClientDocuments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ClientsAttorney;
use App\Models\UploadedOcrData;
use Illuminate\Support\Facades\Session;
use App\Repositories\UserRepository;
use App\Traits\Common; // Trait
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class AdminClientController extends Controller
{
    use Common;
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listing(Request $request)
    {
        $attorney = User::where('role', User::ATTORNEY)->select('name', 'id')->orderBy('id', 'DESC')->get();
        $client = User::orderBy('id', 'DESC')->where('users.role', User::CLIENT)
        ->join('tbl_clients_attorney', 'users.id', '=', 'tbl_clients_attorney.client_id')
        ->leftJoin('tbl_clients_paralegal', 'users.id', '=', 'tbl_clients_paralegal.client_id')
        ->leftJoin('users as user_attorney', 'user_attorney.id', '=', 'tbl_clients_attorney.attorney_id')
        ->select('users.concierge_service', 'users.client_subscription', 'users.phone_no', 'users.name', 'users.email', 'users.id', 'users.user_status', 'user_attorney.name as attorney_name', 'tbl_clients_paralegal.paralegal_id', 'users.date_marked_delete');

        $type = $request->type ?? '';

        if (!empty($request->query('q'))) {
            $client->Where(function ($query) use ($request, $type) {
                $query->Where('users.name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('users.email', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('users.phone_no', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('users.id', 'like', '%' . $request->query('q') . '%');
                if ($type == 'archived') {
                    $query->Where('users.user_status', '=', Helper::INACTIVE);
                } elseif ($type == 'removed') {
                    $query->Where('users.user_status', '=', Helper::REMOVED);
                } else {
                    $query->Where('users.user_status', '=', Helper::ACTIVE);
                }
            });
        }

        if ($type == 'archived') {
            $client->Where('users.user_status', '=', Helper::INACTIVE);
        } elseif ($type == 'removed') {
            $client->Where('users.user_status', '=', Helper::REMOVED);
        } else {
            $client->Where('users.user_status', '=', Helper::ACTIVE);
        }

        $client = $client->groupby('users.id')->paginate(10);
        $keyword = $request->query('q') ?? '';

        return view('admin.client.list', ['keyword' => $keyword,'client' => $client,'attorney' => $attorney , 'type' => $type]);
    }
    public function add(Request $request)
    {


        if ($request->isMethod('post')) {
            $input = $request->all();
            $this->validate($request, [
                'name' => 'required|alpha_dash_space',
                'email' => 'required|email|unique:App\Models\User,email',
                'client_attorney' => 'required',
            ]);
            $password = mt_rand(100000, 999999);
            $input['password'] = Hash::make($password);
            $input['role'] = User::CLIENT;
            $input['user_added_by'] = 1;//admin
            $client_attorney = $input['client_attorney'];
            unset($input['client_attorney']);
            $user = User::create($input);
            $insertedId = $user->id;
            if (!empty($insertedId)) {
                $client_attorney = ['client_id' => $insertedId,'attorney_id' => $client_attorney,];
                ClientsAttorney::create($client_attorney);
                $user['password'] = $password;
                $user['pass_flag'] = true;

                $attorney = User::with(['attorneyCompany' => function ($query) use ($request) {
                    $query->select(['company_name','attorney_id']);
                }])->select('name', 'id')->where('id', $request->client_attorney)->first();

                return redirect()->route('admin_client_list')->with('success', 'User has been added successfully.');
            } else {
                return redirect()->route('admin_client_list')->with('error', 'Record has not been saved, Please check.');
            }
        } else {
            return redirect()->back()->with('error', 'Not a valid request, Please check.');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function edit(Request $request, $id)
    {
        $client = app(UserRepository::class)->getUserWithClientsAttorneyIdName($id);

        $attorney = User::where('role', User::ATTORNEY)->orderBy('id', 'DESC')->get();

        if ($request->isMethod('post')) {
            if (empty($id)) {
                return redirect()->route('admin_client_list')->with('error', 'Invalid Request.');
            }
            $input = $request->all();

            $this->validate($request, [
                'name' => 'required|alpha_dash_space',
                'email' => 'required|email|unique:App\Models\User,email,'.$id,
                'client_attorney' => 'required',
            ]);
            $clients_attorney_id = $input['clients_attorney_id'];
            $client_attorney = $input['client_attorney'];
            unset($input['_token'],$input['clients_attorney_id'],$input['client_attorney']);
            $input['user_added_by'] = 1;//admin
            $user = User::where('id', $id)->update($input);
            if (!empty($user)) {
                $isExit = ClientsAttorney::where('id', $clients_attorney_id)->get()->toArray();
                if (!empty($isExit)) {
                    ClientsAttorney::where('id', $clients_attorney_id)->update(['attorney_id' => $client_attorney]);
                } else {
                    $client_attorney = ['client_id' => $id,'attorney_id' => $client_attorney];
                    ClientsAttorney::create($client_attorney);
                }

                return redirect()->route('admin_client_list')->with('success', 'User has been updated successfully.');
            } else {
                return redirect()->route('admin_client_list')->with('error', 'Record has not been saved, Please check.');
            }
        } else {
            return view('admin.client.edit', ['User' => $client,'attorney' => $attorney]);
        }
    }
    public function view($id)
    {
        $client = app(UserRepository::class)->getUserWithClientsAttorneyIdName($id);

        return view('admin.client.view', ['User' => $client]);
    }
    public function delete(Request $request)
    {
        $client_id = $request->input('client_id');

        DB::beginTransaction();
        try {
            User::where('id', $client_id)
                ->update([
                    'date_marked_delete' => now()->toDateString(),
                    'user_status' => Helper::REMOVED,
                ]);
            DB::commit();

            return response()->json(Helper::renderJsonSuccess("Client Marked Deleted Successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function delete_permanent(Request $request)
    {
        $client_id = $request->input('client_id');

        DB::beginTransaction();
        try {
            $this->deleteAdminClient($client_id);

            $deletedRows = User::where('id', $client_id)->delete();
            if (empty($deletedRows)) {
                DB::rollBack();

                return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
            }

            DB::commit();

            return response()->json(Helper::renderJsonSuccess("Client Permanently Deleted Successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }
    public function restore(Request $request)
    {
        $client_id = $request->input('client_id');

        DB::beginTransaction();
        try {
            User::where('id', $client_id)
                ->update([
                    'date_marked_delete' => null,
                    'user_status' => Helper::ACTIVE,
                ]);
            DB::commit();

            return response()->json(Helper::renderJsonSuccess("Client Marked Active Successfully."))->header('Content-Type: application/json;', 'charset=utf-8');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }


    public function ocrlisting($client_id)
    {
        $list = UploadedOcrData::where('client_id', $client_id)->orderBy('updated_at', 'DESC')->get();
        $list = !empty($list->toArray()) ? $list->toArray() : [];

        return view('admin.client.ocrdata', ['list' => $list]);
    }

    public function admin_client_login($client_id)
    {
        $attorney = Auth::user()->id;
        Auth::loginUsingId($client_id);
        Session::put('refrence_admin', $attorney);
        Session::put('refrence_parent', null);

        return redirect()->route('client_dashboard')->with('success', 'You are Logged in into client dashboard successfully');
    }

    public function client_password_reset_popup_by_admin(Request $request)
    {
        $client_id = $request->client_id;
        $client = User::where('id', $client_id)->select(columns: ['name'])->first();

        $formLabel = $client->name ? "Reset Password - ".$client->name : "Reset Client Password";

        return view('modal.common.client_password_reset_popup')
            ->with([
                'client_id' => $client_id,
                'formLabel' => $formLabel,
                'formRoute' => route('client_password_reset_save_by_admin')
            ]);
    }

    public function client_password_reset_save_by_admin(Request $request)
    {
        $client_id = $request->input('client_id');
        $attorney_id = ClientDocuments::getClientAttorneyId($client_id);

        return User::client_password_reset_save($client_id, $attorney_id, $request);
    }
		public function send_survey_text(Request $request)
    {
        $client_id = $request->input('client_id', null);
        $type = $request->input('type', null);
		if (empty($client_id) || empty($type) || !in_array($type, [1, 2])) {
			return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
		}

		$message = '';
		$emailMessage = '';
		$link = '';

		$user = User::find($client_id);

		if ($type == 1) {
			$link = env('SURVEY_URL_CLIENT_APP');
			$message = 'Hi '.$user->name.',
We’d appreciate your quick feedback on our app (bkquestionnaire.com). Please take a moment to complete this short survey: ['.$link.']
Thank you!';
			$emailMessage = 'Hi '.$user->name.',
We’d appreciate your quick feedback on our app (bkquestionnaire.com). Please take a moment to complete this short survey: ';

		} elseif ($type == 2) {
			$link = env('SURVEY_URL_CUSTOMER_SERVICE');
			$message = 'Hi '.$user->name.',
We hope your issue was resolved. Could you take a moment to let us know how we did?
Your feedback means a lot: ['.$link.']
Thank you!';
			$emailMessage = 'Hi '.$user->name.',
We hope your issue was resolved. Could you take a moment to let us know how we did?
Your feedback means a lot:';

		}

		if(empty($message) || empty($user) || empty($link)) {
			return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
		}

		try {			
			AddressHelper::sendSakariMobileTextMessage($user, $message);
			$subject = 'Customer Satisfaction Survey';
			Mail::to($user->email)->send(new CSatSurveyMail($subject,  $emailMessage, $link));
			return response()->json(Helper::renderJsonSuccess('Survey text sent successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
		} catch (\Throwable $th) {
			return response()->json(Helper::renderJsonError('Failed to send survey text. Please try again later.'))->header('Content-Type: application/json;', 'charset=utf-8');
		}
		


		
    }
}
