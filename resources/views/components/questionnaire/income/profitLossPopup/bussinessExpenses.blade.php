<div class="col-md-12 {{ empty($majorLawProfitLossLabels['labels']) ? 'hide-data' : '' }}">
    <div class="light-gray-box-tittle-div mb-2 mt-3">
        <h2>Business Costs</h2>
    </div>
    <p class="text-bold text-center  w-100 mobile-fs-12">
        <span class="text-danger">Only use expenses that show money coming out of your bank account(s).</span>
        <br>
        <span class="text-danger">Don’t input tax deductions such as vehicle mileage, Home Office Deduction, Depreciation etc.</span>
    </p>
</div>

<div class="col-md-12 {{ !empty($majorLawProfitLossLabels['labels']) ? 'hide-data' : '' }}">
    <label class="text-bold">{{ $majorLawProfitLossLabels['monthly_expsens'] ?? '' }}</label>
</div>

<x-questionnaire.income.profitLossPopup.expensesRow
        :incomeProfitLoss="$incomeProfitLoss"
        :web_view="$webView"
        :title="$majorLawProfitLossLabels['cost_of_goods_sold'] ?? ''"
        name="cost_of_goods_sold"
        :subLabel="!empty($majorLawProfitLossLabels['labels']) ? '(Examples of this are: Raw Materials, Inventory Costs, Production Costs, etc.)' : ''"
/>

@php
    $expenses = [
        'advertising_expense' => 'Advertising Costs, Online Ads, Website Expenses',
        'subcontractor_pay' => 'Employees or subcontractors you just pay, and they are responsible for taxes',
        'professional_service' => 'Accounting Fees: Bookkeeping, tax preparation, financial consulting',
        'cc_expense' => '',
        'equipment_rental_expense' => '',
        'insurance_expense' => 'Business Insurance: Liability insurance, property insurance, auto insurance',
        'licenses_expense' => '',
        'office_supplies_expense' => 'Stationery, printer ink, and other office materials',
        'postage_expense' => 'Shipping Costs: Delivering products to customers, receiving supplies',
        'rent_office_expense' => 'Fixing trucks/cars, engine repairs, tires, oil changes, maintenance',
        'bank_fee_and_interest' => 'Bank service fees, credit card interest, interest on business loans',
        'software_and_subscription' => 'Software Licenses: QuickBooks, Salesforce, online services subscriptions',
        'supplies_material_expense' => '',
        'travel_expense' => '',
        'utility_expense' => 'Phones, electric, gas, water (strictly for business)',
        'vehicle_expense' => '<span class="text-danger">(business-only vehicles)</span> car loan payments, maintenance, registration fees, licenses'
    ];
@endphp

@foreach($expenses as $key => $description)
    <x-questionnaire.income.profitLossPopup.expensesRow
        :incomeProfitLoss="$incomeProfitLoss"
        :web_view="$webView"
        :title="$majorLawProfitLossLabels[$key] ?? ''"
        name="{{ $key }}"
        :subLabel="!empty($majorLawProfitLossLabels['labels']) ? '(Examples of this are: ' . $description . ')' : ''"
    />
@endforeach
