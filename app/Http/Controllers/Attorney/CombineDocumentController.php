<?php

namespace App\Http\Controllers\Attorney;

use App\Http\Controllers\AttorneyController;
use Illuminate\Http\Request;
use App\Models\ClientDocumentUploaded;
use Storage;

class CombineDocumentController extends AttorneyController
{
    public function att_combine_and_download_tax_return(Request $request, $client_id, $documentType, $employer_id = 0)
    {
        $selectedIds = [];
        if (isset($request->pdf_id) && !empty($request->pdf_id)) {
            $selectedIds = $request->pdf_id;
        }
        $taxDocuments = ClientDocumentUploaded::getDocumentForCombine($employer_id, $client_id, $documentType, $selectedIds);
        if (empty($taxDocuments)) {
            return redirect()->back()->with('error', 'PDF files are not available to combine.');
        }

        $download_combined = ClientDocumentUploaded::download_combined_tax_return($client_id, $taxDocuments);
        if (!$download_combined) {
            return redirect()->back()->with('error', 'PDF files are not available to combine.');
        }
    }

    public function get_document_for_combine(Request $request, $client_id, $documentType, $employer_id = 0)
    {
        $selectedIds = [];
        if (isset($request->pdf_id) && !empty($request->pdf_id)) {
            $selectedIds = $request->pdf_id;
        }
        $taxDocuments = ClientDocumentUploaded::getDocumentForCombine($employer_id, $client_id, $documentType, $selectedIds);

        $document_ids = array_column($taxDocuments, 'id');
        $dococument_thumbnails = ClientDocumentUploaded::create_thumbnails($document_ids, $client_id);
        foreach ($taxDocuments as $key => $value) {
            $thumbnails = $dococument_thumbnails[$value['id']] ?? json_decode($value['thumbnails']);
            $temporary_thumnail_urls = [];
            if (!empty($thumbnails)) {
                foreach ($thumbnails as $thumbnail) {
                    $temporary_thumnail_urls[] = Storage::disk('s3')->temporaryUrl(
                        $thumbnail,
                        now()->addDays(2), // Expires in 10 minutes
                        ['ResponseContentDisposition' => 'inline']
                    );
                }
            }

            $taxDocuments[$key]['temporary_thumnail_url_arr'] = $temporary_thumnail_urls;
        }

        $pdf_download_url = route('combine_and_download_tax_return', [$client_id, $documentType, $employer_id]). '?' . http_build_query(['pdf_id' => $selectedIds]);
        $reorder_view = view("attorney.document-reorder", ["documents" => $taxDocuments])->render();
        $responce = ["status" => "1", "reorder_view" => $reorder_view, "pdf_download_url" => $pdf_download_url];

        return response()->json($responce);
    }

}
