<?php

namespace App\Http\Controllers\Api;

use App\Http\Services\ServiceProcessService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function serviceList(Request $request, $locationId)
    {
        $service = new ServiceProcessService();
        $response = $service->serviceList($locationId, $request->parent_service);

        return response()->json($response);
    }
}
