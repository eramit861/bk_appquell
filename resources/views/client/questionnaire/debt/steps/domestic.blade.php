<form name="client_debts_step2_dso" id="client_debts_step2_dso" action="{{route('dso_custom_save')}}" method="post" novalidate>
    @csrf
    <div class="light-gray-div mt-2">
        <h2>Domestic Support Debts</h2>
        <div class="row gx-3">
            <div class="col-12">
                <div class="label-div question-area">
                    <label for="bankruptcy_filed">
                        Do you or your spouse (if you have one) owe any child support or alimony, either now or from the past?
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="The court needs to know if you pay child support and/or alimony so your case is done properly. If have this type of Debt its important to list it so you get credit on your expenses, which the Court looks through in determining your case.">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                    <!-- Radio Buttons -->
                    <div class="custom-radio-group form-group">
                        <input type="radio" id="domestic-support_yes" class="d-none" name="domestic_support" required {{ Helper::validate_key_toggle('domestic_support', $debts, 1) }} value="1">
                        <label for="domestic-support_yes" class="btn-toggle {{ Helper::validate_key_toggle_active('domestic_support', $debts, 1) }}" onclick="common_toggle_fn('yes','domestic-support');">Yes</label>

                        <input type="radio" id="domestic-support_no" class="d-none" name="domestic_support" required {{ Helper::validate_key_toggle('domestic_support', $debts, 0) }} value="0">
                        <label for="domestic-support_no" class="btn-toggle {{ Helper::validate_key_toggle_active('domestic_support', $debts, 0) }}" onclick="common_toggle_fn('no','domestic-support');">No</label>
                    </div>
                </div>
            </div>
            <div class="col-12 second_step_domestic_debts w-100 {{ Helper::key_hide_show('domestic_support', $debts) }}" id="second_step_domestic_debts_div" >
                <div class="row {{ Helper::key_hide_show_v('domestic_support', $debts) }}"
                    id="domestic-support">
                    <div class="col-md-12" >
                        <div class="outline-gray-border-area" id="domestic_div_html">
                            @php
                                $i = 0;
                                $debtNo = 1;
                                $domestic = [];
                                $customSaveUrl = route("dso_custom_save");
                            @endphp
                            
                            @if(!empty($debts['domestic_tax']) && count($debts['domestic_tax']) > 0)
                                @foreach($debts['domestic_tax'] as $domestic)
                                    @include("client.questionnaire.debt.domestic",$domestic)
                                    @php 
                                        $i++;
                                        $debtNo++;
                                    @endphp
                                @endforeach
                            @else
                                @include("client.questionnaire.debt.domestic")
                            @endif
                            <div class="add-more-div-bottom">
                                <button type="button" class="btn-new-ui-default py-1 px-2" id="add-more-domestic-form" onclick="addAnotherDomesticForm('{{ $customSaveUrl }}');return false;">
                                    <i class="bi bi-plus-lg"></i>
                                    Add Additional DSO Owed
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>