<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Helpers\VideoHelper;

class ClientLoginHistoryController extends AttorneyController
{
    public function clientLoginHistory(Request $request)
    {
        $attorney_id = Helper::getCurrentAttorneyId();
        $query = \App\Models\LoginActivity::join('users', 'users.id', '=', 'login_activities.user_id')
            ->join('tbl_clients_attorney as atty', 'atty.client_id', '=', 'users.id')
            ->where('atty.attorney_id', $attorney_id)
            ->select('login_activities.*', 'users.name as client_name', 'users.email as client_email');

        // Apply search filter if keyword is passed
        if ($request->has('keyword') && !empty($request->keyword)) {
            $query->where('users.name', 'LIKE', '%' . $request->keyword . '%');
        }

        $clientLoginHistory = $query->orderBy('login_activities.logged_in_at', 'desc')->paginate(50);
        $video = VideoHelper::getAttorneyVideos(Helper::ATTORNEY_CLIENT_QUESTIONNAIRE_VIDEO);

        return view('attorney.client.login-history', ['clientLoginHistory' => $clientLoginHistory, 'video' => $video]);
    }


}
