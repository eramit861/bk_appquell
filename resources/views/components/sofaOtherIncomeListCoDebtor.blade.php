<div class="col-12">
    <div class="colum-heading-main mb-2">
        <span class="section-title font-weight-bold font-lg-12">
            Spouse (if applicable):
        </span>
    </div>
</div>

<div class="col-5">
    <label class="font-weight-bold ">Period</label>
</div>
<div class="col-5">
    <label class="font-weight-bold ">Source of income</label>
</div>
<div class="col-2">
    <label class="font-weight-bold ">Gross&nbsp;income</label>
</div>

@php
    $currentYearArray = Helper::validate_key_value('other_income_received_spouse_this_year', $mainData);
@endphp

@if (!empty($currentYearArray) && is_array($currentYearArray))
    <div class="col-12">
        <label class="text-u-blue text-bold ">Current year to date:</label>
    </div>
    @foreach ($currentYearArray as $index => $key)
        <div class="col-5 mb-1">
            <span class=" fs-13px">{{ date('Y') }}</span>
        </div>
        <div class="col-5 mb-1">
            <span class=" fs-13px">
                {{ Helper::getSourceOfIncomeArray(Helper::validate_key_loop_value('other_income_received_spouse_this_year', $mainData, $index)) }}
                @if (Helper::validate_key_loop_value('other_income_received_spouse_this_year', $mainData, $index) == -1)
                    :
                    {{ Helper::validate_key_loop_value('other_income_received_spouse_this_year_text', $mainData, $index) }}
                @endif
            </span>
        </div>
        <div class="col-2 mb-1">
            <span class="text-success fs-13px">
                ${{ number_format((float) Helper::validate_key_loop_value('other_amount_spouse_this_year_income', $mainData, $index), 2, '.', ',') }}
            </span>
        </div>
    @endforeach
@endif

@php
    $lastYearArray = Helper::validate_key_value('other_income_received_spouse_last_year', $mainData);
@endphp
@if (!empty($lastYearArray) && is_array($lastYearArray))
    <div class="col-12">
        <label class="text-u-blue text-bold ">Last Years Total Income:</label>
    </div>
    @foreach ($lastYearArray as $index => $key)
        <div class="col-5 mb-1">
            <span class=" fs-13px">{{ date('Y', strtotime('-1 year')) }}</span>
        </div>
        <div class="col-5 mb-1">
            <span class=" fs-13px">
                {{ Helper::getSourceOfIncomeArray(Helper::validate_key_loop_value('other_income_received_spouse_last_year', $mainData, $index)) }}
                @if (Helper::validate_key_loop_value('other_income_received_spouse_last_year', $mainData, $index) == -1)
                    :
                    {{ Helper::validate_key_loop_value('other_income_received_spouse_last_year_text', $mainData, $index) }}
                @endif
            </span>
        </div>
        <div class="col-2 mb-1">
            <span class="text-success fs-13px">
                ${{ number_format((float) Helper::validate_key_loop_value('other_amount_spouse_last_year_income', $mainData, $index), 2, '.', ',') }}
            </span>
        </div>
    @endforeach
@endif

@php
    $lastBeforeYearArray = Helper::validate_key_value('other_income_received_spouse_lastbefore_year', $mainData);
@endphp
@if (!empty($lastBeforeYearArray) && is_array($lastBeforeYearArray))
    <div class="col-12">
        <label class="text-u-blue text-bold ">Previous Year Total Income:</label>
    </div>
    @foreach ($lastBeforeYearArray as $index => $key)
        <div class="col-5 mb-1">
            <span class=" fs-13px">{{ date('Y', strtotime('-2 year')) }}</span>
        </div>
        <div class="col-5 mb-1">
            <span class=" fs-13px">
                {{ Helper::getSourceOfIncomeArray(Helper::validate_key_loop_value('other_income_received_spouse_lastbefore_year', $mainData, $index)) }}
                @if (Helper::validate_key_loop_value('other_income_received_spouse_lastbefore_year', $mainData, $index) == -1)
                    :
                    {{ Helper::validate_key_loop_value('other_income_received_spouse_lastbefore_year_text', $mainData, $index) }}
                @endif
            </span>
        </div>
        <div class="col-2 mb-1">
            <span class="text-success fs-13px">
                ${{ number_format((float) Helper::validate_key_loop_value('other_amount_spouse_lastbefore_year_income', $mainData, $index), 2, '.', ',') }}
            </span>
        </div>
    @endforeach
@endif
