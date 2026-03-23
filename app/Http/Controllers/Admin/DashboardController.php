<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Models\OrganizationMember;
use App\Models\Commission;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers    = OrganizationMember::count();
        $totalCommissions = Commission::count();
        return view('admin.dashboard', compact('totalMembers', 'totalCommissions'));
    }
}
