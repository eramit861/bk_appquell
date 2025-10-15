@props([
    'tradedStocksData' => [],
    'tradedStocks' => [],
    'webView' => false,
])

<div class="d-none {{ !$webView ? 'form-main mt-3 w-100' : '' }}">
    <div class="col-md-12">
        <div class="form-group">
            <input type="hidden" name="traded_stocks[id]" value="{{ $tradedStocksData['id'] }}">
            <input type="hidden" name="traded_stocks[type]" value="traded_stocks">
            <label class="d-block">{!! 'Do you or your spouse have any non-publicly traded stocks and/or interests in businesses.' !!}</label>

            <div class="d-inline radio-primary">
                <input type="radio" {{ Helper::validate_key_toggle('type_value', $tradedStocks, 1) }} required
                    id="non_publicly_items_yes" name="traded_stocks[type_value]" onchange="getNonPubliclyItems('yes');"
                    value="1">
                <label for="non_publicly_items_yes" class="cr">Yes</label>
            </div>
            <div class="d-inline radio-primary">
                <input type="radio" {{ Helper::validate_key_toggle('type_value', $tradedStocks, 0) }} required
                    id="non_publicly_items_no" name="traded_stocks[type_value]" onchange="getNonPubliclyItems('no');"
                    value="0">
                <label for="non_publicly_items_no" class="cr">No</label>
            </div>
        </div>
    </div>

    <!-- Condition data -->
    <div class="col-md-12 {{ $tradedStocksData['hideShowClass'] }}" id="non_publicly_items_data">
        <div class="row">
            <a href="javascript:void(0)" onclick="openPopup('traded-stock-popup')">
                <img alt="Quick Tip" class="tool-tip-icon" src="{{ url('assets/img/quick-tip.jpg') }}" width="60px" />
            </a>
            <div class="hide-data traded-stock-popup">
                This is for all non publicly traded company interests. If you own shares or a portion
                any business entity you should list this here. (Listed here: LLC; C-Corp; S-Corp;
                Partnerships & Sole Proprietorships)
            </div>
        </div>

        <div class="row">
            @php $i = 0; @endphp
            @if (!empty($tradedStocksData['description']) && is_array($tradedStocksData['description']))
                @for ($i = 0; $i < count($tradedStocksData['description']); $i++)
                    @include('client.questionnaire.property.financial.traded_stocks', [
                        'traded_stocks' => $tradedStocks,
                        'i' => $i,
                        'hiddenInputs' => false,
                    ])
                @endfor
            @else
                @include('client.questionnaire.property.financial.traded_stocks', [
                    'traded_stocks' => $tradedStocks,
                    'i' => $i,
                    'hiddenInputs' => false,
                ])
            @endif

            @if (
                !empty($tradedStocksData['description']) &&
                    is_array($tradedStocksData['description']) &&
                    count($tradedStocksData['description']) < 4)
                <div class="col-md-12 add-more-btn">
                    <button class="btn btn-primary shadow-2 rounded-0" id="add-more-residence-form"
                        onclick="common_financial_addmore('traded_stocks','traded-stocks-mutisec'); return false;">
                        <i class="feather icon-plus mr-0"></i> Add More
                    </button>
                    <i class="fas fa-trash fa-lg mb-2 mt-2 remove-traded-stocks-mutisec" name=""
                        style="position: absolute;right: 40px;"
                        onclick="removeButton('.traded_stocks_mutisec', '.remove-traded-stocks-mutisec');"></i>
                </div>
            @else
                <div class="col-md-12 add-more-btn">
                    <button class="btn btn-primary shadow-2 rounded-0"
                        onclick="common_financial_addmore('traded_stocks','traded-stocks-mutisec'); return false;">
                        <i class="feather icon-plus mr-0"></i> Add More
                    </button>
                    <i class="fas fa-trash fa-lg mb-2 mt-2 remove-traded-stocks-mutisec" name=""
                        style="position: absolute;right: 40px;"
                        onclick="removeButton('.traded_stocks_mutisec', '.remove-traded-stocks-mutisec');"></i>
                </div>
            @endif
        </div>
    </div>
</div>
