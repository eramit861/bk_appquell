<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Http\Controllers\StripeController;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Traits\Common; // Trait
use App\Models\SubscriptionToclient;
use App\Helpers\VideoHelper;
use App\Models\AttorneySubscription;

class AttorneySubscriptionController extends AttorneyController
{
    use Common;

    public function consumed(Request $request)
    {
        if (Auth::user()->show_terms == 1) {
            return redirect()->route('attorney_landing')->with('error', 'Please accept the term and conditions.');
        }
        if (!$this->isValidPackage()) {
            return redirect()->route('attorney_price_table', ['package_id' => 100]);
        }

        $listing = SubscriptionToclient::where('attorney_id', Helper::getCurrentAttorneyId())
            ->join("users", "users.id", "=", "tbl_subscription_to_client.client_id")
            ->where('users.free_package_unpaid', '=', 0)
            ->select('tbl_subscription_to_client.per_package_price', 'tbl_subscription_to_client.discount_percentage', 'tbl_subscription_to_client.discounted_price', 'tbl_subscription_to_client.package_name', 'users.name', 'tbl_subscription_to_client.client_id', 'tbl_subscription_to_client.package_id', 'tbl_subscription_to_client.quantity', 'tbl_subscription_to_client.created_at');

        $searchQuery = $request->input('q') ?? '';

        if (!empty($searchQuery)) {
            $listing->where(function ($query) use ($searchQuery) {
                $query->where('users.name', 'like', '%' . $searchQuery . '%');
            });
        }

        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');

        $listing = $listing->orderBy($sortBy, $sortOrder);

        $perPage = $request->input('per_page', 10);
        $listing = $listing->paginate($perPage)->appends([
            'q' => $searchQuery,
            'per_page' => $perPage,
            'sort_by' => $sortBy,
            'sort_order' => $sortOrder,
        ]);

        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_TRANSACTION_MANAGEMENT);

