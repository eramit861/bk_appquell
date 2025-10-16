<!-- Tab 2 -->

@php
$detailed_property = !empty($resident['detailed_property']) ? $resident['detailed_property'] : 0;
$enable_free_bank_statements = $resident['enable_free_bank_statements'];

$client = isset($attorney_edit) && $attorney_edit == true ? $client_user : $authUser;
$client_id = $client->id;
$attorney = \App\Models\ClientsAttorney::where("client_id", $client_id)->first();
$attorney_id = $attorney->attorney_id;
$documentTypes = Helper::getDocuments($client->client_type, 0, 0, 0, 0, 0, $attorney_id);
$attorney_edit = isset($attorney_edit) && $attorney_edit == true ? true : false;
$assetSaveRoute = isset($attorney_edit) && $attorney_edit == true ? route('update_property_asset_att_side') : route('update_property_asset_client_side');
$tab2_percentage_by_steps = Helper::validate_key_value('tab2_percentage_by_steps', $progress);
$BasicInfoPartAAddress = AddressHelper::getClientBasicAddress($client_id);
@endphp
<!-- include("client.questionnaire.topbar") -->

@php
    // Extract step data
    $step1TabData = !empty($tab2_percentage_by_steps['step1']) ? $tab2_percentage_by_steps['step1'] : [];
    $step1PercentDone = (int)(!empty($step1TabData['percentDone']) ? $step1TabData['percentDone'] : 0);
    $step1PercentTotal = (int)(!empty($step1TabData['percentTotal']) ? $step1TabData['percentTotal'] : 0);
    $step1TabClass = !empty($step1TabData['tabClass']) ? $step1TabData['tabClass'] : '';

    $step2TabData = !empty($tab2_percentage_by_steps['step2']) ? $tab2_percentage_by_steps['step2'] : [];
    $step2PercentDone = (int)(!empty($step2TabData['percentDone']) ? $step2TabData['percentDone'] : 0);
    $step2PercentTotal = (int)(!empty($step2TabData['percentTotal']) ? $step2TabData['percentTotal'] : 0);
    $step2TabClass = !empty($step2TabData['tabClass']) ? $step2TabData['tabClass'] : '';

    $step3TabData = !empty($tab2_percentage_by_steps['step3']) ? $tab2_percentage_by_steps['step3'] : [];
    $step3PercentDone = (int)(!empty($step3TabData['percentDone']) ? $step3TabData['percentDone'] : 0);
    $step3PercentTotal = (int)(!empty($step3TabData['percentTotal']) ? $step3TabData['percentTotal'] : 0);
    $step3TabClass = !empty($step3TabData['tabClass']) ? $step3TabData['tabClass'] : '';

    $step4TabData = !empty($tab2_percentage_by_steps['step4']) ? $tab2_percentage_by_steps['step4'] : [];
    $step4PercentDone = (int)(!empty($step4TabData['percentDone']) ? $step4TabData['percentDone'] : 0);
    $step4PercentTotal = (int)(!empty($step4TabData['percentTotal']) ? $step4TabData['percentTotal'] : 0);
    $step4TabClass = !empty($step4TabData['tabClass']) ? $step4TabData['tabClass'] : '';

    $step5TabData = !empty($tab2_percentage_by_steps['step5']) ? $tab2_percentage_by_steps['step5'] : [];
    $step5PercentDone = (int)(!empty($step5TabData['percentDone']) ? $step5TabData['percentDone'] : 0);
    $step5PercentTotal = (int)(!empty($step5TabData['percentTotal']) ? $step5TabData['percentTotal'] : 0);
    $step5TabClass = !empty($step5TabData['tabClass']) ? $step5TabData['tabClass'] : '';

    $step6TabData = !empty($tab2_percentage_by_steps['step6']) ? $tab2_percentage_by_steps['step6'] : [];
    $step6PercentDone = (int)(!empty($step6TabData['percentDone']) ? $step6TabData['percentDone'] : 0);
    $step6PercentTotal = (int)(!empty($step6TabData['percentTotal']) ? $step6TabData['percentTotal'] : 0);
    $step6TabClass = !empty($step6TabData['tabClass']) ? $step6TabData['tabClass'] : '';

    $step7TabData = !empty($tab2_percentage_by_steps['step7']) ? $tab2_percentage_by_steps['step7'] : [];
    $step7PercentDone = (int)(!empty($step7TabData['percentDone']) ? $step7TabData['percentDone'] : 0);
    $step7PercentTotal = (int)(!empty($step7TabData['percentTotal']) ? $step7TabData['percentTotal'] : 0);
    $step7TabClass = !empty($step7TabData['tabClass']) ? $step7TabData['tabClass'] : '';
@endphp

