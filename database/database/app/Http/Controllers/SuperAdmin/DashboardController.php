<?php

namespace App\Http\Controllers\SuperAdmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['mainMenu'] = 'dashboard';
        $data['menuName'] = __('Dashboard');

        return view('super_admin.dashboard', $data);
    }
}
