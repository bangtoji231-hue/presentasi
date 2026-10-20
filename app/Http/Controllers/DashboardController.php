<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request): RedirectResponse
    {
        $dashboardRoute = $request->user()->is_admin
            ? 'admin.dashboard'
            : 'user.dashboard';

        return redirect()->route($dashboardRoute);
    }
}