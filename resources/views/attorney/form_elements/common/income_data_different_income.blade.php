<div class="col-md-12">
    <label class="extrem_cs_btn">
        <a class="btn-form btn_res font-weight-bold" href="javascript:void(0)" ><u>{{ __('Mean Test Info') }}</u></a>
    </label>
    <div class="row">
        @php
            $i = 1;
            $totalIncome = 0;
            $currentDate = date('Y-m-d'); // Cache current date for performance
        @endphp
        
        @foreach($month_data as $amount)
            @php
                $totalIncome = (float)$totalIncome + (float)$amount;
                $month = date('Y-m', strtotime("-$i months", strtotime($currentDate)));
                $year = date('Y', strtotime("-$i months", strtotime($currentDate)));
                $month_name = date("F", strtotime("-$i months", strtotime($currentDate)));
            @endphp
            <div class="col-md-6">
                <div class="form-group">
                    <label class="d-block"> Month {{ $i }}:&nbsp;{{ $month_name . ', ' . $year }}<strong>:&nbsp;${{ $amount }} </strong>
                    </label>
                </div>
            </div>
            @php $i++; @endphp
        @endforeach
    </div>
    {{-- Average Income Summary Section --}}
    <div class="row {{ isset($mbCustom) && !empty($mbCustom) ? $mbCustom : 'mb-3' }}">
        <div class="col-md-12"><hr></div>
        <div class="col-md-4 pr-0"></div>
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <label class="font-weight-normal mb-0">
                {{ isset($avgLabel) && !empty($avgLabel) ? $avgLabel : 'Avg. Income: ' }}
                <span class="text-c-blue">${{ Helper::priceFormtWithComma(($totalIncome / ($i - 1))) }}</span>
            </label>
        </div>
        <div class="col-md-12"><hr></div>
    </div>
</div>