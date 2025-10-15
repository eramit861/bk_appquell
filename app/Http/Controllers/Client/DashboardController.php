<?php

namespace App\Http\Controllers\Client;

use App\Helpers\ClientHelper;
use App\Http\Controllers\Controller;
use App\Models\FormsStepsCompleted;
use App\Models\User;
use App\Models\ZipCode;
use Illuminate\Support\Facades\Mail;
use App\Mail\FinalSubmission;
use App\Mail\FinalSubmissionToClient;
use App\Mail\FinalSubmissionToAttorneyCinciergeClients;
use App\Helpers\AddressHelper;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Helpers\VideoHelper;
use App\Models\Expenses;
use App\Models\ParalegalSettings;

class DashboardController extends Controller
{
    public function pre_client_dashboard()
    {
        if (Auth::user()->hide_questionnaire && empty(Auth::user()->client_payroll_assistant)) {
            return redirect()->route('no_client_questionnaire_mobile')->with('success', 'You are Logged in successfully');
        }
        if (auth()->user()->logged_in_ever == 0) {
            User::where('id', Auth::user()->id)->update(['logged_in_ever' => 1]);
        }
        $client_id = Auth::user()->id;
        $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();

        $videos = VideoHelper::getAdminVideos();
        $tutorial = $videos[Helper::GUIDE_PAGE_TUTORIAL_VIDEO] ?? [];
        $video = VideoHelper::getVideos($tutorial);
        $steps = ['step1' => true, 'step2' => false, 'step3' => false, 'step4' => false, 'step5' => false, 'step6' => false, 'video' => $video];
        $steps['tab'] = 'tab1';
        $info = [];
        $client_with_payments = true;
        $district_names = ZipCode::groupBy("district_name")->orderBy('short_name', "asc")->where("short_name", "!=", null)->get();
        $docsUploadInfo = ClientHelper::documentUploadInfo();
        $progress = FormsStepsCompleted::getStepCompletionData($client_id, Auth::user()->client_type);
        $docsProgress = ClientHelper::get_uploaded_docs_progress('', $client_id, $attorney->attorney_id);

        $expenses = Expenses::where('client_id', $client_id)->first();
        $expenses = (!empty($expenses)) ? $expenses->toArray() : [];
        $showSpouseExpense = Helper::validate_key_value('live_separately', $expenses, 'radio') == 1;

        return view('client.pre-dashboard', $steps)->with(['showSpouseExpense' => $showSpouseExpense, 'docsProgress' => $docsProgress,'progress' => $progress, 'info' => $info, 'client_with_payments' => $client_with_payments, "district_names" => $district_names, 'docsUploadInfo' => $docsUploadInfo, 'userJustLogin' => Session::get('userJustLogin'), 'progress_percentage' => ClientHelper::checkProgress() ]);
    }


