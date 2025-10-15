<div class="col-md-12 mb-2">
    <div class="colum-heading-main">
        <span class="section-title font-weight-bold font-lg-12">
            @if (empty($spouse))
                Debtor:
            @else
                Spouse (if applicable):
            @endif
        </span>
    </div>
</div>
<div class="col-md-5">
    <label class="font-weight-bold ">{{ __('Period') }}</label>
</div>
<div class="col-md-5">
    <label class="font-weight-bold ">{{ __('Source of income') }}</label>
</div>
<div class="col-md-2">
    <label class="font-weight-bold ">Gross&nbsp;income</label>
</div>

@php
    $hasExtraThisYear =
        isset($financialaffairsInfo['total_amount_' . $spouse . 'this_year_income_extra']) &&
        $financialaffairsInfo['total_amount_' . $spouse . 'this_year_income_extra'] != null;
    $typeA = $hasExtraThisYear ? $financialaffairsInfo['total_amount_' . $spouse . 'this_year'] : null;
    $typeB = $hasExtraThisYear ? $financialaffairsInfo['total_amount_' . $spouse . 'this_year_extra'] : null;
@endphp

@if ($hasExtraThisYear)
    @if ($typeA == $typeB)
        <div class="col-md-5">
            <label class="font-weight-bold fs-13px "> <span class="font-weight-normal">Current year to date:
                    {{ date('Y') }}</span></label>
        </div>
        <div class="col-md-5">
            <label class="font-weight-bold fs-13px ">
                <span class="font-weight-normal">
                    {{ !empty($financialaffairsInfo['total_amount_' . $spouse . 'this_year']) && $financialaffairsInfo['total_amount_' . $spouse . 'this_year'] == 1 ? 'Wages, commissions, bonuses, tips' : 'Operating a business' }}
                </span>
            </label>
        </div>
        <div class="col-md-2">
            <label class="font-weight-bold fs-13px">
                @php
                    $sameAAmountFirst = Helper::validate_key_value( 'total_amount_' . $spouse . 'this_year_income', $financialaffairsInfo );
                    $sameAAmountFirst = (float) str_replace(',', '', $sameAAmountFirst);
                    $sameAAmountSecond = Helper::validate_key_value( 'total_amount_' . $spouse . 'this_year_income_extra', $financialaffairsInfo );
                    $sameAAmountSecond = (float) str_replace(',', '', $sameAAmountSecond);
                    $sameATotal = $sameAAmountFirst + $sameAAmountSecond;
                    $sameATotalFormatted = number_format(abs($sameATotal), 2, '.', ',');
                    $sameATotalClass = $sameATotal < 0 ? 'text-danger' : '';
                    $sameAStart = $sameATotal < 0 ? '(' : '';
                    $sameAEnd = $sameATotal < 0 ? ')' : '';
                @endphp
                <span class="font-weight-normal section-title {{ $sameATotalClass }}">
                    ${{ $sameAStart . $sameATotalFormatted . $sameAEnd }}
                </span>
            </label>
        </div>
    @endif
    @if ($typeA != $typeB)
        <div class="col-md-5">
            <label class="font-weight-bold fs-13px "> <span class="font-weight-normal">Current year to date:
                    {{ date('Y') }}</span></label>
        </div>
        <div class="col-md-5">
            <label class="font-weight-bold fs-13px ">
                <span class="font-weight-normal">
                    {{ !empty($financialaffairsInfo['total_amount_' . $spouse . 'this_year']) && $financialaffairsInfo['total_amount_' . $spouse . 'this_year'] == 1 ? 'Wages, commissions, bonuses, tips' : 'Operating a business' }}
                </span>
            </label>
        </div>
        <div class="col-md-2">
            <label class="font-weight-bold fs-13px ">
                @php
                    $differentAAmount = (float) Helper::validate_key_value( 'total_amount_' . $spouse . 'this_year_income', $financialaffairsInfo );
                    $differentA = number_format(abs($differentAAmount), 2, '.', ',');
                    $differentAClass = $differentAAmount < 0 ? 'text-danger' : '';
                    $differentAStart = $differentAAmount < 0 ? '(' : '';
                    $differentAEnd = $differentAAmount < 0 ? ')' : '';
                @endphp
                <span class="font-weight-normal section-title {{ $differentAClass }}">
                    ${{ $differentAStart . $differentA . $differentAEnd }}
                </span>
            </label>
        </div>
        <!-- additional -->
        <div class="col-md-5">
            <label class="font-weight-bold fs-13px "> <span class="font-weight-normal">Current year to date:
                    {{ date('Y') }}</span></label>
        </div>
        <div class="col-md-5">
            <label class="font-weight-bold fs-13px ">
                <span class="font-weight-normal">
                    {{ !empty($financialaffairsInfo['total_amount_' . $spouse . 'this_year_extra']) && $financialaffairsInfo['total_amount_' . $spouse . 'this_year_extra'] == 1 ? 'Wages, commissions, bonuses, tips' : 'Operating a business' }}
                </span>
            </label>
        </div>
        <div class="col-md-2">
            <label class="font-weight-bold fs-13px ">
                @php
                    $differentExtraAAmount = (float) Helper::validate_key_value( 'total_amount_' . $spouse . 'this_year_income_extra', $financialaffairsInfo );
                    $differentExtraA = number_format(abs($differentExtraAAmount), 2, '.', ',');
                    $differentExtraAClass = $differentExtraAAmount < 0 ? 'text-danger' : '';
                    $differentExtraAStart = $differentExtraAAmount < 0 ? '(' : '';
                    $differentExtraAEnd = $differentExtraAAmount < 0 ? ')' : '';
                @endphp
                <span class="font-weight-normal section-title {{ $differentExtraAClass }}">
                    ${{ $differentExtraAStart . $differentExtraA . $differentExtraAEnd }}
                </span>
            </label>
        </div>
    @endif
