<div class="light-gray-div mt-3">
    <h2>Select to show/hide documents</h2>
    <div class="row gx-3 dis_client">
        @foreach ($documentlisttoexlude as $doctype)
        <div class="col d-flex justify-content-center mx-auto">
            <label class="custom-card package package-101 mt-2">
                <input id="{{$doctype}}" type="checkbox" class="packages exclude_doc_type checkbox_input" value=""
                    @if($doctype=='Pre_Filing_Bankruptcy_Certificate_CCC' )
                    onclick="showCreditCounselingForm(this)"
                    @else
                    onclick="excludeDocs(this, '{{$doctype}}')"
                    @endif
                    @if ($doctype !='Pre_Filing_Bankruptcy_Certificate_CCC' && (empty($exclude_docs) || !in_array($doctype, $exclude_docs)) || ($certificateenable && $doctype=='Pre_Filing_Bankruptcy_Certificate_CCC' ))
                    checked
                    @endif>
                <span class="radio-btn">
                    <i class="fas fa-check-circle"></i>
                    <div class="package-desc">
                        @php
                        $misd = \App\Models\ClientDocumentUploaded::getMiscDocsForAttorneyDocumentScreen(Auth::user()->id);
                        $misd = $misd + ['Pre_Filing_Bankruptcy_Certificate_CCC' => 'Pre-Filing Bankruptcy Certificate(s)'];
                        @endphp
                        <p class="text-bold">
                            @if ($doctype == "Insurance_Documents")
                                Proof of Auto Insurance
                            @else 
                                {{ str_replace('_', ' ', $misd[$doctype] ?? $doctype) }}
                            @endif
                        </p>
                    </div>
                </span>
            </label>
        </div>
        @endforeach
    </div>
</div>

@include('attorney.document_management', ['delete_route' => route("attorney_client_delete_documents")])