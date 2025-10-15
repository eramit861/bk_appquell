<div class="col-xl-4 col-lg-6 col-md-12 mt-1 {{ $doc_list_name }} d-none">

    <div class="light-gray-box-tittle-div mb-3 pb-1">
        <h2>Debtor's Document List</h2>
    </div>
    @foreach($documentList as $key => $label)
        @if(!in_array($key, ['Drivers_License','Social_Security_Card']))
            @continue
        @endif
        
        @php
            $borderClass = 'not-selected-border';
            $cardBg = "selected";
            $checkedStatus = true;
            if (old($doc_list_name.'['.$key.']') === '1') {
                $checkedStatus = true;
            }
        @endphp

        <div class="custom-item mt-2">
            <div class="item-card btn-new-ui-default px-3 py-1 {{ $borderClass }} {{ $cardBg }}" data-label="">
                <div class="card-body p-0">
                    <label class="w-100 d-flex mb-0" for="debtor_doc_{{ $doc_list_name . $key }}" >
                        <span class="doc-card w-100 name_{{ $key }}">{{ $label }}</span>
                        <input type="checkbox" 
                            id="debtor_doc_{{ $doc_list_name . $key }}" 
                            class="float_right d-none mt-1 notify_doc" 
                            name="{{ $doc_list_name }}[{{ $key }}]" 
                            value="{{ $label }}" 
                            onclick="selectDocument()" 
                            @if($checkedStatus) checked @endif
                        >
                    </label>
                </div>
            </div>
        </div>
    @endforeach

    <div class="light-gray-box-tittle-div mb-3 pb-1 mt-3">
        <h2>Secured Loan Documents</h2>
    </div>
    @php
        $checkArray = [
            // "Current_Mortgage_Statement",
            // "Current_Mortgage_Statement_1_1", "Current_Mortgage_Statement_2_1", "Current_Mortgage_Statement_3_1", "Current_Mortgage_Statement_1_2", "Current_Mortgage_Statement_2_2", "Current_Mortgage_Statement_3_2", "Current_Mortgage_Statement_1_3", "Current_Mortgage_Statement_2_3", "Current_Mortgage_Statement_3_3", "Current_Mortgage_Statement_1_4", "Current_Mortgage_Statement_2_4", "Current_Mortgage_Statement_3_4", "Current_Mortgage_Statement_1_5", "Current_Mortgage_Statement_2_5", "Current_Mortgage_Statement_3_5",
            // "Current_Auto_Loan_Statement",
            // "Current_Auto_Loan_Statement_1", "Current_Auto_Loan_Statement_2", "Current_Auto_Loan_Statement_3", "Current_Auto_Loan_Statement_4", "Other_Loan_Statement_1", "Other_Loan_Statement_2",
            "Vehicle_Information",
        ];
    @endphp
    
    @foreach($documentList as $key => $label)
        @if(!in_array($key, $checkArray))
            @continue
        @endif

        @php
            $borderClass = 'not-selected-border';
            $cardBg = "selected";
            $checkedStatus = true;
            if (old($doc_list_name.'['.$key.']') === '1') {
                $checkedStatus = true;
            }
        @endphp
        <div class="custom-item mt-2">
            <div class="item-card btn-new-ui-default px-3 py-1 {{ $borderClass }} {{ $cardBg }}" data-label="">
                <div class="card-body p-0">
                    <label class="w-100 d-flex mb-0" for="loan_{{ $doc_list_name . $key }}" >
                        <span class="doc-card w-100 name_{{ $key }}">{{ $label }}</span>
                        <input type="checkbox" 
                            id="loan_{{ $doc_list_name . $key }}" 
                            class="float_right d-none mt-1 notify_doc" 
                            name="{{ $doc_list_name }}[{{ $key }}]" 
                            value="{{ $label }}" 
                            onclick="selectDocument()" 
                            @if($checkedStatus) checked @endif
                        >
                    </label>
                </div>
            </div>
        </div>
    @endforeach

</div>

