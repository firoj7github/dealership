<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index()
    {
        return 'ok';
    }

    public function cardo()
    {

        $messagesUrl = "https://isv-uat.cardconnect.com/cardconnect/rest/auth";
        $cred = "AccessTestAccount:Welcome1!";
    
        $payload = [
            "merchid" => "177000000005",
            "account" => "4788250000121443",
            "expiry" => "2024",
            "cvv2" => "123",
            "amount" => "100",
            "phone" => "15558889999",
            "capture" => "y",
        ];
    
        $options = [
            "headers" => [
                "Authorization" => "Basic " . base64_encode($cred),
                "Content-Type" => "application/json",
            ],
        ];
    
        $response = Http::put($messagesUrl, $payload, $options);
    
        // if ($response->successful()) {
        //     $responseData = $response->json();
        //     \Log::info($responseData);
        // } else {
        //     \Log::error('Request failed with status code: ' . $response->status());
        // }
        // Access the response content
        $responseData = $response->json();
    
        // Log the response
        \Log::info($responseData);


        dd($response->status(),$response->body());
    }
}