@else
    <div class="col-md-5">
        <label class="font-weight-bold fs-13px "> <span class="font-weight-normal">Current year to date:
                {{ date('Y') }}</span></label>
    </div>
    <div class="col-md-5">
        <label class="font-weight-bold fs-13px ">
            <span class="font-weight-normal">
                {{ !empty($financialaffairsInfo['total_amount_' . $spouse . 'this_year']) && $financialaffairsInfo['total_amount_' . $spouse . 'this_year'] == 1 ? 'Wages, commissions, bonuses, tips' : 'Operating a business' }}
            </span>
        </label>
    </div>
    <div class="col-md-2">
        <label class="font-weight-bold fs-13px ">
            @php
                $singleAAmount = (float) Helper::validate_key_value( 'total_amount_' . $spouse . 'this_year_income', $financialaffairsInfo);
                $singleA = number_format(abs($singleAAmount), 2, '.', ',');
                $singleAClass = $singleAAmount < 0 ? 'text-danger' : '';
                $singleAStart = $singleAAmount < 0 ? '(' : '';
                $singleAEnd = $singleAAmount < 0 ? ')' : '';
            @endphp
            <span class="font-weight-normal section-title {{ $singleAClass }}">
                ${{ $singleAStart . $singleA . $singleAEnd }}
            </span>
        </label>
    </div>
@endif

@php
    $hasExtraLastYear =
        isset($financialaffairsInfo['total_amount_' . $spouse . 'last_year_income_extra']) &&
        $financialaffairsInfo['total_amount_' . $spouse . 'last_year_income_extra'] != null;
    $typeA = $hasExtraLastYear ? $financialaffairsInfo['total_amount_' . $spouse . 'last_year'] : null;
    $typeB = $hasExtraLastYear ? $financialaffairsInfo['total_amount_' . $spouse . 'last_year_extra'] : null;
@endphp

