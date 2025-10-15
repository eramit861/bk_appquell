<div class="mb-2 col-md-12">
    <div class="label-div question-area">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <label class="form-label mb-md-0">REPO:<br> I had a vehicle repoed in the last 10 days on this date:
                        <small>(MM/DD/YYYY)</small></label>
                </div>
                <div class="col-md-4">
                    <input type="text" name="vehicle_repoed_date" class="form-control date_filed"
                        placeholder="MM/DD/YYYY"
                        value="{{ !empty(Helper::validate_key_value('vehicle_repoed_date', $formData)) ? Helper::validate_key_value('vehicle_repoed_date', $formData) : old('vehicle_repoed_date') }}">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- BORROWED & PAID BACK: Have you BORROWED AND PAID BACK a FRIEND OR FAMILY MEMBER $1,000 OR MORE in the last 4 years? List each person, your relationship, and the amount repaid, month and year. -->
<div class="my-2 col-md-12 ">
    <div class="label-div question-area">
        <div class="form-group">
            <label class=" form-label">BORROWED & PAID BACK:<br> Have you BORROWED AND PAID BACK a FRIEND OR FAMILY
                MEMBER
                $1,000 OR MORE in the last 4 years? List each person, your relationship, and the amount repaid, month
                and year.</label>
            <textarea name="borrowed_and_paid_back"
                class="input_capitalize form-control">{{ !empty(Helper::validate_key_value('borrowed_and_paid_back', $formData)) ? Helper::validate_key_value('borrowed_and_paid_back', $formData) : old('borrowed_and_paid_back') }}</textarea>
        </div>
    </div>
</div>
<!-- ; FRIEND / FAMILY DEBT: Do you still owe $1,000 + to any friend or family member? List each person, your relationship, how much you owe, and what the loan was for. -->
<div
    class="my-2 col-md-12 {{ \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'estimated_total_loans_from_family') }}">
    <div class="label-div question-area">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <label class="form-label mb-md-0">FRIEND / FAMILY DEBT:<br> Do you still owe $1,000 + to any friend
                        or family
                        member? List each person, your relationship, how much you owe, and what the loan was for</label>
                </div>
                <div class="col-md-4">
                    <div class="d-flex input-group">
                        <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                        <input required type="text" class="custom_corner_input form-control price-field"
                            placeholder="Estimated Total Loans From Family" name="family_loans"
                            value="{{ !empty(Helper::validate_key_value('family_loans', $formData)) ? Helper::validate_key_value('family_loans', $formData) : old('family_loans') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- JOINT DEBT: Do you share any loan with someone else (not just an authorized user)? List every shared debt and name the other borrower(s), including CHARGE-OFFs. -->
<div class="my-2 col-md-12 ">
    <div class="label-div question-area">
        <div class="form-group">
            <label class=" form-label">JOINT DEBT:<br> Do you share any loan with someone else (not just an authorized
                user)?
                List every shared debt and name the other borrower(s), including CHARGE-OFFs.</label>
            <textarea name="joint_debt"
                class="input_capitalize form-control">{{ !empty(Helper::validate_key_value('joint_debt', $formData)) ? Helper::validate_key_value('joint_debt', $formData) : old('joint_debt') }}</textarea>
        </div>
    </div>
</div>
<!-- ; TOTAL CREDIT CARD DEBT: What it the TOTAL owed on all credit cards combined, including Charge-offs? • How much of these are from a Credit Union? -->
<div
    class="my-2 col-md-12 {{ \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'estimated_total_credit_card_debt') }}">
    <div class="label-div question-area">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <label class="form-label mb-md-0">TOTAL CREDIT CARD DEBT:<br> What it the TOTAL owed on all credit
                        cards combined,
                        including Charge-offs? • How much of these are from a Credit Union?</label>
                </div>
                <div class="col-md-4">
                    <div class="d-flex input-group">
                        <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                        <input required type="text" class="custom_corner_input form-control price-field"
                            placeholder="Estimated Total Credit Card Debt" name="credit_crd_debt"
                            value="{{ !empty(Helper::validate_key_value('credit_crd_debt', $formData)) ? Helper::validate_key_value('credit_crd_debt', $formData) : old('credit_crd_debt') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- TOTAL UNSECURED LOANS: What is the TOTAL amount of all unsecured debts combined? These include personal, payday, signature, consolidation, or any other unsecured loans (not student loans or credit cards), including CHARGE-OFFs? -->
