<form name="client_debts_step2_back_taxes" id="client_debts_step2_back_taxes" action="{{route('back_tax_custom_save')}}" method="post" novalidate>
    @csrf
    <div class="light-gray-div mt-2">
        <h2>State Back Taxes Owed</h2>
        <div class="row gx-3">
            <div class="col-12">
                <div class="label-div question-area">
                    <label for="bankruptcy_filed">
                        Do you owe any back taxes to any <span class="text-c-blue">State?</span>
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Unpaid taxes owed to any state, including income, property, or business taxes from previous years. May result in penalties or interest if left unpaid.">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                    <!-- Radio Buttons -->
                    <div class="custom-radio-group form-group">
                        <input type="radio" id="tax-owned-state_yes" class="d-none" name="tax_owned_state" required {{ Helper::validate_key_toggle('tax_owned_state', $debts, 1) }} value="1">
                        <label for="tax-owned-state_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('tax_owned_state', $debts, 1) }}" onclick="getTaxowned('yes');">Yes</label>
                   
                        <input type="radio" id="tax-owned-state_no" class="d-none" name="tax_owned_state" required {{ Helper::validate_key_toggle('tax_owned_state', $debts, 0) }} value="0">
                        <label for="tax-owned-state_no" class="btn-toggle {{ Helper::validate_key_toggle_active('tax_owned_state', $debts, 0) }}" onclick="getTaxowned('no');">No</label>
                    </div>
                </div>
            </div>
            <div class="col-12 {{ Helper::key_hide_show_v('tax_owned_state', $debts) }} back-taxes-tax-owed" id="tax-owned-state">
                <div class="outline-gray-border-area">
                    @php
                        $i = 0;
                        $taxNo = 1;
                        $backdebts = [];
                        $customSaveUrl = route("back_tax_custom_save");
                    @endphp
                    
                    @if(!empty($debts['back_tax_own']) && count($debts['back_tax_own']) > 0)
                        @foreach($debts['back_tax_own'] as $backdebts)
                            @include("client.questionnaire.debt.tax_debt",$backdebts)
                            @php 
                                $i++;
                                $taxNo++;
                            @endphp
                        @endforeach
                    @else
                        @include("client.questionnaire.debt.tax_debt")
                    @endif
                    <div class="add-more-div-bottom">
                        <button type="button" class="btn-new-ui-default py-1 px-2" id="add-more-residence-form" onclick="addbackTaxes('{{ $customSaveUrl }}');return false;">
                            <i class="bi bi-plus-lg"></i>
                            Add State Taxes Owed to Another State
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>