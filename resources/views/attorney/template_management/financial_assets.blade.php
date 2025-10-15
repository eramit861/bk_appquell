@php
    $conditionalQuestionArray = [
        'cash' => 'Do you or your spouse keep any cash on hand (not in a bank)?',
        'bank' => 'Do you or your spouse have any bank accounts (checking, savings, credit union) or CDs?',
        'venmo_paypal_cash' => 'Do you or your spouse, if applicable, have any Venmo, PayPal, Cash App, or Apple Pay accounts?',
        'list_all_financial_accounts' => 'In the past 12 months, did you or a financial institution close, sell, move, or transfer any bank or investment accounts in your name or for your benefit?',
        'brokerage_account' => 'Do you or your spouse, if applicable, have any brokerage and/or cryptocurrency (crypto) accounts?',
        'retirement_pension' => 'Do you or your spouse have any retirement accounts, like 401 (k), IRA, or pension accounts?',
        'tax_refunds' => 'Do you or your spouse, if applicable, expect any tax refunds in the immediate future?',
        'licenses_franchises' => 'Do you or your spouse (if applicable) hold any professional licenses, have interests in any franchises, or own any general intangible assets?',
        'mutual_funds' => 'Do you own any government or company bonds, savings bonds, annuities, or other certificates/papers that promise to pay you money in the future?',
        'education_ira' => 'Do you or your spouse, if applicable, have any Education IRAS, ABLE accounts, or state tuition savings accounts?',
        'trusts_life_estates' => "Do you or your spouse, if applicable, have any financial interests or legal rights in property that you don't fully own but still benefit from, such as a trust, inheritance, or equitable interest?",
        'all_property_transfer_10_year' => 'In the last 10 years, did you transfer any property into a trust or similar arrangement where you are a beneficiary?',
        'patents_copyrights' => 'Do you or your spouse, if applicable, have any Patents, Copyrights, Trademarks, Trade Secrets, and/or any Other Intellectual Property?',
    ];
    $templateData = !empty($templateData) ? Helper::validate_key_value('data', $templateData) : [];
@endphp

<form name="financial_assets_data_save" id="financial_assets_data_save" action="{{route('template_data_save')}}" method="post" novalidate>
    @csrf
    <input type="hidden" name="type" value="{{ $type }}">

                    <div class="row gx-3">
                        <div class="col-12 col-md-12">
                            <div class="light-gray-div mt-3">
                                <h2>Enable/Disable Questions</h2>
                                <div class="row gx-3">
                                    <div class="col-12 table-responsive ">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>#</th>
                                                    <th class="question-text">Question</th>
                                                    <th class="custom-radio-group">Manage Question Display</th>
                                                </tr>
                                                @php $i = 1; @endphp
                                                @foreach ($conditionalQuestionArray as $key => $question)
                                                    @php $checked = ""; @endphp
                                                    <tr>
                                                        <td class="py-1">{{ $i }}</td>
                                                        <td class="py-1 question-text">{{ $question }}</td>
                                                        <td class="py-1 custom-radio-group">
                                                            @if (empty($templateData))
                                                                @php $checked = 'checked'; @endphp
                                                            @else
                                                                @php $checked = ''; @endphp
                                                                @if (isset($templateData[$key]) && $templateData[$key] == 1)
                                                                    @php $checked = 'checked'; @endphp
                                                                @endif
                                                            @endif
                                                            <div class="form-check p-0 text-center">
                                                                <div class="label-div question-area m-0">
                                                                    <!-- Radio Buttons -->
                                                                    <div class="custom-radio-group form-group m-0 mt-1">
                                                                        <input type="radio" id="{{ $key }}_yes"
                                                                            class="d-none" name="data[{{ $key }}]"
                                                                            {!! $checked !!} value="1">
                                                                        <label for="{{ $key }}_yes"
                                                                            class="btn-toggle btn-green {{ $checked == 'checked' ? 'active' : '' }}">Enable</label>

                                                                        <input type="radio" id="{{ $key }}_no"
                                                                            class="d-none" name="data[{{ $key }}]"
                                                                            {!! $checked !!} value="0">
                                                                        <label for="{{ $key }}_no"
                                                                            class="btn-toggle btn-red {{ $checked !== 'checked' ? 'active' : '' }}">Disable</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @php $i++; @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
    <div class="bottom-btn-div">
        <button type="submit" class="btn font-weight-bold border-blue-big m-0 btn-new-ui-default btn-green"><span class="">Save</span></button>
    </div>
</form>