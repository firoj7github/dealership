<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $data['mainMenu'] = 'dashboard';
        $data['menuName'] = __('Dashboard');

        return view('admin.dashboard', $data);
    }
}
