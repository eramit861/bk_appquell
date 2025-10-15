<?php

namespace App\Http\Controllers;

use App\Http\Requests\StripeCreateRequest;
use App\Http\Requests\StripeRequest;
use App\Services\StripeService;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use App\Models\AttorneySubscription;
use Stripe\StripeClient;

class StripeController extends Controller
{
    private StripeClient $stripe_client;

    public function __construct()
    {
        $this->stripe_client = new StripeClient(config('services.stripe.key'));
        /*if($is_live == true){
            $this->stripe_key = "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";
        }else{
            $this->stripe_key="sk_test_va4znBM7G16CfbL5gGxkN1Zq00y2YqXw13";
        }*/
    }

    public function payment(StripeRequest $request)
    {
        $stripeService = new StripeService($this->stripe_client, $request->validated());

        try {
            //https://stripe.com/docs/api/payment_methods/create
            if ($stripeService->createPaymentMethod()->create()) {
                return redirect()->route('attorney_profile', ['tab' => 3])
                    ->with(
                        'success',
                        'Attorney Card has been securely registered on stripe.'
                    );
            }

        } catch (\Stripe\Error\Card $e) {
            return redirect()->route('attorney_profile', ['tab' => 3])->with('error', $e->getMessage());
        } catch (\Stripe\Error\Base $e) {
            return redirect()->route('attorney_profile', ['tab' => 3])->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->route('attorney_profile', ['tab' => 3])->with('error', $e->getMessage());
        }
    }