<div class="my-2 col-md-12 ">
    <div class="label-div question-area">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <label class=" form-label mb-md-0">TOTAL UNSECURED LOANS:<br> What is the TOTAL amount of all
                        unsecured debts combined?
                        These include personal, payday, signature, consolidation, or any other unsecured loans (not
                        student
                        loans or credit cards), including CHARGE-OFFs?</label>
                </div>
                <div class="col-md-4">
                    <div class="d-flex input-group">
                        <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                        <input type="text" name="total_unsecured_loan"
                            class="custom_corner_input form-control price-field" placeholder="Total amount"
                            value="{{ !empty(Helper::validate_key_value('total_unsecured_loan', $formData)) ? Helper::validate_key_value('total_unsecured_loan', $formData) : old('total_unsecured_loan') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ; TOTAL MEDICAL DEBT: How much TOTAL medical debt do you have, including CHARGE-OFFs? -->
<div
    class="my-2 col-md-12 {{ \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'estimated_total_medical_debt') }}">
    <div class="label-div question-area">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <label class="form-label mb-md-0">TOTAL MEDICAL DEBT:<br> How much TOTAL medical debt do you have,
                        including
                        CHARGE-OFFs?</label>
                </div>
                <div class="col-md-4">
                    <div class="d-flex input-group">
                        <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                        <input required type="text" class="custom_corner_input form-control price-field"
                            placeholder="Estimated Total Medical Debt" name="medical_debt"
                            value="{{ !empty(Helper::validate_key_value('medical_debt', $formData)) ? Helper::validate_key_value('medical_debt', $formData) : old('medical_debt') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- TOTAL UTILITY DEBT: What is the TOTAL debt of all utilities that you are more than 1 month behind, combined? (examples: Time Warner, Verizon, water, and electricity), including CHARGE-OFFs -->
<div class="my-2 col-md-12 ">
    <div class="label-div question-area">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <label class=" form-label mb-md-0">TOTAL UTILITY DEBT:<br> What is the TOTAL debt of all utilities
                        that you are more than
                        1 month behind, combined? (examples: Time Warner, Verizon, water, and electricity), including
                        CHARGE-OFFs</label>
                </div>
                <div class="col-md-4">
                    <div class="d-flex input-group">
                        <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                        <input type="text" name="total_utility_debt"
                            class="custom_corner_input form-control price-field" placeholder="Total amount"
                            value="{{ !empty(Helper::validate_key_value('total_utility_debt', $formData)) ? Helper::validate_key_value('total_utility_debt', $formData) : old('total_utility_debt') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ; JUDGMENTS: Do you have any judgments against you that you know about? If so, how much, including CHARGE-OFFs? -->
<div
    class="my-2 col-md-12 {{ \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'estimated_law_suit_judgement') }}">
    <div class="label-div question-area">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <label class="form-label mb-md-0">JUDGMENTS:<br> Do you have any judgments against you that you know
                        about? If so,
                        how
                        much, including CHARGE-OFFs?</label>
                </div>
                <div class="col-md-4">
                    <div class="d-flex input-group">
                        <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                        <input required type="text" class="custom_corner_input form-control price-field"
                            placeholder="Estimated Lawsuit / Judgement" name="law_suit"
                            value="{{ !empty(Helper::validate_key_value('law_suit', $formData)) ? Helper::validate_key_value('law_suit', $formData) : old('law_suit') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ; STUDENT LOANS: Total you owe? • How much is federal? • Monthly payment on those federal loans? -->
<div
    class="my-2 col-md-12 {{ \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'estimated_total_student_loans') }}">
    <div class="label-div question-area">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <label class="form-label mb-md-0">STUDENT LOANS:<br> Total you owe? • How much is federal? • Monthly
                        payment on
                        those federal loans?</label>
                </div>
                <div class="col-md-4">
                    <div class="d-flex input-group">
                        <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                        <input required type="text" class="custom_corner_input form-control price-field"
                            placeholder="Estimated Total Student Debt" name="student_loans"
                            value="{{ !empty(Helper::validate_key_value('student_loans', $formData)) ? Helper::validate_key_value('student_loans', $formData) : old('student_loans') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- TOLLS, TICKETS, & FINES OWED: -->
