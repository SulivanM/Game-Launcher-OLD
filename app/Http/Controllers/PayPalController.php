<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;

class PayPalController extends Controller
{
    public function process(Request $request)
    {
        $provider = new PayPalClient;

        $response = $provider->addProduct('Demo Product', 'Demo Product', 'SERVICE', 'SOFTWARE')
            ->addPlanTrialPricing('DAY', 7)
            ->addDailyPlan('Demo Plan', 'Demo Plan', 1.50)
            ->setReturnAndCancelUrl('https://launcher.digitalchocolate.online/paypal-success', 'https://launcher.digitalchocolate.online/paypal-cancel')
            ->setupSubscription('John Doe', 'john@example.com', '2021-12-10');

        if (isset($response['approve_link'])) {
            return redirect($response['approve_link']);
        } else {
            return redirect('/balance')->with('error', 'Failed to retrieve approval link. Please try again.');
        }
    }

    public function getExpressCheckoutDetails(Request $request)
    {
        $token = $request->get('token');
        $payerId = $request->get('PayerID');

        $provider = new PayPalClient;

        $response = $provider->capturePayment($token, $payerId);

        if (isset($response['status']) && $response['status'] == 'success') {
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