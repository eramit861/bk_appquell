<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;

class AdminAttorneyChatController extends Controller
{
    public function AttorneyChatListing()
    {
        return view('admin.attorney.attorneychat');
    }

    public function AdminFileSharing(Request $request)
    {
        return Helper::Attachment_upload($request);
    }
}
