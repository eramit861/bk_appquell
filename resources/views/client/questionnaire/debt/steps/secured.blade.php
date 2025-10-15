<form name="client_debts_step2_al" id="client_debts_step2_al" action="{{route('additional_liens_custom_save')}}" method="post" novalidate>
    @csrf
    <div class="light-gray-div mt-2">
        <h2>Secured Debts/Loans for Personal Property</h2>
        <div class="row gx-3">
            <div class="col-12">
                <div class="label-div question-area">
                    <label for="bankruptcy_filed">
                        Do you have any secured debts that are not related to a home or auto loan?
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Example: A Secured Debt, is when you take out a loan on a specific item that can be taken back if you default on payments like a car, boat, or house. List all items that you have as secure debt(s).">
                            <i class="bi bi-question-circle"></i>
                        </div>
                         <br><p class="text-c-red blink p-0 mb-1">ONLY list any debts here not already listed elsewhere in the questionnaire.</p>
                    </label>
                   
                    <!-- Radio Buttons -->
                    <div class="custom-radio-group form-group">
                        <input type="radio" id="additional-liens_yes" class="d-none" name="additional_liens" required {{ Helper::validate_key_toggle('additional_liens', $debts, 1) }} value="1">
                        <label for="additional-liens_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('additional_liens', $debts, 1) }}" onclick="common_toggle_fn('yes','additional_liens');">Yes</label>

                        <input type="radio" id="additional-liens_no" class="d-none" name="additional_liens" required {{ Helper::validate_key_toggle('additional_liens', $debts, 0) }} value="0">
                        <label for="additional-liens_no" class="btn-toggle {{ Helper::validate_key_toggle_active('additional_liens', $debts, 0) }}" onclick="common_toggle_fn('no','additional_liens');">No</label>
                    </div>
                </div>
            </div>

            <div class="col-12 {{ Helper::key_hide_show_v('additional_liens', $debts) }} additional_liens_div" id="additional_liens">
                <div class="row" >
                    <div class="col-md-12" >
                        <div class="outline-gray-border-area" id="additional_liens_html">
                                @php
                                    $i = 0;
                                    $additional = [];
                                @endphp
                                
                                @if(!empty($debts['additional_liens_data']) && count($debts['additional_liens_data']) > 0)
                                    @foreach($debts['additional_liens_data'] as $additional)
                                        @include("client.questionnaire.debt.additional_liens",$additional)
                                        @php $i++; @endphp
                                    @endforeach
                                @else
                                    @include("client.questionnaire.debt.additional_liens")
                                @endif
                                <div class="add-more-div-bottom">
                                    <button type="button" class="btn-new-ui-default py-1 px-2" id="add-more-additional-form" onclick="addAdditionalLiensForm('{{ $alCustomSaveUrl }}');return false;">
                                        <i class="bi bi-plus-lg"></i>
                                        Add Additional Secured Debts
                                    </button>
                                </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</form>