@php
$array = [
        "joints_paycheck_mandatory_contribution" => "Mandatory Retirement (Pension)",
        "joints_paycheck_voluntary_contribution" => "Voluntary Retirement (401K, IRA)",
        "joints_paycheck_required_repayment" => "Repayment of Loan (Retirement loan or employer loan)",
        "joints_automatically_deduction_insurance" => "Deducted for insurance (Health, vision, dental, etc)",
        "joints_domestic_support_obligations" => "Domestic Support Obligations (Child support, alimony)",
        "joints_union_dues_deducted" => "Union dues",
        "other_deduction" => "Other deductions (Any other deductions )"
    ];
@endphp
<div class="modal-content modal-content-div conditional-ques">
    <div class="modal-header align-items-center py-2">
        <h5 class="modal-title d-flex w-100" >
            Co-debtor's Paystub Calculation
        </h5>
    </div>

    <div class="modal-body p-0">
        <div class="card-body b-0-i">
            <form method="POST" id="pinwheel_cal_form" name="pinwheel_cal_form">
                @csrf
                <div class="light-gray-div mt-3">
                    <h2>Paystub Calculation</h2>
                    <div class="row gx-3 form_bgp">	
                        @foreach ($data as $key => $value)                    
                            <div class="col-md-6">
                                <div class="label-div">
                                    <div class="form-group">
                                        <label class="mb-0 mt-2">{!! $key.": <strong>$".$value.'</strong>' !!}</label>
                                    </div>  
                                </div>                                  
                            </div>
                            <div class="col-md-6">
                                <div class="label-div">
                                    <div class="form-group">
                                        <select class="form-control typ_det" name="selected_deduction[]" id="{{ $value }}" data-type="{{ $key }}">
                                            <option value="">Select</option>
                                            @foreach ($array as $index => $name)
                                            <option value="{{ $index }}">{!! $name !!}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endforeach                        
                    </div>
                </div>
                <div class="bottom-btn-div">
                    <a href ="javascript:void(0)" onclick="setupPinwheelCalculation()" class="btn-new-ui-default">Import</a>
                </div>
            </form>
        </div>
    </div>

</div>

@push('tab_scripts')
    <script>
        window.__pinwheelCalculationRoutes = {
            submitRouteUrl: "{{ $submitRouteUrl ?? '' }}"
        };
        window.__pinwheelCalculationData = {
            priceCount: {{ is_array($data) ? count($data) : 0 }},
            clientId: "{{ $client_id ?? '' }}"
        };
    </script>
    <script src="{{ asset('assets/js/client/pinwheel_calculation_form.js') }}"></script>
@endpush