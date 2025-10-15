@php
    $profitType = 1;
    if (!empty($incomeProfitLoss)) {
        if (isset($incomeProfitLoss[0]['profit_loss_type'])) {
            $profitType = 2;
        }
    }
    $income_video = $incomeVideo ?? '';
    $deleteRoute = route('remove_client_additional_profit_loss_popup_joint');
@endphp

<div class="light-gray-div {{ $class }} {{ $hideShowClass }}">
    <div class="light-gray-box-form-area">
        <h2>
            <div class="circle-number-div">{{ $businessIndex }}</div>
            Company <span class="company-index mx-1">{{ !empty($additional) ? $additional : '1' }}:</span> <span
                class="company-name">{{ $companyName }}</span>
        </h2>

        <button type="button" class="delete-div" title="Delete"
            onclick="removeAdditionalBusinessSectionJoint('{{ $deleteRoute }}', '{{ $businessIndex }}'); return false;">
            <i class="bi bi-trash3 mr-1"></i>
            Delete
        </button>

        <div class="row gx-3">

            <div class="col-12">
                <div class="label-div question-area py-1 d-block">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <a href="javascript:void(0)" class="profit-loss-btn px-2 py-1"
                                onclick="openProfitForm('{{ route('client_profit_loss_popup_joint') }}', '{{ $profitType }}', '{{ $additional }}')">
                                <i class="bi bi-pencil-square mr-1"></i>
                                Select/Tap Here to Fill Out Profit/Loss
                            </a>
                        </div>
                        <div class="col-md-8 col-12">
                            <div class="video-div float_right">
                                @if (isset($income_video) && !empty($income_video))
                                    <button type="button" class="video-btn" data-bs-toggle="modal"
                                        data-bs-target="#video_modal" onclick="run_tutorial_videos(this,'#video_modal')"
                                        data-video="{{ $income_video['en'] }}"
                                        data-video2="{{ $income_video['sp'] }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29"
                                            viewBox="0 0 29 29">
                                            <g id="vds-btn" transform="translate(-299 -55)">
                                                <rect id="Rectangle_27" data-name="Rectangle 27" width="29"
                                                    height="29" rx="14.5" transform="translate(299 55)"
                                                    fill="#0b01aa"></rect>
                                                <path id="screen-play"
                                                    d="M13.42,0H3.532A3.536,3.536,0,0,0,0,3.532V9.182a3.536,3.536,0,0,0,3.532,3.532H13.42a3.536,3.536,0,0,0,3.532-3.532V3.532A3.536,3.536,0,0,0,13.42,0ZM15.54,9.182A2.122,2.122,0,0,1,13.42,11.3H3.532A2.122,2.122,0,0,1,1.413,9.182V3.532A2.122,2.122,0,0,1,3.532,1.413H13.42A2.122,2.122,0,0,1,15.54,3.532ZM7.063,15.54a1.413,1.413,0,1,1-1.413-1.413A1.412,1.412,0,0,1,7.063,15.54ZM10.828,4.951,8,3.382a1.618,1.618,0,0,0-2.39,1.406V7.925A1.619,1.619,0,0,0,8,9.331l2.824-1.569a1.62,1.62,0,0,0,0-2.812Zm-.687,1.577L7.318,8.1a.2.2,0,0,1-.291-.171V4.788a.186.186,0,0,1,.1-.169.2.2,0,0,1,.1-.029.2.2,0,0,1,.1.026l2.823,1.569a.2.2,0,0,1,0,.343Zm6.811,9.011a.706.706,0,0,1-.706.706H9.182a.706.706,0,1,1,0-1.413h7.063A.706.706,0,0,1,16.952,15.539Zm-14.127,0a.706.706,0,0,1-.706.706H.706a.706.706,0,1,1,0-1.413H2.119A.706.706,0,0,1,2.825,15.539Z"
                                                    transform="translate(305 61)" fill="#fff"></path>
                                            </g>
                                        </svg>
                                        <div>Step-by-Step Guide</div>
                                    </button>
                                @endif
                            </div>
                            @if (env('APP_ENV') == 'local' || env('APP_ENV') == 'development')
                                @if ($plIsImportedCodebtor == 1)
                                    <div class="video-div float_right">
                                        <button type="button" class="video-btn py-1"
                                            onclick="bankStatementImport('{{ $plIsImportedCodebtor }}', '{{ Auth::user()->id }}', 'debtor')">
                                            <i class="bi bi-download me-2"></i>
                                            <div>Import Profit/Loss</div>
                                        </button>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @php
                $plData = [];
                if ($profitType == 1) {
                    $plData = DateTimeHelper::createSixDuplicateObject($incomeProfitLoss, $attProfitLossMonths);
                } elseif ($profitType == 2) {
                    $plData = DateTimeHelper::getIncomeDescArray($incomeProfitLoss);
                }

                $monthsArray = DateTimeHelper::getFullMonthYearArrayForProfitLoss($attProfitLossMonths);
                $i = 1;
            @endphp
            @foreach ($monthsArray as $key => $monthYear)
                @php
                    $plValue = 0;
                    $bgRed = 'pl-bg-red';
                    $emptyText =
                        '<label><small class="text-danger text-bold font-italic">(P/L not filled out for this month)</small></label>';
                    foreach ($plData as $data) {
                        if (isset($data['profit_loss_month']) && $data['profit_loss_month'] == $key) {
                            $plValue = $data['total_profit_loss'];
                            $bgRed = '';
                            $emptyText = '';
                            break;
                        }
                    }
                @endphp
                <div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xxl-2 no_dup_col">
                    <div class="label-div">
                        <div class="form-group">
                            <label class="">Month {{ $i }}:&nbsp;{{ $monthYear }}</label>
                            <div class="input-group mb-0 ">
                                <span class="input-group-text">$</span>
                                <input type="number" disabled="disabled" readonly
                                    class="form-control price-field required no_dup_inp {{ $bgRed }}"
                                    name="operation_business_month[{{ $key }}]"
                                    value="{{ $plValue }}" />
                            </div>
                            {!! $emptyText !!}
                        </div>
                    </div>
                </div>
                @php
                    $i++;
                @endphp
            @endforeach
        </div>
    </div>
</div>
