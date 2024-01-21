<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use Auth;

class PayPalController extends Controller
{
    public function process(Request $request)
    {
        $provider = new ExpressCheckout();

        $data = [];
        $data['items'] = [
            [
                'name' => 'DCOIN',
                'price' => $request->input('amount_custom', $request->input('amount')),
                'qty' => 1,
            ],
        ];

        $response = $provider->setExpressCheckout($data);

        return redirect($response['paypal_link']);
    }

    public function getExpressCheckoutDetails(Request $request)
    {
        $token = $request->get('token');
        $payerId = $request->get('PayerID');

        $provider = new ExpressCheckout();

        $response = $provider->getExpressCheckoutDetails($token);

        $paymentStatus = $provider->doExpressCheckoutPayment($response, $token, $payerId);

        if ($paymentStatus == 'success') {
            Auth::user()->update([
                'dcoin' => Auth::user()->dcoin + $response['PAYMENTREQUEST_0_AMT'],
            ]);

            return redirect('/balance')->with('success', 'Paiement réussi. Votre compte a été crédité.');
        } else {
            return redirect('/balance')->with('error', 'Échec du paiement. Veuillez réessayer.');
        }
    }
}