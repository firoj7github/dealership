<?php

namespace App\Http\Controllers;
use Mews\Captcha\Facades\Captcha;


use Illuminate\Http\Request;

class CaptaController extends Controller
{
    public function index(){

     return response()->json([
        'captcha'=> captcha_img()
     ]);
    }
}
