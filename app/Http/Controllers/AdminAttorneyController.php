<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeAboard;
use App\Models\AttorneySettings;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminAttorneyController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listing(Request $request)
    {
        $attorney = \App\Models\User::where('role', \App\Models\User::ATTORNEY)->orderBy('users.id', 'DESC')->where('parent_attorney_id', '=', 0)->leftJoin(
            'tbl_attorney_company',
            'users.id',
            '=',
            'tbl_attorney_company.attorney_id'
        )->leftjoin(
            'tbl_attorney_settings',
            'users.id',
            '=',
            'tbl_attorney_settings.attorney_id'
        )->select('law_firm_management_enabled', 'name', 'email', 'attorney_phone', 'users.enable_free_bank_statements', 'users.enable_free_payroll_assistant', 'users.created_at', 'company', 'users.id', 'demo_attorney', 'invite_document_selection');
        if (!empty($request->query('q'))) {
            $attorney->Where(function ($query) use ($request) {
                $query->Where('name', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('email', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('company', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('users.id', '=', $request->query('q'));
            });
        }

        $attorney = $attorney->paginate(10);
        $keyword = $request->query('q') ?? '';

        return view('admin.attorney.list', ['keyword' => $keyword,'attorney' => $attorney]);
    }

    public function admin_attorney_mark_demo($id)
    {
        \App\Models\User::where('id', $id)->update(['demo_attorney' => 1]);

        return redirect()->route('admin_attorney_list')->with('success', 'User has been marked demo successfully.');

    }

    public function admin_attorney_unmark_demo($id)
    {
        \App\Models\User::where('id', $id)->update(['demo_attorney' => 0]);

        return redirect()->route('admin_attorney_list')->with('success', 'User has been removed from demo user successfully.');

    }

    public function enable_free_bank_statements(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $userId = $input['attorney_id'];
            $status = $input['status'] == 1 ? 0 : 1;

            \App\Models\User::where('id', $userId)->update(['enable_free_bank_statements' => $status]);

            return response()->json(Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function enable_law_firm_management_enabled(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $userId = $input['attorney_id'];
            $status = $input['status'] == 1 ? 0 : 1;

            AttorneySettings::where('attorney_id', $userId)->update(['law_firm_management_enabled' => $status]);

            return response()->json(Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }



    public function enable_free_payroll_assistant(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $userId = $input['attorney_id'];
            $status = $input['status'] == 1 ? 0 : 1;
            $payrollType = \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION;
            $price = \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION_PLAN_PRICE;
            $payment_remark = "enable free";
            $no_of_payroll_assistant = 1000;

            \App\Models\User::where('id', $userId)->update(['enable_free_payroll_assistant' => $status]);
            if (!empty($status)) {
                $subscription = [
                    'attorney_id' => $userId,
                    'type' => $payrollType,
                    'amount' => $price,
                    'payment_status' => Helper::SUCCESS,
                    'payment_remark' => $payment_remark,
                    'total_paid' => 0.00,
                    'subscribe' => 0,
                    'package_name' => \App\Models\AttorneySubscription::allPackageNameWithParamForTransactionArray($payrollType),
                    'discount_percentage' => 100,
                    'discount_amount' => ($price * $no_of_payroll_assistant),
                    'stripe_subscription_id' => 'N/A',
                    'no_of_questionnaire' => $no_of_payroll_assistant,
                    'credit_by_admin' => 1
                ];
                \App\Models\AttorneySubscription::create($subscription);
            } else {
                \App\Models\AttorneySubscription::where('payment_remark', $payment_remark)
                    ->where('attorney_id', $userId)
                    ->where('type', $payrollType)
                    ->where('payment_status', Helper::SUCCESS)
                    ->where('total_paid', 0.00)
                    ->where('no_of_questionnaire', $no_of_payroll_assistant)
                    ->delete();
            }

            return response()->json(Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function update_invite_doc_selection_status(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $userId = $input['attorney_id'];
            $status = $input['status'];
            \App\Models\User::where('id', $userId)->update(['invite_document_selection' => $status]);

            return response()->json(Helper::renderJsonSuccess('Record Updated Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        }
    }

    public function add(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $this->validate($request, [
                'name' => 'required|alpha_dash_space',
                'email' => 'required|email|unique:App\Models\User,email',
                'company' => 'required|alpha_dash_space',
            ]);
            $password = mt_rand(100000, 999999);
            $input['password'] = Hash::make($password);
            $input['role'] = \App\Models\User::ATTORNEY;
            $user = \App\Models\User::create($input);
            if (!empty($user['email'])) {
                $user['password'] = $password;
                $user['pass_flag'] = true;
                try {
                    Mail::to($user['email'])->send(new WelcomeAboard($user));
                } catch (\Exception $e) {

                }

            }
            $insertedId = $user->id;
            if (!empty($insertedId)) {
                return redirect()->route('admin_attorney_list')->with('success', 'User has been added successfully.');
            } else {
                return redirect()->route('admin_attorney_list')->with('error', 'Record has not been saved, Please check.');
            }
        } else {
            return redirect()->back()->with('error', 'Not a valid request, Please check.');
        }
    }

    public function edit(Request $request, $id)
    {
        $attorney = \App\Models\User::find($id);
        if ($request->isMethod('post')) {
            if (empty($id)) {
                return redirect()->route('admin_attorney_list')->with('error', 'Invalid Request.');
            }
            $input = $request->all();
            $this->validate($request, [
                'name' => 'required|alpha_dash_space',
                'email' => 'required|email|unique:App\Models\User,email,'.$id,
                'company' => 'required|alpha_dash_space',
            ]);
            unset($input['_token']);
            $user = \App\Models\User::where('id', $id)->update($input);
            if (!empty($user)) {
                return redirect()->route('admin_attorney_list')->with('success', 'User has been updated successfully.');
            } else {
                return redirect()->route('admin_attorney_list')->with('error', 'Record has not been saved, Please check.');
            }
        } else {
            return view('admin.attorney.edit', ['User' => $attorney]);
        }
    }

    public function view($id)
    {
        $attorney = \App\Models\User::find($id);
        $subscriptions = \App\Models\AttorneySubscription::where(['attorney_id' => $id])->orderBy('id', 'DESC');
        $subscriptions = $subscriptions->paginate(10);

        return view('admin.attorney.view', ['attorney_transactions' => $subscriptions,'User' => $attorney]);
    }

    public function delete(Request $request)
    {
        $attorney_id = $request->input('attorney_id');
        DB::beginTransaction();

        try {
            $user = \App\Models\User::where('id', $attorney_id)->first();
            if (!empty($user)) {
                \App\Models\Message::where(function ($query) use ($attorney_id) {
                    $query->where('from_user_id', '=', $attorney_id)
                          ->orWhere('to_user_id', '=', $attorney_id);
                })->delete();
                $user->attorneyCards()->delete();
                $user->attorneyCompany()->delete();
                $user->attorneyDocuments()->delete();
                $user->attorneyPayments()->delete();
                $user->subscriptions()->delete();
                $user->clientRetainerDocuments()->delete();
            }

            $deletedRows = \App\Models\User::where('id', $attorney_id)->delete();
            if (empty($deletedRows)) {
                return response()->json(Helper::renderJsonError('Invalid Request'))->header('Content-Type: application/json;', 'charset=utf-8');
            }
            $clientIds = \App\Models\ClientsAttorney::where('attorney_id', $attorney_id)
            ->pluck('client_id')
            ->unique() // Ensures no duplicate client IDs
            ->toArray();

            \App\Models\User::whereIn('id', $clientIds)->delete();

            \App\Models\ClientsAttorney::where('attorney_id', $attorney_id)->update(['attorney_id' => 0]);
            \App\Models\RetainerDocuments::where('attorney_id', $attorney_id)->delete();
            \App\Models\SignedDocuments::where('attorney_id', $attorney_id)->delete();
            DB::commit();

            return response()->json(Helper::renderJsonSuccess('Account Deleted Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(Helper::renderJsonError('Somthing went wrong.'.$e->getMessage()))->header('Content-Type: application/json;', 'charset=utf-8');
        }

    }


    public function add_subscription_to_attorney(Request $request)
    {
        $attorney_id = $request->input('attorney_id');
        $packageId = $request->input('package_id');
        $no_of_questionnaire = $request->input('no_of_questionnaire');
        $payment_remark = $request->input('payment_remark');
        $packageName = \App\Models\AttorneySubscription::allPackageNameArray($packageId);
        $subscription = [
            'attorney_id' => $attorney_id,
            'type' => $packageId,
            'amount' => \App\Models\AttorneySubscription::allPackagePriceArray($packageId),
            'payment_status' => Helper::SUCCESS,
            'payment_remark' => $payment_remark,
            'total_paid' => 0.00,
            'subscribe' => 0,
            'package_name' => \App\Models\AttorneySubscription::allPackageNameWithParamForTransactionArray($packageId),
            'discount_percentage' => 0,
            'discount_amount' => 0,
            'stripe_subscription_id' => 'N/A',
            'no_of_questionnaire' => $no_of_questionnaire,
            'credit_by_admin' => 1
        ];
        $user = \App\Models\User::find($attorney_id);

        try {
            $mail = Helper::getAttorneyEmailArray($attorney_id);
            if (AttorneySettings::isEmailEnabled(1, 'attorney_subscription_credited_mail', '', true)) {
                Mail::to($mail)->send(new \App\Mail\SubscriptionCreditedToAttorney($user, $packageName, $no_of_questionnaire, $payment_remark));
            }
        } catch (\Exception $e) {

        }
        \App\Models\AttorneySubscription::create($subscription);

        return redirect()->route('admin_attorney_view', ['id' => $attorney_id])->with('success', 'Subscription added Successfully!');
    }

    public function add_payroll_to_attorney(Request $request)
    {
        $attorney_id = $request->input('attorney_id');
        $payrollType = $request->input('payroll_type');
        $no_of_payroll_assistant = $request->input('no_of_payroll_assistant');
        $payment_remark = $request->input('payment_remark');
        $packageName = \App\Models\AttorneySubscription::allPackageNameArray($payrollType);
        $price = \App\Models\AttorneySubscription::payrollPriceArray($payrollType);
        if ($payrollType == 3) {
            $price = $price * 2;
        }

        $subscription = [
            'attorney_id' => $attorney_id,
            'type' => $payrollType,
            'amount' => $price,
            'payment_status' => Helper::SUCCESS,
            'payment_remark' => $payment_remark,
            'total_paid' => 0.00,
            'subscribe' => 0,
            'package_name' => \App\Models\AttorneySubscription::allPackageNameWithParamForTransactionArray($payrollType),
            'discount_percentage' => 0,
            'discount_amount' => 0,
            'stripe_subscription_id' => 'N/A',
            'no_of_questionnaire' => $no_of_payroll_assistant,
            'credit_by_admin' => 1
        ];

        $user = \App\Models\User::find($attorney_id);

        try {
            $mail = Helper::getAttorneyEmailArray($attorney_id);
            if (AttorneySettings::isEmailEnabled(1, 'attorney_subscription_credited_mail', '', true)) {
                Mail::to($mail)->send(new \App\Mail\SubscriptionCreditedToAttorney($user, $packageName, $no_of_payroll_assistant, $payment_remark));
            }
        } catch (\Exception $e) {

        }
        \App\Models\AttorneySubscription::create($subscription);

        return redirect()->route('admin_attorney_view', ['id' => $attorney_id])->with('success', 'Payroll added Successfully!');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSetLink(Request $request)
    {
        $request->validate([
           'link' => 'required|url'
        ]);
        $input['attorney_id'] = $request->attorney_id;
        $input['link_for'] = $request->link_for ?? '';
        if (!empty($input['link_for']) && $input['link_for'] == 'manual') {
            $input['manual_link'] = $request->link;
        } else {
            $input['link'] = $request->link;
        }
        $url = \App\Models\ShortLink::getSetLink($input, $request->attorney_id);

        return response()->json(Helper::renderJsonSuccess("", ['url' => $url]))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function admin_attorney_login($attorney_id)
    {
        $attorney = Auth::user()->id;
        Auth::loginUsingId($attorney_id);
        Session::put('refrence_admin', $attorney);
        Session::put('refrence_parent', null);

        return redirect()->route('attorney_dashboard')->with('success', 'You are Logged in into attorney dashboard successfully');
    }

}