<!-- Tab Navigation Component -->
<x-client.tab-navigation
    :tabData="[
        'step1' => [
            'percentDone' => $step1PercentDone,
            'percentTotal' => $step1PercentTotal,
            'tabClass' => $step1TabClass,
            'routeName' => 'property_information',
            'icon' => '🏠',
            'label' => 'Real Property',
            'tabId' => 'all-firm-client-tab',
            'targetId' => 'all-firm-client'
        ],
        'step2' => [
            'percentDone' => $step2PercentDone,
            'percentTotal' => $step2PercentTotal,
            'tabClass' => $step2TabClass,
            'routeName' => 'client_property_step1',
            'icon' => '🚗',
            'label' => 'Vehicles',
            'tabId' => 'all-firm-client-tab',
            'targetId' => 'all-firm-client'
        ],
        'step3' => [
            'percentDone' => $step3PercentDone,
            'percentTotal' => $step3PercentTotal,
            'tabClass' => $step3TabClass,
            'routeName' => 'client_property_step2',
            'icon' => '🛋️',
            'label' => 'Personal/Household Items',
            'tabId' => 'all-firm-client-tab',
            'targetId' => 'all-firm-client'
        ],
        'step4' => [
            'percentDone' => $step4PercentDone,
            'percentTotal' => $step4PercentTotal,
            'tabClass' => $step4TabClass,
            'routeName' => 'client_property_step3',
            'icon' => '🏦',
            'label' => 'Financial Assets',
            'tabId' => 'all-firm-client-tab',
            'targetId' => 'all-firm-client'
        ],
        'step5' => [
            'percentDone' => $step5PercentDone,
            'percentTotal' => $step5PercentTotal,
            'tabClass' => $step5TabClass,
            'routeName' => 'client_property_step4_continue',
            'icon' => '💼',
            'label' => 'Money or property owed to you',
            'tabId' => 'all-firm-client-tab',
            'targetId' => 'all-firm-client'
        ],
        'step6' => [
            'percentDone' => $step6PercentDone,
            'percentTotal' => $step6PercentTotal,
            'tabClass' => $step6TabClass,
            'routeName' => 'client_property_step4',
            'icon' => '🏢',
            'label' => 'Business-Related Assets',
            'tabId' => 'all-firm-client-tab',
            'targetId' => 'all-firm-client',
            'condition' => (int)(!empty($isBusinessProperty['type_value']) ? $isBusinessProperty['type_value'] : 0) == 1
        ],
        'step7' => [
            'percentDone' => $step7PercentDone,
            'percentTotal' => $step7PercentTotal,
            'tabClass' => $step7TabClass,
            'routeName' => 'client_property_step5',
            'icon' => '🚜',
            'label' => 'Farm & Fish-Related Assets',
            'tabId' => 'all-firm-client-tab',
            'targetId' => 'all-firm-client',
            'condition' => (int)(!empty($isFarmProperty['type_value']) ? $isFarmProperty['type_value'] : 0) == 1
        ]
    ]"
    :debtorTabName="$debtorname"
    :codebtorTabName="$spousename" />
<div class="card-body border-top-left-radius-none">
	<div class="tab-content bg-unset p-0 box-shadow-unset" id="pills-tabContent">
		<div class="tab-pane fade show active" id="active" role="tabpanel" aria-labelledby="" tabindex="0">
			<!-- Step 1 - Real Property -->
			@if($step1)
				<div class="{{ !$step1 ? 'hidestep' : '' }}" id="property-part-a">
					@include("client.questionnaire.property.steps.step1")
				</div>
			@endif
			<!-- Step 2 - Vehicles -->
			@if($step2)
				<div class="{{ !$step2 ? 'hidestep' : '' }}" id="property-part-b">
					@include("client.questionnaire.property.steps.step2")
				</div>
			@endif
			<!-- Step 3 - Personal/Household Items -->
			@if($step3)
				<div class="{{ !$step3 ? 'hidestep' : '' }}" id="property-part-c">
					@include("client.questionnaire.property.steps.step3")
				</div>
			@endif
			<!-- Step 4 - Financial Assets -->
			@if($step4)
				<div class="{{ !$step4 ? 'hidestep' : '' }}" id="property-part-d finaicalmamit">
					@include("client.questionnaire.property.steps.step4")
				</div>
			@endif
			<!-- Step 5 - Money or property owed to you -->
			@if(isset($step4continue) && $step4continue)
				<div class="{{ !isset($step4continue) || !$step4continue ? 'hidestep' : '' }}" id="property-part-d-cont">
					@include("client.questionnaire.property.steps.step5")
				</div>
			@endif
			<!-- Step 6 - Business-Related Assets -->
			@if($step5)
				<div class="{{ !$step5 ? 'hidestep' : '' }}" id="property-part-e">
					@include("client.questionnaire.property.steps.step6")
				</div>
			@endif
			<!-- Step 7 - Farm and Commercial Fishing-Related Property  -->
			@if($step6)
				<div class="{{ !$step6 ? 'hidestep' : '' }}" id="property-part-f">
					@include("client.questionnaire.property.steps.step7")
				</div>
			@endif
		</div>
	</div>
