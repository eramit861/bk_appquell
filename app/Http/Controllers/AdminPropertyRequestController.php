<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TblPropertyDetailApiRequest;

class AdminPropertyRequestController extends Controller
{
    public function index(Request $request)
    {
        $api_requests = TblPropertyDetailApiRequest::where("client_id", "!=", null)->orderBy('id', 'desc');

        if (!empty($request->query('q'))) {
            $api_requests->Where(function ($query) use ($request): void {
                $query->Where('client_id', 'like', '%' . $request->query('q') . '%');
            });
        }

        $api_requests = $api_requests->paginate(10);
        $keyword = $request->query('q') ?? '';

        return view('admin.propertyrequest.show')->with(['keyword' => $keyword,'api_requests' => $api_requests]);
    }
}
