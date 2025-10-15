@if ($document_type != "requested_documents" && (!is_array($document_file) && !empty($document_file)))
    @php
        $filePth = null;
        // Only generate temporary URL if S3 is properly configured
        if (config('filesystems.disks.s3.bucket')) {
            try {
                $filePth = \Storage::disk('s3')->temporaryUrl(
                    $document_file,
                    now()->addDays(2), // Expires in 2 days
                    ['ResponseContentDisposition' => 'inline']
                );
            } catch (\Exception $e) {
                \Log::error('S3 temporaryUrl failed in docDownload: ' . $e->getMessage());
                $filePth = null;
            }
        }
    @endphp
    @if($filePth)
        <a href="javascript:void(0)" data-url="{{$filePth}}" data-docid="{{$docId}}" data-clientid="{{$client_id}}" data-documenttype="{{$objKey}}" class="openPdf btn-new-ui-default p-sm-1 ms-2 me-1 blue-pdf-icon" title="Download {{ $document_name }}"> <i class="bi bi-file-earmark-pdf-fill pdf-icon-inside" aria-hidden="true"></i></a>
    @endif
@endif