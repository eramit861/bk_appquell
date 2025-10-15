<form name="client_debts_step2_unsecured" id="client_debts_step2_unsecured" action="{{ route('debt_custom_save') }}"
    method="post" novalidate>
    @csrf
    <input class="form-check-input" type="hidden" value="1" name="checkinputdebt">
    <div class="row gx-3">
        <div class="col-12">
            @if (
                (int) (!empty($attorneySettings['is_debt_header_custom_enabled'])
                    ? $attorneySettings['is_debt_header_custom_enabled']
                    : 0) == 1)
                <h6 class="blink text-c-red text-center mb-1">
                    <strong>
                        {{ !empty($attorneySettings['debt_header_custom_text']) ? $attorneySettings['debt_header_custom_text'] : '' }}
                    </strong>
                </h6>
            @else
                <h6 class="blink text-c-red mb-1"><strong>How/Where to get credit reports Free</strong> <i
                        class="fa fa-arrow-down"></i></h6>
                <p onclick="openFreeReportGuide()" class="text-left font-weight-bold text-c-blue">
                    Get a Free Copy of your Credit Report here:
                    <span class="text-c-blue">https://www.annualcreditreport.com/index.action</span>
                </p>
            @endif

        </div>

        @if (env('ENABLED_CLIENT_SIDE_CREDIT_REPORT', false) == true &&
                ($creditReportEnabled['debtor'] || $creditReportEnabled['codebtor']))
            @include('client.common_client_upload_view', [
                'docsUploadInfo' => $docsUploadInfo,
                'client_id' => $client_id,
                'isManualPage' => false,
                'isUnsecuredPage' => true,
                'user' => $authUser,
                'creditReportVideos' => $creditReportVideos,
            ])

            <div class="col-12 col-xl-4 col-xxl-3 d-flex align-items-center">
                <div class="video-div ml-auto">
                    <button type="button" class="video-btn blink" onclick="opengetReportPopup()">
                        <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29">
                            <g id="vds-btn" transform="translate(-299 -55)">
                                <rect id="Rectangle_27" data-name="Rectangle 27" width="29" height="29"
                                    rx="14.5" transform="translate(299 55)" fill="#28a745"></rect>
                                <path id="screen-play"
                                    d="M13.42,0H3.532A3.536,3.536,0,0,0,0,3.532V9.182a3.536,3.536,0,0,0,3.532,3.532H13.42a3.536,3.536,0,0,0,3.532-3.532V3.532A3.536,3.536,0,0,0,13.42,0ZM15.54,9.182A2.122,2.122,0,0,1,13.42,11.3H3.532A2.122,2.122,0,0,1,1.413,9.182V3.532A2.122,2.122,0,0,1,3.532,1.413H13.42A2.122,2.122,0,0,1,15.54,3.532ZM7.063,15.54a1.413,1.413,0,1,1-1.413-1.413A1.412,1.412,0,0,1,7.063,15.54ZM10.828,4.951,8,3.382a1.618,1.618,0,0,0-2.39,1.406V7.925A1.619,1.619,0,0,0,8,9.331l2.824-1.569a1.62,1.62,0,0,0,0-2.812Zm-.687,1.577L7.318,8.1a.2.2,0,0,1-.291-.171V4.788a.186.186,0,0,1,.1-.169.2.2,0,0,1,.1-.029.2.2,0,0,1,.1.026l2.823,1.569a.2.2,0,0,1,0,.343Zm6.811,9.011a.706.706,0,0,1-.706.706H9.182a.706.706,0,1,1,0-1.413h7.063A.706.706,0,0,1,16.952,15.539Zm-14.127,0a.706.706,0,0,1-.706.706H.706a.706.706,0,1,1,0-1.413H2.119A.706.706,0,0,1,2.825,15.539Z"
                                    transform="translate(305 61)" fill="#fff"></path>
                            </g>
                        </svg>
                        <span class="fs-11px text-c-red">See Videos How To Get Your Free Credit Reports</span>
                    </button>
                </div>
            </div>
        @endif


        <div class="col-12 light-gray-div b-0-i py-0 mb-2">
            <div class="label-div question-area">
                <label for="bankruptcy_filed">
                    Do you have unsecured debts?
                    <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                        data-bs-original-title="Such as: Credit cards, Collection accounts, Personal loans, Medical bills, Student loans, Lines of credit, Business loans, Past due utility bills, and other instances in which credit was given without any collateral requirement.">
                        <i class="bi bi-question-circle"></i>
                    </div>
                </label>
                <!-- Radio Buttons -->
                <div class="custom-radio-group form-group">
                    <input type="radio" id="additional-tax_yes" class="d-none"
                        name="does_not_have_additional_creditor" required
                        {{ Helper::validate_key_toggle('does_not_have_additional_creditor', $debts, 1) }}
                        value="1">
                    <label for="additional-tax_yes"
                        class="btn-toggle {{ Helper::validate_key_toggle_active('does_not_have_additional_creditor', $debts, 1) }}"
                        onclick="checkAC('yes');">Yes</label>

                    <input type="radio" id="additional-tax_no" class="d-none" name="does_not_have_additional_creditor"
                        required
                        {{ Helper::validate_key_toggle('does_not_have_additional_creditor', $debts, 0) }}
                        value="0">
                    <label for="additional-tax_no"
                        class="btn-toggle {{ Helper::validate_key_toggle_active('does_not_have_additional_creditor', $debts, 0) }}"
                        onclick="checkAC('no');">No</label>
                </div>
                <p class="text-bold text-center  mb-0 second_step_debt {{ isset($debts['does_not_have_additional_creditor']) && $debts['does_not_have_additional_creditor'] == 1 ? '' : 'hide-data' }}"
                    id="second_step_debt_note_div">
                    <span class="text-danger">Most credit reports only show about 70% of a consumer's debts as of 2024.
                        Its best you list ALL your debts here , even if your attorney is going to run your credit. This
                        way you include ALL your debts in your case.</span>
                    </br>
                    <span class="text-c-blue">Please ensure all of the debts you want discharge in your case are listed
                        here</span>
                </p>
            </div>
        </div>
        <div class="col-12 second_step_debt {{ Helper::key_hide_show_v('does_not_have_additional_creditor', $debts) }}"
            id="second_step_debt_div">

            <div class="row" id="unsecured_html">
                <div class="col-12">
                    <div class="outline-gray-border-area">
                        @php
                            $i = 0;
                            $debt = [];
                            if (!empty($debts['debt_tax'])) {
                                usort($debts['debt_tax'], function ($a, $b) {
                                    $aName = isset($a['creditor_name']) ? $a['creditor_name'] : '';
                                    $bName = isset($b['creditor_name']) ? $b['creditor_name'] : '';

                                    return strnatcasecmp($aName, $bName);
                                });
                            }

                            $cardTypes = ArrayHelper::getDebtCardSelectionsForAttorney();
                            $cards_collections = ArrayHelper::getDebtCardSelections();
                            $customSaveUrl = route('debt_custom_save');
                        @endphp

                        @if (!empty($debts['debt_tax']) && count($debts['debt_tax']) > 0)
                            @foreach ($debts['debt_tax'] as $debt)
                                @include('client.questionnaire.debt.creditors')
                                @php $i++; @endphp
                            @endforeach
                        @else
                            @include('client.questionnaire.debt.creditors')
                        @endif
                        <input type="hidden" id="debt_url" value="{{ $customSaveUrl }}">
                        <div class="add-more-div-bottom">
                            <button type="button" class="btn-new-ui-default py-1 px-2" id="add-more-residence-form"
                                onclick="addanotherDebts('{{ $customSaveUrl }}');return false;">
                                <i class="bi bi-plus-lg"></i>
                                Add Additional Debt(s)
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</form>
<div id="report_guide_img" class="image-outer hide-data">
    <div class="sign_up_bgs">
        <div class="container-fluid">
            <div class="row py-0 page-flex">
                <div class="col-md-12 pr-0 pl-0">
                    <div class="form_colm red-flag row p-4">
                        <div class="col-md-12 main-div">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="align-left" style="font-size:1px !important;">
                                        <a href="https://www.annualcreditreport.com" target="_blank"><img
                                                class="webkit_fill"
                                                src="{{ url('/assets/img/credit-report.png') }}" /></a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('client.uploaddoc_mode', [
    'client_id' => $client_id,
    'bank_statement_months' => $bank_statement_months,
    'isManual' => false,
    'max_size' => 20000,
    'isUnsecuredPage' => true,
])
