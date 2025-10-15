<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/client/profit_loss_pdf.css') }}">
    @if ($web_view ?? false)
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/client/profit_loss_pdf_conditional.css') }}">
    @endif
    @if (!($majorLawProfitLossLabels['labels'] ?? true))
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/client/profit_loss_pdf_for_firm.css') }}">
    @endif
</head>

<body>
    <div class="profitlosspopup  profitpopup">
        <div class="row no-border-elements">
            @for ($i = 1; $i <= 1; $i++)
                @csrf
                <div class="col-xs-12 align-center">
                    <div class="col-xs-12">
                        <div class="d-block">
                            <h4 class="{{ !($majorLawProfitLossLabels['labels'] ?? true) ? 'hide-data' : '' }}">Monthly
                                Profit/Loss Statement</h4>
                            <h4 class="{{ $majorLawProfitLossLabels['labels'] ?? true ? 'hide-data' : '' }}">Business
                                Income & Expense Worksheet</h4>
                        </div>
                        <div class="d-block">
                            <h4>(<span
                                    style="border-bottom: 1px solid gray;">{{ Helper::validate_key_value('name_of_business', $income_profit_loss) }}</span>)
                            </h4>
                        </div>
                        <div class="selected-months">
                            <h4>For</h4>
                            <h4>
                                @php
                                    $dateString = Helper::validate_key_value('profit_loss_month', $income_profit_loss);
                                @endphp
                                @if (!empty($dateString))
                                    @php
                                        $date = \Carbon\Carbon::createFromFormat('m-Y', $dateString);
                                        $monthName = $date->format('F Y');
                                    @endphp
                                    {{ $monthName }}
                                @endif
                            </h4>
                        </div>

                    </div>
                </div>


                <div class="col-md-12  {{ !($majorLawProfitLossLabels['labels'] ?? true) ? 'hide-data' : '' }}">
                    <div class="col-md-12 my-2">
                        <h4 class="">Income:</h4>
                    </div>
                </div>
                <div class="col-md-12  {{ $majorLawProfitLossLabels['labels'] ?? true ? 'hide-data' : '' }}">
                    <div class="col-md-12 my-2">
                        <h6 class="">(Note: ONLY INCLUDE information directly related to the business operation.
                            DO NOT include personal income
                            or expenses)</h6>
                    </div>
                </div>


                <table>
                    <tr>
                        <td style="line-height: 14px; ">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['gross_business_income']) !!}</td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">
                            $&nbsp;{{ Helper::validate_key_value('gross_business_income', $income_profit_loss, 'float', true) }}
                        </td>
                    </tr>
                    <tr class="{{ !($majorLawProfitLossLabels['labels'] ?? true) ? 'hide-data' : '' }}">
                        <td colspan="3" style="line-height: 12px; padding-bottom: 8px;">
                            <small class="text-c-blue">(You can get this amount from your Additions and/or total
                                deposits from bank statement(s))</small>
                        </td>
                    </tr>
                </table>

                <div class="col-md-12 {{ !($majorLawProfitLossLabels['labels'] ?? true) ? 'hide-data' : '' }}">
                    <div class="col-md-12 my-2">
                        <h4 class="">Business Expenses:</h4>
                    </div>
                </div>
                <div class="col-md-12 {{ $majorLawProfitLossLabels['labels'] ?? true ? 'hide-data' : '' }}">
                    <div class="col-md-12 my-2">
                        <h6 class="">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['monthly_expsens']) !!}</h6>
                    </div>
                </div>

                <table>
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['cost_of_goods_sold']) !!}</td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('cost_of_goods_sold', $income_profit_loss, 'float', true) }}
                        </td>
                    </tr>
                    <tr class="{{ !($majorLawProfitLossLabels['labels'] ?? true) ? 'hide-data' : '' }}">
                        <td colspan="3" style="line-height: 12px; padding-bottom: 8px;">
                            <small class="text-c-blue">(Examples of this are: Raw Materials, Inventory Costs, Production
                                Costs, etc.)</small>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['advertising_expense']) !!}</td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('advertising_expense', $income_profit_loss, 'float', true) }}
                        </td>
                    </tr>

                    <tr class="{{ !($majorLawProfitLossLabels['labels'] ?? true) ? 'hide-data' : '' }}">
                        <td colspan="3" style="line-height: 12px; padding-bottom: 8px;">
                            <small class="text-c-blue">(Examples of this are: Advertising Costs, Expenses for online
                                ads, Website Expenses etc.)</small>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['subcontractor_pay']) !!}</td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('subcontractor_pay', $income_profit_loss, 'float', true) }}
                        </td>
                    </tr>
                    <tr class="{{ !($majorLawProfitLossLabels['labels'] ?? true) ? 'hide-data' : '' }}">
                        <td colspan="3" style="line-height: 12px; padding-bottom: 8px;">
                            <small class="text-c-blue">(Examples of this are: employees or subcontractors you just pay,
                                and they are responsible for taxes)</small>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['professional_service']) !!}</td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('professional_service', $income_profit_loss, 'float', true) }}
                        </td>
                    </tr>
                    <tr class="{{ !($majorLawProfitLossLabels['labels'] ?? true) ? 'hide-data' : '' }}">
                        <td colspan="3" style="line-height: 12px; padding-bottom: 8px;">
                            <small class="text-c-blue">(Examples of this are: Accounting Fees: Expenses for bookkeeping,
                                tax preparation, and financial consulting, etc.)</small>
                        </td>
                    </tr>
                </table>

                <table style="margin-bottom: 8px;">
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['cc_expense']) !!}</td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('cc_expense', $income_profit_loss, 'float', true) }}</td>
                    </tr>
                </table>

                <table style="margin-bottom: 8px;">
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['equipment_rental_expense']) !!}
                        </td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('equipment_rental_expense', $income_profit_loss, 'float', true) }}
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['insurance_expense']) !!}</td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('insurance_expense', $income_profit_loss, 'float', true) }}
                        </td>
                    </tr>
                    <tr class="{{ !($majorLawProfitLossLabels['labels'] ?? true) ? 'hide-data' : '' }}">
                        <td colspan="3" style="line-height: 12px; padding-bottom: 8px;">
                            <small class="text-c-blue">(Examples of this are: Business Insurance: Premiums for coverage
                                like liability insurance, property insurance, and auto)</small>
                        </td>
                    </tr>
                </table>

                <table style="margin-bottom: 8px;">
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['licenses_expense']) !!}</td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('licenses_expense', $income_profit_loss, 'float', true) }}
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['office_supplies_expense']) !!}</td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('office_supplies_expense', $income_profit_loss, 'float', true) }}
                        </td>
                    </tr>
                    <tr class="{{ !($majorLawProfitLossLabels['labels'] ?? true) ? 'hide-data' : '' }}">
                        <td colspan="3" style="line-height: 12px; padding-bottom: 8px;">
                            <small class="text-c-blue">(Examples of this are: Costs for items like stationery, printer
                                ink, and other office materials, etc.)</small>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['postage_expense']) !!}</td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('postage_expense', $income_profit_loss, 'float', true) }}
                        </td>
                    </tr>
                    <tr class="{{ !($majorLawProfitLossLabels['labels'] ?? true) ? 'hide-data' : '' }}">
                        <td colspan="3" style="line-height: 12px; padding-bottom: 8px;">
                            <small class="text-c-blue">(Examples of this are: Shipping Costs: Expenses for delivering
                                products to customers or receiving supplies, etc.)</small>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['rent_office_expense']) !!}</td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('rent_office_expense', $income_profit_loss, 'float', true) }}
                        </td>
                    </tr>
                    <tr class="{{ !($majorLawProfitLossLabels['labels'] ?? true) ? 'hide-data' : '' }}">
                        <td colspan="3" style="line-height: 12px; padding-bottom: 8px;">
                            <small class="text-c-blue">(Examples of this are: Costs for fixing trucks/cars, engine
                                repairs, tires, oil changes, equipment maintenance, etc.)</small>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['bank_fee_and_interest']) !!}</td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('bank_fee_and_interest', $income_profit_loss, 'float', true) }}
                        </td>
                    </tr>
                    <tr class="{{ !($majorLawProfitLossLabels['labels'] ?? true) ? 'hide-data' : '' }}">
                        <td colspan="3" style="line-height: 12px; padding-bottom: 8px;">
                            <small class="text-c-blue">(Examples of this are: monthly bank service fees, credit card
                                interest, interest on business loans, etc.)</small>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['software_and_subscription']) !!}
                        </td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('software_and_subscription', $income_profit_loss, 'float', true) }}
                        </td>
                    </tr>
                    <tr class="{{ !($majorLawProfitLossLabels['labels'] ?? true) ? 'hide-data' : '' }}">
                        <td colspan="3" style="line-height: 12px; padding-bottom: 8px;">
                            <small class="text-c-blue">(Examples of this are: Software Licenses: QuickBooks,
                                Salesforce, Subscriptions: online services, and other subscriptions, etc.)</small>
                        </td>
                    </tr>
                </table>

                <table style="margin-bottom: 8px;">
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['supplies_material_expense']) !!}
                        </td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('supplies_material_expense', $income_profit_loss, 'float', true) }}
                        </td>
                    </tr>
                </table>

                <table style="margin-bottom: 8px;">
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['travel_expense']) !!}</td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('travel_expense', $income_profit_loss, 'float', true) }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['utility_expense']) !!}</td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('utility_expense', $income_profit_loss, 'float', true) }}
                        </td>
                    </tr>
                    <tr class="{{ !($majorLawProfitLossLabels['labels'] ?? true) ? 'hide-data' : '' }}">
                        <td colspan="3" style="line-height: 12px; padding-bottom: 8px;">
                            <small class="text-c-blue">(Examples of this are: phones, utility bills like electric gas,
                                water strictly for business only, etc.)</small>
                        </td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['vehicle_expense']) !!}</td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('vehicle_expense', $income_profit_loss, 'float', true) }}
                        </td>
                    </tr>
                    <tr class="{{ !($majorLawProfitLossLabels['labels'] ?? true) ? 'hide-data' : '' }}">
                        <td colspan="3" style="line-height: 12px; padding-bottom: 8px;">
                            <small class="text-c-blue">(Examples of this are: <span class="text-danger">(business only
                                    vehicles)</span> car loan payments, maintenance, registration fees, licenses,
                                etc.)</small>
                        </td>
                    </tr>
                </table>

                <div class="col-md-12 {{ !($majorLawProfitLossLabels['labels'] ?? true) ? 'hide-data' : '' }}">
                    <div class="col-md-12 my-3">
                        <h4 class="mb-0" style="line-height: 14px;">Other Business Expenses:</h4>
                        <small class="text-c-blue" style="line-height: 12px; padding-bottom: 8px;">(Add in other
                            expense(s) that you didn’t list above such as: Rent (not home office), Salaries/Wages,
                            Travel and Meals, etc.)</small>
                    </div>
                </div>

                <table style="margin-bottom: 8px;">
                    <tr>
                        <td style="line-height: 14px; width:86%;">
                            {{ Helper::validate_key_value('other_expense_name1', $income_profit_loss) }}</td>
                        <td style="line-height: 14px; "> $
                            {{ Helper::validate_key_value('other_1', $income_profit_loss, 'float', true) }}</td>
                    </tr>
                </table>

                <table style="margin-bottom: 8px;">
                    <tr>
                        <td style="line-height: 14px; width:86%;">
                            {{ Helper::validate_key_value('other_expense_name2', $income_profit_loss) }}</td>
                        <td style="line-height: 14px; "> $
                            {{ Helper::validate_key_value('other_2', $income_profit_loss, 'float', true) }}</td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td style="line-height: 14px; width:86%;">
                            {{ Helper::validate_key_value('other_expense_name3', $income_profit_loss) }}</td>
                        <td style="line-height: 14px; "> $
                            {{ Helper::validate_key_value('other_3', $income_profit_loss, 'float', true) }}</td>
                    </tr>
                </table>

                <table style="margin-bottom: 8px;">
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['total_monthly_expenses']) !!}</td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('total_expense', $income_profit_loss, 'float', true) }}</td>
                    </tr>
                </table>

                <table style="margin-bottom: 8px;">
                    <tr>
                        <td style="line-height: 14px; display:inline">
                            {!! str_replace(' ', '&nbsp;', $majorLawProfitLossLabels['net_monthly_income']) !!}</td>
                        <td class="dotted" style="line-height: 14px; border-bottom:1px dotted black;"></td>
                        <td style="line-height: 14px; width:100px;">$
                            {{ Helper::validate_key_value('total_profit_loss', $income_profit_loss, 'float', true) }}
                        </td>
                    </tr>
                </table>


                <div class="col-xs-12 align-center mt-3">
                    <div class="col-xs-12">
                        <div class="d-block">
                            <h5>DECLARATION UNDER PENALTY OF PERJURY BY DEBTOR(S)</h5>
                        </div>
                        <p class="align-left">I/We declare under penalty of perjury that the information provided is
                            true and correct to the best of my/our knowledge and belief.</p>
                    </div>
                </div>

                <div class="col-xs-12">
                    <div style="float:left; width: 50%"> <span>Signature of Debtor:</span>
                        @php
                            $name1 =
                                Helper::validate_key_value('name', $BasicInfoPartA) .
                                ' ' .
                                Helper::validate_key_value('middle_name', $BasicInfoPartA) .
                                ' ' .
                                Helper::validate_key_value('last_name', $BasicInfoPartA);
                        @endphp
                        {{ $name1 }}
                    </div>
                    <div style="float:left; width: 50%"><span style="width: 15%">Date:</span>
                        {{ $final_date }}</div>

                </div>

                <div class="col-xs-12" style="clear: both">
                    <div style="float:left; width: 50%">
                        <span>Signature of Co-Debtor:</span>
                        @php
                            $name2 =
                                Helper::validate_key_value('name', $BasicInfo_PartB) .
                                ' ' .
                                Helper::validate_key_value('middle_name', $BasicInfo_PartB) .
                                ' ' .
                                Helper::validate_key_value('last_name', $BasicInfo_PartB);
                        @endphp
                        {{ $name2 }}
                    </div>
                    <div style="float:left; width: 50%">
                        <span style="width: 15%">Date:</span>
                        {{ $final_date }}
                    </div>

                </div>
            @endfor
        </div>
    </div>
</body>
