<div class="sign_up_bgs">
    <div class="container-fluid">
        <div class="row py-0 page-flex">
            <div class="col-md-12 pr-0 pl-0">
                <div class="form_colm red-flag row p-4">
                    <div class="col-md-12 main-div">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="align-left" style="font-size:1px !important;">
                                    @if(!empty($docGuide['image']))
                                        @php
                                            $fileUrl = $docGuide['image'];
                                            $fileExtension = strtolower($docGuide['ext']); // normalize for safety
                                        @endphp

                                        @if($fileExtension !== 'pdf')
                                            {{-- Image or other previewable content --}}
                                            <div class="hint-guide {{ $docGuide['type'] }}">
                                                <img class="webkit_fill" alt="icon" src="{{ $fileUrl }}" />
                                            </div>
                                        @elseif($fileExtension === 'pdf')
                                            {{-- PDF preview --}}
                                            <div style="width: 100%; height: 600px; background: white; margin: 0; padding: 0; position: relative;" class="hint-guide {{ $docGuide['type'] }}">
                                                <div class="iframe-loader" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: #fff; z-index: 10;">
                                                    <span>Loading...</span>
                                                </div>
                                                <iframe src="{{ $fileUrl }}" type="application/pdf" frameborder="0" style="width: 100%; height: 100%; border: none; background: white; display: none;" onload="this.style.display='block'; this.previousElementSibling.style.display='none';"></iframe>
                                            </div>
                                        @else
                                            {{-- Unknown file format --}}
                                            <p>Unsupported file format</p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                