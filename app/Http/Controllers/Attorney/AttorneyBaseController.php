<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Traits\Common; // Trait
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Helpers\VideoHelper;

class AttorneyBaseController extends AttorneyController
{
    use Common;

    public function transactions(Request $request)
    {
        if (Auth::user()->show_terms == 1) {
            return redirect()->route('attorney_landing')->with('error', 'Please accept the term and conditions.');
        }
        if (!$this->isValidPackage()) {
            return redirect()->route('attorney_price_table', ['package_id' => 100]);
        }
        $attorney_transactions = \App\Models\AttorneySubscription::orderBy('id', 'DESC');
        if (!empty($request->query('q'))) {
            $attorney_transactions->orWhere(function ($query) use ($request) {
                $query->orWhere('amount', 'like', '%' . $request->query('q') . '%');
                $query->orWhere('stripe_subscription_id', 'like', '%' . $request->query('q') . '%');
            });
        }
        $attorney_transactions->where('attorney_id', Auth::user()->id);
        $attorney_transactions = $attorney_transactions->paginate(10);
        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_TRANSACTION_MANAGEMENT);

        return view('attorney.transaction', ['video' => $video, 'attorney_transactions' => $attorney_transactions]);
    }


    public function landing(Request $request)
    {
        $attorney_id = Helper::getCurrentAttorneyId();

        if ($request->isMethod('post')) {
            $input = $request->all();
            if (empty($input['agreed'])) {
                return redirect()->route('attorney_landing', ['package_id' => $request->package_id])->with('error', 'Please accept the term and conditions.');
            }
            /*marking term as accepted*/
            $attorney_id = Auth::user()->id;
            \App\Models\User::where("id", $attorney_id)->update(["show_terms" => 0]);

            try {
                $user = \App\Models\User::where("id", $attorney_id)->select('*')->first();
                $mail = Helper::getAttorneyEmailArray($attorney_id);
                Mail::to($mail)->send(new \App\Mail\WelcomeAttorney($user, true));
            } catch (\Exception $e) {

            }

            if (!$this->isValidPackage()) {
                return redirect()->route('attorney_price_table', ['package_id' => $request->package_id]);
            }

            return redirect()->route('attorney_dashboard')->with('success', 'You are logged in.');
        }

        if (Auth::check() && !empty(Auth::user()->id)) {
            //Change Show terms to 0 after showing first time to attorney so attorney does not see terms popup again
            $attorney_company = \App\Models\AttorneyCompany::where('attorney_id', $attorney_id)->first();
            $attorney_company = !empty($attorney_company->toArray()) ? $attorney_company->toArray() : [];
            $attorney_company['name'] = Auth::user()->name;
            $attorney_company['email'] = Auth::user()->email;
        }

        return view('attorney.landing', ["company" => $attorney_company]);
    }

    public function pricing(Request $request)
    {
        if (Auth::user()->show_terms == 1) {
            return redirect()->route('attorney_landing', ['package_id' => $request->package_id])->with('error', 'Please accept the term and conditions.');
        }
        $data['planNames'] = \App\Models\AttorneySubscription::packageNameLandingPageArray();
        $data['planPrices'] = \App\Models\AttorneySubscription::packagePriceArray();
        $data['package_id'] = $request->package_id;
        $data['video'] = VideoHelper::getAttorneyVideos(Helper::LANDING_PAGE_PRICING_PLAN_VIDEO);

        return view('attorney.price_table', $data);
    }

    public function dashboard(Request $request)
    {

        if (Auth::user()->show_terms == 1) {
            return redirect()->route('attorney_landing', ['package_id' => $request->package_id])->with('error', 'Please accept the term and conditions.');
        }
        if (!$this->isValidPackage()) {
            return redirect()->route('attorney_price_table', ['package_id' => 100]);
        }
        $attorney_id = Helper::getCurrentAttorneyId();

        $client_count = User::whereHas('ClientsAttorneybyclient', function ($q) use ($attorney_id) {
            $q->where('attorney_id', $attorney_id);
        })->where('users.role', \App\Models\User::CLIENT)->count();





        $sortBy = $request->input('sort_by', 'id');
        $sortOrder = $request->input('sort_order', 'desc');

        $client = User::whereHas('ClientsAttorneybyclient', function ($q) use ($attorney_id) {
            $q->where('attorney_id', $attorney_id);
        })->orderBy('users.' . $sortBy, $sortOrder)->where('users.role', \App\Models\User::CLIENT);

        $searchQuery = $request->input('q') ?? '';

        if (!empty($searchQuery)) {
            $client->where(function ($query) use ($searchQuery) {
                $query->where('users.id', 'like', '%' . $searchQuery . '%')
                      ->orWhere('users.name', 'like', '%' . $searchQuery . '%');
            });
        }



        if (!empty(Auth::user()->parent_attorney_id && empty(Auth::user()->paralegal_law_firm_id))) {
            $client->leftJoin('tbl_clients_paralegal', 'users.id', '=', 'tbl_clients_paralegal.client_id');
            $client->where(['tbl_clients_paralegal.paralegal_id' => Auth::user()->id]);
        }

        if (!empty(Auth::user()->paralegal_law_firm_id)) {
            $client->leftJoin('tbl_clients_associate', 'users.id', '=', 'tbl_clients_associate.client_id');
            $client->where(['tbl_clients_associate.associate_id' => Auth::user()->paralegal_law_firm_id]);
        }

        $client->select(['users.id as id','users.name','users.created_at','users.client_type', 'users.user_status']);

        $perPage = $request->input('per_page', 10);
        $client = $client->paginate($perPage)->appends([
            'q' => $searchQuery,
            'per_page' => $perPage,
            'sort_by' => $sortBy,
            'sort_order' => $sortOrder,
        ]);

        // $client = $client->paginate(10);
        $clients = !empty($client) ? $client->toArray()['data'] : [];

        $this->validateAttorneyPackage($request);
        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_DASHBOARD_VIDEO);


        //$all_attorney = \App\Models\User::where(['id' => $attorney_id, 'role' => \App\Models\User::ATTORNEY, 'parent_attorney_id' => 0 ])->orderBy('name','asc')->pluck('name','id')->all();
        //100, 121,135
        $packages = $this->getAttorneyPackages();

        $usedSubscriptions = $this->getAttorneyUsedSubscriptions();
        if (!empty(Auth::user()->paralegal_law_firm_id)) {
            $client_count = \App\Models\ClientsAssociate::where('associate_id', Auth::user()->paralegal_law_firm_id)->count();
            $packages = [];
            $usedSubscriptions = [];
        }

        return view('attorney.dashboard', ['usedSubscriptions' => $usedSubscriptions,'packages' => $packages, 'sort_by' => $sortBy, 'sort_order' => $sortOrder, 'per_page' => $perPage, 'searchQuery' => $searchQuery, 'clients' => $clients,'video' => $video,'client' => $client,'client_count' => $client_count,"user_data" => Auth::user()]);

    }





    private function validateAttorneyPackage($request)
    {
        if (Auth::user()->show_terms == 1) {
            return redirect()->route('attorney_landing')->with('error', 'Please accept the term and conditions.');
        } else {
            if (!$this->isValidPackage()) {
                return redirect()->route('attorney_price_table', ['package_id' => $request->package_id]);
            }
        }
    }
}