@if ($hasExtraLastYear)
    @if ($typeA == $typeB)
        <div class="col-md-5">
            <label class="font-weight-bold fs-13px "> <span class="font-weight-normal">Last Years Total Income:
                    {{ date('Y', strtotime('-1 year')) }}</span></label>
        </div>
        <div class="col-md-5">
            <label class="font-weight-bold fs-13px ">
                <span class="font-weight-normal">
                    {{ !empty($financialaffairsInfo['total_amount_' . $spouse . 'this_year']) && $financialaffairsInfo['total_amount_' . $spouse . 'this_year'] == 1 ? 'Wages, commissions, bonuses, tips' : 'Operating a business' }}
                </span>
            </label>
        </div>
        <div class="col-md-2">
            <label class="font-weight-bold fs-13px ">
                @php
                    $sameBAmountFirst = Helper::validate_key_value( 'total_amount_' . $spouse . 'last_year_income', $financialaffairsInfo );
                    $sameBAmountFirst = (float) str_replace(',', '', $sameBAmountFirst);
                    $sameBAmountSecond = Helper::validate_key_value( 'total_amount_' . $spouse . 'last_year_income_extra', $financialaffairsInfo );
                    $sameBAmountSecond = (float) str_replace(',', '', $sameBAmountSecond);
                    $sameBTotal = $sameBAmountFirst + $sameBAmountSecond;
                    $sameBTotalFormatted = number_format(abs($sameBTotal), 2, '.', ',');
                    $sameBTotalClass = $sameBTotal < 0 ? 'text-danger' : '';
                    $sameBStart = $sameBTotal < 0 ? '(' : '';
                    $sameBEnd = $sameBTotal < 0 ? ')' : '';
                @endphp
                <span class="font-weight-normal section-title {{ $sameBTotalClass }}">
                    ${{ $sameBStart . $sameBTotalFormatted . $sameBEnd }}
                </span>
            </label>
        </div>
    @endif
    @if ($typeA != $typeB)
        ?>
        <div class="col-md-5">
            <label class="font-weight-bold fs-13px "> <span class="font-weight-normal">Last Years Total Income:
                    {{ date('Y', strtotime('-1 year')) }}</span></label>
        </div>
        <div class="col-md-5">
            <label class="font-weight-bold fs-13px ">
                <span class="font-weight-normal">
                    {{ !empty($financialaffairsInfo['total_amount_' . $spouse . 'last_year']) && $financialaffairsInfo['total_amount_' . $spouse . 'last_year'] == 1 ? 'Wages, commissions, bonuses, tips' : 'Operating a business' }}
                </span>
            </label>
        </div>
        <div class="col-md-2">
            <label class="font-weight-bold fs-13px ">
                @php
                    $differentBAmount = (float) Helper::validate_key_value( 'total_amount_' . $spouse . 'last_year_income', $financialaffairsInfo );
                    $differentB = number_format(abs($differentBAmount), 2, '.', ',');
                    $differentBClass = $differentBAmount < 0 ? 'text-danger' : '';
                    $differentBStart = $differentBAmount < 0 ? '(' : '';
                    $differentBEnd = $differentBAmount < 0 ? ')' : '';
                @endphp
                <span class="font-weight-normal section-title {{ $differentBClass }}">
                    ${{ $differentBStart . $differentB . $differentBEnd }}
                </span>
            </label>
        </div>
        <!-- additional -->
        <div class="col-md-5">
            <label class="font-weight-bold fs-13px "> <span class="font-weight-normal">Last Years Total Income:
                    {{ date('Y', strtotime('-1 year')) }}</span></label>
        </div>
        <div class="col-md-5">
            <label class="font-weight-bold fs-13px ">
                <span class="font-weight-normal">
                    {{ !empty($financialaffairsInfo['total_amount_' . $spouse . 'last_year_extra']) && $financialaffairsInfo['total_amount_' . $spouse . 'last_year_extra'] == 1 ? 'Wages, commissions, bonuses, tips' : 'Operating a business' }}
                </span>
            </label>
        </div>
        <div class="col-md-2">
            <label class="font-weight-bold fs-13px ">
                @php
                    $differentExtraBAmount = (float) Helper::validate_key_value( 'total_amount_' . $spouse . 'last_year_income_extra', $financialaffairsInfo );
                    $differentExtraB = number_format(abs($differentExtraBAmount), 2, '.', ',');
                    $differentExtraBClass = $differentExtraBAmount < 0 ? 'text-danger' : '';
                    $differentExtraBStart = $differentExtraBAmount < 0 ? '(' : '';
                    $differentExtraBEnd = $differentExtraBAmount < 0 ? ')' : '';
                @endphp
                <span class="font-weight-normal section-title {{ $differentExtraBClass }}">
                    ${{ $differentExtraBStart . $differentExtraB . $differentExtraBEnd }}
                </span>
            </label>
        </div>
    @endif
