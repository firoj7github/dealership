<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment-form');
    }

    public function processPayment(Request $request)
    {

        // dd($request->all());
        $client = new Client([
            'base_uri' => env('CARDCONNECT_API_URL'),
            'auth' => [
                env('CARDCONNECT_API_USER'),
                env('CARDCONNECT_API_PASSWORD')
            ]
        ]);

        // dd($client);

        $response = $client->post('/', [
            'form_params' => [
                'merchid' => '177000000005', // Replace with your actual merchant ID
                'account' => $request->input('card_number'),
                'expiry' => $request->input('expiry_date'),
                'cvv' => $request->input('cvv'),
                // Include other required parameters for the transaction
            ]
        ]);

        dd($response);
        // Handle the response from CardConnect
        $result = json_decode($response->getBody(), true);

        // Process the result and handle success/failure
        // For example:
        if ($result['status'] === 'approved') {
            return redirect()->route('payment.success');
        } else {
            return redirect()->route('payment.failure');
        }
    }
}
