<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;

class StripeController extends Controller
{
    public function payment_index()
    {
        return view('stripe');
    }
    
    public function payment(Request $request)
    {

        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $customer = Customer::create(
                array(
                    'email' => $request->stripeEmail,
                    'source' => $request->stripeToken
                )
            );

            dump($customer);
            dump($customer->id);
            $charge = Charge::create(
                array(
                    'customer' => $customer->id,
                    'amount' => 100,
                    'currency' => 'jpy'
                )
            );

            dump($charge);
            dump($charge->source->id);
            dump($charge->source->brand);
            dump($charge->source->last4);
            dump($charge->source->exp_month);
            dump($charge->source->exp_year);

            return redirect()->route('complete');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function complete()
    {
        return view('thx4payment');
    }
}
