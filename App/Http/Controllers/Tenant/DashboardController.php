<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        return view('tenant.dashboard');
    }

    public function staffDashboard()
    {
        return view('tenant.staff.dashboard');
    }
}