<div class="my-2 col-md-12 ">
    <div class="label-div question-area">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <label class=" form-label mb-md-0">TOLLS, TICKETS, & FINES OWED:</label>
                </div>
                <div class="col-md-4">
                    <div class="d-flex input-group">
                        <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                        <input type="text" name="tolls_tickets_fines_owed"
                            class="custom_corner_input form-control price-field" placeholder="Total amount"
                            value="{{ !empty(Helper::validate_key_value('tolls_tickets_fines_owed', $formData)) ? Helper::validate_key_value('tolls_tickets_fines_owed', $formData) : old('tolls_tickets_fines_owed') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- EVICTION OR BACK RENT: How much eviction debt and back rent debt do you have, including CHARGE-OFFs? -->
<div class="my-2 col-md-12 ">
    <div class="label-div question-area">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <label class=" form-label mb-md-0">EVICTION OR BACK RENT:<br> How much eviction debt and back rent
                        debt do you have,
                        including CHARGE-OFFs?</label>
                </div>
                <div class="col-md-4">
                    <div class="d-flex input-group">
                        <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                        <input type="text" name="eviction_or_back_rent"
                            class="custom_corner_input form-control price-field" placeholder="Total amount"
                            value="{{ !empty(Helper::validate_key_value('eviction_or_back_rent', $formData)) ? Helper::validate_key_value('eviction_or_back_rent', $formData) : old('eviction_or_back_rent') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FORECLOSURE DEBT: How much past foreclosure debt do you have, including CHARGE-OFFs? -->
<div class="my-2 col-md-12 ">
    <div class="label-div question-area">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <label class=" form-label mb-md-0">FORECLOSURE DEBT:<br> How much past foreclosure debt do you have,
                        including
                        CHARGE-OFFs?</label>
                </div>
                <div class="col-md-4">
                    <div class="d-flex input-group">
                        <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                        <input type="text" name="foreclosure_debt"
                            class="custom_corner_input form-control price-field" placeholder="Total amount"
                            value="{{ !empty(Helper::validate_key_value('foreclosure_debt', $formData)) ? Helper::validate_key_value('foreclosure_debt', $formData) : old('foreclosure_debt') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- REPO DEBT: How much do you still owe from any past repossessions, including CHARGE-OFFs? -->
<div class="my-2 col-md-12 ">
    <div class="label-div question-area">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <label class=" form-label mb-md-0">REPO DEBT:<br> How much do you still owe from any past
                        repossessions, including
                        CHARGE-OFFs?</label>
                </div>
                <div class="col-md-4">
                    <div class="d-flex input-group">
                        <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                        <input type="text" name="repo_debt"
                            class="custom_corner_input form-control price-field" placeholder="Total amount"
                            value="{{ !empty(Helper::validate_key_value('repo_debt', $formData)) ? Helper::validate_key_value('repo_debt', $formData) : old('repo_debt') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ; CREDIT UNION DEBT: For every loan or card from a credit union, list: • Type (car loan, credit card, etc.) • Amount still owed • What the money was for, including CHARGE-OFFs? -->
<div
    class="my-2 col-md-12 {{ \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'estimated_total_credit_union_loans') }}">
    <div class="label-div question-area">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <label class="form-label mb-md-0">CREDIT UNION DEBT:<br> For every loan or card from a credit union,
                        list: • Type
                        (car loan, credit card, etc.) • Amount still owed • What the money was for, including
                        CHARGE-OFFs?</label>
                </div>
                <div class="col-md-4">
                    <div class="d-flex input-group">
                        <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                        <input required type="text" class="custom_corner_input form-control price-field"
                            placeholder="Estimated Total Credit Union Loans" name="credit_union_loans"
                            value="{{ !empty(Helper::validate_key_value('credit_union_loans', $formData)) ? Helper::validate_key_value('credit_union_loans', $formData) : old('credit_union_loans') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div
    class="my-2 col-md-12 {{ \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'estimated_total_personal_loans') }}">
    <div class="label-div question-area">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <label class="form-label mb-md-0">PERSONAL LOAN:<br> Estimated Total Personal Loans</label>
                </div>
                <div class="col-md-4">
                    <div class="d-flex input-group">
                        <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                        <input required type="text" class="custom_corner_input form-control price-field"
                            placeholder="Estimated Total Personal Loans" name="personal_loans"
                            value="{{ !empty(Helper::validate_key_value('personal_loans', $formData)) ? Helper::validate_key_value('personal_loans', $formData) : old('personal_loans') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ; OTHER DEBT: Debt not previously listed, including CHARGE-OFFs -->
