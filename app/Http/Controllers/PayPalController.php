<?php

namespace App\Http\Controllers;

use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;

class PayPalController extends Controller
{
    public function index()
    {
        return view('balance');
    }

    public function payment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $package = $request->input('package');
        $customAmount = $request->input('custom_amount');

        $amount = ($package == 'custom') ? $customAmount : $package;

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.payment.success'),
                "cancel_url" => route('paypal.payment.cancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $amount,
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()->route('cancel.payment');
        } else {
            return redirect()->route('create.payment');
        }
    }

    public function paymentCancel()
    {
        echo '<script>
                Swal.fire({
                    title: "Payment Canceled",
                    text: "Your payment has been canceled.",
                    icon: "warning",
                });
              </script>';
        return redirect()->route('balance');
    }

    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            echo '<script>
                    Swal.fire({
                        title: "Payment Successful",
                        text: "Your payment was successful.",
                        icon: "success",
                    });
                  </script>';
            return redirect()->route('balance');
        } else {
            return redirect()->route('balance');
        }
    }
}