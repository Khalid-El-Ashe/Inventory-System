<?php

namespace App\Repositories\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardModelRepository implements DashboardRepository {
     public function changePassword(Request $request, $guard)
    {
        // Implement password change logic
        // Change password logic
        $user = Auth::guard($guard)->user();

        // Validate request data
        // request()->validate([
        //     'current_password' => ['required'],
        //     'new_password' => ['required', 'min:8', 'confirmed'],
        // ]);

        // Check current password
        if (!Hash::check(request('current_password'), $user->password)) {
            return response()->json([
            'message' => 'Current password is incorrect.'
            ], Response::HTTP_BAD_REQUEST);
        }

        // Update password
        $user->password = Hash::make(request('new_password'));
        $user->save();

        return response()->json([
            'message' => 'Password changed successfully.'
        ], Response::HTTP_CREATED);
    }
}
