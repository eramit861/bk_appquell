<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayrollPurchaseController extends AttorneyController
{
    public function payroll_purchase_popup(Request $request)
    {
        $input = $request->all();

        return $this->handlerequest($input, 'payroll');
    }

    public function purchase_concierge_service_popup(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];
        $subscription_type = $input['type'];
        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }
        if ($subscription_type == \App\Models\AttorneySubscription::BASIC_SUBSCRIPTION) {
            return $this->handlerequest($input, 'service');
        } else {
            \App\Models\User::where('id', $client_id)->update(['concierge_service' => 1]);

            return response()->json(Helper::renderJsonSuccess("Package added sccessfully"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

    }

    private function handlerequest($input, $retype = '')
    {
        $client_id = $input['client_id'];

        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        $type = $input['type'];
        // return($input)
        $client = \App\Models\User::where('id', $client_id)->select(['client_bank_statements','client_subscription'])->first();
        $clientData = !empty($client) ? $client->toArray() : [];
        $clientSubscription = $clientData['client_subscription'];
        if ($retype == 'bank_assistant') {
            $packageId = \App\Models\AttorneySubscription::bankStatementBySubscriptionArray($clientSubscription);
        }
        if ($retype == 'bank_assistant_premium') {
            $packageId = \App\Models\AttorneySubscription::bankStatementPremiumBySubscriptionArray($clientSubscription);
        }
        if ($retype == 'payroll') {
            $packageId = \App\Models\AttorneySubscription::payrollBySubscriptionArray($clientSubscription);
        }
        if ($retype == 'profit_loss') {
            $packageId = \App\Models\AttorneySubscription::profitLossBySubscriptionArray($clientSubscription);
        }
        if ($retype == 'credit_report') {
            $packageId = \App\Models\AttorneySubscription::creditReortBySubscriptionArray($clientSubscription);
        }
        $noofCountneeded = 1;
        if ($type == 3) {
            $noofCountneeded = 2;
        }
        if ($retype == 'service' && $clientSubscription == \App\Models\AttorneySubscription::BASIC_SUBSCRIPTION) {
            $packageId = \App\Models\AttorneySubscription::STANDARD_CONCIERGE_SERVICE_PACKAGE;
            $noofCountneeded = 1;
        }
        $availableCount = \App\Models\AttorneySubscription::getAvailablePackage(Auth::user(), $packageId);
        $packageName = \App\Models\AttorneySubscription::allPackageNameArray($packageId);

        return view('attorney.client.payroll_popup', [
            'client_id' => $client_id,
            'packageName' => $packageName,
            'availableCount' => $availableCount,
            'package_id' => $packageId,
            'noofCountneeded' => $noofCountneeded,
            'type' => $type
            ]);
    }

    public function bank_assistant_purchase_popup(Request $request)
    {
        $input = $request->all();

        return $this->handlerequest($input, 'bank_assistant');
    }

    public function bank_assistant_premium_purchase_popup(Request $request)
    {
        $input = $request->all();

        return $this->handlerequest($input, 'bank_assistant_premium');
    }

    public function profit_loss_purchase_popup(Request $request)
    {
        $input = $request->all();

        return $this->handlerequest($input, 'profit_loss');
    }

    public function credit_report_purchase_popup(Request $request)
    {
        $input = $request->all();

        return $this->handlerequest($input, 'credit_report');
    }

    public function free_package_purchase_popup(Request $request)
    {
        $input = $request->all();
        $client_id = $input['client_id'];

        if (!Helper::isClientBelongsToAttorney($client_id, Helper::getCurrentAttorneyId())) {
            return response()->json(Helper::renderJsonError("Invalid Request"))->header('Content-Type: application/json;', 'charset=utf-8');
        }

        $packageId = \App\Models\AttorneySubscription::FREE_PACKAGE;
        $noofCountneeded = 1;
        $availableCount = \App\Models\AttorneySubscription::getAvailablePackage(Auth::user(), $packageId);
        $packageName = \App\Models\AttorneySubscription::allPackageNameArray($packageId);

        return view('attorney.client.payroll_popup', [
            'client_id' => $client_id,
            'packageName' => $packageName,
            'availableCount' => $availableCount,
            'package_id' => $packageId,
            'noofCountneeded' => $noofCountneeded,
            'type' => ''
            ]);
    }

}
