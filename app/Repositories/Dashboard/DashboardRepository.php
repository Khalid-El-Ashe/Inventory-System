<?php

namespace App\Repositories\Dashboard;

use Illuminate\Http\Request;

interface DashboardRepository {
    public function changePassword(Request $request, $guard);
}
