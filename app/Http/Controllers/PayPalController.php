<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Auth;

class PayPalController extends Controller
{
    public function process(Request $request)
    {
        $data = [];
        $data['items'] = [
            [
                'name' => 'DCOIN',
                'price' => $request->input('amount_custom', $request->input('amount')),
                'qty' => 1,
            ],
        ];

        $provider = new PayPalClient;

        $response = $provider->setExpressCheckout($data);

        return redirect($response['paypal_link']);
    }

    public function getExpressCheckoutDetails(Request $request)
    {
        $token = $request->get('token');
        $payerId = $request->get('PayerID');

        $provider = new PayPalClient;

        $response = $provider->getExpressCheckoutDetails($token);

        $paymentStatus = $provider->doExpressCheckoutPayment($response, $token, $payerId);

        if ($paymentStatus == 'success') {
            // Mettez à jour la colonne 'dcoin' de l'utilisateur authentifié
            Auth::user()->update([
                'dcoin' => Auth::user()->dcoin + $response['PAYMENTREQUEST_0_AMT'],
            ]);

            return redirect('/balance')->with('success', 'Paiement réussi. Votre compte a été crédité.');
        } else {
            return redirect('/balance')->with('error', 'Échec du paiement. Veuillez réessayer.');
        }
    }
}