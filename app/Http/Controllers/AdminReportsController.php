<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ReportsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Helpers\DateTimeHelper;

class AdminReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(Request $request)
    {
        $input = $request->all();
        $all_attorney = \App\Models\User::where(['role' => \App\Models\User::ATTORNEY])->where('parent_attorney_id', '=', 0)->orderBy('name', 'asc')->pluck('name', 'id')->all();
        $fromDate = date("Y-m-d", strtotime(now()->subDays(30)));
        $toDate = date("Y-m-d", strtotime(now()));
        $selectedAttorney = 610;
        if (!empty($input)) {
            $fromDate = $input['fromDate'] ?? $fromDate;
            $toDate = $input['toDate'] ?? $toDate;
        }

        if (!empty($input) && !empty($input['allAttorney'])) {
            $selectedAttorney = $input['allAttorney'];
        }

        $listing = \App\Models\SubscriptionToclient::where('tbl_subscription_to_client.created_at', '>=', $fromDate)
            ->where('tbl_subscription_to_client.created_at', '<=', $toDate)
            ->join("users", "users.id", "=", "tbl_subscription_to_client.client_id")
            ->select(
                'users.name',
                'tbl_subscription_to_client.client_id',
                'tbl_subscription_to_client.package_id',
                'tbl_subscription_to_client.quantity',
                'tbl_subscription_to_client.attorney_id',
                'tbl_subscription_to_client.created_at',
                'tbl_subscription_to_client.per_package_price',
                'tbl_subscription_to_client.discount_percentage',
                'tbl_subscription_to_client.discounted_price',
                'tbl_subscription_to_client.package_name'
            )
            ->orderBy('created_at', 'DESC');

        if (!empty($selectedAttorney)) {
            $listing = $listing->where(['attorney_id' => $selectedAttorney]);
        }
        if (!empty($request->query('q'))) {
            $listing->orWhere(function ($query) use ($request) {
                $query->orWhere('name', 'like', '%' . $request->query('q') . '%');
            });
        }

        $all_transactions = $listing->get();
        $data = \App\Models\AttorneySubscription::getTransactionData($all_transactions, $all_attorney);

        $attorneyName = $selectedAttorney ? \App\Models\User::where('id', $selectedAttorney)->value('name') : '';
        if ($request->isMethod('post') && isset($input['export']) && $input['export'] == 1) {
            $xlsData = [];
            foreach ($data['transactions'] as $transaction) {
                $attorneyName = $transaction['attorney'];
                $xlsData[] = [
                    'Questionnaire' => $transaction['questionnaire_type'],
                    'Client' => $transaction['transaction_details']['client_name'],
                    'Client Id' => $transaction['transaction_details']['client_id'],
                    'Status' => 'Success',
                    'Purchased on' => DateTimeHelper::dbDateToDisplay($transaction['transaction_details']['transaction_time'], true),
                    'Units' => $transaction['units'],
                    'Total Amount' => $transaction['payment_details']['total_amount'],
                ];
            }
            array_push($xlsData, [
                'Questionnaire' => '',
                'Client' => '',
                'Client Id' => '',
                'Status' => '',
                'Purchased on' => '',
                'Units' => 'Total Units',
                'Total Amount' => "Total Amount"
            ]);
            array_push($xlsData, [
                'Questionnaire' => '',
                'Client' => '',
                'Client Id' => '',
                'Status' => '',
                'Purchased on' => '',
                'Units' => $data['summary']['total_units'],
                'Total Amount' => $data['summary']['total_price']
            ]);
            $string = $attorneyName.' Sales Report ('.date("m/d/Y", strtotime($fromDate)).' and '.date("m/d/Y", strtotime($toDate)).')';
            $fileName = str_replace(' ', '_', $attorneyName).'_Sales_Report_'.date("m.d.Y", strtotime($fromDate)).'_and_'.date("m.d.Y", strtotime($toDate));

            return Excel::download(new ReportsExport($xlsData, $string), $fileName.'.xlsx');
        }

        return view('admin.reports.index')->with([
            'listdata' => $data,
            'toDate' => $toDate,
            'fromDate' => $fromDate,
            'all_attorney' => $all_attorney,
            'selectedAttorney' => $selectedAttorney
        ]);
    }

}
