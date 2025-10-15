<div class="col-12">
    <div class="light-gray-div mt-2">
        <h2 class="text-dark fw-bold">Relationship Information</h2>
        <div class="row gx-3">
            <div class="col-12">
                <div class="label-div question-area">
                    <label>
                        Please list all the dependents of you and your spouse with their age and
                        relationship to you (if applicable).
                        <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                            data-bs-original-title="List all dependents, including their age and relationship to you or your spouse, if applicable.">
                            <i class="bi bi-question-circle"></i>
                        </div>
                    </label>
                    <div class="custom-radio-group form-group">
                        <input type="radio" name="any_dependents" id="all_dependents_yes" class="d-none required"
                            value="1" {{ Helper::validate_key_toggle('any_dependents', $expenses, 1) }}>
                        <label for="all_dependents_yes"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('any_dependents', $expenses, 1) }}"
                            onclick="getAllDependents('yes');updateAveragePrice();">Yes</label>

                        <input type="radio" name="any_dependents" id="all_dependents_no" class="d-none required"
                            value="0" {{ Helper::validate_key_toggle('any_dependents', $expenses, 0) }}>
                        <label for="all_dependents_no"
                            class="btn-toggle {{ Helper::validate_key_toggle_active('any_dependents', $expenses, 0) }}"
                            onclick="getAllDependents('no');updateAveragePrice('1');">No</label>
                    </div>
                </div>
            </div>

            <div class="col-12 {{ Helper::key_hide_show_v('any_dependents', $expenses) }}" id="all_dependents">
                <div class="outline-gray-border-area" id="employer_listing_html">
                    @if (!empty($expenses['dependent_relationship']))
                        @for ($i = 0; $i < count($expenses['dependent_relationship']); $i++)
                            @include('client.questionnaire.expense.common.all_dependents')
                        @endfor
                    @else
                        @php $i = 0; @endphp
                        @include('client.questionnaire.expense.common.all_dependents')
                    @endif

                    <div class="add-more-div-bottom">
                        <button type="button" class="btn-new-ui-default py-1 px-2"
                            onclick="addRelationshipForm();updateAveragePrice();return false;">
                            <i class="bi bi-plus-lg"></i>
                            Add Additional Dependent(s)
                        </button>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
