<div id="signed_doc_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content modal-content-div conditional-ques">

            <div class="modal-header align-items-center py-2">
                <div class="row w-100 m-0">
                    <div class="col-12">
                        <h5 class="modal-title d-flex">
                            Click or Tap to Review Document(s)
                        </h5>
                    </div>
                </div>
            </div>

            <div class="modal-body">
                <div class="card-body light-gray-div ">
                    <h2>Document(s)</h2>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row client_doc_ul ui-sortable" id="">
                                @if(!empty($listOfFiles))
                                    @foreach($listOfFiles as $file)
                                        <div id="" class="col-md-6 client_doc_li ui-sortable-handle list-unstyled signed-doc-anchor">
                                            <div class="li-main-card mb-3">
                                                <a title="click here to download" target="_blank" href="{{ $file['path'] }}" download onclick="updateDocViewStatus({{ $client_id }}, '{{ $file['file'] }}')">
                                                    <div class="d-flex align-items-center">
                                                        <div class=""><img src="{{url('assets/img/pdf-icon.svg')}}" width="60" title="" alt="pdf icon"></div>
                                                        <div class=""><span class="ml-3">{{ $file['name'] }}</span></div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 px-0">
                            <hr>
                        </div>
                        <div class="col-md-6 mx-auto signed-doc-div-parent">
                            <div class="signed-doc-div text-gray mt-3">
                                <a title="Not Submitted Yet" href="javascript:void(0);" id="" class="nav-linkf text-left align-items-center d-flex" data-type="" onclick="reviewDocClicked('{{ route('client_signed_doc') }}')">
                                    <div class="d-status">
                                        <img src="{{ asset('assets/img/blue_icons/misc_docs.svg')}}" class="doc-icon" width="35px" alt="icon">
                                    </div>
                                    <div class="text-gray b-none doc-card d-block ml-3">Return Doc(s) to Attorney</div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="signed-upload-sec hide-data px-0">
                    <div class="upload-border mx-auto">
                        @include('client.upload_doc_form_signed_docs', ['route' => route('client_signed_doc'), 'max_size' => 500])
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>