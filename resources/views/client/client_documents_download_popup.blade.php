<div class="row">
    <div class="col-12">
        <h4 class="section-main-title my-3 text-c-blue f-w-800 "><span class="border-bottom-light-blue">Uploaded Document(s)</span></h4>
    </div>
    <div class="col-12">
        <div class="row">
            @if(!empty($alreadyUploadedDocs))
                @foreach($alreadyUploadedDocs as $key => $file)
                    @if(\Storage::disk('s3')->exists($file['document_file']))
                        @php
                            $filePath = \Storage::disk('s3')->temporaryUrl(
                                $file['document_file'],
                                now()->addDays(2),
                                ['ResponseContentDisposition' => 'inline']
                            );
                        @endphp
                        <div class="col-6">
                            <div class="uploaded-file my-2 d-flex align-items-center">
                                <div class="w-100">
                                    <a title="click here to download" class="download-btn" target="_blank" href="{{ $filePath }}" download>
                                        <div class="d-flex align-items-center">
                                            <div class=""><img src="{{ url('assets/img/pdf-icon.svg') }}" width="20" alt="pdf icon"></div>
                                            <div class=""><span class="ml-3">{{ $file['updated_name'] }}</span></div>
                                        </div>
                                    </a>
                                </div>
                                <div class="">
                                    <i class="fas fa-trash" onclick="removeDocumentById({{ $file['id'] }}, {{ $client_id }}, '{{ $doc_type }}')"></i>
                                </div>
                            </div>                
                        </div>
                    @endif
                @endforeach
            @endif

            <div class="col-6">
                <a title="click here to download" class="uploaded-file my-2" href="{{ route('client_doc_see', ['type' => $doc_type, 'client_id' => $client_id]) }}">
                    <div class="d-flex align-items-center">
                        <div class=""><img src="{{ url('assets/img/zip-file-format.png') }}" width="20" title="" alt="zip icon"></div>
                        <div class=""><span class="ml-3 text-c-blue">Select to Download as Zip File</span></div>
                    </div>
                </a>
            </div>  
        </div>
    </div>
</div>