@else
    <div class="col-md-5">
        <label class="font-weight-bold fs-13px ">
            <span class="font-weight-normal">Last Years Total Income:
                {{ date('Y', strtotime('-1 year')) }}
            </span>
        </label>
    </div>
    <div class="col-md-5">
        <label class="font-weight-bold fs-13px ">
            <span class="font-weight-normal">
                {{ !empty($financialaffairsInfo['total_amount_' . $spouse . 'last_year']) && $financialaffairsInfo['total_amount_' . $spouse . 'last_year'] == 1 ? 'Wages, commissions, bonuses, tips' : 'Operating a business' }}
            </span>
        </label>
    </div>
    <div class="col-md-2">
        <label class="font-weight-bold fs-13px ">
            @php
                $singleBAmount = (float) Helper::validate_key_value( 'total_amount_' . $spouse . 'last_year_income', $financialaffairsInfo );
                $singleB = number_format(abs($singleBAmount), 2, '.', ',');
                $singleBClass = $singleBAmount < 0 ? 'text-danger' : '';
                $singleBStart = $singleBAmount < 0 ? '(' : '';
                $singleBEnd = $singleBAmount < 0 ? ')' : '';
            @endphp
            <span class="font-weight-normal section-title {{ $singleBClass }}">
                ${{ $singleBStart . $singleB . $singleBEnd }}
            </span>
        </label>
    </div>
@endif

@php
    $hasExtraLastBeforeYear =
        isset($financialaffairsInfo['total_amount_' . $spouse . 'lastbefore_year_income_extra']) &&
        $financialaffairsInfo['total_amount_' . $spouse . 'lastbefore_year_income_extra'] != null;
    $typeA = $hasExtraLastBeforeYear ? $financialaffairsInfo['total_amount_' . $spouse . 'lastbefore_year'] : null;
    $typeB = $hasExtraLastBeforeYear
        ? $financialaffairsInfo['total_amount_' . $spouse . 'lastbefore_year_extra']
        : null;
@endphp

