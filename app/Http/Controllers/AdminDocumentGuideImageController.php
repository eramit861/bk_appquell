<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;
use Illuminate\Support\Facades\Storage;
use App\Models\AdminDocumentGuide;
use Illuminate\Support\Facades\Cache;

class AdminDocumentGuideImageController extends Controller
{
    // Document types with labels

    /**
     * Display the upload form
     */
    public function index()
    {
        $fileUploadTypes = Helper::getAllDocumentTypes();


        // Get all existing documents in one query
        $existingDocuments = AdminDocumentGuide::whereIn('document_type', array_keys($fileUploadTypes))
            ->get()
            ->keyBy('document_type');

        return view('admin.document-guide.file-upload', [
            'fileTypes' => $fileUploadTypes,
            'existingDocuments' => $existingDocuments
        ]);
    }

    /**
     * Handle single file upload to S3
     */
    public function uploadToS3(Request $request)
    {
        Cache::forget('help_document_urls_all');
        $request->validate([
            'document' => 'required|file|mimes:pdf,jpg,jpeg,png'
        ]);

        $type = $request->document_type;
        $file = $request->file('document');

        try {
            // Delete old file if exists
            $oldDocument = AdminDocumentGuide::where('document_type', $type)->first();
            if ($oldDocument) {
                if (Storage::disk('s3')->exists($oldDocument->s3_path)) {
                    Storage::disk('s3')->delete($oldDocument->s3_path);
                }
            }

            // Store new file
            $path = Storage::disk('s3')->putFileAs(
                'documents_guide',
                $file,
                "{$type}.{$file->extension()}"
            );

            // Create or update database record
            $document = AdminDocumentGuide::updateOrCreate(
                ['document_type' => $type],
                [
                    'original_name' => $file->getClientOriginalName(),
                    's3_path' => $path,
                    'file_extension' => $file->extension(),
                    'file_size' => $file->getSize(),
                    'mime_type' => $file->getMimeType()
                ]
            );

            // Generate temporary URL for the response
            $url = Storage::disk('s3')->temporaryUrl(
                $path,
                now()->addHour(),
                ['ResponseContentDisposition' => 'attachment;filename=' . rawurlencode($document->original_name)]
            );

            return response()->json([
                'success' => true,
                'url' => $url,
                'type' => $type
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteImg(Request $request)
    {
        if ($request->isMethod('post')) {
            Cache::forget('help_document_urls_all');
            $id = $request->input('id');
            $type = $request->input('type');

            $document = AdminDocumentGuide::where('id', $id)->where('document_type', $type)->first();

            if (!$document) {
                return response()->json([
                    'success' => false,
                    'message' => 'Document not found.'
                ], 404);
            }

            try {
                if (Storage::disk('s3')->exists($document->s3_path)) {
                    Storage::disk('s3')->delete($document->s3_path);
                }

                $document->delete();

                return response()->json(['success' => true]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Deletion failed: ' . $e->getMessage()
                ], 500);
            }
        }
    }

}
