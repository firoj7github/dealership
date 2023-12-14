<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\NewsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function newsList()
    {
        $service = new NewsService();
        $response = $service->newsList();

        return response()->json($response);
    }
}