@if ($hasExtraLastBeforeYear)
    @if ($typeA == $typeB)
        <div class="col-md-5">
            <label class="font-weight-bold fs-13px "> <span class="font-weight-normal">Previous Year Total Income:
                    {{ date('Y', strtotime('-2 year')) }}</span></label>
        </div>
        <div class="col-md-5">
            <label class="font-weight-bold fs-13px ">
                <span class="font-weight-normal">
                    {{ !empty($financialaffairsInfo['total_amount_' . $spouse . 'lastbefore_year']) && $financialaffairsInfo['total_amount_' . $spouse . 'lastbefore_year'] == 1 ? 'Wages, commissions, bonuses, tips' : 'Operating a business' }}
                </span>
            </label>
        </div>
        <div class="col-md-2">
            <label class="font-weight-bold fs-13px ">
                @php
                    $sameCAmountFirst = Helper::validate_key_value( 'total_amount_' . $spouse . 'lastbefore_year_income', $financialaffairsInfo );
                    $sameCAmountFirst = (float) str_replace(',', '', $sameCAmountFirst);
                    $sameCAmountSecond = Helper::validate_key_value( 'total_amount_' . $spouse . 'lastbefore_year_income_extra', $financialaffairsInfo );
                    $sameCAmountSecond = (float) str_replace(',', '', $sameCAmountSecond);
                    $sameCTotal = $sameCAmountFirst + $sameCAmountSecond;
                    $sameCTotalFormatted = number_format(abs($sameCTotal), 2, '.', ',');
                    $sameCTotalClass = $sameCTotal < 0 ? 'text-danger' : '';
                    $sameCStart = $sameCTotal < 0 ? '(' : '';
                    $sameCEnd = $sameCTotal < 0 ? ')' : '';
                @endphp
                <span class="font-weight-normal section-title {{ $sameCTotalClass }}">
                    ${{ $sameCStart . $sameCTotalFormatted . $sameCEnd }}
                </span>
            </label>
        </div>
    @endif
    @if ($typeA != $typeB)
        ?>
        <div class="col-md-5">
            <label class="font-weight-bold fs-13px "> <span class="font-weight-normal">Previous Year Total Income:
                    {{ date('Y', strtotime('-2 year')) }}</span></label>
        </div>
        <div class="col-md-5">
            <label class="font-weight-bold fs-13px ">
                <span class="font-weight-normal">
                    {{ !empty($financialaffairsInfo['total_amount_' . $spouse . 'lastbefore_year']) && $financialaffairsInfo['total_amount_' . $spouse . 'lastbefore_year'] == 1 ? 'Wages, commissions, bonuses, tips' : 'Operating a business' }}
                </span>
            </label>
        </div>
        <div class="col-md-2">
            <label class="font-weight-bold fs-13px ">
                @php
                    $differentCAmount = (float) Helper::validate_key_value( 'total_amount_' . $spouse . 'lastbefore_year_income', $financialaffairsInfo );
                    $differentC = number_format(abs($differentCAmount), 2, '.', ',');
                    $differentCClass = $differentCAmount < 0 ? 'text-danger' : '';
                    $differentCStart = $differentCAmount < 0 ? '(' : '';
                    $differentCEnd = $differentCAmount < 0 ? ')' : '';
                @endphp
                <span class="font-weight-normal section-title {{ $differentCClass }}">
                    ${{ $differentCStart . $differentC . $differentCEnd }}
                </span>
            </label>
        </div>
        <!-- additional -->
        <div class="col-md-5">
            <label class="font-weight-bold fs-13px "> <span class="font-weight-normal">Previous Year Total Income:
                    {{ date('Y', strtotime('-2 year')) }}</span></label>
        </div>
        <div class="col-md-5">
            <label class="font-weight-bold fs-13px ">
                <span class="font-weight-normal">
                    {{ !empty($financialaffairsInfo['total_amount_' . $spouse . 'lastbefore_year_extra']) && $financialaffairsInfo['total_amount_' . $spouse . 'lastbefore_year_extra'] == 1 ? 'Wages, commissions, bonuses, tips' : 'Operating a business' }}
                </span>
            </label>
        </div>
        <div class="col-md-2">
            <label class="font-weight-bold fs-13px ">
                @php
                    $differentExtraCAmount = (float) Helper::validate_key_value( 'total_amount_' . $spouse . 'lastbefore_year_income_extra', $financialaffairsInfo );
                    $differentExtraC = number_format(abs($differentExtraCAmount), 2, '.', ',');
                    $differentExtraCClass = $differentExtraCAmount < 0 ? 'text-danger' : '';
                    $differentExtraCStart = $differentExtraCAmount < 0 ? '(' : '';
                    $differentExtraCEnd = $differentExtraCAmount < 0 ? ')' : '';
                @endphp
                <span class="font-weight-normal section-title {{ $differentExtraCClass }}">
                    ${{ $differentExtraCStart . $differentExtraC . $differentExtraCEnd }}
                </span>
            </label>
        </div>
    @endif
@else
    <div class="col-md-5">
        <label class="font-weight-bold fs-13px ">
            <span class="font-weight-normal">Previous Year Total Income: {{ date('Y', strtotime('-2 year')) }}</span>
        </label>
    </div>
    <div class="col-md-5">
        <label class="font-weight-bold fs-13px ">
            <span class="font-weight-normal">
                {{ !empty($financialaffairsInfo['total_amount_' . $spouse . 'lastbefore_year']) && $financialaffairsInfo['total_amount_' . $spouse . 'lastbefore_year'] == 1 ? 'Wages, commissions, bonuses, tips' : 'Operating a business' }}
            </span>
        </label>
    </div>
    <div class="col-md-2">
        <label class="font-weight-bold fs-13px ">
            @php
                $singleCAmount = (float) Helper::validate_key_value( 'total_amount_' . $spouse . 'lastbefore_year_income', $financialaffairsInfo );
                $singleC = number_format(abs($singleCAmount), 2, '.', ',');
                $singleCClass = $singleCAmount < 0 ? 'text-danger' : '';
                $singleCStart = $singleCAmount < 0 ? '(' : '';
                $singleCEnd = $singleCAmount < 0 ? ')' : '';
            @endphp
            <span class="font-weight-normal section-title {{ $singleCClass }}">
                ${{ $singleCStart . $singleC . $singleCEnd }}
            </span>
        </label>
    </div>
@endif
