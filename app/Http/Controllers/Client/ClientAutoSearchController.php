<?php

namespace App\Http\Controllers\Client;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\AutoLoanCompanies;
use App\Models\CourtHouses;
use App\Models\MasterCreditor;
use App\Models\Mortgages;
use Illuminate\Http\Request;

class ClientAutoSearchController extends Controller
{
    public function mortgage_search(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            if (request()->hasHeader('Authorization')) {
                $input = $request->json()->all();
            }
            $keyword = urldecode($input["keyword"]);
            $companies = Mortgages::where("mortgage_name", "!=", null)->where('active_status', '=', 1)->orderBy('mortgage_name', 'asc');
            if (!empty($keyword)) {
                $companies->Where(function ($query) use ($keyword) {
                    $query->Where('mortgage_name', 'like', '%' . $keyword . '%');
                });
            }
            $companies = $companies->paginate(10);
            $companies = $companies->toArray();
            $companies = $companies['data'];
            $json = null;
            foreach ($companies as $val) {
                $zips = explode("-", $val['mortgage_zip']);
                $zip = $zips[0];
                $placeholder = Helper::commonCreditorPlaceholder(['creditor_name' => $val['mortgage_name'],'creditor_address' => $val['mortgage_address'] ?? '', 'creditor_city' => $val['mortgage_city'], 'creditor_state' => $val['mortgage_state'], 'creditor_zip' => $zip]);
                $json[] = ['placeholder' => $placeholder,'value' => strip_tags(html_entity_decode($val['mortgage_name'], ENT_QUOTES, 'UTF-8')), 'address' => isset($val['mortgage_address']) ? strip_tags(html_entity_decode($val['mortgage_address'], ENT_QUOTES, 'UTF-8')) : '', 'city' => strip_tags(html_entity_decode($val['mortgage_city'], ENT_QUOTES, 'UTF-8')), 'state' => strip_tags(html_entity_decode(trim($val['mortgage_state']), ENT_QUOTES, 'UTF-8')), 'zip' => strip_tags(html_entity_decode($zip, ENT_QUOTES, 'UTF-8'))];
            }

            return response()->json(Helper::renderApiSuccess('Result', ['data' => $json]), 200);
        }
    }
    public function loan_company_search(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            if (request()->hasHeader('Authorization')) {
                $input = $request->json()->all();
            }
            $keyword = urldecode($input["keyword"]);
            $companies = AutoLoanCompanies::where("alcomp_name", "!=", null)->where('active_status', '=', 1)->orderBy('alcomp_name', 'asc');
            if (!empty($keyword)) {
                $companies->Where(function ($query) use ($keyword) {
                    $query->Where('alcomp_name', 'like', '%' . $keyword . '%');
                });
            }
            $companies = $companies->paginate(10);
            $companies = $companies->toArray();
            $companies = $companies['data'];
            $json = null;
            foreach ($companies as $val) {
                $zips = explode("-", $val['alcomp_zip']);
                $zip = $zips[0];
                $placeholder = Helper::commonCreditorPlaceholder(['creditor_name' => $val['alcomp_name'],'creditor_address' => $val['alcomp_address'] ?? '', 'creditor_city' => $val['alcomp_city'], 'creditor_state' => $val['alcomp_state'], 'creditor_zip' => $zip]);
                $json[] = ['placeholder' => $placeholder,'value' => strip_tags(html_entity_decode($val['alcomp_name'], ENT_QUOTES, 'UTF-8')), 'address' => isset($val['alcomp_address']) ? strip_tags(html_entity_decode($val['alcomp_address'], ENT_QUOTES, 'UTF-8')) : '', 'city' => strip_tags(html_entity_decode($val['alcomp_city'], ENT_QUOTES, 'UTF-8')), 'state' => strip_tags(html_entity_decode($val['alcomp_state'], ENT_QUOTES, 'UTF-8')), 'zip' => strip_tags(html_entity_decode($zip, ENT_QUOTES, 'UTF-8'))];
            }

            return response()->json(Helper::renderApiSuccess('Result', ['data' => $json]), 200);
        }
    }
    public function master_credit_search(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            if (request()->hasHeader('Authorization')) {
                $input = $request->json()->all();
            }
            $keyword = urldecode($input["keyword"]);
            $companies = MasterCreditor::where("creditor_name", "!=", null)->where('active_status', '=', 1)->orderBy('creditor_name', 'asc');
            if (!empty($keyword)) {
                $companies->Where(function ($query) use ($keyword) {
                    $query->Where('creditor_name', 'like', '%' . $keyword . '%');
                });
            }
            $companies = $companies->paginate(10);
            $companies = $companies->toArray();
            $companies = $companies['data'];
            $json = null;
            foreach ($companies as $val) {
                $zips = explode("-", $val['creditor_zip']);
                $zip = $zips[0];
                $placeholder = Helper::commonCreditorPlaceholder($val);
                $json[] = ['placeholder' => $placeholder, 'value' => strip_tags(html_entity_decode($val['creditor_name'], ENT_QUOTES, 'UTF-8')), 'address' => isset($val['creditor_address']) ? strip_tags(html_entity_decode($val['creditor_address'], ENT_QUOTES, 'UTF-8')) : '', 'city' => strip_tags(html_entity_decode($val['creditor_city'], ENT_QUOTES, 'UTF-8')), 'state' => strip_tags(html_entity_decode($val['creditor_state'], ENT_QUOTES, 'UTF-8')), 'zip' => strip_tags(html_entity_decode($zip, ENT_QUOTES, 'UTF-8'))];
            }

            return response()->json(Helper::renderApiSuccess('Result', ['data' => $json]), 200);
        }
    }
    public function master_credit_search_by_category(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            if (request()->hasHeader('Authorization')) {
                $input = $request->json()->all();
            }
            $keyword = urldecode($input["keyword"]);
            $debtType = $input["debtType"] ?? '';

            $companies = MasterCreditor::where("creditor_name", "!=", null)->where('active_status', '=', 1)->orderBy('creditor_name', 'asc');
            if (!empty($keyword)) {
                $companies->Where(function ($query) use ($keyword) {
                    $query->Where('creditor_name', 'like', '%' . $keyword . '%');
                });
            }
            $companies = $companies->paginate(10);
            $companies = $companies->toArray();
            $companies = $companies['data'];

            $listCompanies = [];
            foreach ($companies as $val) {
                if (empty($val['category'])) {
                    $val['category'] = 4;
                }
                $listCompanies[] = $val;
            }

            $mortgages = Mortgages::where("mortgage_name", "!=", null)->where('active_status', '=', 1)->orderBy('mortgage_name', 'asc');
            if (!empty($keyword)) {
                $mortgages->Where(function ($query) use ($keyword) {
                    $query->Where('mortgage_name', 'like', '%' . $keyword . '%');
                });
            }
            $mortgages = $mortgages->paginate(10);
            $mortgages = $mortgages->toArray();
            $mortgages = $mortgages['data'];
            $listMortages = [];
            foreach ($mortgages as $val) {
                $zips = explode("-", $val['mortgage_zip']);
                $zip = $zips[0];
                $val['category'] = 1;
                $val['creditor_name'] = $val['mortgage_name'];
                $val['creditor_address'] = $val['mortgage_address'];
                $val['creditor_city'] = $val['mortgage_city'];
                $val['creditor_state'] = $val['mortgage_state'];
                $val['creditor_zip'] = $val['mortgage_zip'];
                $lisxMortages[] = $val;
            }


            $autoloans = AutoLoanCompanies::where("alcomp_name", "!=", null)->where('active_status', '=', 1)->orderBy('alcomp_name', 'asc');
            if (!empty($keyword)) {
                $autoloans->Where(function ($query) use ($keyword) {
                    $query->Where('alcomp_name', 'like', '%' . $keyword . '%');
                });
            }
            $autoloans = $autoloans->paginate(10);
            $autoloans = $autoloans->toArray();
            $autoloans = $autoloans['data'];
            $listAutoloans = [];
            foreach ($autoloans as $val) {
                $zips = explode("-", $val['alcomp_zip']);
                $zip = $zips[0];
                $val['category'] = 2;
                $val['creditor_name'] = $val['alcomp_name'];
                $val['creditor_address'] = $val['alcomp_address'];
                $val['creditor_city'] = $val['alcomp_city'];
                $val['creditor_state'] = $val['alcomp_state'];
                $val['creditor_zip'] = $val['alcomp_zip'];
                $listAutoloans[] = $val;
            }

            $companies = $listCompanies + $listMortages + $listAutoloans;

            if (in_array($debtType, [2,3])) {
                $companies = $listCompanies + $listMortages + $listAutoloans ;
            }

            usort($companies, function ($a, $b) use ($debtType) {
                $customOrder = [ 3, 4 , 2, 1];
                switch ($debtType) {
                    case 2: $customOrder = [3, 4 , 2, 1];
                        break;
                    case 3: $customOrder = [4, 3 , 2, 1];
                        break;
                }
                $posA = array_search((int)$a['category'], $customOrder) !== false ? array_search((int)$a['category'], $customOrder) : PHP_INT_MAX;
                $posB = array_search((int)$b['category'], $customOrder) !== false ? array_search((int)$b['category'], $customOrder) : PHP_INT_MAX;

                return $posA <=> $posB;
            });

            $json = null;
            $addedCategory = [];
            foreach ($companies as $val) {
                $zips = explode("-", $val['creditor_zip']);
                $zip = $zips[0];
                $placeholder = Helper::commonCreditorPlaceholder($val);
                if (empty($val['category'])) {
                    $val['category'] = 4;
                }
                if (!in_array($val['category'], $addedCategory)) {
                    $json[] = ['placeholder' => Helper::getCreditorCategories($val['category']), 'value' => 'heading', 'address' => '', 'city' => '', 'state' => '', 'zip' => '', 'category' => $val['category']];
                    $addedCategory[] = $val['category'];
                }
                $json[] = ['placeholder' => $placeholder, 'value' => strip_tags(html_entity_decode($val['creditor_name'], ENT_QUOTES, 'UTF-8')), 'address' => isset($val['creditor_address']) ? strip_tags(html_entity_decode($val['creditor_address'], ENT_QUOTES, 'UTF-8')) : '', 'city' => strip_tags(html_entity_decode($val['creditor_city'], ENT_QUOTES, 'UTF-8')), 'state' => strip_tags(html_entity_decode($val['creditor_state'], ENT_QUOTES, 'UTF-8')), 'zip' => strip_tags(html_entity_decode($zip, ENT_QUOTES, 'UTF-8')), 'category' => $val['category']];

            }

            return response()->json(Helper::renderApiSuccess('Result', ['data' => $json]), 200);
        }
    }

    public function courthouses_search(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            if (request()->hasHeader('Authorization')) {
                $input = $request->json()->all();
            }
            $keyword = urldecode($input["keyword"]);
            $companies = CourtHouses::where("courthouse_name", "!=", null)->orderBy('courthouse_name', 'asc');
            if (!empty($keyword)) {
                $companies->Where(function ($query) use ($keyword) {
                    $query->Where('courthouse_city', 'like', '%' . $keyword . '%');
                });
            }
            $companies = $companies->paginate(10);
            $companies = $companies->toArray();
            $companies = $companies['data'];
            $json = null;
            foreach ($companies as $val) {
                $zips = explode("-", $val['courthouse_zip']);
                $zip = $zips[0];
                $placeholder = Helper::commonCreditorPlaceholder(['creditor_name' => $val['courthouse_name'],'creditor_address' => $val['courthouse_address'] ?? '', 'creditor_city' => $val['courthouse_city'], 'creditor_state' => $val['courthouse_state'], 'creditor_zip' => $zip]);
                $json[] = ['placeholder' => $placeholder,'value' => strip_tags(html_entity_decode($val['courthouse_name'], ENT_QUOTES, 'UTF-8')), 'address' => isset($val['courthouse_address']) ? strip_tags(html_entity_decode($val['courthouse_address'], ENT_QUOTES, 'UTF-8')) : '', 'city' => strip_tags(html_entity_decode($val['courthouse_city'], ENT_QUOTES, 'UTF-8')), 'state' => strip_tags(html_entity_decode($val['courthouse_state'], ENT_QUOTES, 'UTF-8')), 'zip' => strip_tags(html_entity_decode($zip, ENT_QUOTES, 'UTF-8'))];
            }

            return response()->json(Helper::renderApiSuccess('Result', ['data' => $json]), 200);
        }
    }
}
