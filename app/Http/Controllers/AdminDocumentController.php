<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class AdminDocumentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function client_document_directory_list(Request $request, $type = '')
    {
        $list = \App\Models\ClientDocumentUploaded::where('is_uploaded_to_s3', $type)->orderby('id', 'desc')
        ->leftJoin('users', 'users.id', '=', 'tbl_client_document_uploaded.client_id')->select(['tbl_client_document_uploaded.*','name']);
        $list = $list->paginate(10);

        return view('admin.client_documents.list', ['list' => $list]);
    }

    public function client_document_directory_sync_with_s3(Request $request)
    {
        $list = \App\Models\ClientDocumentUploaded::where('is_uploaded_to_s3', 0)->orderby('client_id', 'asc');
        $list = $list->paginate(300);
        $list = !empty($list) ? $list->toArray()['data'] : [];
        foreach ($list as $doc) {

            if (\File::exists(public_path().'/'.$doc['document_file'])) {

                $s3url = '';
                $s3url = 'https://'.env("AWS_BUCKET").'.s3.amazonaws.com/'.$doc['document_file'];
                \App\Models\ClientDocumentUploaded::where('id', $doc['id'])->update(['file_s3_url' => $s3url,'is_uploaded_to_s3' => 1]);
                $file = public_path().'/'.$doc['document_file'];
                Storage::disk('s3')->put($doc['document_file'], fopen($file, 'r+'));

            }
        }
    }


}
