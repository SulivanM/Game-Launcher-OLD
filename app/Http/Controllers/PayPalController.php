<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayPalController extends Controller
{
    public function process(Request $request)
    {
        $provider = new PayPalClient;

        $response = $provider->addProduct('Demo Product', 'Demo Product', 'SERVICE', 'SOFTWARE')
            ->addPlanTrialPricing('DAY', 7)
            ->addDailyPlan('Demo Plan', 'Demo Plan', 1.50)
            ->setReturnAndCancelUrl('https://example.com/paypal-success', 'https://example.com/paypal-cancel')
            ->setupSubscription('John Doe', 'john@example.com', '2021-12-10');

        return redirect($response['approve_link']);
    }

    public function getExpressCheckoutDetails(Request $request)
    {
        $token = $request->get('token');
        $payerId = $request->get('PayerID');

        $provider = new PayPalClient;

        $response = $provider->capturePayment($token, $payerId);

        if ($response['status'] == 'success') {
            // Update the 'dcoin' column of the authenticated user
            auth()->user()->update([
                'dcoin' => auth()->user()->dcoin + $response['amount'],
            ]);

            return redirect('/balance')->with('success', 'Payment successful. Your account has been credited.');
        } else {
            return redirect('/balance')->with('error', 'Payment failed. Please try again.');
        }
    }
}