    public function create_payment(StripeCreateRequest $request)
    {
        $stripeService = new StripeService($this->stripe_client, $request->validated());

        try {
            if ($stripeService->createPaymentMethod()->create()) {
                if ($this->isSignupSubscription()) {
                    $this->attorney_signup_subscription($request->package_id, $request->no_of_clients);

                    return redirect()->route('attorney_profile')->with(
                        'success',
                        'Subscription has been added succssfully'
                    );
                } else {
                    $return = $this->attorney_subscription($request->package_id, $request->no_of_clients);
                    if (!empty($return)) {
                        return redirect()->route('attorney_profile')->with(
                            'error',
                            $return
                        );
                    }

                    return redirect()->route('attorney_profile')->with(
                        'success',
                        'Subscription has been added succssfully'
                    );
                }
            }

            return redirect()->route('attorney_profile')->with('error', 'Subscription error');
        } catch (\Stripe\Error\Card $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } catch (\Stripe\Error\Base $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    private function isSignupSubscription()
    {
        $attorneyUser = Auth::user();
        $attorney_id = $attorneyUser->id;
        $signupSubcription = AttorneySubscription::where('attorney_id', $attorney_id)->first();
        if (!empty($signupSubcription)) {
            false;
        }

        return true;
    }

    public function attorney_subscription($packageId, $noOfClients, $subscription_id = null, $packagePrice = null)
    {
        $noOfClients = $noOfClients ?? 1;
        $attorneyUser = Auth::user();
        $attorney_id = $attorneyUser->id;
        $attorneypayments = $attorneyUser->attorneyPayments;
        $attorneypayments = (!empty($attorneypayments)) ? $attorneypayments->toArray() : [];
        $packageName = AttorneySubscription::allPackageNameArray($packageId);
        $packagePrice = isset($packagePrice) && !is_null($packagePrice) ? $packagePrice : AttorneySubscription::allPackagePriceArray($packageId);
        if (is_array($packagePrice) || empty($packagePrice)) {
            return "Please choose correct plan!";
        }
        $payamount = AttorneySubscription::getPaymentWithDigit($packageId, $packagePrice, $noOfClients, $attorney_id);
        try {
            if (!empty($attorneypayments['stripe_customer_id'])) {
                $product = $this->stripe_client->paymentIntents->create(
                    ['amount' => $payamount * 100,
                    'currency' => 'usd',
                    'payment_method' => $attorneypayments['stripe_payment_method'],
                    'customer' => $attorneypayments['stripe_customer_id'],
                    'description' => $packageName ." (".$noOfClients." questionnaire)",
                    ]
                );
                $intent_confirm = $this->stripe_client->paymentIntents->confirm(
                    $product->id,
                    ['payment_method' => $attorneypayments['stripe_payment_method']]
                );
                if ($intent_confirm->status == 'requires_capture') {
                    $intent = $this->stripe_client->paymentIntents->retrieve($product->id);
                    $intent->capture(['amount_to_capture' => $payamount * 100]);
                }
                if (!empty($product->id)) {
                    if ($subscription_id > 0) {
                        AttorneySubscription::where('id', $subscription_id)
                        ->update([
                            'stripe_subscription_id' => $product->id,
                            'payment_status' => Helper::SUCCESS,
                            'total_paid' => $payamount,
                            'payment_remark' => "Payment made successfully.",
                        ]);
                    } else {
                        $subscription = [
                            'attorney_id' => $attorney_id,
                            'type' => $packageId,
                            'amount' => $packagePrice,
                            'payment_status' => Helper::SUCCESS,
                            'payment_remark' => "Payment made successfully.",
                            'total_paid' => $payamount,
                            'subscribe' => 0,
                            'discount_percentage' => AttorneySubscription::getdiscountPercentage($attorney_id),
                            'discount_amount' => AttorneySubscription::getdiscountAmount($noOfClients, $packagePrice, $attorney_id),
                            'stripe_subscription_id' => $product->id,
                            'no_of_questionnaire' => $noOfClients,
                            'package_name' => AttorneySubscription::allPackageNameWithParamForTransactionArray($packageId),
                        ];
                        AttorneySubscription::create($subscription);
                    }
                }

            }
        } catch (\Stripe\Error\Base $e) {
            return $e->getMessage();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function attorney_subscription_in_bulk($attorneyUser, $paymentAmount, $paymentDesc, $nameArray)
    {
        $attorney_id = $attorneyUser->id;
        $attorneypayments = $attorneyUser->attorneyPayments;
        $attorneypayments = (!empty($attorneypayments)) ? $attorneypayments->toArray() : [];
        // Convert the discounted amount to cents and round to the nearest integer
        $paymentAmount = intval(round($paymentAmount * 100));

        try {
            if (!empty($attorneypayments['stripe_customer_id'])) {
                $product = $this->stripe_client->paymentIntents->create(
                    ['amount' => $paymentAmount,
                    'currency' => 'usd',
                    'payment_method' => $attorneypayments['stripe_payment_method'],
                    'customer' => $attorneypayments['stripe_customer_id'],
                    'description' => $paymentDesc,
                    'metadata' => $nameArray
                    ]
                );
                if (empty($product->id)) {
                    return ['status' => 0,  'id' => null, 'msg' => 'Failed to create PaymentIntent.'];
                }
                $intent_confirm = $this->stripe_client->paymentIntents->confirm(
                    $product->id,
                    ['payment_method' => $attorneypayments['stripe_payment_method']]
                );

                if ($intent_confirm->status == 'requires_capture') {
                    $intent = $this->stripe_client->paymentIntents->retrieve($product->id);
                    $intent->capture(['amount_to_capture' => $paymentAmount]);
                }
                $intent = $this->stripe_client->paymentIntents->retrieve($product->id);
                if ($intent->status === 'succeeded') {
                    return ['status' => 1, 'id' => $product->id];
                } else {
                    return ['status' => 0, 'id' => null, 'msg' => 'Payment Failed, Please update your payment method.'];
                }


            }
        } catch (\Stripe\Error\Base $e) {
            return ['status' => 0, 'id' => null, 'msg' => $e->getMessage()];
        } catch (Exception $e) {
            return ['status' => 0, 'id' => null, 'msg' => $e->getMessage()];
        }
    }


    private function attorney_signup_subscription($packageId, $noOfClients)
    {
        $noOfClients = $noOfClients ?? 1;
        $attorneyUser = Auth::user();
        $attorney_id = $attorneyUser->id;
        $attorneypayments = $attorneyUser->attorneyPayments;
        $attorneypayments = (!empty($attorneypayments)) ? $attorneypayments->toArray() : [];
        $packageName = AttorneySubscription::allPackageNameArray($packageId);
        $packagePrice = AttorneySubscription::allPackagePriceArray($packageId);
        if (is_array($packagePrice) || empty($packagePrice)) {
            return redirect()->route('attorney_price_table', ['package_id' => $packageId])->with('error', "Please choose correct subscription package!");
        }
        $payamount = AttorneySubscription::getPaymentWithDigit($packageId, $packagePrice, $noOfClients, $attorney_id);

        try {
            if (!empty($attorneypayments['stripe_customer_id'])) {
                $product = $this->stripe_client->paymentIntents->create([
                    'amount' => $payamount * 100,
                    'currency' => 'usd',
                    'payment_method' => $attorneypayments['stripe_payment_method'],
                    'customer' => $attorneypayments['stripe_customer_id'],
                    'description' => $packageName ." (".$noOfClients." questionnaire)",
                ]);
                $intent_confirm = $this->stripe_client->paymentIntents->confirm(
                    $product->id,
                    ['payment_method' => $attorneypayments['stripe_payment_method']]
                );
                if ($intent_confirm->status == 'requires_capture') {
                    $intent = $this->stripe_client->paymentIntents->retrieve($product->id);
                    $intent->capture(['amount_to_capture' => $payamount * 100]);
                }
                $expire_time = '2099-12-31'; // Never expire (far future date)
                if (!empty($product->id)) {
                    $subscription = [
                        'attorney_id' => $attorney_id,
                        'type' => $packageId,
                        'amount' => $packagePrice,
                        'payment_status' => Helper::SUCCESS,
                        'payment_remark' => "Payment made successfully.",
                        'total_paid' => $payamount,
                        'subscribe' => 0,
                        'stripe_subscription_id' => $product->id,
                        'expiration_date' => $expire_time,
                        'no_of_questionnaire' => $noOfClients ?? 1,
                        'is_signup_subscription' => 1,
                        'package_name' => AttorneySubscription::allPackageNameWithParamForTransactionArray($packageId),
                    ];
                    AttorneySubscription::create($subscription);

                    return redirect()->route('attorney_profile')->with(
                        'success',
                        'Subscription has been added succssfully'
                    );
                }
            }
        } catch (\Stripe\Error\Base $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


}
