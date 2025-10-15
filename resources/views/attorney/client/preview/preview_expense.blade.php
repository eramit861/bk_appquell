<div class="light-gray-div questionnaire">        
    <h2 >Current Expenses</h2>
    @include("attorney.form_elements.common.questionnaire_review_section_common",[ 'forKey' => 'expense', 'forLabel' => 'Expenses' ])
    <div class="row gx-3" id="current-expenses">									
        <div class="col-12">
            <div class="current-expenses-sec mt-3 mb-4">
                @include("attorney.form_elements.expenses",$expenses_info)
            </div>
            @if (!empty($spouse_expenses_info) && Helper::validate_key_value('live_separately', $expenses_info))
                <div class="current-expenses-sec">
                    @include("attorney.form_elements.spouse_expenses",$spouse_expenses_info)
                </div>
            @endif
            <div class="row print_asset_footer d-none">
                <div class="col-md-12 mb-3">
                    <p class="">I/we declare under penalty of perjury the foregoing is true and correct to the best of my/our ability. The above is all of my assets, debts, income & expenses, that I/we have declared and given to the {{ $attorney_company->company_name ?? "" }}.</p>
                </div>
                @php
                    $BasicInfoPartA = $basic_info['BasicInfoPartA'];
                    $BasicInfoPartB = $basic_info['BasicInfoPartB'];
                    $debtorname = Helper::validate_key_value('name', $BasicInfoPartA);
                    $debtorname .= " " . Helper::validate_key_value('middle_name', $BasicInfoPartA);
                    $debtorname .= " " . Helper::validate_key_value('last_name', $BasicInfoPartA);
                    $spousename = Helper::validate_key_value('name', $BasicInfoPartB);
                    $spousename .= " " . Helper::validate_key_value('middle_name', $BasicInfoPartB);
                    $spousename .= " " . Helper::validate_key_value('last_name', $BasicInfoPartB);
                @endphp
                @if (!empty($debtorname))
                    <div class="col-md-6 ">
                        <span>X</span>
                        <div class="w-80 ml-3">
                            <p style="border-top: 1px solid #000000 !important;">{{ $debtorname }}</p>
                        </div>
                    </div>
                @endif
                @if (!empty($spousename))
                    <div class="col-md-6 ">
                        <span>X</span>
                        <div class="w-80 ml-3">
                            <p style="border-top: 1px solid #000000 !important;">{{ $spousename }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>




