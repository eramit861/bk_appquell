<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserLoginHistoryController extends Controller
{
    public function userLoginHistory(Request $request)
    {

        $query = \App\Models\LoginActivity::join('users', 'users.id', '=', 'login_activities.user_id')
            ->select('login_activities.*', 'users.role', 'users.name as client_name', 'users.email as client_email')->where('role', '!=', 1);

        // Apply search filter if keyword is passed
        if ($request->has('keyword') && !empty($request->keyword)) {
            $query->where('users.name', 'LIKE', '%' . $request->keyword . '%');
        }

        $userLoginHistory = $query->orderBy('login_activities.logged_in_at', 'desc')->paginate(50);

        return view('admin.user.login-history', ['userLoginHistory' => $userLoginHistory]);
    }


}