        return view('attorney.transaction_consumed', [ 'sort_by' => $sortBy, 'sort_order' => $sortOrder, 'per_page' => $perPage, 'video' => $video, 'listing' => $listing, 'keyword' => $searchQuery,]);
    }

    public function purchase_package_for_attorney(Request $request)
    {
        $packages = $request->input('packages');
        $packages = json_decode($packages, 1);
        $stripe = new StripeController();
        foreach ($packages as $package) {
            $return = $stripe->attorney_subscription($package['id'], $package['unit']);
            if (!empty($return)) {
                return response()->json(Helper::renderJsonError($return))->header('Content-Type: application/json;', 'charset=utf-8');
            }
        }

        return response()->json(Helper::renderJsonSuccess('Subscription purchased successfully.'))->header('Content-Type: application/json;', 'charset=utf-8');
    }

    public function purchase_package_add_to_client(Request $request)
    {
        $attorneyId = Helper::getCurrentAttorneyId();
        $package_id = $request->input('package_id');
        $client_id = $request->input('client_id');
        $package_type = $request->input('package_type');
        $unit = 1;
        if ($package_type == 3) {
            $unit = 2;
        }
        $packagePrice = AttorneySubscription::allPackagePriceArray($package_id);
        $attorney = Auth::user();

        $AttorneySubscriptionRowId = null;
        $isFreePackage = false;
        if ($package_id == AttorneySubscription::FREE_PACKAGE) {
            $package_id = AttorneySubscription::BASIC_SUBSCRIPTION;
            $AttorneySubscriptionRowId = AttorneySubscription::where('stripe_subscription_id', $client_id)
                ->where('attorney_id', $attorneyId)
                ->where('type', $package_id)
                ->first();
            $AttorneySubscriptionRowId = $AttorneySubscriptionRowId->id ?? null;

            $isFreePackage = true;
        }

        if (!is_array($packagePrice) && $packagePrice > 0 && $attorney->demo_attorney == 0) {
            $stripe = new StripeController();
            $return = $stripe->attorney_subscription($package_id, $unit, $AttorneySubscriptionRowId, $packagePrice);
            if (!empty($return)) {
                return response()->json(Helper::renderJsonError($return))->header('Content-Type: application/json;', 'charset=utf-8');
            }
        }

        $package = AttorneySubscription::addPackages($attorneyId, $client_id, $package_id, $unit);
        $discountPercentage = $attorney->subscription_discount_percent ?? 0;
        $perPackagePrice = $packagePrice;
        $packageName = $this->getPackageName($package_id);
        $package['per_package_price'] = $perPackagePrice;
        $package['discount_percentage'] = $discountPercentage;
        $discountedAmount = $this->getDiscountPrice($discountPercentage, $perPackagePrice);
        $package['discounted_price'] = $discountedAmount;
        $package['package_name'] = $packageName;
        if ($isFreePackage) {
            SubscriptionToclient::where('client_id', $client_id)
                ->where('attorney_id', $attorneyId)
                ->where('package_id', $package_id)
                ->update(['updated_at' => date("Y-m-d H:i:s")]);
        }
        if (!$isFreePackage) {
            SubscriptionToclient::create($package);
        }
        AttorneySubscription::addPackageToUserTable($client_id, $package_id, $package_type, $isFreePackage);

        return response()->json(Helper::renderJsonSuccess('Subscription purchased successfully.'))->header('Content-Type: application/json;', 'charset=utf-8');
    }



    public function subscription(Request $request)
    {
        if ($request->isMethod('post')) {
            $attorney = Auth::user();
            $input = $request->all();
            $stripe = new StripeController();
            $package = $input['package'];
            $sub_package = $input['sub_package'] ?? [];
            $no_of_clients = $input['no_of_clients'];
            $packages = [];
            array_push($packages, $package);
            if (!empty($sub_package)) {
                array_push($sub_package, $package);
                $packages = $sub_package;
            }
            $packagePriceTotal = 0;
            $packageDesc = '';
            $nameArray = [];
            $inde = 1;
            foreach ($packages as $packageId) {
                $thisPackageName = AttorneySubscription::allPackageNameArray($packageId)." (".$no_of_clients." questionnaire)";
                $thisPackagePrice = AttorneySubscription::allPackagePriceArray($packageId);
                $nameArray[$inde.'. $'.($thisPackagePrice * $no_of_clients)] = $thisPackageName;
                $packageDesc = $packageDesc. $thisPackageName;
                $packagePriceTotal += ($thisPackagePrice * $no_of_clients);
                $inde++;
            }
            $product_id = '';
            if ($attorney->demo_attorney == 0) {
                $stripe = new StripeController();
                $packageDesc = $packageDesc;
                $result = $stripe->attorney_subscription_in_bulk($attorney, $packagePriceTotal, $packageDesc, $nameArray);
                if (!isset($result['status'])) {
                    return redirect()->route('attorney_profile', ['tab' => 4])->with('error', $result);
                }
                $product_id = $result['id'] ?? '';
            }
            foreach ($packages as $packageId) {
                $price = AttorneySubscription::allPackagePriceArray($packageId);
                AttorneySubscription::addSubscriptionRecord(Helper::getCurrentAttorneyId(), $packageId, $price, $no_of_clients, $product_id);
            }

            return redirect()->route('attorney_profile', ['tab' => 4])->with('success', 'Addon has been purchased successfully.');
        }
    }

    public function petition_subscription(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $stripe = new StripeController();
            $petition_type = $input['petition_type'];
            $no_of_petition_client = $input['no_of_petition_client'];
            $this->validatePetition($petition_type);
            $return = $stripe->attorney_subscription($petition_type, $no_of_petition_client);
            if (!empty($return)) {
                return redirect()->route('attorney_profile', ['tab' => 4])->with('active', 1)->with('error', $return);
            }
            /** Purchase Paralegal check */
            $paralegal_selected = $input['paralegal_selected'] ?? 0;
            if ($paralegal_selected == 1) {
                $paralegal_type = $input['paralegal_type'] ?? 0;
                $no_of_paralegal_client = $input['no_of_paralegal_client'] ?? 0;
                $this->validateParalegal($paralegal_type, $no_of_paralegal_client);
                $return = $stripe->attorney_subscription($paralegal_type, $no_of_paralegal_client);
                if (!empty($return)) {
                    return redirect()->route('attorney_profile', ['tab' => 4])->with('active', 1)->with('error', $return);
                }
            }

            /** purchase paralegal check end */
            return redirect()->route('attorney_profile', ['tab' => 4])->with('success', 'Addon has been updated successfully.');
        }
    }

    private function validatePetition($petition_type)
    {
        $peitionArray = AttorneySubscription::getPetitionPriceArray();
        if (!in_array($petition_type, array_keys($peitionArray))) {
            return redirect()->route('attorney_profile', ['tab' => 4])->with('error', 'Invalid Petition package');
        }
    }

    private function validateParalegal($paralegal_type, $no_of_paralegal_client)
    {
        $paralegalArray = AttorneySubscription::getParalegalArray();
        if (!in_array($paralegal_type, array_keys($paralegalArray))) {
            return redirect()->route('attorney_profile', ['tab' => 4])->with('error', 'Invalid package type');
        }
        if ($no_of_paralegal_client < 1) {
            return redirect()->route('attorney_profile', ['tab' => 4])->with('error', 'Paralegal check required');
        }
    }

    public function video_subscription(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->all();
            $stripe = new StripeController();
            $attorney_id = Helper::getCurrentAttorneyId();
            if ($input['type'] != AttorneySubscription::WELCOME_VIDEO_SUBSCRIPTION) {
                return redirect()->route('attorney_profile', ['tab' => 4])->with('error', 'Invalid request');
            }
            /*
            * NORMAL SUBSCRIPTION PROCESS
            */
            $subscription = [
                'attorney_id' => $attorney_id,
                'type' => $input['type'],
                'amount' => AttorneySubscription::WELCOME_VIDEO_SUBSCRIPTION_PRICE,
                'subscribe' => $input['subscribe'],
                'video_link' => (!empty($input['video_link'])) ? $input['video_link'] : "",
                'no_of_questionnaire' => 1,
            ];

            $thumbnail_video_image = "";
            if ($request->hasFile('thumbnail_file')) {
                $store_path = "attorney/".$attorney_id."/subscription_image";
                $path = public_path()."/attorney/".$attorney_id."/subscription_image";
                $this->checkOrCreateDir($path);
                $imageName = time().'.'.$request->thumbnail_file->extension();
                $request->thumbnail_file->move($path, $imageName);
                $thumbnail_video_image = $store_path.'/'.$imageName;
                $subscription['thumbnail_video_image'] = $thumbnail_video_image;
            }
            unset($input['thumbnail_file']);
            $attorney_subscription = AttorneySubscription::create($subscription);
            $attorney_subscription = $attorney_subscription->id;
            $return = $stripe->attorney_subscription(AttorneySubscription::WELCOME_VIDEO_SUBSCRIPTION, 1, $attorney_subscription);
            if (!empty($return)) {
                return redirect()->route('attorney_profile', ['tab' => 4])->with('active', 1)->with('error', $return);
            }

            return redirect()->route('attorney_profile', ['tab' => 4])->with('cuccess', 'Subscription has been added successfully.');
        }
    }

}