    public function client_final_submit()
    {
        $client_id = Auth::user()->id;
        $form_completed_clients = FormsStepsCompleted::select('*')->where('client_id', $client_id)->get()->toArray();
        $form_completed_clients = isset($form_completed_clients) && !empty($form_completed_clients) ? $form_completed_clients : [];
        if (empty($form_completed_clients)) {
            $msg = "Basic Information tab data is not completed.";
            $route = route('client_dashboard');
            if (Auth::user()->client_subscription == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION) {
                $route = route('client_income');
            }
            if (Auth::user()->hide_questionnaire && empty(Auth::user()->client_payroll_assistant)) {
                $route = route('no_client_questionnaire');
            }

            return redirect()->to($route)->with('error', $msg);
        }
        $steps = current($form_completed_clients);
        $msg = '';
        if (Auth::user()->client_subscription != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION) {
            if ($steps['step1'] == 0) {
                $msg = "Basic Information tab data is not completed.";
                $route = route('client_dashboard');

                return redirect()->to($route)->with('error', $msg);
            }
            if ($steps['step2'] == 0) {
                $msg = "Property Information tab data is not completed.";
                $route = route('property_information');

                return redirect()->to($route)->with('error', $msg);
            }
            if ($steps['step3'] == 0) {
                $msg = "Debts tab data is not completed.";
                $route = route('client_debts_step2_unsecured');

                return redirect()->to($route)->with('error', $msg);
            }
        }
        if ($steps['step4'] == 0) {
            $msg = "Current Income tab data is not completed.";
            $route = route('client_income');

            return redirect()->to($route)->with('error', $msg);
        }
        if (Auth::user()->client_subscription != \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION) {
            if ($steps['step5'] == 0) {
                $msg = "Current Expenses tab data is not completed.";
                $route = route('client_expenses');

                return redirect()->to($route)->with('error', $msg);
            }
            if ($steps['step6'] == 0) {
                $msg = "Statement of Financial Affairs tab data is not completed.";
                $route = route('client_financial_affairs');

                return redirect()->to($route)->with('error', $msg);
            }
        }

        FormsStepsCompleted::updateOrCreate(
            ["client_id" => $client_id],
            [
            'client_id' => $client_id,
            'step6' => 1,
            'can_edit' => 2,
            'can_edit_basic_info' => 0,
            'can_edit_property' => 0,
            'can_edit_debts' => 0,
            'can_edit_income' => 0,
            'can_edit_expenase' => 0,
            'can_edit_sofa' => 0,
            'request_edit_access' => 0,
            'request_edit_access_types' => null,
            'request_edit_access_time' => null,
            'submitted_to_att_at' => date("Y-m-d H:i:s")
        ]
        );

        $user = User::where('id', $client_id)->first();
        $attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();
        $attorney = User::where('id', $attorney->attorney_id)->first();
        $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', $attorney->id)->first();
        $attorney_company = (!empty($attorney_company)) ? $attorney_company : [];

        $concierge_service = Auth::user()->concierge_service;

        $adminDetails = User::where(['id' => 1, 'role' => 1])->first();
        $adminEmail = $adminDetails->email ?? '';
        try {
            if ($concierge_service == 1) {
                Mail::to($adminEmail)->send(new FinalSubmission($user));
                $url = Helper::CALENDY_CONCIERGE_DOC_REVIEW_URL."?month=".date('Y-m');
                Mail::to($user->email)->send(new FinalSubmissionToAttorneyCinciergeClients($user->name, $attorney->name, $url));
                $notifMessage = 'Hello, '.$user->name.'. My name is Mike, I see you submitted your questionnaire. '.$attorney->name.' asked me to go over your questionnaire and documents with you. Can you please set up an appointment with me here: [url='.$url.']';
                AddressHelper::sendSakariMobileTextMessage($user, $notifMessage);
            } else {
                $mail = Helper::getAttorneyEmailArray($attorney->id);
                $clientParalegal = \App\Models\ClientParalegal::where('client_id', Auth::user()->id)->first();
                if ($clientParalegal) {
                    $attorneyData = User::where('id', $clientParalegal->paralegal_id)->first();
                    $mail = Helper::getAttorneyEmailArray($attorneyData->id);
                }
                foreach ($mail as $emailId) {
                    $sendTo = ParalegalSettings::getMailSendToId($client_id, $emailId, !empty(Auth::user()->parent_attorney_id));
                    Mail::to($sendTo)->send(new FinalSubmission($user));
                    \Log::info('Final Submission email sent to attorney email: ' . $emailId);
                }

            }
            Mail::to($user->email)->send(
                new FinalSubmissionToClient($attorney, $user, $attorney_company)
            );

            return redirect()->back()->with('success', 'Form successfully Submitted to Attorney for Preparation.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function attorney_login_dashboard($attorneyId)
    {
        $query = $_GET['q'] ?? '';
        $attorneyParentId = Helper::getAttorneyIdByUserid($attorneyId);
        if (!Helper::isClientBelongsToAttorney(Auth::user()->id, $attorneyParentId)) {
            return redirect()->route('client_dashboard')->with('error', 'Invalid request.');
        }
        Auth::loginUsingId($attorneyId);

        return redirect()->route('attorney_client_management', ['q' => $query])->with('success', 'You are successfully logged into your dashboard!');
    }

    public function admin_login_dashboard($attorneyId)
    {
        $query = $_GET['q'] ?? '';
        Auth::loginUsingId($attorneyId);
        $isconcierge = User::where(['id' => $query,'concierge_service' => 1])->exists();
        if ($isconcierge) {
            return redirect()->route('admin_concierge_service_list', ['q' => $query])->with('success', 'You are successfully logged into your dashboard!');
        } else {
            return redirect()->route('admin_client_list', ['q' => $query])->with('success', 'You are successfully logged into your dashboard!');
        }
    }

    public function add_upload_client_note(Request $request)
    {
        if ($request->isMethod('post')) {
            $client_id = $request->input('client_id');
            $note = "The client selected to upload documents before completing questionnaire.";
            $subject = "The client selected to upload documents before completing questionnaire.";
            \App\Models\ConciergeServiceNotes::create(['client_id' => $client_id, 'subject' => $subject,'created_at' => date("Y-m-d H:i:s"),'updated_at' => date("Y-m-d H:i:s"),'note' => $note,'added_by_id' => 1]);

            return response()->json(Helper::renderJsonSuccess('Note Added Successfully!'))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        return response()->json(Helper::renderJsonError("Invalid request"))->header('Content-Type: application/json;', 'charset=utf-8');
    }
}