<div
    class="my-2 col-md-12 {{ \App\Models\ShortFormConditionalFields::returnActiveOrNot($conditionalQuestions, 'estimated_misc_loans') }}">
    <div class="label-div question-area">
        <div class="form-group">
            <div class="row">
                <div class="col-md-8">
                    <label class="form-label mb-md-0">OTHER DEBT:<br> Debt not previously listed, including
                        CHARGE-OFFs</label>
                </div>
                <div class="col-md-4">
                    <div class="d-flex input-group">
                        <span class="custom_corner_span h-26px br-0 input-group-text" id="basic-addon1">$</span>
                        <input required type="text" class="custom_corner_input form-control price-field"
                            placeholder="Estimated Other types of Debts" name="misc_loans"
                            value="{{ !empty(Helper::validate_key_value('misc_loans', $formData)) ? Helper::validate_key_value('misc_loans', $formData) : old('misc_loans') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- $: How much do you have in the Bank, Credit Union, in your Pocket, in Stock, Bond, Investments, NFTs, Crypto, Cash App, PayPal, Venmo, Whole Life Ins., I.U.L., Trusts, Business Accounts- ANYWHERE except 401(k)s, 403(b)s, 457(b)&(f)s, and IRAs? -->
<div class="my-2 col-md-12 ">
    <div class="label-div question-area">
        <div class="form-group">
            <label class=" form-label">$: How much do you have in the Bank, Credit Union, in your Pocket, in Stock,
                Bond,
                Investments, NFTs, Crypto, Cash App, PayPal, Venmo, Whole Life Ins., I.U.L., Trusts, Business Accounts-
                ANYWHERE except 401(k)s, 403(b)s, 457(b)&(f)s, and IRAs?</label>
            <input type="text" name="money_you_have" class="input_capitalize form-control" placeholder="Details"
                value="{{ !empty(Helper::validate_key_value('money_you_have', $formData)) ? Helper::validate_key_value('money_you_have', $formData) : old('money_you_have') }}">
        </div>
    </div>
</div>

<div class="col-md-12 my-2">
    <div class="label-div question-area ">
        <label class="form-label">Have you made any major purchases or used credit cards for purchases over the
            last 3 months?</label>
        <!-- Radio -->
        <div class="custom-radio-group form-group">
            <input type="radio" required name="made_purchases" class="form-check-input" {{ (Helper::validate_key_value('made_purchases', $formData, 'radio') === 0 || old('made_purchases') === '0') ? 'checked' : '' }} id="made_purchases_yes" value="0">
            <label for="made_purchases_yes" class="btn-toggle">Yes</label>
            <input type="radio" required name="made_purchases" class="form-check-input" {{ (Helper::validate_key_value('made_purchases', $formData, 'radio') === 1 || old('made_purchases') === '1') ? 'checked' : '' }} id="made_purchases_no" value="1">
            <label for="made_purchases_no" class="btn-toggle">No</label>
        </div>
    </div>
</div>
<div class="my-2 col-md-12">
    <div class="label-div question-area ">
        <label class="form-label">Do you bank at or with any bank you have credit cards with also?</label>
        <!-- Radio -->
        <div class="custom-radio-group form-group">
            <input type="radio" required name="checking_account" class="form-check-input" id="checking_account_yes"
                {{ (Helper::validate_key_value('checking_account', $formData, 'radio') === 0 || old('checking_account') === '0') ? 'checked' : '' }} value="0">
            <label for="checking_account_yes" class="btn-toggle">Yes</label>
            <input type="radio" required name="checking_account" class="form-check-input" id="checking_account_no" {{ (Helper::validate_key_value('checking_account', $formData, 'radio') === 1 || old('checking_account') === '1') ? 'checked' : '' }} value="1">
            <label for="checking_account_no" class="btn-toggle">No</label>
        </div>
    </div>
</div>