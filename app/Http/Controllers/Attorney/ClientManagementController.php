<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Helpers\VideoHelper;
use App\Helpers\ArrayHelper;
use App\Models\AttorneySettings;

/**
 * Client Management Controller
 *
 * Handles client search, status changes, invitations, and client type options
 */
class ClientManagementController extends AttorneyController
{
    /**
     * Return JSON response with proper headers
     *
     * @param array $data Response data
     * @param int $statusCode HTTP status code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse(array $data, int $statusCode = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json($data, $statusCode)->header('Content-Type', 'application/json', 'charset=utf-8');
    }
    /**
     * Search for attorney clients
     *
     * @return \Illuminate\Http\JsonResponse|void
     */
    public function attorney_client_search(Request $request): \Illuminate\Http\JsonResponse|null
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $keyword = urldecode($input["keyword"]);
            $clients = \App\Models\User::orderBy('id', 'DESC')->with(['ClientsAttorneybyclient','ClientsAttorneybyattorney','ClientsAttorneybyclient.getuserattorney' => function ($query) use ($request) {
                $query->where('id', Helper::getCurrentAttorneyId());
            }])->where('role', \App\Models\User::CLIENT);
            if (!empty($keyword)) {
                $clients->Where(function ($query) use ($keyword) {
                    $query->Where('name', 'like', '%' . $keyword . '%');
                });
            }
            $clients = $clients->paginate(10);
            $clients = $clients->toArray();

            $clients = $clients['data'];
            $json = null;
            foreach ($clients as $val) {
                $json[] = [
                    'client_name' => strip_tags(html_entity_decode($val['name'], ENT_QUOTES, 'UTF-8')),
                    'client_id' => isset($val['id']) ? strip_tags(html_entity_decode($val['id'], ENT_QUOTES, 'UTF-8')) : '',
                ];
            }

            return response()->json(Helper::renderApiSuccess('Result', ['data' => $json]), 200);
        }

    }



    /**
     * View client details
     *
     * @param int $id Client ID
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function view($id): \Illuminate\Http\RedirectResponse|\Illuminate\View\View
    {
        if (!Helper::isClientBelongsToAttorney($id, Helper::getCurrentAttorneyId())) {
            return redirect()->route('attorney_dashboard')->with('error', 'Invalid request');
        }

        // Safely check subscription type to avoid null pointer exception
        $user = Auth::user();
        $subscription = $user->subscriptions()->first();
        if ($subscription && $subscription->type == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION) {
            return redirect()->route('client_paystub', ['id' => $id, 'type' => 'paystub']);
        }

        $client = $this->getClientData($id);
        $editable = \App\Models\FormsStepsCompleted::select('can_edit')->where('client_id', $id)->first();

        $total = $this->getClientCompletedStepsCount($id);
        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_CLIENT_QUESTIONNAIRE_VIDEO);

        return view('attorney.client.view', ['video' => $video, 'User' => $client,'editable' => (isset($editable->can_edit) ? $editable->can_edit : 0),'type' => 'view', 'totals' => $total]);
    }

    /**
     * Change client status
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function change_status(Request $request): \Illuminate\Http\JsonResponse
    {
        $client_id = $request->input('client_id');
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return $this->jsonResponse(Helper::renderJsonError("Invalid Request"));
        }

        $status = $request->input('status');

        // Validate status first before processing
        if (!in_array($status, [Helper::ACTIVE, Helper::INACTIVE])) {
            return $this->jsonResponse(Helper::renderJsonError('Invalid Status'));
        }

        $this->validClient($client_id);
        $newStatus = self::checkValidStatus($status);

        \App\Models\User::where("id", $client_id)->update(['user_status' => $newStatus]);

        return $this->jsonResponse(Helper::renderJsonSuccess("Status updated successfully."));
    }

    /**
     * Toggle status between active and inactive
     *
     * @param int $status Current status
     * @return int New toggled status
     */
    private static function checkValidStatus($status): int
    {
        // Toggle the status
        if ($status == Helper::ACTIVE) {
            return Helper::INACTIVE;
        }

        if ($status == Helper::INACTIVE) {
            return Helper::ACTIVE;
        }

        // Default fallback (should never reach here if validated properly)
        return Helper::INACTIVE;
    }

    /**
     * Resend client invitation with new password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resend_invite(Request $request): \Illuminate\Http\JsonResponse
    {
        $client_id = $request->input('client_id');
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return $this->jsonResponse(Helper::renderJsonError("Invalid Request"));
        }
        $attorneyId = Helper::getCurrentAttorneyId();
        $this->validClient($client_id);
        $user = \App\Models\User::where("id", $client_id)->select('*')->first();

        // Generate cryptographically secure random password
        $password = random_int(100000, 999999);

        \App\Models\User::where('id', $client_id)->update(["password" => Hash::make($password)]);
        $user['password'] = $password;

        if (!empty($user->email)) {
            try {
                $attorney = \App\Models\User::with('attorneyCompany')->where('id', $attorneyId)->first();
                if (AttorneySettings::isEmailEnabled($attorneyId, 'client_resend_invite_mail', $client_id)) {
                    Mail::to($user['email'])->send(new \App\Mail\WelcomeAboard($user, false, $attorney));
                }
            } catch (\Exception $e) {
                // Log the error for debugging
                \Log::error('Failed to send client invite email', [
                    'client_id' => $client_id,
                    'attorney_id' => $attorneyId,
                    'error' => $e->getMessage()
                ]);
            }
        }

        return $this->jsonResponse(Helper::renderJsonSuccess("Invite re-sent successfully."));
    }

    /**
     * Get client type options based on package
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_client_type_option(Request $request): \Illuminate\Http\JsonResponse
    {
        $input = $request->all();
        $selections = '';

        // Use constants instead of magic numbers for package IDs
        if ($input['package_id'] == \App\Models\AttorneySubscription::BASIC_SUBSCRIPTION) {
            $selections = ArrayHelper::getClientTypeSelection($input['client_type_id'], false, false);
        } elseif ($input['package_id'] == \App\Models\AttorneySubscription::BLACK_LABEL_SUBSCRIPTION) {
            $selections = ArrayHelper::getClientTypeSelection($input['client_type_id'], true, false);
        } elseif ($input['package_id'] == \App\Models\AttorneySubscription::PAYROLL_ASSISTANT_SUBSCRIPTION) {
            $selections = ArrayHelper::getClientTypeSelection($input['client_type_id'], false, false);
        } elseif ($input['package_id'] == \App\Models\AttorneySubscription::ULTIMATE_SUBSCRIPTION) {
            $selections = ArrayHelper::getClientTypeSelection($input['client_type_id'], false, true);
        } else {
            $selections = ArrayHelper::getClientTypeSelection($input['client_type_id'], true, false);
        }

        return response()->json(['success' => true, 'status' => 1, 'selections' => $selections]);
    }

    /**
     * Get paralegal options list
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function get_paralegal_option(Request $request): \Illuminate\Http\JsonResponse
    {
        $selectedParalegal = $request->get('selectedParalegal');
        $selections = Helper::getParalegalSelection($selectedParalegal, true);

        return response()->json(['success' => true, 'status' => 1, 'selections' => $selections]);
    }

}
