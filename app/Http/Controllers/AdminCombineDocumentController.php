<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientDocumentUploaded;

class AdminCombineDocumentController extends Controller
{
    public function combine_and_download_tax_return(Request $request, $client_id, $docType, $employer_id = 0)
    {
        $selectedIds = [];
        if (isset($request->pdf_id) && !empty($request->pdf_id)) {
            $selectedIds = $request->pdf_id;
        }
        $taxDocs = ClientDocumentUploaded::getDocumentForCombine($employer_id, $client_id, $docType, $selectedIds);
        if (empty($taxDocs)) {
            return redirect()->back()->with('error', 'PDF files are not available to combine.');
        }
        ClientDocumentUploaded::download_combined_tax_return($client_id, $taxDocs);
    }

}
