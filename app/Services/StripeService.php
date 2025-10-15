<?php

namespace App\Services;

use App\Models\User;
use Stripe\Exception\ApiErrorException;
use Stripe\PaymentMethod;
use Stripe\StripeClient;

class StripeService
{
    protected array $validated_data;
    protected User $user;
    protected StripeClient $stripeClient;
    protected PaymentMethod $payment_data;


    public function __construct(StripeClient $stripeClient, array $validated_data)
    {
        $this->validated_data = $validated_data;
        $this->user = auth()->user();
        $this->stripeClient = $stripeClient;
    }

    /**
     * @throws ApiErrorException
     */
    public function create(): bool
    {
        if ($this->payment_data->id) {
            $card_info = $this->makeCardInfo();

            $payment_methods_data = [];
            $payment_methods_data['attorney_id'] = $this->user->id;
            $payment_methods_data['stripe_payment_method'] = $this->payment_data->id;
            $payment_methods_data['stripe_payment_type'] = $this->payment_data->type;

            $customer_data = $this->stripeClient->customers->create([
                'name' => $this->user->name,
                'email' => $this->user->email,
                'payment_method' => $this->payment_data->id,
            ]);
            $payment_methods_data['stripe_customer_id'] = $customer_data->id;
            $this->user->attorneyPayments()->delete();
            $attorney_payments_info = $this->user->attorneyPayments()
                ->create($payment_methods_data);

            if ($attorney_payments_info->id) {
                $this->user->attorneyCards()->delete();
                $this->user->attorneyCards()->create($card_info);
            }

            return true;
        }

        return false;
    }

    /**
     * @throws ApiErrorException
     */
    public function createPaymentMethod(): self
    {
        $this->payment_data = $this->stripeClient->paymentMethods->create([
            'type' => 'card',
            'card' => [
                'number' => $this->validated_data['card_number'],
                'exp_month' => $this->validated_data['exp_month'],
                'exp_year' => $this->validated_data['exp_year'],
                'cvc' => $this->validated_data['cvc'],
            ],
        ]);

        return $this;
    }

    public function checkPaymentMethod(): bool
    {
        $attorney_payments = $this->user->attorneyPayments;
        $attorney_payments = !empty($attorney_payments) ? $attorney_payments->toArray() : [];

        return empty($attorney_payments['stripe_payment_method']);
    }

    protected function makeCardInfo(): array
    {
        $card_info = [];
        $card_info['attorney_id'] = $this->user->id;
        $card_info['brand'] = $this->payment_data->card->brand;
        $card_info['country'] = $this->payment_data->card->country;
        $card_info['exp_month'] = $this->payment_data->card->exp_month;
        $card_info['exp_year'] = $this->payment_data->card->exp_year;
        $card_info['last4'] = $this->payment_data->card->last4;
        $card_info['card_name'] = $this->validated_data['card_holder_name'];

        return $card_info;
    }


}