<div class="col-xl-4 col-lg-6 col-md-12 mt-1 {{ $doc_list_name }} d-none">
    @php
        $check_keys = ['Co_Debtor_Drivers_License', 'Co_Debtor_Social_Security_Card'];
        $intersection = array_intersect_key(array_flip($check_keys), $documentList);
        $mt2 = '';
        $aad_mt3 = '';
        if (!empty($intersection)) {
            $mt2 = 'mt-2';
            $aad_mt3 = 'mt-3';
        }
    @endphp

    @if(!empty($intersection))
    
    <div class="light-gray-box-tittle-div mb-3 pb-1">
        <h2>Co-Debtor's Document List</h2>
    </div>
    @foreach($documentList as $key => $label)
        @if(!in_array($key, ['Co_Debtor_Drivers_License','Co_Debtor_Social_Security_Card']))
            @continue
        @endif

        @php
            $borderClass = 'not-selected-border';
            $cardBg = "selected";
            $checkedStatus = true;
            if (old($doc_list_name.'['.$key.']') === '1') {
                $checkedStatus = true;
            }
        @endphp
        
        <div class="custom-item mt-2">
            <div class="item-card btn-new-ui-default px-3 py-1 {{ $borderClass }} {{ $cardBg }}" data-label="">
                <div class="card-body p-0">
                    <label class="w-100 d-flex mb-0" for="co_debtor_doc_{{ $doc_list_name . $key }}" >
                        <span class="doc-card w-100 name_{{ $key }}">{{ $label }}</span>
                        <input type="checkbox" 
                            id="co_debtor_doc_{{ $doc_list_name . $key }}" 
                            class="float_right d-none mt-1 notify_doc" 
                            name="{{ $doc_list_name }}[{{ $key }}]" 
                            value="{{ $label }}" 
                            onclick="selectDocument()" 
                            @if($checkedStatus) checked @endif
                        >
                    </label>
                </div>
            </div>
        </div>				
    @endforeach
    @endif

    <div class="light-gray-box-tittle-div mb-3 pb-1 {{ $aad_mt3 }}">
        <h2>Additional Attorney Docs</h2>
    </div>
    @foreach($attorneydocuments as $key => $label)
        @php
            $borderClass = 'not-selected-border';
            $cardBg = "selected";
            $checkedStatus = true;
            if (old($doc_list_name.'['.$key.']') === '1') {
                $checkedStatus = true;
            }
        @endphp
	
        <div class="custom-item mt-2">
            <div class="item-card btn-new-ui-default px-3 py-1 {{ $borderClass }} {{ $cardBg }}" data-label="">
                <div class="card-body p-0">
                    <label class="w-100 d-flex mb-0" for="att_doc_{{ $doc_list_name . $key }}" >
                        <span class="doc-card w-100 name_{{ $key }}">{{ Helper::removeUnderscores($label) }}</span>
                        <input type="checkbox" 
                            id="att_doc_{{ $doc_list_name . $key }}" 
                            class="float_right d-none mt-1 notify_doc" 
                            name="{{ $doc_list_name }}[{{ $key }}]" 
                            value="{{ $label }}" 
                            onclick="selectDocument()" 
                            @if($checkedStatus) checked @endif
                        >
                    </label>
                </div>
            </div>
        </div>					
    @endforeach

    
</div>

<div class="col-xl-4 col-lg-6 col-md-12 mt-1 {{ $doc_list_name }} d-none">

    <div class="light-gray-box-tittle-div mb-3 pb-1">
        <h2>Tax Returns</h2>
    </div>
    @foreach($documentList as $key => $label)
        @if(!in_array($key, ['Last_Year_Tax_Returns','Prior_Year_Tax_Returns','Prior_Year_Two_Tax_Returns','Prior_Year_Three_Tax_Returns','W2_Last_Year','W2_Year_Before']))
            @continue
        @endif
        
        @php
            $checkedStatus = true;
            $borderClass = 'not-selected-border';
            $cardBg = "selected";
            if (old($doc_list_name.'['.$key.']') === '1') {
                $checkedStatus = true;
                $borderClass = '';
                $cardBg = "selected";
            }
            if (in_array($key, $excludedocs)) {
                $checkedStatus = false;
                $borderClass = 'not-selected-border';
                $cardBg = "no-selected";
            }
        @endphp

        <div class="custom-item mt-2">
            <div class="item-card btn-new-ui-default px-3 py-1 {{ $borderClass }} {{ $cardBg }}" data-label="">
                <div class="card-body p-0">
                    <label class="w-100 d-flex mb-0" for="tax_doc_{{ $doc_list_name . $key }}" >
                        <span class="doc-card w-100 name_{{ $key }}">{{ $label }}</span>
                        <input type="checkbox" 
                            id="tax_doc_{{ $doc_list_name . $key }}" 
                            class="float_right d-none mt-1 notify_doc" 
                            name="{{ $doc_list_name }}[{{ $key }}]" 
                            value="{{ $label }}" 
                            onclick="selectDocument()" 
                            @if($checkedStatus) checked @endif
                        >
                    </label>
                </div>
            </div>
        </div>							
    @endforeach

    <div class="light-gray-box-tittle-div mb-3 pb-1 mt-3">
        <h2>Misc. Doc(s)/Requested Documents</h2>
    </div>
    @foreach($documentList as $key => $label)
        @if(!in_array($key, ['Miscellaneous_Documents', 'Other_Misc_Documents', "Vehicle_Registration", "Insurance_Documents"]))
            @continue
        @endif
        
        @php
            $checkedStatus = true;
            $borderClass = 'not-selected-border';
            $cardBg = "selected";
            if (old($doc_list_name.'['.$key.']') === '1') {
                $checkedStatus = true;
                $borderClass = '';
                $cardBg = "selected";
            }
            if (in_array($key, $excludedocs)) {
                $checkedStatus = false;
                $borderClass = 'not-selected-border';
                $cardBg = "no-selected";
            }
        @endphp

        <div class="custom-item mt-2">
            <div class="item-card btn-new-ui-default px-3 py-1 {{ $borderClass }} {{ $cardBg }}" data-label="">
                <div class="card-body p-0">
                    <label class="w-100 d-flex mb-0" for="misc_doc_{{ $doc_list_name . $key }}" >
                        <span class="doc-card w-100 name_{{ $key }}">{{ $label }}</span>
                        <input type="checkbox" 
                            id="misc_doc_{{ $doc_list_name . $key }}" 
                            class="float_right d-none mt-1 notify_doc" 
                            name="{{ $doc_list_name }}[{{ $key }}]" 
                            value="{{ $label }}" 
                            onclick="selectDocument()" 
                            @if($checkedStatus) checked @endif
                        >
                    </label>
                </div>
            </div>
        </div>						
    @endforeach

</div>
