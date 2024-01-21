<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
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

        $response = PayPal::setExpressCheckout($data);

        return redirect($response['paypal_link']);
    }

    public function getExpressCheckoutDetails(Request $request)
    {
        $token = $request->get('token');
        $payerId = $request->get('PayerID');

        $response = PayPal::getExpressCheckoutDetails($token);

        $paymentStatus = PayPal::doExpressCheckoutPayment($response, $token, $payerId);

        if ($paymentStatus == 'success') {
            // Mettez à jour la colonne 'dcoin' de l'utilisateur authentifié
            auth()->user()->update([
                'dcoin' => auth()->user()->dcoin + $response['PAYMENTREQUEST_0_AMT'],
            ]);

            return redirect('/balance')->with('success', 'Paiement réussi. Votre compte a été crédité.');
        } else {
            return redirect('/balance')->with('error', 'Échec du paiement. Veuillez réessayer.');
        }
    }
}