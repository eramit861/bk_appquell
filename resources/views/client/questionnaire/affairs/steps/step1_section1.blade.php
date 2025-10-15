<input type="hidden" name="current_marital_Status" value="{{ $maritalStatus }}">

<!-- List any lawsuits, court actions -->
<div class="col-12">
    <div class="label-div question-area">
        <label>
            Have you been a party to any <span class="text-c-blue">lawsuits</span> in the last 12 months?
            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title=""
                data-bs-original-title="List all such matters, including personal injury cases, small claims actions, divorces, collection suits, paternity actions, supportor custody modifications, and contract disputes.">
                <i class="bi bi-question-circle"></i>
            </div>

            <p class="text-bold mb-0">
                <span class="text-danger blink mb-0">A lawsuit means a case filed in court where you were either suing someone or being sued. <i class="fa fa-arrow-down"></i></span>
                <br>
                <span class="text-success mb-0">The court needs to know about any lawsuits so they can see if money or property might be owed back to you.</span>
            </p>
        </label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group">
            <input type="radio" id="list_lawsuits_yes" class="d-none" name="list_lawsuits" required {{ Helper::validate_key_toggle('list_lawsuits', $finacial_affairs, 1) }} value="1">
            <label for="list_lawsuits_yes"
                class="btn-toggle  {{ Helper::validate_key_toggle_active('list_lawsuits', $finacial_affairs, 1) }}"
                onclick="getListLawsuitsData('yes');">Yes</label>

            <input type="radio" id="list_lawsuits_no" class="d-none" name="list_lawsuits" required {{ Helper::validate_key_toggle('list_lawsuits', $finacial_affairs, 0) }} value="0">
            <label for="list_lawsuits_no"
                class="btn-toggle  {{ Helper::validate_key_toggle_active('list_lawsuits', $finacial_affairs, 0) }}"
                onclick="getListLawsuitsData('no');">No</label>
        </div>
    </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ Helper::key_hide_show_v('list_lawsuits', $finacial_affairs) }}" id="list-lawsuits-data">
    @include("client.questionnaire.affairs.common.parent_list_lawsuits")
</div>

<!-- Property Repossessed -->
<div class="col-12">
    <div class="label-div question-area">
        <label>
            Have you had any of your property
            <span class="text-c-blue">repossessed</span>,
            <span class="text-c-blue">foreclosed</span>,
            <span class="text-c-blue">garnished</span>,
            <span class="text-c-blue">attached</span>,
            <span class="text-c-blue">seized</span>, or
            <span class="text-c-blue">levied</span> in the last
            <span class="text-danger">12 months</span>?
            <div class="d-inline-block" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="List all such matters, including personal injury cases, small claims actions, divorces, collection suits, paternity actions, supportor custody modifications, and contract disputes.">
                <i class="bi bi-question-circle"></i>
            </div>
            <p class="text-bold mb-0 blink text-danger text-bold">
                <span class="text-danger">This means if a bank, creditor, or government took your car, home, money, or other property because of unpaid debts. <i class="fa fa-arrow-down"></i></span>
            </p>
        </label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group">
            <input type="radio" id="property_repossessed_yes" class="d-none" name="property_repossessed" required {{ Helper::validate_key_toggle('property_repossessed', $finacial_affairs, 1) }} value="1">
            <label for="property_repossessed_yes" class="btn-toggle  {{ Helper::validate_key_toggle_active('property_repossessed', $finacial_affairs, 1) }}" onclick="getPropertyRepossessedData('yes');">Yes</label>

            <input type="radio" id="property_repossessed_no" class="d-none" name="property_repossessed" required {{ Helper::validate_key_toggle('property_repossessed', $finacial_affairs, 0) }} value="0">
            <label for="property_repossessed_no" class="btn-toggle  {{ Helper::validate_key_toggle_active('property_repossessed', $finacial_affairs, 0) }}" onclick="getPropertyRepossessedData('no');">No</label>
        </div>
    </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ Helper::key_hide_show_v('property_repossessed', $finacial_affairs) }}" id="property-repossessed-data">
    @include("client.questionnaire.affairs.common.parent_property_repossessed")
</div>

<!-- List any lawsuits, court actions -->
<div class="col-12">
    <div class="label-div question-area">
        <label>
            In the <span class="text-danger">last 3 months</span>, has any bank, creditor, or lender taken money from your account or refused to make a payment because you owed them money?
            <p class="text-bold mb-0 text-bold">
                <span class="text-c-blue">A bank taking money from your checking or savings account.</span><br>
                <span class="text-c-blue">A creditor refusing to pay a bill or release funds because you owe money.</span>
            </p>
        </label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group">
            <input type="radio" id="setoffs_creditor_yes" class="d-none" name="setoffs_creditor" required {{ Helper::validate_key_toggle('setoffs_creditor', $finacial_affairs, 1) }} value="1">
            <label for="setoffs_creditor_yes" class="btn-toggle  {{ Helper::validate_key_toggle_active('setoffs_creditor', $finacial_affairs, 1) }}" onclick="getSetoffsCreditorData('yes');">Yes</label>

            <input type="radio" id="setoffs_creditor_no" class="d-none" name="setoffs_creditor" required {{ Helper::validate_key_toggle('setoffs_creditor', $finacial_affairs, 0) }} value="0">
            <label for="setoffs_creditor_no" class="btn-toggle  {{ Helper::validate_key_toggle_active('setoffs_creditor', $finacial_affairs, 0) }}" onclick="getSetoffsCreditorData('no');">No</label>
        </div>
    </div>
</div>
<!-- Condition data -->
<div class="col-12 {{ Helper::key_hide_show_v('setoffs_creditor', $finacial_affairs) }}" id="setoffs_creditor-data">
    @include("client.questionnaire.affairs.common.parent_setoffs_creditor")
</div>

<!-- court-appointed -->
<div class="col-12">
    <div class="label-div question-area">
        <label>
            In the past year, has any of your property been held by someone like a court-appointed official, receiver, or trustee because ofyour debts?
            <p class="text-bold mb-0 text-bold">
                <span class="text-danger">This means if a court or official temporarily took your property to pay your creditors.</span>
            </p>
        </label>
        <!-- Radio Buttons -->
        <div class="custom-radio-group form-group">
            <input type="radio" id="court_appointed_yes" class="d-none" name="court_appointed" required {{ Helper::validate_key_toggle('court_appointed', $finacial_affairs, 1) }} value="1">
            <label for="court_appointed_yes" class="btn-toggle  {{ Helper::validate_key_toggle_active('court_appointed', $finacial_affairs, 1) }}">Yes</label>

            <input type="radio" id="court_appointed_no" class="d-none" name="court_appointed" required {{ Helper::validate_key_toggle('court_appointed', $finacial_affairs, 0) }} value="0">
            <label for="court_appointed_no" class="btn-toggle  {{ Helper::validate_key_toggle_active('court_appointed', $finacial_affairs, 0) }}">No</label>
        </div>
    </div>
</div>

<div class="col-12">
   <button type="button" class="btn-submit-danger mb-3" onclick="selectNoToAbove('sofa_section_legal_action')">
      No to all of the above
   </button>
</div>