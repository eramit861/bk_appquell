@props([
    'step4' => false,
    'tradedStocks' => [],
    'webView' => false,
    'basicInfoPartRest' => [],
    'attorneyEdit' => '',
])
<!-- Step 4: Traded Stocks Section -->
<div id="basic-info-part-d" class="{{ !$step4 ? 'hidestep' : '' }}">
    <div class="mt-3">
        <form name="client_basic_info_step4" id="client_basic_info_step4" action="{{ route('client_basic_info_step4') }}"
            method="post" novalidate>
            @csrf

            <!-- Traded Stocks Component -->
            <x-client.traded-stocks-section :tradedStocksData="[
                'id' => Helper::validate_key_value('id', $tradedStocks),
                'type_value' => Helper::validate_key_value('type_value', $tradedStocks),
                'description' => $tradedStocks['description'] ?? [],
                'hideShowClass' => Helper::key_hide_show_v('type_value', $tradedStocks),
            ]" :tradedStocks="$tradedStocks" :webView="$webView" />
            <!-- condition-data -->
            <div class="col-md-12">
                <div class="next-part-btn text-right">

                    @if (!empty($basicInfoPartRest['id']))
                        <input type="hidden" name="basicinfo_partrest_id" value="{{ $basicInfoPartRest['id'] }}">
                        <a href="{{ route('client_basic_info_step2') }}"
                            class="btn btn-primary shadow-2 mb-4 {{ ClientHelper::hideBackOnEditPopup($attorneyEdit) }}">Back</a>
                        <button type="submit" class="btn btn-primary shadow-2 mb-4">Save & Next <i
                                class="feather icon-chevron-right mr-0"></i></button>
                        <!--<button class="btn btn-primary shadow-2 mb-4" onclick="changeStep(this);return false;">Next <i class="feather icon-chevron-right mr-0"></i></button>-->
                    @else
                        <button type="submit" class="btn btn-primary shadow-2 mb-4">Save & Next <i
                                class="feather icon-chevron-right mr-0"></i></button>
                    @endif

                </div>
            </div>
        </form>
    </div>
</div>