</div>
<div class="hide-data no-mortgage-popup">
    <p>
        <i class="fa fa-exclamation-triangle fs-18px text-danger blink" aria-hidden="true"></i>
        <span class="text-c-red">Its extremely important you list any <u>Mortgages/Loans</u> on this property if you have any. If you have mortgages/liens on a property your not listing it looks like you have a bunch of equity you really don't have. If you plan on keeping this property it needs to be accurate.
        </span><br><small class="text-c-blue">Although some people have homes without any mortgages and/or loans this is very rare</small>
    </p>
    <p>Are you sure you don't have any loans on this property?</p>
</div>

<div class="hide-data no-vehicle-popup">
    <p>
        <i class="fa fa-exclamation-triangle fs-18px text-danger blink" aria-hidden="true"></i>
        <span class="text-c-red"> It is essential that you list any loans or liens on this vehicle if applicable. Failing to disclose them can create a misleading impression of your actual equity. If you plan to keep this vehicle, please ensure the information is accurate.
        </span><br><small class="text-c-blue">Although some people have older cars and or new cars without any loans this is very rare</small>
    </p>
    <p>Are you sure you don't have any loans on this property?</p>
</div>
@include('modal.client.property.property_value')
@push('tab_styles')
    <link rel="stylesheet" href="{{ asset('assets/css/client/tab2.css') }}">
@endpush
@push('tab_scripts')
<script>
        // Pass PHP variables to JavaScript
        window.tab2Data = {
			graphqlurl: "{{ route('get_property_residence_details_by_graphql') }}",
			BasicInfoPartAAddress: "{{ !empty($BasicInfoPartAAddress) ? $BasicInfoPartAAddress : ''}}",
            clientId: "{{ $client_id }}",
            assetSaveRoute: "{{ $assetSaveRoute }}",
            showNoticePopup: "{{ request()->routeIs('client_property_step2') || request()->routeIs('client_property_step3') || request()->routeIs('client_property_step4_continue') || request()->routeIs('client_property_step4') || request()->routeIs('client_property_step5') ? '1' : '0' }}",
            // Property-specific status data
            propertyresidentStatus: {{ isset($propertyresident) && !empty($propertyresident) ? 1 : 0 }},
            vehicleStatus: {{ isset($vehicleselected) && !empty($vehicleselected) ? 1 : 0 }},
            householdStatus: {{ isset($propertyhousehold) && !empty($propertyhousehold) ? 1 : 0 }},
            financialAssetsStatus: {{ isset($financialassets) && !empty($financialassets) ? 1 : 0 }},
            businessAssetsStatus: {{ isset($businessassets) && !empty($businessassets) ? 1 : 0 }},
            farmCommercialStatus: {{ isset($farmcommercial) && !empty($farmcommercial) ? 1 : 0 }},
            miscellaneousStatus: {{ isset($miscellaneous) && !empty($miscellaneous) ? 1 : 0 }},
            previousData: "{{ (isset($previous_data) && !empty($previous_data)) ? $previous_data : '' }}",
            transactionPdfEnabled: "{{ isset($transaction_pdf_enabled) ? $transaction_pdf_enabled : 0 }}",
            propertySaveRoute: "{{ route('update_property_step1_ajax') }}",
        };

        window.tab2Routes = {
            mortgageSearch: "{{ route('mortgage_search') }}",
            countyByStateName: "{{ route('county_by_state_name') }}",
            // Property-specific routes
            fetchVinNumber: "{{ route('fetch_vin_number') }}",
            loanCompanySearch: "{{ route('loan_company_search') }}",
            getPropertyVehicleDetailsByGraphQL: "{{ route('get_property_vehicle_details_by_graphql') }}"
        };
</script>

    {{-- Load Tab 2 Common utilities (always loaded) --}}
    <script src="{{ asset('assets/js/client/questionnaire/tab2/common.js') }}?v=1.03"></script>
    
    {{-- Load step-specific JavaScript based on active step --}}
    @if($step1)
        <script src="{{ asset('assets/js/client/questionnaire/tab2/step1.js') }}?v=1.11"></script>
    @endif
    
    @if($step2)
        <script src="{{ asset('assets/js/client/questionnaire/tab2/step2.js') }}?v=1.05"></script>
    @endif
    
    @if($step3)
        <script src="{{ asset('assets/js/client/questionnaire/tab2/step3.js') }}?v=1.02"></script>
    @endif
    
    @if($step4 || isset($step4continue))
        <script src="{{ asset('assets/js/client/questionnaire/tab2/step4.js') }}?v=1.04"></script>
    @endif
    
    @if($step5)
        <script src="{{ asset('assets/js/client/questionnaire/tab2/step5.js') }}?v=1.04"></script>
        <script src="{{ asset('assets/js/client/questionnaire/tab2/step6.js') }}?v=1.02"></script>
    @endif
    
    @if($step6)
        <script src="{{ asset('assets/js/client/questionnaire/tab2/step7.js') }}?v=1.02"></script>
    @endif
@endpush

